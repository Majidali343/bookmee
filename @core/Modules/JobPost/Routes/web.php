<?php


// backend routes

Route::group(['prefix' => 'admin-home/jobs','as'=>'admin.', 'middleware' => ['globalVariable','setlang']], function () {
    Route::get( '/all', 'Backend\JobsController@jobs')->name('jobs.all');
    Route::post( '/status/{id}', 'Backend\JobsController@change_status')->name('jobs.status');
    Route::post( '/delete/{id}', 'Backend\JobsController@delete')->name('jobs.delete');
    Route::get( '/request/all/{id}', 'Backend\JobsController@all_request')->name('jobs.request.all');
    Route::get( '/request/conversation/details/{id}', 'Backend\JobsController@conversation_details')->name('jobs.request.conversation.details');
});

// frontend routes
Route::group(['prefix'=>'buyer/jobpost','middleware'=>['auth','inactiveuser','UserRoleCheck','userEmailVerify','setlang']],function() {
    Route::get('/all-jobs', 'Frontend\JobPostController@all_jobs')->name('buyer.all.jobs');
    Route::match(['get','post'],'/add-job', 'Frontend\JobPostController@add_job')->name('buyer.add.job');
    Route::match(['get','post'],'/edit-job/{id}', 'Frontend\JobPostController@edit_job')->name('buyer.edit.job');
    Route::post('subcategory/get', 'Frontend\JobPostController@sub_category')->name('buyer.subcategory');
    Route::post('child-category/get', 'Frontend\JobPostController@child_category')->name('buyer.child_category');
    Route::post('city/get', 'Frontend\JobPostController@city')->name('buyer.city');
    Route::post('/job-on-of', 'Frontend\JobPostController@job_on_off')->name('buyer.job.on.off');
    Route::post('/delete/{id}', 'Frontend\JobPostController@job_delete')->name('buyer.job.delete');
});

// seller job
Route::group(['prefix'=>'buyer/job','middleware'=>['auth','inactiveuser','UserRoleCheck','userEmailVerify','setlang','globalVariable']],function() {
    Route::get('/request/all', 'Frontend\JobRequestController@all_jobs')->name('buyer.all.jobs.request');
    Route::post('request/delete/{id}','Frontend\JobRequestController@request_delete')->name('buyer.job.request.delete');
    Route::get('request/conversation/{id}','Frontend\JobRequestController@conversation')->name('buyer.job.request.conversation');
    Route::post('request/message-send', 'Frontend\JobRequestController@send_message')->name('buyer.job.request.message.send');
    Route::post('request/seller-hire/{id?}', 'Frontend\JobRequestController@hire_seller')->name('buyer.job.request.seller.hired');
    Route::get('order/order-cancel-static','Frontend\JobRequestController@job_order_payment_cancel_static')->name('job.order.payment.cancel.static');
});

// seller job
Route::group(['prefix'=>'seller/job','middleware'=>['auth','inactiveuser','BuyerCheck','userEmailVerify','setlang','globalVariable']],function(){
    Route::get('notification/new/jobs','Frontend\JobRequestController@new_jobs')->name('seller.new.jobs');
    Route::get('/request/all', 'Frontend\JobRequestController@seller_all_jobs')->name('seller.all.jobs.request');
    Route::post('/job-request/edit', 'Frontend\JobRequestController@sellerJobRequestEdit')->name('seller.job.offer.price.edit');
    Route::get('request/conversation/{id}','Frontend\JobRequestController@seller_conversation')->name('seller.job.request.conversation');
    Route::post('request/message-send', 'Frontend\JobRequestController@seller_send_message')->name('seller.job.request.message.send');
});

Route::group(['prefix' => 'jobs/details','middleware' => ['globalVariable','setlang']], function () {
    Route::get('/{slug}', 'Frontend\JobDetailsApplyController@job_details')->name('job.post.details');
    Route::post('apply/job/post', 'Frontend\JobDetailsApplyController@job_apply')->name('job.post.apply');
    Route::get('category/{slug}', 'Frontend\JobDetailsApplyController@category_jobs')->name('job.post.category.jobs');
});


Route::group(['prefix' => 'jobpost' ,'middleware' => 'setlang'],function (){
    //jobpost payment routes
    Route::get('/paypal-ipn','Frontend\BuyerPaymentController@paypal_ipn_for_jobs')->name('buyer.paypal.ipn.jobs');
    Route::post('/paytm-ipn','Frontend\BuyerPaymentController@paytm_ipn_for_jobs')->name('buyer.paytm.ipn.jobs');
    Route::get('/paystack-ipn','Frontend\BuyerPaymentController@paystack_ipn_for_jobs')->name('buyer.paystack.ipn.jobs');
    Route::get('/mollie/ipn','Frontend\BuyerPaymentController@mollie_ipn_for_jobs')->name('buyer.mollie.ipn.jobs');
    Route::get('/stripe/ipn','Frontend\BuyerPaymentController@stripe_ipn_for_jobs')->name('buyer.stripe.ipn.jobs');
    Route::post('/razorpay-ipn','Frontend\BuyerPaymentController@razorpay_ipn_for_jobs')->name('buyer.razorpay.ipn.jobs');
    Route::get('/flutterwave/ipn','Frontend\BuyerPaymentController@flutterwave_ipn_for_jobs')->name('buyer.flutterwave.ipn.jobs');
    Route::get('/midtrans-ipn','Frontend\BuyerPaymentController@midtrans_ipn_for_jobs')->name('buyer.midtrans.ipn.jobs');
    Route::post('/payfast-ipn','Frontend\BuyerPaymentController@payfast_ipn_for_jobs')->name('buyer.payfast.ipn.jobs');
    Route::post('/cashfree-ipn','Frontend\BuyerPaymentController@cashfree_ipn_for_jobs')->name('buyer.cashfree.ipn.jobs');
    Route::get('/instamojo-ipn','Frontend\BuyerPaymentController@instamojo_ipn_for_jobs')->name('buyer.instamojo.ipn.jobs');
    Route::get('/marcadopago-ipn','Frontend\BuyerPaymentController@marcadopago_ipn_for_jobs')->name('buyer.marcadopago.ipn.jobs');
    Route::get('/squareup-ipn','Frontend\BuyerPaymentController@squareup_ipn_for_jobs' )->name('buyer.squareup.ipn.jobs');
    Route::post('/cinetpay-ipn', 'Frontend\BuyerPaymentController@cinetpay_ipn_for_jobs' )->name('buyer.cinetpay.ipn.jobs');
    Route::post('/paytabs-ipn','Frontend\BuyerPaymentController@paytabs_ipn_for_jobs' )->name('buyer.paytabs.ipn.jobs');
    Route::post('/billplz-ipn','Frontend\BuyerPaymentController@billplz_ipn_for_jobs' )->name('buyer.billplz.ipn.jobs');
    Route::post('/zitopay-ipn','Frontend\BuyerPaymentController@zitopay_ipn_for_jobs' )->name('buyer.zitopay.ipn.jobs');
});
