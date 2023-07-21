@if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 1)
        <div class="chat-container-footer">
            {{-- <button class="open-button"> <i class="las la-comments"></i> {{ __('Chat') }}</button> --}}
            <div class="mobile-overlay"></div>
            <div class="chat-wrapper-area chat-popup" id="myForm">
                <div class="chat-wrapper-conversation">
                    <div id="app">
                        <div class="row-flex-item">
                            <div class="col-lg-8-item">
                                <div class="chat-showing-item">
                                    <div id="chat-overlay" class="row-"></div>

                                    <audio id="chat-alert-sound" style="display: none">
                                        <source src="{{ asset('assets/uploads/sound/facebook_chat.mp3') }}" />
                                    </audio>
                                    @include('livechat::frontend.buyer.chat-box')
                                </div>
                            </div>
                            <div class="chat-mobile-icon">
                                <i class="las la-bars"></i>
                            </div>
                            <div class="col-lg-4-item" id="col-lg-4-item">
                                <input type="hidden" id="current_user" value="{{ \Auth::guard('web')->user()->id }}"/>
                                <div class="conversation-start">
                                    @php
                                        $sellers = \Modules\LiveChat\Entities\LiveChatMessage::select('seller_id')
                                                  ->with('sellerList')
                                                  ->distinct('seller_id')
                                                  ->where('seller_id','!=',NULL)
                                                  ->where('buyer_id', Auth::guard('web')->user()->id)
                                                  ->get();
                                    @endphp

                                    @if($sellers->count() > 0)
                                        <div class="chat-showing-person">
                                            <div class="public-chat-flex">
                                                <h5 class="panel-title">{{__('All Contacts')}}</h5>
                                                <div class="public-chat-btn">
                                                    <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="input-name-search-field custom-form">
                                                <input class="form-control" type="text" placeholder="{{__('Search Name')}}" id="chat_name_search_text">
                                            </div>
                                            <div class="seller_container">
                                                <ul class="user-profile-chat margin-top-30" id="users">
                                                    @foreach($sellers as $seller)
                                                        @php
                                                            $user_image = get_attachment_image_by_id(optional($seller->sellerList)->image);
                                                        @endphp
                                                        <li>
                                                            <a href="javascript:void(0);" class="chat-toggle"data-id="{{ optional($seller->sellerList)->id }}"data-user="{{ optional($seller->sellerList)->name }}" data-user_image="{{ !empty($user_image) ? $user_image["img_url"] : null }}">
                                                                <div class="chat-bg bg-image" {!! render_background_image_markup_by_attachment_id(optional($seller->sellerList)->image) !!}> <span class="notification-dot active"></span> </div>
                                                                <h4 class="chat-author-title"> {{ optional($seller->sellerList)->name  }} </h4>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(!Auth::guard('web')->check())
            @if(get_static_option('login_text_show_hide') == 'yes')
                <button class="open-button"> <i class="las la-comments"></i> {{ __('Login To Chat') }}</button>
            @endif

        <div class="mobile-overlay"></div>
            <div class="chat-wrapper-area chat-popup" id="myForm">
                <div class="chat-wrapper-conversation">
                    <div id="app">
                        <div class="row-flex-item">
                            <div class="chat-mobile-icon">
                                <i class="las la-bars"></i>
                            </div>
                            <div class="col-lg-4-item" id="col-lg-4-item">
                                <div class="conversation-start">
                                        <div class="chat-showing-person">
                                            <div class="public-chat-flex">
                                                @if(get_static_option('login_text_show_hide') == 'yes')
                                                <h5 class="panel-title">{{__('Login to Chat')}}</h5>
                                                @endif
                                                <div class="public-chat-btn">
                                                    <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-item-4-form-style">
                                                <p class="mt-3 error_message"></p>
                                                <small class="please_login_text">{{ __('Please login to start chat with seller') }}</small>
                                                <div class="email custom-form mt-2">
                                                    <input class="form-control" type="email" placeholder="{{__('Email or Username')}}" name="user_login_email" id="user_login_email">
                                                </div>
                                                <div class="email custom-form mt-2">
                                                    <input class="form-control" type="password" placeholder="{{__('Password')}}" name="user_login_password" id="user_login_password">
                                                </div>
                                                <button class="form-control mt-2 login_to_chat">{{ __('Login') }}</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    @endif

    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type === 0)
        <button class="open-button"> <i class="las la-comments"></i> {{ __('Chat') }}</button>
        <div class="mobile-overlay"></div>
        <div class="chat-wrapper-area chat-popup" id="myForm">
            <div class="chat-wrapper-conversation">
                <div id="app">
                    <div class="row-flex-item">
                        <div class="col-lg-8-item">
                            <div class="chat-showing-item">
                                <div id="chat-overlay" class="row-"></div>

                                <audio id="chat-alert-sound" style="display: none">
                                    <source src="{{ asset('assets/uploads/sound/facebook_chat.mp3') }}" />
                                </audio>
                                @include('livechat::frontend.seller.chat-box')
                            </div>
                        </div>
                        <div class="chat-mobile-icon">
                            <i class="las la-bars"></i>
                        </div>
                        <div class="col-lg-4-item" id="col-lg-4-item">
                            <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}"/>
                            <div class="conversation-start">
                                @php
                                    $buyers = \Modules\LiveChat\Entities\LiveChatMessage::select('buyer_id')
                                        ->with('buyerList')
                                        ->distinct('buyer_id')
                                        ->where('buyer_id','!=',NULL)
                                        ->where('seller_id', Auth::guard('web')->user()->id)
                                        ->get();
                                @endphp

                                @if($buyers->count() > 0)
                                    <div class="chat-showing-person">
                                        <div class="public-chat-flex">
                                            <h5 class="panel-title">{{__('All Contacts')}}</h5>
                                            <div class="public-chat-btn">
                                                <button type="button" class="btn-icon" onclick="minimizeForm()"><i class="las la-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-name-search-field custom-form">
                                            <input class="form-control" type="text" placeholder="{{__('Search Name')}}" id="chat_name_search_text">
                                        </div>
                                        <div class="seller_container">
                                            <ul class="user-profile-chat margin-top-30" id="users">
                                                @foreach($buyers as $buyer)
                                                    @php
                                                        $user_image = get_attachment_image_by_id(optional($buyer->buyerList)->image);
                                                    @endphp
                                                    <li>
                                                        <a href="javascript:void(0);" class="chat-toggle"data-id="{{ optional($buyer->buyerList)->id }}"data-user="{{ optional($buyer->buyerList)->name }}" data-user_image="{{ !empty($user_image) ? $user_image["img_url"] : null }}">
                                                            <div class="chat-bg bg-image" {!! render_background_image_markup_by_attachment_id(optional($buyer->buyerList)->image) !!}> <span class="notification-dot active"></span> </div>
                                                            <h4 class="chat-author-title"> {{ optional($buyer->buyerList)->name  }} </h4>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif