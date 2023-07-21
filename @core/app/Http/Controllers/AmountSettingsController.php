<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\AmountSettings;

class AmountSettingsController extends Controller
{
    public function amount_settings()
    {
        $amount_settings =AmountSettings::first();
        return view('backend.pages.amount-settings.amount-settings',compact('amount_settings'));
    }

    public function amount_settings_update(Request $request,$id=null)
    {
        $request->validate([
            'min_amount'=> 'required|numeric',
        ]);

        if(!empty($id)){
            AmountSettings::where('id',$id)->update([
               'min_amount' => $request->min_amount,
               'max_amount' => $request->max_amount,
            ]);
        }else{
            AmountSettings::create([
               'min_amount' => $request->min_amount,
               'max_amount' => $request->max_amount,
            ]);
        }
        return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
    }

    public function user_register_settings()
    {
        return view('backend.pages.register-settings.user-register-settings');
    }

    public function seller_register_settings_update(Request $request)
    {
        update_static_option('seller_register_on_off',$request->seller_register_on_off);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));
    }

    public function buyer_register_settings_update(Request $request)
    {
        update_static_option('buyer_register_on_off',$request->buyer_register_on_off);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));
    }
    public function seller_buyer_register_off_notice_update(Request $request)
    {
        update_static_option('register_notice',$request->register_notice);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));
    }



}
