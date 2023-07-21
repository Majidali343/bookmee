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
    <title>{{get_static_option('site_title').' '. __('Mail')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @if(get_user_lang_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/backend/css/rtl.css')}}">
    @endif

</head>
<body>
    
    
<style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
            padding: 40px 0;
        }
        .inner-wrap {
            background-color: #fff;
            margin: 40px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);
        }
        .inner-wrap p {
            font-size: 16px;
            line-height: 26px;
            color: #656565;
            margin: 0;
        }
        .inner-wrap .table {
            overflow-x: auto !important;
            width: 100% !important;
        }

        .message-wrap {
            background-color: #f2f2f2;
            padding: 30px;
            margin-top: 40px;
        }

        .message-wrap p {
            font-size: 14px;
            line-height: 26px;
        }
        .table {
           
        }
        .table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        .table td, .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table .table-row:nth-child(even){background-color: #f2f2f2;}

        .table .table-row:hover {background-color: #ddd;}

        .table .table-row .table-heading {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
        .earning-title {
            border-bottom: 1px solid #ddd;
            font-size: 24px;
            color: red;
        }
        @media only screen and (max-width: 575px) {
            .inner-wrap {
                background-color: #fff;
                margin: 30px 0 !important;
                padding: 30px 10px !important;
                text-align: left;
                box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);
            }
            .inner-wrap .table {
                overflow-x: auto;
                width: 100%;
                margin: 30px 0 !important;
            }
            .table td, .table th {
                border: 1px solid #ddd;
                padding: 8px 0;
                font-size: 14px;
            }
            .earning-title {
                font-size: 18px;
            }
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

<div class="mail-container" style="max-width: 650px;margin: 0 auto;text-align: center;background-color: #f2f2f2;padding: 40px 0;">
    <div class="logo-wrapper">
        <a href="{{url('/')}}">
            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
        </a>
    </div>
        <div class="inner-wrap" style="background-color: #fff;text-align: left;box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);">
        <div class="inner-wrap-contents">
            <p class="wrap-para">{{ __('Hello, Order Created By:') }} {{ optional($order_details->buyer)->name }} <br>
            {{ __('Order has been created successfully at:') .optional($order_details->created_at)->toFormattedDateString().','. ucwords(str_replace("_", " ", $order_details->payment_gateway)) }}
            </p>
            <h4 class="earning-order-title">{{ __('Your Order ID') }} #{{ $order_details->id }}<br>
                {{ __('Total Amount') }} {{ float_amount_with_currency_symbol($order_details->total) }}<br>
                {{ __('Tax Amount') }} {{ float_amount_with_currency_symbol($order_details->tax) }} <br> <br>
                @if($order_details->transaction_id !='')
                {{ __('Your Transaction Id') }} {{ $order_details->transaction_id }} <br>
                @endif
            </h4>
        </div>

        @php $package_fee =0; 
        $order_includes = App\OrderInclude::where('order_id',$order_details->id)->get()
        @endphp

        @if($order_includes->count()>=1)
        <h3 class="earning-title">{{ __('Order Include Details') }}</h3>
        <table class="table table-bordered table-responsive" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;overflow-x: auto;">
            <thead>
                <tr class="table-row">
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Title') }}</th>
                    @if($order_details->is_order_online !=1)
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Unit Price') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Quantity') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;" class="table-heading">{{ __('Total') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php $package_fee =0; 
                $order_includes = App\OrderInclude::where('order_id',$order_details->id)->get()
                @endphp
                @foreach($order_includes as $include)
                <tr class="table-row">
                    <td style="border: 1px solid #ddd; padding: 8px; text-align:left;">{{ $include->title }}</td>
                    @if($order_details->is_order_online !=1)
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;">{{ float_amount_with_currency_symbol($include->price) }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;">{{ $include->quantity }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;text-align:left;">{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                    @php $package_fee += $include->price * $include->quantity @endphp
                    @endif
                </tr>
                @endforeach
                <tr class="table-row">
                    @if($order_details->is_order_online !=1)
                    <td colspan="3" style="padding: 10px"><strong>{{ get_static_option('service_package_fee_title') ??  __('Package Fee') }}</strong></td>
                    <td style="padding: 10px"><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                    @else
                        <td style="padding: 10px; text-align:left;"><strong>{{ __('Package Fee ') . float_amount_with_currency_symbol($order_details->package_fee) }}</strong></td>
                    @endif
                </tr>
            </tbody>
        </table>
        @endif


        @php $extra_service =0; 
        $order_additionals = App\OrderAdditional::where('order_id',$order_details->id)->get()
        @endphp

        @if($order_additionals->count()>=1)
        <h3 class="earning-title">{{ get_static_option('service_extra_title') ?? __('Order Additional Details') }}</h3>
        <table class="table table-bordered" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;">
            <thead>
                <tr>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Title') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Unit Price') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Quantity') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order_additionals as $additional)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $additional->title }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ float_amount_with_currency_symbol($additional->price) }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $additional->quantity }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                    @php $extra_service += $additional->price * $additional->quantity @endphp
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="padding: 10px"><strong>{{ __('Additional Service Fee') }}</strong></td>
                    <td style="padding: 10px"><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                </tr>
            </tbody>
        </table>
        @endif
        
        @if($order_details->coupon_code !='')
        <h3 class="earning-title">{{ __('Coupon Details') }}</h3>  
        <table class="table table-bordered" style="margin: 0 auto; border: 1px solid #ddd; border-collapse: collapse; width: 100%; margin-bottom: 30px;">
            <thead>
                <tr>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Coupon Code') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Coupon Type') }}</th>
                    <th style="background-color: #111d5c; color: #fff; padding: 10px; text-align: left;">{{ __('Coupon Amount') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $order_details->coupon_code }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $order_details->coupon_type }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        @if($order_details->coupon_amount >0)
                        {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        @endif

       @if($order_details->is_order_online !=1)
        <div class="earning-wrapper">
            <h3 class="earning-title">{{ __('Billing Details') }}</h3><hr>
            <p class="wrap-para"><strong>{{ __('Name:') }}</strong> {{ $order_details->name }}</p>
            <p class="wrap-para"><strong>{{ __('Email:') }}</strong> {{ $order_details->email }}</p>
            <p class="wrap-para"><strong>{{ __('Phone:') }}</strong> {{ $order_details->phone }}</p>
        </div>
        <div class="earning-wrapper">
            <h3 class="earning-title">{{ __('Shipping Details') }}</h3><hr>
            <p class="wrap-para"><strong>{{ __('Name:') }}</strong> {{ $order_details->name }}</p>
            <p class="wrap-para"><strong>{{ __('Email:') }}</strong> {{ $order_details->email }}</p>
            <p class="wrap-para"><strong>{{ __('Phone:') }}</strong> {{ $order_details->phone }}</p>
            <p class="wrap-para"><strong>{{ __('City:') }}</strong> {{ optional($order_details->service_city)->service_city }}</p>
            <p class="wrap-para"><strong>{{ __('Area:') }}</strong> {{ optional($order_details->service_area)->service_area }}</p>
            <p class="wrap-para"><strong>{{ __('Country:') }}</strong> {{ optional($order_details->service_country)->country }}</p>
            <p class="wrap-para"><strong>{{ __('Address:') }}</strong> {{ $order_details->address }}</p>
            <p class="wrap-para"><strong>{{ __('Date:') }}</strong> {{ __($order_details->date) }}</p>
            <p class="wrap-para"><strong>{{ __('Schedule:') }}</strong> {{ __($order_details->schedule) }}</p>
            <p class="wrap-para"><strong>{{ __('Order Create Date:') }}</strong> {{ optional($order_details->created_at)->toFormattedDateString() }}</p>
        </div>
       @endif

    </div>
    <footer>
        {!! get_footer_copyright_text() !!}
    </footer>
</div>

</body>
</html>
