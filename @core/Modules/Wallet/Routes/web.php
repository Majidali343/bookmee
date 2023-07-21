<?php

use Illuminate\Support\Facades\Route;

// backend routes
Route::group(['prefix' => 'admin-home/wallet','as'=>'admin.wallet.', 'middleware' => 'globalVariable'], function () {
    Route::get( '/lists', 'Backend\WalletController@wallet_lists')->name('lists');
    Route::post( '/status/{id}', 'Backend\WalletController@change_status')->name('status');
    Route::get( '/history/records', 'Backend\WalletController@wallet_history')->name('history');
    Route::post( '/history/records/status/{id}', 'Backend\WalletController@wallet_history_status')->name('history.status');
    Route::post( '/deposit/create-by-admin', 'Backend\WalletController@depositCreateByAdmin')->name('deposit.create');
});

//buyer routes
Route::group(['as'=>'buyer.','prefix'=>'buyer','middleware'=>['auth','inactiveuser','UserRoleCheck','userEmailVerify','setlang','globalVariable']],function(){
    Route::controller(Frontend\BuyerWalletController::class)->group(function () {
        Route::get('/wallet-history', 'wallet_history')->name('wallet.history');
        Route::post('/wallet/deposit', 'deposit')->name('wallet.deposit');
        Route::get('wallet/deposit-cancel-static','deposit_payment_cancel_static')->name('wallet.deposit.payment.cancel.static');
    });
});

Route::group(['prefix' => 'wallet'],function (){
    //wallet payment routes
    Route::get('/paypal-ipn','Frontend\BuyerWalletPaymentController@paypal_ipn_for_wallet')->name('buyer.paypal.ipn.wallet');
    Route::post('/paytm-ipn','Frontend\BuyerWalletPaymentController@paytm_ipn_for_wallet')->name('buyer.paytm.ipn.wallet');
    Route::get('/paystack-ipn','Frontend\BuyerWalletPaymentController@paystack_ipn_for_wallet')->name('buyer.paystack.ipn.wallet');
    Route::get('/mollie/ipn','Frontend\BuyerWalletPaymentController@mollie_ipn_for_wallet')->name('buyer.mollie.ipn.wallet');
    Route::get('/stripe/ipn','Frontend\BuyerWalletPaymentController@stripe_ipn_for_wallet')->name('buyer.stripe.ipn.wallet');
    Route::post('/razorpay-ipn','Frontend\BuyerWalletPaymentController@razorpay_ipn_for_wallet')->name('buyer.razorpay.ipn.wallet');
    Route::get('/flutterwave/ipn','Frontend\BuyerWalletPaymentController@flutterwave_ipn_for_wallet')->name('buyer.flutterwave.ipn.wallet');
    Route::get('/midtrans-ipn','Frontend\BuyerWalletPaymentController@midtrans_ipn_for_wallet')->name('buyer.midtrans.ipn.wallet');
    Route::post('/payfast-ipn','Frontend\BuyerWalletPaymentController@payfast_ipn_for_wallet')->name('buyer.payfast.ipn.wallet');
    Route::post('/cashfree-ipn','Frontend\BuyerWalletPaymentController@cashfree_ipn_for_wallet')->name('buyer.cashfree.ipn.wallet');
    Route::get('/instamojo-ipn','Frontend\BuyerWalletPaymentController@instamojo_ipn_for_wallet')->name('buyer.instamojo.ipn.wallet');
    Route::get('/marcadopago-ipn','Frontend\BuyerWalletPaymentController@marcadopago_ipn_for_wallet')->name('buyer.marcadopago.ipn.wallet');
    Route::get('/squareup-ipn','Frontend\BuyerWalletPaymentController@squareup_ipn_for_wallet' )->name('buyer.squareup.ipn.wallet');
    Route::post('/cinetpay-ipn', 'Frontend\BuyerWalletPaymentController@cinetpay_ipn_for_wallet' )->name('buyer.cinetpay.ipn.wallet');
    Route::post('/paytabs-ipn','Frontend\BuyerWalletPaymentController@paytabs_ipn_for_wallet' )->name('buyer.paytabs.ipn.wallet');
    Route::post('/billplz-ipn','Frontend\BuyerWalletPaymentController@billplz_ipn_for_wallet' )->name('buyer.billplz.ipn.wallet');
    Route::post('/zitopay-ipn','Frontend\BuyerWalletPaymentController@zitopay_ipn_for_wallet' )->name('buyer.zitopay.ipn.wallet');
});

