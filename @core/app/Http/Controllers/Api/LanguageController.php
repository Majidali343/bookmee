<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;


class LanguageController extends Controller
{
    public function languageInfo(){
        
        $languages = Language::select('id','name','slug','direction')->where('default',1)->first()->toArray();
        
        if(!is_null($languages)){
            return response()->success([
                'language'=>$languages,
            ]);
        }
        
        return response()->success([
                'language'=> [ 
                    "slug" => "en_GB",
                    "direction" => "ltr"
                ],
        ]);
    }
    
    public function translateString(Request $request){
        $translateable_array = json_decode($request->get('strings'),true);
        
        $translated_array = [];
        if($request->has('strings')){
            foreach($translateable_array as $key => $string){
                $translated_array[$key] = __($key);
            }
        }

        return response()->success([
            'strings'=> $translated_array
        ]);
    }

    
}
