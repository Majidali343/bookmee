<?php

namespace Modules\Subscription\Http\Controllers\Frontend;

use App\Helpers\FlashMsg;
use App\Mail\BasicMail;
use App\Mail\OrderMail;
use App\Service;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\SellerSubscription;
use Modules\Subscription\Entities\SubscriptionHistory;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Str;

class SellerPaymentController extends Controller
{
    protected function cancel_page()
    {
        return redirect()->route('seller.subscription.payment.cancel.static');
    }

    public function paypal_ipn_for_subs(Request $request)
    {

        $paypal_mode = getenv('PAYPAL_MODE');
        $client_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_ID') : getenv('PAYPAL_LIVE_CLIENT_ID');
        $client_secret = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_SECRET') : getenv('PAYPAL_LIVE_CLIENT_SECRET');
        $app_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_APP_ID') : getenv('PAYPAL_LIVE_APP_ID');
        $paypal = XgPaymentGateway::paypal();
        $paypal->setClientId($client_id);
        $paypal->setClientSecret($client_secret);
        $paypal->setEnv($paypal_mode === 'sandbox');
        $paypal->setAppId($app_id);
        $payment_data = $paypal->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function paytm_ipn_for_subs(Request $request)
    {

        $paytm_merchant_id = getenv('PAYTM_MERCHANT_ID');
        $paytm_merchant_key = getenv('PAYTM_MERCHANT_KEY');
        $paytm_merchant_website = getenv('PAYTM_MERCHANT_WEBSITE') ?? 'WEBSTAGING';
        $paytm_channel = getenv('PAYTM_CHANNEL') ?? 'WEB';
        $paytm_industry_type = getenv('PAYTM_INDUSTRY_TYPE') ?? 'Retail';
        $paytm_env = getenv('PAYTM_ENVIRONMENT');

        $paytm = XgPaymentGateway::paytm();
        $paytm->setMerchantId($paytm_merchant_id);
        $paytm->setMerchantKey($paytm_merchant_key);
        $paytm->setMerchantWebsite($paytm_merchant_website);
        $paytm->setChannel($paytm_channel);
        $paytm->setIndustryType($paytm_industry_type);
        $paytm->setEnv($paytm_env === 'local'); //env must set as boolean, string will not work

        $payment_data = $paytm->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function mollie_ipn_for_subs(Request $request)
    {
        $mollie_key = getenv('MOLLIE_KEY');
        $mollie = XgPaymentGateway::mollie();
        $mollie->setApiKey($mollie_key);
        $mollie->setEnv(true); //env must set as boolean, string will not work
        $payment_data = $mollie->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function stripe_ipn_for_subs(Request $request){

        $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
        $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
        $stripe = XgPaymentGateway::stripe();
        $stripe->setSecretKey($stripe_secret_key);
        $stripe->setPublicKey($stripe_public_key);
        $stripe->setEnv(true); //env must set as boolean, string will not work

        $payment_data = $stripe->ipn_response();


        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function razorpay_ipn_for_subs(Request $request)
    {
        $razorpay_api_key = getenv('RAZORPAY_API_KEY');
        $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');

        $razorpay = XgPaymentGateway::razorpay();
        $razorpay->setApiKey($razorpay_api_key);
        $razorpay->setApiSecret($razorpay_api_secret);

        $payment_data = $razorpay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function flutterwave_ipn_for_subs(Request $request)
    {
        $flutterwave_public_key = getenv("FLW_PUBLIC_KEY");
        $flutterwave_secret_key = getenv("FLW_SECRET_KEY");
        $flutterwave_secret_hash = getenv("FLW_SECRET_HASH");

        $flutterwave = XgPaymentGateway::flutterwave();
        $flutterwave->setPublicKey($flutterwave_public_key);
        $flutterwave->setSecretKey($flutterwave_secret_key);
        $flutterwave->setEnv(true); //env must set as boolean, string will not work

        $payment_data = $flutterwave->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function paystack_ipn_for_subs(Request $request)
    {
        $paystack_public_key = getenv('PAYSTACK_PUBLIC_KEY');
        $paystack_secret_key = getenv('PAYSTACK_SECRET_KEY');
        $paystack_merchant_email = getenv('MERCHANT_EMAIL');

        $paystack = XgPaymentGateway::paystack();
        $paystack->setPublicKey($paystack_public_key);
        $paystack->setSecretKey($paystack_secret_key);
        $paystack->setMerchantEmail($paystack_merchant_email);

        $payment_data = $paystack->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function cashfree_ipn_for_subs(Request $request)
    {
        $cashfree_env = getenv('CASHFREE_TEST_MODE') === 'true';
        $cashfree_app_id = getenv('CASHFREE_APP_ID');
        $cashfree_secret_key = getenv('CASHFREE_SECRET_KEY');

        $cashfree = XgPaymentGateway::cashfree();
        $cashfree->setAppId($cashfree_app_id);
        $cashfree->setSecretKey($cashfree_secret_key);

        $payment_data = $cashfree->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function instamojo_ipn_for_success(Request $request)
    {
        $instamojo_client_id = getenv('INSTAMOJO_CLIENT_ID');
        $instamojo_client_secret = getenv('INSTAMOJO_CLIENT_SECRET');
        $instamojo_env = getenv('INSTAMOJO_TEST_MODE') === 'true';

        $instamojo = XgPaymentGateway::instamojo();
        $instamojo->setClientId($instamojo_client_id);
        $instamojo->setSecretKey($instamojo_client_secret);
        $instamojo->setEnv($instamojo_env); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
        $payment_data = $instamojo->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function marcadopago_ipn_for_subs(Request $request)
    {
        $mercadopago_client_id = getenv('MERCADO_PAGO_CLIENT_ID');
        $mercadopago_client_secret = getenv('MERCADO_PAGO_CLIENT_SECRET');
        $mercadopago_env =  getenv('MERCADO_PAGO_TEST_MOD') === 'true';

        $marcadopago = XgPaymentGateway::marcadopago();
        $marcadopago->setClientId($mercadopago_client_id);
        $marcadopago->setClientSecret($mercadopago_client_secret);
        $marcadopago->setEnv($mercadopago_env); ////true mean sandbox mode , false means live mode
        $payment_data = $marcadopago->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }
    public function payfast_ipn_for_subs(Request $request)
    {
        $payfast_merchant_id = getenv('PF_MERCHANT_ID');
        $payfast_merchant_key = getenv('PF_MERCHANT_KEY');
        $payfast_passphrase = getenv('PAYFAST_PASSPHRASE');
        $payfast_env = getenv('PAYFAST_PASSPHRASE') === 'true';
        $payfast = XgPaymentGateway::payfast();
        $payfast->setMerchantId($payfast_merchant_id);
        $payfast->setMerchantKey($payfast_merchant_key);
        $payfast->setPassphrase($payfast_passphrase);
        $payfast->setEnv($payfast_env); //env must set as boolean, string will not work

        $payment_data = $payfast->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function midtrans_ipn_for_subs()
    {
        $midtrans_env =  getenv('MIDTRANS_ENVAIRONTMENT') === 'true';
        $midtrans_server_key = getenv('MIDTRANS_SERVER_KEY');
        $midtrans_client_key = getenv('MIDTRANS_CLIENT_KEY');
        $midtrans = XgPaymentGateway::midtrans();
        $midtrans->setClientKey($midtrans_client_key);
        $midtrans->setServerKey($midtrans_server_key);
        $midtrans->setEnv($midtrans_env); //true mean sandbox mode , false means live mode

        $payment_data = $midtrans->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }
    public function squareup_ipn_for_subs()
    {
        $squareup_env =  !empty(get_static_option('squareup_test_mode'));
        $squareup_location_id = get_static_option('cinetpay_site_id');
        $squareup_access_token = get_static_option('squareup_access_token');
        $squareup_application_id = get_static_option('squareup_application_id');

        $squareup = XgPaymentGateway::squareup();
        $squareup->setLocationId($squareup_location_id);
        $squareup->setAccessToken($squareup_access_token);
        $squareup->setApplicationId($squareup_application_id);
        $squareup->setEnv($squareup_env);

        $payment_data = $squareup->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function cinetpay_ipn_for_subs()
    {
        $cinetpay_env =  !empty(get_static_option('cinetpay_test_mode'));
        $cinetpay_site_id = get_static_option('cinetpay_site_id');
        $cinetpay_app_key = get_static_option('cinetpay_app_key');

        $cinetpay = XgPaymentGateway::cinetpay();
        $cinetpay->setAppKey($cinetpay_app_key);
        $cinetpay->setSiteId($cinetpay_site_id);
        $cinetpay->setEnv($cinetpay_env);

        $payment_data = $cinetpay->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }
    public function paytabs_ipn_for_subs()
    {
        $paytabs_env =  !empty(get_static_option('paytabs_test_mode'));
        $paytabs_region = get_static_option('paytabs_region');
        $paytabs_profile_id = get_static_option('paytabs_profile_id');
        $paytabs_server_key = get_static_option('paytabs_server_key');

        $paytabs = XgPaymentGateway::paytabs();
        $paytabs->setProfileId($paytabs_profile_id);
        $paytabs->setRegion($paytabs_region);
        $paytabs->setServerKey($paytabs_server_key);
        $paytabs->setEnv($paytabs_env);

        $payment_data = $paytabs->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function billplz_ipn_for_subs()
    {
        $billplz_env =  !empty(get_static_option('billplz_test_mode'));
        $billplz_key =  get_static_option('billplz_key');
        $billplz_xsignature =  get_static_option('billplz_xsignature');
        $billplz_collection_name =  get_static_option('billplz_collection_name');

        $billplz = XgPaymentGateway::billplz();
        $billplz->setKey($billplz_key);
        $billplz->setVersion('v4');
        $billplz->setXsignature($billplz_xsignature);
        $billplz->setCollectionName($billplz_collection_name);
        $billplz->setEnv($billplz_env);

        $payment_data = $billplz->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }
    public function zitopay_ipn_for_subs()
    {
        $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
        $zitopay_username =  get_static_option('zitopay_username');

        $zitopay = XgPaymentGateway::zitopay();
        $zitopay->setUsername($zitopay_username);
        $zitopay->setEnv($zitopay_env);

        $payment_data = $zitopay->ipn_response();

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $order_id = $payment_data['order_id'];
            $history_id = session()->get('history_id');
            $this->update_database($order_id, $payment_data['transaction_id'],$history_id);
            $this->send_subscription_mail($order_id);
            $new_order_id = wrapped_id($order_id);
            return redirect()->route('seller.subscription.payment.success',$new_order_id);
        }
        return $this->cancel_page();
    }

    public function send_subscription_mail($order_id)
    {
        if(empty($order_id)){
            return redirect()->route('homepage');
        }

        $subscription_details = SellerSubscription::find($order_id);
        $user_name = User::select('name')->where('id',$subscription_details->seller_id)->first();
        $user_email = User::select('email')->where('id',$subscription_details->seller_id)->first();

        try {
            $message = get_static_option('buy_subscription_seller_message') ?? '';
            $message = str_replace(["@type","@price","@connect"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$subscription_details->connect],$message);
            Mail::to($user_email)->send(new BasicMail([
                'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                'message' => $message
            ]));

            $message = get_static_option('buy_subscription_admin_message') ?? '';
            $message = str_replace(["@type","@price","@connect","@seller_name","@seller_email"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$subscription_details->connect,$user_name,$user_email],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                'message' => $message
            ]));

        } catch (\Exception $e) {
            \Toastr::error($e->getMessage());
        }
    }

    private function update_database($subscription_id, $transaction_id, $history_id)
    {
        $subscription_details = SellerSubscription::find($subscription_id);
        if($subscription_details){
            SellerSubscription::where('id', $subscription_id)->update([
                'payment_status' => 'complete',
                'transaction_id' => $transaction_id,
                'connect' => ($subscription_details->initial_connect + $subscription_details->connect),
                'price' => $subscription_details->initial_price,
                'status' => 1,
            ]);

            SubscriptionHistory::where('id', $history_id)->update([
                'payment_status' => 'complete',
            ]);
        }

    }
}
