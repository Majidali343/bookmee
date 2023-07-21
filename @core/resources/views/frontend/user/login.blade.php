@extends('frontend.frontend-master')

@section('page-meta-data')
    <title>{{ __('User Login') }}</title>
@endsection
@section('content')
<div class="signup-area padding-top-70 padding-bottom-100">
    <div class="container">
        <div class="signup-wrapper">
            <div class="signup-contents">
                <h3 class="signup-title"> {{ get_static_option('login_form_title') ?? __('Login to your account') }}</h3>

                @if(Session::has('msg'))
                <p class="alert alert-{{Session::get('type') ?? 'success'}}">{{ Session::get('msg') }}</p>
                @endif
                <div class="error-message"></div>

                <form class="signup-forms" action="{{ route('user.send.login.otp')}}" method="post">
                    @csrf
                    <div class="single-signup margin-top-30">
                        <label class="signup-label"> {{__('Phone Number')}} </label>
                        <div style="display: flex">
                            <input class="form--control" type="text" name="phone_number" value="+44" readonly style="width: 43px; padding: 0px 0px 0px 6px; margin-right:8px;">
                            <input class="form--control" type="text" name="phone" id="phone" placeholder="{{__('Phone Number')}}"  >
                        </div>
                    </div>

                    <div class="signup-checkbox">
                        <div class="checkbox-inlines">
                            <input class="check-input" name="remember" id="remember" type="checkbox" id="check8">
                            <label class="checkbox-label" for="remember"> {{ __('Remember me')}}</label>
                        </div>
                        <!-- <div class="forgot-btn">
                            <a href="{{ route('user.forget.password') }}" class="forgot-pass"> {{ __('Forgot Password') }}</a>
                        </div> -->
                    </div>
                    <button id="signin_form" type="submit" style="background-color:rgba(3, 152, 158, 1);">{{ __('Login Now') }}</button>
                    <span class="bottom-register"> {{ _('Do not have Account?')}} <a class="resgister-link" href="{{ route('user.register')}}"> {{_('Register')}} </a> </span>
                </form>
                
                <!-- @if(preg_match('/(bytesed)/',url('/')))
                <div class="adminlogin-info table-responsive margin-top-30">
                    <table class="table-border table">
                        <th>{{__('Username')}}</th>
                        <th>{{__('Password')}}</th>
                        <th>{{__('Action')}}</th>
                        <tbody>
                            <tr>
                                <td id="seller_username">test_seller</td>
                                <td id="seller_password">12345678</td>
                                <td><button type="button" class="autoLogin" id="sellerLogin">{{__('Seller Login')}}</button></td>
                            </tr>
                            <tr>
                                <td id="buyer_username">test_buyer</td>
                                <td id="buyer_password">12345678</td>
                                <td><button type="button" class="autoLogin" id="buyerLogin">{{__('Buyer Login')}}</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif -->

                <!-- <div class="social-login-wrapper">
                    @if(get_static_option('enable_google_login') || get_static_option('enable_facebook_login'))
                    <div class="bar-wrap">
                        <span class="bar"></span>
                        <p class="or">{{ __('or') }}</p>
                        <span class="bar"></span>
                    </div>
                    @endif

                    <div class="sin-in-with">
                        @if(get_static_option('enable_google_login'))
                        <a href="{{ route('login.google.redirect') }}" class="sign-in-btn">
                            <img src="{{ asset('assets/frontend/img/static/google.png') }}" alt="icon">
                            {{ __('Sign in with Google') }}
                        </a>
                        @endif
                        @if(get_static_option('enable_facebook_login'))
                        <a href="{{ route('login.facebook.redirect') }}" class="sign-in-btn">
                            <img src="{{ asset('assets/frontend/img/static/facebook.png') }}" alt="icon">
                            {{ __('Sign in with Facebook') }}
                        </a>
                        @endif
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>
 


@endsection
@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>

@endsection