<?php

// backend routes
Route::group(['prefix' => 'admin-home/subscription','as'=>'admin.', 'middleware' => 'globalVariable'], function () {
    Route::match(['get','post'],'/all','Backend\SubscriptionController@subscriptions')->name('subscription.all');
    Route::post('connect/settings','Backend\SubscriptionController@connectSettings')->name('connect.settings');
    Route::match(['get','post'],'/edit-subscription/{id?}','Backend\SubscriptionController@edit_subscription')->name('subscription.edit');
    Route::post('/delete/{id}','Backend\SubscriptionController@delete_subscription')->name('subscription.delete');
    Route::post('/bulk-action', 'Backend\SubscriptionController@bulk_action')->name('subscription.bulk.action');
    Route::match(['get','post'],'/settings', 'Backend\SubscriptionController@settings')->name('subscription.settings');

    Route::match(['get','post'],'/coupons', 'Backend\SubscriptionController@coupon')->name('subscription.coupon');
    Route::post('/update-coupons', 'Backend\SubscriptionController@coupon_update')->name('subscription.coupon.update');
    Route::post('/change-coupon-status/{id}', 'Backend\SubscriptionController@coupon_status')->name('subscription.coupon.status');
    Route::post('/delete-coupon/{id}', 'Backend\SubscriptionController@coupon_delete')->name('subscription.coupon.delete');

    Route::get('/seller-subscription', 'Backend\SubscriptionController@sellerSubscription')->name('seller.subscription');
    Route::get('/seller-subscription/history/{id}', 'Backend\SubscriptionController@seller_subscription_history')->name('seller.subscription.history');
    Route::post('/seller-subscription/buy', 'Backend\SubscriptionController@sellerSubscriptionBuy')->name('seller.subscription.buy');
    Route::post('/status/{id?}', 'Backend\SubscriptionController@change_status')->name('seller.subscription.status');
    Route::post('/payment-status/{id?}', 'Backend\SubscriptionController@payment_status')->name('seller.subscription.payment.status');
    Route::post('/seller/delete/{id}','Backend\SubscriptionController@delete_seller_subscription')->name('seller.subscription.delete');
    Route::post('/seller/bulk-action', 'Backend\SubscriptionController@seller_bulk_action')->name('seller.subscription.bulk.action');
    Route::get('/send-email/{id?}', 'Backend\SubscriptionController@send_email')->name('seller.subscription.email');
});


// frontend routes

//show seller subscription
Route::group(['prefix'=>'seller','as'=>'seller.','middleware'=>['auth','inactiveuser','BuyerCheck','userEmailVerify','setlang','globalVariable']],function() {
    Route::get('/subscription', 'Frontend\SellerSubsController@subscriptions')->name('subscription.all');
    Route::post('/subscription/renew', 'Frontend\SellerSubsController@sub_renew')->name('subscription.renew');
});

Route::group(['prefix' => 'subscription','as'=>'seller.', 'middleware' => 'globalVariable'], function () {
    Route::post('/apply-coupon','Frontend\BuySubscriptionController@apply_coupon')->name('subscription.coupon.apply');
    Route::post('/buy-now','Frontend\BuySubscriptionController@buy_subscription')->name('subscription.buy');
    Route::get('/subscription-success/{id}','Frontend\BuySubscriptionController@subscription_payment_success')->name('subscription.payment.success');
    Route::get('/subscription-cancel/{id}','Frontend\BuySubscriptionController@subscription_payment_cancel')->name('subscription.payment.cancel');
    Route::get('/subscription-cancel-static','Frontend\BuySubscriptionController@subscription_payment_cancel_static')->name('subscription.payment.cancel.static');
});


Route::group(['prefix' => 'subscription'],function (){
    //subscription payment routes
    Route::get('/paypal-ipn','Frontend\SellerPaymentController@paypal_ipn_for_subs')->name('seller.paypal.ipn.subs');
    Route::post('/paytm-ipn','Frontend\SellerPaymentController@paytm_ipn_for_subs')->name('seller.paytm.ipn.subs');
    Route::get('/paystack-ipn','Frontend\SellerPaymentController@paystack_ipn_for_subs')->name('seller.paystack.ipn.subs');
    Route::get('/mollie/ipn','Frontend\SellerPaymentController@mollie_ipn_for_subs')->name('seller.mollie.ipn.subs');
    Route::get('/stripe/ipn','Frontend\SellerPaymentController@stripe_ipn_for_subs')->name('seller.stripe.ipn.subs');
    Route::post('/razorpay-ipn','Frontend\SellerPaymentController@razorpay_ipn_for_subs')->name('seller.razorpay.ipn.subs');
    Route::get('/flutterwave/ipn','Frontend\SellerPaymentController@flutterwave_ipn_for_subs')->name('seller.flutterwave.ipn.subs');
    Route::get('/midtrans-ipn','Frontend\SellerPaymentController@midtrans_ipn_for_subs')->name('seller.midtrans.ipn.subs');
    Route::post('/payfast-ipn','Frontend\SellerPaymentController@payfast_ipn_for_subs')->name('seller.payfast.ipn.subs');
    Route::post('/cashfree-ipn','Frontend\SellerPaymentController@cashfree_ipn_for_subs')->name('seller.cashfree.ipn.subs');
    Route::get('/instamojo-ipn','Frontend\SellerPaymentController@instamojo_ipn_for_subs')->name('seller.instamojo.ipn.subs');
    Route::get('/marcadopago-ipn','Frontend\SellerPaymentController@marcadopago_ipn_for_subs')->name('seller.marcadopago.ipn.subs');
    Route::get('/squareup-ipn','Frontend\SellerPaymentController@squareup_ipn_for_subs' )->name('seller.squareup.ipn.subs');
    Route::post('/cinetpay-ipn', 'Frontend\SellerPaymentController@cinetpay_ipn_for_subs' )->name('seller.cinetpay.ipn.subs');
    Route::post('/paytabs-ipn','Frontend\SellerPaymentController@paytabs_ipn_for_subs' )->name('seller.paytabs.ipn.subs');
    Route::post('/billplz-ipn','Frontend\SellerPaymentController@billplz_ipn_for_subs' )->name('seller.billplz.ipn.subs');
    Route::post('/zitopay-ipn','Frontend\SellerPaymentController@zitopay_ipn_for_subs' )->name('seller.zitopay.ipn.subs');
});