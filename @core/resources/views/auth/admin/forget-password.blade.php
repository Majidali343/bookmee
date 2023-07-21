@extends('layouts.login-screens')
@section('content')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('admin.forget.password') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>{{__('Forget Password')}}</h4>
                        <p>{{__('Hello there, here you can rest you password')}}</p>
                    </div>
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">{{__('Username Or Email')}}</label>
                            <input type="text" id="username" name="username">
                            <i class="ti-email"></i>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{__('Send Reset Password Mail')}} <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
