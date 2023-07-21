<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PayoutRequest;
use App\OrderInclude;
use App\OrderAdditional;
use App\Order;
use PDF;
use Auth;

class InvoiceController extends Controller
{
    public function PayoutInvoice($id=null)
    {
        $payout_details = PayoutRequest::where('id',$id)->first();
        $pdf = PDF::loadView('frontend.user.seller.payout.payout-invoice',compact('payout_details'));
        return $pdf->download('invoice.pdf');
    }

    public function orderInvoiceSeller($id=null)
    {
        $order_details = Order::where('id',$id)->where('seller_id',Auth::guard('web')->user()->id)->first();
        $order_includes = OrderInclude::where('order_id',$id)->get();
        $order_additionals = OrderAdditional::where('order_id',$id)->get();
//        $order_additionals = OrderAdditional::where('order_id',$id)->get();
        if($order_details != ''){
            $pdf = PDF::loadView('frontend.user.seller.order.order-invoice',compact('order_details','order_includes','order_additionals'));
            return $pdf->stream('invoice.pdf');  
        }else{
            abort(404);
        }
        
        
    }

    public function orderInvoiceBuyer($id=null)
    {
        $order_details = Order::where(['id' => $id, 'buyer_id' => auth('web')->id()])->firstOrFail();
        $order_includes = OrderInclude::where('order_id',$id)->get();
        $order_additionals = OrderAdditional::where('order_id',$id)->get();
        $pdf = PDF::loadView('frontend.user.buyer.order.order-invoice',compact('order_details','order_includes','order_additionals'));
        return $pdf->stream('invoice.pdf');  
    }
}
