<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Staff;
use App\Helpers\FlashMsg;


class StaffController extends Controller
{
    public function index(){
        $user = \Auth::user();
        $staff  = $user->staff;
        return view('frontend.user.seller.staff.staff')->with(['staff'=>$staff]);
    }

    public function addStaff(Request $request){
       
        $request->validate([
            'staffName' => 'required',
            'staffEmail' => 'required|max:191',
            'image' => 'max:150',
        ]);

        

        $staff = new Staff();
        $staff->name = $request->staffName;
        $staff->email = $request->staffEmail;
        $staff->profile_image_id = $request->image;
        $staff->user_id = \Auth::id();
        $staff->save();

        return redirect()->back();
    }


    public function updateStaff(Request $request){

        $request->validate([
            'staffId' => 'required',
            'staffName_up' => 'required',
            'image_up' => 'max:191',
            'staffEmail_up' => 'required|max:150',
        ]);

        $staff = Staff::find($request->staffId);
        $staff->name = $request->staffName_up;
        $staff->email = $request->staffEmail_up;
        $staff->profile_image_id = $request->image_up;
        $staff->user_id = \Auth::id();
        $staff->save();
        
        return redirect()->back();
    }

    
    public function deleteStaff($id = null){
        if($id == null){
            return redirect()->back()->with(FlashMsg::item_new("Please Provide Id"));
        }

        $staff = Staff::find($id);
        if($staff== null){
            return redirect()->back()->with(FlashMsg::item_new("Staff Not Found"));
        }
        if($staff->user_id == \Auth::id()){
            $staff->delete();
        }else{
            return redirect()->back()->with(FlashMsg::item_new("Your are Not Allowed To Delete!!"));
        }
        
        return redirect()->back();
    }
}
