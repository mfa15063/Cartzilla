<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['main_menu_title'] = "Order Management";
        $data['sub_menu_title'] = "Viewing all Orders";

        $data['orders'] = Order::orderBy('id', 'desc');
        if ($request->name != '') {
            $data['orders']->whereHas('orderGiver', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            });
        }


        if ($request->status != '') {
            $data['orders']->where('status',$request->status);
        }
        if ($request->date_from != '') {
            $data['orders']->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($request->date_from)));
        }
        if ($request->date_to != '') {
            $data['orders']->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->date_to)));
        }
        $data['orders'] = $data['orders']->paginate(100);

        $data['total_sale']=$data['orders']->sum('amount');
        return view('backend.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Order::find($id);
        $data['main_menu_title'] = "Order # ".$data['order']->order_number;
        $data['sub_menu_title'] = "Order Details";
        return view('backend.orders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

        if(!($order->status=="dispatched" || $order->status=="delivered"))
        {
            $order->orderDetail()->delete();
            $order->delete();
            return response()->json(['status' => 1,'orderstatus' => 'Order deleted successfully']);
        }

        return response()->json(['status' => 403,'orderstatus' => 'Order cannot be deleted']);
    }
    public function change_status(Request $request){
        $order=Order::find($request->id);
        if($order->status=="delivered"){

            return response()->json(['status' => 403,'orderstatus' => $request->status]);
        }
        if($order->status=="dispatched"){
            if($request->status=="delivered"){
                $order->status=$request->status;
                $order->save();
                return response()->json(['status' => 1,'orderstatus' => $request->status]);
            }
            else{
                return response()->json(['status' => 403,'orderstatus' => $request->status]);
            }


        }
        $order->status=$request->status;

        $order->save();


        /*event(new NewOrderReceived($order));*/
        return response()->json(['status' => 1,'orderstatus' => $request->status]);
    }

    public function invoice($id){
        
        $data['order'] = Order::find($id);
        $data['main_menu_title'] = "Order # ".$data['order']->order_number;
        $data['sub_menu_title'] = "Order Details";
        return view('backend.orders.invoice', $data);
    }
}
