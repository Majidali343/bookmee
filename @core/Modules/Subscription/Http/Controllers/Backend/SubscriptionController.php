<?php

namespace Modules\Subscription\Http\Controllers\Backend;

use App\Helpers\FlashMsg;
use App\Mail\BasicMail;
use App\Service;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Slider;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Modules\Subscription\Entities\SellerSubscription;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\SubscriptionCoupon;
use Modules\Subscription\Entities\SubscriptionHistory;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:subscription-list|subscription-edit|subscription-delete',['only' => ['subscriptions']]);
        $this->middleware('permission:subscription-edit',['only' => ['edit_subscription']]);
        $this->middleware('permission:subscription-delete',['only' => ['delete_subscription','bulk_action']]);
        $this->middleware('permission:seller-subscription-list',['only' => ['sellerSubscription']]);
        $this->middleware('permission:subscription-settings',['only' => ['settings']]);
    }

    public function subscriptions(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate(
                [
                    'image'=> 'required|max:191',
                    'title'=> 'required|max:191|unique:subscriptions',
                    'type'=> 'required|max:191',
                    'price'=> 'required',
                    'connect'=> 'required',
                ]);
            Subscription::create([
                'image' => $request->image,
                'title' => $request->title,
                'type' => $request->type,
                'price' => $request->price,
                'connect' => $request->connect,
                'service' => $request->service,
                'job' => $request->job,
                'status' => 1,
            ]);
            return redirect()->back()->with(FlashMsg::item_new('New Subscription Added'));
        }
        $subscriptions = Subscription::where('status',1)->get();
        return view('subscription::backend.all-subscription',compact('subscriptions'));
    }

    public function edit_subscription(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=> 'required|max:191|unique:subscriptions,title,'.$id,
                'type'=> 'required|max:191',
                'price'=> 'required',
                'connect'=> 'required|integer',
            ]);
            $old_image = Subscription::select('image')->where('id',$id)->first();
            Subscription::where('id',$id)->update([
                'title'=>$request->title,
                'type'=>$request->type,
                'price'=>$request->price,
                'connect'=>$request->connect,
                'service' => $request->service,
                'job' => $request->job,
                'image'=>$request->image ?? $old_image->image,
            ]);
            return redirect()->back()->with(FlashMsg::item_new('Subscription Update Success'));
        }
        $subscription = Subscription::find($id);
        return view('subscription::backend.edit-subscription',compact('subscription'));
    }

    public function connectSettings(Request $request)
    {
        $request->validate([
            'set_number_of_connect' => 'required|integer|gt:0'
        ]);
        update_static_option('set_number_of_connect',$request->set_number_of_connect);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));
    }

    public function delete_subscription($id){
        Subscription::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Subscription Deleted Success'));
    }

    public function bulk_action(Request $request){
        Subscription::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function sellerSubscription()
    {
        $subscriptions = Subscription::latest()->get();
        $seller_subscriptions = SellerSubscription::latest()->get();
        $sellers = User::where('user_type',0)->whereDoesntHave('subscribedSeller')->latest()->get();
        return view('subscription::backend.seller-subscriptions',compact('subscriptions','seller_subscriptions','sellers'));
    }

    public function seller_subscription_history($seller_id){
        $subscription_history = SubscriptionHistory::where('seller_id',$seller_id)->get();
        return view('subscription::backend.history',compact('subscription_history'));
    }

    public function sellerSubscriptionBuy(Request $request)
    {

        $request->validate([
            'subscription_id' => 'required',
            'seller_id' => 'required'
        ]);

        $subscription_details = Subscription::where('id',$request->subscription_id)->first();
        $expire_date = Carbon::now()->addDays(30);
        SellerSubscription::create([
            'subscription_id' => $request->subscription_id,
            'seller_id' => $request->seller_id,
            'type' => $subscription_details->type,
            'initial_price' => $subscription_details->price,
            'price' => $subscription_details->price,
            'total' => $subscription_details->price,
            'initial_connect' => $subscription_details->connect,
            'initial_service' => $subscription_details->service,
            'initial_job' => $subscription_details->job,
            'connect' => $request->payment_status == 'pending' ? $subscription_details->connect = 0 : $subscription_details->connect,
            'expire_date' => $expire_date,
            'payment_status' => $request->payment_status,
            'payment_gateway' => $request->payment_gateway,
        ]);
        return redirect()->back()->with(FlashMsg::item_new('Subscription Created Success'));
    }

    public function change_status($id)
    {
         $subs_details = SellerSubscription::find($id);
         if($subs_details->status == 0){
             $status = 1;
         }else{
             $status = 0;
         }

        SellerSubscription::where('id',$id)->update(['status'=>$status]);
        return redirect()->back()->with(FlashMsg::item_new('Status Changed Success'));
    }

    public function payment_status($id)
    {
        $subs_details = SellerSubscription::find($id);
        $seller_email = optional($subs_details->seller)->email;
        $status = ($subs_details->payment_status == 'pending' || $subs_details->payment_status == '') ? 'complete' : '';
        SellerSubscription::where('id',$id)
            ->update([
                'payment_status'=>$status,
                'price'=>$subs_details->initial_price,
                'connect'=>($subs_details->initial_connect+$subs_details->connect),
                'status'=>1,
            ]);

        //Send payment status complete email
        try {
            $message = get_static_option('payment_subscription_seller_message') ?? '';
            Mail::to($seller_email)->send(new BasicMail([
                'subject' => get_static_option('payment_subscription_email_subject') ?? __('Subscription Payment Status'),
                'message' => strip_tags($message)
            ]));

        } catch (\Exception $e) {
            \Toastr::error($e->getMessage());
        }

        return redirect()->back()->with(FlashMsg::item_new('Payment Status Changed Success'));
    }

    public function delete_seller_subscription($id){
        $seller = SellerSubscription::find($id)->first();
        $seller->delete();
        return redirect()->back()->with(FlashMsg::item_new('Seller Subscription Deleted Success'));
    }

    public function seller_bulk_action(Request $request)
    {
        SellerSubscription::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function send_email($id=null)
    {
       $seller = SellerSubscription::find($id);
       $seller_email = optional($seller->seller)->email;
       $expire_date = date('d-m-Y', strtotime($seller->expire_date));

        //Send order email to admin and seller
        try {
            $message_body_seller = __('Dear user,').'</br>'
                .'<span class="verify-code">'.__('Your subscription will be expired on').' '.$expire_date.'</br>'
                .'</span>';

            Mail::to($seller_email)->send(new BasicMail([
                'subject' => __('Subscription Reminder'),
                'message' => $message_body_seller
            ]));

        } catch (\Exception $e) {
            \Toastr::error($e->getMessage());
        }
        return redirect()->back()->with(FlashMsg::item_new('Email Send Success'));
    }

    public function settings(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'package_expire_notify_mail_days'=> 'required|array',
                'package_expire_notify_mail_days.*'=> 'required|max:7',
            ]);

            update_static_option('package_expire_notify_mail_days',json_encode($request->package_expire_notify_mail_days));
            return redirect()->back()->with(FlashMsg::item_new('Settings Update Success'));
        }
        return view('subscription::backend.settings');
    }

    public function coupon(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'code' => 'required|unique:subscription_coupons|max:191',
                'discount' => 'required|numeric',
                'discount_type' => 'required|max:191',
                'expire_date' => 'required',
            ]);

            SubscriptionCoupon::create([
                'code' => str_replace(' ', '', $request->code),
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'expire_date' => $request->expire_date,
                'status' => 0,
            ]);
            return redirect()->back()->with(FlashMsg::item_new('Coupon Added Success'));
        }
        $coupons = SubscriptionCoupon::latest()->get();
        return view('subscription::backend.coupons',compact('coupons'));
    }

    public function coupon_update(Request $request)
    {
        $request->validate([
            'up_code' => 'required|max:191|unique:subscription_coupons,code,'.$request->up_id,
            'up_discount' => 'required|numeric',
            'up_discount_type' => 'required|max:191',
            'up_expire_date' => 'required',
        ]);


        SubscriptionCoupon::where('id',$request->up_id)->update([
            'code' => str_replace(' ', '', $request->up_code),
            'discount' => $request->up_discount,
            'discount_type' => $request->up_discount_type,
            'expire_date' => $request->up_expire_date,
        ]);
        return redirect()->back()->with(FlashMsg::item_new('Coupon Updated Success'));
    }

    public function coupon_status($id=null)
    {
        $status = SubscriptionCoupon::select('status')->where('id', $id)->first();
        if ($status->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        SubscriptionCoupon::where('id',$id)->update([
            'status' => $status,
        ]);
        return redirect()->back()->with(FlashMsg::item_new('Coupon Status Change Success'));
    }

    public function coupon_delete($id = null)
    {
        SubscriptionCoupon::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new('Coupon Delete Success'));
    }

}
