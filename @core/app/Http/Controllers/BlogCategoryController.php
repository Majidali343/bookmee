<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use App\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public $languages = null;
    public function __construct()
    {
        if ($this->languages === null){
            $this->languages =  $all_languages = Language::all();
        }
        //Blog Category
        $this->middleware('permission:blog-category-list|blog-category-create|blog-category-edit|blog-category-delete',['only' => ['index']]);
        $this->middleware('permission:blog-category-create',['only' => ['new_category']]);
        $this->middleware('permission:blog-category-edit',['only' => ['update_category']]);
        $this->middleware('permission:blog-category-delete',['only' => ['delete_category','bulk_action','delete_category_all_lang']]);
    }

    public function index(Request $request){
        $all_category = BlogCategory::select(['id','title','status','image'])->get();
        return view('backend.pages.blog.category')->with([
            'all_category' => $all_category,
            'default_lang' => $request->lang ?? LanguageHelper::default_slug(),
        ]);
    }

    public function new_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:blog_categories',
            'status' => 'required|string|max:191',
            'image' => 'nullable|string',
        ]);

        $category = new BlogCategory();
        $category
            ->setTranslation('title',$request->lang, purify_html($request->title));
            $category->status = $request->status;
            $category->image = $request->image;
            $category->save();
             return redirect()->back()->with(FlashMsg::item_new('Blog Category Added'));
    }

    public function update_category(Request $request){
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:blog_categories',
            'status' => 'required|string|max:191',
            'image' => 'nullable|string',
        ]);

        $category =  BlogCategory::findOrFail($request->id);
        $category
            ->setTranslation('title',$request->lang, purify_html($request->title));
            $category->status = $request->status;
            $category->image = $request->image;
            $category->save();

        return back()->with(FlashMsg::item_update());
    }


    public function delete_category_all_lang(Request $request,$id){

        if (Blog::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You can not delete this category, It already associated with a post...'),
                'type' => 'danger'
            ]);
        }
        $category =  BlogCategory::where('id',$id)->first();
        $category->delete();

        return back()->with(FlashMsg::item_delete());
    }


    public function bulk_action(Request $request){
        BlogCategory::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

}
