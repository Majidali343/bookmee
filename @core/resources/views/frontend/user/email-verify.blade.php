@extends('frontend.frontend-master')
@section('page-meta-data')
    <title>{{__('Verify Account')}}</title>
@endsection
@section('content')
<div class="signup-area padding-top-70 padding-bottom-100">
    <div class="container">
        <div class="signup-wrapper">
            <div class="signup-contents">
                <h3 class="signup-title"> {{ __('Verify Your Account')}} </h3>
                <x-msg.error/>
                <x-session-msg/>
               <div class="alert alert-info alert-dismissible fade show mt-5 mb-1" role="alert">
                    {{__('Please check email inbox/spam for verification code')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="signup-forms" action="{{ route('email.verify')}}" method="post">
                    @csrf
                    <div class="single-signup margin-top-30">
                        <label class="signup-label"> {{__('Enter code*')}} </label>
                        <input class="form--control" type="text" name="email_verify_token" placeholder="{{__('Enter code')}}">
                    </div>
                    <button type="submit">{{ __('Verify Account') }}</button>
                </form>
                
                 <div class="resend-verify-code-wrap">
                    <a class="text-center" href="{{ route('resend.verify.code') }}">{{ __('Resend Code') }}</a>
                </div>
            </div>
            <br>
            
        </div>
    </div>
</div>
@endsection
