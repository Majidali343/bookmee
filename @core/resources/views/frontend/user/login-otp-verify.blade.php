@extends('frontend.frontend-master')

@section('page-meta-data')
    <title>{{ __('User Login') }}</title>
@endsection
@section('content')
    <style>
        .otp-msg-container {
            background: #D1ECF1;
            border: 1px solid #BEE5EB;
            border-radius: 4px;
            height: 47px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 30px;
        }

        .otp-msg-container .text {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 21px;
            display: flex;
            align-items: center;
            color: #0C5460;
        }

        .resend_otp {

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 21px;
            /* or 150% */

            display: flex;
            align-items: center;
            text-align: center;

            color: #333333;
            margin-top: 30px;
            cursor: pointer;
        }
    </style>
    <div class="signup-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="signup-wrapper">
                <div class="signup-contents">
                    <h3 class="signup-title"> Enter OTP </h3>
                    @if (Session::has('msg'))
                        <p class="alert alert-{{ Session::get('type') ?? 'success' }}">{{ Session::get('msg') }}</p>
                    @endif
                    <div class="error-message"></div>
                    <form class="signup-forms" action="{{ route('user.verify.login.otp') }}" method="post">
                        @csrf
                        <div class="single-signup margin-top-30">
                            <label class="signup-label"> {{ __('Enter Code') }} </label>
                            <input class="form--control" type="text" name="otp" id="otp"
                                placeholder="{{ __('Enter Code') }}">
                            <input class="form--control" type="text" name="phone"
                                id="phone"value="{{ $phone }}" style="display:none;">
                        </div>
                        <button id="signin_form" type="submit"
                            style="background-color:rgba(3, 152, 158, 1);">{{ __('Verify') }}</button>
                    </form>

                    <form action="{{ route('user.send.login.otp') }}" method="post" class="d-flex align-items-center justify-content-center">
                        @csrf
                        <input type="text" name="phone" id="phone" value="{{ $phone }}"
                            style="display:none;">
                        <input name="remember" id="remember" type="checkbox" id="check8" style="display:none;" checked>
                        <button class="resend_otp"type="submit"
                            style="color: #333333;background:none;border:none;">{{ __('Resend Otp') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script>
        function hideOtpMsgContainer() {
            $('#otp-msg-container').remove();
        }
    </script>
@endsection
