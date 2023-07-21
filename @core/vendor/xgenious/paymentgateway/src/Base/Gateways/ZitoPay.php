<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class ZitoPay extends PaymentGatewayBase
{
    use CurrencySupport,ConvertUsdSupport,PaymentEnvironment;
    protected $username;

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
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

        if (request()->has('ref')){
            $response = Http::acceptJson()->asForm()->post('https://zitopay.africa/api_v1',[
                "action" => 'get_transaction',
                'receiver' => $this->getUsername(),
                'ref' => request()->get('ref'),
                'trade_id' => 0
            ]);

            if ($response->ok()){
                $result = $response->object();
                if (!empty($result) && !property_exists($result,'error')){
                    if ($result->status_msg  === 'COMPLETED'){
                        return $this->verified_data([
                            'status' => $result->status_msg === 'COMPLETED' ? 'complete' : strtolower($result->status_msg),
                            'transaction_id' => request()->get('zitopay_transaction_reference'),
                            'order_id' =>  Str::of(request()->get('ref'))->after('#')->__toString() ,
                        ]);
                    }
                }
            }
        }
        return  ['status' => 'failed'];
    }

    public function charge_customer(array $args)
    {
        $args['username'] = $this->getUsername();
        $args['currency'] = $this->getCurrency();
        return view('paymentgateway::zitopay',compact('args'));
    }

    public function supported_currency_list()
    {
        return [
            "USD",
            "EUR",
            "GBP",
            "AED",
            "AFN",
            "ALL",
            "AMD",
            "ANG",
            "AOA",
            "ARS",
            "AUD",
            "AWG",
            "AZN",
            "BAM",
            "BBD",
            "BDT",
            "BGN",
            "BHD",
            "BIF",
            "BMD",
            "BND",
            "BOB",
            "BRL",
            "BSD",
            "BTN",
            "BWP",
            "BYN",
            "BZD",
            "CAD",
            "CDF",
            "CHF",
            "CLP",
            "CNY",
            "COP",
            "CRC",
            "CUP",
            "CVE",
            "CZK",
            "DJF",
            "DKK",
            "DOP",
            "DZD",
            "EGP",
            "ERN",
            "ETB",
            "FJD",
            "GEL",
            "GHS",
            "GMD",
            "GNF",
            "GTQ",
            "GYD",
            "HNL",
            "HRK",
            "HTG",
            "HUF",
            "IDR",
            "ILS",
            "INR",
            "IQD",
            "IRR",
            "ISK",
            "JMD",
            "JOD",
            "JPY",
            "KES",
            "KGS",
            "KHR",
            "KMF",
            "KPW",
            "KRW",
            "KWD",
            "KZT",
            "LAK",
            "LBP",
            "LKR",
            "LRD",
            "LSL",
            "LTL",
            "LVL",
            "LYD",
            "MAD",
            "MDL",
            "MGA",
            "MKD",
            "MMK",
            "MNT",
            "MRO",
            "MUR",
            "MVR",
            "MWK",
            "MXN",
            "MYR",
            "MZN",
            "NAD",
            "NGN",
            "NIO",
            "NOK",
            "NPR",
            "NZD",
            "OMR",
            "PAB",
            "PEN",
            "PGK",
            "PHP",
            "PKR",
            "PLN",
            "PYG",
            "QAR",
            "RON",
            "RSD",
            "RUB",
            "RWF",
            "SAR",
            "SCR",
            "SDG",
            "SEK",
            "SGD",
            "SLL",
            "SOS",
            "SRD",
            "STD",
            "SVC",
            "SYP",
            "SZL",
            "THB",
            "TJS",
            "TMT",
            "TND",
            "TOP",
            "TRY",
            "TTD",
            "TWD",
            "TZS",
            "UAH",
            "UGX",
            "UYU",
            "UZS",
            "VEF",
            "VND",
            "VUV",
            "WST",
            "XCD",
            "XOF",
            "YER",
            "ZAR",
            "ZMW",
            "ZWD",
            "XAF",
        ];
    }
    public function charge_currency()
    {
        return "USD";
    }

    public function gateway_name()
    {
        return 'zitopay';
    }
}
