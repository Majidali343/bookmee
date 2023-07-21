<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Helpers\FlashMsg;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:brand-list|brand-create|brand-status|brand-edit|brand-delete',['only' => ['brand']]);
        $this->middleware('permission:brand-create',['only' => ['add_brand']]);
        $this->middleware('permission:brand-status',['only' => ['change_status_brand']]);
        $this->middleware('permission:brand-edit',['only' => ['edit_brand']]);
        $this->middleware('permission:brand-delete',['only' => ['delete_brand','bulk_action_brand']]);
    }

    public function brand()
    {
        $brands = Brand::latest()->get();
        return view('backend.pages.brand.brand',compact('brands'));
    }

    public function add_brand(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=> 'required|max:191',
            ]);
    
            Brand::create([
               'title' => $request->title,
               'url' => $request->url,
               'image' => $request->image,
           ]);
    
           return redirect()->back()->with(FlashMsg::item_new('New Brand Added'));
        }
        return view('backend.pages.brand.add_brand');
    }


    public function edit_brand(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=> 'required|max:191',
            ]);
            $old_img = Brand::select('image')->find($id);
            Brand::where('id',$id)->update([
                'title'=>$request->title,
                'url'=>$request->url,
                'image'=>$request->image,
                'image' => $request->image ?? $old_img->image,
            ]);
            return redirect()->back()->with(FlashMsg::item_new('Brand Update Success'));
        }

        $brand = Brand::find($id);
        return view('backend.pages.brand.edit_brand',compact('brand'));
    }

    public function delete_brand($id)
    {
        Brand::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Brand Deleted Success'));
    }

    public function bulk_action_brand(Request $request){
        Brand::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
