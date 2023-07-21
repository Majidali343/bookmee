<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Language;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:page-settings-contact-page-manage');
    }
    public function contact_page_settings(){
        return view('backend.pages.contact-page.contact-page-settings');
    }
    public function update_contact_page(Request $request){
        $this->validate($request,[
            'contact_page_map_section_location' => 'required|string',
            'contact_page_map_section_zoom' => 'required|string',
        ]);
        $all_languages = Language::all();
        foreach ($all_languages as $lang) {
            $this->validate($request, [
                'contact_page_contact_us_' . $lang->slug . '_title' => 'nullable|string',
                'contact_page_button_' . $lang->slug . '_text' => 'nullable|string',
                'contact_page_contact_us_' . $lang->slug . '_address' => 'nullable|string',
                'contact_page_contact_us_' . $lang->slug . '_phone' => 'nullable|string',
                'contact_page_contact_us_' . $lang->slug . '_email' => 'nullable|string',
            ]);
            $fields = [
                'contact_page_contact_us_' . $lang->slug . '_title',
                'contact_page_button_' . $lang->slug . '_text',
                'contact_page_contact_us_' . $lang->slug . '_address',
                'contact_page_contact_us_' . $lang->slug . '_phone',
                'contact_page_contact_us_' . $lang->slug . '_email',
            ];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    update_static_option($field, $request->$field);
                }
            }
        }
        update_static_option('contact_page_map_section_location',$request->contact_page_map_section_location);
        update_static_option('contact_page_map_section_zoom',$request->contact_page_map_section_zoom);

        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function section_manage(){
        return view('backend.pages.contact-page.section-manage');
    }
    public function update_section_manage(Request $request){
        $this->validate($request,[
            'contact_page_map_section_status' => 'nullable|string',
            'contact_page_contact_info_section_status' => 'nullable|string',
            'contact_page_contact_form_section_status' => 'nullable|string',
        ]);
        $fields = ['map','contact_info','contact_form'];
        foreach($fields as $field){
            $filed_name = 'contact_page_'.$field.'_section_status';
            update_static_option($filed_name,$request->$filed_name);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }
}
