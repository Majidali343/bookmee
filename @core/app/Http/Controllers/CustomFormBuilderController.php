<?php

namespace App\Http\Controllers;

use App\FormBuilder;
use App\Helpers\FlashMsg;
use App\Helpers\NexelitHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomFormBuilderController extends Controller
{
    protected const BASE_PATH = 'backend.form-builder.custom.';
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function all(){
        $all_forms = FormBuilder::all();
        return view(self::BASE_PATH.'all',compact('all_forms'));
    }
    public function bulk_action(Request $request){
        FormBuilder::whereIn('id',$request->ids)->delete();
        return response()->json('ok');
    } 
    public function edit($id){
       $form =  FormBuilder::findOrFail($id);
        return view(self::BASE_PATH.'edit',compact('form'));
    }
    
    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'email' => 'required|string',
            'button_title' => 'required|string',
            'field_name' => 'required|max:191',
            'field_placeholder' => 'required|max:191',
            'success_message' => 'required',
        ]);
        $id = $request->id;
        $title = $request->title;
        $email = $request->email;
        $button_title = $request->button_title;
        unset($request['_token'],$request['email'],$request['button_title'],$request['title'],$request['id']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            $all_fields_name[] = strtolower(Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        FormBuilder::findOrfail($id)->update([
            'title' => $title,
            'email' => $email,
            'button_text' => $button_title,
            'success_message' => $request->success_message,
            'fields' => $json_encoded_data
        ]);

        return back()->with(FlashMsg::item_update());
    }

    public function store(Request $request){
        $this->validate($request,[
           'title' => 'required|string',
           'email' => 'required|string',
           'button_title' => 'required|string',
           'success_message' => 'required|string',
        ]);
        FormBuilder::create([
            'title' => $request->title,
            'email' => $request->email,
            'button_text' => $request->button_title,
            'success_message' => $request->success_message,
        ]);
        return back()->with(FlashMsg::item_new());
    }

    public function delete($id){
        FormBuilder::findOrFail($id)->delete();
        return back()->with(FlashMsg::item_delete());
    }
}
