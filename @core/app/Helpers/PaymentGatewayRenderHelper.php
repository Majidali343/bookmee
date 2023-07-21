<?php

namespace App\Helpers;

use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use Modules\Wallet\Entities\Wallet;

class PaymentGatewayRenderHelper
{
    public static function listOfPaymentGateways(){
        $payment_gateway_list = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','marcadopago','instamojo','cashfree','payfast','midtrans','squareup','cinetpay','paytabs','billplz','zitopay'];
        //todo append payment gateway name from modules
        $modules_payment_gateway = (new ModuleMetaData())->getAllPaymentGatewayList();
        return !empty($modules_payment_gateway) ? array_merge($payment_gateway_list,$modules_payment_gateway) : $payment_gateway_list;
    }

    public static function renderCurrentBalanceForm(){
        $output = '<div class="current-balance-wrapper">';
        $output .= '<input type="checkbox" name="selected_payment_gateway" id="current_balance_gateway" class="mr-2 current_balance_selected_gateway">';
        $output .= '<label for="current_balance_gateway">'.__('Deposit From Current Balance').'</label>';
        $output .= '</div>';
        return $output;
    }

    public static function renderWalletForm(){
        
        if(!\Auth::guard('web')->check()) {
            return '';
        }
        $auth_user_id = \Auth::guard('web')->user()->id;
        $wallet_lists = Wallet::where('buyer_id', $auth_user_id)->where('status', 1)->latest()->first();
        if (!empty($wallet_lists)){
            $output = '<div class="wallet-payment-gateway-wrapper">';
            $output .= '<input type="checkbox" name="selected_payment_gateway" id="wallet_selected_payment_gateway" class="mr-2 wallet_selected_payment_gateway">';
            $output .= '<label for="wallet_selected_payment_gateway">'.__('Order From Wallet').'</label>';
            $output .= '</div>';
        }else{
            $output = '';
        }
        return $output;
    }

    public static function renderPaymentGatewayForForm($cash_on_delivery_show = true){
        $output = '<div class="payment-gateway-wrapper payment_getway_image">';

        $output .= '<input type="hidden" name="selected_payment_gateway" id="order_from_user_wallet" value="' . get_static_option('site_default_payment_gateway') . '">';

        $all_gateway = self::listOfPaymentGateways();

        $output .= '<ul>';
        $cash_on_delivery = (bool)get_static_option('cash_on_delivery_gateway');
        if ($cash_on_delivery && $cash_on_delivery_show) {
            $output .= '<li data-gateway="cash_on_delivery" ><div class="img-select">';
            $output .= render_image_markup_by_attachment_id(get_static_option('cash_on_delivery_preview_logo'));
            $output .= '</div></li>';
        }
        foreach ($all_gateway as $gateway) {
            if (!empty(get_static_option($gateway . '_gateway'))) :
                $class = (get_static_option('site_default_payment_gateway') == $gateway) ? 'class="selected active"' : '';

                $output .= '<li data-gateway="' . $gateway . '" ' . $class . '><div class="img-select">';
                $output .= render_image_markup_by_attachment_id(get_static_option($gateway . '_preview_logo'));
                $output .= '</div></li>';
            endif;
        }
        $output .= '</ul>';
        $output .= '</div>';
        //extra field data for payment gateway
        $output .= '<div class="payment_gateway_extra_field_information_wrap">';
        if(!empty(get_static_option('manual_payment_gateway'))){
            $output .= '<div class="manual_payment_gateway_extra_field"><div class="form-group"> <div class="label mt-3 mb-2">'.get_static_option('site_manual_payment_name').__('Receipt').'</div> <input type="file" name="manual_payment_image" class="form-control" style="line-height: 1.15"></div><div class="manual_description">'. get_static_option('site_manual_payment_description') .'</div></div>';
        }
        //todo write code for all module extra info markup
        $output .= (new ModuleMetaData())->renderAllPaymentGatewayExtraInforBlade();
        $output .= '</div>';
        return $output;
    }


}