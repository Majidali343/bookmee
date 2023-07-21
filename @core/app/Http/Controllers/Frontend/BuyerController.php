<?php

namespace App\Http\Controllers\Frontend;

use App\Accountdeactive;
use App\ExtraService;
use App\Helpers\ModuleMetaData;
use App\Helpers\PaymentGatewayRequestHelper;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\OrderMail;
use App\Notifications\TicketNotificationSeller;
use App\OrderCompleteDecline;
use App\Report;
use App\ReportChatMessage;
use App\Review;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\OrderAdditional;
use App\OrderInclude;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;
use App\Order;
use App\User;
use Auth;
use App\SupportTicket;
use App\SupportDepartment;
use App\SupportTicketMessage;
use App\Events\SupportMessage;
use App\Helpers\FlashMsg;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\BuyerJob;

class BuyerController extends Controller
{
    private const CANCEL_ROUTE = 'buyer.order.extra.service.payment.cancel';
    private const SUCCESS_ROUTE = 'buyer.order.extra.service.payment.success';
    public function __construct(){
        $this->middleware('inactiveuser');
    }

    public function buyerDashboard()
    {
        $buyer_id = Auth::guard('web')->user()->id;

        $pending_order = Order::where(['buyer_id'=>$buyer_id, 'status'=>0])->count();
        $active_order = Order::where(['buyer_id'=>$buyer_id, 'status'=>1])->count();
        $complete_order = Order::where(['buyer_id'=>$buyer_id, 'status'=>2])->count();
        $total_order = Order::where('buyer_id',$buyer_id)->count();
        $last_10_order = Order::where('buyer_id',$buyer_id)->take(10)->latest()->get();
        $last_10_tickets = SupportTicket::where('buyer_id',$buyer_id)->take(10)->latest()->get();

        return view('frontend.user.buyer.dashboard.dashboard',compact('pending_order','active_order','complete_order','total_order','last_10_order','last_10_tickets'));
    }

    public function buyerOrders()
    {
        $orders = Order::with('online_order_ticket')
            ->where('buyer_id', Auth::guard('web')->user()->id)
            ->where('job_post_id', NULL)
            ->latest()->paginate(10);

        return view('frontend.user.buyer.order.orders', compact('orders'));
    }

    public function buyerJobOrders()
    {
        $orders = Order::with('online_order_ticket')
            ->where('buyer_id', Auth::guard('web')->user()->id)
            ->where('job_post_id', '!=', NULL)
            ->latest()->paginate(10);

        return view('frontend.user.buyer.order.orders', compact('orders'));
    }

    public function orderDetails($id=null)
    {
        $order_details = Order::with('seller')
            ->where('id',$id)
            ->where('buyer_id',Auth::guard('web')->user()->id)->first();
        $order_declines_history = OrderCompleteDecline::where('order_id',$id)->latest()->get();

        if(!is_null($order_details)){
            $order_includes = OrderInclude::where('order_id',$id)->get();
            $order_additionals = OrderAdditional::where('order_id',$id)->get();
            return view('frontend.user.buyer.order.order-details', compact('order_details','order_includes','order_additionals','order_declines_history'));
        }
        abort(404);
    }

    public function orderCompleteRequestApprove($id=null)
    {
        Order::where('id',$id)->update(['order_complete_request'=>2,'status'=>2]);
        toastr_success(__('Order complete request successfully approved.'));
        return redirect()->back();
    }

    public function orderCancel($id=null)
    {
        Order::where('id',$id)->update(['payment_status'=>'','status'=>4]);
        toastr_success(__('Order successfully cancelled.'));
        return redirect()->back();
    }

