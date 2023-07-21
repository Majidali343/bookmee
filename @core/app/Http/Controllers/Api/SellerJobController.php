<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Modules\JobPost\Entities\JobRequestConversation;

class SellerJobController extends Controller
{
    public function request_list()
    {
        $buyer_id = auth('sanctum')->user()->id;
        $all_job_requests = JobRequest::with('job')
            ->where('seller_id',$buyer_id)
            ->latest()
            ->paginate(10)->withQueryString();
        return response()->success([
            'all_job_requests'=>$all_job_requests,
        ]);
    }

    public function new_jobs()
    {
        $jobs = BuyerJob::whereDoesntHave('sellerViewJobs', function ($list){
            $list->where('seller_id',auth('sanctum')->user()->id);
        })->latest()->paginate(10)->withQueryString();

        $image_url=[''];
        foreach($jobs as $job){
            $image_url[]= get_attachment_image_by_id($job->image);
        }

        return response()->success([
            'jobs'=>$jobs,
            'image_url'=>$image_url,
        ]);
    }

    public function conversation(Request $request,$id)
    {
        $seller_id = auth('sanctum')->user()->id;
        $request_details = JobRequest::with('job')
            ->where('seller_id',$seller_id)
            ->where('id',$id)
            ->first();
        $all_messages = JobRequestConversation::where(['job_request_id'=>$id])->get();
        $q = $request->q ?? '';
        return response()->success([
            'request_details'=>$request_details,
            'all_messages'=>$all_messages,
            'q'=>$q,
        ]);
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'job_request_id' => 'required',
            'user_type' => 'required|string|max:191',
            'message' => 'required',
            'send_notify_mail' => 'nullable|string',
            'file' => 'nullable|mimes:zip',
        ]);

        $request_info = JobRequestConversation::create([
            'job_request_id' => $request->job_request_id,
            'type' => $request->user_type,
            'message' => $request->message,
            'notify' => $request->send_notify_mail ? 'on' : 'off',
        ]);

        if ($request->hasFile('file')){
            $uploaded_file = $request->file;
            $file_extension = $uploaded_file->getClientOriginalExtension();
            $file_name =  pathinfo($uploaded_file->getClientOriginalName(),PATHINFO_FILENAME).time().'.'.$file_extension;
            $uploaded_file->move('assets/uploads/job-request',$file_name);
            $request_info->attachment = $file_name;
            $request_info->save();
        }
        return response()->success([
            'msg'=>'Message Send Success',
        ]);
    }

    //job apply
    public function job_apply(Request $request){
        $seller_id = auth('sanctum')->user()->id;
        $user_type = auth('sanctum')->user()->user_type;

        if(Auth::guard('sanctum')->check() && $user_type === 1){
            return response()->error([
                'msg'=>'For create an offer you must register as a seller',
            ]);
        }

        if($request->isMethod('post')){
            if(Auth::guard('sanctum')->check()){
                $request->validate([
                    'seller_id'=> 'required',
                    'buyer_id'=> 'required',
                    'job_post_id'=> 'required',
                    'expected_salary'=> 'required',
                    'cover_letter'=> 'required',
                ]);
                if($request->expected_salary == '' || $request->cover_letter == ''){
                    return response()->error([
                        'msg'=>'Please enter your budget and description',
                    ]);
                }
                if($request->expected_salary > $request->job_price){
                    return response()->error([
                        'msg'=>'Your budget must less than the original price',
                    ]);
                }
                $request->validate([
                    'cover_letter'=>'required',
                ]);
                $seller_request_count = JobRequest::select('seller_id')
                    ->where('seller_id',$seller_id)
                    ->where('job_post_id',$request->job_post_id)
                    ->count();
                if($seller_request_count >=1){
                    return response()->error([
                        'msg'=>'You have already applied for this job.',
                    ]);
                }
                JobRequest::create([
                    'seller_id'=> $seller_id,
                    'buyer_id'=> $request->buyer_id,
                    'job_post_id'=> $request->job_post_id,
                    'expected_salary'=> $request->expected_salary,
                    'cover_letter'=> $request->cover_letter,
                ]);
                try {
                    $message_body = __('New application is created for your job').'. '.'<span class="verify-code">'.__('Your job id is').' #'.$request->job_post_id.'</span>';
                    Mail::to($request->buyer_email)->send(new BasicMail([
                        'subject' => __('New Application Created'),
                        'message' => $message_body
                    ]));
                } catch (\Exception $e) {
                    return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
                }
                return response()->success([
                    'msg'=>'You have successfully applied for this job.',
                ]);
            }
            return response()->error([
                'msg'=>'You must login to apply for a job.',
            ]);
        }
    }
}
