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
    <title>{{__('Account Verify')}}</title>
    <style>
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
        }

        .mail-container .logo-wrapper {
            background-color: #1d2228;
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

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #1d2228;
            color: white;
        }

        footer {
            margin: 20px 0;
            font-size: 10px;
        }
        .mail-container .message-box{
            text-align: center;
            margin: 40px 0;
        }
        .btn{
            background-color:#444;
            color:#fff;
            text-decoration:none;
            padding: 10px 15px;
            border-radius: 3px;
            display: block;
            width: 130px;
            margin-top: 20px;
        }
        .verify-code{
            background-color:#f2f2f2;
            color:#333;
            padding: 10px 15px;
            border-radius: 3px;
            display: block;
            margin: 20px 0;
        }

        /*RTL CSS Start*/
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
        /*RTL CSS end*/
    </style>
</head>
<body>
<div class="mail-container">
    <div class="logo-wrapper">
        <a href="{{url('/')}}">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </a>
    </div>
    <div class="message-box wrap-para">
        @php
            $message = get_static_option('site_global_email_template');
            $message = str_replace('@username',$data->username,$message);
            $message = str_replace('@message',__('Here is your verification code').' <span class="verify-code">'.$data->email_verify_token.'</span>',$message);
            $message = str_replace('@company',get_static_option('site_title'),$message);
        @endphp
        {!! $message !!}
    </div>
    <footer>
        {!! get_footer_copyright_text() !!}
    </footer>
</div>
</body>
</html>
