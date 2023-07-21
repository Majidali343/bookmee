<?php

namespace App\Http\Controllers;

use App\Mail\BasicMail;
use Illuminate\Http\Request;
use App\PayoutRequest;
use App\Helpers\FlashMsg;
use App\Order;
use Illuminate\Support\Facades\Mail;

class PayoutRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payout-list|payout-edit|payout-view|payout-delete',['only' => ['payout_request_all']]);
        $this->middleware('permission:payout-edit',['only' => ['payout_request_update']]);
        $this->middleware('permission:payout-view',['only' => ['view_request']]);
        $this->middleware('permission:payout-delete',['only' => ['delete_payout_request','bulk_action_payout']]);
    }

    public function payout_request_all(){
        $all_payout_request = PayoutRequest::paginate(10);
        return view('backend.pages.payout-request.all-payout-request',compact('all_payout_request'));
    }

    public function payout_request_update(Request $request){
        $request->validate([
            'status'=> 'required',
        ]);

        PayoutRequest::where('id',$request->payout_request_id)
        ->update([
            'status'=>$request->status,
            'payment_receipt'=>$request->payment_receipt,
            'admin_note'=>$request->admin_note,
        ]);

        $seller_payout_details = PayoutRequest::where('id',$request->payout_request_id)->first();
        $seller_email =  optional($seller_payout_details->seller)->email;
        $seller_name =  optional($seller_payout_details->seller)->name;
        try {
            $message = get_static_option('admin_withdraw_amount_send_message') ?? '';
            $message = str_replace(["@name","@withdraw_amount"],[$seller_name,float_amount_with_currency_symbol($seller_payout_details->amount)],$message);
            Mail::to( $seller_email)->send(new BasicMail([
                'subject' =>get_static_option('admin_withdraw_amount_send_subject') ?? __('Payment Success'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }
        return redirect()->back()->with(FlashMsg::item_new(__('Payment Request Update Success...')));
    }

    public function view_request($id=null){
        $request_details = PayoutRequest::where('id',$id)->first();
        $complete_order_balance = Order::where(['status'=>2,'seller_id'=>$request_details->seller_id])->sum('total');
        $total_earnings = PayoutRequest::where('seller_id',$request_details->seller_id)->sum('amount');
        $remaining_balance = float_amount_with_currency_symbol($complete_order_balance - $total_earnings);
        return view('backend.pages.payout-request.payout-request-details',compact('request_details','remaining_balance'));
    }

    //delete 
    public function delete_payout_request($id)
    {
        PayoutRequest::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(__('Payout Request Delete Success...')));
    }

    public function bulk_action_payout(Request $request){
        PayoutRequest::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
