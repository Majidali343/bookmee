<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Str;
use App\Mail\OrderMail;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;

class PaymentController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.order.payment.cancel.static';
    private const SUCCESS_ROUTE = 'frontend.order.payment.success';
    
    protected function cancel_page()
    {
        return redirect()->route('frontend.order.payment.cancel.static');
    }
    
    public function mollieIpn(Request $request){
        
        $payment_id = session()->get('mollie_payment_id');
        return $payment_id;
        $payment = Mollie::api()->payments->get($payment_id);
        // session()->forget('mollie_payment_id');

        if ($payment->isPaid()) {
            return $this->verified_data([
                'status' => 'complete',
                'transaction_id' => $payment->id,
                'order_id' =>  substr($payment->metadata->order_id,5,-5)
            ]);
        }
        return ['status' => 'failed'];
        
        // return response()->success([
        //     'mollie_payment_id' => session()->get('mollie_payment_id')
        // ]);
        // $payment_data = XgPaymentGateway::mollie()->ipn_response();
        // if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
        //     $this->update_database($payment_data['order_id'], $payment_data['transaction_id']);
        //     $this->send_order_mail($payment_data['order_id']);
        //     $order_id = $payment_data['order_id'];
        //     $random_order_id_1 = Str::random(30);
        //     $random_order_id_2 = Str::random(30);
        //     $new_order_id = $random_order_id_1.$order_id.$random_order_id_2;
        //     return redirect()->route('frontend.order.payment.success',$new_order_id);
        // }
        // return self::cancel_page();
    }
    
    public function mollieChargeCustomer(Request $request){
        if(!$request->has('order_id')){
            return response()->error([
                'message' => __('provider order id')
            ]);
        }
        $userInfo = auth('sanctum')->user();
        $last_order_id = $request->order_id;
        $get_service_id_from_last_order = Order::select('service_id','id','total')->where('id',$last_order_id)->first();
        $title = Str::limit(strip_tags(optional($get_service_id_from_last_order->service)->title),20);
        $description = sprintf(__('Order id #%1$d Email: %2$s, Name: %3$s'),$last_order_id,$userInfo->email,$userInfo->name);
        
         $redirect_url = XgPaymentGateway::mollie()->charge_customer([
            'amount' => $get_service_id_from_last_order->total, 
            'title' => $title,
            'description' => $description,
            'ipn_url' => route('mollie.api.ipn'),
            'order_id' => $last_order_id,
            'track' => \Str::random(36),
            'cancel_url' => route(self::CANCEL_ROUTE,$last_order_id),
            'success_url' => route(self::SUCCESS_ROUTE,$last_order_id),
            'email' => $userInfo->email, 
            'name' => $userInfo->name, 
            'payment_type' => 'order',
            'action_type' => 'api',
        ]);
        session()->put('order_id',$last_order_id);
        return response()->success([
            'redirect_url' => $redirect_url   , 
            'mollie_payment_id' => session()->get('mollie_payment_id')
        ]);
    }
    
    public function send_order_mail($order_id)
    {
        if(empty($order_id)){
            //
        }
        
        $order_details = Order::find($order_id);
        $seller_email = User::select('email')->where('id',$order_details->seller_id)->first();
        //Send order email to buyer
        try {
            Mail::to($order_details->email)->send(new OrderMail(__('You have successfully placed an order #').$order_details->id,$order_details));
            Mail::to($seller_email->email)->send(new OrderMail(__('You have a new order #').$order_details->id,$order_details));
            Mail::to(get_static_option('site_global_email'))->send(new OrderMail(__('You have a new order #').$order_details->id,$order_details));

        } catch (\Exception $e) {
            //handle exception
        }

    }

    private function update_database($order_id, $transaction_id)
    {
        Order::where('id', $order_id)->update([
            'payment_status' => 'complete',
            'transaction_id' => $transaction_id,
        ]);

    }

    
}
