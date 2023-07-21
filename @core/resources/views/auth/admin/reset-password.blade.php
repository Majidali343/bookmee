@extends('layouts.login-screens')

@section('content')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('admin.reset.password.change') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>{{__('Reset Password')}}</h4>
                        <p>{{__('Hello there, Here you can change your password')}}</p>
                    </div>
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                    <div class="login-form-body">
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="form-gp focused">
                            <label for="username">{{__('Username')}}</label>
                            <input type="text" id="username" readonly value="{{$username}}" name="username">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{__('Reset Password')}} <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
