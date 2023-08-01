<?php

namespace App\Http\Controllers\Auth;

use App\Accountdeactive;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Str;
use Twilio\Rest\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/';
    public function redirectTo()
    {
        return route('homepage');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Override username functions
     * @since 1.0.0
     * */
    public function username()
    {
        return 'username';
    }

    /**
     * show admin login page
     * @since 1.0.0
     * */
    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    /**
     * admin login system
     * */
    public function adminLogin(Request $request)
    {
        $email_or_username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'username.required' => sprintf(__('%s required'), $email_or_username),
            'password.required' => __('password required'),
        ]);

        if (Auth::guard('admin')->attempt([$email_or_username => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return response()->json([
                'msg' => __('Login Success Redirecting'),
                'type' => 'success',
                'status' => 'ok',
            ]);
        }
        return response()->json([
            'msg' => sprintf(__('Your %s or Password Is Wrong !!'), $email_or_username),
            'type' => 'danger',
            'status' => 'not_ok',
        ]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function userLogin(Request $request)
    {
        $redirectUrl =  session()->get('ref');
   

        if (Auth::check()) {
            return redirect('/');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'phone' => 'required|max:191 ',
                'otp' => 'required|max:4s',
            ]);
            $timeNow = Carbon::now();
            $user = User::where('phone', $request->phone)->where('otp', $request->otp)->first();

            if (empty($user)) {
                session()->flash('msg', 'You have entered a wrong otp');
                session()->flash('type', 'danger');
                return view('frontend.user.login-otp-verify')->with(['phone' => $request->phone]);
            }
            if ($user->otp_expire_at->lte($timeNow)) {
                $this->sendOtpHelper($request->phone);
                session()->flash('msg', 'otp has been expired, we have send a new one');
                session()->flash('type', 'danger');
                return view('frontend.user.login-otp-verify')->with(['phone' => $request->phone]);
            }
            Auth::login($user, true);
            // check account delete status
            $user = Accountdeactive::select(['user_id', 'status'])
                ->where('user_id', Auth::guard('web')->user()->id)
                ->where('status', 1)
                ->first();

            User::where('phone', $request->phone)->where('otp', $request->otp)->first()->update([
                'otp_expire_at' => Carbon::now(),
            ]);
            if (!empty($user)) {
                if ($user->status === 1) {
                    session()->flash('msg', 'Your account has been deleted');
                    session()->flash('type', 'danger');
                    return view('frontend.user.login-otp-verify')->with(['phone' => $request->phone]);
                }
            } else {
                if($redirectUrl != null){
                    return redirect($redirectUrl);
                }else if ( User::where('phone', $request->phone)->first()->user_type == 0) {
                    return redirect()->route('seller.dashboard');
                } else {
                    return redirect()->route('buyer.dashboard');
                }
                return redirect('/');
            }
        }
        return view('frontend.user.login-otp-verify')->with([
            'phone' => $request->phone,
        ]);
    }

    public function userLoginOnline(Request $request)
    {
        $email_or_username = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ],
            [
                'username.required' => sprintf(__('%s required'), $email_or_username),
                'password.required' => __('password required'),
            ]);

        if (Auth::guard('web')->attempt([$email_or_username => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->back();

        }
        return redirect()->back();
    }

    public function userForgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
            ], [
                'email.required' => __('Email is required'),
            ]);

            $email = User::select('email')->where('email', $request->email)->count();
            if ($email >= 1) {
                $password = Str::random(6);
                $new_password = Hash::make($password);
                User::where('email', $request->email)->update(['password' => $new_password]);
                try {
                    $message_body = __('Here is your new password') . ' <span class="verify-code">' . $password . '</span>';
                    Mail::to($request->email)->send(new BasicMail([
                        'subject' => __('Your new password send'),
                        'message' => $message_body,
                    ]));
                } catch (\Exception $e) {

                }

                return redirect()->back()->with(['msg' => __('Password generate success.Check email for new password'), 'type' => 'success']);
            }
            return redirect()->back()->with(Session::flash('msg', __('Email does not exists')));
        }
        return view('frontend.user.forget-password-form');
    }

    public function sendOtp(Request $request)
    {
 
        if (Auth::check()) {
            return redirect('/');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'phone' => 'required|max:191',
            ]);

            $countryCode = '+44';
        $phoneNumber = $request->phone;
       

        $fullNumber = $countryCode . $phoneNumber;

            if ($user = User::where('phone',  $fullNumber)->first() == null) {
                return back()->with([
                    'msg' => __('User Not Found'),
                    'type' => 'danger',
                ]);
            } else {
                $this->sendOtpHelper($fullNumber);
                session()->flash('msg', 'Check your device OTP has been sent!!!');
                session()->flash('type', 'success');
                return view('frontend.user.login-otp-verify')->with([
                    'msg' => __('Otp has been send'),
                    'type' => 'success',
                    'phone' => $fullNumber,
                ]);
            }
        }
        return view('frontend.user.login');
    }
    public function genRandomOtp($n)
    {
        $result = '';
        $generator = "1357902468";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, rand() % strlen($generator), 1);
        }

        return $result;
    }
    public function sendOtpHelper($number)
    {
        $user = User::where('phone', $number)->first();
        $otp = $this->genRandomOtp(4);
        $otp_expire_date = Carbon::now()->addMinute(10);
        $user->update([
            'otp' => $otp,
            'otp_expire_at' => $otp_expire_date,
        ]);
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_MESSAGING_ID");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($number, [
                'from' =>  $twilio_number,
                'body' => "Your BookMi otp is " . $otp]);
        } catch (\Exception $e) {

        }
    }
}
