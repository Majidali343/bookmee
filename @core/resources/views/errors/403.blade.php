
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{get_static_option('site_meta_'.get_user_lang().'_description')}}">
    <meta name="tags" content="{{get_static_option('site_meta_'.get_user_lang().'_tags')}}">
    <title>{{get_static_option('site_'.get_user_lang().'_title')}} - {{get_static_option('site_'.get_user_lang().'_tag_line')}}</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">
    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
    @if(!empty(get_static_option('custom_css_area')))
        <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <style>
        :root {
            --main-color-one: {{get_static_option('site_main_color_one')}};
            --secondary-color: {{get_static_option('site_main_color_two')}};
            --heading-color: {{get_static_option('site_heading_color')}};
            --paragraph-color: {{get_static_option('site_paragraph_color')}};
        }
    </style>
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 767px;
            width: 100%;
            line-height: 1.4;
            padding: 0px 15px;
        }

        .notfound .notfound-404 {
            position: relative;
            height: 150px;
            line-height: 150px;
            margin-bottom: 25px;
        }

        .notfound .notfound-404 h1 {
            font-family: 'Titillium Web', sans-serif;
            font-size: 186px;
            font-weight: 900;
            margin: 0px;
            text-transform: uppercase;
            color: var(--main-color-one);
        }

        .notfound h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 26px;
            line-height: 36px;
            color: var(--heading-color);
        }
        .notfound h2 {
            font-family: 'Titillium Web', sans-serif;
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            color: var(--heading-color);
        }

        .notfound p {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 0px;
            color: var(--paragraph-color);
            line-height: 29px;
        }

        .notfound a {
             font-family: 'Titillium Web', sans-serif;
            display: inline-block;
            text-transform: uppercase;
            color: #fff;
            text-decoration: none;
            border: none;
            background: var(--secondary-color);
            padding: 10px 40px;
            font-size: 14px;
            font-weight: 700;
            border-radius: 1px;
            margin-top: 15px;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
                line-height: 26px;
        }

        .notfound a:hover {
            background: var(--main-color-one);
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 {
                height: 110px;
                line-height: 110px;
            }
            .notfound .notfound-404 h1 {
                font-size: 120px;
            }
        }
    </style>
</head>
    <body>
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404">
                    <h1>{{__('403')}}</h1>
                    <h3>{{__('USER DOES NOT HAVE THE RIGHT PERMISSIONS.')}}</h3>
                    <a href="{{route('admin.home')}}">{{__('back to Admin Dashboard')}}</a>
                </div>
            </div>
        </div>
    </body>
</html>
