<?php

namespace Modules\JobPost\Http\Controllers\Frontend;

use App\AdminCommission;
use App\Category;
use App\JobPost;
use App\JobRequestTicket;
use App\Mail\BasicMail;
use App\Notifications\JobApplyNotification;
use App\SellerVerify;
use App\Service;
use App\Subcategory;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Modules\JobPost\Entities\SellerViewJob;

class JobDetailsApplyController extends Controller
{
    public function job_details($slug=null){
        
        $current_date = date('Y-m-d h:i:s');
        $job_details = BuyerJob::with(['job_request','buyer'])->where('slug',$slug)->firstOrFail();
        $same_buyer_jobs = BuyerJob::where('buyer_id',$job_details->buyer_id)
            ->where('is_job_on', 1)
            ->where('dead_line', '>=' ,$current_date)
            ->take(6)->get()
            ->except($job_details->id);
        
        $similar_jobs = BuyerJob::where('is_job_on', 1)->where('dead_line', '>=' ,$current_date)->take(6)->inRandomOrder()->get()->except($job_details->id);

        $job_view = BuyerJob::select('view')->where('id', $job_details->id)->first();
        $view_count = $job_view->view + 1;
        BuyerJob::where('id', $job_details->id)->update([
            'view' => $view_count,
        ]);

        $seller = Auth::guard('web')->user();
        if($seller && $seller->user_type == 0) {
            $seller_job_view_count = SellerViewJob::where('seller_id', $seller->id)->where('job_post_id', $job_details->id)->count();
            if ($seller_job_view_count < 1){
                SellerViewJob::create([
                    'job_post_id' => $job_details->id,
                    'seller_id' => $seller->id,
                ]);
            }
        }

        $is_job_hired = JobRequest::where('job_post_id',$job_details->id)->where('is_hired',1)->count();

        return view('jobpost::frontend.jobs.job-details',compact('job_details','same_buyer_jobs','similar_jobs','is_job_hired'));
    }

    //job apply
    public function job_apply(Request $request){
//        return $request->all();

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 1){
            toastr_warning(__('For create an offer you must register as a seller'));
            return back();
        }

        if($request->isMethod('post')){
            if(Auth::guard('web')->check()){

                //todo: check subscription step:1 commission type check step:2 subscription check step:3 subscription
                // type example(monthly, yearly, liveTime) Step:4 seller total job request count
                //commission type check
                $commission = AdminCommission::first();
                if($commission->system_type == 'subscription'){
                    if(subscriptionModuleExistsAndEnable('Subscription')){
                        $seller_subscription = \Modules\Subscription\Entities\SellerSubscription::where('id', Auth::guard('web')->user()->id)->first();
                        // Seller Service count
                        $seller_job_request_count = JobRequest::where('seller_id', Auth::guard('web')->user()->id)->count();
                        if ($seller_subscription->type === 'monthly'){
                            // check seller connect,service,expire date
                            if ($seller_subscription->connect == 0){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }elseif ($seller_subscription->initial_job <= $seller_job_request_count){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }elseif ($seller_subscription->expire_date > Carbon::now()){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }
                        }elseif ($seller_subscription->type === 'yearly'){
                            // check seller connect,service,expire date
                            if ($seller_subscription->connect == 0){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }elseif ($seller_subscription->initial_job <= $seller_job_request_count){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }elseif ($seller_subscription->expire_date > Carbon::now()){
                                toastr_error(__('Your Subscription is expired'));
                                return redirect()->back();
                            }
                        }
                    }
                }

                if($request->expected_salary == '' || $request->cover_letter == ''){
                    toastr_warning(__('Please enter your budget and description'));
                    return back();
                }
                if($request->expected_salary < 1){
                    toastr_warning(__('Your budget can not be lesss than 1'));
                    return back();
                }
                if($request->expected_salary > $request->job_price){
                    toastr_warning(__('Your budget must less than the original price'));
                    return back();
                }
                $request->validate([
                    'cover_letter'=>'required',
                ]);
                $seller_request_count = JobRequest::select('seller_id')
                    ->where('seller_id',Auth::guard('web')->user()->id)
                    ->where('job_post_id',$request->job_post_id)
                    ->count();
                if($seller_request_count >=1){
                    toastr_warning(__('You have already applied for this job.'));
                    return redirect()->back();
                }
                JobRequest::create([
                    'seller_id'=> Auth::guard('web')->user()->id,
                    'buyer_id'=> $request->buyer_id,
                    'job_post_id'=> $request->job_post_id,
                    'expected_salary'=> $request->expected_salary,
                    'cover_letter'=> $request->cover_letter,
                ]);
                try {
                    $message = get_static_option('job_apply_message') ?? '';
                    $message = str_replace(["@job_post_id"],[$request->job_post_id],$message);
                    Mail::to($request->buyer_email)->send(new BasicMail([
                        'subject' => get_static_option('job_apply_subject') ?? __('New Application Created'),
                        'message' => $message
                    ]));
                } catch (\Exception $e) {
                    return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
                }
                if(subscriptionModuleExistsAndEnable('Subscription')){
                    \Modules\Subscription\Entities\SellerSubscription::where('seller_id', Auth::guard('web')->user()->id)->update([
                        'connect' => DB::raw(sprintf("connect - %s",(int)strip_tags(get_static_option('set_number_of_connect')))),
                    ]);
                }
                toastr_success(__('You have successfully applied for this job.'));
                return redirect()->back();
            }
            toastr_error(__('You must login to apply for a job.'));
            return back();
        }
    }

    //category wise services
    public function category_jobs($slug = null)
    {
        $category = Category::select('id','name')->where('slug',$slug)->firstOrFail();
        $sub_category = Subcategory::select('id','name')->where('slug',$slug)->first();
        $all_jobs = collect([]);
        if(!is_null($category)){
            $all_jobs = BuyerJob::where(['category_id' => $category->id, 'status' => 1, 'is_job_on' => 1])
                ->paginate(9);
        }

        if(!is_null($sub_category)){
            $all_jobs = BuyerJob::where(['subcategory_id' => $sub_category->id, 'status' => 1, 'is_job_on' => 1])
                ->paginate(9);
        }
        return view('jobpost::frontend.jobs.category-jobs', compact(
            'all_jobs',
            'category',
            'sub_category'
        ));
    }

}
