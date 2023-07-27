<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\SellerVerify;
use App\ServiceCity;
use App\SmsVerification;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Str;
use Twilio\Rest\Client;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = '/';
    public function redirectTo()
    {
        return route('homepage');
    }
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'captcha_token' => ['nullable'],
            'username' => ['required', 'string', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'captcha_token.required' => __('google captcha is required'),
            'name.required' => __('name is required'),
            'name.max' => __('name is must be between 191 character'),
            'username.required' => __('username is required'),
            'username.max' => __('username is must be between 191 character'),
            'username.unique' => __('username is already taken'),
            'email.unique' => __('email is already taken'),
            'email.required' => __('email is required'),
            'password.required' => __('password is required'),
            'password.confirmed' => __('both password does not matched'),
        ]);
    }
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:admins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['user_name'],
            'phone' => $data['phone'],
            'service_city' => $data['service_city'],
            'service_area' => $data['service_area'],
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }

    public function sendOptOnRegister(Request $request)
    {
        
        if (Auth::check()) {
            return redirect('/');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'contact_number' => 'required|max:191',
            ]);

        
            $isExists = SmsVerification::where("contact_number", $request->contact_number)->first();
            $otp = $this->genRandomOtp(4);
            if (!empty($isExists) && SmsVerification::where("contact_number", $request->contact_number)->get()->where("status", "pending")->first() == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => "User Already Exists Please Login",
                ]);
            }
            if ($isExists == null) {
                $user = SmsVerification::create([
                    'contact_number' => $request->contact_number,
                    'code' => $otp,
                ]);
            } else {
                $isExists->update([
                    'code' => $otp,
                ]);
            }
            try {
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_MESSAGING_ID");
                $client = new Client($account_sid, $auth_token);
                $client->messages->create('whatsapp:'.$request->contact_number, [
                    'from' => 'whatsapp:'. $twilio_number,
                    'body' => "Your BookMi otp is " . $otp]);
                    
            } catch (\Exception $e) {
                dd($e);
                // return response()->json([
                //     'message' => __('We are Have problem while sending otp, please contact admin'),
                //     'status' => 'error',
                // ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => "OTP has been sent! Check your device.",
            ]);
        }

        return view('frontend.user.register', compact('cities', 'countries'));
    }
    public function verifyOptOnRegister(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'contact_number' => 'required|max:191',
                'code' => 'required|max:4',
            ]);

            $user = SmsVerification::where('contact_number', $request->contact_number);
            if ($user == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => "User Not Found",
                ]);
            }

            if ($user->first()->code == $request->code) {
                return response()->json([
                    'status' => 'success',
                    'message' => "Verified",
                ]);
            }
            return response()->json([
                'status' => 'wrong_otp',
                'message' => "You have entered a wrong otp",
            ]);
        }

        return view('frontend.user.register', compact('cities', 'countries'));
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
    public function userRegister(Request $request)
    {
        $redirectUrl =  session()->get('ref');
        if (Auth::check()) {
            return redirect('/');
        }

        $countryCode = '+44';
        $phoneNumber = $request->phone;
       

        $fullNumber = $countryCode . $phoneNumber;
        
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|max:191',
                'email' => 'required|email|unique:users|max:191',
                'username' => 'required|unique:users|max:191',
                'phone' => 'required|unique:users|max:191',
                // 'service_city' => 'required',
                // 'country' => 'required',
                // 'service_area' => 'required',
            ]);

            $smsVerify = SmsVerification::where('contact_number', $fullNumber)->first();
            if ($smsVerify == null) {
                if ($smsVerify->status == 'pending') {
                    return back()->with([
                        'msg' => __('User otp not verified'),
                        'type' => 'danger',
                    ]);
                }
            }
            $email_verify_tokn = Str::random(8);
            $password = $this->genRandomOtp(13);
            $user_type = $request->get_user_type;
        

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $fullNumber,
                'email_verified' => 1,
                'password' => Hash::make($password),
                'service_city' => $request->service_city,
                // 'service_area' => $request->service_area,
                'country_id' => $request->country,
                'user_type' => $request->get_user_type,
                'address'  => $request->location,
                'longitude'  => $request->longitude,
                'latitude'  => $request->latitude,
                'terms_conditions' => 1,
                'email_verify_token' => $email_verify_tokn,
                "otp_expire_at" => Carbon::now(),
            ]);
          
            Auth::guard('web')->login($user);
            $smsVerify->update([
                'status' => "verified",
            ]);
            if ($user) {
                if ($request->get_user_type == 0) {
                    $user_type = 'seller';
                } else {
                    $user_type = 'buyer';
                }
            }

            if ($request->get_user_type == 0) {
                $last_order_id = DB::getPdo()->lastInsertId();
                SellerVerify::create([
                    'seller_id' => $last_order_id,
                    'status' => 0,
                ]);
            }
            if($redirectUrl != null){
               return redirect($redirectUrl);
            }else if ($request->get_user_type == 0) {
                return redirect()->route('seller.services');
            } else {
                return redirect('/');
            }
        }

        $cities = ServiceCity::all();
        $countries = Country::all();
        return view('frontend.user.register', compact('cities', 'countries'));
    }

    public function emailVerify(Request $request)
    {
        $user_details = Auth::guard('web')->user();

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email_verify_token' => 'required|max:191',
            ], [
                'email_verify_token.required' => __('verify code is required'),
            ]);

            $user_details = User::where(['email_verify_token' => $request->email_verify_token, 'email' => $user_details->email])->first();

            if (!is_null($user_details)) {
                $user_details->email_verified = 1;
                $user_details->save();
                if ($user_details->user_type == 0) {
                    return redirect()->route('seller.dashboard');
                } else {
                    return redirect()->route('buyer.dashboard');
                }
            }

            return redirect()->back()->with(['msg' => __('Your verification code is wrong.'), 'type' => 'danger']);
        }

        $verify_token = $user_details->email_verify_token ?? null;

        try {
            //check user has verify token has or not

            if (is_null($verify_token)) {

                $verify_token = Str::random(8);
                $user_details->email_verify_token = Str::random(8);
                $user_details->save();

                $message = get_static_option('user_email_verify_message');
                $message = str_replace(["@name", "@email_verify_tokn"], [$user_details->name, $verify_token], $message);
                Mail::to($user_details->email)->send(new BasicMail([
                    'subject' => get_static_option('user_email_verify_subject'),
                    'message' => $message,
                ]));

            }

        } catch (\Exception $e) {

        }

        return view('frontend.user.email-verify');
    }

    public function resendCode()
    {
        $user_details = Auth::guard('web')->user();
        $verify_token = $user_details->email_verify_token ?? null;

        try {

            if (is_null($verify_token)) {
                $verify_token = Str::random(8);
                $user_details->email_verify_token = Str::random(8);
                $user_details->save();
            }

            $message = get_static_option('user_email_verify_message');
            $message = str_replace(["@name", "@email_verify_tokn"], [$user_details->name, $verify_token], $message);

            Mail::to($user_details->email)->send(new BasicMail([
                'subject' => get_static_option('user_email_verify_subject'),
                'message' => $message,
            ]));

        } catch (\Exception $e) {

        }

        return redirect()->back()->with(['msg' => __('Resend Email Verify Code, Please check your inbox of spam.'), 'type' => 'success']);
    }

}