    public function orderCompleteRequestDecline(Request $request)
    {
        if(empty($request->decline_reason)){
            toastr_warning(__('You must write a short description to decline the request.'));
            return back();
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
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        toastr_success(__('Order complete request decline successfully'));
        return back();
    }

    public function orderRequestDeclineHistory($id)
    {
        $order_id = $id;
        $decline_histories = OrderCompleteDecline::latest()->where('order_id',$id)->paginate(10);
        return view('frontend.user.buyer.order.decline-history',compact('decline_histories','order_id'));
    }

    //buyer report
    public function reportUs(Request $request)
    {
        $request->validate([
            'report' => 'required',
        ]);

        $buyer_id = Auth::guard()->check() ? Auth::guard('web')->user()->id : NULL;
        $is_report_exist = Report::where(['order_id'=>$request->order_id , 'report_from'=>'buyer'])->first();

        if($is_report_exist){
            toastr_error(__('Report Already Created For This Order'));
            return redirect()->back();
        }

        $report = Report::create([
            'order_id' => $request->order_id,
            'service_id' => $request->service_id,
            'seller_id' => $request->seller_id,
            'buyer_id' => $buyer_id,
            'report_from' => 'buyer',
            'report_to' => 'seller',
            'report' => $request->report,
        ]);

        $last_report_id = $report->id;

        try {
            $message = get_static_option('buyer_report_message');
            $message = str_replace(["@report_id"],[$last_report_id],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('buyer_report_subject') ?? __('Buyer New Report'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        toastr_success(__('Report Send Success'));
        return redirect()->back();
    }

    public function reportList()
    {
        $reports = Report::where('buyer_id',Auth::guard('web')->user()->id)->paginate(10);
        return view('frontend.user.buyer.report.report-list',compact('reports'));
    }

    public function chat_to_admin(Request $request, $report_id)
    {
        $buyer_id = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){
            $this->validate($request,[
                'message' => 'required',
                'notify' => 'nullable|string',
                'attachment' => 'nullable|mimes:zip',
            ]);

            $ticket_info = ReportChatMessage::create([
                'report_id' => $report_id,
                'buyer_id' => $buyer_id,
                'message' => $request->message,
                'type' =>'buyer',
                'notify' => $request->send_notify_mail ? 'on' : 'off',
            ]);

            if ($request->hasFile('attachment')){
                $uploaded_file = $request->attachment;
                $file_extension = $uploaded_file->extension();
                $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
                $uploaded_file->move('assets/uploads/ticket',$file_name);
                $ticket_info->attachment = $file_name;
                $ticket_info->save();
            }

            //send mail to user
//            event(new SupportMessage($ticket_info));
            return redirect()->back()->with(FlashMsg::item_new(__('Message Send')));
        }
        $report_details = Report::where('id',$report_id)->where('buyer_id',$buyer_id)->first();
        $all_messages = ReportChatMessage::where('report_id',$report_id)
            ->where('buyer_id',$buyer_id)
            ->get();
        $q = $request->q ?? '';
        return view('frontend.user.buyer.report.report-chat',compact('report_details','all_messages','q'));

    }

    public function buyerProfile()
    {
        return view('frontend.user.buyer.profile.buyer-profile');
    }

    public function buyerProfileEdit(Request $request)
    {

        if ($request->isMethod('post')) {
            $user = Auth::guard('web')->user()->id;
            $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|max:191|email|unique:users,email,'.$user,
                'phone' => 'required|max:191',
                'service_area' => 'required|max:191',
                'post_code' => 'required|max:191',
                'address' => 'required|max:191',
            ]);
            $old_image = User::select('image')->where('id',Auth::guard('web')->user()->id)->first();
            User::where('id', Auth::guard('web')->user()->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'image' => $request->image ?? $old_image->image,
                    'profile_background' => $request->profile_background ?? $old_image->profile_background,
                    'service_city' => $request->service_city,
                    'service_area' => $request->service_area,
                    'country_id' => $request->country,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'about' => $request->about,
                ]);
            toastr_success(__('Profile Update Success---'));
            return redirect()->back();
        }

        $cities = ServiceCity::where('status',1)->get();
        $areas = ServiceArea::where('status',1)->get();
        $countries = Country::where('status',1)->get();
        return view('frontend.user.buyer.profile.buyer-profile-edit',compact('cities','areas','countries'));
    }

