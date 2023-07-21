<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:slider-list|slider-edit|slider-delete',['only' => ['add_new_slider']]);
        $this->middleware('permission:slider-edit',['only' => ['edit_slider']]);
        $this->middleware('permission:slider-delete',['only' => ['delete_slider','bulk_action']]);
    }

    public function add_new_slider(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate(
                [
                    'background_image'=> 'required|max:191',
                    'title'=> 'required|max:191',
                    'sub_title'=> 'required|max:191',
                ]);
            Slider::create([
                'background_image' => $request->background_image,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'service_id' => $request->service_id,
            ]);

            return redirect()->back()->with(FlashMsg::item_new('New Slider Added'));
        }
        $sliders = Slider::all();
        return view('backend.pages.slider.add_slider',compact('sliders'));
    }

    public function edit_slider(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $request->validate([
                'title'=> 'required|max:191',
                'sub_title'=> 'required|max:191',
            ]);

            $old_image = Slider::select('background_image')->where('id',$id)->first();
            Slider::where('id',$id)->update([
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'service_id'=>$request->service_id,
                'background_image'=>$request->background_image ?? $old_image->background_image,
            ]);
            return redirect()->back()->with(FlashMsg::item_new('Slider Update Success'));
        }
        $slider = Slider::find($id);
        return view('backend.pages.slider.edit_slider',compact('slider'));
    }

    public function delete_slider($id){
        Slider::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Slider Deleted Success'));
    }

    public function bulk_action(Request $request){
        slider::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