//buyer routes
Route::group(['as'=>'seller.','prefix'=>'seller','middleware'=>['auth','inactiveuser','BuyerCheck','userEmailVerify','setlang','globalVariable']],function(){
    Route::controller(Frontend\SellerWalletController::class)->group(function () {
        Route::get('/wallet-history', 'wallet_history')->name('wallet.history');
        Route::post('/wallet/deposit', 'deposit')->name('wallet.deposit');
        Route::get('wallet/deposit-cancel-static','deposit_payment_cancel_static')->name('wallet.deposit.payment.cancel.static');
    });
});

Route::group(['prefix' => 'seller/wallet'],function (){
    //wallet payment routes
    Route::get('/paypal-ipn','Frontend\SellerWalletPaymentController@paypal_ipn_for_wallet')->name('seller.paypal.ipn.wallet');
    Route::post('/paytm-ipn','Frontend\SellerWalletPaymentController@paytm_ipn_for_wallet')->name('seller.paytm.ipn.wallet');
    Route::get('/paystack-ipn','Frontend\SellerWalletPaymentController@paystack_ipn_for_wallet')->name('seller.paystack.ipn.wallet');
    Route::get('/mollie/ipn','Frontend\SellerWalletPaymentController@mollie_ipn_for_wallet')->name('seller.mollie.ipn.wallet');
    Route::get('/stripe/ipn','Frontend\SellerWalletPaymentController@stripe_ipn_for_wallet')->name('seller.stripe.ipn.wallet');
    Route::post('/razorpay-ipn','Frontend\SellerWalletPaymentController@razorpay_ipn_for_wallet')->name('seller.razorpay.ipn.wallet');
    Route::get('/flutterwave/ipn','Frontend\SellerWalletPaymentController@flutterwave_ipn_for_wallet')->name('seller.flutterwave.ipn.wallet');
    Route::get('/midtrans-ipn','Frontend\SellerWalletPaymentController@midtrans_ipn_for_wallet')->name('seller.midtrans.ipn.wallet');
    Route::post('/payfast-ipn','Frontend\SellerWalletPaymentController@payfast_ipn_for_wallet')->name('seller.payfast.ipn.wallet');
    Route::post('/cashfree-ipn','Frontend\SellerWalletPaymentController@cashfree_ipn_for_wallet')->name('seller.cashfree.ipn.wallet');
    Route::get('/instamojo-ipn','Frontend\SellerWalletPaymentController@instamojo_ipn_for_wallet')->name('seller.instamojo.ipn.wallet');
    Route::get('/marcadopago-ipn','Frontend\SellerWalletPaymentController@marcadopago_ipn_for_wallet')->name('seller.marcadopago.ipn.wallet');
    Route::get('/squareup-ipn','Frontend\SellerWalletPaymentController@squareup_ipn_for_wallet' )->name('seller.squareup.ipn.wallet');
    Route::post('/cinetpay-ipn', 'Frontend\SellerWalletPaymentController@cinetpay_ipn_for_wallet' )->name('seller.cinetpay.ipn.wallet');
    Route::post('/paytabs-ipn','Frontend\SellerWalletPaymentController@paytabs_ipn_for_wallet' )->name('seller.paytabs.ipn.wallet');
    Route::post('/billplz-ipn','Frontend\SellerWalletPaymentController@billplz_ipn_for_wallet' )->name('seller.billplz.ipn.wallet');
    Route::post('/zitopay-ipn','Frontend\SellerWalletPaymentController@zitopay_ipn_for_wallet' )->name('seller.zitopay.ipn.wallet');
});