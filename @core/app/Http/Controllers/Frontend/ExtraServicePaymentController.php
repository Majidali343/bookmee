<?php

namespace App\Http\Controllers\Frontend;

use App\ExtraService;
use App\Helpers\PaymentGatewayRequestHelper;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\OrderMail;
use App\Notifications\TicketNotificationSeller;
use App\Report;
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
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class ExtraServicePaymentController extends Controller
{
    private const CANCEL_ROUTE = 'buyer.order.extra.service.payment.cancel';
    private const SUCCESS_ROUTE = 'buyer.order.extra.service.payment.success';

    public function __construct(){
        $this->middleware('inactiveuser');
    }

    public function paypal_ipn(Request $request)
    {
       try{
           $payment_data = PaymentGatewayRequestHelper::paypal()->ipn_response();
           return $this->PaymentUpdateHandle($payment_data);
       }catch (\Exception $e){
           //
       }
    }

    public function mollie_ipn()
    {
      try{
          $payment_data = PaymentGatewayRequestHelper::mollie()->ipn_response();
          return $this->PaymentUpdateHandle($payment_data);
      }catch (\Exception $e){
          //
      }
    }

    public function paytm_ipn()
    {
       try{
           $payment_data = PaymentGatewayRequestHelper::paytm()->ipn_response();
           return $this->PaymentUpdateHandle($payment_data);
       }catch (\Exception $e){
           //
       }
    }

    public function stripe_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::stripe()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function razorpay_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::razorpay()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }

    public function flutterwave_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::flutterwave()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function marcadopago_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::marcadopago()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function cashfree_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::cashfree()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }

    public function instamojo_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::instamojo()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }

    public function payfast_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::payfast()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function midtrans_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::midtrans()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }

    public function squareup_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::squareup()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function cinetpay_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::cinetpay()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }

    public function paytabs_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::paytabs()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function billplz_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::billplz()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }
    public function zitopay_ipn()
    {
        try{
            $payment_data = PaymentGatewayRequestHelper::zitopay()->ipn_response();
            return $this->PaymentUpdateHandle($payment_data);
        }catch (\Exception $e){
            //
        }
    }


    private  function PaymentUpdateHandle($payment_data){

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){

            $extraService = ExtraService::find($payment_data['order_id']);

            $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
            $this->send_order_mail($extraService);

            return redirect()->route('buyer.order.details',$extraService->order_id);
        }

        abort(404);
    }


    private function update_database($order_id,$transaction_id){
        ExtraService::find($order_id)->update([
           'payment_status' => 'complete',
           'transaction_id' => $transaction_id
        ]);
    }

    private function send_order_mail($extra_service)
    {
        //todo send mail to seller and buyer
        try {
            //send mail to seller
            $seller_details = User::select('name','email')->find(optional($extra_service->order)->seller_id);
            $message = get_static_option('buyer_to_seller_extra_service_message');
            $message = str_replace(["@seller_name","@order_id"],[$seller_details->name,$extra_service->order_id],$message);

            Mail::to($seller_details->email)->send(new BasicMail([
                'subject' => __('Extra service added in your order #').$extra_service->order_id,
                'message' => $message
            ]));

            $buyer_details = User::select('name','email')->find(optional($extra_service->order)->buyer_id);
            //send mail to buyer
            $message = get_static_option('buyer_extra_service_message');
            $message = str_replace(["@buyer_name","@order_id"],[$buyer_details->name,$extra_service->order_id],$message);

            Mail::to($buyer_details->email)->send(new BasicMail([
                'subject' => __('Extra service added in your order #').$extra_service->order_id,
                'message' => $message
            ]));

        }catch (\Exception $e){
            //handle error
        }

    }

}