    public function buyerAccountSetting(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'current_password' => 'required|min:6',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6',
            ]);

            $buyer = User::where('id', Auth::user()->id)->first();

            if (Hash::check($request->current_password, $buyer->password)) {
                if ($request->new_password == $request->confirm_password) {
                    User::where('id', $buyer->id)->update(['password' => Hash::make($request->new_password)]);
                    toastr_success(__('Password Update Success---'));
                    return redirect()->back();
                }
                toastr_error(__('Password and Confirm Password not match---'));
                return redirect()->back();
            }
            toastr_error(__('Current Password is Wrong---'));
            return redirect()->back();
        }
        $user = Accountdeactive::select('user_id','status')->where('user_id', Auth::guard('web')->user()->id)->first();
        return view('frontend.user.buyer.profile.buyer-account-settings', compact('user'));
    }

    // buyer account Deactivate
    public function accountDeactive(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required|max:150',
            ]);

            //buyer order status check
            $buyer_id =  Auth::guard('web')->user()->id;
            $all_orders = Order::where('buyer_id', $buyer_id)->where('status', 1)->count();
            if ($all_orders >1){
                toastr_error(__('Your have active orders. Please complete them before trying to delete your account.'));
                return redirect()->back();
            }else{

                //check buyer job post
                if(moduleExists('JobPost')) {
                    $buyer_all_job_post = BuyerJob::where('buyer_id', Auth::guard('web')->user()->id)->get();
                    if (!empty($buyer_all_job_post)) {
                        BuyerJob::where('buyer_id', Auth::guard('web')->user()->id)->update(['status' => 0]);
                    }
                }

                //Deactivate Account
                Accountdeactive::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'reason' => $request['reason'],
                    'description' => $request['description'],
                    'status' => 0,
                    'account_status' => 0,
                ]);
                toastr_error(__('Your Account Successfully Deactivate'));
                return redirect()->back();
            }
        }
    }

    // buyer account delete
    public function accountDelete(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'reason' => 'required',
                'description' => 'required|max:150',
            ]);

            $auth_buyer_id =  Auth::guard('web')->user()->id;

            //first seller order status check
            $all_orders = Order::where('buyer_id', $auth_buyer_id)->where('status', 1)->count();
            if ($all_orders >1){
                toastr_error(__('Your have active orders. Please complete them before trying to delete your account.'));
                return redirect()->back();
            }else{
                Accountdeactive::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'reason' => $request['reason'],
                    'description' => $request['description'],
                    'status' => 1,
                    'account_status' => 1,
                ]);
                if(moduleExists('JobPost')) {
                    BuyerJob::where('buyer_id', Auth::guard('web')->user()->id)->update(['status' => 0]);
                }
                toastr_error(__('Your Account Delete Successfully'));
            }

            return redirect()->route('buyer.logout');
        }
    }

    // buyer account Deactivate Cancel
    public function accountDeactiveCancel($id = null)
    {
        $account_details = Accountdeactive::where('user_id', $id)->first();

        if (!empty($account_details)){
            $account_details->delete();
        }

        // check buyer job post
        if(moduleExists('JobPost')) {
            $buyer_all_job_post = BuyerJob::where('buyer_id', Auth::guard('web')->user()->id)->get();
            if (!empty($buyer_all_job_post)) {
                BuyerJob::where('buyer_id', Auth::guard('web')->user()->id)->update(['status' => 1]);
            }
        }
        toastr_success(__('Your Account Successfully Active'));
        return redirect()->back();
    }

    public function buyerLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    //support tickets
    public function allTickets()
    {
        $tickets = SupportTicket::where('buyer_id',Auth::guard('web')->user()->id)
            ->orderBy('id','desc')
            ->paginate(10);

        $orders = Order::where('buyer_id', Auth::guard('web')->user()->id)
            ->where('payment_status', '!=','')
            ->whereNotNull('buyer_id')
            ->latest()->get();

        return view('frontend.user.buyer.support-ticket.all-tickets', compact('tickets','orders'));
    }

    //add new ticket
    public function addNewTicket(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            if($request->order_id){
                $seller_id = Order::select('seller_id')->where('id',$request->order_id)->first();
            }

            $this->validate($request,[
                'title' => 'required|string|max:191',
                'subject' => 'required|string|max:191',
                'priority' => 'required|string|max:191',
                'description' => 'required|string',
            ],[
                'title.required' => __('title required'),
                'subject.required' =>  __('subject required'),
                'priority.required' =>  __('priority required'),
                'description.required' => __('description required'),
            ]);

            SupportTicket::create([
                'title' => $request->title,
                'description' => $request->description,
                'subject' => $request->subject,
                'status' => 'open',
                'priority' => $request->priority,
                'buyer_id' => Auth::guard('web')->user()->id,
                'seller_id' => $seller_id->seller_id,
                'service_id' => $request->service_id,
                'order_id' => $request->order_id,
            ]);
            toastr_success(__('Ticket successfully created.'));
            $last_ticket_id = DB::getPdo()->lastInsertId();
            $last_ticket = SupportTicket::where('id',$last_ticket_id)->first();

            // send order ticket notification to seller
            $seller = User::where('id',$last_ticket->seller_id)->first();
            if($seller){
                $order_ticcket_message = __('You have a new order ticket');
                $seller ->notify(new TicketNotificationSeller($last_ticket_id , $seller_id, $last_ticket->seller_id,$order_ticcket_message ));
            }

            //Send ticket mail to seller and admin
            try {
                $message = get_static_option('buyer_report_message');
                $message = str_replace(["@order_ticket_id","@report_id"],[$last_ticket_id],$message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('buyer_report_subject') ?? __('New Order Ticket'),
                    'message' => $message
                ]));
                Mail::to($seller->email)->send(new BasicMail([
                    'subject' => get_static_option('buyer_report_subject') ?? __('New Order Ticket'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
            }

            return redirect()->back();
        }

        $order = Order::select('id','service_id','seller_id')
            ->where('id',$id)
            ->where('buyer_id',Auth::guard('web')->user()->id)
            ->first();

        return view('frontend.user.buyer.support-ticket.add-new-ticket', compact('order'));
    }

    public function ticketDelete($id=null)
    {
        SupportTicket::find($id)->delete();
        toastr_error(__('Ticket Delete Success---'));
        return redirect()->back();
    }

    //view ticket
    public function view_ticket(Request $request,$id)
    {
        $ticket_details = SupportTicket::findOrFail($id);
        $all_messages = SupportTicketMessage::where(['support_ticket_id'=>$id])->get();
        $q = $request->q ?? '';
        foreach(Auth::guard('web')->user()->unreadNotifications as $notification){

            if($ticket_details->id == $notification->data['last_ticket_id']){
                $Notification = Auth::guard('web')->user()->Notifications->find($notification->id);
                if($Notification){
                    $Notification->markAsRead();
                }
                return view('frontend.user.buyer.support-ticket.view-ticket', compact('ticket_details','all_messages','q'));
            }
        }
        return view('frontend.user.buyer.support-ticket.view-ticket', compact('ticket_details','all_messages','q'));
    }

    //priority status
    public function priorityChange(Request $request)
    {
        SupportTicket::where('id',$request->ticket_id)->update(['priority'=>$request->priority]);
        toastr_success(__('Priority Change Success---'));
        return redirect()->back();
    }

    //change status
    public function statusChange($id=null)
    {
        $status = SupportTicket::find($id);
        if($status->status=='open'){
            $status = 'close';
        }else{
            $status = 'open';
        }
        SupportTicket::where('id',$id)->update(['status'=>$status]);
        toastr_success(__('Status Change Success---'));
        return redirect()->back();
    }

    //send message
    public function support_ticket_message(Request $request)
    {
        $this->validate($request,[
            'ticket_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $ticket_info = SupportTicketMessage::create([
            'support_ticket_id' => $request->ticket_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->extension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/ticket',$file_name);
            $ticket_info->attachment = $file_name;
            $ticket_info->save();
        }

        //send mail to user
        event(new SupportMessage($ticket_info));
        return redirect()->back()->with(FlashMsg::item_new(__('Message Send')));
    }

    //service review add
    public function serviceReviewfromDashboard(Request $request)
    {

        $request->validate([
            'rating' => 'required',
            'message' => 'required',
        ]);

        $review_count = Review::where('order_id',$request->order_id)->where('type', 1)->where('buyer_id',Auth::guard('web')->user()->id)->first();

        if(!$review_count){
            $review = Review::create([
                'order_id' => $request->order_id,
                'service_id' => $request->service_id ?? 0,
                'seller_id' => $request->seller_id,
                'buyer_id' => Auth::guard()->check() ? Auth::guard('web')->user()->id : NULL,
                'rating' => $request->rating,
                'name' => Auth::guard()->check() ? Auth::guard('web')->user()->name : NULL,
                'email' => Auth::guard()->check() ? Auth::guard('web')->user()->email : NULL,
                'message' => $request->message,
                'type' => 1,
            ]);
            if($review){
                toastr_success(__('Review Added Success---'));
                return redirect()->back();
            }
        }
        toastr_error(__('You Can Not Send Review More Than One'));
        return redirect()->back();
    }

    public function extraServiceDecline(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
        
        ExtraService::where(['order_id' => $request->order_id,'id' => $request->id])->update([
            'payment_status' => 'decline',
            'status' => 2,
        ]);

        toastr_error(__('Decline Success'));
        return redirect()->back();
    }

    public function extraServiceAccept(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'order_id' => 'required|integer',
        ]);
        $extra_service_details = ExtraService::with('order')->find($request->id);
        //extraServiceAccept
        $selected_payment_gateway = $request->selected_payment_gateway;
        session()->put('order_id',$extra_service_details->id);

        //manual payment
        if($request->selected_payment_gateway === 'manual_payment') {
            $request->validate([
                'manual_payment_image' => 'required'
            ]);

            if($request->hasFile('manual_payment_image')){
                $manual_payment_image = $request->manual_payment_image;
                $img_ext = $manual_payment_image->extension();
                $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;
                $manual_image_path = 'assets/uploads/manual-payment/';
                $manual_payment_image->move($manual_image_path,$manual_payment_image_name);

                ExtraService::where('id',$extra_service_details->id)->update([
                    'manual_payment_gateway_image'=>$manual_payment_image_name,
                    'payment_gateway'=>'Manual Payment',
                    'status'=>1,
                ]);
            }

            //todo send mail to seller and buyer
            try {
                //send mail to seller
                $seller_details = User::select('name','email')->find(optional($extra_service_details->order)->seller_id);
                $message = get_static_option('buyer_to_seller_extra_service_message');
                $message = str_replace(["@seller_name","@order_id"],[$seller_details->name,$extra_service_details->order_id],$message);

                Mail::to($seller_details->email)->send(new BasicMail([
                    'subject' => get_static_option('buyer_extra_service_subject') ?? __('Extra Service Accepted'),
                    'message' => $message
                ]));

                $buyer_details = User::select('name','email')->find(optional($extra_service_details->order)->buyer_id);
                //send mail to buyer
                $message = get_static_option('buyer_extra_service_message');
                $message = str_replace(["@buyer_name","@order_id"],[$buyer_details->name,$extra_service_details->order_id],$message);
                Mail::to($buyer_details->email)->send(new BasicMail([
                    'subject' => get_static_option('buyer_extra_service_subject') ?? __('Extra Service Accepted'),
                    'message' => $message,
                ]));

            }catch (\Exception $e){
                //handle error
            }
            toastr_success(__('Order Created Success'));
            return back();
        }

        if ($selected_payment_gateway === 'paypal'){
            try {
                return PaymentGatewayRequestHelper::paypal()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.paypal.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'mollie'){
            try {
                return PaymentGatewayRequestHelper::mollie()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.mollie.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'paytm'){
            try {
                return PaymentGatewayRequestHelper::paytm()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.paytm.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'stripe'){
            try {
                return PaymentGatewayRequestHelper::stripe()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.stripe.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'razorpay'){
            try {
                return PaymentGatewayRequestHelper::razorpay()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.razorpay.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'flutterwave'){
            try {
                return PaymentGatewayRequestHelper::flutterwave()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.flutterwave.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'paystack'){
            try {
                return PaymentGatewayRequestHelper::paystack()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.paystack.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'marcadopago'){
            try {
                return PaymentGatewayRequestHelper::marcadopago()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.marcadopago.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'instamojo'){
            try {
                return PaymentGatewayRequestHelper::instamojo()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.instamojo.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'cashfree'){
            try {
                return PaymentGatewayRequestHelper::cashfree()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.cashfree.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'payfast'){
            try {
                return PaymentGatewayRequestHelper::payfast()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.payfast.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'midtrans'){
            try {
                return PaymentGatewayRequestHelper::midtrans()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.midtrans.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'squareup'){
            try {
                return PaymentGatewayRequestHelper::squareup()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.squareup.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'cinetpay'){
            try {
                return PaymentGatewayRequestHelper::cinetpay()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.cinetpay.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }
        elseif ($selected_payment_gateway === 'paytabs'){
            try {
                return PaymentGatewayRequestHelper::paytabs()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.paytabs.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }

        }
        elseif ($selected_payment_gateway === 'billplz'){
            try {
                return PaymentGatewayRequestHelper::billplz()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.billplz.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }

        }
        elseif ($selected_payment_gateway === 'zitopay'){
            try {
                return PaymentGatewayRequestHelper::zitopay()->charge_customer($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.zitopay.ipn')));
            }catch (\Exception $e){
                toastr_error($e->getMessage());
                return back();
            }
        }else{
            //todo check Bookmi meta data for new payment gateway
            $module_meta =  new ModuleMetaData();
            $list = $module_meta->getAllPaymentGatewayList();
            if (in_array($selected_payment_gateway,$list)){
                //todo call the module payment gateway customerCharge function

                $customerChargeMethod =  $module_meta->getChargeCustomerMethodNameByPaymentGatewayName($selected_payment_gateway);
                try {
                    $returned_val = $customerChargeMethod($this->buildPaymentArg($extra_service_details,route('buyer.order.extra.service.payment.zitopay.ipn')));
                    
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

        toastr_error(__('something went wrong, try after sometime'));
        return redirect()->back();
    }

    private function buildPaymentArg($extra_service_details,$ipn_route){

        return [
            'amount' => $extra_service_details->total, // amount you want to charge from customer
            'title' => $extra_service_details->title, // payment title
            'description' => '', // payment description
            'ipn_url' => $ipn_route, //you will get payment response in this route
            'order_id' => $extra_service_details->id, // your order number
            'track' => \Str::random(36), // a random number to keep track of your payment
            'cancel_url' => route(self::CANCEL_ROUTE,$extra_service_details->id), //payment gateway will redirect here if the payment is failed
            'success_url' => route(self::SUCCESS_ROUTE,$extra_service_details->id), // payment gateway will redirect here after success
            'email' => $extra_service_details->order?->buyer?->email, // user email
            'name' => $extra_service_details->order?->buyer?->name, // user name
            'payment_type' => 'extra_service', // which kind of payment your are receving from customer
        ];
    }

}
