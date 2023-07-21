<?php

namespace Xgenious\Paymentgateway\Tests\Features;

use Xgenious\Paymentgateway\Base\GlobalCurrency;
use Xgenious\Paymentgateway\Tests\TestCase;

class CurrencyListTest extends TestCase
{
    public function testCurrencyList(){
        $currency_list = GlobalCurrency::script_currency_list();
        $this->assertTrue(is_array($currency_list),'all currency list with symbol as array '. print_r($currency_list,true));
    }
}