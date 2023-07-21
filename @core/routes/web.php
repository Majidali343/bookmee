<?php

use Illuminate\Support\Facades\Route;

// frontend starts
Route::group(['middleware' => ['globalVariable', 'maintains_mode', 'setlang']], function () {

    Route::get('/', 'FrontendController@index')->name('homepage');
    Route::post('/store-data', 'FrontendController@store')->name('storeData');
    Route::get('/home-search', 'FrontendController@home_search')->name('frontend.home.search');
    Route::get('/home-search-two', 'FrontendController@home_search_two')->name('frontend.home.search.two');
    Route::get('/home-search/single-page', 'FrontendController@home_search_single_page')->name('frontend.home.search.single');

    //blog routes
    $blog_page_slug = getSlugFromReadingSetting('blog_page') ?? 'blog';
    Route::group(['prefix' => $blog_page_slug, 'namespace' => 'Frontend'], function () {
        Route::get('/{slug}', 'BlogController@blog_single')->name('frontend.blog.single');
        Route::post('/post-blog-comment', 'BlogController@blog_comment')->name('frontend.blog.comment');
        Route::post('/sign-in-for-blog-comment', 'BlogController@signin_for_blog_comment')->name('frontend.blog.comment.signin');
        Route::get('/category/{slug?}', 'BlogController@category_wise_blog_page')->name('frontend.blog.category');
        Route::get('/tags/{tag_name?}', 'BlogController@tags_wise_blog_page')->name('frontend.blog.tags');
    });

    //user login register forget password
    Route::match (['get', 'post'], '/register', 'Auth\RegisterController@userRegister')->name('user.register');
    Route::match (['get', 'post'], '/email-verify', 'Auth\RegisterController@emailVerify')->name('email.verify')->middleware('auth:web');
    Route::get('/resend-verify-code-again', 'Auth\RegisterController@resendCode')->name('resend.verify.code')->middleware('auth:web');
    Route::post('/userotpcode', 'Auth\RegisterController@sendOptOnRegister')->name('user.otp.code');
    Route::post('/register/otp/verify', 'Auth\RegisterController@verifyOptOnRegister')->name('user.otp.register.verify.code');

    Route::post('/get-city-by-country', 'FrontendController@getCity')->name('user.country.city');
    Route::post('/get-area-by-city', 'FrontendController@getAarea')->name('user.city.area');

    Route::match (['get', 'post'], '/login', 'Auth\LoginController@sendOtp')->name('user.login');
    Route::post('/login-for-online', 'Auth\LoginController@userLoginOnline')->name('user.login.online');
    Route::match (['get', 'post'], 'user/forget-password', 'Auth\LoginController@userForgetPassword')->name('user.forget.password');
    Route::match (['get', 'post'], '/login/otp/send', 'Auth\LoginController@sendOtp')->name('user.send.login.otp');
    Route::match (['get', 'post'], '/login/otp/verify', 'Auth\LoginController@userLogin')->name('user.verify.login.otp');

    //social login
    Route::group(['prefix' => 'facebook'], function () {
        Route::get('callback', 'Frontend\SocialLoginController@facebook_callback')->name('facebook.callback');
        Route::get('redirect', 'Frontend\SocialLoginController@facebook_redirect')->name('login.facebook.redirect');
    });
    Route::group(['prefix' => 'google'], function () {
        Route::get('callback', 'Frontend\SocialLoginController@google_callback')->name('google.callback');
        Route::get('redirect', 'Frontend\SocialLoginController@google_redirect')->name('login.google.redirect');
    });

    Route::group(['prefix' => 'service-list'], function () {
        Route::get('/{slug}', 'Frontend\ServiceListController@serviceDetails')->name('service.list.details');
        Route::post('/loadmore/subscateogry', 'Frontend\ServiceListController@loadMoreSubCategories')->name('service.list.load.more.subcategories');
        Route::post('/loadmore/child-cateogry', 'Frontend\ServiceListController@loadMoreChildCategories')->name('service.list.load.more.child.categories');

        Route::get('book-now/{slug}', 'Frontend\ServiceListController@serviceBook')->name('service.list.book');

        Route::post('book-now/get-city-by-country', 'Frontend\ServiceListController@serviceBookGetCity')->name('service.list.book.city');
        Route::post('book-now/get-area-by-city', 'Frontend\ServiceListController@serviceBookGetArea')->name('service.list.book.area');

        Route::post('book-now/get-schedules-by-day', 'Frontend\ServiceListController@scheduleByDay')->name('service.schedule.by.day');
        Route::post('book-now/create-order', 'Frontend\ServiceListController@createOrder')->name('service.create.order');

        Route::get('book-now/coupon/coupon-apply', 'Frontend\ServiceListController@couponApply')->name('service.coupon.apply');

        Route::post('service-review-add', 'Frontend\ServiceListController@serviceReviewAdd')->name('service.review.add');
        Route::get('seller/all-services/{seller_id?}', 'Frontend\ServiceListController@sellerAllServices')->name('seller.service.all');

        //all service search
        Route::get('all-services/search-by-category', 'Frontend\ServiceListController@allSearchByCategory')->name('all.service.search.category');
        Route::get('all-services/search-by-subcategory', 'Frontend\ServiceListController@allSearchBySubcategory')->name('all.service.search.subcategory');
        Route::get('all-services/search-by-rating', 'Frontend\ServiceListController@allSearchByRating')->name('all.service.search.rating');
        Route::get('all-services/search-by-sorting', 'Frontend\ServiceListController@allSearchBySorting')->name('all.service.search.sorting');

        //seller service search
        Route::get('seller-all-services/search-by-category', 'Frontend\ServiceListController@searchByCategory')->name('service.search.category');
        Route::get('seller-all-services/search-by-subcategory', 'Frontend\ServiceListController@searchBySubcategory')->name('service.search.subcategory');
        Route::get('seller-all-services/search-by-rating', 'Frontend\ServiceListController@searchByRating')->name('service.search.rating');
        Route::get('seller-all-services/search-by-sorting', 'Frontend\ServiceListController@searchBySorting')->name('service.search.sorting');

        //all featured service
        Route::get('featured-service/all', 'Frontend\ServiceListController@allfeaturedService')->name('service.all.featured');
        //all popular service
        Route::get('popular-service/all', 'Frontend\ServiceListController@allPopularService')->name('service.all.popular');
        //category wise service
        Route::get('category/{slug?}', 'Frontend\ServiceListController@categoryServices')->name('service.list.category');
        //category wise service
        Route::get('sub-category/{slug?}', 'Frontend\ServiceListController@subCategoryServices')->name('service.list.subcategory');

        Route::get('child-category/{slug?}', 'Frontend\ServiceListController@childCategoryServices')->name('service.list.child.category');
    });

    //all category
    Route::get('category/all', 'Frontend\ServiceListController@allCategory')->name('all.category.subcategory');
    //all sellers
    Route::get('seller/all', 'Frontend\ServiceListController@allSellers')->name('all.sellers');

    //payment status route
    Route::get('/order-success/{id}', 'Frontend\ServiceListController@order_payment_success')->name('frontend.order.payment.success');
    Route::get('/order-cancel/{id}', 'FrontendController@order_payment_cancel')->name('frontend.order.payment.cancel');
    Route::get('/order-cancel-static', 'Frontend\ServiceListController@order_payment_cancel_static')->name('frontend.order.payment.cancel.static');

    //order payment routes
    Route::get('/paypal/ipn', 'ServicePaymentController@paypal_ipn')->name('frontend.paypal.ipn');
    Route::post('/paytm/ipn', 'ServicePaymentController@paytm_ipn')->name('frontend.paytm.ipn');
    Route::get('/paystack/ipn', 'ServicePaymentController@paystack_ipn')->name('frontend.paystack.ipn');
    Route::get('/mollie/ipn', 'ServicePaymentController@mollie_ipn')->name('frontend.mollie.ipn');
    Route::get('/stripe/ipn', 'ServicePaymentController@stripe_ipn')->name('frontend.stripe.ipn');
    Route::post('/razorpay/ipn', 'ServicePaymentController@razorpay_ipn')->name('frontend.razorpay.ipn');
    Route::get('/flutterwave/ipn', 'ServicePaymentController@flutterwave_ipn')->name('frontend.flutterwave.ipn');
    Route::get('/midtrans/ipn', 'ServicePaymentController@midtrans_ipn')->name('frontend.midtrans.ipn');
    Route::post('/payfast/ipn', 'ServicePaymentController@payfast_ipn')->name('frontend.payfast.ipn');
    Route::post('/cashfree/ipn', 'ServicePaymentController@cashfree_ipn')->name('frontend.cashfree.ipn');
    Route::get('/instamojo/ipn', 'ServicePaymentController@instamojo_ipn')->name('frontend.instamojo.ipn');
    Route::get('/marcadopago/ipn', 'ServicePaymentController@marcadopago_ipn')->name('frontend.marcadopago.ipn');
    Route::get('/squareup-ipn', 'ServicePaymentController@squareup_ipn')->name('frontend.squareup.ipn');
    Route::post('/cinetpay-ipn', 'ServicePaymentController@cinetpay_ipn')->name('frontend.cinetpay.ipn');
    Route::post('/paytabs-ipn', 'ServicePaymentController@paytabs_ipn')->name('frontend.paytabs.ipn');
    Route::post('/billplz-ipn', 'ServicePaymentController@billplz_ipn')->name('frontend.billplz.ipn');
    Route::post('/zitopay-ipn', 'ServicePaymentController@zitopay_ipn')->name('frontend.zitopay.ipn'); //need to exclude from csrf token varification

});
// frontend ends

