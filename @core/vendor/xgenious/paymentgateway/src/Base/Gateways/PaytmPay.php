<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\IndianCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class PaytmPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport,IndianCurrencySupport;
    protected $merchant_id;
    protected $merchant_key;
    protected $merchant_website;
    protected $channel;
    protected $industry_type;

    public function setMerchantId($merchant_id){
        $this->merchant_id = $merchant_id;
        return $this;
    }
    public function getMerchantId(){
        return $this->merchant_id;
    }
    public function setMerchantKey($merchant_key){
        $this->merchant_key = $merchant_key;
        return $this;
    }
    public function getMerchantKey(){
        return $this->merchant_key;
    }
    public function setMerchantWebsite($merchant_website){
        $this->merchant_website = $merchant_website;
        return $this;
    }
    public function getMerchantWebsite(){
        return $this->merchant_website;
    }
    public function setChannel($channel){
        $this->channel = $channel;
        return $this;
    }
    public function getChannel(){
        return $this->channel;
    }
    public function setIndustryType($industry_type){
        $this->industry_type = $industry_type;
        return $this;
    }
    public function getIndustryType(){
        return $this->industry_type;
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
        return $this->get_amount_in_inr($amount);
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
     *
     * @throws \Exception
     */

    public function charge_customer($args)
    {
        $charge_amount = $this->charge_amount($args['amount']);
        $order_id =  random_int(11111,99999).$args['order_id'].random_int(11111,99999);
        $payment = $this->createReceiveDriver();
        $payment->prepare([
            'order' => $order_id,
            'user' => Str::slug($args['name']),
            'mobile_number' => random_int(99999999, 99999999),
            'email' => $args['email'],
            'amount' => number_format((float) $charge_amount, 2, '.', ''),
            'callback_url' => $args['ipn_url']
        ]);
        return $payment->receive();
    }
    protected function createReceiveDriver(){

        return $this->buildProvider(
            'Anand\LaravelPaytmWallet\Providers\ReceivePaymentProvider',
            [
                'env' => $this->getEnv() ? 'local': 'production', //env('PAYTM_ENVIRONMENT','local'), // values : (local | production)
                'merchant_id' => $this->getMerchantId(),// env('PAYTM_MERCHANT_ID'),
                'merchant_key' => $this->getMerchantKey(),// env('PAYTM_MERCHANT_KEY'),
                'merchant_website' => $this->getMerchantWebsite(),// env('PAYTM_MERCHANT_WEBSITE'),
                'channel' =>  $this->getChannel(),//env('PAYTM_CHANNEL'),
                'industry_type' => $this->getIndustryType(),//env('PAYTM_INDUSTRY_TYPE'),
            ]
        );
    }
    public function buildProvider($provider, $config){
        return new $provider(
            request(),
            $config
        );
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

        $order_id = request()->get('ORDERID');
        $transaction = $this->createReceiveDriver();
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        if ($transaction->isSuccessful()) {

            return $this->verified_data([
                'transaction_id' => $response['TXNID'],
                'order_id' => substr($order_id,5,-5)
            ]);

        }
        return ['status' => 'failed'];
    }

    /**
     * geteway_name();
     * return @string
     * */
    public function gateway_name(){
        return 'paytm';
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
        return  "INR";
    }
    /**
     * supported_currency_list();
     * it will return all of supported currency for the payment gateway
     * return array
     * */
    public function supported_currency_list(){
        return ['INR'];
    }

}
