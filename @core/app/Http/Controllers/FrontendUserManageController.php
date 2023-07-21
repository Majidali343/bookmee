<?php

namespace App\Http\Controllers;

use App\Country;
use App\Helpers\DataTableHelpers\General;
use App\ServiceArea;
use App\ServiceCity;
use App\User;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMail;
use App\Mail\SingleMailToUser;
use App\Accountdeactive;
use App\MediaUpload;
use App\Service;
use App\SupportTicket;
use App\SupportTicketMessage;
use App\Serviceinclude;
use App\PayoutRequest;
use App\ToDoList;
use App\Review;
use App\Order;
use App\Serviceadditional;
use App\Servicebenifit;
use App\Day;
use App\Schedule;
use App\ExtraService;
use App\EditServiceHistory;
use App\OnlineServiceFaq;
use App\ServiceCoupon;
use App\SellerVerify;
use App\OrderAdditional;
use App\Report;
use App\ReportChatMessage;
use App\OrderCompleteDecline;
use App\Actions\Media\MediaHelper;
use Modules\Subscription\Entities\SubscriptionHistory;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Modules\JobPost\Entities\JobRequestConversation;
use Modules\Wallet\Entities\Wallet;
use Modules\Wallet\Entities\WalletHistory;
use Modules\LiveChat\Entities\LiveChatMessage;
use function GuzzleHttp\Promise\all;

class FrontendUserManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete',['only' => 'all_user']);
        $this->middleware('permission:user-delete',['only' => ['bulk_action','new_user_delete']]);
    }

    public function all_user(Request $request)
    {

        if ($request->ajax()){
            $data = User::with('sellerVerify')->take(10);

            return \DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('checkbox',function ($row){
                    return General::bulkCheckbox($row->id);
                })
                ->addColumn('id',function ($row) {
                    return $row->id;
                })
                ->addColumn('name',function ($row){
                        $user_type = $row->user_type==0 ? __("Seller") : __("Buyer");
                        return $row->name." "."<".$row->username.">"."(".$user_type.")";
                })
                ->addColumn('user_status',function ($row) {
                    $url = route('admin.frontend.user.status',$row->id);
                    $user_status = $row->user_status==0 ? '<span class="text-warning">'. __('Inactive') .'</span>' : '<span class="text-info">'. __('Active') .'</span>';
                    $markup = $user_status.General::statusChange($url);
                    return $markup;
                })
                ->addColumn('user_verify',function ($row) {
                    $url = route('admin.frontend.seller.profile.view',$row->id);
                    $user_status = optional($row->sellerVerify)->status==1 ? '<span class="text-warning">'. __('Verified') .'</span>' : '<span class="text-info">'. __('Not Verified') .'</span>';
                    $markup = $user_status.'<a class="btn btn-info" href="'.$url.'"><i class="ti-eye"></i></a>';
                    return $markup;

                })
                ->addColumn('email_verify',function ($row) {
                    $url = route('admin.frontend.user.email.verify.code',$row->id);
                    if ($row->email_verified == 1){
                        $markup =  $row->email;
                    }else{
                        // email verified
                        $verified_url = route('admin.frontend.seller.email.verify',$row->id);
                        if ($row->email_verified == 0 ){
                            $seller_email_verify = General::statusChange($verified_url);
                        }
                        $user_status = $row->email_verified == 1 ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>';
                        $markup =  $row->email." ".$user_status.'<a class="btn btn-primary btn-sm mb-3 mr-1 subcategory_edit_btn d-block" href="'.$url.'">'.__('Send Code ').'</a>'. $seller_email_verify;
                    }
                    return $markup;
                })
                ->addColumn('action', function($row){
                    $action = '';
                    $testimonial_img = get_attachment_image_by_id($row->image,null,true);
                    $img_url = $testimonial_img['img_url'];
                    $action .= ' <a href="#"
                                   data-toggle="modal"
                                   data-target="#edit_user_info_modal"
                                   class="btn btn-info btn-sm mb-3 mr-1 edit_user_info_btn"
                                   data-id="'.$row->id.'"
                                   data-email="'.$row->email.'"
                                   data-username="'.$row->username.'"
                                   data-name="'.$row->name.'"
                                   data-phone="'.$row->phone.'"
                                   data-country="'.$row->country_id.'"
                                   data-city="'.$row->service_city.'"
                                   data-area="'.$row->service_area.'"
                                   data-address="'.$row->address.'"
                                   data-imageid="'.$row->image.'"
                                   data-image="'.$img_url.'"
                                >
                                    <i class="ti-user"></i>
                                </a>';
                    $action .= '<a href="#"
                                   data-toggle="modal"
                                   data-target="#change_password_modal"
                                   class="btn btn-warning btn-sm mb-3 mr-1 change_password_modal_btn"
                                   data-id="'.$row->id.'"
                                   data-email="'.$row->email.'">
                                    <i class="ti-key"></i>
                                </a>';
                    $admin = auth()->guard('admin')->user();
                    if ($admin->can('user-delete')){
                        $action .= General::deletePopover(route('admin.frontend.user.delete',$row->id));
                    }
                    if ($admin->can('email-verify-code')){
                        $action .= '<a href="#"
                                        data-toggle="modal"
                                        data-target="#send_mail_modal"
                                        class="btn btn-primary btn-xs mb-3 mr-1 send_mail_modal_btn"
                                        data-id="'.$row->id.'"
                                        data-email="'.$row->email.'"
                                    >
                                        '.__('Send Email').'
                                    </a>';
                    }

                    return $action;
                })
                ->rawColumns(['checkbox','action','user_status','user_verify','email_verify'])
                ->make(true);
        }
        $countries = Country::all();
        return view('backend.frontend-user.all-user',compact('countries'));
    }

    public function sellerAll()
    {
        $all_user = User::with('sellerVerify')
            ->where('user_type',0)
            ->get();
        return view('backend.pages.seller-verify.verify')->with(['all_user' => $all_user]);
    }

    public function userStatus($id=null)
    {   
        $user_status = User::select('user_status')->find($id);
        User::where('id', $id)->update([
            'user_status' => $user_status->user_status== 0 ? 1 : 0
        ]);

        $user_status_2 = User::select('user_status')->find($id);
        if($user_status_2->user_status == 0){
            Service::where('seller_id',$id)
            ->update(['status'=>0]);
        }
        if($user_status_2->user_status == 1){
            Service::where('seller_id',$id)
            ->update(['status'=>1]);
        }
        return redirect()->back()->with(FlashMsg::item_new('Status change success--'));
    }

   //seller profile view
    public function sellerProfileView($id=null){
        $seller_details = User::with('sellerVerify')->where('id',$id)->first();
        return view('backend.frontend-user.seller-details',compact('seller_details'));
    }

    //seller verify
    public function sellerVerify($id)
    {

        $seller_status = SellerVerify::select('id','seller_id','status')->where('seller_id',$id)->firstOrCreate([
            'seller_id' => $id
        ]);
       $verify_seller = SellerVerify::where('seller_id', $id)->update([
            'status' => $seller_status->status === 0 ? 1 : 0
        ]);

       if($verify_seller){
           $seller = User::select('id','email','name')->where('id',$id)->first();
           try {
               $message = get_static_option('admin_seller_verification_message') ?? '';
               $message = str_replace(["@name"],[$seller->name],$message);
               Mail::to($seller ->email)->send(new BasicMail([
                   'subject' => get_static_option('admin_seller_verification_subject') ?? __('Seller Verification Success'),
                   'message' => $message
               ]));
           } catch (\Exception $e) {
               return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
           }
       }

        return redirect()->back()->with(FlashMsg::item_new('Status change success--'));
    }

    public function userDelete($id=null)
    {

        $user_info = User::find($id);
        //delete user related data
        $user_column = $user_info->user_type === 0 ? "seller_id" : "buyer_id";
        //check user type
        if($user_info->user_type === 0){
            //delete seller related data
            //delete user service
            $services = Service::where("seller_id",$user_info->id)->delete();
            //delete payout history
            PayoutRequest::where("seller_id",$user_info->id)->delete();
            
            //delete subscription
            if(moduleExists("Subscription")){
                SubscriptionHistory::where('seller_id',$user_info->id)->delete();
            }
            
            //schedule
            Schedule::where("seller_id",$user_info->id)->delete();
            SellerVerify::where("seller_id",$user_info->id)->delete();
            Servicebenifit::where("seller_id",$user_info->id)->delete();
            Serviceadditional::where("seller_id",$user_info->id)->delete();
            Serviceinclude::where("seller_id",$user_info->id)->delete();
            ServiceCoupon::where("seller_id",$user_info->id)->delete();
            OnlineServiceFaq::where("seller_id",$user_info->id)->delete();
            EditServiceHistory::where("seller_id",$user_info->id)->delete();
            Day::where("seller_id",$user_info->id)->delete();
        
        
        }else{
            //delete buyer related data
            if(moduleExists("JobPost")){
                $jobs = BuyerJob::where('buyer_id',$user_info->id)->get();
                foreach($jobs as $job){
                    JobRequest::where('job_post_id',$job->id)->delete();
                    $job->delete();
                }
            }
            //delete jobs
        }
        
        
        
        $media_uploads = MediaUpload::where(["user_id" => $user_info->id,"type" => "web"])->get();
        foreach($media_uploads as $media){
            //delete media uploader records 
            MediaHelper::delete_user_media_image($media->id);
            $media->delete();
        }
        
        
        //report
        Accountdeactive::where("user_id",$user_info->id)->delete();

        
        // Wallet
         if(moduleExists("Wallet")){
                $wallet = Wallet::where('buyer_id',$user_info->id)->delete();
                WalletHistory::where('buyer_id',$user_info->id)->delete();
            }
        
        //delete order
        $orders = Order::where($user_column,$user_info->id)->get();
        foreach($orders as $order){
            OrderAdditional::where("order_id",$order->id)->delete();
            OrderCompleteDecline::where("order_id",$order->id)->delete();
            ExtraService::where("order_id",$order->id)->delete();
            $reports = Report::where($user_column,$user_info->id)->get();
            foreach($reports as $report){
                ReportChatMessage::where("report_id",$order->id)->delete();
                $report->delete();
            }
            $order->delete();
        }
        
        //review 
        Review::where($user_column,$user_info->id)->delete();
        ToDoList::where("user_id",$user_info->id)->delete();
       
        
       //delete support ticket
        $support_tickets =  SupportTicket::where($user_column,$user_info->id)->get();
        foreach($support_tickets as $ticket){
             //delete support ticket messages
            SupportTicketMessage::where("support_ticket_id",$ticket->id)->delete();
            $ticket->delete();
        }

        //delete live chat records
        //LiveChat
         if(moduleExists("LiveChat")){
            $wallet = LiveChatMessage::where($user_column,$user_info->id)->delete();
        }
        
        
        $user_info->delete();
        return redirect()->back()->with(FlashMsg::item_new('User delete success--'));
    }

    public function bulk_action(Request $request)
    {
        $all = User::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function email_verify_code($id=null){
       $user_details =  User::find($id);
       try {
            $message = get_static_option('admin_user_verification_code_message') ?? '';
            $message = str_replace(["@name","@verification_code"],[$user_details->name,$user_details->email_verify_token],$message);
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => get_static_option('admin_user_verification_code_subject') ?? __('Verification Code Send Success'),
                'message' => $message
            ]));
        }catch (\Exception $e){
             return redirect()->back()->with(FlashMsg::item_new( $e->getMessage()));
        }
       return redirect()->back()->with(FlashMsg::item_new(__('Verification Code Send Success')));
    }

    public function seller_email_verify_status($id=null){

        $user_details = User::select('id','email','email_verified')->where('id',$id)->first();

        User::where('id', $id)->update([
            'email_verified' => $user_details->user_status== Null ? 1 : 0
        ]);

       try {
            $message = __('Email Verified Success');
            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => __('Email Verified'),
                'message' => $message
            ]));
        }catch (\Exception $e){
             return redirect()->back()->with(FlashMsg::item_new( $e->getMessage()));
        }
       return redirect()->back()->with(FlashMsg::item_new(__('Email Verified Success')));
    }

    public function send_mail_to_single_user(Request $request){

        $this->validate($request,[
           'email' => 'required|email',
           'subject' => 'required',
           'message' => 'required',
        ]);

        try {
            Mail::to($request->email)->send(new BasicMail([
                'subject' => $request->subject,
                'message' => $request->message,
            ]));

        }catch (\Exception $ex){
            return redirect()->back()->with(FlashMsg::item_delete($ex->getMessage()));
        }

        return redirect()->back()->with([
            'msg' => __('Mail Send Success...'),
            'type' => 'success'
        ]);
    }
    
     public function deactive_user()
    {
        $all_user = Accountdeactive::all();
        return view('backend.frontend-user.all-deactive-user')->with(['all_user' => $all_user]);
    }

    public function getCity(Request $request)
    {
        $cities = ServiceCity::where('country_id', $request->country_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'cities' => $cities,
        ]);
    }

    public function getAarea(Request $request)
    {
        $areas = ServiceArea::where('service_city_id', $request->city_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'areas' => $areas,
        ]);
    }

    public function updateUserInfo (Request $request)
    {
        $old_image = User::select('image')->where('email',$request->edit_email)->first();
        User::where('email', $request->edit_email)
            ->update([
                'name' => $request->edit_name,
                'phone' => $request->edit_phone,
                'country_id' => $request->edit_country,
                'service_city' => $request->edit_city,
                'service_area' => $request->edit_area,
                'address' => $request->edit_address,
                'image' => $request->edit_image ?? $old_image->image,
            ]);
        return redirect()->back()->with(FlashMsg::item_new(__('User info update success')));
    }

    public function changeUserPassword(Request $request){
        $request->validate([
            'user_new_password_email' => 'required|email',
            'user_new_password' => 'required',
        ]);

        User::where('email',$request->user_new_password_email)->update(['password' => Hash::make($request->user_new_password)]);
        try {
            $message = get_static_option('admin_user_new_password_message') ?? '';
            $message = str_replace(["@new_password"],[$request->user_new_password],$message);
            Mail::to($request ->user_new_password_email)->send(new BasicMail([
                'subject' => get_static_option('admin_user_new_password_subject') ?? __('Password Change Success'),
                'message' => $message
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
        }

        return redirect()->back()->with([
            'msg' => __('Mail Send Success...'),
            'type' => 'success'
        ]);
    }

}
