<?php

namespace Xgenious\Paymentgateway\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class PaystackPaymentController extends Controller
{
    public function redirect_to_gateway(Request $request){
        config(array_merge([
            'paystack.merchantEmail' => $request->merchantEmail,
            'paystack.secretKey' => base64_decode($request->secretKey),
            'paystack.publicKey' => $request->publicKey,
            'paystack.paymentUrl' => 'https://api.paystack.co',
        ]));

        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            abort(405,$e->getMessage());
        }
    }
}
