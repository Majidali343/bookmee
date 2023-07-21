<!doctype html>
<html class="no-js" lang="{{get_default_language()}}" dir="{{get_default_language_direction()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{get_static_option('site_title')}} -
        @if(request()->path() == 'admin-home')
            {{get_static_option('site_tag_line')}}
        @else
            @yield('site-title')
        @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'),"full",false);
    @endphp
    @if (!empty($site_favicon))
        <link rel="icon" href="{{$site_favicon['img_url']}}" type="image/png">
    @endif

    <link rel="stylesheet" href="{{asset('assets/common/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/line-awesome.min.css')}}">
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome-iconpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/flatpickr.min.css')}}">
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.min.css')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('style')
    @if(get_static_option('site_admin_dark_mode') == 'on')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dark-mode.css')}}">
    @endif
    @if( get_default_language_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/backend/css/rtl.css')}}">
    @endif

</head>

<body>

@if(!empty(get_static_option('admin_loader_animation')))
<div id="preloader">
    <div class="loader"></div>
</div>
@endif

<div class="page-container">

    @include('backend/partials/sidebar')

    <div class="main-content">

        <div class="header-area">
            <div class="row align-items-center">

                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div class="col-md-6 col-sm-4 clearfix">
                    <ul class="notification-area pull-right">
                        <li ><label class="switch yes">
                            <input id="darkmode" type="checkbox" data-mode={{ get_static_option('site_admin_dark_mode') }} @if(get_static_option('site_admin_dark_mode') == 'on') checked @else @endif>
                            <span class="slider-color-mode onff"></span>
                        </label></li>
                        <li id="full-view"><i class="ti-fullscreen"></i></li>
                        <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        <li><a class="btn @if(get_static_option('site_admin_dark_mode') == 'off')btn-primary @else btn-dark  @endif" target="_blank" href="{{url('/')}}"><i class="fas fa-external-link-alt mr-1"></i>   {{__('View Site')}} </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">@yield('site-title')</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{route('admin.home')}}">{{__('Home')}}</a></li>
                            <li><span>@yield('site-title')</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        {!! render_image_markup_by_attachment_id(auth()->guard('admin')->user()->image,'avatar user-thumb') !!}
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('admin.profile.update')}}">{{__('Edit Profile')}}</a>
                            <a class="dropdown-item" href="{{route('admin.password.change')}}">{{__('Password Change')}}</a>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ __('Logout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <footer>
        <div class="footer-area footer-wrap">
            <p>
                {!! render_footer_copyright_text() !!}
            </p>
            <p class="version">V-{{get_static_option('site_script_version','1.4.6')}}</p>
        </div>
    </footer>
</div>

<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/backend/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.slicknav.min.js')}}"></script>
<script src="{{asset('assets/backend/js/fontawesome-iconpicker.min.js')}}"></script>
<script src="{{asset('assets/backend/js/flatpickr.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('script')
<script src="{{asset('assets/backend/js/plugins.js')}}"></script>
<script src="{{asset('assets/backend/js/scripts.js')}}"></script>

<script>
    (function ($){
        "use strict";



        $('#reload').on('click', function(){
            location.reload();
        })
        $('#darkmode').on('click', function(){
           var el = $(this)
            var mode = el.data('mode')
            $.ajax({
                type:'GET',
                url:  '{{ route("admin.dark.mode.toggle") }}',
                data:{mode:mode},
                success: function(){
                    location.reload();
                },error: function(){
                }
            });
        });

        $(document).on('click','.swal_delete_button',function(e){
          e.preventDefault();
            Swal.fire({
              title: '{{__("Are you sure?")}}',
              text: '{{__("You would not be able to revert this item!")}}',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: "{{__('Yes, Delete it!')}}",
               cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
              if (result.isConfirmed) {
                $(this).next().find('.swal_form_submit_btn').trigger('click');
              }
            });
        });


        $(document).on('click','.swal_delete_all_lang_data_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: '{{__("It will delete All language data..!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, Delete it!')}}",
                 cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.swal_change_language_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure to make this language as a default language?")}}',
                text: '{{__("Languages will be turn changed as default")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, Change it!')}}",
                cancelButtonText: "{{__('Cancel')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

    })(jQuery);
</script>
<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}
<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top','color':'green'});
    });
</script>
</body>

</html>
