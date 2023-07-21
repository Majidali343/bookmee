<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Billplz\Laravel\Billplz;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Base\PaymentGatewayHelpers;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\MyanmarCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;
use Billplz\Signature;
use Illuminate\Support\Str;

class BillPlzPay extends PaymentGatewayBase
{
    use CurrencySupport,MyanmarCurrencySupport,PaymentEnvironment;
    public $key;
    public $version;
    public $x_signature;
    public $collection_name;


    public function getCollectionName(){
        return $this->collection_name;
    }
    public function setCollectionName($collection_name){
        $this->collection_name = $collection_name;
        return $this;
    }

    public function getKey(){
        return $this->key;
    }
    public function setKey($key){
        $this->key = $key;
        return $this;
    }

    public function getVersion(){
        return $this->version;
    }
    public function setVersion($version){
        $this->version = $version;
        return $this;
    }

    public function getXsignature(){
        return $this->x_signature;
    }
    public function setXsignature($x_signature){
        $this->x_signature = $x_signature;
        return $this;
    }

    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $amount * 100;
        }
        return $this->get_amount_in_myr($amount);
    }

    public function ipn_response(array $args = [])
    {
        $signature = new Signature($this->getXsignature(), Signature::WEBHOOK_PARAMETERS);
        $x_signature = $signature->create(request()->all());

        $oder_id = Str::after(request()->get('name'),'ID#');
        if (hash_equals($x_signature,request()->get('x_signature')) && request()->get('paid') === 'true'){
            return $this->verified_data([
                'status' => 'complete',
                'transaction_id' => request()->id,
                'order_id' => substr( $oder_id,5,-5) ,
            ]);
        }
        return  ['status' => 'failed','order_id' => substr( $oder_id,5,-5) ];
    }
    public function charge_customer(array $args)
    {
        $this->setConfigration();
        try {
            $bill = Billplz::bill()->create(
                $this->getCollectionName(),
                $args['email'],
                $args['phone'] ?? '',
                $args['name'].' id#'.PaymentGatewayHelpers::wrapped_id($args['order_id']),
                $this->charge_amount($args['amount']),
                $args['ipn_url'],
                $args['description'],
                [
                    'redirect_url' =>  $args['success_url'],
                ]
            );
            $arry = $bill->toArray();
            Session::put('billplz_order_id',PaymentGatewayHelpers::wrapped_id($args['order_id']));
            return redirect()->to($arry['url']);
        }catch (\Exception $e){
            abort(501,$e->getMessage());
        }
    }

    public function supported_currency_list()
    {
        return  ['MYR'];
    }

    public function charge_currency()
    {
        return 'MYR';
    }

    public function gateway_name()
    {
        return 'billplz';
    }

    protected function setConfigration() : void
    {
       Config::set([
           'services.billplz.key' => $this->getKey(),
           'services.billplz.version' => $this->getVersion(),
           'services.billplz.x-signature' => $this->getXsignature(),
           'services.billplz.sandbox' => $this->getEnv(),
       ]);
    }
}
