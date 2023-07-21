<?php

namespace Modules\JobPost\Http\Controllers\Frontend;

use App\AdminCommission;
use App\Category;
use App\Helpers\FlashMsg;
use App\Helpers\ModuleMetaData;
use App\Mail\OrderMail;
use App\Notifications\OrderNotification;
use App\Order;
use App\Service;
use App\Tax;
use App\User;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobRequest;
use Modules\JobPost\Entities\JobRequestConversation;
use Modules\Wallet\Entities\Wallet;
use Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class JobRequestController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.order.payment.cancel.static';


    public function job_order_payment_cancel_static()
    {
        return view('jobpost::frontend.buyer.payment-cancel-static');
    }

    public function all_jobs()
    {
        $all_job_requests = JobRequest::with('job')
            ->where('buyer_id',Auth::guard('web')->user()->id)
            ->orderByDesc('id')
            ->paginate(10);
        return view('jobpost::frontend.buyer.job-requests',compact('all_job_requests'));
    }

    public function request_delete($id)
    {
        $job_request = JobRequest::find($id);
        //delete all pending order from order table 
        $order_details =  Order::where(['job_post_id' => $job_request->job_post_id,'seller_id' => $job_request->seller_id])->first();
        //delete notification of that speecif order
        JobRequestConversation::where()->delete($job_request->id);
        $job_request->delete();
        $order_details->delete();
        //delete job request converstaion //
        \DB::table('notifications')->whereJsonContains('data->order_id',4)->delete();

        toastr_success(__('Job request deleted success'));
        return back();
    }

    public function conversation(Request $request, $id)
    {
        $request_details = JobRequest::with('job')
            ->where('buyer_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)
            ->where('id',$id)
            ->first();
        $all_messages = JobRequestConversation::where(['job_request_id'=>$id])->get();
        $q = $request->q ?? '';
        return view('jobpost::frontend.buyer.conversation', compact('request_details','all_messages','q'));
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $request_info = JobRequestConversation::create([
            'job_request_id' => $request->request_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/job-request',$file_name);
            $request_info->attachment = $file_name;
            $request_info->save();
        }

        //send mail to user
//        event(new SupportMessage($ticket_info));
        return redirect()->back()->with(FlashMsg::item_new(__('Message Send')));
    }

    public function seller_all_jobs()
    {
        $all_job_requests = JobRequest::with('job')
            ->where('seller_id',Auth::guard('web')->user()->id)
            ->orderByDesc('id')
            ->paginate(10);
        return view('jobpost::frontend.seller.job-requests',compact('all_job_requests'));
    }

    // edit seller job request budget
    public function sellerJobRequestEdit(Request $request)
    {
        $request->validate([
            'expected_salary' => 'required',
        ]);

        JobRequest::where('seller_id',Auth::guard('web')->user()->id)->where('id', $request->up_id)->update([
            'expected_salary' => $request->expected_salary,
        ]);

        toastr_success('Job Request Offer Price Update Successfully');
        return back();
    }

    //new jobs notification
    public function new_jobs()
    {
        $jobs = BuyerJob::whereDoesntHave('sellerViewJobs', function ($list){
            $list->where('seller_id', Auth::guard('web')->user()->id);
        })->latest()->paginate(10);
        return view('jobpost::frontend.seller.new-jobs',compact('jobs'));
    }

    public function seller_conversation(Request $request, $id)
    {
        $request_details = JobRequest::with('job')
            ->where('seller_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)
            ->where('id',$id)
            ->first();
        $all_messages = JobRequestConversation::where(['job_request_id'=>$id])->get();
        $q = $request->q ?? '';
        return view('jobpost::frontend.seller.conversation', compact('request_details','all_messages','q'));
    }

    public function seller_send_message(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $request_info = JobRequestConversation::create([
            'job_request_id' => $request->request_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/job-request',$file_name);
            $request_info->attachment = $file_name;
            $request_info->save();
        }

        //send mail to user
//        event(new SupportMessage($ticket_info));
        return redirect()->back()->with(FlashMsg::item_new(__('Message Send')));
    }

    public function hire_seller(Request $request, $id)
    {
        $request_details = JobRequest::findOrFail($id);
        if($request->selected_payment_gateway === 'manual_payment') {
            $request->validate([
                'manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);
        }

        //(if Subscription else admin commission calculate)
        $admin_commmission = AdminCommission::first();

        if($admin_commmission->system_type == 'subscription'){
            if(subscriptionModuleExistsAndEnable('Subscription')){
                $commission_amount = 0;
                \Modules\Subscription\Entities\SellerSubscription::where('id', $request->seller_id)->update([
                    'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                ]);
            }
        }else{
            if($admin_commmission->commission_charge_type=='percentage'){
                $commission_amount = ($request_details->expected_salary*$admin_commmission->commission_charge)/100;
            }else{
                $commission_amount = $admin_commmission->commission_charge;
            }
        }

        if($request->selected_payment_gateway=='cash_on_delivery' || $request->selected_payment_gateway == 'manual_payment'){
            $payment_status='pending';
        }else{
            $payment_status='';
        }

        //tax amount calculate
        $tax_amount =0;
        if(optional($request_details->job)->country_id != 0){
            $country_tax =  Tax::select('id','tax')->where('country_id',optional($request_details->job)->country_id)->first();
            $country_tax = $country_tax->tax ?? 0;
            $tax_amount = ($request_details->expected_salary * $country_tax) / 100;
        }
        $total = $request_details->expected_salary + $tax_amount;


        //buyer info get
        $user = Auth::guard('web')->user();
        $is_check = Auth::guard('web')->check();
        $is_job_online = optional($request_details->job)->is_job_online;

        $buyer_id =  $is_check ? $user->id : NULL;
        $name = $is_check ? $user->name : NULL;
        $email = $is_check ? $user->email : NULL;
        $phone = $is_check ? $user->phone : NULL;
        $post_code = $is_check ? $user->post_code : NULL;
        $address = $is_check ? $user->address : NULL;
        $city = $is_check ? $user->service_city : NULL;
        $area = $is_check ? $user->service_area : NULL;
        $country = $is_check ? $user->country_id : NULL;

        $order_details = Order::create([
            'service_id' => '0',
            'seller_id' => $request_details->seller_id,
            'buyer_id' => $buyer_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'post_code' => $post_code ?? 0000,
            'address' => $address ?? " ",
            'city' => $city,
            'area' => $area,
            'country' => $country,
            'date' => 'No Date Created',
            'schedule' => 'No Schedule Created',
            'package_fee' => 0,
            'extra_service' => 0,
            'sub_total' => $total,
            'tax' => $tax_amount,
            'total' => $total,
            'commission_type' => $admin_commmission->commission_charge_type,
            'commission_charge' => $admin_commmission->commission_charge,
            'commission_amount' => $commission_amount,
            'status' => 0,
            'order_note' => NULL,
            'payment_gateway' => $request->selected_payment_gateway,
            'payment_status' => $payment_status,
            'order_from_job' => 'yes',
            'job_post_id' => $request_details->job_post_id,
            'is_order_online' => $is_job_online,
        ]);

        $last_order_id = $order_details->id;
        $job_post_title = optional($request_details->job)->title;
        $title = Str::limit($job_post_title,20);
        $description = sprintf(__('Order id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$email,$name);

        //Send order notification to seller
        $seller = User::where('id',$request_details->seller_id)->first();
        $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
        $order_message = __('You have a new order');
        $seller->notify(new OrderNotification($last_order_id,$request_details->job_post_id, $request_details->seller_id, $buyer_id,$order_message));

        // variable for all payment gateway
        $global_currency = get_static_option('site_global_currency');

        $usd_conversion_rate =  get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $inr_exchange_rate = getenv('INR_EXCHANGE_RATE');
        $ngn_exchange_rate = getenv('NGN_EXCHANGE_RATE');
        $zar_exchange_rate = getenv('ZAR_EXCHANGE_RATE');
        $brl_exchange_rate = getenv('BRL_EXCHANGE_RATE');
        $idr_exchange_rate = getenv('IDR_EXCHANGE_RATE');
        $myr_exchange_rate = getenv('MYR_EXCHANGE_RATE');


        //todo: check payment gateway is wallet or not
        if(moduleExists('Wallet')){
            if ($request->selected_payment_gateway === 'wallet') {
                $order_details = Order::find($last_order_id);
                $random_order_id_1 = Str::random(30);
                $random_order_id_2 = Str::random(30);
                $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;
                $buyer_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL;
                $wallet_balance = Wallet::where('buyer_id',$buyer_id)->first();

                if(!empty($wallet_balance)){
                    if($wallet_balance->balance >= $order_details->total){
                        //Send order email to buyer for cash on delivery
                        try {
                            $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an order #');
                            $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new order #');
                            Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                            Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                            Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));


                        } catch (\Exception $e) {
                            \Toastr::error($e->getMessage());
                        }
                        Order::where('id', $last_order_id)->update([
                            'payment_status' => 'complete',
                            'payment_gateway' => 'wallet',
                        ]);
                        Wallet::where('buyer_id',$buyer_id)->update([
                            'balance' => $wallet_balance->balance-$order_details->total,
                        ]);
                    }else{
                        $shortage_balance =  $order_details->total-$wallet_balance->balance;
                        toastr_warning('Your wallet has '.float_amount_with_currency_symbol($shortage_balance).' shortage to order this service. Please Credit your wallet first and try again.');
                        return back();
                    }
                }
                toastr_success('Your Order Created Successfully');
                return back();
            }
        }


        if ($request->selected_payment_gateway === 'cash_on_delivery') {
            $order_details = Order::find($last_order_id);
            $random_order_id_1 = Str::random(30);
            $random_order_id_2 = Str::random(30);
            $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

            //Send order email to buyer for cash on delivery
            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an order #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new order #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            return redirect()->route('frontend.order.payment.success',$new_order_id);
        }


        if($request->selected_payment_gateway === 'manual_payment') {
            $order_details = Order::find($last_order_id);
            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();

                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                    $manual_image_path = 'assets/uploads/manual-payment/';
                    $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                    Order::where('id',$last_order_id)->update([
                        'manual_payment_image'=>$manual_payment_image_name
                    ]);
                }else{
                    return back()->with(['msg' => __('image type not supported'),'type' => 'danger']);
                }
            }

            try {
                $message_for_buyer = get_static_option('new_order_buyer_message') ?? __('You have successfully placed an order #');
                $message_for_seller_admin = get_static_option('new_order_admin_seller_message') ?? __('You have a new order #');
                Mail::to($order_details->email)->send(new OrderMail(strip_tags($message_for_buyer).$order_details->id,$order_details));
                Mail::to($seller->email)->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));
                Mail::to(get_static_option('site_global_email'))->send(new OrderMail(strip_tags($message_for_seller_admin).$order_details->id,$order_details));

            } catch (\Exception $e) {
                \Toastr::error($e->getMessage());
            }
            toastr_success('Your Order Created Successfully');
            return redirect()->route('buyer.orders');

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
                        'ipn_url' => route('buyer.paypal.ipn.jobs'), //you will get payment response in this route
                        'order_id' => $last_order_id, // your order number
                        'track' => \Str::random(36), // a random number to keep track of your payment
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id), //payment gateway will redirect here if the payment is failed
                        'success_url' => route('buyer.orders'), // payment gateway will redirect here after success
                        'email' => $email, // user email
                        'name' => $name, // user name
                        'payment_type' => 'order', // which kind of payment your are receving from customer
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.paytm.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);

                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.mollie.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.stripe.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.razorpay.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.flutterwave.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.paystack.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' =>  $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.payfast.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' =>  $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.cashfree.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' =>  $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.instamojo.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => 'asdfasdfsdf',
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.marcadopago.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.midtrans.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.squareup.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.cinetpay.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        'ipn_url' => route('buyer.paytabs.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $billplz->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('buyer.billplz.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);

                    session()->put('order_id',$last_order_id);
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
                    $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                    $redirect_url = $zitopay->charge_customer([
                        'amount' => $total,
                        'title' => $title,
                        'description' => $description,
                        'ipn_url' => route('buyer.zitopay.ipn.jobs'),
                        'order_id' => $last_order_id,
                        'track' => \Str::random(36),
                        'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                        'success_url' => route('buyer.orders'),
                        'email' => $email,
                        'name' => $name,
                        'payment_type' => 'order',
                    ]);
                    session()->put('order_id',$last_order_id);
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
                        $new_order_id = $random_order_id_1.$last_order_id.$random_order_id_2;

                        $customerChargeMethod =  $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($request->selected_payment_gateway);
                        try {
                            $returned_val = $customerChargeMethod([
                               'amount' => $total,
                                'title' => $title,
                                'description' => $description,
                                'ipn_url' => null,
                                'order_id' => $last_order_id,
                                'track' => \Str::random(36),
                                'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
                                'success_url' => route('buyer.orders'),
                                'email' => $email,
                                'name' => $name,
                                'payment_type' => 'job',
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
