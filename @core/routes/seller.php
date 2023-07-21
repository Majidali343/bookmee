<?php 
use Illuminate\Support\Facades\Route;

 
Route::group(['prefix'=>'seller','middleware'=>['auth','inactiveuser','BuyerCheck','userEmailVerify','setlang','globalVariable']],function(){
    
    Route::get('/dashboard','Frontend\SellerController@sellerDashboard')->name('seller.dashboard');
    Route::get('/profile','Frontend\SellerController@sellerProfile')->name('seller.profile');
    Route::match(['get','post'],'/profile-edit','Frontend\SellerController@sellerProfileEdit')->name('seller.profile.edit');
    Route::match(['get','post'],'/account-settings','Frontend\SellerController@sellerAccountSetting')->name('seller.account.settings');
    Route::post('/account-deactive','Frontend\SellerController@accountDeactive')->name('seller.account.deactive');
    Route::get('/account-deactive/cancel/{id}','Frontend\SellerController@accountDeactiveCancel')->name('seller.account.deactive.cancel');
    Route::post('account/delete','Frontend\SellerController@accountDelete')->name('seller.account.delete');
    Route::get('/logout','Frontend\SellerController@sellerLogout')->name('seller.logout');

    //service coupons
    Route::get('/coupons','Frontend\SellerController@serviceCoupon')->name('seller.service.coupon');
    Route::post('/coupons/add-coupon','Frontend\SellerController@addServiceCoupon')->name('seller.service.coupon.add');
    Route::post('/coupons/update-coupon','Frontend\SellerController@updateServiceCoupon')->name('seller.service.coupon.update');
    Route::post('/coupons/services/add', 'ServiceController@add_services_coupon')->name('coupon.add.services.add');
    Route::post('/coupons/change-status/{id}','Frontend\SellerController@changeCouponStatus')->name('seller.service.coupon.status');
    Route::post('/coupons/delete/{id}','Frontend\SellerController@couponDelete')->name('seller.service.coupon.delete');


    Route::get('/services','Frontend\SellerController@sellerServices')->name('seller.services');
    Route::post('/get-dependent-subcategory','Frontend\SellerController@getSubcategory')->name('seller.subcategory');

    /// timings and shedulings work is here
    Route::get('/shedules','Frontend\TimingsController@GetTimings')->name('seller.timings');
    Route::post('/Addtimings','Frontend\TimingsController@AddTimings')->name('addtimings');
    Route::post('/timedelete/{id}','Frontend\TimingsController@TimeDelete')->name('timedelete');
    Route::post('/timeedit','Frontend\TimingsController@Timeedit')->name('timeedit');


    // get child category for service add
    Route::post('/get-child-category-by-subcategory', 'Frontend\SellerController@getChildCategory')->name('seller.subcategory.child.category');
    Route::match(['get','post'],'/add-services','Frontend\SellerController@addServices')->name('seller.add.services');

    Route::get('/service-attributes','Frontend\SellerController@serviceAttributes')->name('seller.services.attributes');
    Route::post('/add-service-attributes','Frontend\SellerController@addServiceAttributes')->name('seller.services.attributes.add');
    Route::match(['get','post'],'/add-service-attributes-by-id/{id?}','Frontend\SellerController@addServiceAttributesById')->name('seller.services.attributes.add.byid');
    Route::post('/service-on-of','Frontend\SellerController@ServiceOnOf')->name('seller.services.on.of');
    Route::get('/show-service-attributes-by-id/{id?}','Frontend\SellerController@showServiceAttributesById')->name('seller.services.attributes.show.byid');
    Route::post('/delete-include-service/{id?}','Frontend\SellerController@deleteIncludeService')->name('seller.services.includeservice.delete');
    Route::post('/delete-additional-service/{id?}','Frontend\SellerController@deleteAdditionalService')->name('seller.services.additionalservice.delete');
    Route::post('/delete-service-benifit/{id?}','Frontend\SellerController@deleteBenifit')->name('seller.services.benifit.delete');
    Route::post('/delete-service-faq/{id?}','Frontend\SellerController@deleteFaq')->name('seller.services.faq.delete');
    Route::post('/service-delete/{id}','Frontend\SellerController@ServiceDelete')->name('seller.services.delete');

    Route::match(['get','post'],'/edit-services/{id?}','Frontend\SellerController@editServices')->name('seller.edit.services');
    Route::match(['get','post'],'/edit-service-attributes/{id?}','Frontend\SellerController@editServiceAttribute')->name('seller.edit.service.attribute');
    Route::match(['get','post'],'/edit-service-attributes-offline-to-online/{id?}','Frontend\SellerController@editServiceAttributeOfflineToOnline')->name('seller.edit.service.attribute.offline.to.online');

    //day
    Route::get('/days','Frontend\SellerController@days')->name('seller.days');
    Route::post('/add-day','Frontend\SellerController@addDay')->name('seller.add.day');
    Route::post('/day-delete/{id}','Frontend\SellerController@dayDelete')->name('seller.day.delete');
    Route::post('/update-total-day','Frontend\SellerController@updateTotalDay')->name('seller.update.totalday');

    //schedules
    Route::get('/schedules','Frontend\SellerController@schedules')->name('seller.schedules');
    Route::post('/add-schedule','Frontend\SellerController@addSchedule')->name('seller.add.schedule');
    Route::post('/edit-schedule','Frontend\SellerController@editSchedule')->name('seller.edit.schedule');
    Route::post('/schedules-delete/{id}','Frontend\SellerController@scheduleDelete')->name('seller.schedule.delete');
    Route::post('/allow/multiple/schedule/','Frontend\SellerController@allow')->name('seller.allow.multiple.schedule');

    //Services all order list
    Route::get('/orders','Frontend\SellerController@sellerOrders')->name('seller.orders');

    // job all order list
    Route::get('/job-orders','Frontend\SellerController@sellerJobOrders')->name('seller.job.orders');

    Route::get('/orders-details/{id}','Frontend\SellerController@orderDetails')->name('seller.order.details');
    Route::post('/order-status-change','Frontend\SellerController@orderStatus')->name('seller.order.status');
    Route::post('/order-payment-status-change','Frontend\SellerController@orderPaymentStatus')->name('seller.order.payment.status');

    // service orders
    Route::get('orders/active-orders','Frontend\SellerController@activeOrders')->name('seller.active.orders');
    Route::get('orders/complete-orders','Frontend\SellerController@completeOrders')->name('seller.complete.orders');
    Route::get('orders/deliver-orders','Frontend\SellerController@deliverOrders')->name('seller.deliver.orders');
    Route::get('orders/cancel-orders','Frontend\SellerController@cancelOrders')->name('seller.cancel.orders');
    Route::post('service/group/add','Frontend\SellerController@groupAdd')->name('seller.service.group.add');


    //job orders
    Route::get('orders/job/active-orders','Frontend\SellerController@activeJobOrders')->name('seller.job.active.orders');
    Route::get('orders/job/complete-orders','Frontend\SellerController@completeJobOrders')->name('seller.job.complete.orders');
    Route::get('orders/job/deliver-orders','Frontend\SellerController@deliverJobOrders')->name('seller.job.deliver.orders');
    Route::get('orders/job/cancel-orders','Frontend\SellerController@cancelJobOrders')->name('seller.job.cancel.orders');


    Route::get('pending-orders','Frontend\SellerController@pendingOrders')->name('seller.pending.orders');
    Route::post('/order-delete/{id}','Frontend\SellerController@orderDelete')->name('seller.order.delete');

    Route::post('order/report-us','Frontend\SellerController@reportUs')->name('seller.order.report');
    Route::get('order/report/list','Frontend\SellerController@reportList')->name('seller.order.report.list');
    Route::match(['get','post'],'/report/chat/to/admin/{report_id?}','Frontend\SellerController@chat_to_admin')->name('seller.order.report.chat.admin');

    Route::get('/decline-order-history/{id}','Frontend\SellerController@orderRequestDeclineHistory')->name('seller.order.request.decline.history');
    Route::post('cancel/order/if-cash-on-delivery/payment-pending/{id}','Frontend\SellerController@orderCancel')->name('seller.order.cancel.cod.payment.pending');


    /* extra order request */
    Route::post('order/extra-service','Frontend\SellerController@extraService')->name('seller.order.extra.service');
    Route::post('order/extra-service/delete','Frontend\SellerController@extraServiceDelete')->name('seller.order.extra.service.delete');

    //notifications 
    Route::get('notification/all-notifications','Frontend\SellerController@allNotification')->name('seller.notification.all');

    //payout request 
    Route::get('payout-request','Frontend\SellerController@payoutRequest')->name('seller.payout');
    Route::post('create-payout-request','Frontend\SellerController@createPayoutRequest')->name('seller.create.payout.request');
    Route::get('payout-request-details/{id?}','Frontend\SellerController@PayoutRequestDetails')->name('seller.payout.request.details');

    Route::get('payout-invoice-details/{id?}','Frontend\InvoiceController@PayoutInvoice')->name('seller.payout.invoice.details');
    Route::get('order-invoice-details/{id?}','Frontend\InvoiceController@orderInvoiceSeller')->name('seller.order.invoice.details');

    //reviews
    Route::get('service-reviews','Frontend\SellerController@serviceReview')->name('seller.service.review');
    Route::get('service-all-reviews/{id}','Frontend\SellerController@serviceReviewAll')->name('service.review.all');
    Route::post('review-delete/{id}','Frontend\SellerController@reviewDelete')->name('service.review.delete');

    // seller to buyer review
    Route::post('review/seller-to-buyer', 'Frontend\SellerController@sellerToBuyerReview')->name('seller.to.buyer.review');

    //tickets
    Route::get('all-tickets','Frontend\SellerController@allTickets')->name('seller.support.ticket');
    Route::match(['get','post'],'add-new-ticket/{id?}','Frontend\SellerController@addNewTicket')->name('seller.support.ticket.new');
    Route::post('support-ticket-delete/{id}','Frontend\SellerController@ticketDelete')->name('seller.support.ticket.delete');
    Route::post('support-ticket/priority-change/','Frontend\SellerController@priorityChange')->name('seller.support.ticket.priority.change');
    Route::get('support-ticket/status-change/{id?}','Frontend\SellerController@statusChange')->name('seller.support.ticket.status.change');
    Route::get('ticket-view/{id?}','Frontend\SellerController@view_ticket')->name('seller.support.ticket.view');
    Route::post('support-ticket/message-send', 'Frontend\SellerController@support_ticket_message')->name('seller.support.ticket.message.send');

    //service coupons
     Route::get('/to-do-list','Frontend\SellerController@toDoList')->name('seller.todolist');
     Route::post('/to-do-list/add','Frontend\SellerController@addTodolist')->name('seller.todolist.add');
     Route::post('/to-do-list/update','Frontend\SellerController@updateTodolist')->name('seller.todolist.update');
     Route::post('/to-do-list/delete/{id}','Frontend\SellerController@deleteTodolist')->name('seller.todolist.delete');
     Route::post('/to-do-list/status-change/{id?}','Frontend\SellerController@changeTodoStatus')->name('seller.todolist.status');

    //seller profile verify 
    Route::match(['get','post'],'/seller-profile-verify','Frontend\SellerController@sellerVerify')->name('seller.profile.verify');
    Route::match(['get','post'],'/account-settings','Frontend\SellerController@sellerAccountSetting')->name('seller.account.settings');


    //Staff 
    Route::get('/staff','StaffController@index')->name('seller.staff');
    Route::post('/staff','StaffController@addStaff')->name('seller.staff.add');
    Route::post('/staff/edit','StaffController@updateStaff')->name('seller.staff.edit');
    Route::post('/staff/delete/{id}','StaffController@deleteStaff')->name('seller.staff.delete');


});