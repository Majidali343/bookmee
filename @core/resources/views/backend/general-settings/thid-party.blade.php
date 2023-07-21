@extends('backend.admin-master')
@section('site-title')
    {{__('Third Party Scripts Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Third Party Scripts Settings")}}</h4>
                        <form action="{{route('admin.general.scripts.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_third_party_tracking_code">{{__('Third Party Api Code')}}</label>
                                <textarea name="site_third_party_tracking_code" id="site_third_party_tracking_code" cols="30" rows="10" class="form-control">{{get_static_option('site_third_party_tracking_code')}}</textarea>
                                <p>{{__('this code will be load before </head> tag')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="site_google_analytics">{{__('Google Analytics')}}</label>
                                <textarea type="text" name="site_google_analytics"  class="form-control" cols="30" rows="10"  id="site_google_analytics">{!! get_static_option('site_google_analytics') !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_site_key">{{__('Google Captcha V3 Site Key')}}</label>
                                <input type="text" name="site_google_captcha_v3_site_key"  class="form-control" value="{{get_static_option('site_google_captcha_v3_site_key')}}" id="site_google_captcha_v3_site_key">
                            </div>
                            <div class="form-group">
                                <label for="site_google_captcha_v3_secret_key">{{__('Google Captcha V3 Secret Key')}}</label>
                                <input type="text" name="site_google_captcha_v3_secret_key"  class="form-control" value="{{get_static_option('site_google_captcha_v3_secret_key')}}" id="site_google_captcha_v3_secret_key">
                            </div>
                            <div class="form-group">
                                <label for="tawk_api_key">{{__('Tawk.to API')}}</label>
                                <textarea name="tawk_api_key" id="tawk_api_key" cols="30" rows="10" class="form-control">{{get_static_option('tawk_api_key')}}</textarea>
                            </div>

                           
                            <div class="form-group">
                                <label for="enable_facebook_login"><strong>{{__('Enable/Disable Facebook Login')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enable_facebook_login"  @if(!empty(get_static_option('enable_facebook_login'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="facebook_client_id">{{__('Facebook Client ID')}}</label>
                                <input type="text" name="facebook_client_id"  class="form-control" value="{{get_static_option('facebook_client_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="facebook_client_secret">{{__('Facebook Client Secret')}}</label>
                                <input type="text" name="facebook_client_secret"  class="form-control" value="{{get_static_option('facebook_client_secret')}}">
                            </div>
                            <p class="info-text">{{__('facebook callback url for your app')}} <code>{{url('/')}}/facebook/callback</code>
                                    <a href="https://bytesed.com/docs/facebook-login/" target="_blank"><i class="fas fa-external-link-alt"></i></a></p>
                            <div class="form-group">
                                <label for="enable_google_login"><strong>{{__('Enable/Disable Google Login')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="enable_google_login"  @if(!empty(get_static_option('enable_google_login'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="google_client_id">{{__('Google Client ID')}}</label>
                                <input type="text" name="google_client_id"  class="form-control" value="{{get_static_option('google_client_id')}}">
                            </div>
                            <div class="form-group">
                                <label for="google_client_secret">{{__('Google Client Secret')}}</label>
                                <input type="text" name="google_client_secret"  class="form-control" value="{{get_static_option('google_client_secret')}}">
                            </div>
                            <p class="info-text">{{__('google callback url for your app')}} <code>{{url('/')}}/google/callback</code>
                                    <a href="https://bytesed.com/docs/google-login/" target="_blank"><i class="fas fa-external-link-alt"></i></a></p>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
