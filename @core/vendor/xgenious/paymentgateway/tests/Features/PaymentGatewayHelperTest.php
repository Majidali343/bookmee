<?php

namespace Xgenious\Paymentgateway\Tests\Features;

use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Xgenious\Paymentgateway\Tests\TestCase;

class PaymentGatewayHelperTest extends TestCase
{
    public function testPaymentGatewayList(){
        $currency_list = XgPaymentGateway::all_payment_gateway_list();
        $this->assertTrue(is_array($currency_list),'all payment gateawy list as array '. print_r($currency_list,true));
    }
}