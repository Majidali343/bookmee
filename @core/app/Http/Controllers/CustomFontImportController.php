<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use App\CustomFontImport;
use File;
class CustomFontImportController extends Controller
{

    // Add custom font
    public function add_custom_font(Request $request)
    {

        $request->validate([
            'files' => 'required',
        ]);

        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $key => $file)
            {
                if($file->getClientOriginalExtension() == "ttf"){
                    \Validator::make(["font_file_".$key => $file], [
                        "font_file_".$key => ["file","required",'mimetypes:font/ttf,font/sfnt']
                    ])->validated();
                }else{
                    \Validator::make(["font_file_".$key => $file], [
                        "font_file_".$key => ["file","required",'mimes:woff,woff2,eot']
                    ])->validated();
                }

                if(in_array($file->getClientOriginalExtension(),['ttf','woff','woff2','eot'])){
                    $name = $file->getClientOriginalName();
                    $path = 'assets/common/fonts/custom-fonts/css/'.$name;
                    // remove file type
                    $file_name = pathinfo($path, PATHINFO_FILENAME);
                    $file->move('assets/common/fonts/custom-fonts/css', $name);
                    $insert[$key]['file'] = $file_name;
                    $insert[$key]['path'] = $path;
                }
            }
        }

        CustomFontImport::insert($insert);

        return redirect()->back()->with(['status', 'msg' => 'Custom Font has been uploaded Successfully']);
    }


    // Delete File
    public function deleteFontFile(Request $request) {
        $find_file = CustomFontImport::find($request->id);

        if(file_exists($find_file->path)){
            unlink($find_file->path);
        }

        CustomFontImport::where("id", $find_file->id)->delete();
        return redirect()->back()->with("success", "Custom Font Deleted Successfully.");
    }

     // add custom font css
    public function update_css_custom_font(Request $request)
    {
        update_static_option('google_font',$request->google_font);
        update_static_option('custom_font',$request->custom_font);
        file_put_contents('assets/common/fonts/custom-fonts/css/custom_font.css', $request->custom_css_area);
        return redirect()->back()->with(['msg' => __('Custom Font Css Successfully Added...'), 'type' => 'success']);
    }


   // body font status change
    public function change_status_custom_font($id)
    {
        // if body font add status change
        CustomFontImport::where('status', 1)->update(['status'=>0]);
        $custom_font = CustomFontImport::select('status')->where('id',$id)->first();
        CustomFontImport::where('id',$id)->update(['status'=>1]);
         return redirect()->back()->with(FlashMsg::item_new(' Body Font Add Success'));
    }

    // heading font add
    public function change_status_custom_font_heading($id)
    {
             // if body font add status change
             CustomFontImport::where('status', 2)->update(['status'=>0]);
            $custom_font = CustomFontImport::select('status')->where('id',$id)->first();
            CustomFontImport::where('id',$id)->update(['status'=>2]);
             return redirect()->back()->with(FlashMsg::item_new(' Heading Font Add Success'));
    }



}
