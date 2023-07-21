<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\Category;
use App\BlogComment;
use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{

    public function blog_single($slug)
    {
        $blog_post = Blog::with('category','comments')->where('slug', $slug)->first();
        $tags = Blog::select('tag_name')->where('slug',$slug)->get();
        $related_blog = Blog::where('status','publish')->inRandomOrder()->take(3)->get();

        if(empty($blog_post)){
            abort(404);
        }
        

        return view('frontend.pages.blog.blog-single')->with([
            'blog_post' => $blog_post,
            'tags' => $tags,
            'related_blog' => $related_blog,
        ]);
    }

    //service review add
    public function blog_comment(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'message' => 'required',
        ]);
        
        BlogComment::create([
            'blog_id' => $request->blog_id,
            'user_id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : NULL,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function category_wise_blog_page($cat_slug)
    {
        $category_name = Category::select('id','name','slug')->where(['slug' => $cat_slug])->first();
        if(empty($category_name)){
            abort(404);
        }
        $all_blogs = Blog::where('category_id',$category_name->id)->orderBy('id', 'desc')->paginate(6);
        return view('frontend.pages.blog.blog-category',compact('all_blogs','category_name'));
    }

    public function tags_wise_blog_page($tag_name)
    {
        $ta_g_name = Tag::select('id','name')->where(['name' => $tag_name])->first();
        if(empty($ta_g_name)){
            abort(404);
        }

        $all_blogs = Blog::whereJsonContains('tag_name',$ta_g_name->name)->orderBy('id', 'desc')->paginate(6);
        return view('frontend.pages.blog.blog-tags',compact('all_blogs','ta_g_name'));  
    }

    public function blog_comment_store(Request $request)
    {
        $this->validate($request, [
            'comment_content' => 'required'
        ]);


        $content = BlogComment::create([
            'blog_id' => $request->blog_id,
            'user_id' => $request->user_id,
            'parent_id' => $request->comment_id,
            'commented_by' => $request->commented_by,
            'comment_content' => purify_html($request->comment_content),
        ]);

        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                'subject' => __('You have a comment from') . ' ' . get_static_option('site_title'),
                'message' => __('you have a new comment submitted by') . ' ' . Auth::user()->name . ' ' . __('Email') . ' ' . Auth::user()->email . ' .' . __('check admin panel for more info'),
            ]));

        }catch (\Exception $e){
            return redirect()->back()->with(FlashMsg::error($e->getMessage()));
        }


        return response()->json([
            'msg' => __('Your comment sent succefully'),
            'type' => 'success',
            'status' => 'ok',
            'content' => $content,
        ]);
    }

    public function signin_for_blog_comment(Request $request){
        if($request->ajax()){
            if(empty($request->username || $request->password)){
                return response()->json([
                    'status' => 'error',
                    'msg' => __('Please Enter Username and Password !!'),
                ]);
            }

            if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password,'email_verified'=>1])){
                return response()->json([
                    'status' => 'success'
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'msg' => __('Your Username or Password Is Wrong !!'),
                ]);
            }
        }
    }


}
