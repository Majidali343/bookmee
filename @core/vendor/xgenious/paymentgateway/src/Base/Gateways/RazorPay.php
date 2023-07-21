<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Http;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Razorpay\Api\Api;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\IndianCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class RazorPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport,IndianCurrencySupport;

    protected $api_key;
    protected $api_secret;

    public function setApiKey($api_key){
        $this->api_key = $api_key;
        return $this;
    }
    private function getApiKey(){
        return $this->api_key;
    }
    public function setApiSecret($api_secret){
        $this->api_secret = $api_secret;
        return $this;
    }
    private function getApiSecret(){
        return $this->api_secret;
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
            return $this->is_decimal($amount) ? $amount : $amount;
        }
        return $this->is_decimal( $this->get_amount_in_inr($amount)) ? $this->get_amount_in_inr($amount) : $this->get_amount_in_inr($amount);
    }


    /**
     * @required param list
     * */

    public function charge_customer($args)
    {
        $order_id = random_int(12345,99999).$args['order_id'].random_int(12345,99999);
        $razorpay_data['currency'] =  $this->charge_currency();
        $razorpay_data['price'] = $this->charge_amount($args['amount']);
        $razorpay_data['title'] = $args['title'];
        $razorpay_data['description'] = $args['description'];
        $razorpay_data['route'] = $args['ipn_url'];
        $razorpay_data['order_id'] = $order_id;
        $razorpay_data['api_key'] = $this->getApiKey();
        session()->put('razorpay_last_order_id',$order_id);

        abort_if(is_null($this->getApiKey()),405,'razorpay api key is missing');

        return view('paymentgateway::razorpay')->with('razorpay_data', $razorpay_data);
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

        $request = request();
        $razorpay_payment_id = request()->razorpay_payment_id;

        abort_if(is_null($this->getApiKey()),405,'razorpay api key is missing');
        abort_if(is_null($this->getApiSecret()),405,'razorpay api secret is missing');
        //get API Configuration
        //Fetch payment information by razorpay_payment_id
        $reponse = Http::withBasicAuth(
            $this->getApiKey(),
            $this->getApiSecret()
        )->get($this->baseApi(). 'payments/'.$razorpay_payment_id);

        if ($reponse->ok()){
            $res_object = $reponse->object();
            $amount = $res_object->amount;
            $currency =$this->getCurrency();

            if (in_array($res_object->status,['paid','authorized'])){
                return $this->verified_data([
                    'status' => 'complete',
                    'order_id' => substr( request()->order_id,5,-5),
                    'payment_amount' => $amount,
                ]);
            }
        }

        return ['status' => 'failed'];
    }

    /**
     * geteway_name();
     * return @string
     * */
    public function gateway_name(){
        return 'razorpay';
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
     * it will returl all of supported currency for the payment gateway
     * return array
     * */
    public function supported_currency_list(){
        return ['INR'];
    }

    public function baseApi(){
        return  'https://api.razorpay.com/v1/';
    }
}
