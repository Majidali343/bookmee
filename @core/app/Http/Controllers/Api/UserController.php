<?php

namespace App\Http\Controllers\Api;

use App\ExtraService;
use App\Notifications\TicketNotificationSeller;
use App\Actions\Media\MediaHelper;
use App\Country;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Order;
use App\ServiceArea;
use App\Report;
use App\ServiceCity;
use App\SupportTicket;
use App\SupportTicketMessage;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\OrderCompleteDecline;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;

class UserController extends Controller
{
    public function walletBalance(){
        $buyer_id = auth('sanctum')->id();
        $user_info = auth('sanctum')->user();
        $user_column =  'buyer_id';

        $waller_details = Wallet::where($user_column,$buyer_id)->first();
        if (!is_null($waller_details)){
            return response([
                'balance' => amount_with_currency_symbol($waller_details->balance)
            ],200);
        }
        return response(['msg' => __('wallet not found')],422);
    }
    public function walletDeduct(Request $request){
        
        $request->validate([
            'amount' => 'required'
        ]);
        
        $buyer_id = auth('sanctum')->id();
        $user_column =  'buyer_id';

        $waller_details = Wallet::where($user_column,$buyer_id)->first();
        if (!is_null($waller_details)){
            
            if($waller_details->balance > $request->amount){
                
                $waller_details->balance -= $request->amount;
                $waller_details->save();
                
                return response([
                    'balance' => amount_with_currency_symbol($waller_details->balance),
                    'msg' => __("wallet charge success")
                ],200);
            }
           
            return response([
                'balance' => amount_with_currency_symbol($waller_details->balance),
                'msg' => __("wallet charge failed, due to insufficient balance")
            ],200);
        }
        return response(['msg' => __('wallet not found')],422);
    }

    public function walletHistory(){
        $buyer_id = auth('sanctum')->id();
        $user_info = auth('sanctum')->user();
        $user_column = 'buyer_id';

        $wallet_history = WalletHistory::select('id','buyer_id','payment_gateway','payment_status','amount')
            ->whereIn('payment_status',['complete','pending'])
            ->where([$user_column => $buyer_id])->get();
        if (!is_null($wallet_history)){
            return response([
                'history' => $wallet_history
            ],200);
        }
        return response(['msg' => __('no history found')],422);
    }

    public function walletDepositPaymentStatus(Request $request){

        $request->validate([
            'wallet_history_id' => 'required'
        ]);

        $buyer_id = auth('sanctum')->id();
        $user_info = auth('sanctum')->user();
        $user_column = 'buyer_id';
        $wallet_details = Wallet::where($user_column,$buyer_id)->first();
        
        $wallet_history = WalletHistory::where([$user_column => $buyer_id,'id' => $request->wallet_history_id ])->first();
        $wallet_history->payment_status = 'complete';
        $wallet_history->save();
        
        $wallet_details->balance += $wallet_history->amount;
        $wallet_details->save();
        

        return response(['msg' => __('wallet deposit success')],200);
    }

    

    public function walletDeposit(Request $request){

        $request->validate([
           'amount' => 'required',
           'payment_gateway' => 'required',
        ]);

        $buyer_id = auth('sanctum')->id();
        $user_info = auth('sanctum')->user();

        $user_column =  'buyer_id';
        $buyer = Wallet::where($user_column,$buyer_id)->first();
        if(empty($buyer)){
            Wallet::create([
                $user_column => $buyer_id,
                'balance' => 0,
                'status' => 0,
            ]);
        }

        $deposit_history = WalletHistory::create([
            $user_column => $buyer_id,
            'amount' => $request->amount,
            'payment_gateway' => $request->payment_gateway,
            'payment_status' => 'pending',
            'status' => 1
        ]);

        //if anual payment gateway it will add a image

        if($request->hasFile('manual_payment_image')){
            $manual_payment_image = $request->manual_payment_image;
            $img_ext = $manual_payment_image->extension();

            $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
            if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
                $manual_image_path = 'assets/uploads/manual-payment/';
                $manual_payment_image->move($manual_image_path,$manual_payment_image_name);
                
                WalletHistory::where('id',$deposit_history->id)->update([
                    'manual_payment_image'=>$manual_payment_image_name
                ]);
            }else{
                return response(['msg' => __('image type not supported')],422);
            }
        }

