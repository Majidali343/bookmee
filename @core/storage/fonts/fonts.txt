<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'setlang' => \App\Http\Middleware\SetUserLanguages::class,
        'demo' => \App\Http\Middleware\Demo::class,
        'globalVariable' => \App\Http\Middleware\GlobalVariableMiddleware::class,
        'userEmailVerify' => \App\Http\Middleware\UserEmailVerify::class,
        //user permission middle ware
        'about_page_manage_check' => \App\Http\Middleware\Permission\AboutPageManage::class,
        'admin_manage_check' => \App\Http\Middleware\Permission\AdminManage::class,
        'language_check' => \App\Http\Middleware\Permission\Languages::class,
        'users_manage_check' => \App\Http\Middleware\Permission\UsersManage::class,
        'newsletter_manage_check' => \App\Http\Middleware\Permission\UsersManage::class,
        'quote_manage_check' => \App\Http\Middleware\Permission\QuoteManage::class,
        'package_order_manage_check' => \App\Http\Middleware\Permission\PackageOrdersManage::class,
        'payment_logs_check' => \App\Http\Middleware\Permission\PaymentLogs::class,
        'pages_manage_check' => \App\Http\Middleware\Permission\PagesManage::class,
        'menus_manage_check' => \App\Http\Middleware\Permission\MenusManage::class,
        'widgets_manage_check' => \App\Http\Middleware\Permission\WidgetsManage::class,
        'popup_builder_check' => \App\Http\Middleware\Permission\PopupBuilder::class,
        'form_builder_check' => \App\Http\Middleware\Permission\FormBuilder::class,
        'blogs_manage_check' => \App\Http\Middleware\Permission\BlogsManage::class,
        'job_post_manage_check' => \App\Http\Middleware\Permission\JobPostManage::class,
        'events_manage_check' => \App\Http\Middleware\Permission\EventsManage::class,
        'products_manage_check' => \App\Http\Middleware\Permission\ProductsManage::class,
        'donations_manage_check' => \App\Http\Middleware\Permission\DonationsManage::class,
        'knowledgebase_manage_check' => \App\Http\Middleware\Permission\KnowledgebaseManage::class,
        'home_variant_manage_check' => \App\Http\Middleware\Permission\HomeVariant::class,
        'topbar_settings_check' => \App\Http\Middleware\Permission\TopbarSettings::class,
        'home_page_manage_check' => \App\Http\Middleware\Permission\HomePageManage::class,
        'contact_page_manage_check' => \App\Http\Middleware\Permission\ContactPageManage::class,
        'feedback_page_manage_check' => \App\Http\Middleware\Permission\FeedbackPageManage::class,
        'services_manage_check' => \App\Http\Middleware\Permission\ServicesManage::class,
        'case_study_manage_check' => \App\Http\Middleware\Permission\CaseStudyManage::class,
        'gallery_page_check' => \App\Http\Middleware\Permission\GalleryPage::class,
        'error_404_manage_check' => \App\Http\Middleware\Permission\Error_404_Manage::class,
        'faq_manage_check' => \App\Http\Middleware\Permission\FaqManage::class,
        'brand_logos_manage_check' => \App\Http\Middleware\Permission\Brand_Logos_Manage::class,
        'price_plan_manage_check' => \App\Http\Middleware\Permission\Price_Plan_Manage::class,
        'team_member_manage_check' => \App\Http\Middleware\Permission\TeamMemberManage::class,
        'testimonial_manage_check' => \App\Http\Middleware\Permission\TestimonialManage::class,
        'counterup_manage_check' => \App\Http\Middleware\Permission\CounterupManage::class,
        'general_settings_check' => \App\Http\Middleware\Permission\GeneralSettings::class,
        'job_module_check' => \App\Http\Middleware\Module\JobModuleStatus::class,
        'event_module_check' => \App\Http\Middleware\Module\EventModuleStatus::class,
        'product_module_check' => \App\Http\Middleware\Module\ProductModuleStatus::class,
        'donation_module_check' => \App\Http\Middleware\Module\DonationModuleStatus::class,
        'knowledgebase_module_check' => \App\Http\Middleware\Module\KnowledgebaseModuleStatus::class,
    ];
}
