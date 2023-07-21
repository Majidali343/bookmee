<?php


use App\Http\Controllers\Api\BuyerJobController;
use App\Http\Controllers\Api\JobDetailsController;
use App\Http\Controllers\Api\SellerJobController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\MiscellaneousController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\PaymentGatewayController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\BuyerChatController;
use App\Http\Controllers\Api\SellerChatController;
use App\Http\Controllers\Api\SellerSubscriptionController;
use App\Http\Controllers\Api\OrderReportController;
use App\Http\Controllers\Api\SellerServiceController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1', 'middleware' => 'setlang'],function(){
    
    //todo: amount settings
    Route::get('/amount-settings',[MiscellaneousController::class,'amountSettings']);
    
    //todo: currency
    Route::get('/currency',[MiscellaneousController::class,'currencyInfo']);
    Route::get('/module-permission',[MiscellaneousController::class,'modulePermission']);
    
    //todo: languages
    Route::get('/language',[LanguageController::class,'languageInfo']);
    Route::post('/translate-string',[LanguageController::class,'translateString']);
    Route::get('/mollie-ipn',[PaymentController::class,'mollieIpn'])->name('mollie.api.ipn')->middleware(['api']);
    Route::post('/mollie-charge-customer',[PaymentController::class,'mollieChargeCustomer'])->middleware(['auth:sanctum','api']);
    
    Route::get('/country',[UserController::class,'country']);
    Route::get('country/service-city/{id}',[UserController::class,'serviceCity']);
    Route::get('country/service-city/service-area/{country_id}/{city_id}',[UserController::class,'serviceArea']);
    
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('social/login',[UserController::class,'socialLogin']);
    Route::post('/send-otp-in-mail',[UserController::class,'sendOTP']);
    Route::post('/reset-password',[UserController::class,'resetPassword']);
   
    /*--------------------------
        Buyer Api Routes
    --------------------------*/
    Route::group(['prefix' => 'user/','middleware' => 'auth:sanctum'],function (){

       /* Report api route start */
        Route::group(['prefix' => 'report'],function(){
            Route::post('create',[OrderReportController::class,'create']);
            Route::get('details/{id}',[OrderReportController::class,'details']);
            Route::post('send-message',[OrderReportController::class,'sendMessage']);
            Route::post('list',[OrderReportController::class,'list']);
        });
        /* Report api route end */

        if(moduleExists("Wallet")) {
            Route::group(['prefix' => 'wallet'], function () {
                Route::get('/balance', [UserController::class, 'walletBalance']);
                Route::get('/history', [UserController::class, 'walletHistory']);
                Route::post('/deposit', [UserController::class, 'walletDeposit']);
                Route::post('/deduct', [UserController::class, 'walletDeduct']);
                Route::post('/deposit/payment-status', [UserController::class, 'walletDepositPaymentStatus']);
                //todo:: seller subscription renew

            });
        }


        Route::post('logout',[UserController::class,'logout']);
        Route::get('profile',[UserController::class,'profile']);
        Route::post('change-password',[UserController::class,'changePassword']);
        Route::post('update-profile',[UserController::class,'updateProfile']);
        Route::post('/add-service-rating/{id}',[ServiceController::class,'serviceRating']);
        Route::post('/my-orders',[UserController::class,'myOrders']);
         
        Route::post('/my-orders/{id}',[UserController::class,'singleOrder']);
        Route::post('/order/request/status/complete/approve',[UserController::class,'orderCompleteRequestApprove']);
        Route::post('/order/request/status/complete/decline',[UserController::class,'orderCompleteRequestDecline']);
        Route::get('/order/request/complete/decline/history',[UserController::class,'orderCompleteRequestDeclineHistory']);

        /* extra order request */
        Route::group(['prefix' => 'order'],function(){
            Route::get('extra-service/list/{id}',[UserController::class,'extraServiceList']);
            Route::post('extra-service/accept',[UserController::class,'extraServiceAccept']);
            Route::post('extra-service/decline',[UserController::class,'extraServiceDelete']);
        });



        //new added in sanctom - by sharifur
        Route::post('/support-tickets',[UserController::class,'allTickets']);
        Route::get('/view-ticket/{id}',[UserController::class,'viewTickets']);
        Route::post('ticket/message-send',[UserController::class,'sendMessage']);
        Route::post('/send-otp-in-mail/success',[UserController::class,'sendOTPSuccess']);
        Route::post('ticket/create',[UserController::class,'createTicket']);
        Route::post('payment-status-update',[ServiceController::class,'paymentStatusUpdate']);
        
        //payment gateway list
        Route::post('payment-gateway-list',[PaymentGatewayController::class,'gatewayList']);

        //buyer chat
        if(moduleExists("LiveChat")) {
            Route::group(['prefix' => 'chat'], function () {
                Route::get('/seller-lists', [BuyerChatController::class, 'liveChat'])->name('buyer.live.chat');
                Route::get('/all-messages', [BuyerChatController::class, 'allMessages']);
                Route::post('/send', [BuyerChatController::class, 'postSendMessage']);
                Route::get('pusher/credentials', [BuyerChatController::class, 'getPusherCredentials']);
            });
        }


        //buyer jobs
        if(moduleExists("JobPost")) {
            Route::group(['prefix' => 'job'], function () {
                Route::get('/job-lists', [BuyerJobController::class, 'job_list']);
                Route::post('/on-off', [BuyerJobController::class, 'job_on_off']);
                Route::post('/add-job', [BuyerJobController::class, 'add_job']);
                Route::post('/edit-job/{id}', [BuyerJobController::class, 'edit_job']);
                Route::post('/delete-job/{id}', [BuyerJobController::class, 'delete_job']);

                Route::get('request/request-lists', [BuyerJobController::class, 'request_list']);
                Route::get('request/conversation', [BuyerJobController::class, 'conversation']);
                Route::post('request/conversation/send', [BuyerJobController::class, 'send_message']);
                 Route::post('request/seller-hire/{id?}', [BuyerJobController::class,'hire_seller']);
                
                /* job hire */
                Route::post('/payment-complete', [BuyerJobController::class, 'job_payment_complete']);
                Route::post('/hire', [BuyerJobController::class, 'job_hire']);
                
            });
        }

    });

    Route::get('/slider',[SliderController::class,'slider']);
    Route::get('/category',[CategoryController::class,'category']);
    Route::get('/category/sub-category/{category_id}',[CategoryController::class,'subCategory']);

    Route::get('/top-services',[ServiceController::class,'topService']);
    Route::get('/latest-services',[ServiceController::class,'latestService']);
    Route::get('/service-details/{id}',[ServiceController::class,'serviceDetails']);
    
    Route::get('/service-list/all-services',[ServiceController::class,'allServices']);
    Route::get('/service-list/search-by-category/{category_id}',[ServiceController::class,'searchByCategory']);
    Route::get('/service-list/category-subcategory-search/{category_id}/{subcategory_id}',[ServiceController::class,'searchBySubCategory']);
    Route::get('/service-list/category-subcategory-rating-search/{category_id?}/{subcategory_id?}/{rating?}',[ServiceController::class,'searchByRating']);
    Route::get('/service-list/category-subcategory-rating-sort-by-search/{category_id?}/{subcategory_id?}/{rating?}/{sort_by?}',[ServiceController::class,'searchBySort']);
    Route::get('service-list/service-book/{id?}',[ServiceController::class,'serviceBook']);
    Route::get('service-list/service-schedule/{day?}/{seller_id?}',[ServiceController::class,'scheduleByDay']);
    Route::post('service-list/coupon-apply',[ServiceController::class,'couponApply']);

    Route::get('city/service-city',[ServiceController::class,'serviceCity']);
    Route::post('home/home-search', [ServiceController::class,'homeSearch']);

    //jobs and apply
    if(moduleExists("JobPost")) {
        Route::get('job/all', [JobDetailsController::class, 'jobs_all']);
        Route::get('job/details/{id}', [JobDetailsController::class, 'job_details']);
        Route::post('job/apply/new-job', [SellerJobController::class, 'job_apply']);
        Route::get('job/recent-jobs', [JobDetailsController::class, 'recent_jobs']);
    }

    //verify 
    Route::group(['middleware' => 'auth:sanctum'],function (){
        Route::post('service/order', [ServiceController::class,'order']);
        Route::post('image/upload', [ServiceController::class,'imageUpload']);
        Route::post('payment-image/manual-payment', [ServiceController::class,'manualPaymentImage']);
        
    });
    
    /*--------------------------
        Seller Api Routes
    --------------------------*/
    Route::group(['prefix' => 'seller','middleware' => 'auth:sanctum'],function (){
        Route::post('dashboard-info', [SellerController::class,'dashboardInfo']);
        Route::post('chart-data', [SellerController::class,'chartData']);
        Route::post('recent-orders', [SellerController::class,'recentOrders']);


        if(moduleExists("Wallet")) {
            Route::group(['prefix' => 'wallet'], function () {
                Route::post('/renew-subscription', [SellerController::class, 'renewSubscription']);
                Route::post('/diposit-from-balance', [SellerController::class, 'depositFromBalance']);
                //todo:: seller subscription renew

            });
        }

         //profile 
        Route::group(['prefix' => 'profile'],function(){
            Route::post('/',[SellerController::class,'profileInfo']);
            Route::post('/edit',[SellerController::class,'profileEdit']);
            Route::post('/verify',[SellerController::class,'profileVerify']);
            Route::post('/deactivate',[SellerController::class,'profileDeactivate']);
        }); 
        
        //Services
        Route::group(['prefix' => 'service'],function(){
            Route::get('/my-services',[SellerServiceController::class,'myService']);
            Route::get('/category-wise-sub-category/{id}',[SellerServiceController::class,'subCategoryByCategory']);
            Route::get('/subcategory-wise-child-category/{id}',[SellerServiceController::class,'childCategoryBySubcategory']);
            Route::post('/add-service',[SellerServiceController::class,'addService']);
            Route::post('/update-service',[SellerServiceController::class,'updateService']);
            Route::post('/add-service-attributes-by-id/{id}',[SellerServiceController::class,'addServiceAttributesByID']);
            Route::post('/update-service-attributes-by-id/{id}',[SellerServiceController::class,'updateServiceAttributesByID']);
            Route::post('/on-off/{id}',[SellerServiceController::class,'ServiceOnOff']);
            Route::get('/attributes/show/{id}',[SellerServiceController::class,'showAttributes']);
            Route::post('/delete/include-service/{id}',[SellerServiceController::class,'deleteIncludeService']);
            Route::post('/delete/additional-service/{id}',[SellerServiceController::class,'deleteAdditionalService']);
            Route::post('/delete/benefits/{id}',[SellerServiceController::class,'deleteBenefits']);
            Route::post('/delete/service-with-all-attributes/{id}',[SellerServiceController::class,'deleteService']);


        });
        
        //my orders
        Route::group(['prefix' => 'my-orders'],function(){
            Route::post('/',[SellerController::class,'myOrders']);
            Route::post('/{id}',[SellerController::class,'singleOrder']);
            Route::post('status/complete/request',[SellerController::class,'orderStatus']);
            Route::get('/order/request/complete/decline/history',[SellerController::class,'orderCompleteRequestDeclineHistory']);
            Route::post('/order/change-payment-status',[SellerController::class,'codPaymentStatusChange']);
            Route::post('/order/change-status',[SellerController::class,'OrderStatusChange']);
        });

        /* extra order request */
        Route::group(['prefix' => 'order'],function(){
            Route::post('order-decline',[SellerController::class,'orderDecline']);
            Route::post('extra-service/add',[SellerController::class,'extraService']);
            Route::post('extra-service/delete',[SellerController::class,'extraServiceDelete']);
            Route::get('extra-service/list/{id}',[SellerController::class,'extraServiceList']);
        });

        Route::post('/support-tickets',[SellerController::class,'allTickets']);
        Route::get('/view-ticket/{id}',[SellerController::class,'viewTickets']);
        Route::post('/ticket-status-change',[SellerController::class,'ticketStatusChange']);
        Route::post('ticket/message-send',[SellerController::class,'sendMessage']);
        
        
        //payment history
        Route::group(['prefix' => 'payment-history'],function(){
            Route::post('/',[SellerController::class,'paymentHistory']);
            Route::post('/create',[SellerController::class,'createPaymentRequest']);
            Route::post('/details/{id}',[SellerController::class,'paymentRequestDetails']);
        });

        //seller chat
        if(moduleExists("LiveChat")){
            Route::group(['prefix' => 'chat'], function () {
                Route::get('buyer-lists', [SellerChatController::class, 'liveChat'])->name('seller.live.chat');
                Route::get('/all-messages', [SellerChatController::class, 'allMessages']);
                Route::post('/send', [SellerChatController::class, 'postSendMessage']);
                Route::get('/fetch-old-messages', [SellerChatController::class, 'getOldMessages'])->name('fetch.old.message');
            });
        }

        //seller jobs
        if(moduleExists("JobPost")) {
            Route::group(['prefix' => 'job'], function () {
                Route::get('/request/request-lists', [SellerJobController::class, 'request_list']);
                Route::get('/job-lists', [SellerJobController::class, 'new_jobs']);
                Route::get('/request/conversation/{id}', [SellerJobController::class, 'conversation']);
                Route::post('/request/conversation/send', [SellerJobController::class, 'send_message']);
            });
        }

        //seller subscription
        if(moduleExists("Subscription")){
            Route::group(['prefix' => 'subscription'], function () {
                Route::get('/info', [SellerSubscriptionController::class, 'subscription_info'])->name('seller.subscription.info');
                Route::get('/history', [SellerSubscriptionController::class, 'subscription_history'])->name('seller.subscription.history');
            });
        }
        
    });
  

});
