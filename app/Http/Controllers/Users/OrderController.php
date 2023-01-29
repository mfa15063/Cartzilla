<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreWishListRequest;
use App\Http\Requests\UpdateWishListRequest;
use App\Models\Order;
use Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders(){
        $orders = Order::where('order_by' , Auth::user()->id)->paginate(10);
        return view('user.orders' , compact('orders'));
    }
    public function order_detail($id){
        $order = Order::find($id);
        
        return view('user.includes.order-detail' , compact('order'));
    }

}
