<?php

namespace Xgenious\Paymentgateway\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class AuthorizeNetPaymentController extends Controller
{
    public function charge_customer(Request $request){
       $payment_data =  XgPaymentGateway::authorizenet()->charge_customer_from_controller();
       $transaction_id = $payment_data['transaction_id'] ?? "";
       Session::put('authorizenet_last_transaction_id',$transaction_id);
       return redirect($request->ipn_url."?transaction_id=".$transaction_id."&order_id=".$request->order_id."&order_type=".$request->payment_type."&status=".$payment_data['status']);
    }
}
