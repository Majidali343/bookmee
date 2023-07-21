<!-- Header area Starts -->
<header class="header-style-01">
    <!-- Menu area Starts -->
    <nav class="navbar navbar-area white nav-absolute navbar-expand-lg navbar-border">
        <div class="container container-two nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="index.html" class="logo">
                        <img src="{{ asset('assets/frontend/img/logo-01.png') }}" alt="">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <li class="menu-item-has-children current-menu-item">
                        <a href="#">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Home 01</a></li>
                            <li><a href="02_index.html">Home 02</a></li>
                            <li><a href="03_index.html">Home 03</a></li>
                            <li><a href="04_index.html">Home 04</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="service_list.html">Service List</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li class="menu-item-has-children current-menu-item">
                        <a href="#">Others</a>
                        <ul class="sub-menu">
                            <li><a href="service_details.html">Service Details</a></li>
                            <li><a href="02_service_details.html">Service Details Two</a></li>
                            <li><a href="03_service_details.html">Service Details Three</a></li>
                            <li><a href="04_service_details.html">Service Details Four</a></li>
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="seller_profile.html">Seller Profile</a></li>
                            <li><a href="seller_order_view.html">Seller View</a></li>
                            <li><a href="invoice.html">Invoice</a></li>
                            <li><a href="signup.html">Signup</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="error.html">404</a></li>
                            <li><a href="multistep_form.html">multistep Form</a></li>
                            <li><a href="02_multistep_form.html">multistep Form Two</a></li>
                            <li><a href="register_step_form.html">RegisterStep Form</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children current-menu-item">
                        <a href="#">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog_details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">contact</a></li>
                </ul>
            </div>
            <div class="nav-right-content">
                <ul>
                    <li>
                        <a href="#">
                            <div class="info-bar-item">
                                <div class="cart-icon icon">
                                    <i class="las la-shopping-cart"></i>
                                    <div class="cart-list">
                                        <span class="single-list"> Cart One </span>
                                        <span class="single-list"> Cart Two </span>
                                        <span class="single-list"> Cart Three </span>
                                        <span class="single-list"> Cart Four </span>
                                        <span class="single-list"> Cart Five </span>
                                    </div>
                                </div>
                                <div class="notification-icon icon">
                                    <i class="las la-bell"></i>
                                    <span class="notification-number"> 4 </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="info-bar-item-two">
                                <div class="author-thumb">
                                    <img src="{{ asset('assets/frontend/img/author-nav.jpg') }}" alt="">
                                </div>
                                <div class="author-nav-content">
                                    <span class="title"> Alex Jerin </span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Menu area end -->
</header>
<div class="overlays"></div>
<!-- Header area end -->











{{--<div class="topbar-area navbar-style-{{get_navbar_style()}}">--}}
{{--    <div class="container custom-header-container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="topbar-inner">--}}
{{--                    <div class="left-contnet">--}}
{{--                        <div class="social-link">--}}
{{--                            <ul>--}}
{{--                                @foreach($all_social_icons as $key=> $data)--}}
{{--                                <li><a href="{{$data->url}}"><i class="{{$data->icon}}"></i></a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="right-contnet">--}}
{{--                        <ul class="info-items">--}}
{{--                            @foreach($all_topbar_infos as $data)--}}
{{--                            <li class="email"><i class="{{$data->icon}}"></i>{{$data->details}}</li>--}}
{{--                            @endforeach--}}


{{--                            @if(auth()->check())--}}
{{--                                @php--}}
{{--                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');--}}
{{--                                @endphp--}}
{{--                                <li><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>--}}
{{--                                    <a href="{{ route('frontend.user.logout') }}">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}


{{--                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                        <input type="submit" value="aa" id="userlogout-form" class="d-none">--}}
{{--                                    </form>--}}
{{--                                </li>--}}
{{--                            @else--}}
{{--                                    <li class="log-btn">--}}
{{--                                        <a href="{{route('user.login')}}">{{__('Login')}}</a>--}}
{{--                                              <span>|</span>--}}
{{--                                        <a href="{{route('user.register')}}">{{__('Register')}}</a>--}}
{{--                                    </li>--}}
{{--                            @endif--}}
{{--                                @if(!empty(get_static_option('language_select_option')))--}}
{{--                                    <li>--}}
{{--                                        <select id="langchange">--}}
{{--                                            @foreach($all_language as $lang)--}}
{{--                                                 @php--}}
{{--                                                    $lang_name = explode('(',$lang->name);--}}
{{--                                                    $data = array_shift($lang_name);--}}
{{--                                                 @endphp--}}
{{--                                                <option @if(get_user_lang() == $lang->slug) selected @endif value="{{$lang->slug}}">{{$data}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                            --}}{{--Dark Mode Toggle--}}
{{--                            <li>--}}
{{--                                <label class="switch yes">--}}
{{--                                    <input id="frontend_darkmode" type="checkbox" data-mode={{ get_static_option('site_frontend_dark_mode') }} @if(get_static_option('site_frontend_dark_mode') == 'on') checked @else @endif>--}}
{{--                                    <span class="slider-color-mode onff"></span>--}}
{{--                                </label>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

