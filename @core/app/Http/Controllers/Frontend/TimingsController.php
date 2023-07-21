<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\BusinessDay;
use Illuminate\Http\Request;
use Auth;

class TimingsController extends Controller
{
    //
    public function GetTimings(){
       $userid= Auth::guard('web')->user()->id;

        $data= BusinessDay:: where('user_id' , $userid)->get();
        
        return view('frontend.user.seller.businessdays.timings' ,compact('data'));
    }


    public function TimeDelete(Request $request, $id)
    {

        BusinessDay::where('id',$id)->delete();
        
        toastr_error(__('Day Delete Success---'));
        return redirect()->back();
    }
    
    
    public function Timeedit(Request $request)
    {
        BusinessDay::where('id', $request->up_id)
       ->update(['day' => $request->eday , 'to_time' => $request->eopening_time , 'from_time' => $request->eclosing_time]);

       return redirect()->back();
        
    }
    


    public function AddTimings(Request $request){
 
        $request->validate([
            'day' => 'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
        ]);

    //    @dd($request->all());
        $data = BusinessDay::create([
            'day' => $request->day,
            'to_time' => $request->opening_time,
            'from_time' => $request->closing_time,
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        // dd($data);
         $data->save();

        toastr_success(__('Day Timings Added Successfully---'));
        return redirect()->back();
    }
}
