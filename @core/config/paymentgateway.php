<?php
/**
 * paymentgateway package config file
 */
return [
    // Place your package's config settings here.
    'stripe' => [
        'secret_key' => env('STRIPE_SECRET_KEY',null),
        'public_key' => env('STRIPE_PUBLIC_KEY',null)
    ],
    'paypal' =>[
        'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
        'sandbox' => [
            'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
            'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
            'app_id'            => env('PAYPAL_SANDBOX_APP_ID', ''),
        ],
        'live' => [
            'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
            'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
            'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
        ],

        'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
        'currency'       => env('SITE_GLOBAL_CURRENCY', 'USD'),
        'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
        'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
        'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
    ],
    'midtrans' => [
        'merchant_id' =>   env('MIDTRANS_MERCHANT_ID', null),
        'server_key' =>   env('MIDTRANS_SERVER_KEY', null),
        'client_key' =>   env('MIDTRANS_CLIENT_KEY', null),
        'envaironment' =>   env('MIDTRANS_ENVAIRONTMENT', false) // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    ],
    'paytm' => [
        'env' => env('PAYTM_ENVIRONMENT','local'), // values : (local | production)
        'merchant_id' => env('PAYTM_MERCHANT_ID'),
        'merchant_key' => env('PAYTM_MERCHANT_KEY'),
        'merchant_website' => env('PAYTM_MERCHANT_WEBSITE'),
        'channel' => env('PAYTM_CHANNEL'),
        'industry_type' => env('PAYTM_INDUSTRY_TYPE'),
    ],
    'razorpay' => [
        'api_key' => env('RAZORPAY_API_KEY',null),
        'api_secret' => env('RAZORPAY_API_SECRET',null),
    ],
    'mollie' => [
      'public_key' => env('MOLLIE_KEY',null)
    ],
    'flutterwave' => [
        'public_key' => env('FLW_PUBLIC_KEY',null),
        'secret_key' => env('FLW_SECRET_KEY',null),
        'secret_hash' => env('FLW_SECRET_HASH','abcd'),
    ],
    'paystack' => [
        'public_key' => env('PAYSTACK_PUBLIC_KEY',null),
        'secret_key' => env('PAYSTACK_SECRET_KEY',null),
        'payment_url' => env('PAYSTACK_PAYMENT_URL','https://api.paystack.co'),
        'merchant_email' => env('MERCHANT_EMAIL',''),
    ],
    'payfast' => [
        'merchant_id' => env('PF_MERCHANT_ID'),
        'merchant_key' => env('PF_MERCHANT_KEY'),
        'passpharse' => env('PAYFAST_PASSPHRASE'),
        'environment' => env('PF_MERCHANT_ENV',true),
        'PF_ITN_URL' => env('PF_ITN_URL',null)
    ],
    'cashfree' => [
        'test_mode' => env('CASHFREE_TEST_MODE','true'),
        'app_id' => env('CASHFREE_APP_ID'),
        'secret_key' => env('CASHFREE_SECRET_KEY'),
    ],
    'instamojo' => [
      'client_id' => env('INSTAMOJO_CLIENT_ID'),
      'client_secret' => env('INSTAMOJO_CLIENT_SECRET'),
      'test_mode' => env('INSTAMOJO_TEST_MODE',true),
    ],
    'mercadopago' => [
      'client_id' => env('MERCADO_PAGO_CLIENT_ID'),
      'client_secret' => env('MERCADO_PAGO_CLIENT_SECRET'),
      'test_mode' => env('MERCADO_PAGO_TEST_MODE',true),
    ],
    'global_currency' => env('SITE_GLOBAL_CURRENCY','USD'),
    'ngn_exchange_rate' => env('NGN_EXCHANGE_RATE',null),
    'inr_exchange_rate' => env('INR_EXCHANGE_RATE',null),
    'usd_exchange_rate' => env('USD_EXCHANGE_RATE',null),
    'idr_exchange_rate' => env('IDR_EXCHANGE_RATE',null),
    'zar_exchange_rate' => env('ZAR_EXCHANGE_RATE',null),
    'brl_exchange_rate' => env('BRL_EXCHANGE_RATE',null)
];