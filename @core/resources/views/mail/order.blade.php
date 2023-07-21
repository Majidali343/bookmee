<!doctype html>
@php
    $default_lang = get_default_language();
@endphp
<html lang="{{$default_lang}}" dir="{{ get_user_lang_direction() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Package Order From')}} {{get_static_option('site_title')}}</title>
    <style>
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            background-color: #111d5c;
            padding: 20px 0 20px;
        }
        table {
            margin: 0 auto;
        }
        table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
        footer {
            margin: 20px 0;
            font-size: 14px;
        }

        [dir="rtl"] .earning-wrapper {
            text-align: right !important;
        }
        [dir="rtl"] .earning-wrapper .earning-title {
            text-align: right !important;
        }
        [dir="rtl"] .wrap-para {
            text-align: right !important;
        }
        [dir="rtl"] .inner-wrap-contents p {
            text-align: right !important;
        }
        [dir="rtl"] .inner-wrap-contents .earning-order-title {
            text-align: right !important;
        }
        [dir="rtl"] .earning-title {
            text-align: right !important;
        }
    </style>
</head>
<body>
<div class="mail-container">
    <div class="logo-wrapper">
        <a href="{{url('/')}}">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </a>
    </div>
    <p class="wrap-para">{{__('You Have A Order Message From')}} {{get_static_option('site_title')}}</p>
    <table class="wrap-para">
        <tr>
            <td>{{__('Package Name')}}</td>
            <td>{{$package->lang_front->title}}</td>
        </tr>
        @foreach($data as $key => $field)
            @php
                $name = str_replace(['-','_'],[' ',' '],$key);
            @endphp
            <tr>
                <td>{{ucwords($name)}}</td>
                <td>{{$field}}</td>
            </tr>
        @endforeach
    </table>
    <footer>
        {!! render_footer_copyright_text() !!}
    </footer>
</div>
</body>
</html>