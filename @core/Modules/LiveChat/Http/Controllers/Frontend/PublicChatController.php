<?php

namespace Modules\LiveChat\Http\Controllers\Frontend;

use App\Events\Message;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LiveChat\Entities\LiveChatPublicInfo;
use Modules\LiveChat\Entities\LiveChatPublicMessage;
use Carbon\Carbon;
use Session;

class PublicChatController extends Controller
{

    public function saveUserInfo(Request $request)
    {
        $request->validate([
            'chat_user_name'=>'required',
            'chat_user_email'=>'required|email|regex:/(.+)@(.+)\.(.+)/i',
        ]);

       $info = LiveChatPublicInfo::create([
            'name'=>$request->chat_user_name,
            'email'=>$request->chat_user_email,
        ]);

       if($new_user = $info->id){
            Session::put('live_chat_public_info_id',$new_user);
           $new_message = LiveChatPublicMessage::create([
               'live_chat_public_info_id' => $new_user,
               'message' => $request->chat_user_message,
               'time' => date('Y-m-d H:i:s'),
           ]);
           $time = $new_message->created_at->diffForHumans();
           $profile_image = "<img style='width:50px; height:50px; border-radius: 50%; object-fit: cover;' src='" . asset('assets/backend/images/static/profile2.png') . "' alt='profile-image'>" ;
           $status = __('save_user_info');
           event(new Message('Admin', $profile_image, $request->chat_user_name, $time, $request->chat_user_message,$status));

            return response()->json([
                'status'=>'save_user_info',
            ]);
        }
    }


    public function sendUserMessage(Request $request)
    {
     $new_user_id = Session::get('live_chat_public_info_id');
     $user_name = LiveChatPublicInfo::select('name')->where('id',$new_user_id)->first();
     if($request->ajax()){
         $request->validate([
             'chat_user_message'=>'required',
         ]);

         $new_message = LiveChatPublicMessage::create([
             'live_chat_public_info_id' => $new_user_id,
             'message' => $request->chat_user_message,
             'time' => date('Y-m-d H:i:s'),
         ]);
         $time = $new_message->created_at->diffForHumans();
         $profile_image = "<img style='width:50px;height:50px; border-radius: 50%; object-fit: cover;' src='" . asset('assets/backend/images/static/profile2.png') . "' alt='profile-image'>" ;
         event(new Message('Admin', $profile_image, $user_name->name, $time, $request->chat_user_message));

         return response()->json([
             'status'=>'success',
             'profile_image'=>$profile_image,
             'time'=>$time,
             'message'=>$request->chat_user_message,
             'user_name'=>$user_name,
         ]);
     }
    }


    public function closeChatBox(Request $request)
    {
        if($request->ajax()){
            $new_user_id = Session::get('live_chat_public_info_id');
            LiveChatPublicMessage::where('live_chat_public_info_id',$new_user_id)->update([
                'status' => 1,
            ]);
            LiveChatPublicInfo::where('id',$new_user_id)->update([
                'status' => 1,
            ]);
            Session::forget('live_chat_public_info_id');
        }
    }

}
