<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Billplz\Laravel\Billplz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Base\PaymentGatewayHelpers;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\MyanmarCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;
use Billplz\Signature;
use Illuminate\Support\Str;

class PagaliPay extends PaymentGatewayBase
{
    use CurrencySupport,ConvertUsdSupport,PaymentEnvironment;
    public $pageId;
    public $entityId;


    public function getPageId(){
        return $this->pageId;
    }
    public function setPageId($pageId){
        $this->pageId = $pageId;
        return $this;
    }

    public function getEntityId(){
        return $this->entityId;
    }
    public function setEntityId($entityId){
        $this->entityId = $entityId;
        return $this;
    }

    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $amount;
        }
        return $this->get_amount_in_usd($amount);
    }

    public function ipn_response(array $args = [])
    {
        //todo:: write code for verify payment
        $payment_status = request()->payment_status;
        $order_id = request()->order_id;
        $get_host = parse_url(request()->headers->get('referer'), PHP_URL_HOST);
        if ($payment_status === 'Completed'){
            request()->getUri();
            return $this->verified_data([
                'status' => 'complete',
                'order_id' => substr( request()->order_id,5,-5)
            ]);
        }
        return ['status' => 'failed','order_id' => substr( request()->order_id,5,-5)];
    }

    public function pagali_view($args){
        return view('paymentgateway::pagali', ['pagali_data' => array_merge($args,[
            'order_id' => PaymentGatewayHelpers::wrapped_id($args['order_id']),
            'page_id' => $this->getPageId(),
            'currency' => $this->getCurrency(),
            'entity_id' => $this->getEntityId(),
            'charge_amount' => $this->charge_amount($args['amount']),
        ])]);
    }

    /**
     * @throws \Exception
     */
    public function charge_customer(array $args)
    {
        $order_id =  PaymentGatewayHelpers::wrapped_id($args['order_id']);
        //build the argument for pagali blade file
        return $this->pagali_view($args);
    }

    public function supported_currency_list()
    {
        return  ['MYR','USD','EUR','CVE'];
    }

    public function charge_currency()
    {
        return 'USD';
    }

    public function gateway_name()
    {
        return 'pagali';
    }
}
