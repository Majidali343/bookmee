<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Slider;

class SliderController extends Controller
{
    public function slider(){
        $slider = Slider::select('background_image','title','sub_title')->get();
        $image_url=[];
        foreach($slider as $sli){
            $image_url[]= get_attachment_image_by_id($sli->background_image);
        }
        if($slider){
            return response()->success([
                'slider-details'=>$slider,
                'image_url'=>$image_url,
            ]);
        }
        return response()->error([
            'message'=> __('Slider Not Available'),
        ]);
    }
}
