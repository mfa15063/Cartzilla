<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
class HomeController extends Controller
{
    public function dashboard(){

        $data['active_users']=User::where('status',1)->count();
        $data['total_revenue']=Order::whereIn('status',['dispatched','delivered'])->sum('amount');
        $data['cmr']=Order::whereIn('status',['dispatched','delivered'])
            ->whereMonth('created_at', '=', date('m'))->sum('amount');
        $data['total_orders']=Order::count();
        $data['total_products']=Product::count();
        return view('backend.dashboard',$data);
    }

    public function about_us()
    {
        $data['page_title']="About US";
        return view('backend.about', $data);
    }
}
