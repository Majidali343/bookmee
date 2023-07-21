<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subcategory;

class CategoryController extends Controller
{
    public function category(){
        $category = Category::select('id','name','icon','mobile_icon')->where('status',1)->get()->transform(function($item){
            //
            $mobile_icon = get_attachment_image_by_id($item->mobile_icon);
            $item->mobile_icon = !empty($mobile_icon) ? $mobile_icon['img_url'] : null;
            
            return $item;
        });
        if($category){
            return response()->success([
                'category'=>$category,
            ]);
        }
        return response()->error([
            'message'=>__('Category Not Available'),
        ]);
    }

    //get subcategory under category
    public function subCategory($category_id)
    {
        $sub_categories = Subcategory::select('id', 'name')
            ->where('category_id', $category_id)
            ->get();
        if ($sub_categories->count() >= 1) {
            return response()->json(['sub_categories' => $sub_categories]);
        } else {
            return response()->error([
                'message' => __('No Sub Categories Available On The Selected Category'),
            ]);
        }
    }
}
