<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class Error404PageManage extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:page-settings-404-page-manage');
    }
    public function error_404_page_settings()
    {
        $all_languages = Language::all();
        return view('backend.pages.404.404-page-settings')->with(['all_languages' => $all_languages]);
    }
    public function update_error_404_page_settings(Request $request)
    {
            $this->validate($request, [
                'error_404_page_title' => 'nullable|string',
                'error_404_page_subtitle' => 'nullable|string',
                'error_404_page_paragraph' => 'nullable|string',
                'error_404_page_button_text' => 'nullable|string',
            ]);
            $title = 'error_404_page_title';
            $subtitle = 'error_404_page_subtitle';
            $paragraph = 'error_404_page_paragraph';
            $button_text = 'error_404_page_button_text';
            $error_image = 'error_image';
               
            update_static_option($title, $request->$title);
            update_static_option($subtitle, $request->$subtitle);
            update_static_option($paragraph, $request->$paragraph);
            update_static_option($button_text, $request->$button_text);
            update_static_option($error_image, $request->$error_image);

        return redirect()->back()->with([
            'msg' => __('Settings Updated ...'),
            'type' => 'success'
        ]);
    }
}
