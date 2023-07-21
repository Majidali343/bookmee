<?php

/*
|--------------------------------------------------------------------------
| paymentgateway Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your package.
|
*/

/* ----------------------------------------
    STRIPE ROUTE
---------------------------------------- */
Route::group(['middleware' => 'web'],function (){
    /**
     *  STRIPE PAYMENT ROUTE
     * */
    Route::post('xgpayment-gateway/authorizenet',[\Xgenious\Paymentgateway\Http\Controllers\AuthorizeNetPaymentController::class,'charge_customer'])->name('xg.payment.gateway.authorizenet');
    Route::post('xgpayment-gateway/stipe',[\Xgenious\Paymentgateway\Http\Controllers\StripePaymentController::class,'charge_customer'])->name('xg.payment.gateway.stripe');
    Route::post('xgpayment-gateway/paystack',[\Xgenious\Paymentgateway\Http\Controllers\PaystackPaymentController::class,'redirect_to_gateway'])->name('xg.payment.gateway.paystack');
    Route::get('xgpayment-gateway/paystack-callback',[\Xgenious\Paymentgateway\Http\Controllers\PaystackPaymentController::class,'callback'])->name('xg.payment.gateway.paystack.callback');
});

