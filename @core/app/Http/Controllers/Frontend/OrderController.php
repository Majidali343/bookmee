<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderAdditional;
use App\OrderInclude;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderDetails($id){
        $order_details = Order::where('id',$id)->first();
        $order_includes = OrderInclude::where('id',$id)->get();
        $order_additionals = OrderAdditional::where('id',$id)->get();
        return view('frontend.pages.order.order-details',compact('order_details','order_includes','order_additionals'));
    }
}
