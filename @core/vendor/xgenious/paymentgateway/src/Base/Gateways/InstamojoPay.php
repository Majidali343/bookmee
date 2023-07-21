<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Instamojo\Instamojo;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\IndianCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;

class InstamojoPay extends PaymentGatewayBase
{
    use IndianCurrencySupport,CurrencySupport,PaymentEnvironment;

    protected $client_id;
    protected $secret_key;

    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())) {
            return $amount;
        }
        return $this->get_amount_in_inr($amount);
    }

    public function ipn_response(array $args = [])
    {
        $payment_id = request()->get('payment_id');
        $payment_request_id = request()->get('payment_request_id');
        $api_token = $this->setConfig();
        $result = Http::asForm()
            ->withToken($api_token)
            ->acceptJson()
            ->get($this->base_url() . 'v2/payment_requests/' . $payment_request_id);
        $response = $result->object();

        if ($result->ok() && property_exists($response, 'status') && $response->status === 'Completed') {
            $order_id = Str::of($response->purpose)->after('_ID_')->trim()->__toString();
            return $this->verified_data([
                'transaction_id' => $payment_id,
                'order_id' => substr($order_id,5,-5)
            ]);
        }
        return ['status' => 'failed'];
    }

    /**
     * @throws \Exception
     */
    public function charge_customer(array $args)
    {
        $api_token = $this->setConfig();
        $charge_amount = $this->charge_amount($args['amount']);
        $order_id = random_int(01234, 99999) . $args['order_id'] . random_int(01234, 99999); // not required to mask order for this payment gateway
        $response = Http::asForm()
            ->acceptJson()
            ->withToken($api_token)
            ->post($this->base_url() . 'v2/payment_requests/', [
                'purpose' => $args['payment_type'] . '_ID_' . $order_id,
                'amount' => $charge_amount,
                'buyer_name' => $args['name'],
                'email' => $args['email'],
//                'phone' => $args['phone'] ?? random_int(123456789,999999999), //mobile number support will be available in future
                'redirect_url' => $args['ipn_url'],
                'send_email' => 'True',
                'send_sms' => 'False', //mobile number support will be available in future
//                'webhook' => '', //webhook option will be avilable in future
                'allow_repeated_payments' => 'False',
            ]);
        $res_body = $response->object();
        if (property_exists($res_body, 'longurl')) {
            return redirect()->away($response->object()->longurl);
        } else {
            abort(405, 'something went wrong! , check your instamojo credentials were correct or not.');
        }
    }

    public function supported_currency_list()
    {
        return ['INR'];
    }

    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())) {
            return $this->getCurrency();
        }
        return "INR";
    }

    public function gateway_name()
    {
        return 'instamojo';
    }

    protected function base_url()
    {
        $prefix = $this->getEnv() ? 'test' : 'api';
        return 'https://' . $prefix . '.instamojo.com/';
    }

    /* set app id */
    public function setClientId($client_id){
        $this->client_id = $client_id;
        return $this;
    }
    /* set app secret */
    public function setSecretKey($secret_key){
        $this->secret_key = $secret_key;
        return $this;
    }
    /* get app id */
    private function getClientId(){
        return  $this->client_id;
    }
    /* get secret key */
    private function getSecretKey(){
        return $this->secret_key;
    }

    protected function setConfig()
    {

        $response = Http::asForm()
            ->withBasicAuth($this->getClientId(), $this->getSecretKey())
            ->post($this->base_url() . 'oauth2/token/', [
                'grant_type' => 'client_credentials',
            ]);
        if ($response->ok()) {
            return $response->object()->access_token;
        }
        $response->throw();
    }
}
