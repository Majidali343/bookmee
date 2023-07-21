<?php

namespace Modules\LiveChat\Http\Controllers\Frontend;

use App\Events\MessageSent;
use App\Order;
use App\User;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LiveChat\Entities\LiveChatMessage;

class BuyerChatController extends Controller
{
    public function chatUserLogin(Request $request){
        if($request->isMethod('post')){
            $email_or_username = filter_var($request->user_login_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $request->validate([
                'user_login_email' => 'required|string',
                'user_login_password' => 'required|min:6'
            ],
                [
                    'user_login_email.required' => sprintf(__('%s required'),$email_or_username),
                    'user_login_password.required' => __('password required')
                ]);

            if (Auth::guard('web')->attempt([$email_or_username => $request->user_login_email, 'password' => $request->user_login_password])){
                return response()->json([
                    'status' => 'login'
                ]);
            }
            return response()->json([
                'msg' => sprintf(__('Your %s or Password Is Wrong !!'),$email_or_username),
                'type' => 'danger',
                'status' => 'not_ok'
            ]);
        }
    }


    public function liveChat()
    {
        $users = User::where('id', '!=', Auth::guard('web')
            ->user()->id)
            ->where('user_type',0)
            ->get();

        $prefix = 'buyer';
        return view('livechat::frontend.buyer.livechat',compact('users','prefix'));
    }

    public function getLoadLatestMessages(Request $request)
    {
        if(!$request->user_id) {
            return;
        }
        $messages = LiveChatMessage::where(function($query) use ($request) {
            $query->where('from_user', \Illuminate\Support\Facades\Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();
        $return = [];
        foreach ($messages->reverse() as $message) {
            $return[] = view('livechat::frontend.seller.message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }

        $message = new LiveChatMessage();

        $message->from_user = Auth::user()->id;
        $message->to_user = $request->to_user;

        if($request->message != '' && $request->message != null && $request->message != 'null')  {
            $message->message = strip_tags($request->message);
        } else {
            if($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }

        $message->buyer_id = Auth::user()->id;
        $message->seller_id = $request->to_user;
        $message->save();

        $pusher_auth = get_static_option('seller_pusher_app_push_notification_auth_token');
        $pusher_instance_id = get_static_option('seller_pusher_app_push_notification_instanceId');
        $pusher_auth_url = 'https://'.$pusher_instance_id.'.pushnotifications.pusher.com/publish_api/v1/instances/'.$pusher_instance_id.'/publishes';

        $seller_info = User::find($message->seller_id);
        $response = Http::withToken($pusher_auth)->acceptJson()->post(
            $pusher_auth_url
        ,[
            "interests" => ["debug-seller".$seller_info->id, 'message'],
            "fcm" =>[
                "notification" => [
                    "title" => "You have received a message from ".$seller_info?->name,
                    "body" => '"'.Auth::guard('web')->user()->id.'"'
                ]
            ]
        ]);
            

        $profile_image =  render_image_markup_by_attachment_id(optional($message->fromUser)->image);

        // prepare the message object along with the relations to send with the response
        $message = LiveChatMessage::with(['fromUser', 'toUser'])->find($message->id);

        // fire the event
        event(new MessageSent($message));

        $all_array = $message->toArray() + ['profile_image'=>$profile_image];

        return response()->json(['state' => 1, 'message' => $all_array]);
    }

    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if(!$request->old_message_id || !$request->to_user)
            return;

        $message = LiveChatMessage::find($request->old_message_id);

        $previousMessages = $this->getPreviousMessages($request, $message);

        $return = [];

        $noMoreMessages = true;

        if($previousMessages->count() > 0) {

            foreach ($previousMessages as $message) {

                $return[] = view('livechat::frontend.buyer.message-line')->with('message', $message)->render();
            }

            $noMoreMessages = !($this->getPreviousMessages($request, $previousMessages[$previousMessages->count() - 1])->count() > 0);
        }

        return response()->json(['state' => 1, 'messages' => $return, 'no_more_messages' => $noMoreMessages]);
    }

    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    private function getPreviousMessages(Request $request, $message)
    {
        $previousMessages = LiveChatMessage::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'DESC')->limit(10)->get();

        return $previousMessages;
    }

    private function uploadImage($request)
    {
        $file = $request->file('image');
        $filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();

        $file->move('assets/uploads/chat_image', $filename);

        return $filename;
    }

    //chat name search
    public function chatNameSearch(Request $request)
    {
        $sellers = Order::select('seller_id')
            ->distinct('seller_id')
            ->whereHas('seller', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search_text . '%');
            })
            ->where('buyer_id', Auth::guard('web')
                ->user()->id)
            ->get();

        if ($sellers){
            $seller_container = view('livechat::frontend.buyer.seller_container', compact('sellers'))->render();
            return response()->json([
                'status' => 'success',
                'seller_container' => $seller_container,
            ]);
        }
        return response()->json([
            'status' => 'nothing',
            'msg' => 'Nothing Found',
        ]);
    }

}
