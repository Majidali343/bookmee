<?php

namespace App\Helpers;

use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class PaymentGatewayRequestHelper
{
    public static function paypal(){
        $paypal_mode = getenv('PAYPAL_MODE');
        $client_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_ID') : getenv('PAYPAL_LIVE_CLIENT_ID');
        $client_secret = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_SECRET') : getenv('PAYPAL_LIVE_CLIENT_SECRET');
        $app_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_APP_ID') : getenv('PAYPAL_LIVE_APP_ID');

        $paypal = XgPaymentGateway::paypal();

        $paypal->setClientId($client_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setClientSecret($client_secret); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setAppId($app_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
        $paypal->setCurrency(self::globalCurrency());
        $paypal->setEnv($paypal_mode === 'sandbox'); //env must set as boolean, string will not work
        $paypal->setExchangeRate(self::usdConversionValue()); // if INR not set as currency

        return $paypal;
    }

    public static function mollie(){
        $mollie_key = getenv('MOLLIE_KEY');
        $mollie = XgPaymentGateway::mollie();
        $mollie->setApiKey($mollie_key);
        $mollie->setCurrency(self::globalCurrency());
        $mollie->setEnv(true); //env must set as boolean, string will not work
        $mollie->setExchangeRate(self::usdConversionValue()); // if USD not set as currency

        return $mollie;
    }

    public static function paytm(){

        $paytm_merchant_id = getenv('PAYTM_MERCHANT_ID');
        $paytm_merchant_key = getenv('PAYTM_MERCHANT_KEY');
        $paytm_merchant_website = getenv('PAYTM_MERCHANT_WEBSITE') ?? 'WEBSTAGING';
        $paytm_channel = getenv('PAYTM_CHANNEL') ?? 'WEB';
        $paytm_industry_type = getenv('PAYTM_INDUSTRY_TYPE') ?? 'Retail';
        $paytm_env = getenv('PAYTM_ENVIRONMENT');

        $paytm = XgPaymentGateway::paytm();
        $paytm->setMerchantId($paytm_merchant_id);
        $paytm->setMerchantKey($paytm_merchant_key);
        $paytm->setMerchantWebsite($paytm_merchant_website);
        $paytm->setChannel($paytm_channel);
        $paytm->setIndustryType($paytm_industry_type);
        $paytm->setCurrency(self::globalCurrency());
        $paytm->setEnv($paytm_env === 'local'); // this must be type of boolean , string will not work
        $paytm->setExchangeRate(self::inrConversionValue()); // if INR not set as currency

        return $paytm;
    }

    public static function stripe(){

        $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
        $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
        $stripe = XgPaymentGateway::stripe();
        $stripe->setSecretKey($stripe_secret_key);
        $stripe->setPublicKey($stripe_public_key);
        $stripe->setCurrency(self::globalCurrency());
        $stripe->setEnv(true); //env must set as boolean, string will not work
        $stripe->setExchangeRate(self::usdConversionValue()); // if USD not set as currency

        return $stripe;
    }

    public static function razorpay(){

        $razorpay_api_key = getenv('RAZORPAY_API_KEY');
        $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');
        $razorpay = XgPaymentGateway::razorpay();
        $razorpay->setApiKey($razorpay_api_key);
        $razorpay->setApiSecret($razorpay_api_secret);
        $razorpay->setCurrency(self::globalCurrency());
        $razorpay->setEnv(true); //env must set as boolean, string will not work
        $razorpay->setExchangeRate(self::inrConversionValue()); // if INR not set as currency

        return $razorpay;
    }
    public static function flutterwave(){

        $flutterwave_public_key = getenv("FLW_PUBLIC_KEY");
        $flutterwave_secret_key = getenv("FLW_SECRET_KEY");
        $flutterwave_secret_hash = getenv("FLW_SECRET_HASH");

        $flutterwave = XgPaymentGateway::flutterwave();
        $flutterwave->setPublicKey($flutterwave_public_key);
        $flutterwave->setSecretKey($flutterwave_secret_key);
        $flutterwave->setCurrency(self::globalCurrency());
        $flutterwave->setEnv(true); //env must set as boolean, string will not work
        $flutterwave->setExchangeRate(self::usdConversionValue()); // if NGN not set as currency

        return $flutterwave;
    }
    public static function paystack(){

        $paystack_public_key = getenv('PAYSTACK_PUBLIC_KEY');
        $paystack_secret_key = getenv('PAYSTACK_SECRET_KEY');
        $paystack_merchant_email = getenv('MERCHANT_EMAIL');

        $paystack = XgPaymentGateway::paystack();
        $paystack->setPublicKey($paystack_public_key);
        $paystack->setSecretKey($paystack_secret_key);
        $paystack->setMerchantEmail($paystack_merchant_email);
        $paystack->setCurrency(self::globalCurrency());
        $paystack->setEnv(true); //env must set as boolean, string will not work
        $paystack->setExchangeRate(self::ngnConversionValue()); // if NGN not set as currency

        return $paystack;
    }
    public static function marcadopago(){

        $mercadopago_client_id = getenv('MERCADO_PAGO_CLIENT_ID');
        $mercadopago_client_secret = getenv('MERCADO_PAGO_CLIENT_SECRET');
        $mercadopago_env =  getenv('MERCADO_PAGO_TEST_MOD') === 'true';

        $marcadopago = XgPaymentGateway::marcadopago();
        $marcadopago->setClientId($mercadopago_client_id);
        $marcadopago->setClientSecret($mercadopago_client_secret);
        $marcadopago->setCurrency(self::globalCurrency());
        $marcadopago->setExchangeRate(self::brlConversionValue()); // if BRL not set as currency, you must have to provide exchange rate for it
        $marcadopago->setEnv($mercadopago_env); ////true mean sandbox mode , false means live mode

        return $marcadopago;
    }
    public static function instamojo(){

        $instamojo_client_id = getenv('INSTAMOJO_CLIENT_ID');
        $instamojo_client_secret = getenv('INSTAMOJO_CLIENT_SECRET');
        $instamojo_env = getenv('INSTAMOJO_TEST_MODE') === 'true';

        $instamojo = XgPaymentGateway::instamojo();
        $instamojo->setClientId($instamojo_client_id);
        $instamojo->setSecretKey($instamojo_client_secret);
        $instamojo->setCurrency(self::globalCurrency());
        $instamojo->setEnv($instamojo_env); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
        $instamojo->setExchangeRate(self::inrConversionValue()); // if INR not set as currency

        return $instamojo;
    }

    public static function cashfree(){

        $cashfree_env = getenv('CASHFREE_TEST_MODE') === 'true';
        $cashfree_app_id = getenv('CASHFREE_APP_ID');
        $cashfree_secret_key = getenv('CASHFREE_SECRET_KEY');

        $cashfree = XgPaymentGateway::cashfree();
        $cashfree->setAppId($cashfree_app_id);
        $cashfree->setSecretKey($cashfree_secret_key);
        $cashfree->setCurrency(self::globalCurrency());
        $cashfree->setEnv($cashfree_env); //true means sandbox, false means live , //env must set as boolean, string will not work
        $cashfree->setExchangeRate(self::inrConversionValue()); // if INR not set as currency

        return $cashfree;
    }
    public static function payfast(){

        $payfast_merchant_id = getenv('PF_MERCHANT_ID');
        $payfast_merchant_key = getenv('PF_MERCHANT_KEY');
        $payfast_passphrase = getenv('PAYFAST_PASSPHRASE');
        $payfast_env = getenv('PF_MERCHANT_ENV') === 'true';

        $payfast = XgPaymentGateway::payfast();
        $payfast->setMerchantId($payfast_merchant_id);
        $payfast->setMerchantKey($payfast_merchant_key);
        $payfast->setPassphrase($payfast_passphrase);
        $payfast->setCurrency(self::globalCurrency());
        $payfast->setEnv($payfast_env); //env must set as boolean, string will not work
        $payfast->setExchangeRate(self::zarConversionValue()); // if ZAR not set as currency
        return $payfast;
    }
    public static function midtrans(){

        $midtrans_env =  getenv('MIDTRANS_ENVAIRONTMENT') === 'true';
        $midtrans_server_key = getenv('MIDTRANS_SERVER_KEY');
        $midtrans_client_key = getenv('MIDTRANS_CLIENT_KEY');

        $midtrans = XgPaymentGateway::midtrans();
        $midtrans->setClientKey($midtrans_client_key);
        $midtrans->setServerKey($midtrans_server_key);
        $midtrans->setCurrency(self::globalCurrency());
        $midtrans->setEnv($midtrans_env); //true mean sandbox mode , false means live mode
        $midtrans->setExchangeRate(self::idrConversionValue()); // if IDR not set as currency
        return $midtrans;
    }

    public static function squareup(){

        $squareup_env =  !empty(get_static_option('squareup_test_mode'));
        $squareup_location_id = get_static_option('squareup_location_id');
        $squareup_access_token = get_static_option('squareup_access_token');
        $squareup_application_id = get_static_option('squareup_application_id');

        $squareup = XgPaymentGateway::squareup();
        $squareup->setLocationId($squareup_location_id);
        $squareup->setAccessToken($squareup_access_token);
        $squareup->setApplicationId($squareup_application_id);
        $squareup->setCurrency(self::globalCurrency());
        $squareup->setEnv($squareup_env);
        $squareup->setExchangeRate(self::usdConversionValue()); // if USD not set as currency

        return $squareup;
    }

    public static function cinetpay(){

        $cinetpay_env =  !empty(get_static_option('cinetpay_test_mode'));
        $cinetpay_site_id = get_static_option('cinetpay_site_id');
        $cinetpay_app_key = get_static_option('cinetpay_app_key');

        $cinetpay = XgPaymentGateway::cinetpay();
        $cinetpay->setAppKey($cinetpay_app_key);
        $cinetpay->setSiteId($cinetpay_site_id);
        $cinetpay->setCurrency(self::globalCurrency());
        $cinetpay->setEnv($cinetpay_env);
        $cinetpay->setExchangeRate(self::usdConversionValue()); // if ['XOF', 'XAF', 'CDF', 'GNF', 'USD'] not set as currency

        return $cinetpay;
    }

    public static function paytabs(){

        $paytabs_env =  !empty(get_static_option('paytabs_test_mode'));
        $paytabs_region = get_static_option('paytabs_region');
        $paytabs_profile_id = get_static_option('paytabs_profile_id');
        $paytabs_server_key = get_static_option('paytabs_server_key');

        $paytabs = XgPaymentGateway::paytabs();
        $paytabs->setProfileId($paytabs_profile_id);
        $paytabs->setRegion($paytabs_region);
        $paytabs->setServerKey($paytabs_server_key);
        $paytabs->setCurrency(self::globalCurrency());
        $paytabs->setEnv($paytabs_env);
        $paytabs->setExchangeRate(self::usdConversionValue()); // if ['AED','EGP','SAR','OMR','JOD','USD'] not set as currency

        return $paytabs;
    }
    public static function billplz(){

        $billplz_env =  !empty(get_static_option('billplz_test_mode'));
        $billplz_key =  get_static_option('billplz_key');
        $billplz_xsignature =  get_static_option('billplz_xsignature');
        $billplz_collection_name =  get_static_option('billplz_collection_name');

        $billplz = XgPaymentGateway::billplz();
        $billplz->setKey($billplz_key);
        $billplz->setVersion('v4');
        $billplz->setXsignature($billplz_xsignature);
        $billplz->setCollectionName($billplz_collection_name);
        $billplz->setCurrency(self::globalCurrency());
        $billplz->setEnv($billplz_env);
        $billplz->setExchangeRate(self::myrConversionValue()); // if ['MYR'] not set as currency

        return $billplz;
    }

    public static function zitopay(){

        $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
        $zitopay_username =  get_static_option('zitopay_username');

        $zitopay = XgPaymentGateway::zitopay();
        $zitopay->setUsername($zitopay_username);
        $zitopay->setCurrency(self::globalCurrency());
        $zitopay->setEnv($zitopay_env);
        $zitopay->setExchangeRate(self::usdConversionValue());
        return $zitopay;
    }

    private static function globalCurrency()
    {
        return get_static_option('site_global_currency');
    }

    private static function usdConversionValue()
    {
        return get_static_option('site_' . strtolower(self::globalCurrency()) . '_to_usd_exchange_rate');
    }
    private static function inrConversionValue()
    {
        return getenv('INR_EXCHANGE_RATE');
    }
    private static function ngnConversionValue()
    {
        return getenv('NGN_EXCHANGE_RATE');
    }
    private static function zarConversionValue()
    {
        return getenv('ZAR_EXCHANGE_RATE');
    }
    private static function brlConversionValue()
    {
        return getenv('BRL_EXCHANGE_RATE');
    }
    private static function idrConversionValue()
    {
        return getenv('IDR_EXCHANGE_RATE');
    }
    private static function myrConversionValue()
    {
        return getenv('MYR_EXCHANGE_RATE');
    }
}