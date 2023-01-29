<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\City;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CartFacades;


class HomeController extends Controller
{
    public function index(){
        $data['products'] = Product::where('is_featured',1)->limit(8)->get();
        return view('frontend.home',$data);
    }
    public function quickView(Request $request){
        $data['product']=Product::find(\Request::segment(2));
        if(!Auth::check()){
            $n = $data['product']->standard;
            $price = (int) $n;      // 1
            $fraction = $n - $price;
        }
        else{
            if(Auth::user()->price_category=="standard")
            {
                $n = $data['product']->standard;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else if(Auth::user()->price_category=="premium")
            {
                $n = $data['product']->premium;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
            else{
                $n = $data['product']->gold;
                $price = (int) $n;      // 1
                $fraction = $n - $price;
            }
        }
        $data['price']=$price;
        $data['fraction']=substr($fraction, 1, 3) ;

        return view('frontend.products.quick-view',$data);
    }


    public function all($category = ""){
        if($category != "" && $category != null){
            $category = Category::whereSlug($category)->first();
            $products = Product::whereCategoryId($category->id)->get();
        }
        else
            $products = Product::OrderBy('id' , "Desc")->limit(6)->get();

        $colors = [];
        foreach ($products as $pro) {
            if (!empty($pro->color)) {
                foreach ($pro->getColors() as $key=>$color) {
                    if (!in_array($key, $colors)) {
                        array_push($colors, $key);
                    }
                }
            }
        }
        if (!Auth::check()) {
            $max = Product::max("standard");
            $min = Product::min("standard");
        }else{
            if (Auth::user()->price_category=="standard") {
                $max = Product::max("standard");
                $min = Product::min("standard");
            } elseif (Auth::user()->price_category=="premium") {
                $max = Product::max("premium");
                $min = Product::min("premium");
            } else {
                $max = Product::max("gold");
                $min = Product::min("gold");
            }
        }
        $total = Product::count();
        $prevTotal = 6;
        return view('frontend.products' , compact('products' , 'colors' , 'max' , 'min' , 'category' , 'total' , 'prevTotal'));
    }

    public function filter(Request $request){
        $cats = null;
        $ptotal = '';
        if(isset($request->cats)){
            $cats = $request->cats;
        }
        $min = null;
        if(isset($request->min)){
            $min = $request->min;
        }
        $max = null;
        if(isset($request->max)){
            $max = $request->max;
        }
        $brands = null;
        if(isset($request->brands)){
            $brands = $request->brands;
        }
        $colors = null;
        if(isset($request->colors)){
            $colors = $request->colors;
        }
        if(!isset($request->brands) && !isset($request->cats) && !isset($request->colors)){
            $prevTotal = $request->prevTotal + 6;
        }else{
            $prevTotal = $request->prevTotal;
        }
        $pro = Product::
        when($cats, function ($query, $cats) {
            return $query->whereIn('category_id', $cats);
        })->when($brands, function ($query, $brands) {
            return $query->whereIn('brand_id', $brands);

        })
        ->when($min, function ($query, $min) {
            if(!Auth::check())
                return $query->where('standard', '>=', $min);
            else
                return $query->where(Auth::user()->priceColumnName(), '>=', $min);
        })
        ->when($max, function ($query, $max) {
            if(!Auth::check())
                return $query->where('standard', '<=', $max);
            else
                return $query->where(Auth::user()->priceColumnName(), '<=' , $max);
        });
        $total = $pro->count();
        if($request->page == 0)
            $products = $pro->Orderby('id' , 'Desc')->limit(6)->get();
        else
            $products = $pro->where('id','<',(int)$request->page)->Orderby('id' , 'Desc')->limit(6)->get();

        if (!empty($colors)) {
            foreach ($products as $key => $pro) {
                // echo $pro->color;
                if (empty($pro->color)) {
                    unset($products[$key]);
                } else {
                    // print_r($pro->getColors());
                    $res = array_intersect(array_keys($pro->getColors()), $colors);
                    if (sizeof($res) == 0) {
                        unset($products[$key]);
                    }
                }
            }
        }
        return view('includes.filtered-products', compact('products' , 'total' , 'prevTotal'));
    }

    public function product($slug){
        $product = Product::whereSlug($slug)->first();

        return view('frontend.product' , compact('product'));
    }

    public function add_to_cart($product_id , $is_offer=0 , $quantity=1 , $color = ""){
        $color = str_replace('k' , '#' , $color);
        $cart = ['product_id' => $product_id , 'is_offer' => $is_offer , 'quantity' => $quantity , 'color' => $color];
        return CartFacades::addProduct($cart);
    }
    public function cart(){
        $products = CartFacades::getProducts();
        $total = CartFacades::getTotal();
        return view('frontend.cart' , compact('products' , 'total'));
    }

    public function sum($id){
        $products = CartFacades::getProductIds();
    }
    public function remove($id){
        $products = CartFacades::remove($id);
        $total_price = CartFacades::getTotal();
        $total_items = CartFacades::getTotalCart();
        return response()->json(['totalPrice' => $total_price , 'totalItems' => $total_items]);

    }

    public function change_quantity($id , $quantity){
        CartFacades::changeQuantity($id , $quantity);
        $total_price = CartFacades::getTotal();
        $total_items = CartFacades::getTotalCart();
        return response()->json(['totalPrice' => $total_price , 'totalItems' => $total_items]);
    }

    public function search($search = "" , $cat = 0){
        $search = str_replace("%20" , " " , $search);
        $pro = Product::
        when($cat, function ($query, $cat) {
            return $query->where('category_id', $cat);
        })->when($search, function ($query, $search) {
            // return $query->like('name', $search);
          return $query->where('name' , 'Like', '%'.$search.'%');

        });
        $products = $pro->get();
        return view('includes.search-items', compact('products'));
    }

    public function checkout(){
        $products = CartFacades::getProducts();
        $total = CartFacades::getTotal();
        if($total>0)
        return view('frontend.checkout' , compact('products' , 'total'));
        return redirect()->route('front.index');
    }

    public function getCities($id){
        $cities = City::whereStateId($id)->get();
        return view('includes.cities' , compact('cities'));
    }

    public function privacy_policy(){
        $data['setting'] = Setting::whereSettingKey('privacy_policy')->first();
        $data['title'] = $data['setting']->setting_name;

        return view('frontend.privacy' , $data);
    }

    public function terms(){
        $data['setting'] = Setting::whereSettingKey('terms_and_condition')->first();
        $data['title'] = $data['setting']->setting_name;
        return view('frontend.privacy' , $data);
    }

    public function returns_policy(){
        $data['setting'] = Setting::whereSettingKey('return_policy')->first();
        if($data['setting'] != null)
            $data['title'] = $data['setting']->setting_name;
        else
            $data['title'] = "Return Policy";
        return view('frontend.privacy' , $data);
    }
}
