<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'event-paypal-ipn',
        'event-paytm-ipn',


        'admin-home/update-static-option',
        'admin-home/get-static-option',
        'admin-home/set-static-option',
        'contribution-paytm-ipn',


        'subscription/paytm/ipn',
        'subscription/payfast-ipn',
        'subscription/cinetpay-ipn',
        'subscription/zitopay-ipn',
        'subscription/paytabs-ipn',


        'buyer/paytm-ipn',
        'buyer/cashfree-ipn',
        'buyer/payfast-ipn',
        'buyer/cinetpay-ipn',
        'buyer/zitopay-ipn',
        'buyer/paytabs-ipn',


        'cashfree/ipn',
        'cinetpay-ipn',
        'paypal/ipn',
        'paytm/ipn',
        'payfast-ipn',
        'zitopay-ipn',
        'paytabs-ipn',

        'jobpost/cashfree-ipn',
    ];
}
