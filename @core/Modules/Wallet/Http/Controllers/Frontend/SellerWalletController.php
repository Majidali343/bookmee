<?php

namespace Modules\Wallet\Http\Controllers\Frontend;

use App\Mail\BasicMail;
use App\Order;
use App\PayoutRequest;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;
use Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class SellerWalletController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.order.payment.cancel.static';

    public function deposit_payment_cancel_static()
    {
        return view('wallet::frontend.seller.payment-cancel-static');
    }

    public function wallet_history()
    {
        $wallet_histories = WalletHistory::latest()
            ->where('buyer_id',Auth::guard('web')->user()->id)
            ->whereIn('payment_status',['complete','pending'])
            ->paginate(10);
        $balance = Wallet::select('balance')->where('buyer_id',Auth::guard('web')->user()->id)->first();
        return view('wallet::frontend.seller.wallet-history',compact('wallet_histories','balance'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount'=>'required|integer|min:10|max:5000',
        ]);
        if($request->selected_payment_gateway === 'manual_payment') {
            $request->validate([
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        //deposit amount
        $total = $request->amount;
        $buyer_id = Auth::guard('web')->user()->id;
        $name = Auth::guard('web')->user()->name;
        $email = Auth::guard('web')->user()->email;
        if($request->selected_payment_gateway == 'manual_payment'){
            $payment_status='pending';
        }else{
            $payment_status='';
        }
        $buyer = Wallet::where('buyer_id',$buyer_id)->first();

        // deposit from balance
        if($request->selected_payment_gateway === 'current_balance'){
            //balance calculate
            $get_sum = Order::where(['status'=>2,'seller_id'=>$buyer_id]);
            $complete_order_balance_with_tax = $get_sum->sum('total');
            $complete_order_tax = $get_sum->sum('tax');
            $complete_order_balance_without_tax = $complete_order_balance_with_tax - $complete_order_tax;
            $admin_commission_amount = $get_sum->sum('commission_amount');
            $remaning_balance = $complete_order_balance_without_tax-$admin_commission_amount;
            $total_earnings = PayoutRequest::where('seller_id',$buyer_id)->sum('amount');
            $remaning_balance = $remaning_balance - $total_earnings;

            if($request->amount <= $remaning_balance){
                PayoutRequest::create([
                    'seller_id' => $buyer_id,
                    'amount' => $request->amount,
                    'payment_gateway' => __('Nothing'),
                    'seller_note' => __('Deposit to wallet'),
                    'status' => 1,
                ]);
                if(empty($buyer)){
                    Wallet::create([
                        'buyer_id' => $buyer_id,
                        'balance' => 0,
                        'status' => 0,
                    ]);
                }
                $deposit = WalletHistory::create([
                    'buyer_id' => $buyer_id,
                    'amount' => $total,
                    'payment_gateway' => $request->selected_payment_gateway,
                    'payment_status' => $payment_status,
                    'status' => 1,
                ]);

                $deposit_details = WalletHistory::find($deposit->id);
                WalletHistory::where('id', $deposit->id)->update([
                    'payment_status' => 'complete',
                    'transaction_id' => '',
                    'status' => 1,
                ]);

                $get_balance_from_wallet = Wallet::where('buyer_id',$deposit_details->buyer_id)->first();
                Wallet::where('buyer_id', $deposit_details->buyer_id)
                    ->update([
                        'balance' => $get_balance_from_wallet->balance + $deposit_details->amount,
                    ]);

                toastr_success(__('Your deposit successfully completed.'));
                return back();
            }else{
                toastr_warning(__('Your current balance is less the deposit amount. Please enter a valid amount.'));
                return back();
            }
        }


        if(empty($buyer)){
            Wallet::create([
                'buyer_id' => $buyer_id,
                'balance' => 0,
                'status' => 0,
            ]);
        }
        $deposit = WalletHistory::create([
            'buyer_id' => $buyer_id,
            'amount' => $total,
            'payment_gateway' => $request->selected_payment_gateway,
            'payment_status' => $payment_status,
            'status' => 1,

        ]);

        $last_deposit_id = $deposit->id;
        $title = __('Deposit To Wallet');
        $description = sprintf(__('Order id #%1$d Email: %2$s, Name: %3$s'),$last_deposit_id,$email,$name);

        // variable for all payment gateway
        $global_currency = get_static_option('site_global_currency');
        $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
        $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
        $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
        $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
        $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
        $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');


        if($request->selected_payment_gateway === 'manual_payment') {
            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();

                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                    $manual_image_path = 'assets/uploads/manual-payment/';
                    $manual_payment_image->move($manual_image_path,$manual_payment_image_name);
                    WalletHistory::where('id',$last_deposit_id)->update([
                        'manual_payment_image'=>$manual_payment_image_name
                    ]);
                }else{
                    return back()->with(['msg' => __('image type not supported'),'type' => 'danger']);
                }
            }

            try {
                $message_body = __('Hello a seller just deposit to his wallet. Please check and confirm').'</br>'.'<span class="verify-code">'.__('Deposit ID: ').$last_deposit_id.'</span>';
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => __('Deposit Confirmation'),
                    'message' => $message_body
                ]));
                Mail::to($email)->send(new BasicMail([
                    'subject' => __('Deposit Confirmation'),
                    'message' => __('Manual deposit success. Your wallet will credited after admin approval #').$last_deposit_id
                ]));
            } catch (\Exception $e) {
                //
            }
            toastr_success('Manual deposit success. Your wallet will credited after admin approval');
            return back();

        }else{
            if ($request->selected_payment_gateway === 'paypal') {

                try{
                    $paypal_mode = getenv('PAYPAL_MODE');
                    $client_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_ID') : getenv('PAYPAL_LIVE_CLIENT_ID');
                    $client_secret = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_CLIENT_SECRET') : getenv('PAYPAL_LIVE_CLIENT_SECRET');
                    $app_id = $paypal_mode === 'sandbox' ? getenv('PAYPAL_SANDBOX_APP_ID') : getenv('PAYPAL_LIVE_APP_ID');

                    $paypal = XgPaymentGateway::paypal();

                    $paypal->setClientId($client_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setClientSecret($client_secret); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setAppId($app_id); // provide sandbox id if payment env set to true, otherwise provide live credentials
                    $paypal->setCurrency($global_currency);
                    $paypal->setEnv($paypal_mode === 'sandbox'); //env must set as boolean, string will not work
                    $paypal->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $paypal->charge_customer([
                        'amount' => $total, // amount you want to charge from customer
                        'title' => $title, // payment title
                        'description' => $description, // payment description
                        'ipn_url' => route('seller.paypal.ipn.jobs'), //you will get payment response in this route
                        'order_id' => $last_deposit_id, // your order number
                        'track' => \Str::random(36), // a random number to keep track of your payment
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id), //payment gateway will redirect here if the payment is failed
                        'success_url' => route('buyer.orders'), // payment gateway will redirect here after success
                        'email' => $email, // user email
                        'name' => $name, // user name
                        'payment_type' => 'deposit', // which kind of payment your are receving from customer
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'paytm'){
                try{
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
                    $paytm->setCurrency($global_currency);
                    $paytm->setEnv($paytm_env === 'local'); // this must be type of boolean , string will not work
                    $paytm->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $paytm->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.paytm.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);

                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'mollie'){
                try{
                    $mollie_key = getenv('MOLLIE_KEY');
                    $mollie = XgPaymentGateway::mollie();
                    $mollie->setApiKey($mollie_key);
                    $mollie->setCurrency($global_currency);
                    $mollie->setEnv(true); //env must set as boolean, string will not work
                    $mollie->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $mollie->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.mollie.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'stripe'){
                try{
                    $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
                    $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
                    $stripe = XgPaymentGateway::stripe();
                    $stripe->setSecretKey($stripe_secret_key);
                    $stripe->setPublicKey($stripe_public_key);
                    $stripe->setCurrency($global_currency);
                    $stripe->setEnv(true); //env must set as boolean, string will not work
                    $stripe->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $stripe->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.stripe.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }


            }
            elseif($request->selected_payment_gateway === 'razorpay'){

                try{
                    $razorpay_api_key = getenv('RAZORPAY_API_KEY');
                    $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');
                    $razorpay = XgPaymentGateway::razorpay();
                    $razorpay->setApiKey($razorpay_api_key);
                    $razorpay->setApiSecret($razorpay_api_secret);
                    $razorpay->setCurrency($global_currency);
                    $razorpay->setEnv(true); //env must set as boolean, string will not work
                    $razorpay->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $razorpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.razorpay.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'flutterwave'){
                try{
                    $flutterwave_public_key = getenv("FLW_PUBLIC_KEY");
                    $flutterwave_secret_key = getenv("FLW_SECRET_KEY");
                    $flutterwave_secret_hash = getenv("FLW_SECRET_HASH");

                    $flutterwave = XgPaymentGateway::flutterwave();
                    $flutterwave->setPublicKey($flutterwave_public_key);
                    $flutterwave->setSecretKey($flutterwave_secret_key);
                    $flutterwave->setCurrency($global_currency);
                    $flutterwave->setEnv(true); //env must set as boolean, string will not work
                    $flutterwave->setExchangeRate($usd_conversion_rate); // if NGN not set as currency

                    $redirect_url = $flutterwave->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.flutterwave.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                }
                catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'paystack'){
                try{
                    $paystack_public_key = getenv('PAYSTACK_PUBLIC_KEY');
                    $paystack_secret_key = getenv('PAYSTACK_SECRET_KEY');
                    $paystack_merchant_email = getenv('MERCHANT_EMAIL');

                    $paystack = XgPaymentGateway::paystack();
                    $paystack->setPublicKey($paystack_public_key);
                    $paystack->setSecretKey($paystack_secret_key);
                    $paystack->setMerchantEmail($paystack_merchant_email);
                    $paystack->setCurrency($global_currency);
                    $paystack->setEnv(true); //env must set as boolean, string will not work
                    $paystack->setExchangeRate($ngn_exchange_rate); // if NGN not set as currency

                    $redirect_url = $paystack->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.paystack.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' =>  $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'payfast'){
                try{
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $payfast_merchant_id = getenv('PF_MERCHANT_ID');
                    $payfast_merchant_key = getenv('PF_MERCHANT_KEY');
                    $payfast_passphrase = getenv('PAYFAST_PASSPHRASE');
                    $payfast_env = getenv('PF_MERCHANT_ENV') === 'true';

                    $payfast = XgPaymentGateway::payfast();
                    $payfast->setMerchantId($payfast_merchant_id);
                    $payfast->setMerchantKey($payfast_merchant_key);
                    $payfast->setPassphrase($payfast_passphrase);
                    $payfast->setCurrency($global_currency);
                    $payfast->setEnv($payfast_env); //env must set as boolean, string will not work
                    $payfast->setExchangeRate($zar_exchange_rate); // if ZAR not set as currency

                    $redirect_url = $payfast->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.payfast.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' =>  $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;
                } catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'cashfree'){

                try{
                    $cashfree_env = getenv('CASHFREE_TEST_MODE') === 'true';
                    $cashfree_app_id = getenv('CASHFREE_APP_ID');
                    $cashfree_secret_key = getenv('CASHFREE_SECRET_KEY');

                    $cashfree = XgPaymentGateway::cashfree();
                    $cashfree->setAppId($cashfree_app_id);
                    $cashfree->setSecretKey($cashfree_secret_key);
                    $cashfree->setCurrency($global_currency);
                    $cashfree->setEnv($cashfree_env); //true means sandbox, false means live , //env must set as boolean, string will not work
                    $cashfree->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $cashfree->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.cashfree.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' =>  $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'instamojo'){

                try{
                    $instamojo_client_id = getenv('INSTAMOJO_CLIENT_ID');
                    $instamojo_client_secret = getenv('INSTAMOJO_CLIENT_SECRET');
                    $instamojo_env = getenv('INSTAMOJO_TEST_MODE') === 'true';

                    $instamojo = XgPaymentGateway::instamojo();
                    $instamojo->setClientId($instamojo_client_id);
                    $instamojo->setSecretKey($instamojo_client_secret);
                    $instamojo->setCurrency($global_currency);
                    $instamojo->setEnv($instamojo_env); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
                    $instamojo->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $instamojo->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.instamojo.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => 'asdfasdfsdf',
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'marcadopago'){
                try{
                    $mercadopago_client_id = getenv('MERCADO_PAGO_CLIENT_ID');
                    $mercadopago_client_secret = getenv('MERCADO_PAGO_CLIENT_SECRET');
                    $mercadopago_env =  getenv('MERCADO_PAGO_TEST_MOD') === 'true';

                    $marcadopago = XgPaymentGateway::marcadopago();
                    $marcadopago->setClientId($mercadopago_client_id);
                    $marcadopago->setClientSecret($mercadopago_client_secret);
                    $marcadopago->setCurrency($global_currency);
                    $marcadopago->setExchangeRate($brl_exchange_rate); // if BRL not set as currency, you must have to provide exchange rate for it
                    $marcadopago->setEnv($mercadopago_env); ////true mean sandbox mode , false means live mode
                    ///
                    $redirect_url = $marcadopago->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.marcadopago.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'midtrans'){

                try{
                    $midtrans_env =  getenv('MIDTRANS_ENVAIRONTMENT') === 'true';
                    $midtrans_server_key = getenv('MIDTRANS_SERVER_KEY');
                    $midtrans_client_key = getenv('MIDTRANS_CLIENT_KEY');

                    $midtrans = XgPaymentGateway::midtrans();
                    $midtrans->setClientKey($midtrans_client_key);
                    $midtrans->setServerKey($midtrans_server_key);
                    $midtrans->setCurrency($global_currency);
                    $midtrans->setEnv($midtrans_env); //true mean sandbox mode , false means live mode
                    $midtrans->setExchangeRate($idr_exchange_rate); // if IDR not set as currency

                    $redirect_url = $midtrans->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.midtrans.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'squareup'){

                try{
                    $squareup_env =  !empty(get_static_option('squareup_test_mode'));
                    $squareup_location_id = get_static_option('squareup_location_id');
                    $squareup_access_token = get_static_option('squareup_access_token');
                    $squareup_application_id = get_static_option('squareup_application_id');

                    $squareup = XgPaymentGateway::squareup();
                    $squareup->setLocationId($squareup_location_id);
                    $squareup->setAccessToken($squareup_access_token);
                    $squareup->setApplicationId($squareup_application_id);
                    $squareup->setCurrency($global_currency);
                    $squareup->setEnv($squareup_env);
                    $squareup->setExchangeRate($usd_conversion_rate); // if USD not set as currency


                    $redirect_url = $squareup->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.squareup.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }

            }
            elseif($request->selected_payment_gateway === 'cinetpay'){
                try{
                    $cinetpay_env =  !empty(get_static_option('cinetpay_test_mode'));
                    $cinetpay_site_id = get_static_option('cinetpay_site_id');
                    $cinetpay_app_key = get_static_option('cinetpay_app_key');

                    $cinetpay = XgPaymentGateway::cinetpay();
                    $cinetpay->setAppKey($cinetpay_app_key);
                    $cinetpay->setSiteId($cinetpay_site_id);
                    $cinetpay->setCurrency($global_currency);
                    $cinetpay->setEnv($cinetpay_env);
                    $cinetpay->setExchangeRate($usd_conversion_rate); // if ['XOF', 'XAF', 'CDF', 'GNF', 'USD'] not set as currency

                    $redirect_url = $cinetpay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.cinetpay.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'paytabs'){
                try{
                    $paytabs_env =  !empty(get_static_option('paytabs_test_mode'));
                    $paytabs_region = get_static_option('paytabs_region');
                    $paytabs_profile_id = get_static_option('paytabs_profile_id');
                    $paytabs_server_key = get_static_option('paytabs_server_key');

                    $paytabs = XgPaymentGateway::paytabs();
                    $paytabs->setProfileId($paytabs_profile_id);
                    $paytabs->setRegion($paytabs_region);
                    $paytabs->setServerKey($paytabs_server_key);
                    $paytabs->setCurrency($global_currency);
                    $paytabs->setEnv($paytabs_env);
                    $paytabs->setExchangeRate($usd_conversion_rate); // if ['AED','EGP','SAR','OMR','JOD','USD'] not set as currency

                    $redirect_url = $paytabs->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.paytabs.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'billplz'){
                try{

                    $billplz_env =  !empty(get_static_option('billplz_test_mode'));
                    $billplz_key =  get_static_option('billplz_key');
                    $billplz_xsignature =  get_static_option('billplz_xsignature');
                    $billplz_collection_name =  get_static_option('billplz_collection_name');

                    $billplz = XgPaymentGateway::billplz();
                    $billplz->setKey($billplz_key);
                    $billplz->setVersion('v4');
                    $billplz->setXsignature($billplz_xsignature);
                    $billplz->setCollectionName($billplz_collection_name);
                    $billplz->setCurrency($global_currency);
                    $billplz->setEnv($billplz_env);
                    $billplz->setExchangeRate($myr_exchange_rate); // if ['MYR'] not set as currency
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_deposit_id.$random_order_id_2;

                    $redirect_url = $billplz->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.billplz.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);

                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            elseif($request->selected_payment_gateway === 'zitopay'){
                try{

                    $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
                    $zitopay_username =  get_static_option('zitopay_username');

                    $zitopay = XgPaymentGateway::zitopay();
                    $zitopay->setUsername($zitopay_username);
                    $zitopay->setCurrency($global_currency);
                    $zitopay->setEnv($zitopay_env);
                    $zitopay->setExchangeRate($usd_conversion_rate);

                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_deposit_id.$random_order_id_2;

                    $redirect_url = $zitopay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('seller.zitopay.ipn.wallet'),
                        'order_id' => $last_deposit_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'deposit',
                    ]);
                    session()->put('order_id',$last_deposit_id);
                    return $redirect_url;

                }catch(\Exception $e){
                    return back()->with(['msg' => $e->getMessage(),'type' => 'danger']);
                }
            }
            else{
                //todo check Bookmi meta data for new payment gateway
                $module_meta =  new ModuleMetaData();
                $list = $module_meta->getAllPaymentGatewayList();
                if (in_array($request->selected_payment_gateway,$list)){
                    //todo call the module payment gateway customerCharge function
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_deposit_id.$random_order_id_2;

                    $customerChargeMethod = $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($request->selected_payment_gateway);
                    try {
                        $returned_val = $customerChargeMethod([
                            'amount' => $total,
                            'title' => $title,
                            'description' => $description,
                            'ipn_url' => null,
                            'order_id' => $last_deposit_id,
                            'track' => \Str::random(36),
                            'cancel_url' => route(self::CANCEL_ROUTE,$last_deposit_id),
                            'success_url' => route('buyer.orders'),
                            'email' => $email,
                            'name' => $name,
                            'payment_type' => 'deposit',
                        ]);

                        if(is_array($returned_val) && isset($returned_val['route'])){
                            $return_url = !empty($returned_val['route']) ? $returned_val['route'] : route('homepage');
                            return redirect()->away($return_url);
                        }

                    }catch (\Exception $e){
                        toastr_error( $e->getMessage());
                        return back();
                    }
                }
            }
        }
    }
}
