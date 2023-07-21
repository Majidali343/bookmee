<?php

namespace Xgenious\Paymentgateway\Traits;

use Xgenious\Paymentgateway\Base\GlobalCurrency;

trait ZarCurrencySupport
{
    protected  function get_amount_in_zar($amount){
        if ($this->getCurrency() === 'ZAR'){
            return $amount;
        }
        $payable_amount = $this->make_amount_in_zar($amount, $this->getCurrency());
        if ($payable_amount < 1) {
            return $payable_amount . __('amount is not supported by '.$this->gateway_name());
        }
        return $payable_amount;
    }
    protected function make_amount_in_zar($amount,$currency){
        $output = 0;
        $all_currency = GlobalCurrency::script_currency_list();
        foreach ($all_currency as $cur => $symbol) {
            if ($cur === 'ZAR') {
                continue;
            }
            if ($cur == $currency) {
                $exchange_rate = $this->getExchangeRate();
                $output = $amount * $exchange_rate ;
            }
        }

        return $output;
    }
}