        try {
            $message_body = __('Hello a deposit request for user wallet. Please check and confirm').'</br>'.'<span class="verify-code">'.__('Deposit ID: ').$deposit_history->id.'</span>';
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('Deposit Confirmation'),
                'message' => $message_body
            ]));
            Mail::to($email)->send(new BasicMail([
                'subject' => __('Deposit Confirmation'),
                'message' => __('Manual deposit success. Your wallet will credited after admin approval #').$deposit_history->id
            ]));
        } catch (\Exception $e) {
            //
        }

        return response(['deposit_info' => [
            'amount' => $deposit_history->amount,
            'payment_gateway' => $deposit_history->payment_gateway,
            'wallet_history_id' => $deposit_history->id
        ]],200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:191',
            'password' => 'required',
        ]);

        $login_type = 'email';
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $login_type = 'username';
        }
        $user_type = 1;
        if($request->has('user_type')){
            $user_type = 0;
        }
        $user = User::select('id', 'email','user_type', 'password','country_id','state','username')->where([$login_type => $request->email,'user_type' => $user_type])->first();



        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->error([
                'message' => sprintf(__('Invalid %s or Password'),ucFirst($login_type))
            ]);
        } else {
            $token = $user->createToken(Str::slug(get_static_option('site_title', 'Bookmi')) . 'api_keys')->plainTextToken;
            return response()->success([
                'users' => $user,
                'token' => $token
            ]);
        }
    }

    //social login
    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->error([
                'message' => __('invalid Email'),
            ]);
        }
        $user_type = 1;
        if(!empty($request->user_type)){
            $user_type = 0;
        }

        $username = $request->isGoogle === 0 ?  'fb_'.Str::slug($request->displayName) : 'gl_'.Str::slug($request->displayName);
        $user = User::select('id', 'email', 'username','user_type')
            ->where('user_type' , $user_type)
            ->where('email', $request->email)
            ->Orwhere('username', $username)
            ->first();

        if (is_null($user)) {
            $user = User::create([
                'name' => $request->displayName,
                'email' => $request->email,
                'username' => $username,
                'password' => Hash::make(\Str::random(8)),
                'user_type' => $user_type,
                'terms_condition' => 1,
                'google_id' => $request->isGoogle === 1 ? $request->id : null,
                'facebook_id' => $request->isGoogle === 0 ? $request->id : null
            ]);
        }

        $token = $user->createToken(Str::slug(get_static_option('site_title', 'Bookmi')) . 'api_keys')->plainTextToken;
        return response()->success([
            'users' => $user,
            'token' => $token,
        ]);
    }

    // get country api
    public function country()
    {

        $countries = Country::select('id', 'country')->get();
        if ($countries) {
            return response()->success([
                'countries' => $countries,
            ]);
        } else {
            return response()->error([
                'message' => __("No Country Found"),
            ]);
        }

    }

    // get city under country api
    public function serviceCity($id)
    {
        $service_cities = ServiceCity::select('id', 'service_city')
            ->where('country_id', $id)
            ->get();
        if ($service_cities->count() >= 1) {
            return response()->json([
                'service_cities' => $service_cities,
            ]);
        } else {
            return response()->error([
                'message' => __('No Cities Available On The Selected Country'),
            ]);
        }

    }

    // get area under city and country api
    public function serviceArea($country_id, $city_id)
    {
        $service_areas = ServiceArea::select('id', 'service_area')
            ->where('country_id', $country_id)
            ->where('service_city_id', $city_id)
            ->get();

        if ($service_areas->count() >= 1) {
            return response()->json([
                'service_areas' => $service_areas,
            ]);
        } else {
            return response()->error([
                'message' => __('No Areas Available On The Selected City'),
            ]);
        }


    }

    //register api
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users|max:191',
            'username' => 'required|unique:users|max:191',
            'phone' => 'required|unique:users|max:191',
            'password' => 'required|min:6|max:191',
            'service_city' => 'required',
            'service_area' => 'required',
            'country_id' => 'required',
            'terms_conditions' => 'required',
        ]);
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->error([
                'message' => __('invalid Email'),
            ]);
        }

        $user_type = 1;
        if($request->has('user_type')){
            $user_type = 0;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'service_city' => $request->service_city,
            'state' => $request->service_city,
            'service_area' => $request->service_area,
            'country_code' => $request->country_code,
            'country_id' => $request->country_id,
            'user_type' => $user_type,
            'terms_condition' => 1,
        ]);
        if (!is_null($user)) {
            $token = $user->createToken(Str::slug(get_static_option('site_title', 'Bookmi')) . 'api_keys')->plainTextToken;
            return response()->success([
                'users' => $user,
                'token' => $token,
                'status' => 'ok',
            ]);
        }
        return response()->error([
            'message' => __('Something Went Wrong, Please try again'),
        ]);
    }

    // send otp
    public function sendOTPSuccess(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'email_verified' => 'required|integer',
        ]);

        if(!in_array($request->email_verified,[0,1])){
            return response()->error([
                'message' => __('email verify code must have to be 1 or 0'),
            ]);
        }

        $user = User::where('id', $request->user_id)->update([
            'email_verified' =>  $request->email_verified
        ]);

        if(is_null($user)){
            return response()->error([
                'message' => __('Something went wrong, plese try after sometime,'),
            ]);
        }

        return response()->success([
            'message' => __('Email Verify Success'),
        ]);
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $otp_code = sprintf("%d", random_int(1234, 9999));
        $user_email = User::where('email', $request->email)->first();

        if (!is_null($user_email)) {
            try {
                $message_body = __('Here is your otp code') . ' <span class="verify-code">' . $otp_code . '</span>';
                Mail::to($request->email)->send(new BasicMail([
                    'subject' => __('Your OTP Code'),
                    'message' => $message_body
                ]));
            } catch (\Exception $e) {
                return response()->error([
                    'message' => __($e->getMessage()),
                ]);
            }

            return response()->success([
                'email' => $request->email,
                'otp' => $otp_code,
            ]);

        } else {
            return response()->error([
                'message' => __('Email Does not Exists'),
            ]);
        }

    }

    //reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $user = User::select('email')->where('email', $email)->first();
        if (!is_null($user)) {
            User::where('email', $user->email)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->success([
                'message' => 'success',
            ]);
        } else {
            return response()->error([
                'message' => __('Email Not Found'),
            ]);
        }
    }

    //logout
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->success([
            'message' => __('Logout Success'),
        ]);
    }

    //User Profile
    public function profile(){

        $user_id = auth('sanctum')->id();

        $user = User::with('country','city','area')
            ->select('id','name','email','phone','address','about','country_id','service_city','service_area','post_code','image','country_code')
            ->where('id',$user_id)->first();

        $pending_orders = Order::where('status',0)
            ->where('buyer_id',$user_id)
            ->count();
        $active_orders = Order::where('status',1)
            ->where('buyer_id',$user_id)
            ->count();
        $complete_orders = Order::where('status',2)
            ->where('buyer_id',$user_id)
            ->count();
        $total_orders = Order::where('buyer_id',$user_id)
            ->count();

        $profile_image =  get_attachment_image_by_id($user->image);

        return response()->success([
            'user_details' => $user,
            'pending_order' => $pending_orders,
            'active_order' => $active_orders,
            'complete_order' => $complete_orders,
            'total_order' => $total_orders,
            'profile_image' => $profile_image,
        ]);
    }

    // change password after login
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);

        $user = User::select('id','password')->where('id', auth('sanctum')->user()->id)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->error([
                'message' => __('Current Password is Wrong'),
            ]);
        }
        User::where('id',auth('sanctum')->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return response()->success([
            'current_password' => $request->current_password,
            'new_password' => $request->new_password,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth('sanctum')->user();
        $user_id = auth('sanctum')->user()->id;

        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191|email|unique:users,email,'.$user_id,
            'phone' => 'required|max:191',
            'service_area' => 'required|max:191',
            'address' => 'required|max:191',
        ]);

        if($request->file('file')){
            MediaHelper::insert_media_image($request,'web');
            $last_image_id = DB::getPdo()->lastInsertId();
        }
        $old_image = User::select('image')->where('id',$user_id)->first();
        $user_update = User::where('id',$user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $last_image_id ?? $old_image->image,
                'service_city' => $request->service_city ?? $user->service_city,
                'service_area' => $request->service_area ?? $user->service_area,
                'country_id' => $request->country_id ?? $user->country_id,
                'post_code' => $request->post_code,
                'country_code' => $request->country_code,
                'address' => $request->address,
                'about' => $request->about,
                'state' => $request->service_city,
            ]);

        if($user_update){
            return response()->success([
                'message' =>__('Profile Updated Success'),
            ]);
        }
    }

    public function myOrders($id=null)
    {
       $uesr_info = auth('sanctum')->user()->id;
        $my_orders = Order::query();
        

        if(!empty($request->payment_status) && in_array($request->payment_status,[0,1])){
              //0=pending, 1=complete
            $my_orders->where("payment_status",$request->payment_status === 0 ? "pending" : "complete");
        }
        if(!empty($request->status) && in_array($request->payment_status,[0,1,2,3,4])){
            //0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled
            $my_orders->where("status",$request->status);
        }
        
        $my_orders_all = $my_orders->where('buyer_id',$uesr_info)->get()->transform(function($item){
            $item->payment_status =  !empty($item->payment_status) ? $item->payment_status : 'pending';
            return $item;
        });
        return response()->success([
            'my_orders' => $my_orders_all,
            'user_id' => $uesr_info,
        ]);
    }

    public function allTickets()
    {
        $all_tickets = SupportTicket::select('id','title','description','subject','priority','status')
            ->where('buyer_id',auth('sanctum')->id())->orderBy('id','Desc')
            ->paginate(10)
            ->withQueryString();

        return response()->success([
            'buyer_id'=> auth('sanctum')->id(),
            'tickets' =>$all_tickets,
        ]);
    }

    public function viewTickets(Request $request,$id= null)
    {
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get()->transform(function($item){
            $item->attachment = !empty($item->attachment) ? asset('assets/uploads/ticket/'.$item->attachment) : null;
            return $item;
        });
        $q = $request->q ?? '';
        return response()->success([
            'ticket_id'=>$id,
            'all_messages' =>$all_messages,
            'q' =>$q,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $this->validate($request,[
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'file' => 'nullable|mimes:jpg,png,jpeg,gif',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
        ]);

        if ($request->hasFile('file')){

            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->extension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/ticket',$file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        return response()->success([
            'message'=>__('Message Send Success'),
            'ticket_id'=>$request->ticket_id,
            'user_type' =>$request->user_type,
            'ticket_info' => $ticket_info,
        ]);
    }

    public function createTicket(Request $request){
        $this->validate($request,[
            'subject' => 'required|string|max:191',
            'priority' => 'required|string|max:191',
            'description' => 'required|string',
            'order_id' => 'required|integer',
        ],[
            'subject.required' =>  __('subject required'),
            'priority.required' =>  __('priority required'),
            'description.required' => __('description required'),
        ]);

        $orderInfo = Order::select('seller_id','service_id')->where('id',$request->order_id)->first();
        if(is_null($orderInfo)){
            return response()->success([
                'message'=>__('Order Not Found')
            ]);
        }
        $support = SupportTicket::create([
            'title' => sprintf(__('TIcket Created By %s'),auth('sanctum')->user()->name),
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'open',
            'priority' => $request->priority,
            'buyer_id' => auth('sanctum')->user()->id,
            'seller_id' => $orderInfo->seller_id,
            'service_id' => $orderInfo->service_id,
            'order_id' => $orderInfo->id,
        ]);

        // send order ticket notification to seller
        $seller = User::where('id',$orderInfo->seller_id)->first();
        if($seller){
            $order_ticcket_message = __('You have a new order ticket');
            $seller ->notify(new TicketNotificationSeller($support->id , $support->seller_id, $support->seller_id,$order_ticcket_message ));
        }

        return response()->success([
            'message'=>__('Support Ticket Created Success'),
            'ticket_info' =>$support
        ]);
    }

    public function singleOrder(Request $request){
        if(empty($request->id)){
            return response()->error(['message' => __('no order found')]);
        }

        $orderInfo = Order::where('id',$request->id)->first();
        $orderInfo->payment_status = !empty($orderInfo->payment_status) ? $orderInfo->payment_status : 'pending';
        $orderInfo->total = amount_with_currency_symbol($orderInfo->total);
        $orderInfo->tax = amount_with_currency_symbol($orderInfo->tax);
        $orderInfo->sub_total = amount_with_currency_symbol($orderInfo->sub_total);
        $orderInfo->extra_service = amount_with_currency_symbol($orderInfo->extra_service);
        $orderInfo->package_fee = amount_with_currency_symbol($orderInfo->package_fee);

        //append seller infomation
        $orderInfo->seller_details = $orderInfo->seller ?? null;
        $is_report_exist = Report::where(['order_id'=> $request->order_id , 'report_from'=>'buyer'])->first();

        $orderInfo->has_report = is_null($is_report_exist) ? 1 : 0;

        if(is_null($orderInfo)){
            return response()->success([
                'message'=>__('Order Not Found')
            ]);
        }

        return response()->success([
            'orderInfo'=> $orderInfo
        ]);
    }

    /* Extra Service list */
    public function extraServiceList($id)
    {
        $extra_service_list = ExtraService::where('order_id',$id)->get(['id','order_id','title','quantity','price','tax','sub_total','total','status']);
        return response()->success([
            'extra_service_list' => $extra_service_list,
        ]);
    }

    /* Extra Service Decline */
    public function extraServiceDelete(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);

        $extra_id = ExtraService::find($request->id);
        if(!empty($extra_id)){
            ExtraService::where(['order_id' => $request->order_id,'id' => $request->id])->update([
                'payment_status' => 'decline',
                'status' => 2,
            ]);
            return response()->success([
                'message' => 'Decline Success',
            ]);
        }else{
            return response()->error([
                'message' => 'Extra Service Not Found',
            ]);
        }

    }

    /* Extra Service Accept */
    public function extraServiceAccept(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
        $extra_service_details = ExtraService::with('order')->find($request->id);

        if(is_null($extra_service_details)){
            return response([
                'msg' => __('extra service not found')
            ],500);
        }

        //Manual Payment
        //return response([$request->all(),$extra_service_details]);

        if($request->selected_payment_gateway === 'manual_payment') {

            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();
                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                $manual_image_path = 'assets/uploads/manual-payment/';
                $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                ExtraService::where('id',$extra_service_details->id)->update([
                    'manual_payment_gateway_image'=>$manual_payment_image_name,
                    'payment_gateway'=>'Manual Payment'
                ]);
            }
        }
        
        $extra_service_details->status = 1;
        $extra_service_details->save();
            
        //todo send mail to seller and buyer
        try {
            //send mail to seller
            $seller_details = User::select('name','email')->find(optional($extra_service_details->order)->seller_id);
            $message = '<p>';
            $message .= __('Hello').' '.$seller_details->name.','."<br>";
            $message .= __('your have added extra service in your order #').$extra_service_details->order_id;
            $message .= '</p>';

            Mail::to($seller_details->email)->send(new BasicMail([
                'subject' => __('Extra service added in your order #').$extra_service_details->order_id,
                'message' => $message
            ]));

            $buyer_details = User::select('name','email')->find(optional($extra_service_details->order)->buyer_id);
            //send mail to buyer
            $message = '<p>';
            $message .= __('Hello').' '.$buyer_details->name.','."<br>";
            $message .= __('seller added extra service in your order #').$extra_service_details->order_id;
            $message .= '</p>';

            Mail::to($buyer_details->email)->send(new BasicMail([
                'subject' => __('Extra service added in your order #').$extra_service_details->order_id,
                'message' => $message
            ]));

        }catch (\Exception $e){
            //handle error
        }
        
        return response([
            'id'=> $request->id,
            'order_id'=> $request->order_id,
            'quantity'=> $extra_service_details?->quantity,
            'price'=> $extra_service_details?->price,
            'sub_total'=>float_amount_with_currency_symbol($extra_service_details?->sub_total),
            'tax'=>float_amount_with_currency_symbol($extra_service_details?->tax),
            'total'=>float_amount_with_currency_symbol($extra_service_details?->total),
        ]);
    }
    
    //order request complete approve
    public function orderCompleteRequestApprove(Request $request)
    {
        $find_order = Order::find($request->order_id);
        if(!empty($find_order)){
            Order::where('id',$request->order_id)->update(['order_complete_request'=>2,'status'=>2]);
            return response()->success([
                'msg'=>__('Order complete request successfully approved.'),
            ]);
        }else{
            return response()->error([
                'msg'=>__('Order id does not exists.'),
            ]);
        }
    }
    
    //order request complete decline
    public function orderCompleteRequestDecline(Request $request)
    {
        if(empty($request->decline_reason)){
            return response()->error([
                'msg'=>__('You must write a short description to decline the request.'),
            ]);
        }
        $request->validate([
            'decline_reason'=>'min:20|max:1000'
        ]);
        OrderCompleteDecline::where('order_id',$request->order_id)->update([
            'decline_reason'=>$request->decline_reason,
        ]);
        Order::where('id',$request->order_id)->update(['order_complete_request'=>3]);
        $seller_email = User::select(['id','email'])->where('id',$request->seller_id)->first();

        //Send decline mail to seller and admin
        try {
            $message_body_admin = __('A buyer has been decline a request to complete an order. Order ID #'). $request->order_id.'</br>';
            $message_body_seller = __('Your request to complete an order has been decline by the buyer. Order ID #'). $request->order_id.'</br>';
            $message = get_static_option('buyer_to_admin_extra_service_message');
            $message = str_replace(["@order_id"],[$request->order_id],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' =>get_static_option('buyer_order_decline_subject') ?? __('Order Complete Decline'),
                'message' => $message
            ]));

            $message = get_static_option('buyer_order_decline_message');
            $message = str_replace(["@order_id"],[$request->order_id],$message);
            Mail::to($seller_email->email)->send(new BasicMail([
                'subject' =>get_static_option('buyer_order_decline_subject') ?? __('Order Complete Decline'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            //
        }
        return response()->error([
            'msg'=>__('Order complete request decline successfully'),
        ]);
    }
    
    
    //order request complete decline history
    public function orderCompleteRequestDeclineHistory(Request $request)
    {
        $find_order_id = OrderCompleteDecline::where('order_id',$request->order_id)->first();
        if(!empty($find_order_id)){
            $decline_histories = OrderCompleteDecline::latest()->where('order_id',$request->order_id)->get();
            $seller_details = User::select(['name','email','phone'])->where('id',$find_order_id->seller_id)->get();
            foreach($decline_histories as $history){
                $history_image[] = get_attachment_image_by_id($history->image);
            }
            return response()->success([
                'decline_histories'=> $decline_histories,
                'seller_details'=> $seller_details,
                'history_image'=> $history_image,
            ]);
        }else{
            return response()->error([
                'msg'=>__('Order id does not exists.'),
            ]);
        }
    }
    
}

