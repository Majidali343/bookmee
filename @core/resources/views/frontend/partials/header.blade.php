<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">

<head>
   @if(!empty(get_static_option('site_google_analytics')))
        {!! get_static_option('site_google_analytics') !!}
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}

       @php
        $custom_body_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 1)->latest()->first();
        $custom_heading_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 2)->latest()->first();
       @endphp
       @if(!empty($custom_body_font_get) || !empty($custom_heading_font_get))
           <style>
               /*heading font*/
               @font-face {
                   font-family: {{optional($custom_heading_font_get)->file}};
                   src: url('{{optional($custom_heading_font_get)->path}}') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               /*body font*/
               @font-face {
                   font-family: {{optional($custom_body_font_get)->file}};
                   src: url('{{optional($custom_body_font_get)->path}}') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               :root {
                   --heading-font: '{{optional($custom_heading_font_get)->file}}', sans-serif !important;
                   --body-font: '{{optional($custom_body_font_get)->file}}', sans-serif !important;
               }
           </style>
       @else
        {!! load_google_fonts() !!}
       @endif

    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/helpers.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/new.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.min.css')}}">

    @if( get_user_lang_direction() === 'rtl')
    <link rel="stylesheet" href="{{asset('assets/common/css/rtl.css')}}">
    @endif

    <link rel="canonical" href="{{canonical_url()}}" />
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>

    @php
    $page_post = isset($page_post) ? $page_post : [];
    $page_type = isset($page_type) ? $page_post : [];
    @endphp

    @include('frontend.partials.root-style')
    @yield('style')


    @if(request()->routeIs('homepage'))
        <title>{{get_static_option('site_title')}} - {{get_static_option('site_tag_line')}}</title>

           {!! render_site_meta() !!}

     @elseif( request()->routeIs('frontend.dynamic.page') && $page_type === 'page' )

           {!! render_site_title(optional($page_post)->title ) !!}

           {!! render_site_meta() !!}  

    @else
        @yield('page-meta-data')
    @endif
@if(!empty( get_static_option('site_third_party_tracking_code')))
 {!! get_static_option('site_third_party_tracking_code') !!}
 @endif

</head>


<body>

@include('frontend.partials.preloader')
@include('frontend.partials.navbar',$page_post)



