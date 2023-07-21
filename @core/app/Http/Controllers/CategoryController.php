<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\Category;
use Illuminate\Support\Facades\DB;
use Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-status|category-edit|category-delete',['only' => ['index']]);
        $this->middleware('permission:category-create',['only' => ['add_new_category']]);
        $this->middleware('permission:category-edit',['only' => ['edit_category']]);
        $this->middleware('permission:category-status',['only' => ['change_status']]);
        $this->middleware('permission:category-delete',['only' => ['delete_category','bulk_action']]);
    }
    
    public function index(){
        $categories = Category::all();
        return view('backend.pages.category.index',compact('categories'));
    }

    public function add_new_category(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate(
                [
                    'name'=> 'required|unique:categories|max:191',
                    'slug'=> 'unique:categories|max:191',
                ],
                [
                    'name.unique' => __('Category Already Exists.'),
                    'slug.unique' => __('Slug Already Exists.'),
                ]
            );
           $request->slug=='' ? $slug = Str::slug($request->name) : $slug = $request->slug;
            $category = Category::create([
               'name' => $request->name,
               'slug' => $slug,
               'icon' => $request->icon,
               'image' => $request->image,
               'mobile_icon' => $request->mobile_icon,

           ]);

            // category meta data add
            $Metas = [
                'meta_title'=> purify_html($request->meta_title),
                'meta_tags'=> purify_html($request->meta_tags),
                'meta_description'=> purify_html($request->meta_description),

                'facebook_meta_tags'=> purify_html($request->facebook_meta_tags),
                'facebook_meta_description'=> purify_html($request->facebook_meta_description),
                'facebook_meta_image'=> $request->facebook_meta_image,

                'twitter_meta_tags'=> purify_html($request->twitter_meta_tags),
                'twitter_meta_description'=> purify_html($request->twitter_meta_description),
                'twitter_meta_image'=> $request->twitter_meta_image,
            ];
           $category->metaData()->create($Metas);

           return redirect()->back()->with(FlashMsg::item_new('New Category Added'));
        }
        return view('backend.pages.category.add_category');
    }

    public function edit_category(Request $request, $id=null)
    {



        if($request->isMethod('post')){
            $request->validate(
                [
                'name' => 'required|max:191|unique:categories,name,'.$id,
                'slug'=> 'max:191|unique:categories,slug,'.$id,
            ],
            [
                'name.unique' => __('Category Already Exists.'),
                'slug.unique' => __('Slug Already Exists.'),
            ]
            );
            
            $old_slug = Category::select('slug')->where('id',$id)->first();
            $old_image = Category::select('image')->where('id',$id)->first();
            Category::where('id',$id)->update([
                'name'=>$request->name,
                'slug'=>$request->slug ?? $old_slug->slug,
                'icon'=>$request->icon,
                'mobile_icon'=>$request->mobile_icon,
                'image'=>$request->image,
            ]);

            $category_meta_update =  Category::findOrFail($id);
            $Metas = [
                'meta_title'=> purify_html($request->meta_title),
                'meta_tags'=> purify_html($request->meta_tags),
                'meta_description'=> purify_html($request->meta_description),

                'facebook_meta_tags'=> purify_html($request->facebook_meta_tags),
                'facebook_meta_description'=> purify_html($request->facebook_meta_description),
                'facebook_meta_image'=> $request->facebook_meta_image,

                'twitter_meta_tags'=> purify_html($request->twitter_meta_tags),
                'twitter_meta_description'=> purify_html($request->twitter_meta_description),
                'twitter_meta_image'=> $request->twitter_meta_image,
            ];

            DB::beginTransaction();
            try {
                $category_meta_update->metaData()->update($Metas);
                DB::commit();
            }catch (\Throwable $th){
                DB::rollBack();
            }


            return redirect()->back()->with(FlashMsg::item_new('Category Update Success'));
        }
        $category = Category::find($id);
        return view('backend.pages.category.edit_category',compact('category'));
    }

    public function change_status($id){
       $category = Category::select('status')->where('id',$id)->first();
       if($category->status==1){
           $status = 0;
       }else{
        $status = 1;
       }
       Category::where('id',$id)->update(['status'=>$status]);
       return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
    }

    public function delete_category($id){
        Category::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Category Deleted Success'));
    }

    public function bulk_action(Request $request){
        Category::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