// frontend custom form builders
Route::post('submit-custom-form', 'FrontendFormController@custom_form_builder_message')->name('frontend.form.builder.custom.submit');

// admin login
Route::middleware(['setlang'])->group(function () {
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
    Route::get('/login/admin/forget-password', 'FrontendController@showAdminForgetPasswordForm')->name('admin.forget.password');
    Route::get('/login/admin/reset-password/{user}/{token}', 'FrontendController@showAdminResetPasswordForm')->name('admin.reset.password');
    Route::post('/login/admin/reset-password', 'FrontendController@AdminResetPassword')->name('admin.reset.password.change');
    Route::post('/login/admin/forget-password', 'FrontendController@sendAdminForgetPasswordMail');
    Route::get('/logout/admin', 'AdminDashboardController@adminLogout')->name('admin.logout');
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
});

Route::group(['middleware' => ['setlang', 'globalVariable', 'maintains_mode']], function () {
    Route::get('/{slug}', 'FrontendController@dynamic_single_page')->name('frontend.dynamic.page');
    Route::get('/{username?}', 'FrontendController@dynamic_single_page')->name('about.seller.profile');
    Route::get('/buyer-profile/{username?}', 'FrontendController@buyerProfile')->name('about.buyer.profile');
});

Route::group(['middleware' => ['auth', 'inactiveuser']], function () {
    // media upload routes for User
    Route::group(['namespace' => 'User'], function () {
        Route::post('/media-upload/all', 'MediaUploadController@all_upload_media_file')->name('web.upload.media.file.all');
        Route::post('/media-upload', 'MediaUploadController@upload_media_file')->name('web.upload.media.file');
        Route::post('/media-upload/alt', 'MediaUploadController@alt_change_upload_media_file')->name('web.upload.media.file.alt.change');
        Route::post('/media-upload/delete', 'MediaUploadController@delete_upload_media_file')->name('web.upload.media.file.delete');
        Route::post('/media-upload/loadmore', 'MediaUploadController@get_image_for_loadmore')->name('web.upload.media.file.loadmore');
    });

});

require_once __DIR__ . '/seller.php';
require_once __DIR__ . '/buyer.php';
