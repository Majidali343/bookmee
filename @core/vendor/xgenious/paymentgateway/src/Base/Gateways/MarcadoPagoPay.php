<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use phpDocumentor\Reflection\Types\Parent_;
use Xgenious\Paymentgateway\Base\GlobalCurrency;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class MarcadoPagoPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport;

    protected $client_id;
    protected $client_secret;

    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list(), true)){
            return $amount;
        }
        return $this->get_amount_in_brl($amount);
    }

    /**
     * get_amount_in_brl()
     * @since 1.0.0
     * this function return any amount to usd based on user given currency conversation value,
     * it will not work if admin did not give currency conversation rate
     * */
    protected  function get_amount_in_brl($amount){
        if ($this->getCurrency() === 'BRL'){
            return $amount;
        }
        $payable_amount = $this->make_amount_in_brl($amount, $this->getCurrency());
        if ($payable_amount < 1) {
            return $payable_amount . __('amount is not supported by '.$this->gateway_name());
        }
        return $payable_amount;
    }

    /**
     * convert amount to brl currency base on conversation given by admin
     * */
    protected  function make_amount_in_brl($amount,$currency){
        $output = 0;
        $all_currency = GlobalCurrency::script_currency_list();
        foreach ($all_currency as $cur => $symbol) {
            if ($cur === 'BRL') {
                continue;
            }
            if ($cur == $currency) {
                $exchange_rate = !empty($this->getExchangeRate()) ? $this->getExchangeRate() : config('paymentgateway.brl_exchange_rate');
                $output = $amount * $exchange_rate ;
            }
        }
        return $output;
    }

    public function ipn_response(array $args = [])
    {
        $this->setAccessToken();
        $request = request();
        $return_status = $request->status;
        $return_merchant_order_id = $request->merchant_order_id;
        $return_payment_id = $request->payment_id;
        $payment_details = \MercadoPago\Payment::find_by_id($return_payment_id);
        $order_id = $payment_details->order->id;
        $payment_status = $payment_details->status;
        $payment_metadata =$payment_details->metadata;
        $payment_metadata_order_id =$payment_details->metadata->order_id;

        if ($return_status === $payment_status && $return_merchant_order_id === $order_id){
            return $this->verified_data([
                'transaction_id' => $return_payment_id,
                'order_id' => substr($payment_metadata_order_id,5,-5)
            ]);
        }
        return ['status' => 'failed'];
    }

    public function charge_customer(array $args)
    {

        $charge_amount = $this->charge_amount($args['amount']);
        $order_id =  random_int(01234,99999).$args['order_id'].random_int(01234,99999);
        $this->setAccessToken();
        $preference = new \MercadoPago\Preference();
        # Building an item
        $item = new \MercadoPago\Item();
        $item->id = $order_id;
        $item->title = $args['title'];
        $item->quantity = 1;
        $item->unit_price = $charge_amount;

        $preference->items = array($item);

        $preference->back_urls = array(
            "success" => $args['ipn_url'],
            "failure" => $args['cancel_url'],
            "pending" => $args['cancel_url']
        );
        $preference->auto_return = "approved";
        $preference->metadata = array(
            "order_id" => $order_id,
        );
        $preference->save(); # Save the preference and send the HTTP Request to create

        return  redirect()->away($preference->init_point);

    }
    protected function setAccessToken(){
        return \MercadoPago\SDK::setAccessToken($this->getClientSecret());
    }

    public function supported_currency_list()
    {
        return ['BRL','ARS','BOB','CLF','CLP','COP','CRC','CUC','CUP','DOP','EUR','GTQ','HNL','MXN','NIO','PAB','PEN','PYG','USD','UYU','VEF','VES'];
    }

    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "BRL";
    }

    /* set app secret */
    public function setClientSecret($client_secret){
        $this->client_secret = $client_secret;
        return $this;
    }
    /* get app id */
    private function getClientSecret(){
        return  $this->client_secret;
    }
    /* get app id */
    private function getClientId(){
        return  $this->client_id ;
    }
    /* set app id */
    public function setClientId($client_id){
        $this->client_id = $client_id;
        return $this;
    }

    public function gateway_name()
    {
       return 'mercadopago';
    }
}
