<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Facade;
use Session;
use App\Models\Product;
use App\Models\Offer;

class CartFacades extends Facade
{

    public static function getProductIds(){
        $cart = Session::has('cart')?Session::get('cart'): [];
        $ids = [];
        foreach ($cart as $key => $value) {
            $ids[] = $value['product_id'];
        }
        return $ids;
    }
    public static function addProduct($cart){
        $oldCart = Session::has('cart')?Session::get('cart'): [];
        if (sizeof($oldCart) > 0) {
            foreach ($oldCart as $key => $value) {

                if ($value['product_id'] == $cart['product_id']) {                    
                    return response()->json(['error' => 'Already Added to cart' , 'count' => sizeof($oldCart)]);
                }
            }
        }
        $oldCart[] = $cart;
        Session::put('cart' , $oldCart);
        return response()->json(['success' => 'Added to cart' , 'count' => sizeof($oldCart)]);
    }

    public static function getTotalCart(){
        $oldCart = CartFacades::getProductIds();
        return sizeof($oldCart);
    }
    public static function getProducts(){
        $products = Product::whereIn('id' , CartFacades::getProductIds())->get();
        foreach($products as $pro){
            foreach(Session::get('cart') as $cart){
                if($pro->id == $cart['product_id']){
                    $pro->scolor = $cart['color']; 
                    $pro->squantity = $cart['quantity']; 
                    $pro->is_offer = $cart['is_offer']; 
                    if($cart['is_offer'] == 0)
                        $pro->cprice = $pro->getPrice() . " ".$pro->getFraction(); 
                    else
                    $pro->cprice = CartFacades::getOfferPrice($cart['is_offer']);
                }
            }
        }
        return $products;
    }
    public static function getTotal(){
        $products = CartFacades::getProducts();
        $sum = 0;
        foreach($products as $pro){
            if($pro->is_offer == 0)
                $sum += ($pro->getPrice().$pro->getFraction()) * $pro->squantity;
            else
                $sum += CartFacades::getOfferPrice($pro->is_offer) * $pro->squantity;
        }
        return $sum;
    }
    public static function getOfferPrice($offer_id){
        return Offer::find($offer_id)->price;
    }

    public static function getTotalItems(){
        $products = CartFacades::getProducts();
        $sum = 0;
        foreach($products as $pro){
            $sum += $pro->squantity;
        }
        return $sum;
    }

    public static function getItem($id){
        $products = Session::has('cart')?Session::get('cart'): [];
        foreach($products as $key=>$pro){
            if($pro['product_id'] == $id)
                return $key;
        }
    }

    public static function remove($id){
        $product = CartFacades::getItem($id);
        $oldCart = Session::has('cart')?Session::get('cart'): [];
        unset($oldCart[$product]);
        Session::put('cart' , $oldCart);
    }

    public static function changeQuantity($id , $quantity){
        $product = CartFacades::getItem($id);
        $oldCart = Session::has('cart')?Session::get('cart'): [];
        $newCart = [];
        foreach($oldCart as $key=>$value){
            if($value['product_id'] == $id){
                $value['quantity'] = $quantity;
            }   $newCart[] = $value;
        }
        Session::put('cart' , $newCart);
    }

    public static function emptyCart(){
        Session::forget('cart');
    }
}
?>