<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\IndianCurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PayTabsPay extends PaymentGatewayBase
{

    use CurrencySupport,PaymentEnvironment,ConvertUsdSupport;

    protected $profile_id;
    protected $region;
    protected $server_key;


    public function setProfileId(string $profile_id) : PayTabsPay
    {
        $this->profile_id = $profile_id;
        return $this;
    }
    public function getProfileId(){
        return $this->profile_id;
    }

    public function setRegion(string $region = 'GLOBAL'): PayTabsPay
    {
        $this->region = $region;
        return $this;
    }
    public function getRegion(){
       return $this->region;
    }

    public function setServerKey($server_key): PayTabsPay
    {
        $this->server_key = $server_key;
        return $this;
    }
    public function getServerKey(){
        return $this->server_key;
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
        $transaction_id = request()->tranRef;
        if (!empty($transaction_id)) {
            try {
                $this->setConfig();
                $transaction = Paypage::queryTransaction($transaction_id);
                if ($transaction->success){
                    return $this->verified_data([
                        'transaction_id' => $transaction->transaction_id,
                        'order_id' => substr($transaction->cart_id,5,-5)
                    ]);
                }
            } catch (\Exception $e) {
                // Une erreur s'est produite
                return "Erreur :" . $e->getMessage();
            }
        }
       return ['status' => 'failed'];
    }

    /**
     * @throws \Exception
     */
    public function charge_customer(array $args)
    {

        $this->setConfig();

        $order_id =  random_int(12345,99999).$args['order_id'].random_int(12345,99999);

        try {
            $pay= paypage::sendPaymentCode('all')
                ->sendTransaction('sale')
//            ->sendTransaction('sale')
                ->sendCart($order_id,$this->charge_amount($args['amount']), $args['description']) //1st param cart id or oorder id, 2nd param charge amount , 3rd param card description
//            ->sendCustomerDetails('Walaa Elsaeed', 'w.elsaeed@paytabs.com', '0101111111', 'test', 'Nasr City', 'Cairo', 'EG', '1234','100.279.20.10') // 1st param name, 2nd param email, 3rd param phone,
//            ->sendShippingDetails('Walaa Elsaeed', 'w.elsaeed@paytabs.com', '0101111111', 'test', 'Nasr City', 'Cairo', 'EG', '1234','100.279.20.10')
                ->sendURLs( $args['ipn_url'],$args[ 'success_url']) //first param is callback_url, 2nd param is return url
                ->sendLanguage('en')
                ->sendHideShipping(true)
//            ->sendFramed(true)
                ->create_pay_page();
            return $pay;

        }catch (\Exception $e){
            abort(401,$e->getMessage());
        }
    }

    private function setConfig(){
        \Config::set([
            'paytabs.currency' => $this->getCurrency(), //['AED','EGP','SAR','OMR','JOD','USD']
            'paytabs.profile_id' => $this->getProfileId(),
            'paytabs.region' => $this->getRegion(), // ['ARE','EGY','SAU','OMN','JOR','GLOBAL']
            'paytabs.server_key' => $this->getServerKey()
        ]);

    }

    public function supported_currency_list() : array
    {
        return ['AED','EGP','SAR','OMR','JOD','USD'];
    }

    public function charge_currency() : string
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "USD";
    }

    public function gateway_name() : string
    {
        return 'paytabs';
    }
}
