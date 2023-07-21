<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Subscription\Entities\SellerSubscription;
use Modules\Subscription\Entities\SubscriptionHistory;

class SellerSubscriptionController extends Controller
{
     public function subscription_info()
        {
            $seller_id = auth('sanctum')->id();
            $subscription = SellerSubscription::where('seller_id',$seller_id)->first();
            if($subscription){
                return response()->success([
                    'subscription_info'=>$subscription,
                ]);
            }else{
                return response()->error([
                    'subscription_info'=>__('No Subscription Yet'),
                ]);
            }
        }

     public function subscription_history()
     {
         $seller_id = auth('sanctum')->id();
         $subscription_history = SubscriptionHistory::where('seller_id',$seller_id)->get();
         if($subscription_history){
             return response()->success([
                 'subscription_history'=>$subscription_history,
             ]);
         }else{
             return response()->error([
                 'subscription_history'=>__('No History Found'),
             ]);
         }
     }
}
