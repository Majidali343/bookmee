<?php 
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'buyer','middleware'=>['auth','inactiveuser','UserRoleCheck','userEmailVerify','setlang']],function(){

    Route::get('/dashboard', 'Frontend\BuyerController@buyerDashboard')->name('buyer.dashboard');
    Route::get('/profile','Frontend\BuyerController@buyerProfile')->name('buyer.profile');
    Route::match(['get','post'],'/profile-edit','Frontend\BuyerController@buyerProfileEdit')->name('buyer.profile.edit');
    Route::match(['get','post'],'/account-settings','Frontend\BuyerController@buyerAccountSetting')->name('buyer.account.settings');
    Route::get('/logout', 'Frontend\BuyerController@buyerLogout')->name('buyer.logout');

    // buyer deactivate and delete account
    Route::post('/account-deactive','Frontend\BuyerController@accountDeactive')->name('buyer.account.deactive');
    Route::get('/account-deactive/cancel/{id}','Frontend\BuyerController@accountDeactiveCancel')->name('buyer.account.deactive.cancel');
    Route::post('account/delete','Frontend\BuyerController@accountDelete')->name('buyer.account.delete');

     //all orders 
     Route::get('/orders','Frontend\BuyerController@buyerOrders')->name('buyer.orders');
     Route::get('/job-orders','Frontend\BuyerController@buyerJobOrders')->name('buyer.job.orders');
     Route::get('/orders-details/{id}','Frontend\BuyerController@orderDetails')->name('buyer.order.details');
     Route::post('/approve-order-complete-request/{id}','Frontend\BuyerController@orderCompleteRequestApprove')->name('buyer.order.complete.request.approve');
     Route::post('/decline-order-complete-request','Frontend\BuyerController@orderCompleteRequestDecline')->name('buyer.order.complete.request.decline');
     Route::get('/decline-order-history/{id}','Frontend\BuyerController@orderRequestDeclineHistory')->name('buyer.order.request.decline.history');
     Route::post('cancel/order/if-cash-on-delivery/payment-pending/{id}','Frontend\BuyerController@orderCancel')->name('buyer.order.cancel.cod.payment.pending');

     Route::get('order-invoice-details/{id?}','Frontend\InvoiceController@orderInvoiceBuyer')->name('buyer.order.invoice.details');
     Route::post('order/report-us','Frontend\BuyerController@reportUs')->name('buyer.order.report');
     Route::get('order/report/list','Frontend\BuyerController@reportList')->name('buyer.order.report.list');
     Route::match(['get','post'],'/report/chat/to/admin/{report_id?}','Frontend\BuyerController@chat_to_admin')->name('buyer.order.report.chat.admin');


    //extra services
     Route::post('order/extra-service/decline','Frontend\BuyerController@extraServiceDecline')->name('buyer.order.extra.service.decline');
     Route::post('order/extra-service/accept','Frontend\BuyerController@extraServiceAccept')->name('buyer.order.extra.service.accept');
     Route::get('order/extra-service/success/{id}','Frontend\BuyerController@extraServicePaymentSuccess')->name('buyer.order.extra.service.payment.success');
     Route::get('order/extra-service/cancel/{id}','Frontend\BuyerController@extraServiceCancel')->name('buyer.order.extra.service.payment.cancel');

     /* ------------------------------
        ipn routes for extra services
     --------------------------------*/
    Route::get('/paypal-ipn','Frontend\ExtraServicePaymentController@paypal_ipn')->name('buyer.order.extra.service.payment.paypal.ipn');
    Route::post('/paytm-ipn','Frontend\ExtraServicePaymentController@paytm_ipn')->name('buyer.order.extra.service.payment.paytm.ipn');
    Route::get('/paystack-ipn','Frontend\ExtraServicePaymentController@paystack_ipn')->name('buyer.order.extra.service.payment.paystack.ipn');
    Route::get('/mollie/ipn','Frontend\ExtraServicePaymentController@mollie_ipn')->name('buyer.order.extra.service.payment.mollie.ipn');
    Route::get('/stripe/ipn','Frontend\ExtraServicePaymentController@stripe_ipn')->name('buyer.order.extra.service.payment.stripe.ipn');
    Route::post('/razorpay-ipn','Frontend\ExtraServicePaymentController@razorpay_ipn')->name('buyer.order.extra.service.payment.razorpay.ipn');
    Route::get('/flutterwave-ipn','Frontend\ExtraServicePaymentController@flutterwave_ipn')->name('buyer.order.extra.service.payment.flutterwave.ipn');
    Route::get('/midtrans-ipn','Frontend\ExtraServicePaymentController@midtrans_ipn')->name('buyer.order.extra.service.payment.midtrans.ipn');
    Route::post('/payfast-ipn','Frontend\ExtraServicePaymentController@payfast_ipn')->name('buyer.order.extra.service.payment.payfast.ipn');
    Route::post('/cashfree-ipn','Frontend\ExtraServicePaymentController@cashfree_ipn')->name('buyer.order.extra.service.payment.cashfree.ipn');
    Route::get('/instamojo-ipn','Frontend\ExtraServicePaymentController@instamojo_ipn')->name('buyer.order.extra.service.payment.instamojo.ipn');
    Route::get('/marcadopago-ipn','Frontend\ExtraServicePaymentController@marcadopago_ipn')->name('buyer.order.extra.service.payment.marcadopago.ipn');
    Route::get('/squareup-ipn','Frontend\ExtraServicePaymentController@squareup_ipn' )->name('buyer.order.extra.service.payment.squareup.ipn');
    Route::post('/cinetpay-ipn', 'Frontend\ExtraServicePaymentController@cinetpay_ipn' )->name('buyer.order.extra.service.payment.cinetpay.ipn');
    Route::post('/paytabs-ipn','Frontend\ExtraServicePaymentController@paytabs_ipn' )->name('buyer.order.extra.service.payment.paytabs.ipn');
    Route::post('/billplz-ipn','Frontend\ExtraServicePaymentController@billplz_ipn' )->name('buyer.order.extra.service.payment.billplz.ipn');
    Route::post('/zitopay-ipn','Frontend\ExtraServicePaymentController@zitopay_ipn' )->name('buyer.order.extra.service.payment.zitopay.ipn');


     //tickets
    Route::get('all-tickets','Frontend\BuyerController@allTickets')->name('buyer.support.ticket');
    Route::match(['get','post'],'add-new-ticket/{id?}','Frontend\BuyerController@addNewTicket')->name('buyer.support.ticket.new');
    Route::post('support-ticket-delete/{id}','Frontend\BuyerController@ticketDelete')->name('buyer.support.ticket.delete');
    Route::post('support-ticket/priority-change/','Frontend\BuyerController@priorityChange')->name('buyer.support.ticket.priority.change');
    Route::post('support-ticket/status-change/{id?}','Frontend\BuyerController@statusChange')->name('buyer.support.ticket.status.change');
    Route::get('ticket-view/{id}','Frontend\BuyerController@view_ticket')->name('buyer.support.ticket.view');
    Route::post('support-ticket/message-send', 'Frontend\BuyerController@support_ticket_message')->name('buyer.support.ticket.message.send');

    Route::post('service-review-from-dashboard', 'Frontend\BuyerController@serviceReviewfromDashboard')->name('service.review.from.dashboard');

});