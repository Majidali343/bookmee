@extends('backend.admin-master')

@section('site-title')
    {{__('All Chat Users')}}
@endsection

@section('style')
    <style>
        /*//chat box*/

        /* The popup chat - hidden by default */
        .chat-popup {
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            padding: 10px;
            background-color: white;
        }

        /* Full-width textarea */
        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 50px;
        }

        /* When the textarea gets focus, do something */
        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: none;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }

        .form-container .btn-send {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }


        .form-container .btn-icon {
            background-color: #04AA6D;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            margin-bottom:10px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;

        }
        .public-chat-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .form-container .btn-icon.cross {
            background-color: #ff0000;
            color: #fff;
        }

        .public-chat-btn {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .public-chat-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .conversation-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .conversation-bg-thumb {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .conversation-bg-thumb img{
            border-radius: 50%;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .profile_item_chat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile_item_chat .title {
            font-size: 16px;
            font-weight: 500;
            color: #555;
        }
        .chat-showing-person .user-profile-chat li:not(:last-child) {
            margin-bottom: 20px;
        }
        .chat-showing-person .user-profile-chat li {
            padding: 0 10px;
        } .chat-showing-person .user-profile-chat li .chat-author-title-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-showing-person button.chat-author-title {
            border: 0;
            background-color: unset;
            outline: none;
        }
        .chat-showing-person .chat-author-title {
            font-size: 16px;
            font-weight: 400;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-showing-person .chat-author-title img {
            width: 35px;
            height: 35px;
            border-radius: 100%;
        }
        .chat-showing-person .chat-author-message-image {
            margin-top: 10px;
        }
        .chat-showing-person .chat-author-message-image .chat-author-message-image-send {
            max-width: 300px;
            max-height: 300px;
        }

        .chat-showing-person .chat-author-message-image .chat-author-message-image-send img:not(:last-child) {
            margin-bottom: 10px;
        }

        .chat-showing-person .user-profile-chat .chat-message-reverse .chat-author-title {
            flex-direction: row-reverse;
        }
        .chat-showing-person .user-profile-chat .chat-message-reverse .chat-author-message-image {
            text-align: right;
        }
        .chat-showing-person .user-profile-chat .chat-message-reverse .chat-author-message-image-send {
            margin-left: auto;
        }
        .chat-showing-person .user-profile-chat .chat-message-reverse .chat-author-title-name {
            flex-direction: row-reverse;
            display: flex;
            gap: 10px;
            align-items: center;
        }

    </style>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row mt-5">

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Chat User List')}}  </h4>
                            </div>
                        </div>
                            <div class="chat-showing-person">
                                <ul class="user-profile-chat margin-top-30" id="users">
                                    @forelse($sellers as $seller)
                                        @if(empty(optional($seller->sellerOnlyForAdmin)->id))
                                            @continue
                                        @endif
                                        <li>
                                            <a href="{{ route('admin.chat.buyer.connect.to.seller',optional($seller->sellerOnlyForAdmin)->id) }}">
                                                <h4 class="chat-author-title public-chat-toggle"
                                                     data-chat_user_id="{{ optional($seller->sellerOnlyForAdmin)->id }}">
                                                     {!! render_image_markup_by_attachment_id(optional($seller->sellerOnlyForAdmin)->image) !!}
                                                    {{ optional($seller->sellerOnlyForAdmin)->name }}
                                                </h4>
                                            </a>
                                        </li>
                                    @empty
                                        <li><p>{{ __('No users found') }}</p></li>
                                    @endforelse
                                </ul>
                            </div>
                    </div>
                </div>
            </div>

            @if(!empty($buyers))
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="header-wrap d-flex justify-content-between">
                                <div class="left-content">
                                    <h4 class="header-title">{{__('Buyer connected to seller')}}  </h4>
                                </div>
                            </div>
                            <div class="chat-showing-person">
                                <ul class="user-profile-chat margin-top-30" id="users">
                                    @foreach($buyers as $buyer)
                                        <li>
                                                <form action="{{ route('admin.chat.details') }}" method="GET">
                                                    @csrf
                                                        <input type="hidden" name="seller_id" value="{{ $seller_id }}">
                                                        <input type="hidden" name="buyer_id" value="{{ optional($buyer->buyerList)->id}}">
                                                        <input type="hidden" name="first" value="1">
                                                        <button type="{{ (optional($buyer->buyerList)->id == request()->buyer_id) ? "button" : "submit" }}" class="chat-author-title"> <span class="chat-author-title-image"> {!! render_image_markup_by_attachment_id(optional($buyer->buyerList)->image) !!} </span> {{ optional($buyer->buyerList)->name  }} </button>
                                                </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(!empty($messages))
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="header-wrap d-flex justify-content-between">
                                <div class="left-content">
                                </div>
                            </div>
                            <div class="public-chat-box-wrapper"></div>
                            @include('livechat::backend.chat-box')
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')

@endsection

