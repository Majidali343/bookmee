<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Modules\LiveChat\Entities\LiveChatMessage;

class BuyerChatController extends Controller
{
    public function liveChat()
    {
        $buyer_id = auth('sanctum')->id();
        $seller_lists = LiveChatMessage::select('seller_id')
            ->with('sellerList')
            ->distinct('seller_id')
            ->where('seller_id','!=',NULL)
            ->where('buyer_id', $buyer_id)
            ->get();

        $seller_image=[];
        foreach($seller_lists as $seller){
            $seller_image[]= get_attachment_image_by_id($seller->sellerList->image);
        }
        if($seller_lists){
            return response()->success([
                'chat_seller_lists'=>$seller_lists,
                'seller_image'=>$seller_image,
            ]);
        }
        return response()->error([
            'chat_seller_lists'=>__('No Contacts Yet'),
        ]);

    }

    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new LiveChatMessage();

        $message->from_user = auth('sanctum')->user()->id;
        $message->to_user = $request->to_user;

        if($request->message != '' && $request->message != null && $request->message != 'null')  {
            $message->message = strip_tags($request->message);
        } else {
            if($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }

        $message->buyer_id = auth('sanctum')->user()->id;
        $message->seller_id = $request->to_user;
        $message->save();

        $profile_image =  render_image_markup_by_attachment_id(optional($message->fromUser)->image);

        // prepare the message object along with the relations to send with the response
        $message = LiveChatMessage::with(['fromUser', 'toUser'])->find($message->id);

        // fire the event
        event(new MessageSent($message));

        $all_array = $message->toArray() + ['profile_image'=>$profile_image];

        return response()->json(['state' => 1, 'message' => $all_array]);
    }

    public function allMessages(Request $request)
    {
        if (!$request->to_user) {
            return;
        }

        $messages = LiveChatMessage::where(function($query) use ($request) {
            $query->where('from_user', auth("sanctum")->user()->id)->where('to_user', $request->to_user);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->to_user)->where('to_user', auth("sanctum")->user()->id);
        })->orderBy('created_at', 'DESC')->paginate(16)->withQueryString();

        return response()->json([
            'messages' => $messages
        ]);

    }

    public function getPusherCredentials()
    {
        $pusher_app_id = getenv("PUSHER_APP_ID") ?? '';
        $pusher_app_key = getenv("PUSHER_APP_KEY") ?? '';
        $pusher_app_secret = getenv("PUSHER_APP_SECRET") ?? '';
        $pusher_app_cluster = getenv("PUSHER_APP_CLUSTER") ?? '';

        $user_info = auth('sanctum')->user();
        $user_type =  $user_info->user_type ===  1 ? 'seller_' : '';
        $seller_instanace = $user_info->user_type === 0 ? 'seller_' : '';
        $pusher_app_push_notification_auth_token =  get_static_option($user_type.'pusher_app_push_notification_auth_token');
        $pusher_app_push_notification_instanceId_seller =  get_static_option( $user_type.'pusher_app_push_notification_instanceId');
        $pusher_app_push_notification_instanceId =  get_static_option( $seller_instanace.'pusher_app_push_notification_instanceId');

        $auth_url = 'https://'.$pusher_app_push_notification_instanceId_seller.'.pushnotifications.pusher.com/publish_api/v1/instances/'.$pusher_app_push_notification_instanceId_seller.'/publishes';

        return response()->success([
            'pusher_app_id'=>$pusher_app_id,
            'pusher_app_key'=>$pusher_app_key,
            'pusher_app_secret'=>$pusher_app_secret,
            'pusher_app_cluster'=>$pusher_app_cluster,
            'pusher_app_push_notification_auth_token'=> $pusher_app_push_notification_auth_token,
            'pusher_app_push_notification_auth_url'=> $auth_url, //build by me
            'pusher_app_push_notification_instanceId'=> $pusher_app_push_notification_instanceId
        ]);
    }

}
