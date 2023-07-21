<?php

namespace Xgenious\Paymentgateway\Base;

use Xgenious\Paymentgateway\Base\Gateways\AuthorizeDotNetPay;
use Xgenious\Paymentgateway\Base\Gateways\BillPlzPay;
use Xgenious\Paymentgateway\Base\Gateways\CashFreePay;
use Xgenious\Paymentgateway\Base\Gateways\CinetPay;
use Xgenious\Paymentgateway\Base\Gateways\FlutterwavePay;
use Xgenious\Paymentgateway\Base\Gateways\InstamojoPay;
use Xgenious\Paymentgateway\Base\Gateways\MidtransPay;
use Xgenious\Paymentgateway\Base\Gateways\MolliePay;
use Xgenious\Paymentgateway\Base\Gateways\PagaliPay;
use Xgenious\Paymentgateway\Base\Gateways\PayFastPay;
use Xgenious\Paymentgateway\Base\Gateways\PaypalPay;
use Xgenious\Paymentgateway\Base\Gateways\PaystackPay;
use Xgenious\Paymentgateway\Base\Gateways\PayTabsPay;
use Xgenious\Paymentgateway\Base\Gateways\PaytmPay;
use Xgenious\Paymentgateway\Base\Gateways\PayUmoneyPay;
use Xgenious\Paymentgateway\Base\Gateways\RazorPay;
use Xgenious\Paymentgateway\Base\Gateways\SquarePay;
use Xgenious\Paymentgateway\Base\Gateways\StripePay;
use Xgenious\Paymentgateway\Base\Gateways\MarcadoPagoPay;
use Xgenious\Paymentgateway\Base\Gateways\Toyyibpay;
use Xgenious\Paymentgateway\Base\Gateways\ZitoPay;

/**
 * @see SquarePay
 * @method  setApplicationId();
 * @method  setAccessToken();
 * @method  setLocationId();
 */

class PaymentGatewayHelpers
{

    public function stripe() : StripePay
    {
        return new StripePay();
    }
    public function paypal() : PaypalPay
    {
        return new PaypalPay();
    }
    public function midtrans() : MidtransPay
    {
        return new MidtransPay();
    }
    public function paytm() : PaytmPay
    {
        return new PaytmPay();
    }
    public function razorpay() : RazorPay
    {
        return new RazorPay();
    }
    public function mollie() : MolliePay
    {
        return new MolliePay();
    }
    public function flutterwave() : FlutterwavePay
    {
        return new FlutterwavePay();
    }
    public function paystack() : PaystackPay
    {
        return new PaystackPay();
    }

    public function payfast() : PayFastPay
    {
        return new PayFastPay();
    }
    public function cashfree() : CashFreePay
    {
        return new CashFreePay();
    }
    public function instamojo() : InstamojoPay
    {
        return new InstamojoPay();
    }
    public function marcadopago() : MarcadoPagoPay
    {
        return new MarcadoPagoPay();
    }
    public function payumoney() : PayUmoneyPay
    {
        return new PayUmoneyPay();
    }
    public function squareup() : SquarePay
    {
        return new SquarePay();
    }
    public function cinetpay() : CinetPay
    {
        return new CinetPay();
    }
    public function paytabs() : PayTabsPay
    {
        return new PayTabsPay();
    }
    public function billplz() : BillPlzPay
    {
        return new BillPlzPay();
    }

    public function zitopay() : ZitoPay
    {
        return new ZitoPay();
    }
    public function toyyibpay() : Toyyibpay
    {
        return new Toyyibpay();
    }
    public function pagalipay() : PagaliPay
    {
        return new PagaliPay();
    }
    public function authorizenet() : AuthorizeDotNetPay
    {
        return new AuthorizeDotNetPay();
    }
    public function all_payment_gateway_list() : array
    {
        return [
            'zitopay','billplz','paytabs','cinetpay','squareup',
            'mercadopago','instamojo','cashfree','payfast',
            'paystack','flutterwave','mollie','razopay','paytm',
            'midtrans','paypal','stripe','toyyibpay','pagali','authorizenet'
//            'payumoney',
        ];
    }
    public function script_currency_list(){
        return GlobalCurrency::script_currency_list();
    }

    public static function wrapped_id($id) : string
    {
        return random_int(11111,99999).$id.random_int(11111,99999);
    }
    public static function unwrapped_id($id) : string
    {
        return substr($id,5,-5);
    }
    public static function get_current_file_url($Protocol='http://') {
        return $Protocol.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(__DIR__));
    }
}
