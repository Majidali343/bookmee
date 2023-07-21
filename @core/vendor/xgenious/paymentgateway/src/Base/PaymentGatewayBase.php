<?php

namespace  Xgenious\Paymentgateway\Base;

abstract class PaymentGatewayBase
{
    protected $config;

    /**
     * @since 1.0.0
     * return how them amount need to charge
     * */
    abstract public function charge_amount($amount);
    /**
     * @since 1.0.0
     * handle payment gateway ipn response
     * */
    abstract public function ipn_response(array $args);
    /**
     * @since 1.0.0
     * return customer payment verified data
     * */

    public function verified_data($args) : array
    {
        return array_merge(['status' => 'complete'],$args);
    }
    /**
     * @since 1.0.0
     * charge customer account by this method
     * */
    abstract public function charge_customer(array $args);
    /**
     * @since 1.0.0
     * list of all supported currency by payment gateway
     * */
    abstract public function supported_currency_list();
    /**
     * charge_currency()
     * @since 1.0.0
     * get charge currency for payment gateway
     * */
    abstract public function charge_currency();
    /**
     * gateway_name()
     * @since 1.0.0
     * add payment gateway name
     * */
    abstract public function gateway_name();
    /**
     * global_currency()
     * @since 1.0.0
     * get global currency
     * */
    protected static function global_currency(){
        return config('paymentgateway.global_currency');
    }


}
