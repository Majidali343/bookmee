<?php

namespace Xgenious\Paymentgateway\Base\Gateways;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Xgenious\Paymentgateway\Base\GlobalCurrency;
use Xgenious\Paymentgateway\Base\PaymentGatewayBase;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Xgenious\Paymentgateway\Base\PaymentGatewayHelpers;
use Xgenious\Paymentgateway\Traits\ConvertUsdSupport;
use Xgenious\Paymentgateway\Traits\CurrencySupport;
use Xgenious\Paymentgateway\Traits\PaymentEnvironment;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeDotNetPay extends PaymentGatewayBase
{
    use PaymentEnvironment,CurrencySupport,ConvertUsdSupport;
    protected $merchant_login_id;
    protected $merchant_transaction_id;

    /* get getMerchantLoginId */
    private function getMerchantLoginId(){
        return  $this->merchant_login_id;
    }
    /* set setMerchantLoginId */
    public function setMerchantLoginId($merchant_login_id){
        $this->merchant_login_id = $merchant_login_id;
        return $this;
    }
    /* set setMerchantTransactionId */
    public function setMerchantTransactionId($merchant_transaction_id){
        $this->merchant_transaction_id = $merchant_transaction_id;
        return $this;
    }
    /* get getMerchantTransactionId */
    private function getMerchantTransactionId(){
        return  $this->merchant_transaction_id;
    }
    /*
    * charge_amount();
    * @required param list
    * $amount
    *
    *
    * */
    public function charge_amount($amount)
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $amount;
        }
        return $this->get_amount_in_usd($amount);
    }


       /**
     * @required param list
     * $args['amount']
     * $args['description']
     * $args['item_name']
     * $args['ipn_url']
     * $args['cancel_url']
     * $args['payment_track']
     * return redirect url for paypal
     * */

    public function view($args){
        return view('paymentgateway::authorizenet', ['authorizenet_data' => array_merge($args,[
            'merchant_login_id' =>  Crypt::encrypt($this->getMerchantLoginId()),
            'currency' => $this->getCurrency(),
            'merchant_transaction_id' => Crypt::encrypt($this->getMerchantTransactionId()),
            'charge_amount' => $this->charge_amount($args['amount']),
            'environment' => $this->getEnv(),
            'order_id' => PaymentGatewayHelpers::wrapped_id($args['order_id'])
        ])]);
    }
    public function charge_customer($args)
    {
        return $this->view($args);
        //todo:: format data for send in blade file for get user card details
    }
    public function charge_customer_from_controller()
    {
        $input = request()->input();

        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchant_transaction_id = \Crypt::decrypt(request()->merchant_transaction_id);
        $merchant_login_id = \Crypt::decrypt(request()->merchant_login_id);
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($merchant_login_id);
        $merchantAuthentication->setTransactionKey($merchant_transaction_id);



        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $input['number']);
//dd($cardNumber,request()->all(),request()->get('expiry'),explode('/',request()->get('expiry')));
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $card_date = explode('/',request()->get('expiry'));
        $expiration_month = trim($card_date[0]); //detect if year value is full number like 2024 get only last two digit¥¥¥¥¥¥¥¥^-09oi87uy68uy6t5rewqsdw34e5
        $expiration_year = strlen(trim($card_date[1])) == 4 ? trim($card_date[1]) : '20'.trim($card_date[1]);
        $expiration_date = $expiration_year. "-" .$expiration_month;
        $creditCard->setExpirationDate($expiration_date);
        $creditCard->setCardCode($input['cvc']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($input['charge_amount']);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setCurrencyCode($input['currency']);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $Environment = $input['environment'] ? \net\authorize\api\constants\ANetEnvironment::SANDBOX: \net\authorize\api\constants\ANetEnvironment::PRODUCTION;
        $response = $controller->executeWithApiResponse($Environment);
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                     return $this->verified_data([
                         'transaction_id' => $tresponse->getTransId(),
                         'status' => 'complete',
                         'order_id' => $input['order_id']
                     ]);

                } else {
                    $message = __('There were some issue with the payment. Please try again later.');
                    if ($tresponse->getErrors() != null) {
                        $message = $tresponse->getErrors()[0]->getErrorText();
                    }
                    abort(500,$message);
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type = "error_msg";

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                }
                abort(500,$message_text);
            }
        }
        return $this->verified_data([
            'status' => 'failed',
            'order_id' => PaymentGatewayHelpers::unwrapped_id(request()->get('order_id'))
        ]);
    }

    /**
     * @required param list
     * $args['request']
     * $args['cancel_url']
     * $args['success_url']
     *
     * return @void
     * */
    public function ipn_response($args = []){

        $transaction_id = request()->transaction_id;
        /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->getMerchantLoginId());
        $merchantAuthentication->setTransactionKey($this->getMerchantTransactionId());

        // Set the transaction's refId
        // The refId is a Merchant-assigned reference ID for the request.
        // If included in the request, this value is included in the response.
        // This feature might be especially useful for multi-threaded applications.
        $refId = 'ref' . time();

        $request = new AnetAPI\GetTransactionDetailsRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setTransId($transaction_id);

        $controller = new AnetController\GetTransactionDetailsController($request);
        $Environment = $this->getEnv() ? \net\authorize\api\constants\ANetEnvironment::SANDBOX: \net\authorize\api\constants\ANetEnvironment::PRODUCTION;
        $response = $controller->executeWithApiResponse( $Environment);

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
        {
//            echo "SUCCESS: Transaction Status:" . $response->getTransaction()->getTransactionStatus() . "\n";
//            echo "                Auth Amount:" . $response->getTransaction()->getAuthAmount() . "\n";
//            echo "                   Trans ID:" . $response->getTransaction()->getTransId() . "\n";
            return $this->verified_data([
                'status' => 'complete',
                'transaction_id' => $response->getTransaction()->getTransId() ,
                'order_id' => PaymentGatewayHelpers::unwrapped_id(request()->get('order_id')),
                'order_type' => request()->get('order_type')
            ]);
        }
        return $this->verified_data([
            'status' => 'failed',
            'order_id' => PaymentGatewayHelpers::unwrapped_id(request()->get('order_id')),
            'order_type' => request()->get('payment_type')
        ]);

    }

    /**
     * geteway_name();
     * return @string
     * */
    public function gateway_name(){
        return 'authorizenet';
    }
    /**
     * charge_currency();
     * return @string
     * */
    public function charge_currency()
    {
        if (in_array($this->getCurrency(), $this->supported_currency_list())){
            return $this->getCurrency();
        }
        return  "USD";
    }
    /**
     * supported_currency_list();
     * it will returl all of supported currency for the payment gateway
     * return array
     * */
    public function supported_currency_list(){
        return ['AUD', 'CAD', 'CHF', 'DKK', 'EUR', 'GBP', 'JPY', 'NOK', 'NZD', 'SEK', 'USD', 'ZAR'];
    }
}
