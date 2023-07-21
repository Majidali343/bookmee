<?php

namespace App\Http\Controllers;

use App\Country;
use App\Helpers\FlashMsg;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function country_tax(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'tax'=>'required|numeric',
                'country_id'=>'required|unique:taxes',
            ]);
            Tax::create([
                'tax' => $request->tax,
                'country_id' => $request->country_id,

            ]);
            return redirect()->back()->with(FlashMsg::item_new(__('Tax Added Success')));
        }
        $taxes = Tax::latest()->get();
        $countries = Country::all();
        return view('backend.pages.tax.tax',compact('taxes','countries'));
    }

    public function edit_tax(Request $request)
    {
        $request->validate([
            'tax' => 'required|numeric',
            'country_id' => 'required|unique:taxes,country_id,'.$request->up_id,
        ]);

        Tax::where('id',$request->up_id)->update([
            'tax' => $request->tax,
            'country_id' => $request->country_id,
        ]);
        return redirect()->back()->with(FlashMsg::item_new(__('Tax Updated Success')));
    }

    public function delete_country_tax($id = null)
    {
        Tax::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(__('Tax Deleted Success')));
    }
}
