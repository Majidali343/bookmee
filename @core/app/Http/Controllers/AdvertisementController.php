<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Helpers\FlashMsg;
use App\Poll;
use App\PollInfo;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private const BASE_PATH = 'backend.pages.advertisement.';

    public function __construct()
    {
        $this->middleware('permission:advertisement-list|advertisement-edit|advertisement-delete',['only' => ['index']]);
        $this->middleware('permission:advertisement-create',['only' => ['new_advertisement','store_advertisement']]);
        $this->middleware('permission:advertisement-edit',['only' => ['edit_advertisement','update_advertisement']]);
        $this->middleware('permission:advertisement-delete',['only' => ['bulk_action','delete_advertisement']]);
    }

    public function index()
    {
        $all_advertisements = Advertisement::latest()->get();
        return view(self::BASE_PATH.'index',compact('all_advertisements'));
    }

    public function new_advertisement()
    {
        return view(self::BASE_PATH.'new');
    }

    public function store_advertisement(Request $request)
    {

        $request->validate([
            'title'=>'required|string',
            'type'=>'required|string',
            'size'=> 'required',
            'status'=> 'required',
            'slot'=> 'nullable',
            'embed_code'=> 'nullable',
            'redirect_url'=> 'nullable',
            'image'=> 'nullable'
        ]);

        Advertisement::create([
            'title' => $request->title,
            'type' => $request->type,
            'size' => $request->size,
            'status' => $request->status,
            'slot' => $request->slot,
            'embed_code' => $request->embed_code,
            'redirect_url' => purify_html($request->redirect_url),
            'image' => $request->image,
        ]);

        return redirect()->back()->with(FlashMsg::item_new('New Advertisement Created Successfully'));
    }

    public function edit_advertisement($id)
    {
        $add = Advertisement::find($id);
        return view(self::BASE_PATH.'edit',compact('add'));
    }

    public function update_advertisement(Request $request,$id)
    {
        $request->validate([
            'title'=>'required|string',
            'type'=>'required|string',
            'size'=> 'required',
            'status'=> 'required',
            'slot'=> 'nullable',
            'embed_code'=> 'nullable',
            'redirect_url'=> 'nullable',
            'image'=> 'nullable'
        ]);

        Advertisement::where('id',$id)->update([
            'title' => purify_html( $request->title),
            'type' => purify_html($request->type),
            'size' => $request->size,
            'status' => $request->status,
            'slot' => $request->slot,
            'embed_code' => $request->embed_code,
            'redirect_url' => purify_html($request->redirect_url),
            'image' => $request->image,
        ]);

        return redirect()->back()->with(FlashMsg::item_new(' Advertisement Updated Successfully'));
    }


    public function delete_advertisement($id){
        Advertisement::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Advertisement Deleted Successfully'));
    }

    public function bulk_action(Request $request){
        Advertisement::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

}
