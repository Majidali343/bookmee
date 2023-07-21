<?php

namespace App\Http\Controllers\Api;

use App\Actions\Media\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Order;
use App\User;
use App\Report;
use App\ReportChatMessage;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMail;

class OrderReportController extends Controller
{
   
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'report' => 'required',
            'order_id' => 'required',
            'service_id' => 'required',
            // 'seller_id' => 'required',
        ]);


        // Return the message
        if($validator->fails()){
            return response([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }


        $user_info = Auth::guard('sanctum')->user();
        $is_report_exist = Report::where(['order_id'=> $request->order_id , 'report_from'=>'buyer'])->first();
        $order_details = Order::find($request->order_id);
        
        if($is_report_exist){
            return response([
                'msg' => __('Report Already Created For This Order')
            ],422);
        }

        if(is_null($order_details)){
            return response([
                'msg' => __('Order not exists')
            ],422);
        }

        $report = Report::create([
            'order_id' => $request->order_id,
            'service_id' => $request->service_id,
            'seller_id' => $order_details->seller_id,
            'buyer_id' => $order_details->buyer_id,
            'report_from' => ( $user_info->user_type === 1) ? 'buyer' : 'seller', //check user type to detech report form and report to
            'report_to' => ( $user_info->user_type === 0) ? 'buyer' : 'seller',
            'report' => $request->report,
        ]);

        $last_report_id = $report->id;

        try {
            $message = get_static_option('buyer_report_message');
            $message = str_replace(["@report_id"],[$last_report_id],$message);
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => get_static_option('buyer_report_subject') ?? __('New Report'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            //handle exception
        }

        return response([
            'report_id' => $report->id,
            'msg' => __('Report Send Success')
        ],200);
    }

    public function list(Request $request){
        $user_details = Auth::guard('sanctum')->user();
        $search_column = $user_details->user_type === 1 ? 'buyer_id' : 'seller_id';
        $user_type = $user_details->user_type === 1 ? 'buyer' : 'seller';
        $reports = Report::where([$search_column => $user_details->id,"report_from" => $user_type])->paginate(10)->withQuerySTring();
        return response( $reports,200);
    }


    public function details(Request $request, $report_id)
    {
        $user_info = Auth::guard('sanctum')->user();
        $user_type = $user_info->user_type === 0 ? 'seller_id' : 'buyer_id';

        $all_messages = ReportChatMessage::where('report_id',$report_id)
        ->where( $user_type ,$user_info->id)
        ->get()->transform(function($item){
            $item->attachment = !empty($item->attachment) ? asset('assets/uploads/ticket/'.$item->attachment) : null;
            return $item;
        });
        $q = $request->q ?? '';
    
        return response()->success([
            'ticket_id'=> $report_id,
            'all_messages' => $all_messages,
            'q' =>$q,
        ]);
    }


    public function sendMessage(Request $request)
    {
        $user_info = Auth::guard('sanctum')->user();


        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'notify' => 'nullable|string',
            'attachment' => 'nullable|mimes:jpg,jpeg,png,zip',
        ]);


        // Return the message
        if($validator->fails()){
            return response([
                'error' => true,
                'message' => $validator->errors()
            ],422);
        }

        $ticket_info = ReportChatMessage::create([
            'report_id' => $request->report_id,
            'buyer_id' => $user_info->user_type === 1 ? $user_info->id : 0,
            'seller_id' => $user_info->user_type === 0 ? $user_info->id : 0,
            'message' => $request->message,
            'type' => $user_info->user_type === 1 ? 'buyer' : 'seller',
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

        return response([
            'message' => __('message send to admin')
        ],200);

    }
}
