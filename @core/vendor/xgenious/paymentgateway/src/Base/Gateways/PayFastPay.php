<?php

namespace Xgenious\Paymentgateway\Base\Gateways;
use Illuminate\Support\Facades\Config;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;
use Xgenious\Paymentgateway\Traits\ZarCurrencySupport;


class PayFastPay extends PaymentGatewayBase
{
    protected $merchant_id;
    protected $merchant_key;
    protected $passphrase;

    use PaymentEnvironment,CurrencySupport,ZarCurrencySupport;

    public function setMerchantId($merchant_id){
        $this->merchant_id = $merchant_id;
        return $this;
    }
    public function getMerchantId(){
        return $this->merchant_id;
    }
    public function setMerchantKey($merchant_key){
        $this->merchant_key = $merchant_key;
        return $this;
    }
    public function getMerchantKey(){
        return $this->merchant_key;
    }
    public function setPassphrase($passphrase){
        $this->passphrase = $passphrase;
        return $this;
    }
    public function getPassphrase(){
        return $this->passphrase;
    }

    /**
     * @inheritDoc
     *
     * this payment gateway will not work without this package
     * @ https://github.com/kingflamez/laravelrave
     *
     */
    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->is_decimal($amount) ? $amount : number_format((float)$amount,2,'.');
        }
        return $this->is_decimal( $this->get_amount_in_zar($amount)) ? $this->get_amount_in_zar($amount) :number_format((float) $this->get_amount_in_zar($amount),2,'.');
    }

    /**
     * @inheritDoc
     *  * @param array $args
     * @required param list
     * request
     *
     * @return array
     */
    public function ipn_response(array $args = [])
    {
        $this->setConfig();
        $payfast = new \Billow\Payfast();
        $payfast->setMerchant([
            'merchant_id'  => $this->getMerchantId(),                        // TEST Credentials. Replace with your merchant ID from Payfast.
            'merchant_key' => $this->getMerchantKey(),                  // TEST Credentials. Replace with your merchant key from Payfast.
        ]);
        $payfast->setPassphrase($this->getPassphrase());
        $status = $payfast->verify( request(),  request()->amount_gross,  request()->m_payment_id)->status();
        $return_val = ['status' => 'failed'];
        // Handle the result of the transaction.
        switch( $status )
        {
            case 'COMPLETE': // Things went as planned, update your order status and notify the customer/admins.
                $return_val = $this->verified_data([
                    'status' => 'complete',
                    'order_id' =>  substr( request()->m_payment_id,5,-5) ,
                    'transaction_id' =>  request()->pf_payment_id,
                ]);
                break;
            case 'FAILED': // We've got problems, notify admin and contact Payfast Support.
                $return_val = $this->verified_data([
                    'status' => 'failed',
                    'order_id' => substr( request()->m_payment_id,5,-5)
                ]);
                break;
            case 'PENDING': // We've got problems, notify admin and contact Payfast Support.
                break;
            default: // We've got problems, notify admin to check logs.
                break;
        }

        return $return_val;
    }

    /**
     * @inheritDoc
     */
    public function charge_customer(array $args)
    {
        if($this->charge_amount($args['amount']) > 500000){
            return back()->with(['msg' => __('We could not process your request due to your amount is higher than the maximum.'),'type' => 'danger']);
        }
        $this->setConfig();
        $order_id =  random_int(12345,99999).$args['order_id'].random_int(12345,99999);
        $payfast = new \Billow\Payfast();
        $payfast->setMerchant([
            'merchant_id'  => $this->getMerchantId(),                        // TEST Credentials. Replace with your merchant ID from Payfast.
            'merchant_key' => $this->getMerchantKey(),                  // TEST Credentials. Replace with your merchant key from Payfast.
            'return_url'   => $args['success_url'], // Redirect URL on Success.
            'cancel_url'   => $args['cancel_url'],  // Redirect URL on Cancellation.
            'notify_url'   => $args['ipn_url'],        // ITN URL.
        ]);
        $payfast->setPassphrase($this->getPassphrase());
        $payfast->setBuyer( $args['name'], null, $args['email']);
        $payfast->setAmount($this->charge_amount($args['amount']));
        $payfast->setItem( $args['description'] , null);
        $payfast->setMerchantReference($order_id);
        $payfast->setCancelUrl($args['cancel_url']);
        $payfast->setReturnUrl($args['success_url']);
        $payfast->setNotifyUrl($args['ipn_url']);
        $submit_form =  $payfast->paymentForm(__('Pay Now'));

        return view('paymentgateway::payfast',compact('submit_form'));
    }

    /**
     * @inheritDoc
     */
    public function supported_currency_list()
    {
        return ['ZAR'];
    }

    /**
     * @inheritDoc
     */
    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())) {
            return $this->getCurrency();
        }
        return "ZAR";
    }

    /**
     * @inheritDoc
     */
    public function gateway_name()
    {
        return 'payfast';
    }

    protected function setConfig(){
        Config::set([
            'payfast.testing'  => $this->getEnv(), // Set to false when in production.
        ]);
    }
}
