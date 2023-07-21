<?php

namespace Modules\LiveChat\Http\Controllers\Backend;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LiveChat\Entities\LiveChatMessage;
use Auth;
use Session;

class PublicChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:public-chat',['only' => ['chatUsers']]);
    }

    public function seller()
    {
        $sellers = LiveChatMessage::select('id','seller_id')
            ->with('sellerOnlyForAdmin')
            ->get()
            ->unique('seller_id');
        return view('livechat::backend.public-chat',compact('sellers'));
    }

    public function buyerConnectedToSeller($id)
    {
        $seller_id = $id;
        $buyers = LiveChatMessage::select('buyer_id')
            ->with('buyerList')
            ->distinct('buyer_id')
            ->where('buyer_id','!=',NULL)
            ->where('seller_id', $id)
            ->get();

        $sellers = LiveChatMessage::select('id','seller_id')
            ->with('sellerOnlyForAdmin')
            ->get()
            ->unique('seller_id');
        return view('livechat::backend.public-chat',compact('sellers','buyers','seller_id'));
    }

    public function chatDetails(Request $request)
    {
        $seller_id = $request->seller_id;

         if(!empty(Session::get('first')) && $request->buyer_id === Session::get('buyer_id')){
             Session::forget("first");
             return redirect()->route('admin.chat.seller');
         }

        Session::put('first',$request->first);
        Session::put('buyer_id',$request->buyer_id);

        $buyers = LiveChatMessage::select('buyer_id')
            ->with('buyerList')
            ->distinct('buyer_id')
            ->where('buyer_id','!=',NULL)
            ->where('seller_id', $request->seller_id)
            ->get();

        $sellers = LiveChatMessage::select('id','seller_id')
            ->with('sellerOnlyForAdmin')
            ->get()
            ->unique('seller_id');

        $messages = LiveChatMessage::select('seller_id','buyer_id','message','image','created_at','from_user')
            ->with('buyerOnlyForAdmin','buyerOnlyForAdmin')
            ->where('seller_id', $request->seller_id)
            ->where('buyer_id', $request->buyer_id)
            ->latest()
            ->get();

        return view('livechat::backend.public-chat',compact('sellers','buyers','seller_id','messages'));
    }

    public function loginTextShowHide(Request $request)
    {
        if($request->isMethod('post')){
            update_static_option('login_text_show_hide',$request->login_text_show_hide);
            return redirect()->back()->with(FlashMsg::item_new('Update Success'));
        }
        return view('livechat::backend.chat-login-text-settings');
    }



}
