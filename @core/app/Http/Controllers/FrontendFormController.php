<?php

namespace App\Http\Controllers;


use App\Event;
use App\EventAttendance;
use App\FormBuilder;
use App\Mail\BasicMail;
use App\Mail\ContactMessage;
use App\Mail\CustomFormBuilderMail;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FrontendFormController extends Controller
{

    public function send_contact_message(Request $request)
    {
        $validated_data = $this->get_filtered_data_from_request(get_static_option('contact_page_contact_form_fields'), $request);
        $all_attachment = $validated_data['all_attachment'];
        $all_field_serialize_data = $validated_data['field_data'];
        $success_message = !empty($succ_msg) ? $succ_msg : __('Thanks for your contact !!');
        try{
            Mail::to(get_static_option('site_global_email'))->send(new ContactMessage($all_field_serialize_data, $all_attachment, __('You Have Contact Message from') . ' ' . get_static_option('site_' . get_default_language() . '_title')));
        }catch(\Exception $e){
            return response()->json([
                'msg' => $e->getMessage(),
                'type' => 'danger'
            ]);
        }


        return response()->json([
            'msg' => $success_message,
            'type' => 'success'
        ]);
    }


    public function get_filtered_data_from_request($option_value, $request)
    {

        $all_attachment = [];
        $all_quote_form_fields = (array) json_decode($option_value);
        $all_field_type = isset($all_quote_form_fields['field_type']) ? (array) $all_quote_form_fields['field_type'] : [];
        $all_field_name = isset($all_quote_form_fields['field_name']) ? $all_quote_form_fields['field_name'] : [];
        $all_field_required = isset($all_quote_form_fields['field_required'])  ? (object) $all_quote_form_fields['field_required'] : [];
        $all_field_mimes_type = isset($all_quote_form_fields['mimes_type']) ? (object) $all_quote_form_fields['mimes_type'] : [];
        //get field details from, form request
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token']);
        if (!empty($all_field_name)) {
            foreach ($all_field_name as $index => $field) {
                $is_required = !empty($all_field_required) && property_exists($all_field_required, $index) ? $all_field_required->$index : '';
                $mime_type = !empty($all_field_mimes_type) && property_exists($all_field_mimes_type, $index) ? $all_field_mimes_type->$index : '';
                $field_type = isset($all_field_type[$index]) ? $all_field_type[$index] : '';
                if (!empty($field_type) && $field_type == 'file') {
                    unset($all_field_serialize_data[$field]);
                }
                $validation_rules = !empty($is_required) ? 'required|' : '';
                $validation_rules .= !empty($mime_type) ? $mime_type : '';
                //validate field
                $this->validate($request, [
                    $field => $validation_rules
                ]);
                if ($field_type == 'file' && $request->hasFile($field)) {
                    $filed_instance = $request->file($field);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-' . Str::random(32) . '-' . $field . '.' . $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/applicant', $attachment_name);
                    $all_attachment[$field] = 'assets/uploads/attachment/applicant/' . $attachment_name;
                }
            }
        }
        return [
            'all_attachment' => $all_attachment,
            'field_data' => $all_field_serialize_data
        ];
    }


    public function custom_form_builder_message(Request $request)
    {
        $this->validate($request, [
            "custom_form_id" => 'required'
        ]);
        
        $google_captcha_result = google_captcha_check($request->gcaptcha_token);
        if (!$google_captcha_result['success']) {
            toastr_error(__('google recaptcha error!!, reload the page and try again'));
            return redirect()->back();
        }
        

        $field_details = FormBuilder::find($request->custom_form_id);

        unset($request['custom_form_id']);
        unset($request['gcaptcha_token']);
        $validated_data = $this->get_filtered_data_from_request($field_details->fields, $request, false);
        $all_attachment = $validated_data['all_attachment'];
        $all_field_serialize_data = $validated_data['field_data'];


        try {
            Mail::to($field_details->email)->send(
                new CustomFormBuilderMail([
                    'data' => [
                        'all_fields' => $all_field_serialize_data,
                        'attachments' => $all_attachment
                    ],
                    'form_title' => $field_details->title,
                    'subject' => sprintf(__('You Have %s Message from'), $field_details->title) . ' ' . get_static_option('site_title')
                ])
            );
        } catch (\Exception $e) {
            toastr_error($e->getMessage());
            return redirect()->back();

        }
        toastr_success($field_details->success_message);
        return redirect()->back();
    }
}
