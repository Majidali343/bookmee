<?php

namespace Xgenious\Paymentgateway\Tests\Features;

use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Xgenious\Paymentgateway\Tests\TestCase;

class StripeTest extends TestCase
{
//    public function testCustomerCharge(){
//
//    }
//    public function testIpn(){
//
//    }
    public function testSetCredentials(){
        $stripe  = XgPaymentGateway::stripe();
//        $stripe->se
    }
}