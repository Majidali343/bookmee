<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use App\Language;
use App\User;
use App\Order;
use App\Service;
use App\PayoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use DB;

class AdminDashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware('permission:appearance-menubar-settings',['only'=>['menubar_settings','update_menubar_settings']]);
        $this->middleware('permission:appearance-home-variant',['only'=>['home_variant','update_home_variant']]);
    }

    public function adminIndex()
    {
        $total_admin = Admin::count();
        $total_seller = User::where('user_type',0)->count();
        $total_buyer = User::where('user_type',1)->count();
        $total_earning = Order::where('status',2)->sum('commission_amount');
        $pending_order = Order::where('status',0)->count();
        $pending_service = Service::where('status',0)->count();
        $pending_payout_request = PayoutRequest::where('status',0)->count();
        $new_user_today = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at',Carbon::now()->month)
            ->whereDay('created_at',Carbon::now()->day)
            ->count();


        $most_viewed_10_services = Service::select('id','title','price','view')
        ->where(['status'=>1,'is_service_on'=>1])
        ->orderByDesc('view')
        ->take(10)
        ->get();

        $most_sell_10_services = Order::selectRaw('service_id, COUNT(orders.service_id) as total')
            ->with('service')
            ->groupBy('service_id')
            ->orderBy('total','desc')
            ->take(10)
            ->get();


        //get last 12 months data
        $month_list = [];
        $monthly_income_list = [];
        $monthly_order_list = [];



        for($i=12; $i>=1;$i--){
            $month_list[] = Carbon::now()->subMonth($i)->format('M');
            $monthly_income_list[] = Order::where('status',2)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at',Carbon::now()->subMonth($i))
            ->sum('commission_amount');
            $monthly_order_list[] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at',Carbon::now()->subMonth($i))
            ->count();
        }

        // months array shift
        $arr = $month_list;
        $lastvalue = end($arr);
        $lastkey = key($arr);
        $arr1 = array($lastkey=>$lastvalue);
        array_pop($arr);
        $month_list = array_merge($arr1,$arr);

        // monthly order list shift
        $arr = $monthly_order_list;
        $lastvalue = end($arr);
        $lastkey = key($arr);
        $arr1 = array($lastkey=>$lastvalue);
        array_pop($arr);
        $monthly_order_list = array_merge($arr1,$arr);

        //get last 30 days data
        $currentDateTime = Carbon::now()->format("d M");
        $days_list = [];
        $daily_income_list = [];
        $daily_order_list = [];

        for ($i=29; $i >= 0; $i--) { 
            $days_list[] = Carbon::parse($currentDateTime)->subDay($i)->format("d M");
            $daily_income_list[] = Order::where('status',2)
            ->whereDay('created_at',Carbon::now()
            ->subDay($i))
            ->sum('commission_amount');
            $daily_order_list[] = Order::whereYear('created_at', Carbon::now()->year)
            ->whereDay('created_at',Carbon::now()->subDay($i))
            ->count();
        }

        return view('backend.admin-home',compact(
            'total_admin',
            'total_seller',
            'total_buyer',
            'total_earning',
            'pending_order',
            'pending_service',
            'pending_payout_request',
            'new_user_today',
            'most_viewed_10_services',
            'most_sell_10_services',
            'month_list',
            'days_list',
            'daily_income_list',
            'monthly_income_list',
            'monthly_order_list',
            'daily_order_list'
        ));
    }

    public function lang_change_backend(Request $request)
    {
        $data = $request->lang ?? LanguageHelper::default_slug();
        return response()->json($data);
    }

    public function admin_settings(){
        return view('auth.admin.settings');
    }

    public function admin_profile_update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'image' => 'nullable|string',
             'description'=> 'nullable',
            'designation'=> 'nullable'
        ]);

        Admin::find(Auth::user()->id)->update([
            'name'=>$request->name,
            'email' => $request->email ,
            'image' => $request->image ,
            'description' => $request->description ,
            'designation' => $request->designation
        ]);
        return redirect()->back()->with(['msg' => __('Profile Update Success' ), 'type' => 'success']);
    }

    public function admin_password_chagne(Request $request){
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);

        if (Hash::check($request->old_password ,$user->password)){

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg'=> __('Password Changed Successfully'),'type'=> 'success']);
        }

        return redirect()->back()->with(['msg'=> __('Somethings Going Wrong! Please Try Again or Check Your Old Password'),'type'=> 'danger']);
    }

    public function adminLogout(){
        Auth::logout();
        return redirect()->route('admin.login')->with(['msg'=>__('You Logged Out !!'),'type'=> 'danger']);
    }

    public function admin_profile(){
        return view('auth.admin.edit-profile');
    }

    public function admin_password(){
        return view('auth.admin.change-password');
    }

    public function menubar_settings(){
        $all_languages = Language::all();
        return view('backend.pages.menubar-settings')->with(['all_languages' => $all_languages]);;
    }

    public function update_menubar_settings(Request $request){
        $all_languages = Language::all();

        foreach ($all_languages as $lang){
            $this->validate($request, [
                'menubar_button_'.$lang->slug.'_text'=> 'nullable|string',
                'menubar_button_'.$lang->slug.'_url'=> 'nullable|string',
            ]);

            $fields = [
                'menubar_button_'.$lang->slug.'_text',
                'menubar_button_'.$lang->slug.'_url',
            ];
            foreach ($fields as $field){
                if ($request->has($field)){
                    update_static_option($field,$request->$field);
                }
            }
            update_static_option('menubar_button',$request->menubar_button);
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function cache_settings(){
          return view('backend.general-settings.cache-settings');
    }

    public function update_cache_settings(Request $request){

         $this->validate($request,[
            'cache_type' => 'required|string'
        ]);

        Artisan::call($request->cache_type.':clear');

        return redirect()->back()->with(['msg'=> __('Cache Cleaned...') ,'type'=> 'success']);
    }

    public function dark_mode_toggle(Request $request){
        
        $data = get_static_option('site_admin_dark_mode');
        if($request->mode == 'off' || empty($data)){
            update_static_option('site_admin_dark_mode','on');
        }
        if($request->mode == 'on'){
            update_static_option('site_admin_dark_mode','off');
        }

        return response()->json(['status'=>'done']);
    }

}