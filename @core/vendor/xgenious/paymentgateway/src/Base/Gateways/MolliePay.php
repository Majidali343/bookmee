<?php

namespace Xgenious\Paymentgateway\Base\Gateways;
use Illuminate\Support\Facades\Config;
use Mollie\Laravel\Facades\Mollie;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class MolliePay extends PaymentGatewayBase
{
    protected $api_key;


    public function setApiKey($key){
        $this->api_key = $key;
        return $this;
    }

    public function getApiKey(){
        return $this->api_key;
    }

    use PaymentEnvironment,CurrencySupport,ConvertUsdSupport;
    /**
     * to work this payment gateway you must have this laravel package
     * https://github.com/mollie/laravel-mollie
     * */
    /**
     * @inheritDoc
     */
    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $amount;
        }
        return $this->get_amount_in_usd($amount);
    }

    /**
     * @inheritDoc
     * return array('status','transaction_id','order_id');
     */
    public function ipn_response(array $args = [])
    {
        $this->setConfig();
        $payment_id = session()->get('mollie_payment_id');
        $payment = Mollie::api()->payments->get($payment_id);
        session()->forget('mollie_payment_id');

        if ($payment->isPaid()) {
            return $this->verified_data([
                'status' => 'complete',
                'transaction_id' => $payment->id,
                'order_id' =>  substr($payment->metadata->order_id,5,-5)
            ]);
        }
        return ['status' => 'failed'];
    }

    /**
     * @inheritDoc
     * return array()
     */
    public function charge_customer(array $args)
    {
        $this->setConfig();
        $charge_amount = round($this->charge_amount($args['amount']), 2);
        $order_id =  random_int(12345,99999).$args['order_id'].random_int(12345,99999);
        try{
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => $this->charge_currency(),
                    "value" => number_format( $charge_amount, 2, '.', ''),//"10.00" // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => $args['description'],
                "redirectUrl" => $args['ipn_url'],
                "metadata" => [
                    "order_id" => $order_id,
                    "track" => $args['track'],
                ],
            ]);

        }catch(\Exception $e){
            $msg = '';
            switch($e->getCode()){
                case(400):
                    $msg = __('Bad Request – The Mollie API was unable to understand your request. There might be an error in your syntax.');
                    break;
                case(401):
                    $msg = __('Unauthorized – Your request was not executed due to failed authentication. Check your API key.');
                    break;
                case(403):
                    $msg = __('Forbidden – You do not have access to the requested resource.');
                    break;
                case(404):
                    $msg = __('Not Found – The object referenced by your URL does not exist.');
                    break;
                case(405):
                    $msg = __('Method Not Allowed – You are trying to use an HTTP method that is not applicable on this URL or resource. Refer to the Allow header to see which methods the endpoint supports.');
                    break;
                case(409):
                    $msg = __('Conflict – You are making a duplicate API call that was probably a mistake (only in v2).');
                    break;
                case(410):
                    $msg = __('Gone – You are trying to access an object, which has previously been deleted (only in v2).');
                    break;
                case(415):
                    $msg = __('Unsupported Media Type – Your request’s encoding is not supported or is incorrectly understood. Please always use JSON.');
                    break;
                case(422):
                    $msg = $e->getMessage();
                    break;
                case(429):
                    $msg = __('Too Many Requests – Your request has hit a rate limit. Please wait for a bit and retry.');
                    break;
                case(500):
                    $msg = __('Internal Server Error – An internal server error occurred while processing your request. Our developers are notified automatically, but if you have any information on how you triggered the problem, please contact us.');
                    break;
                case(502):
                    $msg = __('Bad Gateway – The service is temporarily unavailable, either due to calamity or (planned) maintenance. Please retry the request at a later time.');
                    break;
                case(503):
                    $msg = __('Service Unavailable – The service is temporarily unavailable, either due to calamity or (planned) maintenance. Please retry the request at a later time.');
                    break;
                case(504):
                    $msg = __('Gateway Timeout – Your request is causing an unusually long process time.');
                    break;
                default:
                    $msg = $charge_amount.' '.config('paymentgateway.global_currency').' '. __('This amount is higher than the maximum.');
                    break;
            }
            abort(405,$msg);
        }

        $payment = Mollie::api()->payments->get($payment->id);

        session()->put('mollie_payment_id', $payment->id);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    /**
     * @inheritDoc
     */
    public function supported_currency_list()
    {
        return ['AED', 'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'ILS', 'ISK', 'JPY', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN', 'RON', 'RUB', 'SEK', 'SGD', 'THB', 'TWD', 'USD', 'ZAR'];
    }
    private function setConfig(){
        Config::set([
            'mollie.key' => $this->getApiKey()
        ]);
    }
    /**
     * @inheritDoc
     */
    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())) {
            return $this->getCurrency();
        }
        return "USD";
    }

    /**
     * @inheritDoc
     */
    public function gateway_name()
    {
        return 'mollie';
    }
}
