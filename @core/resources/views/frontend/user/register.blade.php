@extends('frontend.frontend-master')

@section('page-meta-data')
    <title>{{ __('User Register') }}</title>
@endsection
@section('content')

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css"
        type="text/css">

    <style>
        .otp-msg-container {
            background: #D1ECF1;
            border: 1px solid #BEE5EB;
            border-radius: 4px;
            height: 47px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 30px;
        }

        .otp-msg-container .text {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 21px;
            display: flex;
            align-items: center;
            color: #0C5460;
        }

        .msform .action-button {
            border: 1px solid #4F7471;
            border-radius: 5px;
            height: 60px;
        }



        #map {
            height: 400px;
            width: 513px;

        }

        .msform .action-buttons {
            background: rgba(3, 152, 158, 1);
            font-weight: 500;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 25px;
            height: 60px;
            width: 137px;
            margin: 40px 92px 5px 10px;
            float: right;
            border: 1px solid rgba(3, 152, 158, 1);
        }

        @media only screen and (max-width: 1000px) {
            .msform .action-buttons {

                margin: 40px 92px 5px 10px;

            }
        }

        .problembutton {
            width: 70px
        }

        @media screen and (max-width: 767px) {

            /* Styles for small screens (mobile devices) */
            #map {
                height: 400px;
                width: 513px;

            }


        }

        @media screen and (max-width: 480px) {

            /* Styles for small screens */
            #map {
                height: 330px;
                width: 350px;

            }

            .problembutton {
                width: 62px
            }

            .msform .action-buttons {

                margin: 40px 60px 5px 20px;

            }
        }

        @media screen and (min-width: 768px) and (max-width: 1023px) {

            /* Styles for medium screens (tablets) */
            #map {
                height: 400px;
                width: 513px;

            }
        }
    </style>
    @php
        
        $reg_type = request()->get('type') ?? 'buyer';
    @endphp
    <!-- Banner Inner area Starts -->
    <div class="banner-inner-area section-bg-2 padding-top-70 padding-bottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-inner-contents text-center">
                        <h2 class="banner-inner-title"> {{ get_static_option('register_page_title') ?? __('Register') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Inner area end -->
    <!-- Register Step Form area starts -->
    <section class="registration-step-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="registration-seller-btn">
                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                            <div class="alert alert-danger" role="alert">
                                {{ get_static_option('register_notice') ?? __('Please be patient!!. Register system is currently disabled. We will come back very soon.') }}
                            </div>
                        @else
                            <ul class="registration-tabs tabs">
                                @if (get_static_option('seller_register_on_off') === 'on')
                                    <li data-tab="tab_one" onCLick="setUserType(1)"
                                        class="is_user_seller @if ($reg_type === 'seller') active @endif">
                                        <div class="single-tabs-registration">
                                            <div class="icon">
                                                <i class="las la-user-alt"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title" id="seller"> {{ 'Customer' }}</h4>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if (get_static_option('buyer_register_on_off') === 'on')
                                    <li data-tab="tab_two" onCLick="setUserType(0)"
                                        class="@if ($reg_type === 'buyer') active @endif is_user_buyer">
                                        <div class="single-tabs-registration">
                                            <div class="icon">
                                                <i class="las la-briefcase"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title" id="buyer"> {{ 'Business' }}</h4>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>

                    <div id="businesshide">

                        {{-- Business work is here  who is seller --}}

                        <div class="tab-content active" id="tab_one">
                            <div class="registration-step-form margin-top-55">
                                <form id="msform-one" class="msform user-register-form" method="post"
                                    action="{{ route('user.register') }}">
                                    @csrf
                                    <ul class="registration-list step-list-two">
                                        <li class="list active">
                                            <a class="list-click" href="javascript:void(0)"><span
                                                    class="list-number">1</span></a>
                                        </li>
                                        <li class="list">
                                            <a class="list-click" href="javascript:void(0)"> <span
                                                    class="list-number">2</span>
                                            </a>
                                        </li>
                                        <li class="list">
                                            <a class="list-click" href="javascript:void(0)"> <span
                                                    class="list-number">3</span>
                                            </a>
                                        </li>
                                        <li class="list">
                                            <a class="list-click" href="javascript:void(0)"> <span
                                                    class="list-number">4</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="text-center mt-5" id="error-message"></div>


                                    <!-- mobile number -->
                                    <fieldset class="fieldset-info user-phone">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>



                                        <div class="information-all margin-top-30">
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Business Number*') }} </label>


                                                        <div style="display: flex">
                                                            <input class="form--control" type="text"
                                                                name="phone_number" value="+44" readonly
                                                                style="width: 43px; padding: 0px 0px 0px 6px; margin-right:8px;">
                                                            <input class="form--control" type="tel" name="phone"
                                                                id="phone" value="{{ old('phone') }}"
                                                                placeholder="{{ __('Type Number') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="Send Confirmation Code" />
                                        @endif
                                    </fieldset>

                                    <!-- otp verify -->
                                    <fieldset class="fieldset-info user-verification">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>
                                        <div class="otp-verify-step margin-top-30">
                                            <h3 class="register-title"> {{ __('Verify Account') }} </h3>
                                            <div class="otp-msg-container" id="otp-msg-container">
                                                <div class="text">
                                                    Check your device OTP has been sent!!!
                                                </div>
                                                <div class="close" onclick="hideOtpMsgContainer()">
                                                    <i class="las la-times"
                                                        style="color: #0C5460;font-size: 30px;font-weight: bold;"></i>
                                                </div>
                                            </div>
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Enter code*') }} </label>
                                                        <input class="form--control" type="text" name="otp_code"
                                                            id="otp_code" value="{{ old('otp_code') }}"
                                                            placeholder="{{ __('Enter code') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="Verify Account" />
                                        @endif
                                    </fieldset>

                                    <fieldset class="fieldset-info user-information">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>

                                        <div class="information-all margin-top-30">
                                            <h3 class="register-title"> {{ __('Business Setup') }} </h3>
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Business Name') }} </label>
                                                        <input class="form--control" type="text" name="name"
                                                            id="" value="{{ old('name') }}"
                                                            placeholder="{{ __('Full Name') }}">
                                                    </div>
                                                </div>
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label">{{ __('Unique Username') }} </label>
                                                        <input class="form--control" type="text" name="username"
                                                            value="{{ old('username') }}" id=""
                                                            placeholder="{{ __('Last Name') }}">
                                                    </div>
                                                </div>
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Email Address') }} </label>
                                                        <input class="form--control" type="text" name="email"
                                                            id="" value="{{ old('email') }}"
                                                            placeholder="{{ __('Type Email') }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="Next" />
                                        @endif
                                    </fieldset>



                                    <!-- Service -->
                                    <fieldset class="fieldset-service service-area">
                                        <h4 style="text-align: center; font-weight:700">
                                            {{ __('Choose Business Location') }} </h4>
                                        <br>
                                        {{-- <div class="mapcontainer">
                                    
                                                                
                                                            </div> --}}
                                        <div style="margin: auto" id="map"></div>

                                        <div class="information-all margin-top-55">
                                            <!-- <h4>Verify Account</h4> -->


                                            <h3 class="register-title"> {{ __('Service Area') }} </h3>


                                            <div class="info-service">
                                                <div class="single-info-service margin-top-30 country-wrapper">
                                                    <div class="single-content">
                                                        <label class="forms-label"> {{ __('Service Country*') }} </label>
                                                        <select name="country" id="country">
                                                            <option value="">{{ __('Select Country') }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->country }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="single-info-service margin-top-30 service_city_wrapper">
                                                    <div class="single-content">
                                                        <label class="forms-label"> {{ __('Service City*') }} </label>
                                                        <select name="service_city" id="service_city"
                                                            class="get_service_city">
                                                            <option value="">{{ __('Select City') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="single-info-service margin-top-30 service_area_wrapper">
                                                    <div class="single-content">
                                                        <label class="forms-label"> {{ __('Service Area*') }} </label>
                                                        <select name="service_area" id="service_area"
                                                            class="get_service_area">
                                                            <option value="">{{ __('Select Area') }}</option>
                                                        </select>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <input type="hidden" name="get_user_type" id="get_user_type" value="0">

                                        <input type="hidden" id="location" name="location" value="">
                                        <input type="hidden" id="latitude" name="latitude" value="">
                                        <input type="hidden" id="longitude" name="longitude" value="">

                                        <input style="border-radius: 5px;" type="submit" name="submit"
                                            class=" next action-buttons problembutton" value="{{ __('Submit') }}" />
                                        <input
                                            style="    background: var(--main-color-two);height: 60px;color: white;border: 1px solid var(--main-color-two);border-radius: 5px;"type="button"
                                            name="previous" class="previous action-button-previous"
                                            value="{{ __('Previous') }}" />
                                    </fieldset>


                                </form>
                            </div>
                        </div>

                    </div>


                    <div class="hidedata" id="customerhide">
                        {{-- customer work is here  who is Buyer --}}

                        <div class="tab-content active" id="tab_one">
                            <div class="registration-step-form margin-top-55">

                                <form id="msform-one" class="msform user-register-form" method="post"
                                    action="{{ route('user.register') }}">
                                    @csrf
                                    <ul class="registration-list step-list-two">
                                        <li class="list active">
                                            <a class="list-click" href="javascript:void(0)"><span
                                                    class="list-number">1</span></a>
                                        </li>
                                        <li class="list">
                                            <a class="list-click" href="javascript:void(0)"> <span
                                                    class="list-number">2</span>
                                            </a>
                                        </li>
                                        <li class="list">
                                            <a class="list-click" href="javascript:void(0)"> <span
                                                    class="list-number">3</span>
                                            </a>
                                        </li>

                                    </ul>
                                    <div class="text-center mt-5" id="error-message"></div>



                                    <!-- mobile number -->
                                    <fieldset class="fieldset-info cuser-phone">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>

                                        <div class="information-all margin-top-30">
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Phone Number*') }} </label>


                                                        <div style="display: flex">
                                                            <input class="form--control" type="text"
                                                                name="phone_number" value="+44" readonly
                                                                style="width: 43px; padding: 0px 0px 0px 6px; margin-right:8px;">
                                                            <input class="form--control" type="tel" name="phone"
                                                                id="cphone" value="{{ old('phone') }}"
                                                                placeholder="{{ __('Type Number') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="Send Confirmation Code" />
                                        @endif
                                    </fieldset>

                                    <!-- otp verify -->
                                    <fieldset class="fieldset-info cuser-verification">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>
                                        <div class="otp-verify-step margin-top-30">
                                            <h3 class="register-title"> {{ __('Verify Account') }} </h3>
                                            <div class="otp-msg-container" id="cotp-msg-container">
                                                <div class="text">
                                                    Check your device OTP has been sent!!!
                                                </div>
                                                <div class="close" onclick="hideOtpMsgContainer()">
                                                    <i class="las la-times"
                                                        style="color: #0C5460;font-size: 30px;font-weight: bold;"></i>
                                                </div>
                                            </div>
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Enter code*') }} </label>
                                                        <input class="form--control" type="text" name="otp_code"
                                                            id="cotp_code" value="{{ old('otp_code') }}"
                                                            placeholder="{{ __('Enter code') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="Verify Account" />
                                        @endif
                                    </fieldset>

                                    <fieldset class="fieldset-info user-information">
                                        {{-- validation error show  --}}
                                        <div class="mt-5">
                                            <x-msg.error />
                                        </div>

                                        <div class="information-all margin-top-30">
                                            <h3 class="register-title"> {{ __('Profile Setup') }} </h3>
                                            <div class="info-forms">
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('First Name') }} </label>
                                                        <input class="form--control" type="text" name="name"
                                                            id="" value="{{ old('name') }}"
                                                            placeholder="{{ __('Full Name') }}">
                                                    </div>
                                                </div>
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label">{{ __('Last Name') }} </label>
                                                        <input class="form--control" type="text" name="username"
                                                            value="{{ old('username') }}" id=""
                                                            placeholder="{{ __('Last Name') }}">
                                                    </div>
                                                </div>
                                                <div class="single-forms">
                                                    <div class="single-content margin-top-30">
                                                        <label class="forms-label"> {{ __('Email Address') }} </label>
                                                        <input class="form--control" type="text" name="email"
                                                            id="" value="{{ old('email') }}"
                                                            placeholder="{{ __('Type Email') }}">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @if (get_static_option('seller_register_on_off') === 'off' && get_static_option('buyer_register_on_off') === 'off')
                                            <input type="button" name="next" class="next action-button form-control"
                                                value="{{ __('Next') }}" disabled />
                                        @else
                                            {{-- <input type="button" name="next" class="next action-button form-control"
                                            value="Next" /> --}}
                                            <input type="hidden" name="get_user_type" id="get_user_type"
                                                value="0">
                                            <input style="border-radius: 5px;width: 100%;" type="submit" name="submit"
                                                class="next action-button" value="{{ __('Submit') }}" />
                                        @endif


                                    </fieldset>



                                </form>

                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </section>
    <!-- Register Step Form area end -->

@endsection
@section('scripts')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibWFqaWQzNDMiLCJhIjoiY2w2NTlteDAxMDQ4eDNrbm43cG81NjhjdSJ9.TOhnLEFgLMsrQZOrCKsWSw';
        const map = new mapboxgl.Map({
            container: 'map',
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [-79.4512, 43.6568],
            zoom: 13
        });

        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        });

        // Add the control to the map.
        map.addControl(geocoder);

        geocoder.on('result', function(e) {
            const latitude = e.result.center[1];
            const longitude = e.result.center[0];
            const locationName = e.result.text;


            document.getElementById("location").value = locationName;
            document.getElementById("latitude").value = latitude;
            document.getElementById("longitude").value = longitude;

            console.log(latitude, longitude, locationName);

        });
    </script>




    <script type="text/javascript">
        function setUserType(type) {

            var Element;
            var element;
            element = document.getElementById('businesshide');
            Element = document.getElementById('customerhide');

            if (type == 0) {


                element.style.display = "block";
                Element.style.display = "none";
            } else if (type == 1) {

                element.style.display = "none";
                Element.style.display = "block";

            }


            document.getElementById('get_user_type').value = type;
        }


        function hideOtpMsgContainer() {
            $('#otp-msg-container').remove();
        }

        function hideOtpMsgContainer() {
            $('#cotp-msg-container').remove();
        }
        (function() {
            "use strict";
            $(document).ready(function() {
                var user_type = "{{ $reg_type === 'buyer' ? 1 : 0 }}";

                $('.cuser-phone .next').on('click', function() {
                    var phone = $('#cphone').val();
                    // validate user information
                    if (phone == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }


                    phone = '+44' + phone;

                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.otp.code') }}",
                        data: {
                            contact_number: phone,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                nextForm('.cuser-phone .next');
                            } else if (res.status == 'error') {
                                //error msg 
                                Command: toastr["warning"](
                                    res.message,
                                    "{{ __('Warning') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false
                            }
                        },
                        error: function(error) {
                            if (!error.responseJSON.errors.phone[0]) return;
                            //error msg 
                            Command: toastr["warning"](
                                error.responseJSON.errors.phone[0],
                                "{{ __('Warning') }}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                    })

                })

                $('.user-phone .next').on('click', function() {
                    var phone = $('#phone').val();
                    // validate user information
                    if (phone == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }


                    phone = '+44' + phone;

                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.otp.code') }}",
                        data: {
                            contact_number: phone,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                nextForm('.user-phone .next');
                            } else if (res.status == 'error') {
                                //error msg 
                                Command: toastr["warning"](
                                    res.message,
                                    "{{ __('Warning') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false
                            }
                        },
                        error: function(error) {
                            if (!error.responseJSON.errors.phone[0]) return;
                            //error msg 
                            Command: toastr["warning"](
                                error.responseJSON.errors.phone[0],
                                "{{ __('Warning') }}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                    })

                })

                //for customer 
                $('.cuser-verification .next').on('click', function() {
                    var otp = $('#cotp_code').val();
                    var phone = $('#cphone').val();
                    // validate user information
                    if (otp == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }

                    phone = '+44' + phone;
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.otp.register.verify.code') }}",
                        data: {
                            contact_number: phone,
                            code: otp,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                nextForm('.cuser-verification .next');
                            } else if (res.status == 'wrong_otp') {
                                Command: toastr["warning"](
                                    res.message,
                                    "{{ __('Warning') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }
                        },
                        error: function(error) {
                            if (!error.responseJSON.errors.phone[0]) return;
                            //error msg 
                            Command: toastr["warning"](
                                error.responseJSON.errors.phone[0],
                                "{{ __('Warning') }}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                    })

                })

                $('.user-verification .next').on('click', function() {
                    var otp = $('#otp_code').val();
                    var phone = $('#phone').val();
                    // validate user information
                    if (otp == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }

                    phone = '+44' + phone;
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.otp.register.verify.code') }}",
                        data: {
                            contact_number: phone,
                            code: otp,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                nextForm('.user-verification .next');
                            } else if (res.status == 'wrong_otp') {
                                Command: toastr["warning"](
                                    res.message,
                                    "{{ __('Warning') }}")
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                return false;
                            }
                        },
                        error: function(error) {
                            if (!error.responseJSON.errors.phone[0]) return;
                            //error msg 
                            Command: toastr["warning"](
                                error.responseJSON.errors.phone[0],
                                "{{ __('Warning') }}")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            return false;
                        }
                    })

                })




                $('.user-information .next').on('click', function() {
                    var name = $('#name').val();
                    var user_name = $('#user_name').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();

                    phone = '+44' + phone;
                    // validate user information
                    if (name == '' || user_name == '' || email == '' || phone == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    else {
                        nextForm('.user-information .next');
                    }
                })





                // change country and get city
                $(document).on('change', '#country', function() {
                    let country_id = $("#country").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions =
                                    "<option value=''>{{ __('Select City') }}</option>";
                                var allList =
                                    "<li class='option' data-value=''>{{ __('Select City') }}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" +
                                        value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city").html(alloptions);
                                $("#service_city").parent().find(".current").html(
                                    "{{ __('Select City') }}");
                                $("#service_city").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html(
                                    "{{ __('Select Area') }}");
                                $(".service_area_wrapper .list").html("");
                            }
                        }
                    })
                })


                // select city and area
                $(document).on('change', '#service_city', function() {
                    var city_id = $("#service_city").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions =
                                    "<option value=''>{{ __('Select Area') }}</option>";
                                var allList =
                                    "<li data-value='' class='option'>{{ __('Select Area') }}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" +
                                        value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html(
                                    "{{ __('Select Area') }}");
                            }
                        }
                    })
                })



                //confirm service area
                $('.service-area .next').on('click', function() {
                    var service_city = $('#service_city').val();
                    var service_area = $('#service_area').val();
                    var country = $('#country').val();


                    $('.get-all-iformation #get_service_city').text(service_city);
                    $('.get-all-iformation #get_service_area').text(service_area);
                    $('.get-all-iformation #get_country').text(country);

                    if (service_city == '' || service_area == '' || country == '') {
                        //error msg 
                        Command: toastr["warning"]("{{ __('Please fill all fields!') }}",
                            "{{ __('Warning') }}")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        return false;
                    }
                    else {
                        nextForm('.service-area .next');
                    }
                })

                $(document).on('submit', '.user-register-form', function(e) {
                    // if (!$('.terms-conditions .check-input').is(":checked")) {
                    //     //error msg 
                    //     Command: toastr["warning"]("{{ __('Please agree with terms and conditions.!') }}","{{ __('Warning') }}")
                    //     toastr.options = {
                    //         "closeButton": true,
                    //         "debug": false,
                    //         "newestOnTop": false,
                    //         "progressBar": true,
                    //         "positionClass": "toast-top-right",
                    //         "preventDuplicates": false,
                    //         "onclick": null,
                    //         "showDuration": "300",
                    //         "hideDuration": "1000",
                    //         "timeOut": "5000",
                    //         "extendedTimeOut": "1000",
                    //         "showEasing": "swing",
                    //         "hideEasing": "linear",
                    //         "showMethod": "fadeIn",
                    //         "hideMethod": "fadeOut"
                    //     }
                    //     return false;
                    // }
                });

            });
        })(jQuery);


        function nextForm(className) {
            var current_fs, next_fs, previous_fs;
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;
            current_fs = $(className).parent();
            next_fs = $(className).parent().next();
            $(".step-list-two li").eq($("fieldset").index(next_fs)).addClass("active");
            next_fs.show();
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
        }
    </script>
@endsection
