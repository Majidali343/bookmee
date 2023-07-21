@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Live Chat')}}
@endsection

@section('style')
    <style>
        .dashboard-right .col-lg-8-item {
            border-left: 1px solid #fff;
            max-width: 450px;
            margin-left: 0;
            margin-right: auto;
        }
        .dashboard-right .chat_box.chat-opened {
            box-shadow: none;
        }
        .dashboard-right .col-lg-4-item {
            box-shadow: none;
        }
        @media screen and (max-width:991px) {
            .chat-mobile-icon {
                margin-top: 20px;
            }
        }
        @media screen and (max-width:620px) {
            .dashboard-right .row-flex-item {
                flex-direction: column;
                margin-top: 20px;
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
                @include('frontend.user.seller.partials.sidebar')
                <div class="dashboard-right">
                    <div id="app">

                        <div class="chat-mobile-icon">
                            <i class="las la-bars"></i>
                        </div>
                        <div class="row-flex-item seller-chat-row-item">
                            <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />

                            <div class="col-lg-4-item" id="col-lg-4-item">
                                @if($buyers->count() > 0)
                                    <div class="chat-showing-person">
                                        <div class="public-chat-flex">
                                            <h5 class="panel-title">{{__('All Contacts')}}</h5>
                                        </div>
                                        <div class="input-name-search-field custom-form">
                                            <input class="form-control" type="text" placeholder="{{__('Search Name')}}" id="chat_name_search_text">
                                        </div>
                                        <div class="seller_container">
                                            <ul class="user-profile-chat margin-top-30" id="users">
                                                @foreach($buyers as $buyer)
                                                    <li>
                                                        <a href="javascript:void(0);" class="chat-toggle"data-id="{{ optional($buyer->buyerList)->id }}"data-user="{{ optional($buyer->buyerList)->name }}">
                                                            <div class="chat-bg bg-image" {!! render_background_image_markup_by_attachment_id(optional($buyer->buyerList)->image) !!}> <span class="notification-dot active"></span> </div>
                                                            <h4 class="chat-author-title"> {{ optional($buyer->buyerList)->name }} </h4>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>


                                @else
                                    <p class="no-contact-found">{{ __('No Contacts Yet') }}</p>
                                @endif
                            </div>
                            <div class="col-lg-8-item">
                                <div class="chat-showing-item">
                                    <div id="chat-overlay" class="row-"></div>
                                    <audio id="chat-alert-sound" style="display: none">
                                        <source src="{{ asset('assets/uploads/sound/facebook_chat.mp3') }}" />
                                    </audio>
                                    @include('livechat::frontend.seller.chat-box')
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.base_url = "{{url('/')}}";
    </script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{asset('@core/public/js/app.js')}}"></script>

    <script>
        $(document).on('click','.chat-mobile-icon', function(){
            document.getElementById("col-lg-4-item").style.display = "block";
            $(this).hide('.chat-mobile-icon');
        });
        function mobileChat(chatMobileContact) {
            if (chatMobileContact.matches) { // If media query matches
                document.getElementById("col-lg-4-item").style.display = "none";
                $('.chat-mobile-icon').show();
            }
        }
    </script>

 @endsection