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
use CinetPay\CinetPay as CinetPayment;

class CinetPay extends PaymentGatewayBase
{

    use CurrencySupport,PaymentEnvironment,ConvertUsdSupport;

    protected $app_key;
    protected $site_id;

    public function setAppKey($app_key){
        $this->app_key = $app_key;
        return $this;
    }
    public function getAppKey(){
        return $this->app_key;
    }
    public function setSiteId($site_id){
        $this->site_id = $site_id;
        return $this;
    }
    public function getSiteId(){
        return $this->site_id;
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
        $id_transaction = request()->cpm_trans_id;
        if (!empty($id_transaction)) {
            try {
                $cp = $this->setConfig();

                // Reprise exacte des bonnes données chez CinetPay
                $payment_status = $cp->setTransId($id_transaction)->getPayStatus();
                $paymentData = [
                    "cpm_site_id" => $cp->_cpm_site_id,
                    "signature" => $cp->_signature,
                    "cpm_amount" => $cp->_cpm_amount,
                    "cpm_trans_id" => $cp->_cpm_trans_id,
                    "cpm_custom" => $cp->_cpm_custom,
                    "cpm_currency" => $cp->_cpm_currency,
                    "cpm_payid" => $cp->_cpm_payid,
                    "cpm_payment_date" => $cp->_cpm_payment_date,
                    "cpm_payment_time" => $cp->_cpm_payment_time,
                    "cpm_error_message" => $cp->_cpm_error_message,
                    "payment_method" => $cp->_payment_method,
                    "cpm_phone_prefixe" => $cp->_cpm_phone_prefixe,
                    "cel_phone_num" => $cp->_cel_phone_num,
                    "cpm_ipn_ack" => $cp->_cpm_ipn_ack,
                    "created_at" => $cp->_created_at,
                    "updated_at" => $cp->_updated_at,
                    "cpm_result" => $cp->_cpm_result,
                    "cpm_trans_status" => $cp->_cpm_trans_status,
                    "cpm_designation" => $cp->_cpm_designation,
                    "buyer_name" => $cp->_buyer_name,
                ];
                if ($cp->isValidPayment()) {
                    if (isset($paymentData['cpm_trans_status']) && $paymentData['cpm_trans_status'] === 'ACCEPTED') {
                        return $this->verified_data([
                            'transaction_id' => $paymentData['cpm_payid'],
                            'order_id' => substr($paymentData['cpm_custom'],5,-5)
                        ]);
                    }
                } else {
                    return ['status' => 'failed'];
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
        if($this->charge_amount($args['amount']) < 100 && !in_array("USD",[$this->getCurrency()])){
            abort(402,__('amount must be getter than 100'));
        }
        $order_id =  random_int(12345,99999).$args['order_id'].random_int(12345,99999);

        $id_transaction = CinetPayment::generateTransId(); // Identifiant du Paiement
        $description_du_paiement = $args['description']; // Description du Payment
        $date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
        $montant_a_payer = $this->charge_amount($args['amount']); // Montant à Payer : minimun est de 100 francs sur CinetPay
        $devise = $this->getCurrency();//'XOF'; // Montant à Payer : minimun est de 100 francs sur CinetPay
        $identifiant_du_payeur =  $order_id; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
        $formName = "goCinetPay"; // nom du formulaire CinetPay
        $notify_url = $args['ipn_url']; // notification CallBack CinetPay (IPN Link)
        $return_url = $args['ipn_url'];//cinetpay redirect this url after successfully payment
        $cancel_url = $args['cancel_url']; // cancel url, where cinet pay will redirect after cancel payment

        $btnType = 2;//1-5xwxxw
        $btnSize = 'large'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

        try{
            $cp = $this->setConfig();
        }catch (\Exception $e) {
            return $e->getMessage();
        }
        try {
            $cp->setTransId($id_transaction)
                ->setDesignation($description_du_paiement)
                ->setTransDate($date_transaction)
                ->setAmount($montant_a_payer)
                ->setCurrency($devise)
                ->setDebug($this->getEnv())// Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
                ->setCustom($identifiant_du_payeur)// optional
                ->setNotifyUrl($notify_url)// optional
                ->setReturnUrl($return_url)// optional
                ->setCancelUrl($cancel_url);// optional
            return view('paymentgateway::cinetpay',[
                'payButton' => $cp->getPayButton($formName, $btnType, $btnSize)
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function setConfig(){
        return new CinetPayment($this->getSiteId(), $this->getAppKey());
    }

    public function supported_currency_list()
    {
        return ['XOF', 'XAF', 'CDF', 'GNF', 'USD'];
    }

    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "USD";
    }

    public function gateway_name()
    {
        return 'cinetpay';
    }
}
