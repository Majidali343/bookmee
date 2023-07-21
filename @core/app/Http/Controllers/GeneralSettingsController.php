<?php

namespace App\Http\Controllers;

use App\CustomFontImport;
use App\Helpers\FlashMsg;
use App\Helpers\ModuleMetaData;
use App\Mail\BasicMail;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Language;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:general-settings-site-identity',['only'=>['site_identity','update_site_identity']]);
        $this->middleware('permission:general-settings-reading-settings',['only'=>['reading','update_reading']]);
        $this->middleware('permission:general-settings-global-navbar-settings',['only'=>['global_variant_navbar','update_global_variant_navbar']]);
        $this->middleware('permission:general-settings-global-footer-settings',['only'=>['global_variant_footer','update_global_variant_footer']]);
        $this->middleware('permission:general-settings-basic-settings',['only'=>['basic_settings','update_basic_settings']]);
        $this->middleware('permission:general-settings-color-settings',['only'=>['color_settings','update_color_settings']]);
        $this->middleware('permission:general-settings-typography-settings',['only'=>['typography_settings','get_single_font_variant','update_typography_settings']]);
        $this->middleware('permission:general-settings-seo-settings',['only'=>['seo_settings','update_seo_settings']]);
        $this->middleware('permission:general-settings-third-party-scripts',['only'=>['update_scripts_settings','scripts_settings']]);
        $this->middleware('permission:general-settings-email-template',['only'=>['email_template_settings','update_email_template_settings']]);
        $this->middleware('permission:general-settings-email-settings',['only'=>['email_settings','update_email_settings']]);
        $this->middleware('permission:general-settings-smtp-settings',['only'=>['smtp_settings','update_smtp_settings','test_smtp_settings']]);
        $this->middleware('permission:general-settings-page-settings',['only'=>['page_settings','update_page_settings']]);
        $this->middleware('permission:general-settings-payment-gateway-settings',['only'=>['payment_settings','update_payment_settings']]);
        $this->middleware('permission:general-settings-custom-css',['only'=>['custom_css_settings','update_custom_css_settings']]);
        $this->middleware('permission:general-settings-custom-js',['only'=>['custom_js_settings','update_custom_js_settings']]);
        $this->middleware('permission:general-settings-licence-settings',['only'=>['license_settings','update_license_settings']]);
        $this->middleware('permission:general-settings-cache-settings',['only'=>['cache_settings','update_cache_settings']]);
    }

    public function reading()
    {
        $all_home_pages = Page::where(['status'=> 'publish'])->get();
        return view('backend.general-settings.reading',compact('all_home_pages'));
    }
    public function update_reading(Request $request)
    {
        $this->validate($request, [
            'home_page' => 'nullable|string',
            'blog_page' => 'nullable|string',
            'service_list_page' => 'nullable|string',
            'price_plan_page' => 'nullable|string',
        ]);
        $fields = [
            'home_page',
            'blog_page',
            'service_list_page',
            'price_plan_page',
        ];
        foreach ($fields as $field) {
                update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function global_variant_navbar()
    {
        return view('backend.general-settings.navbar-global-variant');
    }
    public function update_global_variant_navbar(Request $request)
    {
        $this->validate($request, [
            'global_navbar_variant' => 'nullable|string',
        ]);
        $fields = [
            'global_navbar_variant',
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function global_variant_footer()
    {
        return view('backend.general-settings.footer-global-variant');
    }
    public function update_global_variant_footer(Request $request)
    {
        $this->validate($request, [
            'global_footer_variant' => 'nullable|string',
        ]);
        $fields = [
            'global_footer_variant',
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }


    public function site_identity()
    {
        return view('backend.general-settings.site-identity');
    }
    public function update_site_identity(Request $request)
    {
        $this->validate($request, [
            'site_logo' => 'nullable|string',
            'site_white_logo' => 'nullable|string',
            'site_favicon' => 'nullable|string',
        ]);
        $fields = [
            'site_logo',
            'site_white_logo',
            'site_favicon',
        ];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                update_static_option($field, $request->$field);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function basic_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.basic')->with(['all_languages' => $all_languages]);
    }
    public function update_basic_settings(Request $request)
    {
        $this->validate($request, [
            'language_select_option' => 'nullable|string',
            'disable_user_email_verify' => 'nullable|string',
            'site_main_color' => 'nullable|string',
            'site_secondary_color' => 'nullable|string',
            'site_maintenance_mode' => 'nullable|string',
            'admin_loader_animation' => 'nullable|string',
            'site_loader_animation' => 'nullable|string',
            'site_force_ssl_redirection' => 'nullable|string',
            'admin_panel_rtl_status' => 'nullable|string',
            'site_google_captcha_enable' => 'nullable|string',
            'site_title' => 'nullable|string',
            'site_tag_line' => 'nullable|string',
            'site_footer_copyright' => 'nullable|string',
        ]);
    
            $this->validate($request, [
                'site_title' => 'nullable|string',
                'site_tag_line' => 'nullable|string',
                'site_footer_copyright' => 'nullable|string',
            ]);
            $_title = 'site_title';
            $_tag_line = 'site_tag_line';
            $_footer_copyright = 'site_footer_copyright';
            update_static_option($_title, $request->$_title);
            update_static_option($_tag_line, $request->$_tag_line);
            update_static_option($_footer_copyright, $request->$_footer_copyright);
    

        $all_fields = [
            'language_select_option',
            'disable_user_email_verify',
            'site_main_color',
            'site_secondary_color',
            'site_maintenance_mode',
            'admin_loader_animation',
            'site_loader_animation',
            'admin_panel_rtl_status',
            'site_force_ssl_redirection',
            'site_google_captcha_enable',
        ];
        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function color_settings()
    {
        return view('backend.general-settings.color-settings');
    }

    public function update_color_settings(Request $request)
    {
        $this->validate($request, [
            'site_main_color_one' => 'nullable|string',
            'site_main_color_two' => 'nullable|string',
            'site_main_color_three' => 'nullable|string',
        ]);

        $all_fields = [
          'site_main_color_one',
          'site_main_color_two',
          'site_main_color_three',
          'heading_color',
          'light_color',
          'extra_light_color',
        ];

        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }



    public function seo_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.seo')->with(['all_languages' => $all_languages]);
    }
    public function update_seo_settings(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'site_meta_tags' => 'nullable|string',
                'site_meta_description' => 'nullable|string',
                'og_meta_title' => 'nullable|string',
                'og_meta_description' => 'nullable|string',
                'og_meta_site_name' => 'nullable|string',
                'og_meta_url' => 'nullable|string',
                'og_meta_image' => 'nullable|string',
            ]);
            $fields = [
                'site_meta_tags',
                'site_meta_description',
                'og_meta_title',
                'og_meta_description',
                'og_meta_site_name',
                'og_meta_url',
                'og_meta_image'
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function scripts_settings()
    {
        return view( 'backend.general-settings.thid-party');
    }

    public function update_scripts_settings(Request $request)
    {

        $this->validate($request, [
            'tawk_api_key' => 'nullable|string',
            'google_adsense_id' => 'nullable|string',
            'site_third_party_tracking_code' => 'nullable|string',
            'site_google_analytics' => 'nullable|string',
            'site_google_captcha_v3_secret_key' => 'nullable|string',
            'site_google_captcha_v3_site_key' => 'nullable|string',
        ]);

        update_static_option('site_disqus_key', $request->site_disqus_key);
        update_static_option('site_google_analytics', $request->site_google_analytics);
        update_static_option('tawk_api_key', $request->tawk_api_key);
        update_static_option('site_third_party_tracking_code', $request->site_third_party_tracking_code);
        update_static_option('site_google_captcha_v3_site_key', $request->site_google_captcha_v3_site_key);
        update_static_option('site_google_captcha_v3_secret_key', $request->site_google_captcha_v3_secret_key);

        $fields = [
            'site_google_captcha_v3_secret_key',
            'site_google_captcha_v3_site_key',
            'site_third_party_tracking_code',
            'site_google_analytics',
            'tawk_api_key',
            'enable_google_login',
            'google_client_id',
            'google_client_secret',
            'enable_facebook_login',
            'facebook_client_id',
            'facebook_client_secret',
            'google_adsense_publisher_id',
            'google_adsense_customer_id',
            'enable_google_adsense',
            'instagram_access_token',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        setEnvValue([
            'GOOGLE_ADSENSE_PUBLISHER_ID' => $request->google_adsense_publisher_id,
            'GOOGLE_ADSENSE_CUSTOMER_ID' => $request->google_adsense_customer_id,
            'FACEBOOK_CLIENT_ID' => $request->facebook_client_id,
            'FACEBOOK_CLIENT_SECRET' => $request->facebook_client_secret,
            'FACEBOOK_CALLBACK_URL' => route('facebook.callback'),
            'GOOGLE_CLIENT_ID' => $request->google_client_id,
            'GOOGLE_CLIENT_SECRET' => $request->google_client_secret,
            'GOOGLE_CALLBACK_URL' => route('google.callback'),
        ]);


        return redirect()->back()->with(['msg' => __('Third Party Scripts Settings Updated..'), 'type' => 'success']);
    }
    public function email_template_settings()
    {
        return view('backend.general-settings.email-template');
    }
    public function update_email_template_settings(Request $request)
    {

        $this->validate($request, [
            'site_global_email' => 'required|string',
            'site_global_email_template' => 'required|string',
        ]);

        $save_data = [
            'site_global_email',
            'site_global_email_template'
        ];
        foreach ($save_data as $item) {
            if (empty($request->$item)) {
                continue;
            }
            update_static_option($item, $request->$item);
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function cache_settings()
    {
        return view('backend.general-settings.cache-settings');
    }
    public function email_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.email-settings')->with(['all_languages' => $all_languages]);
    }
    public function update_email_settings(Request $request)
    {
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'contact_mail_success_message' => 'nullable|string',
                'order_mail_success_message' => 'nullable|string',

            ]);
            $fields = [

                'contact_mail_success_message',
                'order_mail_success_message',
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function update_cache_settings(Request $request)
    {

        $this->validate($request, [
            'cache_type' => 'required|string'
        ]);

        Artisan::call($request->cache_type . ':clear');

        return redirect()->back()->with(['msg' => __('Cache Cleaned'), 'type' => 'success']);
    }
    public function typography_settings()
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');

        // custom font css get
        $custom_css = '/* Write Custom Css Here */';
        if (file_exists('assets/common/fonts/custom-fonts/css/custom_font.css')) {
            $custom_css = file_get_contents('assets/common/fonts/custom-fonts/css/custom_font.css');
        }
        // get all font
        $all_fonts = CustomFontImport::all();
        $fonts = \App\CustomFontImport::select('status')->where('status', '!=', 0)->get();
        $custom_font = $fonts->count();



        return view('backend.general-settings.typograhpy', compact('all_fonts', 'custom_font'))->with(['google_fonts' => json_decode($all_google_fonts), 'custom_css' => $custom_css]);
    }

    public function get_single_font_variant(Request $request)
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        $decoded_fonts = json_decode($all_google_fonts, true);
        return response()->json($decoded_fonts[$request->font_family]);
    }
    
    
    public function update_typography_settings(Request $request)
    {



        $this->validate($request, [
            'body_font_family' => 'required|string|max:191',
            'body_font_variant' => 'required',
            'heading_font' => 'nullable|string',
            'heading_font_family' => 'nullable|string|max:191',
            'heading_font_variant' => 'nullable',
        ]);

        $save_data = [
            'body_font_family',
            'heading_font_family',
            'extra_body_font',
            'google_font',
            'custom_font',
        ];
        foreach ($save_data as $item) {
            update_static_option($item, $request->$item);
        }

        $body_font_variant = !empty($request->body_font_variant) ?  $request->body_font_variant : ['regular'];
        $heading_font_variant = !empty($request->heading_font_variant) ?  $request->heading_font_variant : ['regular'];
        update_static_option('heading_font', $request->heading_font);
        update_static_option('body_font_variant', serialize($body_font_variant));
        update_static_option('heading_font_variant', serialize($heading_font_variant));

        //Extra
        $fonts = [
            'body_font_family_three',
            'body_font_family_four',
            'body_font_family_five',
        ];

        foreach($fonts as $font){
            update_static_option($font, $request->$font);
        }

        $fonts_variants = [
            'body_font_variant_three',
            'body_font_variant_four',
            'body_font_variant_five',
        ];
        foreach ($fonts_variants as $vari){
            $body_font_variant = !empty($request->$vari) ?  $request->$vari : ['400'];
            update_static_option($vari, serialize($body_font_variant));
        }

        CustomFontImport::where('status', '!=', 0)->update(['status'=>0]);

        return redirect()->back()->with(['msg' => __('Typography Settings Updated..'), 'type' => 'success']);
    }
    
    
    
    public function smtp_settings()
    {
        return view('backend.general-settings.smtp-settings');
    }


   public function update_smtp_settings(Request $request){
        $this->validate($request,[
            'site_smtp_mail_host' => 'required|string',
            'site_smtp_mail_port' => 'required|string',
            'site_smtp_mail_username' => 'required|string',
            'site_smtp_mail_password' => 'required|string',
            'site_smtp_mail_encryption' => 'required|string'
        ]);

        update_static_option('site_smtp_mail_mailer',$request->site_smtp_mail_mailer);
        update_static_option('site_smtp_mail_host',$request->site_smtp_mail_host);
        update_static_option('site_smtp_mail_port',$request->site_smtp_mail_port);
        update_static_option('site_smtp_mail_username',$request->site_smtp_mail_username);
        update_static_option('site_smtp_mail_password',$request->site_smtp_mail_password);
        update_static_option('site_smtp_mail_encryption',$request->site_smtp_mail_encryption);

        setEnvValue([
            'MAIL_DRIVER' => $request->site_smtp_mail_mailer,
            'MAIL_HOST' => $request->site_smtp_mail_host,
            'MAIL_PORT' => $request->site_smtp_mail_port,
            'MAIL_USERNAME' => $request->site_smtp_mail_username,
            'MAIL_PASSWORD' => '"'.$request->site_smtp_mail_password.'"',
            'MAIL_ENCRYPTION' => $request->site_smtp_mail_encryption
        ]);

        return redirect()->back()->with(['msg' => __('SMTP Settings Updated...'),'type' => 'success']);
    }


    public function test_smtp_settings(Request $request){
        $this->validate($request,[
            'subject' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required|string',
        ]);
        $res_data = [
            'msg' => __('Mail Send Success'),
            'type' => 'success'
        ];
        try {
            Mail::to($request->email)->send(new BasicMail([
                'subject' => $request->subject,
                'message' => $request->message
            ]));
        }catch (\Exception $e){
            return  redirect()->back()->with([
                'type' => 'danger',
                'msg' => $e->getMessage()
            ]);
        }

        if (Mail::failures()){
            $res_data = [
                'msg' => __('Mail Send Failed'),
                'type' => 'danger'
            ];
        }
        return redirect()->back()->with($res_data);
    }

    public function page_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.page-settings')->with(['all_languages' => $all_languages]);
    }

    public function update_page_settings(Request $request)
    {
        $all_languages = Language::all();
        $this->validate($request, [
            'gallery_page_slug'=> 'nullable|string|max:191',
            'blog_page_slug'=> 'nullable|string|max:191',
            'contact_page_slug'=> 'nullable|string|max:191',
        ]);
        $pages_list = ['gallery','blog','contact'];

        foreach ($pages_list as $slug_field) {
            $field = $slug_field.'_page_slug';
            update_static_option($field, Str::slug($request->$field));
        }
        foreach ($all_languages as $lang) {

            $this->validate($request,[
                'gallery_page_' . $lang->slug . '_name' => 'nullable|string',
                'gallery_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'gallery_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'contact_page_' . $lang->slug . '_name' => 'nullable|string',
                'contact_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'contact_page_' . $lang->slug . '_meta_description' => 'nullable|string',
                'blog_page_' . $lang->slug . '_name' => 'nullable|string',
                'blog_page_' . $lang->slug . '_meta_tags' => 'nullable|string',
                'blog_page_' . $lang->slug . '_meta_description' => 'nullable|string',
            ]);

            foreach ($pages_list as $field) {
                $field_name = $field.'_page_'. $lang->slug.'_name';
                $field_meta_tags = $field.'_page_'. $lang->slug.'_meta_tags';
                $field_meta_meta_description = $field.'_page_'. $lang->slug.'_meta_description';
                update_static_option($field_name, $request->$field_name);
                update_static_option($field_meta_tags, $request->$field_meta_tags);
                update_static_option($field_meta_meta_description, $request->$field_meta_meta_description);
            }
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
    public function payment_settings()
    {
        return view('backend.general-settings.payment-gateway');
    }

    public function update_payment_settings(Request $request)
    {
        $field_rules = [
            // paypal
            'paypal_preview_logo' => 'nullable|string|max:191',
            'paypal_mode' => 'nullable|string|max:191',
            'paypal_sandbox_client_id' => 'nullable|string|max:191',
            'paypal_sandbox_client_secret' => 'nullable|string|max:191',
            'paypal_sandbox_app_id' => 'nullable|string|max:191',
            'paypal_live_app_id' => 'nullable|string|max:191',
            'paypal_payment_action' => 'nullable|string|max:191',
            'paypal_currency' => 'nullable|string|max:191',
            'paypal_notify_url' => 'nullable|string|max:191',
            'paypal_locale' => 'nullable|string|max:191',
            'paypal_validate_ssl' => 'nullable|string|max:191',
            'paypal_live_client_id' => 'nullable|string|max:191',
            'paypal_live_client_secret' => 'nullable|string|max:191',
            'paypal_gateway' => 'nullable|string|max:191',
            'paypal_test_mode' => 'nullable|string|max:191',
            // razorpay
            'razorpay_preview_logo' => 'nullable|string|max:191',
            'razorpay_key' => 'nullable|string|max:191',
            'razorpay_secret' => 'nullable|string|max:191',
            'razorpay_api_key' => 'nullable|string|max:191',
            'razorpay_api_secret' => 'nullable|string|max:191',
            'razorpay_gateway' => 'nullable|string|max:191',
            // stripe
            'stripe_preview_logo' => 'nullable|string|max:191',
            'stripe_publishable_key' => 'nullable|string|max:191',
            'stripe_secret_key' => 'nullable|string|max:191',
            'stripe_public_key' => 'nullable|string|max:191',
            'stripe_gateway' => 'nullable|string|max:191',
            // paytm
            'paytm_gateway' => 'nullable|string|max:191',
            'paytm_preview_logo' => 'nullable|string|max:191',
            'paytm_merchant_key' => 'nullable|string|max:191',
            'paytm_merchant_mid' => 'nullable|string|max:191',
            'paytm_merchant_website' => 'nullable|string|max:191',
            'paytm_test_mode' => 'nullable|string|max:191',
            // paystack
            'paystack_merchant_email' => 'nullable|string|max:191',
            'paystack_preview_logo' => 'nullable|string|max:191',
            'paystack_public_key' => 'nullable|string|max:191',
            'paystack_secret_key' => 'nullable|string|max:191',
            'paystack_gateway' => 'nullable|string|max:191',
            // mollie
            'mollie_preview_logo' => 'nullable|string|max:191',
            'mollie_public_key' => 'nullable|string|max:191',
            'mollie_gateway' => 'nullable|string|max:191',
            // marcado_pago
            'marcado_pagp_client_id' => 'nullable|string|max:191',
            'marcado_pago_client_secret' => 'nullable|string|max:191',
            'marcado_pago_test_mode' => 'nullable|string|max:191',
            // cash on delivery (COD)
            'cash_on_delivery_gateway' => 'nullable|string|max:191',
            'cash_on_delivery_preview_logo' => 'nullable|string|max:191',
            // flutterwave
            'flutterwave_preview_logo' => 'nullable|string|max:191',
            'flutterwave_gateway' => 'nullable|string|max:191',
            'flw_public_key' => 'nullable|string|max:191',
            'flw_secret_key' => 'nullable|string|max:191',
            'flw_secret_hash' => 'nullable|string|max:191',
            // midtrans
            'midtrans_preview_logo' => 'nullable|string|max:191',
            'midtrans_merchant_id' => 'nullable|string|max:191',
            'midtrans_server_key' => 'nullable|string|max:191',
            'midtrans_client_key' => 'nullable|string|max:191',
            'midtrans_environment' => 'nullable|string|max:191',
            'midtrans_gateway' => 'nullable|string|max:191',
            'midtrans_test_mode' => 'nullable|string|max:191',
            // payfast
            'payfast_preview_logo' => 'nullable|string|max:191',
            'payfast_merchant_id' => 'nullable|string|max:191',
            'payfast_merchant_key' => 'nullable|string|max:191',
            'payfast_passphrase' => 'nullable|string|max:191',
            'payfast_merchant_env' => 'nullable|string|max:191',
            'payfast_itn_url' => 'nullable|string|max:191',
            'payfast_gateway' => 'nullable|string|max:191',
            // cashfree
            'cashfree_preview_logo' => 'nullable|string|max:191',
            'cashfree_test_mode' => 'nullable|string|max:191',
            'cashfree_app_id' => 'nullable|string|max:191',
            'cashfree_secret_key' => 'nullable|string|max:191',
            'cashfree_gateway' => 'nullable|string|max:191',
            // instamojo
            'instamojo_preview_logo' => 'nullable|string|max:191',
            'instamojo_client_id' => 'nullable|string|max:191',
            'instamojo_client_secret' => 'nullable|string|max:191',
            'instamojo_username' => 'nullable|string|max:191',
            'instamojo_password' => 'nullable|string|max:191',
            'instamojo_test_mode' => 'nullable|string|max:191',
            'instamojo_gateway' => 'nullable|string|max:191',
            // marcadopago
            'marcadopago_preview_logo' => 'nullable|string|max:191',
            'marcado_pago_client_id' => 'nullable|string|max:191',
            'marcadopago_gateway' => 'nullable|string|max:191',
            'marcadopago_test_mode' => 'nullable|string|max:191',


            // zitopay
            'zitopay_username' => 'nullable|string|max:191',
            'zitopay_preview_logo' => 'nullable|string|max:191',
            'zitopay_gateway' => 'nullable|string|max:191',
            'zitopay_test_mode' => 'nullable|string|max:191',

            // billplz
            'billplz_collection_name' => 'nullable|string|max:191',
            'billplz_xsignature' => 'nullable|string|max:191',
            'billplz_key' => 'nullable|string|max:191',
            'billplz_preview_logo' => 'nullable|string|max:191',
            'billplz_gateway' => 'nullable|string|max:191',
            'billplz_test_mode' => 'nullable|string|max:191',

            // paytabs
            'paytabs_region' => 'nullable|string|max:191',
            'paytabs_profile_id' => 'nullable|string|max:191',
            'paytabs_server_key' => 'nullable|string|max:191',
            'paytabs_preview_logo' => 'nullable|string|max:191',
            'paytabs_gateway' => 'nullable|string|max:191',
            'paytabs_test_mode' => 'nullable|string|max:191',

            // cinetpay
            'cinetpay_site_id' => 'nullable|string|max:191',
            'cinetpay_app_key' => 'nullable|string|max:191',
            'cinetpay_preview_logo' => 'nullable|string|max:191',
            'cinetpay_gateway' => 'nullable|string|max:191',
            'cinetpay_test_mode' => 'nullable|string|max:191',

            // squareup
            'squareup_application_id' => 'nullable|string|max:191',
            'squareup_location_id' => 'nullable|string|max:191',
            'squareup_access_token' => 'nullable|string|max:191',
            'squareup_preview_logo' => 'nullable|string|max:191',
            'squareup_gateway' => 'nullable|string|max:191',
            'squareup_test_mode' => 'nullable|string|max:191',



            // site global
            'site_global_currency' => 'nullable|string|max:191',
            'site_global_payment_gateway' => 'nullable|string|max:191',
            // site manual
            'site_manual_payment_name' => 'nullable|string|max:191',
            'site_manual_payment_description' => 'nullable|string|max:191',
            // manual payment
            'manual_payment_preview_logo' => 'nullable|string|max:191',
            'manual_payment_gateway' => 'nullable|string|max:191',
            // exchange rate
            'site_usd_to_ngn_exchange_rate' => 'nullable|string|max:191',
            'site_euro_to_ngn_exchange_rate' => 'nullable|string|max:191',
            'site_currency_symbol_position' => 'nullable|string|max:191',
            'site_default_payment_gateway' => 'nullable|string|max:191',
        ];

        $saveAllPaymentGatewaySettings = (new ModuleMetaData())->saveAllPaymentGatewaySettings();
        foreach ($saveAllPaymentGatewaySettings as $pay_settings){
            foreach ($pay_settings as $pset){
                if (empty($pset)){continue;}
                update_static_option($pset, $request->$pset);
            }
        }
        $this->validate($request, $field_rules);

        $global_currency = get_static_option('site_global_currency');
        

        $field_rules['site_' . strtolower($global_currency) . '_to_idr_exchange_rate'] = 0;
        $field_rules['site_' . strtolower($global_currency) . '_to_inr_exchange_rate'] = 0;
        $field_rules['site_' . strtolower($global_currency) . '_to_ngn_exchange_rate'] = 0;
        $field_rules['site_' . strtolower($global_currency) . '_to_zar_exchange_rate'] = 0;
        $field_rules['site_' . strtolower($global_currency) . '_to_brl_exchange_rate'] = 0;
        $field_rules['site_' . strtolower($global_currency) . '_to_myr_exchange_rate'] = 0;

        foreach ($field_rules as $item => $rule) {
            update_static_option($item, $request->$item);
        }
        //todo update modules payment gateway settings data

        update_static_option('enable_disable_decimal_point',$request->enable_disable_decimal_point);
        update_static_option('add_remove_sapce_between_amount_and_symbol',$request->add_remove_sapce_between_amount_and_symbol);

        //Paypal
        $env_val['PAYPAL_MODE'] = !empty($request->paypal_test_mode) ? 'sandbox' : 'live';
        $env_val['PAYPAL_SANDBOX_CLIENT_ID'] = $request->paypal_sandbox_client_id ?: 'AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb';
        $env_val['PAYPAL_SANDBOX_CLIENT_SECRET'] = $request->paypal_sandbox_client_secret ?: 'EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y';
        $env_val['PAYPAL_SANDBOX_APP_ID'] = $request->paypal_sandbox_app_id ?: '456345645645';
        $env_val['PAYPAL_LIVE_CLIENT_ID'] = $request->paypal_live_client_id ?: '';
        $env_val['PAYPAL_LIVE_CLIENT_SECRET'] = $request->paypal_live_client_secret ?: '';
        $env_val['PAYPAL_LIVE_APP_ID'] = $request->paypal_live_app_id ?: '';
        $env_val['PAYPAL_PAYMENT_ACTION'] = $request->paypal_payment_action ?: '';
        $env_val['PAYPAL_CURRENCY'] = $request->paypal_currency ?: 'USD';
        $env_val['PAYPAL_NOTIFY_URL'] = $request->paypal_notify_url ?: 'http://gateway.test/paypal/ipn';
        $env_val['PAYPAL_LOCALE'] = $request->paypal_locale ?: 'en_GB';
        $env_val['PAYPAL_VALIDATE_SSL'] = $request->paypal_validate_ssl ?: 'false';
        // Paystack
        $env_val['PAYSTACK_PUBLIC_KEY'] = $request->paystack_public_key ?: 'pk_test_081a8fcd9423dede2de7b4c3143375b5e5415290';
        $env_val['PAYSTACK_SECRET_KEY'] = $request->paystack_secret_key ?: 'sk_test_c874d38f8d08760efc517fc83d8cd574b906374f';
        $env_val['MERCHANT_EMAIL'] = $request->paystack_merchant_email ?: 'example@gmail.com';

        $env_val['MOLLIE_KEY'] = $request->mollie_public_key ?: 'test_SMWtwR6W48QN2UwFQBUqRDKWhaQEvw';

        $env_val['FLW_PUBLIC_KEY'] = $request->flw_public_key ?: 'FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X';
        $env_val['FLW_SECRET_KEY'] = $request->flw_secret_key ?: 'FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X';
        $env_val['FLW_SECRET_HASH'] = $request->flw_secret_hash ?: 'oxo';

        $env_val['RAZORPAY_API_KEY'] = $request->razorpay_api_key ?: 'rzp_test_SXk7LZqsBPpAkj';
        $env_val['RAZORPAY_API_SECRET'] = $request->razorpay_api_secret ?: 'Nenvq0aYArtYBDOGgmMH7JNv';

        $env_val['STRIPE_PUBLIC_KEY'] = $request->stripe_public_key ?: 'pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x';
        $env_val['STRIPE_SECRET_KEY'] = $request->stripe_secret_key ?: 'sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw';

        $env_val['PAYTM_MERCHANT_ID'] = $request->paytm_merchant_mid ?: 'Digita57697814558795';
        $env_val['PAYTM_MERCHANT_KEY'] = '"' . $request->paytm_merchant_key . '"' ?: 'dv0XtmsPYpewNag&';
        $env_val['PAYTM_MERCHANT_WEBSITE'] = '"' . $request->paytm_merchant_website . '"' ?: 'WEBSTAGING';
        $env_val['PAYTM_CHANNEL'] = '"' . $request->paytm_channel . '"' ?: 'WEB';
        $env_val['PAYTM_INDUSTRY_TYPE'] = '"' . $request->paytm_industry_type . '"' ?: 'Retail';
        $env_val['PAYTM_ENVIRONMENT'] =  $request->paytm_test_mode  ? 'local' : 'production';


        $global_currency = get_static_option('site_global_currency');
        $currency_filed_name = 'site_' . strtolower($global_currency) . '_to_usd_exchange_rate';
        update_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate', $request->$currency_filed_name);

        $idr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_idr_exchange_rate';
        $inr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_inr_exchange_rate';
        $ngn_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_ngn_exchange_rate';
        $zar_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_zar_exchange_rate';
        $brl_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_brl_exchange_rate';
        $myr_exchange_rate = 'site_' . strtolower($global_currency) . '_to_myr_exchange_rate';

        $env_val['IDR_EXCHANGE_RATE'] = $request->$idr_currency_filed_name ? $request->$idr_currency_filed_name : '14365.30';
        $env_val['INR_EXCHANGE_RATE'] = $request->$inr_currency_filed_name ? $request->$inr_currency_filed_name : '74.85';
        $env_val['NGN_EXCHANGE_RATE'] = $request->$ngn_currency_filed_name ? $request->$ngn_currency_filed_name : '409.91';
        $env_val['ZAR_EXCHANGE_RATE'] = $request->$zar_currency_filed_name ? $request->$zar_currency_filed_name : '15.86';
        $env_val['BRL_EXCHANGE_RATE'] = $request->$brl_currency_filed_name ? $request->$brl_currency_filed_name : '5.70';
        $env_val['MYR_EXCHANGE_RATE'] = $request->$myr_exchange_rate ? $request->$myr_exchange_rate : '5.70';

        $env_val['MIDTRANS_MERCHANT_ID'] = $request->midtrans_merchant_id ?: 'G770543580';
        $env_val['MIDTRANS_SERVER_KEY'] = $request->midtrans_server_key ?: 'SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on';
        $env_val['MIDTRANS_CLIENT_KEY'] = $request->midtrans_client_key ?: 'SB-Mid-client-iDuy-jKdZHkLjL_I';
        $env_val['MIDTRANS_ENVAIRONTMENT'] = $request->midtrans_test_mode ? 'true' : 'false';

        $env_val['PF_MERCHANT_ID'] = $request->payfast_merchant_id ?: '10024000';
        $env_val['PF_MERCHANT_KEY'] = $request->payfast_merchant_key ?: '77jcu5v4ufdod';
        $env_val['PAYFAST_PASSPHRASE'] = $request->payfast_passphrase ?: 'testpayfastsohan';
        $env_val['PF_MERCHANT_ENV'] = $request->payfast_test_mode ? 'true' : 'false';
        $env_val['PF_ITN_URL'] = $request->payfast_itn_url ?: 'https://fundorex.test/donation-payfast';

        $env_val['CASHFREE_TEST_MODE'] = $request->cashfree_test_mode ? 'true' : 'false';
        $env_val['CASHFREE_APP_ID'] = $request->cashfree_app_id ?: '94527832f47d6e74fa6ca5e3c72549';
        $env_val['CASHFREE_SECRET_KEY'] = $request->cashfree_secret_key ?: 'ec6a3222018c676e95436b2e26e89c1ec6be2830';

        $env_val['INSTAMOJO_CLIENT_ID'] = $request->instamojo_client_id ?: 'test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z';
        $env_val['INSTAMOJO_CLIENT_SECRET'] = $request->instamojo_client_secret ?: 'test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm';
        $env_val['INSTAMOJO_USERNAME'] = $request->instamojo_username ?: '';
        $env_val['INSTAMOJO_PASSWORD'] = $request->instamojo_password ?: '';
        $env_val['INSTAMOJO_TEST_MODE'] = $request->instamojo_test_mode ? 'true' : 'false';

        $env_val['MERCADO_PAGO_CLIENT_ID'] = $request->marcado_pago_client_id ?: 'TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769';
        $env_val['MERCADO_PAGO_CLIENT_SECRET'] = $request->marcado_pago_client_secret ?: 'TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991';
        $env_val['MERCADO_PAGO_TEST_MOD'] = $request->marcado_pago_test_mode ? 'true' : 'false';

        //site global currency = 
        $env_val['SITE_GLOBAL_CURRENCY'] = $global_currency;

        setEnvValue($env_val);

        Artisan::call('cache:clear');

        return redirect()->back()->with([
            'msg' => __('Payment Settings Updated..'),
            'type' => 'success'
        ]);
    }

    public function custom_css_settings()
    {
        $custom_css = '/* Write Custom Css Here */';
        if (file_exists('assets/frontend/css/dynamic-style.css')) {
            $custom_css = file_get_contents('assets/frontend/css/dynamic-style.css');
        }
        return view('backend.general-settings.custom-css')->with(['custom_css' => $custom_css]);
    }

    public function update_custom_css_settings(Request $request)
    {
        file_put_contents('assets/frontend/css/dynamic-style.css', $request->custom_css_area);

        return redirect()->back()->with(['msg' => __('Custom Style Successfully Added...'), 'type' => 'success']);
    }

    public function custom_js_settings()
    {
        $custom_js = '/* Write Custom js Here */';
        if (file_exists('assets/frontend/js/dynamic-script.js')) {
            $custom_js = file_get_contents('assets/frontend/js/dynamic-script.js');
        }
        return view('backend.general-settings.custom-js')->with(['custom_js' => $custom_js]);
    }

    public function database_upgrade()
    {
        return view('backend.general-settings.database-upgrade');
    }
    
    public function database_upgrade_post(Request $request)
    {
        setEnvValue(['APP_ENV' => 'local']);
        Artisan::call('migrate', ['--force' => true ]);
        Artisan::call('db:seed', ['--force' => true ]);
        Artisan::call('cache:clear');
        setEnvValue(['APP_ENV' => 'production']);
        return back()->with(FlashMsg::item_new('Database Upgraded Successfully'));
    }

    public function update_custom_js_settings(Request $request)
    {
        file_put_contents('assets/frontend/js/dynamic-script.js', $request->custom_js_area);

        return redirect()->back()->with(['msg' => __('Custom Script Successfully Added...'), 'type' => 'success']);
    }
    public function gdpr_settings()
    {
        $all_languages = Language::all();
        return view('backend.general-settings.gdpr')->with(['all_languages' => $all_languages]);
    }

    public function update_gdpr_cookie_settings(Request $request)
    {

        $this->validate($request, [
            'site_gdpr_cookie_enabled' => 'nullable|string|max:191',
            'site_gdpr_cookie_expire' => 'required|string|max:191',
            'site_gdpr_cookie_delay' => 'required|string|max:191',
            "site_gdpr_cookie_title" => 'nullable|string',
            "site_gdpr_cookie_message" => 'nullable|string',
            "site_gdpr_cookie_more_info_label" => 'nullable|string',
            "site_gdpr_cookie_more_info_link" => 'nullable|string',
            "site_gdpr_cookie_accept_button_label" => 'nullable|string',
            "site_gdpr_cookie_decline_button_label" => 'nullable|string',
        ]);


        $fields = [
            "site_gdpr_cookie_title",
            "site_gdpr_cookie_message",
            "site_gdpr_cookie_more_info_label",
            "site_gdpr_cookie_more_info_link",
            "site_gdpr_cookie_accept_button_label",
            "site_gdpr_cookie_decline_button_label",
            "site_gdpr_cookie_manage_button_label",
            "site_gdpr_cookie_manage_title",
        ];
        
        foreach ($fields as $field){ 
            update_static_option($field, $request->$field);
        }
        
         $all_fields = [
            'site_gdpr_cookie_manage_item_title',
            'site_gdpr_cookie_manage_item_description',
        ];
        
        foreach ($all_fields as $field){
            $value = $request->$field ?? [];
            update_static_option($field,serialize($value));
        }
            

        update_static_option('site_gdpr_cookie_delay', $request->site_gdpr_cookie_delay);
        update_static_option('site_gdpr_cookie_enabled', $request->site_gdpr_cookie_enabled);
        update_static_option('site_gdpr_cookie_expire', $request->site_gdpr_cookie_expire);

        return redirect()->back()->with(['msg' => __('GDPR Cookie Settings Updated..'), 'type' => 'success']);
    }


    public function license_settings()
    {
        return view('backend.general-settings.license-settings');
    }

     public function update_license_settings(Request $request)
    {
        $this->validate($request, [
            'item_purchase_key' => 'required|string|max:191'
        ]);
        $response = Http::get('https://api.bytesed.com/license/new', [
            'purchase_code' => $request->item_purchase_key,
            'site_url' => url('/'),
            'item_unique_key' => $request->item_script_type === 'bundle' ? '0D1FVAFkIrapFP8BxirOSRFTCDVWtyeV' : 'vwYO8y6j9WeciiEIcEBCUeRMTSP8gEaA',
        ]);
        $result = $response->json();
        
        if($response->ok() && !is_null($result)){
            update_static_option('item_purchase_key', $request->item_purchase_key);
            update_static_option('item_license_status', $result['license_status']);
            update_static_option('item_license_msg', $result['msg']);
            update_static_option('item_script_type', $request->item_script_type);

            $type = 'verified' == $result['license_status'] ? 'success' : 'danger';
            setcookie("site_license_check", "", time() - 3600, '/');
            $license_info = [
                "item_license_status" => $result['license_status'],
                "last_check" => time(),
                "purchase_code" => get_static_option('item_purchase_key'),
                "xgenious_app_key" => env('XGENIOUS_API_KEY'),
                "author" => env('XGENIOUS_API_AUTHOR'),
                "message" => $result['msg']
            ];
            file_put_contents('@core/license.json', json_encode($license_info));
            return redirect()->back()->with(['msg' => $result['msg'], 'type' => $type]);
        }
        
        return redirect()->back()->with(['msg' => __('something went wrong please contact support'), 'type' => 'danger']);
    }

    public function sitemap_settings()
    {
        $all_sitemap = glob('sitemap/*');
        return view('backend.general-settings.sitemap-settings')->with(['all_sitemap' => $all_sitemap]);
    }

    public function update_sitemap_settings(Request $request)
    {
        $this->validate($request, [
            'site_url' => 'required|url',
            'title' => 'nullable|string',
        ]);
        $title = $request->title ? $request->title : time();
        SitemapGenerator::create($request->site_url)->writeToFile('sitemap/sitemap-' . $title . '.xml');
        return redirect()->back()->with([
            'msg' => __('Sitemap Generated..'),
            'type' => 'success'
        ]);
    }

    public function delete_sitemap_settings(Request $request)
    {
        if (file_exists($request->sitemap_name)) {
            @unlink($request->sitemap_name);
        }
        return redirect()->back()->with(['msg' => __('Sitemap Deleted...'), 'type' => 'danger']);
    }


    //payment gateway
    public function payment_gateway_settings()
    {
        return view('backend.general-settings.payment-gateway');
    }

    //pusher Settings
    public function pusher_settings(Request $request)
    {
        if($request->isMethod('post')){

            $data = $this->validate($request, [
                'pusher_app_id' => 'required',
                'pusher_app_key' => 'required',
                'pusher_app_secret' => 'required',
                'pusher_app_cluster' => 'required',
                'pusher_app_push_notification_auth_token' => 'nullable',
                'pusher_app_push_notification_auth_url' => 'nullable',
                'pusher_app_push_notification_instanceId' => 'nullable',

                'seller_pusher_app_push_notification_auth_token' => 'nullable',
                'seller_pusher_app_push_notification_auth_url' => 'nullable',
                'seller_pusher_app_push_notification_instanceId' => 'nullable',

            ]);


            foreach ($data as $key => $val){
                update_static_option($key,$request->$key);
            }

            $pusher_app_id = $request->pusher_app_id;
            $pusher_app_key = $request->pusher_app_key;
            $pusher_app_secret = $request->pusher_app_secret;
            $pusher_app_cluster = $request->pusher_app_cluster;

            setEnvValue([
                'PUSHER_APP_ID'=> trim($pusher_app_id),
                'PUSHER_APP_KEY'=> trim($pusher_app_key),
                'PUSHER_APP_SECRET'=> trim($pusher_app_secret),
                'PUSHER_APP_CLUSTER'=> trim($pusher_app_cluster),
                'MIX_PUSHER_APP_KEY' => '"${PUSHER_APP_KEY}"',
                'MIX_PUSHER_APP_CLUSTER' => '"${PUSHER_APP_CLUSTER}"',
                'BROADCAST_DRIVER' => 'pusher',
            ]);

            return redirect()->back()->with([
                'msg' => __('Pusher Settings Updated'),
                'type' => 'success'
            ]);
        }
        return view('backend.general-settings.pusher-settings');
    }


}
