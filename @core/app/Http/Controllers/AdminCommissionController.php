<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\AdminCommission;
use Illuminate\Support\Facades\Cache;

class AdminCommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-commission',['only' => ['admin_commission_all']]);
        $this->middleware('permission:admin-commission',['only' => ['admin_commission_all']]);
    }

    public function admin_commission_all(){
        $commission =AdminCommission::first();
        return view('backend.pages.admin-commission.admin-commission-all',compact('commission'));
    }

    public function admin_commission_update(Request $request,$id=null){
        $request->validate([
            'system_type'=> 'required'
        ]);

        if(!empty($id)){
            AdminCommission::where('id',$id)->update([
                'system_type'=>$request->system_type,
                'commission_charge_type'=>$request->commission_charge_type ?? 'percentage',
                'commission_charge'=>$request->commission_charge ?? 10, 
            ]);
        }else{
            AdminCommission::create([
                'system_type' => $request->system_type,
                'commission_charge_type' => $request->commission_charge_type ?? 'percentage',
                'commission_charge' => $request->commission_charge ?? 10, 
            ]);
        }

        Cache::forget('admin_commission_data');
        
        return redirect()->back()->with(FlashMsg::item_new(__('Update Success')));
    }
}
