<?php

namespace App\PageBuilder\Helpers;

class StylesheetHelper
{
    public static function color($color_code){
        return !empty($color_code) ? 'color:'.$color_code.';' : '';
    }

    public static function text_align($align){
        return !empty($color_code) ? 'text-align:'.$align.';' : '';
    }

    public static function background_color($color_code){
        return !empty($color_code) ? 'background-color:'.$color_code.';' : '';
    }

    public static function render_style($all_style){
        return !empty($all_style) ? 'style="'.$all_style.'"' : '';
    }
}