<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use  Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\CreateOrderRequest;
use Square\Models\CreateCheckoutRequest;
use Square\Models\Order;
use Square\Models\OrderLineItem;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class SquarePay extends PaymentGatewayBase
{

    use PaymentEnvironment, CurrencySupport;

    protected $application_id;
    protected $access_token;
    protected $location_id;

    public function setApplicationId($application_id)
    {
        $this->application_id = $application_id;
        return $this;
    }

    public function getApplicationId()
    {
        return $this->application_id;
    }

    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
        return $this;
    }

    public function getLocationId()
    {
        return $this->location_id;
    }

    /**
     * this payment gateway will not work without this package
     * @https://github.com/stripe/stripe-php
     * @since .0.01
     * */
    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())) {
            return $amount * 100;
        }
        return $amount * 100;
    }

    /**
     *
     * @param array $args
     * required param list
     *
     * @return string[]
     * @since 0.0.1
     */
    public function ipn_response(array $args = []): array
    {

        $square_order_id = session()->get('square_order_id');
        session()->forget('square_order_id');

        $client = $this->setConfig();
        $transaction_id = \request()->get('transactionId');
        try {
            $orders_api = $client->getOrdersApi();
            $response = $orders_api->retrieveOrder($transaction_id);
        } catch (ApiException $e) {
            // If an error occurs, output the message
            echo 'Caught exception!<br/>';
            echo '<strong>Response body:</strong><br/>';
            echo '<pre>';
            var_dump($e->getResponseBody());
            echo '</pre>';
            echo '<br/><strong>Context:</strong><br/>';
            echo '<pre>';
            var_dump($e->getContext());
            echo '</pre>';
            exit();
        }

// If there was an error with the request we will
// print them to the browser screen here
        if ($response->isError()) {
            echo 'Api response has Errors';
            $errors = $response->getErrors();
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>❌ ' . $error->getDetail() . '</li>';
            }
            echo '</ul>';
            exit();
        } else {
            $order = $response->getResult()->getOrder();
            if($order->getState() === 'COMPLETED'){

                return $this->verified_data([
                    'transaction_id' => $order->getId(),
                    'order_id' => $square_order_id
                ]);
            }
        }
        return ['status' => 'failed'];
    }

    /**
     *
     * @param array $args
     * required param list
     *
     * product_name
     * amount
     * description
     * ipn_url
     * cancel_url
     * order_id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @since 0.0.1
     */
    public function charge_customer(array $args)
    {
        $client = $this->setConfig();
        $location_id =  $this->getLocationId();

        try {
            $checkout_api = $client->getCheckoutApi();
            $currency = $client->getLocationsApi()->retrieveLocation($location_id)->getResult()->getLocation()->getCurrency();
            $money_A = new Money();
            $money_A->setCurrency($this->getCurrency());
            $money_A->setAmount(round($this->charge_amount($args['amount']),2));

            $item_A = new OrderLineItem(1);
            $item_A->setName($args['title']);
            $item_A->setBasePriceMoney($money_A);

            // Create a new order and add the line items as necessary.
            $order = new Order($location_id);
            $order->setLineItems([$item_A]);
            $create_order_request = new CreateOrderRequest();
            $create_order_request->setOrder($order);

            // Similar to payments you must have a unique idempotency key.
            $checkout_request = new CreateCheckoutRequest(uniqid(), $create_order_request);
            // Set a custom redirect URL, otherwise a default Square confirmation page will be used
            $checkout_request->setRedirectUrl($args['ipn_url']);
            session()->put('square_order_id', $args['order_id']);
            $response = $checkout_api->createCheckout($location_id, $checkout_request);
        } catch (ApiException $e) {
            // If an error occurs, output the message
            abort(401,$e->getResponseBody().' '.$e->getContext());
        }

        if ($response->isError()) {
            echo 'Api response has Errors';
            $errors = $response->getErrors();
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>❌ ' . $error->getDetail() . '</li>';
            }
            echo '</ul>';
            exit();
        }

        return redirect()->away($response->getResult()->getCheckout()->getCheckoutPageUrl());
    }

    private function setConfig(){
        $client = new SquareClient([
            'accessToken' => $this->getAccessToken(),
            'environment' => $this->getEnv() ? 'sandbox' : 'production', //Environment::PRODUCTION,
        ]);
        return $client;
    }

    /**
     * this will refund payment gateway charge currency
     * @since 0.0.1
     * */
    public function supported_currency_list(): array
    {
        return [
            "AUD",
            "CAD",
            "EUR",
            "GBP",
            "JPY",
            "USD",
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
            "BOV",
            "BRL",
            "BSD",
            "BTN",
            "BWP",
            "BYR",
            "BZD",
            "CAD",
            "CDF",
            "CHE",
            "CHF",
            "CHW",
            "CLF",
            "CLP",
            "CNY",
            "COP",
            "COU",
            "CRC",
            "CUC",
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
            "EUR",
            "FJD",
            "FKP",
            "GBP",
            "GEL",
            "GHS",
            "GIP",
            "GMD",
            "GNF",
            "GTQ",
            "GYD",
            "HKD",
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
            "KYD",
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
            "MOP",
            "MRO",
            "MUR",
            "MVR",
            "MWK",
            "MXN",
            "MXV",
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
            "SBD",
            "SCR",
            "SDG",
            "SEK",
            "SGD",
            "SHP",
            "SLL",
            "SOS",
            "SRD",
            "SSP",
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
            "USD",
            "USN",
            "USS",
            "UYI",
            "UYU",
            "UZS",
            "VEF",
            "VND",
            "VUV",
            "WST",
            "XAF",
            "XAG",
            "XAU",
            "XBA",
            "XBB",
            "XBC",
            "XBD",
            "XCD",
            "XDR",
            "XOF",
            "XPD",
            "XPF",
            "XPT",
            "XTS",
            "XXX",
            "YER",
            "ZAR",
            "ZMK",
            "ZMW",
            "BTC",
        ];
    }

    /**
     * this will refund payment gateway charge currency
     * */
    public function charge_currency()
    {
        return $this->getCurrency();
    }

    /**
     * this will refund payment gateway name
     * */
    public function gateway_name(): string
    {
        return 'squareup';
    }
}
