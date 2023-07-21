<?php

namespace Modules\Subscription\Http\Controllers\Frontend;

use App\Mail\BasicMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Subscription\Entities\SellerSubscription;
use Auth;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\SubscriptionHistory;
use Modules\Wallet\Entities\Wallet;


class SellerSubsController extends Controller
{
    public function subscriptions()
    {
        $seller_id = Auth::guard('web')->user()->id;
        $subscription = SellerSubscription::where('seller_id', $seller_id)->first();
        $subscription_history = SubscriptionHistory::where('seller_id', $seller_id)->latest()->paginate(10);
        return view('subscription::frontend.seller.subscriptions', compact('subscription', 'subscription_history'));
    }

    public function sub_renew(Request $request)
    {
        if (moduleExists("Wallet")){
            if ($request->subscription_id) {
                $seller_id = Auth::guard('web')->user()->id;
                $seller_email = Auth::guard('web')->user()->email;
                $seller_name = Auth::guard('web')->user()->name;
                $subscription_details = Subscription::where('id', $request->subscription_id)->first();
                $seller_subscription = SellerSubscription::where('subscription_id', $request->subscription_id)->where('seller_id', $seller_id)->first();
                $wallet_balance = Wallet::select('balance')->where('buyer_id', $seller_id)->first();

                if ($wallet_balance->balance >= $subscription_details->price) {
                    if ($subscription_details->type == 'monthly') {
                        $expire_date = Carbon::now()->addDays(30);
                        $connect = $subscription_details->connect;
                    } elseif ($subscription_details->type == 'yearly') {
                        $expire_date = Carbon::now()->addDays(365);
                        $connect = $subscription_details->connect;
                    } elseif ($subscription_details->type == 'lifetime') {
                        $expire_date = Carbon::now()->addDays(3650);
                        $connect = 1000000;
                    }

                    SellerSubscription::where('subscription_id', $subscription_details->id)->update([
                        'payment_status' => 'complete',
                        'payment_gateway' => 'wallet',
                        'expire_date' => $expire_date,
                        'connect' => ($seller_subscription->connect + $connect),
                        'price' => $subscription_details->price,
                        'status' => 1,
                    ]);

                    Wallet::where('buyer_id', $seller_id)->update([
                        'balance' => $wallet_balance->balance - $subscription_details->price,
                    ]);

                    //Send order email to admin and seller
                    try {
                        $connect = $subscription_details->type =='lifetime' ? __("No Limit") : $connect;
                        $message = get_static_option('renew_subscription_seller_message') ?? '';
                        $message = str_replace(["@type","@price","@connect"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$connect],$message);
                        Mail::to($seller_email)->send(new BasicMail([
                            'subject' =>get_static_option('renew_subscription_email_subject') ?? __('Renew Subscription'),
                            'message' => $message
                        ]));


                        $message = get_static_option('buy_subscription_admin_message') ?? '';
                        $message = str_replace(["@type","@price","@connect","@seller_name","@seller_email"],[$subscription_details->type,float_amount_with_currency_symbol($subscription_details->price),$connect,$seller_name,$seller_email],$message);
                        Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                            'subject' =>get_static_option('renew_subscription_email_subject') ?? __('Renew Subscription'),
                            'message' => $message
                        ]));

                    } catch (\Exception $e) {
                        \Toastr::error($e->getMessage());
                    }

                    toastr_success(__('Your subscription renewed successfully'));
                } else {
                    toastr_warning(__('Your wallet balance is not sufficient to renew this subscription'));
                }
                return back();
            }
       }

    }
}
