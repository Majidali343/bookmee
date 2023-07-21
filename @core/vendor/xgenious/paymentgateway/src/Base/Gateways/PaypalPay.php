<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Config;
use Xgenious\Paymentgateway\Base\GlobalCurrency;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class PaypalPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport,ConvertUsdSupport;
    protected $client_id;
    protected $client_secret;
    protected $app_id;

    /* get app id */
    private function getAppId(){
        return  $this->app_id;
    }
    /* set app id */
    public function setAppId($app_id){
        $this->app_id = $app_id;
        return $this;
    }
    /* set app id */
    public function setClientId($client_id){
        $this->client_id = $client_id;
        return $this;
    }
    /* set app secret */
    public function setClientSecret($client_secret){
        $this->client_secret = $client_secret;
        return $this;
    }
    /* get app id */
    private function getClientId(){
        return  $this->client_id;
    }
    /* get secret key */
    private function getClientSecret(){
        return $this->client_secret;
    }
    /*
    * charge_amount();
    * @required param list
    * $amount
    *
    *
    * */
    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $amount;
        }
        return $this->get_amount_in_usd($amount);
    }


    protected function getPaymentProvider($args){
        Config::set([
            'paypal.mode'    => $this->getEnv() ? 'sandbox' : 'live',
            'paypal.sandbox' => [
                'client_id'         => $this->getClientId(),
                'client_secret'     => $this->getClientSecret(),
                'app_id'            => $this->getAppId(),
            ],
            'paypal.live' => [
                'client_id'         => $this->getClientId(),
                'client_secret'     => $this->getClientSecret(),
                'app_id'            => $this->getAppId(),
            ],
            'paypal.payment_action' => 'Sale',
            'paypal.currency'       => $this->charge_currency(),
            'paypal.notify_url'     => $args['ipn_url'],
            'paypal.locale'         => app()->getLocale(),
            'paypal.validate_ssl'   => true,
        ]);
        $provider = new PayPalClient;
        $access_token = $provider->getAccessToken();

        abort_if(isset($access_token['type'])  && $access_token['type'] === 'error',405,$access_token['message'] ?? '');
        $provider->setAccessToken($access_token);
        return $provider;
    }
    /**
     * @required param list
     * $args['amount']
     * $args['description']
     * $args['item_name']
     * $args['ipn_url']
     * $args['cancel_url']
     * $args['payment_track']
     * return redirect url for paypal
     * */

    public function charge_customer($args)
    {
       $provider = $this->getPaymentProvider($args);

        $order = $provider->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                0 => [
                    "amount"=> [
                        "currency_code"=> $this->charge_currency(),
                        "value"=> number_format($this->charge_amount($args['amount']), 2, ".", "")
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => $args['cancel_url'],
                'return_url' => $args['ipn_url']
            ]
        ]);

        // throw exception
        abort_if(isset($order['type'])  && $order['type'] === 'error',405,$order['message'] ?? '');
        $order_id = $order['id'];
        session()->put('paypal_order_id',$order_id);
        session()->put('paypal_ipn_url',$args['ipn_url']);
        session()->put('paypal_cancel_url',$args['cancel_url']);
        session()->put('script_order_id', $args['order_id']);
        $redirect_url = $order['links'][1]['href'];
        return redirect($redirect_url)->send();
    }


    /**
     * @required param list
     * $args['request']
     * $args['cancel_url']
     * $args['success_url']
     *
     * return @void
     * */
    public function ipn_response($args = []){

        /** Get the payment ID before session clear **/
        $payment_id = session()->get('paypal_order_id');
        $script_order_id = session()->get('script_order_id');
        $paypal_ipn_url = session()->get('paypal_ipn_url');
        $paypal_cancel_url = session()->get('paypal_cancel_url');
        $request = request();
        /** clear the session payment ID **/
        session()->forget(['paypal_order_id','script_order_id','paypal_cancel_url','paypal_ipn_url']);

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return abort(404);
        }

        $provider = $this->getPaymentProvider(['ipn_url' => $paypal_ipn_url]);
        $order_details = $provider->capturePaymentOrder($payment_id);
        if (isset($order_details['status']) && $order_details['status'] === 'COMPLETED') {
            return $this->verified_data([
                'transaction_id' => $payment_id,
                'order_id' => $script_order_id
            ]);
        }
        return redirect()->to($paypal_cancel_url);
    }

    /**
     * geteway_name();
     * return @string
     * */
    public function gateway_name(){
        return 'paypal';
    }
    /**
     * charge_currency();
     * return @string
     * */
    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "USD";
    }
    /**
     * supported_currency_list();
     * it will returl all of supported currency for the payment gateway
     * return array
     * */
    public function supported_currency_list(){
        return ['USD'];//['AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'INR', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK', 'PHP', 'PLN', 'GBP', 'RUB', 'SGD', 'SEK', 'CHF', 'THB', 'USD'];
    }
}
