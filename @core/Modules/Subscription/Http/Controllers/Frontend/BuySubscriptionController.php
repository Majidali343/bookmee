<?php

namespace Modules\Subscription\Http\Controllers\Frontend;

use App\Helpers\ModuleMetaData;
use App\Mail\BasicMail;
use App\Mail\OrderMail;
use App\Order;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\SellerSubscription;
use Auth;
use Modules\Subscription\Entities\SubscriptionCoupon;
use Modules\Subscription\Entities\SubscriptionHistory;
use Modules\Wallet\Entities\Wallet;
use Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class BuySubscriptionController extends Controller
{
    private const CANCEL_ROUTE = 'seller.subscription.payment.cancel.static';
    private const SUCCESS_ROUTE = 'seller.subscription.payment.success';

    protected function subscription_payment_cancel(){
        return redirect()->route('frontend.subscription.payment.cancel.static');
    }

    public function subscription_payment_cancel_static()
    {
        return view('subscription::frontend.subscription.payment.payment-cancel-static');
    }

    public function subscription_payment_success($id)
    {
        $subscription_id = substr($id,30,-30);
        $subscription_details = SellerSubscription::find($subscription_id);
        return view('subscription::frontend.subscription.payment.success')->with(['subscription_details' => $subscription_details]);
    }

    public function buy_subscription(Request $request)
    {

        if(isset($request->subscription_id)){
            if($request->type=='monthly'){
                $expire_date = Carbon::now()->addDays(30);
                $connect = $request->connect;
            }elseif($request->type=='yearly'){
                $expire_date = Carbon::now()->addDays(365);
                $connect = $request->connect;
            }elseif($request->type=='lifetime'){
                $expire_date = Carbon::now()->addDays(3650);
                $connect = 1000000;
            }
            $price = $request->price;

            //seller complete payment later
            $last_subscription_id = $request->subscription_id;
            $user_name = Auth::guard('web')->user()->name;
            $user_email = Auth::guard('web')->user()->email;
            $last_subscription_history = SubscriptionHistory::where('seller_id',Auth::guard('web')->user()->id)->orderBy('id','Desc')->first();
            if($last_subscription_history){
                $last_subscription_history = $last_subscription_history->id;
            }
            //seller complete payment later
            if($request->selected_payment_gateway == 'manual_payment'){
                $payment_status='pending';
                if(!isset($request->manual_payment_image)){
                    toastr_error(__('Image is Required For Manual Payment. Type: jpg, jpeg, png, pdf'));
                    return redirect()->back();
                }
                $request->validate(
                    [
                        'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
                    ]);
            }else{
                $payment_status='';
            }
            // variable for all payment gateway
            $global_currency = get_static_option('site_global_currency');

            $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
            $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
            $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
            $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
            $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
            $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
            $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');

            if(!empty($request->apply_coupon_code)){
                $get_coupon_code = SubscriptionCoupon::where('code',$request->apply_coupon_code)->first();
                $current_date = date('Y-m-d');

                if(!empty($get_coupon_code)){
                    if($get_coupon_code->expire_date > $current_date){
                        if($get_coupon_code->discount_type == 'percentage'){
                            $discount = ($request->price * $get_coupon_code->discount)/100;
                            $price = $request->price - $discount;
                        }else{
                            $discount = $get_coupon_code->discount;
                            $price = $request->price - $discount;
                        }
                    }else{
                        toastr_error(__('Coupon is expired'));
                        return redirect()->back();
                    }

                }else{
                    toastr_error(__('Invalid coupon. Please enter a valid coupon'));
                    return redirect()->back();
                }
            }

            if($request->seller_payment_later != 'later'){
                if(Auth::guard('web')->check()){
                    $user_name = Auth::guard('web')->user()->name;
                    $user_email = Auth::guard('web')->user()->email;
                    $user_id = Auth::guard('web')->user()->id;
                    $seller_id_from_seller_subscription_table = SellerSubscription::select('id','seller_id','connect','expire_date')
                        ->where('seller_id',$user_id)
                        ->first();

                    $create_history = SubscriptionHistory::create([
                        'subscription_id' => $request->subscription_id,
                        'seller_id' => Auth::guard('web')->user()->id,
                        'type' => $request->type,
                        'connect' => $connect,
                        'coupon_code' => $get_coupon_code->code ?? 'No Coupon',
                        'coupon_type' =>$get_coupon_code->discount_type ?? 'No Type',
                        'coupon_amount' =>$discount ?? 0,
                        'price' => $price,
                        'expire_date' => $expire_date,
                        'payment_gateway' => $request->selected_payment_gateway,
                        'payment_status' => $payment_status,
                    ]);
                    $last_subscription_history = $create_history->id;

                    if($seller_id_from_seller_subscription_table){
                        $total = SellerSubscription::select('total')->where('seller_id',$seller_id_from_seller_subscription_table->seller_id)->first();
                        SellerSubscription::where('seller_id',$seller_id_from_seller_subscription_table->seller_id)
                            ->update([
                                'subscription_id' => $request->subscription_id,
                                'type' => $request->type,
                                'initial_price' => $price,
                                'total' => ($total->total+$price),
                                'initial_connect' => $connect,
                                'expire_date' => $expire_date,
                                'payment_gateway' => $request->selected_payment_gateway,
                                'payment_status' => $payment_status,
                            ]);
                        $last_subscription_id = $seller_id_from_seller_subscription_table->id;
                    }else{
                        $create_subscription = SellerSubscription::create([
                            'subscription_id' => $request->subscription_id,
                            'type' => $request->type,
                            'price' => 0,
                            'connect' => 0,
                            'initial_price' => $price,
                            'total' => $price,
                            'initial_connect' =>$connect,
                            'expire_date' => $expire_date,
                            'seller_id' => Auth::guard('web')->user()->id,
                            'status' => 0,
                            'payment_gateway' => $request->selected_payment_gateway,
                            'payment_status' => $payment_status,
                        ]);
                        $last_subscription_id = $create_subscription->id;
                    }
                }else{
                    toastr_error(__('You must login to buy a subscription'));
                    return redirect()->back();
                }
            }

            //todo: check payment gateway is wallet or not
            if(moduleExists('Wallet')){
                if ($request->selected_payment_gateway === 'wallet') {
                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_subscription_id.$random_order_id_2;

                    $seller_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
                    $wallet_balance = Wallet::where('buyer_id',$seller_id)->first();

                    $subscription_details = SellerSubscription::find($last_subscription_id);
                    if($subscription_details){
                        SellerSubscription::where('id', $last_subscription_id)->update([
                            'payment_status' => 'complete',
                            'connect' => ($subscription_details->initial_connect + $subscription_details->connect),
                            'price' => $subscription_details->initial_price,
                            'status' => 1,
                        ]);

                        SubscriptionHistory::where('id', $last_subscription_history)->update([
                            'payment_status' => 'complete',
                        ]);

                        Wallet::where('buyer_id',$seller_id)->update([
                            'balance' => $wallet_balance->balance-$subscription_details->initial_price,
                        ]);
                    }
                    //Send order email to admin and seller
                    try {
                        $connect = $request->type =='lifetime' ? __("No Limit") : $request->connect;
                        $message = get_static_option('buy_subscription_seller_message') ?? '';
                        $message = str_replace(["@type","@price","@connect"],[$request->type,float_amount_with_currency_symbol($price),$connect],$message);
                        Mail::to($user_email)->send(new BasicMail([
                            'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                            'message' => $message
                        ]));

                        $message = get_static_option('buy_subscription_admin_message') ?? '';
                        $message = str_replace(["@type","@price","@connect","@seller_name","@seller_email"],[$request->type,float_amount_with_currency_symbol($price),$connect,$user_name,$user_email],$message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                            'message' => $message
                        ]));

                    } catch (\Exception $e) {
                        \Toastr::error($e->getMessage());
                    }
                    return redirect()->route('seller.subscription.payment.success',$new_order_id);
                }
            }


            if($request->selected_payment_gateway === 'manual_payment') {
                $subscription_details = SellerSubscription::find($last_subscription_id);
                $random_order_id_1 = Str::random(30);
                $random_order_id_2 = Str::random(30);
                $new_order_id = $random_order_id_1.$last_subscription_id.$random_order_id_2;

                if($request->hasFile('manual_payment_image')){
                    $manual_payment_image = $request->manual_payment_image;
                    $img_ext = $manual_payment_image->extension();

                    $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                    if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                        $manual_image_path = 'assets/uploads/subscription/manual-payment/';
                        $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                        SellerSubscription::where('id',$last_subscription_id)->update([
                            'manual_payment_image'=>$manual_payment_image_name
                        ]);
                    }else{
                        return back()->with(['msg' => __('image type not supported'),'type' => 'danger']);
                    }
                }

                //Send order email to admin and seller
                try {
                    $connect = $request->type =='lifetime' ? __("No Limit") : $request->connect;
                    $message = get_static_option('buy_subscription_seller_message') ?? '';
                    $message = str_replace(["@type","@price","@connect"],[$request->type,float_amount_with_currency_symbol($price),$connect],$message);
                    Mail::to($user_email)->send(new BasicMail([
                        'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                        'message' => $message
                    ]));

                    $message = get_static_option('buy_subscription_admin_message') ?? '';
                    $message = str_replace(["@type","@price","@connect","@seller_name","@email"],[$request->type,float_amount_with_currency_symbol($price),$connect,$user_name,$user_email],$message);
                    Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                        'subject' =>get_static_option('buy_subscription_email_subject') ?? __('New Subscription'),
                        'message' => $message
                    ]));

                } catch (\Exception $e) {
                    \Toastr::error($e->getMessage());
                }
                return redirect()->route('seller.subscription.payment.success',$new_order_id);

            }
            else{
                if ($request->selected_payment_gateway === 'paypal') {

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
                        'amount' => $price, // amount you want to charge from customer
                        'title' => $request->type, // payment title
                        'description' => 'Subscription', // payment description
                        'ipn_url' => route('seller.paypal.ipn.subs'), //you will get payment response in this route
                        'order_id' => $last_subscription_id, // your order number
                        'track' => \Str::random(36), // a random number to keep track of your payment
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id), //payment gateway will redirect here if the payment is failed
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id), // payment gateway will redirect here after success
                        'email' => $user_email, // user email
                        'name' => $user_name, // user name
                        'payment_type' => 'order', // which kind of payment your are receving from customer
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'paytm'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.paytm.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'mollie'){

                    $mollie_key = getenv('MOLLIE_KEY');
                    $mollie = XgPaymentGateway::mollie();
                    $mollie->setApiKey($mollie_key);
                    $mollie->setCurrency($global_currency);
                    $mollie->setEnv(true); //env must set as boolean, string will not work
                    $mollie->setExchangeRate($usd_conversion_rate); // if INR not set as currency

                    $redirect_url = $mollie->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.mollie.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'stripe'){

                    $stripe_public_key = getenv('STRIPE_PUBLIC_KEY');
                    $stripe_secret_key = getenv('STRIPE_SECRET_KEY');
                    $stripe = XgPaymentGateway::stripe();
                    $stripe->setSecretKey($stripe_secret_key);
                    $stripe->setPublicKey($stripe_public_key);
                    $stripe->setCurrency($global_currency);
                    $stripe->setEnv(true); //env must set as boolean, string will not work
                    $stripe->setExchangeRate($usd_conversion_rate); // if INR not set as currency


                    $redirect_url = $stripe->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.stripe.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'razorpay'){

                    $razorpay_api_key = getenv('RAZORPAY_API_KEY');
                    $razorpay_api_secret = getenv('RAZORPAY_API_SECRET');
                    $razorpay = XgPaymentGateway::razorpay();
                    $razorpay->setApiKey($razorpay_api_key);
                    $razorpay->setApiSecret($razorpay_api_secret);
                    $razorpay->setCurrency($global_currency);
                    $razorpay->setEnv(true); //env must set as boolean, string will not work
                    $razorpay->setExchangeRate($inr_exchange_rate); // if INR not set as currency

                    $redirect_url = $razorpay->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.razorpay.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'flutterwave'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.flutterwave.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'paystack'){

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

                    $redirect_url =$paystack->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.paystack.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' =>  $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'payfast'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.payfast.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$random_order_id_1.$last_subscription_id.$random_order_id_2),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'cashfree'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.cashfree.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' =>  $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'instamojo'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.instamojo.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => 'asdfasdfsdf',
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'marcadopago'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.marcadopago.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'midtrans'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.midtrans.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'squareup'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.squareup.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'cinetpay'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.cinetpay.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'paytabs'){

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
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.paytabs.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$last_subscription_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'billplz'){

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
                    $new_order_id = $random_order_id_1.$last_subscription_id.$random_order_id_2;

                    $redirect_url = $billplz->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.billplz.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                elseif($request->selected_payment_gateway === 'zitopay'){

                    $zitopay_env =  !empty(get_static_option('zitopay_test_mode'));
                    $zitopay_username =  get_static_option('zitopay_username');

                    $zitopay = XgPaymentGateway::zitopay();
                    $zitopay->setUsername($zitopay_username);
                    $zitopay->setCurrency($global_currency);
                    $zitopay->setEnv($zitopay_env);
                    $zitopay->setExchangeRate($usd_conversion_rate);

                    $random_order_id_1 = Str::random(30);
                    $random_order_id_2 = Str::random(30);
                    $new_order_id = $random_order_id_1.$last_subscription_id.$random_order_id_2;

                    $redirect_url = $zitopay->charge_customer([
                        'amount' => $price,
                        'title' => $request->type,
                        'description' => 'Subscription',
                        'ipn_url' => route('seller.zitopay.ipn.subs'),
                        'order_id' => $last_subscription_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                        'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                        'email' => $user_email,
                        'name' => $user_name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_subscription_id);
                    session()->put('history_id',$last_subscription_history);
                    return $redirect_url;
                }
                else {
                    //todo check Bookmi meta data for new payment gateway
                    $module_meta =  new ModuleMetaData();
                    $list = $module_meta->getAllPaymentGatewayList();
                    if (in_array($request->selected_payment_gateway,$list)){
                        //todo call the module payment gateway customerCharge function
                        $random_order_id_1 = Str::random(30);
                        $random_order_id_2 = Str::random(30);
                        $new_order_id = $random_order_id_1.$last_subscription_id.$random_order_id_2;

                        $customerChargeMethod =  $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($request->selected_payment_gateway);
                        try {
                            $return_url = $customerChargeMethod([
                                'amount' => $price,
                                'title' => $request->type,
                                'description' => 'Subscription',
                                'ipn_url' => route('seller.zitopay.ipn.subs'),
                                'order_id' => $last_subscription_id,
                                'track' => \Str::random(36),
                                'cancel_url' => route(self::CANCEL_ROUTE,$last_subscription_id),
                                'success_url' => route(self::SUCCESS_ROUTE,$new_order_id),
                                'email' => $user_email,
                                'name' => $user_name,
                                'payment_type' => 'subscription',
                                'history_id' => $last_subscription_history
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
        toastr_success(__('You have successfully buy a subscription'));
        return redirect()->back();
    }

    public function apply_coupon(Request $request)
    {
        if(!empty($request->apply_coupon_code)){
            $get_coupon_code = SubscriptionCoupon::where('code',$request->apply_coupon_code)->first();
            $current_date = date('Y-m-d');

            if(!empty($get_coupon_code)){
                if($get_coupon_code->expire_date > $current_date){
                    if($get_coupon_code->discount_type == 'percentage'){
                        $discount = ($request->subscription_price * $get_coupon_code->discount)/100;
                        $price = $request->subscription_price - $discount;
                    }else{
                        $discount = $get_coupon_code->discount;
                        $price = $request->subscription_price - $discount;
                    }
                }else{
                    $message = __('Coupon is expired');
                }
            }else{
                $message = __('Invalid coupon. Please enter a valid coupon');
            }
        }else{
            $message = __('Please enter a valid coupon');
        }

        return response()->json([
            'message'=>$message ?? '',
            'discount'=>$discount ?? '',
            'price'=>$price ?? '',
        ]);
    }



}
