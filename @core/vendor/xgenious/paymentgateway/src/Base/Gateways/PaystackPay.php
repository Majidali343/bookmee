<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Xgenious\Paymentgateway\Base\GlobalCurrency;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;


class PaystackPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport;

    protected $public_key;
    protected $secret_key;
    protected $merchant_email;

    public function setPublicKey($public_key){
        $this->public_key = $public_key;
        return $this;
    }
    public function getPublicKey(){
        return $this->public_key;
    }
    public function setSecretKey($secret_key){
        $this->secret_key = $secret_key;
        return $this;
    }
    public function getSecretKey(){
        return $this->secret_key;
    }
    public function setMerchantEmail($merchant_email){
        $this->merchant_email = $merchant_email;
        return $this;
    }
    public function getMerchantEmail(){
        return $this->merchant_email;
    }

    /**
     * @inheritDoc
     * @ https://github.com/unicodeveloper/laravel-paystack
     * @param int|float $amount
     */
    public function charge_amount($amount)
    {
        if (in_array($this->global_currency(), $this->supported_currency_list())){
            return $amount;
        }
        return $this->get_amount_in_ngn($amount);
    }

    protected  function get_amount_in_ngn($amount){
        if ($this->getCurrency() === 'NGN'){
            return $amount;
        }
        $payable_amount = $this->make_amount_in_ngn($amount, $this->getCurrency());
        if ($payable_amount < 1) {
            return $payable_amount . __('USD amount is not supported by '.$this->gateway_name());
        }
        return $payable_amount;
    }
    /**
     * convert amount to ngn currency base on conversation given by admin
     * */
    private function make_amount_in_ngn($amount, $currency)
    {
        $output = 0;
        $all_currency = GlobalCurrency::script_currency_list();
        foreach ($all_currency as $cur => $symbol) {
            if ($cur === 'NGN') {
                continue;
            }
            if ($cur === $currency) {
                $exchange_rate = $this->getExchangeRate();
                $output = $amount * $exchange_rate;
            }
        }

        return $output;
    }
    /**
     * @inheritDoc
     * @param array $args;
     * @return array ['status','type','order_id','transaction_id'];
     */
    public function ipn_response(array $args = [])
    {
        $this->setConfig();
        // $paystack_ipn_url = session()->get('paystack_ipn_url');
        // abort_unless(!empty($paystack_ipn_url),405,__('ipn route not found'));
        $paymentDetails = Paystack::getPaymentData();
        if ($paymentDetails['status']) {
            $meta_data = $paymentDetails['data']['metadata'];
            return $this->verified_data([
                'transaction_id' =>  $paymentDetails['data']['reference'],
                'type' => $meta_data['type'],
                'order_id' => substr( $meta_data['order_id'],5,-5),
                // 'ipn_url' => $paystack_ipn_url,
            ]);
        }
        return ['status' => 'failed'];
    }

    /**
     * @inheritDoc
     */
    public function charge_customer(array $args)
    {
        if($args['amount'] > 25000){
            return back()->with(['msg' => __('We could not process your request due to your amount is higher than the maximum.'),'type' => 'danger']);
        }
        $order_id =  random_int(12345,99999).$args['order_id'].random_int(12345,99999);
        $paystack_data['currency'] = $this->charge_currency();
        $paystack_data['price'] = $this->charge_amount($args['amount']);
        $paystack_data['package_name'] =  $args['title'];
        $paystack_data['name'] = $args['name'];
        $paystack_data['email'] = $args['email'];
        $paystack_data['order_id'] = $order_id;
        $paystack_data['track'] = $args['track'];
        $paystack_data['route'] = route('xg.payment.gateway.paystack');
        $paystack_data['type'] = $args['payment_type'] ?? 'random';
        $paystack_data['merchantEmail'] = $this->getMerchantEmail();
        $paystack_data['secretKey'] = $this->getSecretKey();
        $paystack_data['publicKey'] = $this->getPublicKey();

        return view('paymentgateway::paystack')->with(['paystack_data' => $paystack_data]);
    }

    /**
     * @inheritDoc
     */
    public function supported_currency_list()
    {
        return ['GHS','NGN'];
    }

    /**
     * @inheritDoc
     */
    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "NGN";
    }

    /**
     * @inheritDoc
     */
    public function gateway_name()
    {
        return 'paystack';
    }

    public function setConfig($config = []){
        config(array_merge($config,[
            'paystack.merchantEmail' => $this->getMerchantEmail(),
            'paystack.secretKey' => $this->getSecretKey(),
            'paystack.publicKey' => $this->getPublicKey(),
            'paystack.paymentUrl' => 'https://api.paystack.co',
        ]));
    }
}
