<!DOCTYPE html>
<html lang="{{get_default_language()}}" dir="{{get_user_lang_direction()}}">
<head>
@if(!empty(get_static_option('site_google_analytics')))
        {!! get_static_option('site_google_analytics') !!}
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ get_static_option('site_title')}} -  {{ get_static_option('site_tag_line')}} </title>
    <meta name="description" content="{{get_static_option('site_meta_description')}}">
    <meta name="tags" content="{{get_static_option('site_meta_tags')}}">
    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}

<meta name="og:title" content="{{get_static_option('og_meta_title')}}"/>
<meta name="og:description" content="{{get_static_option('og_meta_description')}}"/>
<meta name="og:site_name" content="{{get_static_option('og_meta_site_name')}}"/>
<meta name="og:url" content="{{get_static_option('og_meta_url')}}"/>
{!! render_og_meta_image_by_attachment_id(get_static_option('og_meta_image')) !!}

    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
    {!! load_google_fonts() !!}
    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    <link rel="canonical" href="{{canonical_url()}}" />
    <style>
        :root {
            --main-color-one: {{get_static_option('site_main_color')}};
            --secondary-color: {{get_static_option('site_secondary')}};
            --heading-color: {{get_static_option('site_heading_color')}};
            --paragraph-color: {{get_static_option('site_paragraph_color')}};
            @php $heading_font_family = !empty(get_static_option('heading_font')) ? get_static_option('heading_font_family') :  get_static_option('body_font_family') @endphp
             --heading-font: "{{$heading_font_family}}", sans-serif;
            --body-font: "{{get_static_option('body_font_family')}}", sans-serif;
        }
    </style>
    <style>
        .maintenance-page-content-area {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 0;
            background-size: cover;
            background-position: center;
        }

        .maintenance-page-content-area:after {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: -1;
            content: '';
        }

        .page-content-wrap {
            text-align: center;
        }

        .page-content-wrap .logo-wrap {
            margin-bottom: 30px;
        }

        .page-content-wrap .maintain-title {
            font-size: 45px;
            font-weight: 700;
            color: #fff;
            line-height: 50px;
            margin-bottom: 20px;
        }

        .page-content-wrap p {
            font-size: 16px;
            line-height: 28px;
            color: rgba(255, 255, 255, .7);
            font-weight: 400;
        }

        .page-content-wrap .subscriber-form {
            position: relative;
            z-index: 0;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 40px;
        }

        .page-content-wrap .subscriber-form .submit-btn {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60px;
            height: 50px;
            text-align: center;
            border: none;
            background-color: var(--main-color-one);
            color: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .page-content-wrap .subscriber-form .form-group .form-control {
            height: 50px;
            padding: 0 20px;
            padding-right: 80px;
        }
        .global-timer .syotimer__body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-pack: distribute;
            justify-content: center
            }
            .global-timer .syotimer__body .syotimer-cell {
            margin: 10px 0;
            background: #1DBF73;
            color: #fff;
            padding: 10px 20px;
            border-radius: 3px;
            position: relative;
            z-index: 1;
            margin: 5px 10px;
            text-align: center;
            }
            @media only screen and (max-width: 375px) {
            .global-timer .syotimer__body .syotimer-cell {
                padding: 5px;
            }
            }
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__value {
            font-size: 36px;
            color: #fff;
            font-weight: 700;
            line-height: 1.3;
            font-family: var(--heading-font);
            }
            @media (min-width: 300px) and (max-width: 991.98px) {
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__value {
                font-size: 18px;
            }
            }
            @media only screen and (max-width: 375px) {
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__value {
                font-size: 17px;
            }
            }
            @media only screen and (max-width: 375px) {
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__value {
                font-size: 16px;
            }
            }
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__unit {
            font-size: 16px;
            text-transform: capitalize;
            font-weight: 400;
            line-height: 19px;
            }
            @media (min-width: 300px) and (max-width: 991.98px) {
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__unit {
                font-size: 16px;
            }
            }
            @media only screen and (max-width: 375px) {
            .global-timer .syotimer__body .syotimer-cell .syotimer-cell__unit {
                font-size: 13px;
            }
            }
    </style>
    @yield('style')
    @if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif

</head>
<body>
    <?php
    $date = get_static_option('maintenance_duration');
    $year = Carbon\Carbon::parse($date)->format('Y');
    $month = Carbon\Carbon::parse($date)->format('m');
    $day = Carbon\Carbon::parse($date)->format('d');
    ?>
<div class="maintenance-page-content-area"
        {!! render_background_image_markup_by_attachment_id(get_static_option('maintain_page_background_image')) !!}>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="maintenance-page-inner-content">
                    <div class="page-content-wrap">
                        <div class="logo-wrap">
                            {!! render_image_markup_by_attachment_id(get_static_option('maintain_page_logo')) !!}
                        </div>
                        <h2 class="maintain-title">{{get_static_option('maintain_page_title')}}</h2>
                        <p>{{get_static_option('maintain_page_description')}}</p>                        
                    </div>
                    <div class="simple-countdown mt-5">
                        <div class="global-timer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/dynamic-script.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.syotimer.min.js')}}"></script>
<script>
(function($){
    "use strict";
    $(document).ready(function(){
        $('.global-timer').syotimer({
            year: '{{ $year }}',
            month: '{{ $month }}',
            day: '{{ $day }}',
            hour: 20,
            minute: 30
        });
    });

})(jQuery);
</script>
{!! get_static_option('tawk_api_key') !!}

</body>

</html>
