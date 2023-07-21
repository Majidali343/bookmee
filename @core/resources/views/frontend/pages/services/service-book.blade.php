@extends('frontend.frontend-page-master')

@section('page-meta-data')
    <title>{{ $service_details_for_book->title }}</title>
@endsection

@section('page-title')
    <?php
    $page_info = request()->url();
    $str = explode('/', request()->url());
    $page_info = $str[count($str) - 2];
    ?>
    {{ __(ucwords(str_replace('-', ' ', $page_info))) }}
@endsection

@section('inner-title')
    {{ $service_details_for_book->title }}
@endsection

@section('style')
    <style>
		  .date-overview .single-date-overview .date-time-list .list:not(:first-child) {
            margin-left: 0px!important;
        }
        .schedule_loader {
            border: 10px solid #f3f3f3;
            /* Light grey */
            border-top: 10px solid var(--main-color-one);
            /* Blue */
            border-radius: 50%;
            width: 70px;
            height: 70px;
            animation: spin 2s linear infinite;
        }

        .flatpickr-months .flatpickr-month {
            background-color: var(--main-color-one) !important;
        }

        .flatpickr-current-month {
            color: #fff !important;
        }

        .flatpickr-current-month input.cur-year {
            color: #fff !important;
        }

        .numInputWrapper span.arrowUp,
        .numInputWrapper span.arrowDown {
            color: #fff !important;
        }

        .flatpickr-current-month .numInputWrapper span.arrowUp:after {
            border-bottom-color: #fff !important;
        }

        .flatpickr-current-month .numInputWrapper span.arrowDown:after {
            border-top-color: #fff !important;
        }

        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            padding: 5px 10px !important;
            color: rgb(255 255 255) !important;
            fill: #ffffff !important;
        }

        .flatpickr-day.today {
            border-color: var(--main-color-one) !important;
        }

        .flatpickr-day.today:hover,
        .flatpickr-day.selected,
        .flatpickr-day.today.selected {
            background-color: var(--main-color-one) !important;
            border-color: var(--main-color-one) !important;
        }

        .flatpickr-day:hover {
            background-color: var(--main-color-one) !important;
            border-color: var(--main-color-one) !important;
            color: #fff !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month {
            background-color: #222222 !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month:hover,
        .flatpickr-current-month .flatpickr-monthDropdown-months:focus .flatpickr-monthDropdown-month,
        .flatpickr-current-month .flatpickr-monthDropdown-months.selected .flatpickr-monthDropdown-month {
            background-color: var(--main-color-one) !important;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width:360px) {
            .flatpickr-calendar.inline {
                width: 100% !important;
            }

            .flatpickr-rContainer {
                width: 100% !important;
            }

            .flatpickr-days {
                width: 100% !important;
            }

            .dayContainer {
                width: 100% !important;
                min-width: auto !important;
                max-width: unset !important;
            }
        }

        .heading {
            color: var(--main-color-one);
            font-family: 'poppins';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 46px;
            display: flex;
            align-items: center;
        }

        .text-recom {
            font-family: 'inter';
            font-style: normal;
            font-weight: 500;
            font-size: 20px;
            line-height: 32px;
            color: var(--main-color-one);
        }

        .bold-text {
            font-family: 'inter';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 24px;
            display: flex;
            align-items: center;
            color: var(--main-color-one);
            justify-content: center;
        }

        .shedulescroll{
            height: 336px;
        overflow-x: hidden;
        overflow-y: scroll;
        } ::-webkit-scrollbar {
        width: 5px;
        }

        @media only screen and (max-width: 600px) {
	      .d-flex{
            flex-direction: column;
          }
          .mr-3{
                margin: auto;
          }

            .shedulescroll{
                height: 436px;
            overflow-x: hidden;
            overflow-y: scroll;
            } ::-webkit-scrollbar {
            width: 5px;
            }
            }

        .overview-list .list.active .list-click .list-number {
            background: none;
            border-color: var(--main-color-two);
            color: var(--main-color-two);
        }

        .overview-single .include-contents .single-include .include-list .lists .list-single .rooms::before,
        .overview-single .overview-benefits .list::before {
            background: var(--main-color-two);
        }

        .price-value,
        .overview-summery-contents .single-summery .summery-list-all .summery-result-list .result-list .rooms strong,
        .summery-title {
            color: var(--main-color-two) !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/common/css/flatpickr.min.css') }}">
@endsection

@section('content')
    @php
        $service_country = optional(optional($service_details_for_book->serviceCity)->countryy)->id;
        $country_tax = App\Tax::select('id', 'tax')
            ->where('country_id', $service_country)
            ->first();
    @endphp
    <!-- Location Overview area starts -->
    <section class="location-overview-area padding-top-100">
        <div class="container">
            <div class="row" style=" margin-right: 2px; margin-left: 1px;">
                <div class="col-lg-12">
                    <form action="{{ route('service.create.order') }}" id="msform" class="msform ms-order-form"
                        method="post" name="msOrderForm" enctype="multipart/form-data" novalidate>
                        @csrf
                        @if (!empty($service_details_for_book))
                            <ul class="overview-list step-list">
                                @if ($service_details_for_book->is_service_online != 1)
                                    {{-- <li class="list active" id="account">
                                        <a class="list-click" href="javascript:void(0)"> <span class="list-number">1</span>{{ __('Location') }}</a>
                                    </li> --}}
                                    <li class="list active">
                                        <a class="list-click" href="javascript:void(0)"> <span
                                                class="list-number">1</span>{{ __('Appointment') }}</a>
                                    </li>
                                    {{-- <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> <span
                                                class="list-number">2</span>{{ __('Date & Time') }}</a>
                                    </li> --}}
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> <span
                                                class="list-number">2</span>{{ __('Information') }}</a>
                                    </li>
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> <span class="list-number">3</span>
                                            {{ __('Confirmation') }} </a>
                                    </li>
                                @else
                                    <li class="list active">
                                        <a class="list-click" href="javascript:void(0)"> <span
                                                class="list-number">1</span>{{ __('Appointment') }}</a>
                                    </li>
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> <span
                                                class="list-number">2</span>{{ __('Information') }}</a>
                                    </li>
                                    <li class="list">
                                        <a class="list-click" href="javascript:void(0)"> <span class="list-number">3</span>
                                            {{ __('Confirmation') }} </a>
                                    </li>
                                @endif
                            </ul>



                            {{-- adding address info --}}
                            <input type="text" id="address" style="display:none;"
                                value="{{ $service_details_for_book->seller->address }}">



                            <!-- Location -->
                            {{-- <div> <x-msg.error_for_service_book/> <x-session-msg/> </div> --}}
                            {{-- @if ($service_details_for_book->is_service_online != 1)
                                <fieldset class="padding-top-20 padding-bottom-100 confirm-location" style="width: 100%;">
                                    <div class="overview-list-all">
                                        <h5 class="mt-4 mb-5" style="color: rgba(51, 51, 51, 1);"> <b>Please select your Service location</b> </h4>

                                        <!-- <div class="alert alert-info fade in alert-dismissible show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true" style="font-size:20px">×</span>
                                            </button>
                                            <strong>{{__('Info!')}}</strong> {{__('This service is available only selected country and city')}}
                                        </div> -->

                                        <div class="overview-location">
                                            <!-- <div class="single-location active margin-top-30 wow fadeInUp" data-wow-delay=".3s">
                                                <span class="location">{{ __('Your Location') }} </span>
                                                @if (Auth::guard('web')->check())
                                                    <span class="location loacation_add country_name">{{ optional(Auth::guard('web')->user()->country)->country }}</span>
                                                    <span class="location loacation_add city_name">{{ optional(Auth::guard('web')->user()->city)->service_city }}</span>
                                                    <span class="location loacation_add area_name">{{ optional(Auth::guard('web')->user()->area)->service_area }}</span>

                                                @else
                                                    <span class="location loacation_add country_name"></span>
                                                    <span class="location loacation_add city_name"></span>
                                                    <span class="location loacation_add area_name"></span>

                                                @endif
                                            </div> -->
                                            <div class="select_city_area_country">
                                                <label for="" class="location">{{ __('Service Country') }}</label>
                                                <select name="choose_service_country" id="choose_service_country" class="form-control">
                                                    @if (!empty($country))
                                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="select_city_area_country">
                                                <label for="choose_service_city"
                                                       class="location">{{ __('Service City') }}</label>
                                                <select name="choose_service_city" id="choose_service_city" class="get_service_city">
                                                    @if ($service_details_for_book->is_service_all_cities === 1)
                                                        @php $cities = App\ServiceCity::select('id','service_city')->where('country_id',$service_country)->get(); @endphp

                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                                        @endforeach
                                                    @else
                                                        @if (!empty($city))
                                                            <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                                        @endif
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="select_city_area_country">
                                                <label for="choose_service_area"
                                                       class="location">{{ __('Choose Area') }}</label>
                                                <select name="choose_service_area" id="choose_service_area" class="get_service_area">
                                                       <option value="">{{ __('Select Area') }}</option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{ $area->id }}">{{ $area->service_area }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @if (get_static_option('order_create_settings') == 'anyone')
                                        <input type="button" name="next" class="next action-button" value="{{__('Next')}}" />
                                    @else
                                        @if (Auth::guard('web')->check())
                                            <input type="button" name="next" class="next action-button" value="{{__('Next')}}" />
                                        @else
                                            <div class="btn-wrapper">
                                                <a class="action-button text-white" href="{{route('user.login')}}?return={{request()->path()}}">{{ __('Sign In') }}</a>
                                            </div>
                                        @endif
                                    @endif

                                </fieldset>
                            @endif --}}
                            <!-- Service -->
                            <fieldset class="padding-top-20 padding-bottom-100 confirm-service" style="width: 100%;">
                                <div class="row">
                                    @if ($service_details_for_book->is_service_online != 1)
                                        <div class="date-overview">
                                            <div class="d-flex ">

                                                <div class="mr-3">
                                                    <div class="single-date-overview margin-top-30">
                                                        <h4 class="date-time-title">
                                                            {{ get_static_option('service_available_date_title') ?? __('Available Date') }}
                                                        </h4>
                                                        <div class="calendar-area margin-top-30">
                                                            <input type="date" name="service_available_dates"
                                                                id="service_available_dates" class="d-none">
                                                            <ul class="date-time-list margin-top-20 show-date">
                                                                <span class="seller-id-for-schedule"
                                                                    style="display:none">{{ $service_details_for_book->seller_id }}</span>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class=" margin-top-30">
                                                    <h4 class="date-time-title">
                                                        {{ get_static_option('service_available_schudule_title') ?? __('Available Time Slots') }}
                                                    </h4>
                                                    <div class="single-date-overview " id="addingremove">
                                                        
                                                        <ul class="date-time-list margin-top-20 show-schedule">

                                                        </ul>
                                                        <div class="schedule_loader"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-8 margin-top-30">
                                        <div class="service-overview-wrapper padding-bottom-30">
                                            {{-- <div class="overview-author overview-author-border">
                                                <div class="overview-flex-author">
                                                    <div class="overview-thumb">
                                                        {!! render_image_markup_by_attachment_id($service_details_for_book->image) !!}
                                                    </div>
                                                    <div class="overview-contents">
                                                        <h4 class="overview-title"> <a
                                                                style="color: rgba(51, 51, 51, 1)"\href="{{ route('service.list.details', $service_details_for_book->slug) }}">{{ $service_details_for_book->title }}</a>
                                                        </h4>
                                                        @if ($service_details_for_book->reviews->count() >= 1)
                                                            <span class="overview-review"> {{ __('Rating:') }}
                                                                {{ round(optional($service_details_for_book->reviews)->avg('rating'), 1) }}
                                                                <b>({{ optional($service_details_for_book->reviews)->count() }})</b>
                                                            </span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="overview-single padding-top-40">
                                                <h4 class="title">
                                                    {{ get_static_option('service_main_attribute_title') ?? __('Services') }}
                                                </h4>
                                                <div class="include-contents margin-top-30">
                                                    @foreach ($service_includes as $include)
                                                        <div class="single-include include_service_id_{{ $include->id }}">
                                                            <ul class="include-list">
                                                                <li class="lists">
                                                                    <div class="list-single">
                                                                        <span
                                                                            class="rooms">{{ $include->include_service_title }}</span>
                                                                    </div>

                                                                    @if ($service_details_for_book->is_service_online != 1)
                                                                        <div class="list-single">
                                                                            <span style="color: rgba(3, 152, 158, 1)"
                                                                                class="values"
                                                                                id="include_service_unit_price_{{ $include->id }}">
                                                                                ₹ {{ $include->include_service_price }}
                                                                            </span>
                                                                            <span class="value-input">
                                                                                <input type="number" min="1"
                                                                                    class="inc_dec_include_service"
                                                                                    data-id="{{ $include->id }}"
                                                                                    data-price="{{ $include->include_service_price }}"
                                                                                    value="{{ $include->include_service_quantity }}">
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                                {{-- @if ($service_details_for_book->is_service_online != 1)
                                                                    <li class="lists remove-service-list"
                                                                        data-id="{{ $include->id }}">
                                                                        <a class="remove" style="color: red"
                                                                            href="javascript:void(0)">{{ __('Remove') }}
                                                                        </a>
                                                                    </li>
                                                                @endif --}}
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{-- <div class="overview-single padding-top-60">
                                                <h4 class="title">
                                                    {{ get_static_option('service_benifits_title') ?? __('Benefits of the Package:') }}
                                                </h4>
                                                <ul class="overview-benefits margin-top-30">
                                                    @foreach ($service_benifits as $benifit)
                                                        <li class="list">{{ $benifit->benifits }}</li>
                                                    @endforeach
                                                </ul>
                                            </div> --}}
                                            {{-- <div class="overview-single padding-top-60 extra-services">
                                                <h4 class="title">
                                                    {{ get_static_option('service_additional_attribute_title') ?? __('Upgrade your order with extras') }}
                                                </h4>
                                                <div class="row">
                                                    @foreach ($service_additionals as $additional)
                                                        <div class="col-lg-6 margin-top-30">
                                                            <div class="overview-extra">
                                                                <div class="checkbox-inlines">
                                                                    <input class="check-input" type="checkbox"
                                                                        id="{{ $additional->id }}"
                                                                        value="{{ $additional->id }}">
                                                                    <label class="checkbox-label"
                                                                        for="{{ $additional->id }}">
                                                                        {{ $additional->additional_service_title }}
                                                                    </label>
                                                                </div>
                                                                <div class="overview-extra-flex-content">
                                                                    <div class="list-single">
                                                                        <span class="values"
                                                                            price="{{ $additional->id }}"
                                                                            style="color: rgba(35, 56, 87, 1);">
                                                                            {{ $additional->additional_service_price }}
                                                                        </span>
                                                                        <span class="value-input">
                                                                            <input type="number" min="1"
                                                                                class="inc_dec_additional_service"
                                                                                id="additional_service_quantity_{{ $additional->id }}"
                                                                                data-id="{{ $additional->id }}"
                                                                                data-price="{{ $additional->additional_service_price }}"
                                                                                value="{{ $additional->additional_service_quantity }}">
                                                                        </span>
                                                                    </div>
                                                                    <span class="price-value"
                                                                        style="color: rgba(35, 56, 87, 1);">
                                                                        ₹ {{ $additional->additional_service_price }}
                                                                    </span>
                                                                    <div class="overview-extra-thumb">
                                                                        {!! render_image_markup_by_attachment_id($additional->additional_service_image) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div> --}}


                                            @if ($service_details_for_book->is_service_online == 1)
                                                @if ($service_faqs && count($service_faqs) > 0)
                                                    <div class="faq-area" data-padding-top="70" data-padding-bottom="100">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-12 margin-top-30">
                                                                    <div class="faq-contents">

                                                                        @foreach ($service_faqs as $faq)
                                                                            @if (empty($faq->title))
                                                                                @continue
                                                                            @endif
                                                                            <div class="faq-item">
                                                                                <div class="faq-title">
                                                                                    {{ $faq->title }}
                                                                                </div>
                                                                                <div class="faq-panel">
                                                                                    <p class="faq-para">
                                                                                        {{ $faq->description }}</p>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>


                                    </div>

                                    <div class="col-lg-4 margin-top-30">
                                        <div class="service-overview-summery" style="color: rgba(35, 56, 87, 1);">
                                            <h4 class="title">
                                                {{ get_static_option('service_booking_title') ?? __('Booking Summery') }}
                                            </h4>

                                            <span class="summery-title"  style="color: rgba(35, 56, 87, 1);  font-weight: bold; "    >
                                                {{ get_static_option('service_extra_title') ?? __(' Service') }}</span>
                                            <div class="overview-summery-contents">
                                                <div class="single-summery">
                                                    <span class="summery-title" style="color:rgba(35, 56, 87, 1)">
                                                        @if ($service_details_for_book->is_service_online != 1)
                                                            {{-- {{ get_static_option('service_appoinment_package_title') ?? __('Appointment Package Service') }} --}}
                                                        @else
                                                            <ul class='onlilne-special-list '>
                                                                <li><i class="las la-clock"></i>
                                                                    {{ __('Delivery Days') . ': ' . $service_details_for_book->delivery_days }}
                                                                </li>
                                                                <li class="margin-bottom-30"><i
                                                                        class="las la-redo-alt"></i>
                                                                    {{ __('Revisions') . ': ' . $service_details_for_book->revision }}
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    </span>
                                                    <div class="summery-list-all">
                                                        @if ($service_details_for_book->is_service_online == 1)
                                                            <span
                                                                class="summery-title">{{ __('Included Service') }}</span>
                                                        @endif
                                                        <ul class="summery-list">
                                                            @foreach ($service_includes as $include)
                                                                <li class="list include_service_id_{{ $include->id }}">
                                                                    <span
                                                                        class="rooms">{{ $include->include_service_title }}
                                                                    </span>
                                                                    @if ($service_details_for_book->is_service_online != 1)
                                                                        <span class="value-count service_quantity_count"
                                                                            id="include_service_quantity_2_{{ $include->id }}"
                                                                            style="color: rgba(3, 152, 158, 1);">{{ $include->include_service_quantity }}
                                                                        </span>
                                                                        <span class="room-count">₹
																			 <span>

                                                                                {{ $include->include_service_price }}
                                                                            </span>
                                                                           
                                                                        </span>
                                                                    @endif

                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        {{-- <ul class="summery-result-list">
                                                            <li class="result-list">
                                                                <span class="rooms">
                                                                    {{ get_static_option('service_package_fee_title') ?? __('Package Fee') }}</span>
                                                                <span class="value-count package-fee">₹
                                                                    {{ $service_details_for_book->price }}</span>
                                                            </li>
                                                        </ul> --}}
                                                    </div>
                                                </div>
                                                <div class="single-summery">
                                                   
                                                    <div class="summery-list-all">
                                                        {{-- <ul class="summery-list extra-service-list">

                                                        </ul> --}}
                                                        <input type="hidden"
                                                            name="package_fee_input_hiddend_field_for_js_calculation"
                                                            value="{{ $service_details_for_book->price }}">
                                                        {{-- <ul class="summery-result-list result-border padding-bottom-20">
                                                            <li class="result-list">
                                                                <span
                                                                    class="rooms">{{ get_static_option('service_extra_title') ?? __('Service') }}</span>
                                                                <span
                                                                    class="value-count extra-service-fee">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul> --}}
                                                        <ul class="summery-result-list result-border padding-bottom-20">
                                                            <li class="result-list">
                                                                <span
                                                                    class="rooms">{{ get_static_option('service_subtotal_title') ?? __('Subtotal') }}</span>
                                                                <span
                                                                    class="value-count service-subtotal">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="summery-result-list result-border padding-bottom-20">
                                                            <li class="result-list">
                                                                <span class="rooms"> {{ __('Tax(+)') }} <span
                                                                        class="service-tax">{{ optional($country_tax)->tax ?? 0 }}</span>
                                                                    %</span>
                                                                <span
                                                                    class="value-count tax-amount">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <input type="hidden"
                                                            name="service_subtotal_input_hidden_field_for_js_calculation"
                                                            value="">
                                                        <ul class="summery-result-list">
                                                            <li class="result-list">
                                                                <span class="rooms">
                                                                    <strong>{{ get_static_option('service_total_amount_title') ?? __('Total') }}</strong></span>
                                                                <span
                                                                    class="value-count total-amount">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($service_details_for_book->is_service_online == 1)
                                    @if (Auth::guard('web')->check())
                                        <input type="button" name="next" class="next action-button"
                                            style="background-color: rgba(3, 152, 158, 1);"
                                            value="{{ __('Next') }}" />
                                    @else
                                        <div class="btn-wrapper">
                                            <a class="action-button text-white"
                                                href="{{ route('user.login') }}?return={{ request()->path() }}">{{ __('Sign In') }}</a>
                                        </div>
                                    @endif
                                @else
                                    <input type="button" name="next" class="next action-button"
                                        style="background-color: rgba(3, 152, 158, 1);" value="{{ __('Next') }}" />
                                @endif



                            </fieldset>
                            <!-- Date & Time -->
                            {{-- @if ($service_details_for_book->is_service_online != 1)
                                <fieldset class="padding-top-20 padding-bottom-100 confirm-date-time"
                                    style="width: 100%;">
                                    <div class="date-overview">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="single-date-overview margin-top-30">
                                                    <h4 class="date-time-title">
                                                        {{ get_static_option('service_available_date_title') ?? __('Available Date') }}
                                                    </h4>
                                                    <div class="calendar-area margin-top-30">
                                                        <input type="date" name="service_available_dates"
                                                            id="service_available_dates" class="d-none">
                                                        <ul class="date-time-list margin-top-20 show-date">
                                                            <span class="seller-id-for-schedule"
                                                                style="display:none">{{ $service_details_for_book->seller_id }}</span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="single-date-overview margin-top-30">
                                                    <h4 class="date-time-title">
                                                        {{ get_static_option('service_available_schudule_title') ?? __('Available Schedule') }}
                                                    </h4>
                                                    <ul class="date-time-list margin-top-20 show-schedule">

                                                    </ul>
                                                    <div class="schedule_loader"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button"
                                        style="background-color: rgba(3, 152, 158, 1);" value="{{ __('Next') }}" />
                                    <input type="button" name="previous" class="previous action-button-previous"
                                        style="border: rgba(3, 152, 158, 1);" value="{{ __('Previous') }}" />
                                </fieldset>
                            @endif --}}
                            <!-- Information -->
                            <fieldset class="padding-top-20 padding-bottom-100 confirm-information" style="width: 100%;">
                                <div class="Info-overview padding-top-30">
                                    <h3 class="date-time-title">
                                        {{ get_static_option('service_booking_information_title') ?? __('Booking Information') }}
                                    </h3>
                                    <div class="single-info-overview margin-top-30">
                                        <div class="single-info-input">
                                            <label class="info-title"> {{ __('Your Name*') }} </label>
                                            <input class="form--control" type="text" name="name" id="name"
                                                placeholder="{{ __('Type Your Name') }}"
                                                @if (Auth::guard('web')->check()) value="{{ Auth::user()->name }}" @else value="" @endif>
                                        </div>
                                        <div class="single-info-input">
                                            <label class="info-title"> {{ __('Your Email*') }} </label>
                                            <input class="form--control" type="email" name="email" id="email"
                                                placeholder="{{ __('Type Your Email') }}"
                                                @if (Auth::guard('web')->check()) value="{{ Auth::user()->email }}" @else value="" @endif>
                                        </div>
                                    </div>
                                    <div class="single-info-overview margin-top-30">
                                        <div class="single-info-input">
                                            <label class="info-title"> {{ __('Phone Number*') }} </label>
                                            <input class="form--control" type="text" name="phone" id="phone"
                                                placeholder="{{ __('Type Your Number') }}"
                                                @if (Auth::guard('web')->check()) value="{{ Auth::user()->phone }}" @else value="" @endif>
                                        </div>
                                        {{-- <div class="single-info-input">
                                            <label class="info-title"> {{ __('Post Code*') }} </label>
                                            <input class="form--control" type="text" name="post_code" id="post_code"
                                                placeholder="{{ __('Type Post Code') }}"
                                                @if (Auth::guard('web')->check()) value="{{ Auth::user()->post_code }}" @else value="" @endif>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="single-info-overview margin-top-30">
                                        <div class="single-info-input">
                                            <label class="info-title"> {{ __('Your Address*') }} </label>
                                            <input class="form--control" type="text" name="address" id="address"
                                                placeholder="{{ __('Type Your Address') }}"
                                                @if (Auth::guard('web')->check()) value="{{ Auth::user()->address }}" @else value="" @endif>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="single-info-overview margin-top-30">
                                        <div class="single-info-input">
                                            <label class="info-title">{{ __('Order Note') }} </label>
                                            <textarea class="form--control textarea--form" name="order_note" id="order_note"
                                                placeholder="{{ __('Type Order Note') }}"></textarea>
                                            <span>{{ __('Max: 190 Character') }}</span>
                                        </div>
                                    </div> --}}
                                </div>
                                <input type="button" name="next" class="next action-button"
                                    value="{{ __('Next') }}" />
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="{{ __('Previous') }}" />
                            </fieldset>
                            <!-- Confirmation -->
                            <fieldset class="padding-top-20 padding-bottom-100" style="width: 100%;">
                                <input type="hidden" id="service_id" value="{{ $service_details_for_book->id }}">
                                <input type="hidden" id="seller_id" value="{{ $service_details_for_book->seller_id }}">
                                <div class="confirm-overview padding-top-30">
                                    <div class="overview-author overview-author-border">
                                        <div class="overview-flex-author">
                                            {{-- <div class="overview-thumb confirm-thumb">
                                                {!! render_image_markup_by_attachment_id($service_details_for_book->image, '', 'thumb') !!}
                                            </div> --}}
                                            <div class="overview-contents">
                                                <h2 class="overview-title confirm-title"> <a
                                                        href="{{ route('service.list.details', $service_details_for_book->slug) }}">{{ $service_details_for_book->title }}</a>
                                                </h2>
                                                @if ($service_details_for_book->reviews->count() >= 1)
                                                    <span class="overview-review"> {{ __('Rating:') }}
                                                        {{ round(optional($service_details_for_book->reviews)->avg('rating'), 1) }}
                                                        <b>({{ optional($service_details_for_book->reviews)->count() }})</b>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="confirm-overview-left margin-top-30">
                                            @if ($service_details_for_book->is_service_online != 1)
                                                <div class="single-confirm-overview">
                                                    <div class="single-confirm margin-top-30"
                                                        style="background: rgba(189, 205, 229, 0.2);border-radius: 20px;">
                                                        <div class="heading" style="font-size: 32px; margin-bottom:22px;">
                                                            <img src="https://i.imgur.com/gow3Ldc.png" width="20px"
                                                                height="26px" style="margin-right:20px"> Address
                                                        </div>
                                                        <div class="text-recom">
                                                            {{ $service_details_for_book->seller->address }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-confirm margin-top-30">
                                                    <div class="heading"
                                                        style="color: #333333;font-size: 32px;margin-bottom:40px;">
                                                        {{ __('Date & Time') }}</div>
                                                    <div class="time-date  d-flex flex-coloum" style=" flex-direction: column;">
                                                        <div style="display-flex ;flex-direction :row ;margin-right:80px ; height:45px">
                                                            {{-- <img src="https://i.imgur.com/oy2qijt.png" width="46px"
                                                                height="46px"><br /> --}}

                                                               <span style="font-family: inter ; font-weight:bold ; font-size:19px ; color:black" >Date :  </span> 
                                                            <span style="font-size: 18px;
                                                            font-weight: bold;
                                                            color: #322f2f;
                                                            font-family: inherit;
                                                            padding-left: 26px;" class=" available_date "></span>
                                                        </div>
                                                        
                                                        <div style="display-flex ;flex-direction :row ;margin-right:80px ;height:45px " >
                                                            {{-- <img src="https://i.imgur.com/mxnAdsU.png" width="46px"
                                                                height="46px"> --}}
                                                                <span style="font-family: inter ; font-weight:bold ; font-size:19px ; color:black">Time :  </span>
                                                           <span style="font-size: 18px;font-weight: bold; color: #322f2f; font-family: inherit; padding-left: 26px;" class=" available_schedule ">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="booking-info padding-top-60">
                                                <h2 class="title">{{ __('Booking Information') }}</h2>
                                                <div class="booking-details">
                                                    <ul class="booking-list">
                                                        <li class="lists">
                                                            <span class="list-span"> {{ __('Name:') }} </span>
                                                            <span class="list-strong get_name"></span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span">{{ __('Email:') }}</span>
                                                            <span class="list-strong get_email"></span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span">{{ __('Phone:') }}</span>
                                                            <span class="list-strong get_phone"></span>
                                                        </li>
                                                        {{-- <li class="lists">
                                                            <span class="list-span">{{ __('Post Code:') }}</span>
                                                            <span class="list-strong get_post_code"></span>
                                                        </li> --}}
                                                        {{-- <li class="lists">
                                                            <span class="list-span">{{ __('Address:') }}</span>
                                                            <span class="list-strong get_address"></span>
                                                        </li> --}}
                                                        {{-- <li class="lists">
                                                            <span class="list-span">{{ __('Order Note:') }}</span>
                                                            <span class="list-strong get_order_note"></span>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin-top-60">
                                        <div class="service-overview-summery">
                                            <h4 class="title">
                                                {{ get_static_option('service_booking_title') ?? __('Booking Summery') }}
                                            </h4>

                                            <P style="font-weight: bold;     font-family: 'Inter';
                                            font-size: 19px;
                                            color: black; ">Service</P>
                                            <div class="overview-summery-contents">
                                                <div class="single-summery">
                                                    {{-- @if ($service_details_for_book->is_service_online != 1)
                                                        {{ get_static_option('service_appoinment_package_title') ?? __('Appointment Package Service') }}
                                                    @else
                                                        <ul class='onlilne-special-list '>
                                                            <li><i class="las la-clock"></i>
                                                                {{ __('Delivery Days') . ': ' . $service_details_for_book->delivery_days }}
                                                            </li>
                                                            <li class="margin-bottom-30"><i class="las la-redo-alt"></i>
                                                                {{ __('Revisions') . ': ' . $service_details_for_book->revision }}
                                                            </li>
                                                        </ul>
                                                    @endif --}}
                                                    <div class="summery-list-all">
                                                        @if ($service_details_for_book->is_service_online == 1)
                                                            <span
                                                                class="summery-title">{{ __('Included Service') }}</span>
                                                        @endif
                                                        <ul class="summery-list ">
                                                            @foreach ($service_includes as $include)
                                                                <li
                                                                    class="list include_service_id_{{ $include->id }} include_service_list">
                                                                    <input type="hidden" class="includeServiceID"
                                                                        value="{{ $include->id }}">
                                                                    <span
                                                                        class="rooms">{{ $include->include_service_title }}</span>
                                                                    @if ($service_details_for_book->is_service_online != 1)
                                                                        <span
                                                                            class="value-count include_service_quantity service_quantity_count"
                                                                            id="include_service_quantity_3_{{ $include->id }}">{{ $include->include_service_quantity }}</span>
                                                                        <span
                                                                            class="room-count">{{ amount_with_currency_symbol($include->include_service_price) }}</span>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        {{-- <ul class="summery-result-list">
                                                            <li class="result-list">
                                                                <span class="rooms">
                                                                    {{ get_static_option('service_package_fee_title') ?? __('Package Fee') }}</span>
                                                                <span
                                                                    class="value-count package-fee">{{ amount_with_currency_symbol($service_details_for_book->price) }}</span>
                                                            </li>
                                                        </ul> --}}
                                                    </div>
                                                </div>
                                                <div class="single-summery">
                                                    {{-- <span
                                                        class="summery-title">{{ get_static_option('service_extra_title') ?? __('Extra Service') }}</span> --}}
                                                    <div class="summery-list-all">
                                                        {{-- <ul class="summery-list extra-service-list-2">

                                                        </ul> --}}
                                                        <ul class="summery-result-list result-border padding-bottom-20" hidden>
                                                            <li class="result-list">
                                                                <span
                                                                    class="rooms">{{ get_static_option('service_extra_title') ?? __('Extra Service') }}</span>
                                                                <span
                                                                    class="value-count extra-service-fee">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="summery-result-list result-border padding-bottom-20">
                                                            <li class="result-list">
                                                                <span
                                                                    class="rooms">{{ get_static_option('service_subtotal_title') ?? __('Subtotal') }}</span>
                                                                <span
                                                                    class="value-count service-subtotal">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="summery-result-list result-border padding-bottom-20">
                                                            <li class="result-list">
                                                                <span class="rooms"> {{ __('Tax(+)') }}
                                                                    <span>{{ optional($country_tax)->tax ?? 0 }}</span>
                                                                    %</span>
                                                                <span
                                                                    class="value-count tax-amount">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="summery-result-list">
                                                            <li class="result-list">
                                                                <span class="rooms">
                                                                    <strong>{{ get_static_option('service_total_amount_title') ?? __('Total') }}</strong></span>
                                                                <span
                                                                    class="value-count total-amount total_amount_for_coupon"
                                                                    id="total_amount_for_coupon">{{ amount_with_currency_symbol(0) }}</span>
                                                            </li>
                                                        </ul>
                                                        <ul class="summery-result-list">
                                                            <li class="result-list coupon_amount_for_apply_code"></li>
                                                        </ul>
                                                        <ul class="summery-result-list coupon_input_field">
                                                            <li class="result-list">
                                                                <input type="text" name="coupon_code"
                                                                    class="form-control coupon_code"
                                                                    placeholder="{{ __('Enter Coupon Code') }}">
                                                                <button class="apply-coupon">{{ __('Apply') }}</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                {{-- //manual payment  --}}

                                                <div class="confirm-bottom-content">
                                                    <div class="confirm-payment payment-border">
                                                        @if (moduleExists('Wallet'))
                                                            {!! \App\Helpers\PaymentGatewayRenderHelper::renderWalletForm() !!}
                                                        @endif
                                                        <div class="single-checkbox">
                                                            <div class="checkbox-inlines">
                                                                <label class="checkbox-label" for="check2">
                                                                    {!! \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(
                                                                        $service_details_for_book->is_service_online != 1,
                                                                    ) !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="checkbox-inlines bottom-checkbox terms-and-conditions">
                                                        <input class="check-input" type="checkbox" id="check3">
                                                        <label class="checkbox-label"
                                                            for="check3">{{ __('I agree with') }}
                                                            <a href="{{ get_static_option('terms_and_conditions_link') ?? '#' }}"
                                                                target="_blank">{{ __('terms and conditions *') }}</a></label>
                                                    </div>
                                                </div>
                                                {{-- form inputs  --}}

                                                <input type="hidden" name="service_id"
                                                    value="{{ $service_details_for_book->id }}">
                                                <input type="hidden" name="seller_id"
                                                    value="{{ optional($service_details_for_book->seller)->id }}">
                                                @if ($service_details_for_book->is_service_online == 1)
                                                    <input type="hidden" name="is_service_online_"
                                                        value="{{ $service_details_for_book->is_service_online }}">
                                                    <input type="hidden" name="online_service_package_fee"
                                                        value="{{ $service_details_for_book->price }}">
                                                @endif
                                                <input type="hidden" name="date">
                                                <input type="hidden" name="schedule">
                                                <input type="hidden" id="payment_form_services" name="services[]">
                                                <input type="hidden" id="payment_form_additionals" name="additionals[]">
                                                <div class="btn-wrapper">
                                                    @if ($service_details_for_book->is_service_online == 1)
                                                        @if (Auth::guard('web')->check())
                                                            <button type="submit"
                                                                class="cmn-btn btn-appoinment btn-bg-1">{{ get_static_option('service_order_confirm_title') ?? __('Pay & Confirm Your Order') }}
                                                            </button>
                                                        @else
                                                            <a class="cmn-btn btn-appoinment btn-bg-1"
                                                                href="{{ route('user.login') }}?return={{ request()->path() }}">{{ __('Sign In') }}</a>
                                                            <small
                                                                class="text-danger">{{ __('Must login to create order for online services') }}</small>
                                                        @endif
                                                    @else
                                                        <button type="submit"
                                                            class="cmn-btn btn-appoinment btn-bg-1">{{ get_static_option('service_order_confirm_title') ?? __('Pay & Confirm Your Order') }}
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="signup-area padding-top-70 padding-bottom-100">
                        <div class="container">
                            <div class="signup-wrapper">
                                <div class="signup-contents">
                                    <h3 class="signup-title">
                                        {{ get_static_option('login_form_title') ?? __('Sign In') }}</h3>

                                    @if (Session::has('msg'))
                                        <p class="alert alert-{{ Session::get('type') ?? 'success' }}">
                                            {{ Session::get('msg') }}</p>
                                    @endif
                                    <div class="error-message"></div>

                                    <form class="signup-forms" action="{{ route('user.login.online') }}"
                                        method="post">
                                        @csrf
                                        <div class="single-signup margin-top-30">
                                            <label class="signup-label"> {{ 'User Name*' }} </label>
                                            <input class="form--control" type="text" name="username" id="username"
                                                placeholder="{{ __('Username') }}">
                                        </div>
                                        <div class="single-signup margin-top-30">
                                            <label class="signup-label"> {{ __('Password*') }} </label>
                                            <input class="form--control" type="password" name="password" id="password"
                                                placeholder="{{ __('Password') }}">
                                        </div>
                                        <div class="signup-checkbox">
                                            <div class="checkbox-inlines">
                                                <input class="check-input" name="remember" id="remember"
                                                    type="checkbox" id="check8">
                                                <label class="checkbox-label" for="remember">
                                                    {{ __('Remember me') }}</label>
                                            </div>
                                            <div class="forgot-btn">
                                                <a href="{{ route('user.forget.password') }}" class="forgot-pass">
                                                    {{ __('Forgot Password') }}</a>
                                            </div>
                                        </div>
                                        <button id="signin_form" type="submit">{{ __('Login Now') }}</button>
                                        <span class="bottom-register"> {{ __('Do not have Account?') }} <a
                                                class="resgister-link" href="{{ route('user.register') }}">
                                                {{ __('Register') }} </a> </span>
                                    </form>

                                    <div class="social-login-wrapper">
                                        @if (get_static_option('enable_google_login') || get_static_option('enable_facebook_login'))
                                            <div class="bar-wrap">
                                                <span class="bar"></span>
                                                <p class="or">{{ __('or') }}</p>
                                                <span class="bar"></span>
                                            </div>
                                        @endif

                                        <div class="sin-in-with">
                                            @if (get_static_option('enable_google_login'))
                                                <a href="{{ route('login.google.redirect') }}" class="sign-in-btn">
                                                    <img src="{{ asset('assets/frontend/img/static/google.png') }}"
                                                        alt="icon">
                                                    {{ __('Sign in with Google') }}
                                                </a>
                                            @endif
                                            @if (get_static_option('enable_facebook_login'))
                                                <a href="{{ route('login.facebook.redirect') }}" class="sign-in-btn">
                                                    <img src="{{ asset('assets/frontend/img/static/facebook.png') }}"
                                                        alt="icon">
                                                    {{ __('Sign in with Facebook') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('frontend.pages.services.service-book-js')
