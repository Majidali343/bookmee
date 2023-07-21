<?php

namespace App\Http\Controllers;

use App\HeaderSlider;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HeaderSliderController extends Controller
{
    private const BASE_PATH = 'backend.pages.home-page-manage.';

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){

        $all_header_slider = HeaderSlider::all();
        return view(self::BASE_PATH.'header')->with([
            'all_header_slider' => $all_header_slider,
            'default_lang'=>$request->lang ?? LanguageHelper::default_slug()
        ]);
    }
    public function store(Request $request){

        $this->validate($request,[
            'title'=> 'nullable|string|max:191',
            'btn_text'=> 'nullable|string|max:191',
            'btn_url'=> 'nullable|string|max:191',
            'btn_status'=> 'nullable|string',
            'image'=> 'nullable|string',
            'bg_image'=> 'nullable|string',
        ]);

        $slider = new HeaderSlider();
        $slider
                ->setTranslation('title',$request->lang, purify_html($request->title))
                ->setTranslation('btn_text', $request->lang, purify_html($request->btn_text));
        $slider->btn_status = $request->btn_status;
        $slider->btn_url = $request->btn_url;
        $slider->image = $request->image;
        $slider->bg_image = $request->bg_image;
        $slider->save();

        return redirect()->back()->with(FlashMsg::item_new());
    }

    public function update(Request $request){
        $home_page_variant = get_static_option('home_page_variant');
        $this->validate($request,[
          'title'=> 'nullable|string|max:191',
          'btn_text'=> 'nullable|string|max:191',
          'btn_url'=> 'nullable|string|max:191',
          'btn_status'=> 'nullable|string',
          'image'=> 'nullable|string',
          'bg_image'=> 'nullable|string',
        ]);

        $slider =  HeaderSlider::findOrFail($request->id);
        $slider
            ->setTranslation('title',$request->lang, purify_html($request->title))
            ->setTranslation('btn_text', $request->lang, purify_html($request->btn_text));

        $slider->btn_url = $request->btn_url;
        $slider->image = $request->image;
        $slider->bg_image = $request->bg_image;

        if($request->has('btn_status')){
            $slider->btn_status = 'on';
        }else{
            $slider->btn_status = null;
        }
        $slider->save();

        return redirect()->back()->with(FlashMsg::item_update());
    }

    public function delete($id)
    {
        HeaderSlider::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_delete());
    }

    public function bulk_action(Request $request){
        HeaderSlider::WhereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
