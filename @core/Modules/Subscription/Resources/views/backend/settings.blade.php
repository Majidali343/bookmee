@extends('backend.admin-master')

@section('site-title')
    {{__('Email Notify')}}
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Email Notify')}}  </h4>

                                <form action="#" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @php
                                        $fileds = [1 =>'One Day', 2 => 'Two Day', 3 => 'Three Day', 4 => 'Four Day', 5 => 'Five Day', 6 => 'Six Day', 7=> 'Seven Day'];
                                    @endphp
                                    <div class="form-group  mt-3">
                                        <label for="site_logo">{{__('Select how many days earlier expiration mail alert will be send')}}</label>
                                        <br>
                                        <select name="package_expire_notify_mail_days[]" class="form-control expiration_dates" multiple="multiple" data-placeholder="{{ __('Select Days') }}">

                                            @foreach($fileds as $key => $field)
                                                @php
                                                    $package_expire_notify_mail_days = get_static_option('package_expire_notify_mail_days');
                                                    $decoded = json_decode($package_expire_notify_mail_days) ?? [];
                                                @endphp
                                                <option value="{{$key}}"
                                                @foreach($decoded as  $day)
                                                    {{$day == $key ? 'selected' : ''}}
                                                        @endforeach
                                                >{{__($field)}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $('.expiration_dates').select2();
            });
        })(jQuery)
    </script>
@endsection

