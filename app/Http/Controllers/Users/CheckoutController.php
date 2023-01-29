<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;
use Auth;
use App\Repositories\CartFacades;
use App\Models\Order;
use App\Models\OrderDetail;
use nickknissen\QuickPay\Card;
use nickknissen\QuickPay\Exceptions\QuickPayValidationError;
use nickknissen\QuickPay\Payments;
use Srmklive\PayPal\Services\ExpressCheckout;
use QuickPay\QuickPay;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        $input = $request->all();
        Session::put('order_details', $input);
        $product = [];
        $products = CartFacades::getProducts();
        $prods = [];

        if($request->payment_method == 'paypal'){
            foreach($products as $pro){
                $prods[] = [
                    'name' => $pro->name,
                    'price' => $pro->getPrice().$pro->getFraction(),
                    'qty' => $pro->squantity
                ];
            }
            $product['items'] = $prods;

            $product['invoice_id'] = "Ord".rand(0, 10).time();
            $product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
            $product['return_url'] = route('checkout.thankyou');
            $product['cancel_url'] = route('checkout.cancel');
            $product['total'] = $request->total;
            $paypalModule = new ExpressCheckout;

            // $res = $paypalModule->setExpressCheckout($product);
            $res = $paypalModule->setExpressCheckout($product, true);
            return redirect($res['paypal_link']);
        }else{
            $amount = 0;
            $product_names = "";
            foreach($products as $key => $pro){
                $amount += $pro->getPrice().$pro->getFraction();
                $product_names .= $pro->name . " ,";
            }
            $orderId = "Ord".rand(0, 10).time();
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Charge::create ([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Purchase ". trim($product_names) ."."
            ]);
            return $this->success($orderId);
        }
    }



    public function thankyou(Request $request){
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $inv_num = $response['INVNUM'];
            return $this->success($inv_num);
        }

        dd('Error occured!');
    }
    protected function success($inv_num=""){
        $dat  = Session::get('order_details');
        $order = new Order();
        $order->order_by = Auth::user()->id;
        $order->amount = $dat['total'];
        $order->quantity = CartFacades::getTotalItems();
        $order_number = $inv_num;
        $order->notes = $dat['notes'];
        $order->order_number = $inv_num;
        $order->checkout_lname = $dat['checkout_lname'];
        $order->checkout_email = $dat['checkout_email'];
        $order->checkout_phone = $dat['checkout_phone'];
        $order->checkout_city_id = $dat['checkout_city_id'];
        $order->checkout_zip_code = $dat['checkout_zip_code'];
        $order->checkout_address = $dat['checkout_address'];
        $order->checkout_address_two = $dat['checkout_address_two'];
        $order->payment_method = $dat['payment_method'];
        $order->checkout_state_id = $dat['checkout_state_id'];
        $order->save();
        $products = CartFacades::getProducts();
        foreach($products as $pro){
            $prod = new OrderDetail;
            $prod->order_id = $order->id;
            $prod->product_id = $pro->id;
            $prod->color = $pro->scolor;
            $prod->quantity = $pro->squantity;
            $prod->product_price = $pro->getPrice().$pro->getFraction();
            $prod->save();
        }
        CartFacades::emptyCart();
        return view('checkout.thankyou' , compact('order_number'));
    }
    public function cancelTransaction(Request $request){
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }
}
