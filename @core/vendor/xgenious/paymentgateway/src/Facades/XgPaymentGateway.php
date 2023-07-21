<?php

namespace Xgenious\Paymentgateway\Facades;

use Illuminate\Support\Facades\Facade;
use Xgenious\Paymentgateway\Base\Gateways\InstamojoPay;
use Xgenious\Paymentgateway\Base\PaymentGatewayHelpers;
use Xgenious\Paymentgateway\Base\Gateways\SquarePay;
/**
 * @see GlobalCurrency
 * @method static script_currency_list()
 *
 * @see PaymentGatewayHelpers
 * @method static stripe()
 * @method static paypal()
 * @method static midtrans()
 * @method static paytm()
 * @method static razorpay()
 * @method static mollie()
 * @method static flutterwave()
 * @method static paystack()
 * @method static payfast()
 * @method static cashfree()
 * @method static instamojo()
 * @method static marcadopago()
 * @method static payumoney()
 * @method static squareup()
 * @method static cinetpay()
 * @method static paytabs()
 * @method static zitopay()
 * @method static toyyibpay()
 * @method static pagalipay()
 * @method static authorizenet()
 *
 *  @see InstamojoPay
 * @method public setClientId($client_id)
 */
class XgPaymentGateway extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'XgPaymentGateway';
    }
}
