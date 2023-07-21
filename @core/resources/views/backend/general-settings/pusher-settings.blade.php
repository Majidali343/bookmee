@extends('backend.admin-master')

@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection

@section('site-title')
    {{__('Live Chat Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Live Chat Settings")}}</h4>
                        @include('backend/partials/error')
                        <form action="{{route('admin.general.global.pusher.settings')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_id">{{__('Pusher App ID')}}</label>
                                        <input type="text" name="pusher_app_id" id="pusher_app_id" value="{{get_static_option('pusher_app_id')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_key">{{__('Pusher App Key')}}</label>
                                        <input type="text" name="pusher_app_key" id="pusher_app_key" value="{{get_static_option('pusher_app_key')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_secret">{{__('Pusher App Secret')}}</label>
                                        <input type="text" name="pusher_app_secret" id="pusher_app_secret" value="{{get_static_option('pusher_app_secret')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_cluster">{{__('Pusher App Cluster')}}</label>
                                        <input type="text" name="pusher_app_cluster" id="pusher_app_cluster" value="{{get_static_option('pusher_app_cluster')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_push_notification_auth_token">{{__('Buyer: Pusher App (Push Notification) Auth Token')}}</label>
                                        <input type="text" name="pusher_app_push_notification_auth_token"  value="{{get_static_option('pusher_app_push_notification_auth_token')}}" class="form-control">
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_cluster">{{__('Buyer: Pusher App (push notification) Auth URL')}}</label>
                                        <input type="text" name="pusher_app_push_notification_auth_url"  value="{{get_static_option('pusher_app_push_notification_auth_url')}}" class="form-control">
                                    </div>
                                </div> -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_cluster">{{__('Buyer: Pusher App (push notification) Instance ID')}}</label>
                                        <input type="text" name="pusher_app_push_notification_instanceId"  value="{{get_static_option('pusher_app_push_notification_instanceId')}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_push_notification_auth_token">{{__('Seller: Pusher App (Push Notification) Auth Token')}}</label>
                                        <input type="text" name="seller_pusher_app_push_notification_auth_token"  value="{{get_static_option('seller_pusher_app_push_notification_auth_token')}}" class="form-control">
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_cluster">{{__('Seller: Pusher App (push notification) Auth URL')}}</label>
                                        <input type="text" name="seller_pusher_app_push_notification_auth_url"  value="{{get_static_option('seller_pusher_app_push_notification_auth_url')}}" class="form-control">
                                    </div>
                                </div> -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="pusher_app_cluster">{{__('Seller: Pusher App (push notification) Instance ID')}}</label>
                                        <input type="text" name="seller_pusher_app_push_notification_instanceId"  value="{{get_static_option('seller_pusher_app_push_notification_instanceId')}}" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
    <x-media.js/>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>

                $('.summernote').summernote({
                    height: 150,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    }
                });
            });
        }(jQuery));
    </script>
@endsection
