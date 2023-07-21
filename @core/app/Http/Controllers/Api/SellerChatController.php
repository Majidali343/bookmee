<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Modules\LiveChat\Entities\LiveChatMessage;

class SellerChatController extends Controller
{
    public function liveChat()
    {
        $seller_id = auth('sanctum')->id();
        $buyer_lists = LiveChatMessage::select('buyer_id')
            ->with('buyerList')
            ->whereHas('buyerList')
            ->distinct('buyer_id')
            ->where('buyer_id','!=',NULL)
            ->where('seller_id', $seller_id)
            ->get();   

        $buyer_image=[];
        foreach($buyer_lists as $buyer){
              $buyer_image[]= get_attachment_image_by_id(optional($buyer->buyerList)->image);
        }
        if($buyer_lists){
            return response()->success([
                'chat_buyer_lists'=>$buyer_lists,
                'buyer_image'=>$buyer_image,
            ]);
        }
        return response()->error([
            'chat_buyer_lists'=>__('No Contacts Yet'),
        ]);
    }
    

    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new LiveChatMessage();

        $seller_id = auth('sanctum')->id();
        $message->from_user = $seller_id;
        $message->to_user = $request->to_user;

        if($request->message != '' && $request->message != null && $request->message != 'null')  {
            $message->message = strip_tags($request->message);
        } else {
            if($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }
        $message->seller_id = $seller_id;
        $message->buyer_id = $request->to_user;
        $message->save();

        $profile_image =  render_image_markup_by_attachment_id(optional($message->fromUser)->image);

        // prepare the message object along with the relations to send with the response
        $message = LiveChatMessage::with(['fromUser', 'toUser'])->find($message->id);

        // fire the event
        \event(new MessageSent($message));

        $all_array = $message->toArray() + ['profile_image'=>$profile_image];

        return response()->json([
            'state' => 1,
            'message' => $all_array,
            'from_user' => $seller_id,
            'to_user' => $request->to_user,
            'message' => $request->message,
        ]);
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
}
