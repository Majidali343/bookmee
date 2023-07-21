<?php

namespace App\Http\Controllers;

use App\Events\SupportMessage;
use App\ExtraService;
use App\Mail\BasicMail;
use App\Order;
use App\OrderCompleteDecline;
use App\OrderInclude;
use App\OrderAdditional;
use App\Report;
use App\ReportChatMessage;
use App\SupportTicketMessage;
use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\JobRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\DataTableHelpers\General;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order-list|order-status|order-view|cancel-order-list|order-success-setting',['only' => ['index']]);
        $this->middleware('permission:order-status',['only' => ['orderStatus']]);
        $this->middleware('permission:order-view',['only' => ['orderDetails']]);
        $this->middleware('permission:cancel-order-list',['only' => ['cancelOrders']]);
        $this->middleware('permission:order-success-setting',['only' => ['order_success_settings']]);
    }

    public function index(Request $request){

        if ($request->ajax()){
            $data = Order::select('*')
            ->orderBy('id','desc')
            ->take(20)->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox',function ($row){
                    return General::bulkCheckbox($row->id);
                })

                ->addColumn('id',function ($row){
                    return $row->id;
                })

                ->addColumn('name',function ($row){
                    return $row->name;
                })

                ->addColumn('email',function ($row){
                    return $row->email;
                })

                ->addColumn('phone',function ($row){
                    return $row->phone;
                })

                ->addColumn('address',function ($row){
                    return $row->address;
                })

                ->addColumn('amount',function ($row){
                    return float_amount_with_currency_symbol($row->total);
                })

                ->addColumn('payment_status',function ($row){
                    $payment_status = __('pending');
                    $payment_complete = __('complete');
                    $action = '';
                    if ($row->payment_status == 'pending'){
                        $action .= General::orderPaymentStatusChange(route('admin.order.change.status',$row->id),$row->payment_status);
                        return  $payment_status . $action;
                    }elseif($row->payment_status == 'complete'){
                        return $payment_complete;
                    }else{
                        return $payment_status;
                    }
                })

                ->addColumn('status',function ($row){
                    $action = '';
                    $admin = auth()->guard('admin')->user();
                    if($row->status == 0){
                       //if order status pending admin change any order status
                        if ($admin->can('pending-order-cancel')){
                            $action .= General::pendingOrderCancel($row->id,route('admin.cancel.pending.order',$row->id),$row->status);
                            return $action;
                        }
                    }elseif ($row->status == 1){
                        //if order status active admin change any order status
                        if ($admin->can('pending-order-cancel')){
                            $action .= General::pendingOrderCancel($row->id,route('admin.cancel.pending.order',$row->id),$row->status);
                            return $action;
                        }
                    }
                    else{
                        return General::orderStatus($row->status);
                    }
                })

                ->addColumn('is_order_online',function ($row){
                    return General::orderType($row->is_order_online);
                })

                ->addColumn('action', function($row){
                    $action = '';
                    $admin = auth()->guard('admin')->user();
                    if ($admin->can('order-view')){
                        $action .= General::viewIcon(route('admin.orders.details',$row->id));
                    }
                    return $action;
                })
                ->rawColumns(['checkbox','status','action','is_order_online','payment_status'])
                ->make(true);
        }
        return view('backend.pages.orders.index');
    }

    //cancel pending order
    public function cancelPendingOrder(Request $request, $id=null)
    {
        Order::where('id',$id)->update(['status'=>4]);
        return redirect()->back()->with(FlashMsg::item_new('Status Update Change to Cancel'));
    }

    public function orderStatusChange(Request $request, $id=null)
    {
        $this->validate($request,[
            'status_id' => 'required',
        ]);

        $order_status = Order::select('id','seller_id','status','email','name','job_post_id','order_from_job')->where('id',$request->id)->first();
        $current_status = $order_status->status;

        $old_status = '';
        $pending = __('Pending');
        $active = __('Active');
        $completed = __('Completed');
        $delivered = __('Delivered');
        $cancel = __('Cancel');

        if ($current_status == 0){
             $old_status = $pending;
         }elseif($current_status == 1){
             $old_status = $active;
         }elseif ($current_status == 2){
             $old_status = $completed;
         }elseif ($current_status == 3){
             $old_status = $delivered;
         }else{
             $old_status = $cancel;
         }

        $seller_email = optional($order_status->seller)->email;
        $seller_name = optional($order_status->seller)->name;
        if($order_status->status==0){
            $new_status = 'Active';
        }elseif($order_status->status==1){
            $new_status = 'Completed';
        }else{
            $new_status = 'Cancel';
        }

        Order::where('id',$request->id)->update(['status'=> $request->status_id]);

        try {
            $order_status_change_title = __('Order Status Changed.') . $order_status->id;
            $message_status = __('Order Status Changed.'). ' ' . __('Order ID:') .$order_status->id;
            $message = str_replace(["@name","@old_status","@new_status","@order_id"],[$order_status->name,$old_status,$new_status,$order_status->id],$message_status);
            Mail::to($order_status->email)->send(new BasicMail([
                'subject' => $order_status_change_title,
                'message' => $message
            ]));

            $message = str_replace(["@name","@old_status","@new_status","@order_id"],[$seller_name,$old_status,$new_status,$order_status->id],$message_status);
            Mail::to( $seller_email)->send(new BasicMail([
                'subject' => $order_status_change_title,
                'message' => $message
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        return redirect()->back()->with(FlashMsg::item_new('Status Update Success'));
    }

    //all cancel orders
    public function cancelOrders(){
        $orders = Order::where('status',4)->latest()->get();
        return view('backend.pages.orders.cancelled',compact('orders'));
    }

   //cancel order return money
    public function cancelOrderMoneyReturn($id=null){
        Order::where('id',$id)->update(['cancel_order_money_return'=>1]);
        return redirect()->back()->with(FlashMsg::item_new('Status Update Success'));
    }
    
     //cancel order delete
    public function cancelOrderDelete($id){
        Order::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new('Cancel Order Delete Success'));
    }

    //order complete request
    public function orderCompleteRequest(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            Order::where('id',$id)->update(['order_complete_request'=>2,'status'=>2]);
            return redirect()->back()->with(FlashMsg::item_new('Order Status Change to Complete'));
        }
        $orders = Order::select('id','total','updated_at','seller_id','buyer_id')->with('seller','buyer')
            ->where('order_complete_request',1)
            ->latest()
            ->paginate(10);
        return view('backend.pages.orders.order-complete-request',compact('orders'));
    }

    public function orderDetails($id){
        $order_details = Order::where('id',$id)->first();
        $order_includes = OrderInclude::where('order_id',$id)->get();
        $order_additionals = OrderAdditional::where('order_id',$id)->get();
        return view('backend.pages.orders.order-details',compact('order_details','order_includes','order_additionals'));
    }

    public function orderStatus(Request $request)
    {
        Order::where('id',$request->order_id)->update(['status'=>$request->status]);
        return redirect()->back()->with(FlashMsg::item_new('Status Update Success'));
    }
    
    public function order_success_settings()
     {
        return view('backend.pages.orders.order-success-settings');
     }

    public function seller_buyer_report()
    {
        $reports = Report::latest()->get();
        return view('backend.pages.orders.seller-buyer-report',compact('reports'));
    }

    public function delete_report($id){
        Report::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Report Deleted Success'));
    }

    public function chat_to_seller(Request $request, $report_id,$seller_id)
    {
        if($request->isMethod('post')){
            $this->validate($request,[
                'message' => 'required',
                'notify' => 'nullable|string',
                'attachment' => 'nullable|mimes:zip',
            ]);

            $ticket_info = ReportChatMessage::create([
                'report_id' => $report_id,
                'seller_id' => $seller_id,
                'message' => $request->message,
                'type' => 'admin',
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
        $report_details = Report::where('id',$report_id)->where('seller_id',$seller_id)->first();
        $all_messages = ReportChatMessage::where('report_id',$report_id)
            ->where('seller_id',$seller_id)
            ->get();
        $q = $request->q ?? '';
        return view('backend.pages.orders.report-chat',compact('report_details','all_messages','q'));
    }

    public function chat_to_buyer(Request $request, $report_id,$buyer_id)
    {
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
                'type' => 'admin',
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
        return view('backend.pages.orders.report-chat-buyer',compact('report_details','all_messages','q'));
    }

    public function order_success_settings_update(Request $request)
    {
         $this->validate($request, [
             'success_title' => 'nullable|string',
             'success_subtitle' => 'nullable|string',
             'success_details_title' => 'nullable|string',
             'button_title' => 'nullable|string',
             'button_url' => 'nullable|string',
         ]);
     
         $all_fields = [
             'success_title',
             'success_subtitle',
             'success_details_title',
             'button_title',
             'button_url',
         ];
         foreach ($all_fields as $field) {
             update_static_option($field, $request->$field);
         }
         return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function change_payment_status($id){

        $payment_status = Order::select('id','seller_id','payment_status','email','name','job_post_id','order_from_job')->where('id',$id)->first();
        $old_status = $payment_status->payment_status;
        $seller_email = optional($payment_status->seller)->email;
        $seller_name = optional($payment_status->seller)->name;
        if($payment_status->payment_status=='pending'){
            $new_status = 'complete';
        }else{
            $new_status = 'pending';
        }
        Order::where('id',$id)->update(['payment_status'=>$new_status,'status' => 1]);

        //if order created from job post start
        if($payment_status->order_from_job == 'yes'){
            JobRequest::where('seller_id',$payment_status->seller_id)
                ->where('job_post_id',$payment_status->job_post_id)
                ->update(['is_hired'=>1]);
        }
        //if order created from job post end

        try {
            $message = get_static_option('admin_change_payment_status_message') ?? '';
            $message = str_replace(["@name","@old_status","@new_status","@order_id"],[$payment_status->name,$old_status,$new_status,$payment_status->id],$message);
            Mail::to($payment_status->email)->send(new BasicMail([
                'subject' => get_static_option('admin_change_payment_status_subject') ?? __('Payment Status Changed.'),
                'message' => $message
            ]));

            $message = get_static_option('admin_change_payment_status_message') ?? '';
            $message = str_replace(["@name","@old_status","@new_status","@order_id"],[$seller_name,$old_status,$new_status,$payment_status->id],$message);
            Mail::to( $seller_email)->send(new BasicMail([
                'subject' => get_static_option('admin_change_payment_status_subject') ?? __('Payment Status Changed.'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
     }

     public function extra_orders()
     {
         $extra_services = ExtraService::where('status',2)->get();
         return view('backend.pages.orders.extra_orders',compact('extra_services'));
     }

    public function complete_payment_status($id){
        $extra_order = ExtraService::select('id','payment_status')->where('id',$id)->first();
        $extra_order->payment_status == 'pending' ? $payment_status = 'complete' : '';
        ExtraService::where('id',$id)->update(['payment_status'=>$payment_status]);
        return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
    }

    public function orderRequestDeclineHistory()
    {
        $decline_histories = OrderCompleteDecline::latest()->get();
        return view('backend.pages.orders.decline_history',compact('decline_histories'));
    }
}
