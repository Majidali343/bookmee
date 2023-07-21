<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Language;
use App\AmountSettings;

class MiscellaneousController extends Controller
{
    public function modulePermission(){
        
        return response()->success([
            'permissions'=> [ 
                "JobPost" => moduleExists("JobPost"),
                "LiveChat" => moduleExists("LiveChat"),
                "Subscription" => moduleExists("Subscription"),
                "Wallet" => moduleExists("Wallet"),
            ],
        ]);
    }
    public function currencyInfo(){
        
        return response()->success([
            'currency'=> [ 
                "symbol" => site_currency_symbol(),
                "position" => get_static_option('site_currency_symbol_position')
            ],
        ]);
    }
    
    public function amountSettings(){
        
        $amount_settings = AmountSettings::first();
        
        return response()->success([
            'amount_settings'=> [ 
                "min_amount" => $amount_settings->min_amount,
                "max_amount" => $amount_settings->max_amount
            ],
        ]);
    }

    
}
