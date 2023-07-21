<?php

namespace App\Http\Controllers\User;

use App\Actions\Media\MediaHelper;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\MediaUpload;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class MediaUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload_media_file(Request $request)
    {
        $this->validate($request, [
            'file' => 'nullable|mimes:jpg,jpeg,png,gif|max:11000'
        ]);
        MediaHelper::insert_media_image($request,'web');
    }

    public function all_upload_media_file(Request $request)
    {
        return response()->json(MediaHelper::fetch_media_image($request,'web'));
    }

    public function delete_upload_media_file(Request $request)
    {
        MediaHelper::delete_media_image($request,'web');

        return redirect()->back()->with(FlashMsg::error('Image Deleted'));
    }

    public function alt_change_upload_media_file(Request $request)
    {
        $this->validate($request, [
            'imgid' => 'required',
            'alt' => 'nullable',
        ]);
        MediaUpload::where(['id' => $request->imgid,'type' => 'web','user_id' => auth('web')->id()])->update(['alt' => $request->alt]);
        return __('alt update done');
    }
    public function get_image_for_loadmore(Request $request){
        return response()->json(MediaHelper::load_more_images($request,'web'));
    }

}
