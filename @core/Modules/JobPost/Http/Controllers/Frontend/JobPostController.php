<?php

namespace Modules\JobPost\Http\Controllers\Frontend;

use App\Category;
use App\ChildCategory;
use App\Country;
use App\ServiceCity;
use App\Subcategory;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Str;

class JobPostController extends Controller
{
    public function all_jobs()
    {
        $jobs = BuyerJob::where('buyer_id',Auth::guard('web')->user()->id)->orderByDesc('id')->paginate(10);
        return view('jobpost::frontend.buyer.all-jobs',compact('jobs'));
    }

    //get sub category while change category
    public function sub_category(Request $request)
    {
        $sub_categories = Subcategory::where('category_id', $request->category_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'sub_categories' => $sub_categories,
        ]);
    }

    //get child category while change sub category
    public function child_category(Request $request)
    {
        $child_categories = ChildCategory::where('sub_category_id', $request->sub_cat_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'child_category' => $child_categories,
        ]);
    }

    //get city while change country
    public function city(Request $request)
    {
        $cities = ServiceCity::where('country_id', $request->country_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'cities' => $cities,
        ]);
    }

    //add new job post
    public function add_job(Request $request)
    {
        if($request->isMethod('post')){
            if($request->is_job_online == 1){
                $request->validate([
                    'category' => 'required',
                    'subcategory' => 'required',
                    'title' => 'required|max:191|unique:buyer_jobs',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'dead_line' => 'required',
                    'image' => 'required'
                ]);
                $country_id = 0;
                $city_id = 0;
            }else{
                $request->validate([
                    'category' => 'required',
                    'subcategory' => 'required',
                    'country_id' => 'required',
                    'city_id' => 'required',
                    'title' => 'required|max:191|unique:buyer_jobs',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'dead_line' => 'required',
                ]);
                $country_id = $request->country_id;
                $city_id = $request->city_id;
            }
            BuyerJob::create([
                'category_id'=>$request->category,
                'subcategory_id'=>$request->subcategory,
                'child_category_id'=>$request->child_category,
                'buyer_id'=>Auth::guard('web')->user()->id,
                'country_id'=>$country_id,
                'city_id'=>$city_id,
                'title'=>$request->title,
                'slug'=>$request->slug ?? Str::slug($request->title),
                'description'=>$request->description,
                'image'=>$request->image,
                'is_job_online'=>$request->is_job_online,
                'price'=>$request->price,
                'dead_line'=>$request->dead_line,
            ]);
            toastr_success(__('Job Post Added Success'));
            return redirect()->route('buyer.all.jobs');
        }
        $categories = Category::where('status',1)->get();
        $countries = Country::where('status',1)->whereHas('cities')->get();
        return view('jobpost::frontend.buyer.add-job',compact('categories','countries'));
    }

    //edit job post
    public function edit_job(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            if($request->is_job_online == 1){
                $request->validate([
                    'category' => 'required',
                    'subcategory' => 'required',
                    'title' => 'required|max:191|unique:buyer_jobs,title,'.$id,
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'dead_line' => 'required',
                ]);
                $country_id = 0;
                $city_id = 0;
            }else{
                $request->validate([
                    'category' => 'required',
                    'subcategory' => 'required',
                    'country_id' => 'required',
                    'city_id' => 'required',
                    'title' => 'required|max:191|unique:buyer_jobs,title,'.$id,
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'dead_line' => 'required',
                ]);
                $country_id = $request->country_id;
                $city_id = $request->city_id;
            }
            BuyerJob::where('id',$id)->update([
                'category_id'=>$request->category,
                'subcategory_id'=>$request->subcategory,
                'child_category_id'=>$request->child_category,
                'buyer_id'=>Auth::guard('web')->user()->id,
                'country_id'=>$country_id,
                'city_id'=>$city_id,
                'title'=>$request->title,
                'slug'=>$request->slug ?? Str::slug($request->title),
                'description'=>$request->description,
                'image'=>$request->image,
                'is_job_online'=>$request->is_job_online,
                'price'=>$request->price,
                'dead_line'=>$request->dead_line,
            ]);
            toastr_success(__('Job Post Updated Success'));
            return redirect()->route('buyer.all.jobs');
        }
        $job = BuyerJob::find($id);
        $categories = Category::where('status',1)->get();
        $countries = Country::where('status',1)->whereHas('cities')->get();
        return view('jobpost::frontend.buyer.edit-job',compact('categories','countries','job'));
    }

    //Job post on off
    public function job_on_off(Request $request)
    {
        $is_job_on = BuyerJob::select('is_job_on')->where('id', $request->job_post_id)->first();
        $is_job_on->is_job_on === 1 ? $is_job_on = 0 : $is_job_on = 1;
        BuyerJob::where('id', $request->job_post_id)->update(['is_job_on' => $is_job_on]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    //job delete
    public function job_delete($id = null)
    {
        JobRequest::where('job_post_id',$id)->delete();
        BuyerJob::find($id)->delete();
        toastr_error(__('Job Post Delete Success'));
        return back();
    }
}
