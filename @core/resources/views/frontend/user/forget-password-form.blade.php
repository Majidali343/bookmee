@extends('frontend.frontend-master')
@section('site-title')
    {{__('Forget Password')}}
@endsection
@section('content')
<div class="signup-area padding-top-70 padding-bottom-100">
    <div class="container">
        <div class="signup-wrapper">
            <div class="signup-contents">
                <h3 class="signup-title"> {{ __('Forget Password.')}} </h3>
                <h6 class="text-center">{{ __('Enter your email for new password.') }}</h6>
                
                <x-session-msg/>
                <x-msg.error/>

                <form class="signup-forms" action="{{ route('user.forget.password')}}" method="post">
                    @csrf
                    <div class="single-signup margin-top-30">
                        <label class="signup-label"> {{'Enter email*'}} </label>
                        <input class="form--control" type="email" name="email" placeholder="{{ __('Enter Email') }}">
                    </div>
                    <button type="submit">{{ __('Generate New Password') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

