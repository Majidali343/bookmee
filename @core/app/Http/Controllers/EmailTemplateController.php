<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Traits\EmailTemplateHelperTrait;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
//    use EmailTemplateHelperTrait;
    const BASE_PATH = 'backend.pages.email-template.';
    const BASE_PATH_TWO = 'backend.pages.email-template.admin.';
    const BASE_PATH_JOB = 'backend.pages.email-template.jobs.';
    const BASE_PATH_SUBSCRIPTION = 'backend.pages.email-template.subscription.';

    public function __construct()
    {
        $this->middleware('permission:service-list|service-status|service-delete|service-view', ['only' => ['all']]);
        $this->middleware('permission:service-status', ['only' => ['change_status']]);
        $this->middleware('permission:service-delete', ['only' => ['delete_service', 'bulk_action']]);
        $this->middleware('permission:service-view', ['only' => ['viewServiceDetails']]);
        $this->middleware('permission:service-book-setting', ['only' => ['service_book_settings']]);
        $this->middleware('permission:service-detail-setting', ['only' => ['service_details_settings']]);
    }

    public function all()
    {
        return view(self::BASE_PATH.'all');
    }

    public function user_register_template(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'user_register_subject'=>'required|min:5|max:100',
                'user_register_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'user_register_subject',
                'user_register_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH.'user-register-template');
    }

    public function user_email_verify_template(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'user_email_verify_subject'=>'required|min:5|max:100',
                'user_email_verify_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'user_email_verify_subject',
                'user_email_verify_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH.'user-email-verify-template');
    }

    public function new_service_approve(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'service_approve_subject'=>'required|min:5|max:100',
                'service_approve_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'service_approve_subject',
                'service_approve_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH.'new-service-approve-template');
    }

    public function seller_report(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'seller_report_subject'=>'required|min:5|max:100',
                'seller_report_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'seller_report_subject',
                'seller_report_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'seller-report-template');
    }

    public function seller_payout_request(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'seller_payout_subject'=>'required|min:5|max:100',
                'seller_payout_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'seller_payout_subject',
                'seller_payout_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'seller-payout-request-template');
    }

    public function seller_order_ticket(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'seller_order_ticket_subject'=>'required|min:5|max:100',
                'seller_order_ticket_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'seller_order_ticket_subject',
                'seller_order_ticket_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'seller-order-ticket-template');
    }

    public function seller_verification(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'seller_verification_subject'=>'required|min:5|max:100',
                'seller_verification_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'seller_verification_subject',
                'seller_verification_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'seller-verification-template');
    }

    public function seller_extra_service(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'seller_extra_service_subject'=>'required|min:5|max:100',
                'seller_extra_service_message'=>'required|min:10|max:1000',
                'seller_to_buyer_extra_service_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'seller_extra_service_subject',
                'seller_extra_service_message',
                'seller_to_buyer_extra_service_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'seller-extra-service-template');
    }

    public function buyer_decline(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'buyer_order_decline_subject'=>'required|min:5|max:100',
                'buyer_order_decline_message'=>'required|min:10|max:1000',
                'buyer_to_admin_extra_service_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'buyer_order_decline_subject',
                'buyer_order_decline_message',
                'buyer_to_admin_extra_service_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'buyer-order-complete-decline-template');
    }

    public function buyer_report(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'buyer_report_subject'=>'required|min:5|max:100',
                'buyer_report_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'buyer_report_subject',
                'buyer_report_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'buyer-report-template');
    }

    public function buyer_order_ticket(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'buyer_order_ticket_subject'=>'required|min:5|max:100',
                'buyer_order_ticket_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'buyer_order_ticket_subject',
                'buyer_order_ticket_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'buyer-order-ticket-template');
    }

    public function buyer_extra_service_accept(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'buyer_extra_service_subject'=>'required|min:5|max:100',
                'buyer_extra_service_message'=>'required|min:10|max:1000',
                'buyer_to_seller_extra_service_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'buyer_extra_service_subject',
                'buyer_extra_service_message',
                'buyer_to_seller_extra_service_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
        }
        return view(self::BASE_PATH.'buyer-extra-service-accept-template');
    }


    //admin email template
    public function change_payment_status(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_change_payment_status_subject'=>'required|min:5|max:100',
                'admin_change_payment_status_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_change_payment_status_subject',
                'admin_change_payment_status_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'change-payment-status-template');
    }

    public function withdraw_amount_send(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_withdraw_amount_send_subject'=>'required|min:5|max:100',
                'admin_withdraw_amount_send_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_change_payment_status_subject',
                'admin_withdraw_amount_send_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'withdraw-amount-send-template');
    }

    public function service_approve(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_service_approve_subject'=>'required|min:5|max:100',
                'admin_service_approve_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_service_approve_subject',
                'admin_service_approve_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'service-approve-template');
    }

    public function service_assign_to_seller(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_service_assign_subject'=>'required|min:5|max:100',
                'admin_service_assign_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_service_assign_subject',
                'admin_service_assign_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'admin-service-assign-to-seller-template');
    }

    public function seller_verification_from_admin(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_seller_verification_subject'=>'required|min:5|max:100',
                'admin_seller_verification_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_seller_verification_subject',
                'admin_seller_verification_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'seller-verification-template');
    }

    public function user_verification_code(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_user_verification_code_subject'=>'required|min:5|max:100',
                'admin_user_verification_code_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_user_verification_code_subject',
                'admin_user_verification_code_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'verification-code-template');
    }

    public function user_new_password(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'admin_user_new_password_subject'=>'required|min:5|max:100',
                'admin_user_new_password_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'admin_user_new_password_subject',
                'admin_user_new_password_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'new-password-template');
    }

    public function order_ad_sell_buyer(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'new_order_email_subject'=>'required|min:5|max:100',
                'new_order_buyer_message'=>'required|min:10|max:1000',
                'new_order_admin_seller_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'new_order_email_subject',
                'new_order_buyer_message',
                'new_order_admin_seller_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_TWO.'new-order-template');
    }

    public function job_apply(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'job_apply_subject'=>'required|min:5|max:100',
                'job_apply_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'job_apply_subject',
                'job_apply_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_JOB.'job-apply-template');
    }

    public function buy_subscription(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'buy_subscription_email_subject'=>'required|min:5|max:100',
                'buy_subscription_seller_message'=>'required|min:10|max:1000',
                'buy_subscription_admin_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'buy_subscription_email_subject',
                'buy_subscription_seller_message',
                'buy_subscription_admin_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_SUBSCRIPTION.'buy-subscription-template');
    }

    public function renew_subscription(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'renew_subscription_email_subject'=>'required|min:5|max:100',
                'renew_subscription_seller_message'=>'required|min:10|max:1000',
                'renew_subscription_admin_message'=>'required|min:10|max:1000',
            ]);
            $fields = [
                'renew_subscription_email_subject',
                'renew_subscription_seller_message',
                'renew_subscription_admin_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_SUBSCRIPTION.'renew-subscription-template');
    }

    public function subscription_payment_status(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'payment_subscription_email_subject'=>'required|min:5|max:100',
                'payment_subscription_seller_message'=>'required|min:5|max:100',
            ]);
            $fields = [
                'payment_subscription_email_subject',
                'payment_subscription_seller_message',
            ];
            foreach ($fields as $field) {
                update_static_option($field, $request->$field);
            }
            return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));

        }
        return view(self::BASE_PATH_SUBSCRIPTION.'payment-status-template');
    }


}
