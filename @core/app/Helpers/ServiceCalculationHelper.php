<?php

namespace App\Helpers;


use App\AdminCommission;
use App\Tax;
use DB;

class ServiceCalculationHelper{

    public static function calculateTax($subtotal,$service_country){
        $tax_amount = 0;
        $country_tax =  Tax::select('id','tax')->where('country_id',$service_country)->first();
        if(!is_null($country_tax )){
            $tax_amount = ($subtotal * $country_tax->tax) / 100;
        }

        return $tax_amount;
    }

    public static function calculateCommission($commission_type,$commission_charge,$subtotal,$seller_id){
        $commission = AdminCommission::first();

        //todo: calculate commission
        $commission_amount = 0;
        if($commission->system_type === 'subscription'){
            //todo: check it has subscription or not
            if(moduleExists('Subscription')){
                \Modules\Subscription\Entities\SellerSubscription::where('id', $seller_id)->update([
                    'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                ]);
            }
        }else{
            if($commission_type=='percentage'){
                $commission_amount = ($subtotal*$commission_charge)/100;
            }else{
                $commission_amount = $commission_charge;
            }
        }

        return $commission_amount;
    }

}
