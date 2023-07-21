@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Live Chat')}}
@endsection

@section('style')
    <style>
        p {
            font-size: 13px;
            padding: 5px;
            border-radius: 3px;
        }

        .base_receive p {
            background: #4bdbe6;
        }

        .base_sent p {
            background: #e674a8;
        }

        time {
            font-size: 11px;
            font-style: italic;
        }

        #login-box {
            margin-top: 20px
        }

        .chat-area {
            height: 400px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        form.upload-frm {
            display: none;
        }
        .footer-panel-input-flex {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }
        .footer-panel-input-flex .input-group {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }
        .footer-panel-input-flex .input-group .upload-btn {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 9;
            box-shadow: none;
        }
        .footer-panel-input-flex .input-group .chat_input {
            padding: 10px 40px;
            outline: none;
            box-shadow: none;
        }
        .footer-panel-input-flex .input-group .chat_input:focus{
            outline: none;
            box-shadow: none;
        }
        .footer-panel-input-flex .input-group .btn-chat {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            height: 100%;
            padding: 0 10px;
            z-index: 9;
            box-shadow: none;
        }
        .panel-footer .upload-btn {
            outline: none;
            border: none;

        }
        .panel-footer .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 10px;
            font-size: 15px;
            line-height: 1;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        #users li {
            margin-bottom: 5px;
        }

        .glyphicon-ok {
            color: #42b7dd;
        }

        .loader {
            -webkit-animation: spin 1000ms infinite linear;
            animation: spin 1000ms infinite linear;
        }
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        .chat_input {
            font-size: 15px;
        }

        .btn-chat {
            font-size: 11px;
            font-weight: bold;
        }

        .no-more-messages {
            background-color: #b32b2b;
            margin: 3px;
            margin-bottom: 6px;
            padding: 3px;
            font-size: 12px;
            color: #fff;
        }

        .panel-footer {
            padding-left: 3px !important;
        }

        .upload-btn {
            font-size: 19px;
            color: #2b2be6;
        }

        .emoji-list {
            margin-top: 4px;
        }

        .emoji-list ul {
            list-style-type: none;
        }

        .emoji-list ul li {
            display: inline-block;
            margin: 3px;
        }

        .emoji-list ul li a {
            text-decoration: none;
            font-size: 14px;
        }


        .user-profile-chat li:not(:first-child) a {
            padding-top: 10px;
        }
        .user-profile-chat li:not(:last-child) a {
            padding-bottom: 10px;
            border-bottom: 1px solid #f2f2f2;
        }
        .user-profile-chat li a {
            display: flex;
            align-content: flex-start;
            gap: 20px;
            position: relative;
        }

        .chat-bg {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            position: relative;
        }
        .chat-bg img {
            border-radius: 50%;
        }
        .conversation-bg-thumb {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            background-size: contain;
        }
        .conversation-bg-thumb img{
            border-radius: 50%;
        }
        .chat-author-title{
            font-size: 20px;
            line-height: 28px;
            margin: -4px 0 0;
            font-weight: 500;
            color: #333;
        }
        .notification-dot {
            display: inline-block;
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background-color: #DDD;
            border: 2px solid #fff;
            position: absolute;
            bottom: 0px;
            right: 0px;
            z-index: 2;
            -webkit-box-shadow: 0 0 10px rgba(221, 221, 221, 0.5);
            box-shadow: 0 0 10px rgba(221, 221, 221, 0.5);
        }

        .notification-dot.active{
            background-color: var(--main-color-one);
        }

        .conversation-wrapper-flex {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 5px 30px;
            flex-wrap: wrap;
        }
        .conversation-message-contents {
            flex: 1;
        }
        .conversation-message-contents .messages {
            word-break: break-word;
        }
        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: nowrap;
        }
        .close-chat {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background-color: #ff0000;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
        .panel-title {
            font-size: 28px;
        }
        @media only screen and (max-width: 991px) {
            .chat-showing-item {
                margin-top: 30px;
            }
            .chat-showing-person {
                margin-top: 30px;
            }
            .panel-title {
                font-size: 24px;
            }
        }
    </style>
@endsection


@section('content')

    <x-frontend.seller-buyer-preloader/>
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.buyer.partials.sidebar')
                <div class="dashboard-right">
                <div id="app">
                <div class="row">
                <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
                <div class="col-md-4" id="col-lg-4-item">
                    @if($users->count() > 0)
                        <div class="chat-showing-person">
                            <h3 class="panel-title">{{__('All Contacts')}}</h3>
                            <ul class="user-profile-chat margin-top-30" id="users">
                                @foreach($users as $user)
                                    <li>
                                        <a href="javascript:void(0);" class="chat-toggle"data-id="{{ $user->id }}"data-user="{{ $user->name }}">
                                            <div class="chat-bg bg-image" {!! render_background_image_markup_by_attachment_id($user->image) !!}> <span class="notification-dot active"></span> </div>
                                            <h4 class="chat-author-title"> {{ $user->name }} </h4>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No users found <a href="{{ route('register') }}">{{ __('Register page') }}</a></p>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="chat-showing-item">
                        <div id="chat-overlay" class="row-"></div>

                        <audio id="chat-alert-sound" style="display: none">
                            <source src="{{ asset('assets/uploads/sound/facebook_chat.mp3') }}" />
                        </audio>
                        @include('livechat::frontend.buyer.chat-box')
                    </div>
                </div>
            </div>
            </div>

                </div>
            </div>
        </div>
    </div>

 @endsection
 @section('scripts')
     <script>
         window.base_url = "{{ env("app_url") }}";
     </script>
     <script src="//js.pusher.com/4.1/pusher.min.js"></script>
     <script src="{{asset('./@core/public/js/app.js')}}"></script>
 @endsection