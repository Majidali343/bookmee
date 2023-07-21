<?php

namespace Xgenious\Paymentgateway\Http\Controllers;


use Illuminate\Http\Request;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class StripePaymentController extends Controller
{
    public function charge_customer(Request $request){
        try{
            $stripe_session = XgPaymentGateway::stripe()->charge_customer_from_controller([
                'amount' => $request->amount,
                'charge_amount' => $request->charge_amount,
                'title' => $request->title,
                'description' => $request->description,
                'ipn_url' => $request->ipn_url,
                'order_id' => $request->order_id,
                'track' => $request->track,
                'cancel_url' => $request->cancel_url,
                'success_url' => $request->success_url,
                'email' => $request->email,
                'name' => $request->name,
                'payment_type' => $request->payment_type,
                'secret_key' => $request->secret_key,
                'currency' => $request->currency,
            ]);
            return response()->json(['id' => $stripe_session['id']]);
        }catch(\Exception $e){
            return response()->json(['msg' => $e->getMessage(),'type' => 'danger']);
        }
    }
}
