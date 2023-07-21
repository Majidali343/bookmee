<?php

namespace App\Actions\Media;

use App\MediaUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MediaHelper
{

    public static function fetch_media_image($request,$type='admin')
    {
        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['user_id' => auth($type)->id()]);
        }
        $all_images = $image_query->where(['type' => $type])->orderBy('id', 'DESC')->take(20)->get();
        $selected_image = MediaUpload::find($request->selected);

        $all_image_files = [];
        if (!empty($selected_image)){
            if (file_exists('assets/uploads/media-uploader/'.$selected_image->path)) {

                $image_url = asset('assets/uploads/media-uploader/' . $selected_image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $selected_image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $selected_image->path);
                    $image_url = asset('assets/uploads/media-uploader/semi-large-' . $selected_image->path);
                }

                $all_image_files[] = [
                    'image_id' => $selected_image->id,
                    'title' => $selected_image->title,
                    'dimensions' => $selected_image->dimensions,
                    'alt' => $selected_image->alt,
                    'size' => $selected_image->size,
                    'path' => $selected_image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($selected_image->created_at, 'd M y')
                ];
            }

        }
        foreach ($all_images as $image){
            if (file_exists('assets/uploads/media-uploader/'.$image->path)){
                $image_url = asset('assets/uploads/media-uploader/'.$image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image->path);
                }
                $all_image_files[] = [
                    'image_id' => $image->id,
                    'title' => $image->title,
                    'dimensions' => $image->dimensions,
                    'alt' => $image->alt,
                    'size' => $image->size,
                    'path' => $image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($image->created_at, 'd M y')
                ];

            }
        }
        return $all_image_files;
    }


    public static function delete_user_media_image($image_id,$type ='web')
    {
        $get_image_details = MediaUpload::find($image_id);
        if (file_exists('assets/uploads/media-uploader/' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/grid-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/grid-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/large-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/semi-large-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/semi-large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/thumb-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/thumb-' . $get_image_details->path);
        }

        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['type' => $type,'user_id' => auth($type)->id()]);
        }
        $image_query->where(['id' => $image_id])->delete();
    }
    
    public static function delete_media_image($request,$type ='admin')
    {
        $get_image_details = MediaUpload::find($request->img_id);
        if (file_exists('assets/uploads/media-uploader/' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/grid-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/grid-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/large-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/semi-large-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/semi-large-' . $get_image_details->path);
        }
        if (file_exists('assets/uploads/media-uploader/thumb-' . $get_image_details->path) && !is_dir('assets/uploads/media-uploader/' . $get_image_details->path)) {
            unlink('assets/uploads/media-uploader/thumb-' . $get_image_details->path);
        }

        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['type' => $type,'user_id' => auth($type)->id()]);
        }
        $image_query->where(['id' => $request->img_id])->delete();
    }

    public static function insert_media_image($request,$type='admin',$file_field_name = 'file'){
        
        if ($request->hasFile($file_field_name)) {
            $image = $request->$file_field_name;
            $image_dimension = getimagesize($image);;
            $image_width = $image_dimension[0];
            $image_height = $image_dimension[1];
            $image_dimension_for_db = $image_width . ' x ' . $image_height . ' pixels';
            $image_size_for_db = $image->getSize();

            $image_extenstion = $image->getClientOriginalExtension();
            $image_name_with_ext = $image->getClientOriginalName();

            $image_name = pathinfo($image_name_with_ext, PATHINFO_FILENAME);
            $image_name = strtolower(Str::slug($image_name));

            $image_db = $image_name . time() . '.' . $image_extenstion;
            $image_grid = 'grid-' . $image_db;
            $image_large = 'large-' . $image_db;
            $image_thumb = 'thumb-' . $image_db;
            $image_semi_large = 'semi-large-' . $image_db;

            $folder_path = 'assets/uploads/media-uploader/';
            $resize_grid_image = Image::make($image)->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_large_image = Image::make($image)->resize(740, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resize_semi_large_image = Image::make($image)->resize(540, 350, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_thumb_image = Image::make($image)->resize(150, 150);

            $request->$file_field_name->move($folder_path, $image_db);

            MediaUpload::create([
                'title' => $image_name_with_ext,
                'size' => formatBytes($image_size_for_db),
                'path' => $image_db,
                'dimensions' => $image_dimension_for_db,
                'type' => $type,
                'user_id' => auth($type)->id(),
            ]);

            if ($image_width > 150) {
                $resize_thumb_image->save($folder_path . $image_thumb);
                $resize_grid_image->save($folder_path . $image_grid);
                $resize_large_image->save($folder_path . $image_large);
                $resize_semi_large_image->save($folder_path . $image_semi_large);
            }
        }

    }


    public static function load_more_images($request,$type = 'admin'){

        $image_query = MediaUpload::query();

        if ($type === 'web'){
            $image_query->where(['type' => $type,'user_id' => auth($type)->id()]);
        }

        $all_images = $image_query->orderBy('id', 'DESC')->skip($request->skip)->take(20)->get();

        $all_image_files = [];
        foreach ($all_images as $image){
            if (file_exists('assets/uploads/media-uploader/'.$image->path)){
                $image_url = asset('assets/uploads/media-uploader/'.$image->path);
                if (file_exists('assets/uploads/media-uploader/grid-' . $image->path)) {
                    $image_url = asset('assets/uploads/media-uploader/grid-' . $image->path);
                }
                $all_image_files[] = [
                    'image_id' => $image->id,
                    'title' => $image->title,
                    'dimensions' => $image->dimensions,
                    'alt' => $image->alt,
                    'size' => $image->size,
                    'path' => $image->path,
                    'img_url' => $image_url,
                    'upload_at' => date_format($image->created_at, 'd M y')
                ];

            }
        }
        return $all_image_files;
    }
}