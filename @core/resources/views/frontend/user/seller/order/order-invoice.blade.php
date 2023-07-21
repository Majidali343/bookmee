<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ __('Order Invoice') }} </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">

    @if( get_user_lang_direction() === 'rtl')
    <style>
        
        [dir="rtl"] .item-description .table-title  {
            text-align: right;
        }
        [dir="rtl"] .custom--table tbody tr td {
            text-align: right;
        }
        [dir="rtl"] .custom--table thead tr th {
            text-align: right !important;
        }
        [dir="rtl"] footer {
            text-align: right;
        }
    </style>
@endif

</head>

<body>


    <style>
        * {
            font-family: 'Roboto', sans-serif;
            line-height: 26px;
            font-size: 15px;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        /*=========================================================
          [ Table ]
        =========================================================*/
        
        .custom--table {
            width: 100%;
            color: inherit;
            vertical-align: top;
            font-weight: 400;
            border-collapse: collapse;
            border-bottom: 2px solid #ddd;
            margin-top: 0;
        }
        .table-title{
            font-size: 24px;
            font-weight: 600;
            line-height: 32px;
            margin-bottom: 10px;
        }
        .custom--table thead {
            font-weight: 700;
            background: inherit;
            color: inherit;
            font-size: 16px;
            font-weight: 500;
        }
        
        .custom--table tbody {
            border-top: 0;
            overflow: hidden;
            border-radius: 10px;
        }
        .custom--table thead tr {
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            text-align: left;
        }
        .custom--table thead tr th {
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            text-align: left;
            font-size: 16px;
            padding: 10px 0;
        }
        .custom--table tbody tr {
            vertical-align: top;
        }
        .custom--table tbody tr td {
            font-size: 14px;
            line-height: 18px
            vertical-align: top;
        }
        .custom--table tbody tr td:last-child{
            padding-bottom: 10px;
        }
        .custom--table tbody tr td .data-span {
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
        }
        .custom--table tbody .table_footer_row {
            border-top: 2px solid #ddd;
            margin-bottom: 10px !important;
            padding-bottom: 10px !important;
            
        }
        /* invoice area */
        .invoice-area {
            padding: 10px 0;
        }
        
        .invoice-wrapper {
            max-width: 650px;
            margin: 0 auto;
            box-shadow: 0 0 10px #f3f3f3;
            padding: 0px;
        }
        
        .invoice-header {
            margin-bottom: 40px;
        }
        
        .invoice-flex-contents {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }
        
        .invoice-logo {}
        
        .invoice-logo img {}
        
        .invoice-header-contents {
            text-align: right;
        }
        
        .invoice-header-contents .invoice-title {
            font-size: 40px;
            font-weight: 700;
        }
        
        .invoice-details {
            margin-top: 20px;
        }
        
        .invoice-details-flex {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }
        
        .invoice-details-title {
            font-size: 24px;
            font-weight: 700;
            line-height: 32px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .invoice-single-details {}
        
        .details-list {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-top: 10px;
        }
        
        .details-list .list {
            font-size: 14px;
            font-weight: 400;
            line-height: 18px;
            color: #666;
            margin: 0;
            padding: 0;
            transition: all .3s;
        }
        .details-list .list strong {
            font-size: 14px;
            font-weight: 500;
            line-height: 18px;
            color: #666;
            margin: 0;
            padding: 0;
            transition: all .3s;
        }
        
        .details-list .list a {
            display: inline-block;
            color: #666;
            transition: all .3s;
            text-decoration: none;
            margin: 0;
            line-height: 18px
        }
        
        .item-description {
            margin-top: 10px;
        }
        
        .products-item {
            text-align: left;
        }
        
        .invoice-total-count {}
        
        .invoice-total-count .list-single {
            display: flex;
            align-items: center;
            gap: 30px;
            font-size: 16px;
            line-height: 28px;
        }
        
        .invoice-total-count .list-single strong {}
        
        .invoice-subtotal {
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }
        
        .invoice-total {
            padding-top: 10px;
        }
        
        .terms-condition-content {
            margin-top: 30px;
        }
        
        .terms-flex-contents {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .terms-left-contents {
            flex-basis: 50%;
        }
        
        .terms-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }
        
        .terms-para {
            margin-top: 10px;
        }
        
        .invoice-footer {}
        
        .invoice-flex-footer {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .single-footer-item {
            flex: 1;
        }
        
        .single-footer {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .single-footer .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;
            font-size: 16px;
            background-color: #000e8f;
            color: #fff;
        }
        
        .icon-details {
            flex: 1;
        }
        
        .icon-details .list {
            display: block;
            text-decoration: none;
            color: #666;
            transition: all .3s;
            line-height: 24px;
        }
        
        .icon-details .list:hover {
            color: #000e8f;
        }
        
        @media (min-width: 300px) and (max-width: 991px) {
            .single-footer-item {
                flex-basis: 45%;
            }
            .custom--table tr th {
                font-size: 16px;
            }
        }
        
        @media (min-width: 300px) and (max-width: 575px) {
            .products-item {
                text-align: right;
                width: 260px;
                margin-left: auto;
            }
        }
        
        @media (min-width: 300px) and (max-width: 520px) {
            .item-description-list .list:first-child {
                width: 160px;
            }
            .item-products-list .list:first-child {
                width: 160px;
            }
            .single-footer-item {
                flex-basis: 45%;
            }
        }
        
        @media (min-width: 300px) and (max-width: 500px) {
            .payment-flex-contents {
                flex-direction: column-reverse;
            }
            .invoice-total-count {
                margin-left: auto;
            }
        }
        
        @media (min-width: 300px) and (max-width: 420px) {
            .invoice-wrapper {
                box-shadow: none;
            }
            .terms-left-contents {
                flex-basis: 100%;
            }
            .products-item {
                width: 170px;
            }
        }
    </style>


    <!-- Invoice area Starts -->
    <div class="invoice-area">
        <div class="invoice-wrapper">
            <div class="invoice-header">
                <div class="invoice-flex-contents">
                    <div class="invoice-logo">
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                    </div>
                    <div class="invoice-header-contents">
                        <h2 class="invoice-title">{{ __('INVOICE') }}</h2>
                    </div>
                </div>
            </div>
            <div class="invoice-details" style="margin-bottom:100px">
                <div class="invoice-details-flex">
                    <div class="invoice-single-details" style="float:left;">
                        <h4 class="invoice-details-title">{{ __('Bill To:') }}</h4>
                        <ul class="details-list">
                            <li class="list"> {{ $order_details->name }} </li>
                            <li class="list"> <a href="#"> {{ $order_details->email }} </a> </li>
                            <li class="list"> <a href="#"> {{ $order_details->phone }}</a> </li>
                        </ul>
                    </div>
                    <div class="invoice-single-details" style="float:right">
                        <h4 class="invoice-details-title">{{ __('Ship To:') }}</h4>
                        <ul class="details-list">
                            <li class="list"> <strong>{{ __('City') }}: </strong> {{ optional($order_details->service_city)->service_city }} </li>
                            <li class="list"> <strong>{{ __('Area') }}: </strong> {{ optional($order_details->service_area)->service_area }} </li>
                            <li class="list"> <strong>{{ __('Address') }}: </strong>{{ $order_details->address }} </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if($order_details->order_from_job != 'yes')
            <div class="item-description">
                <h5 class="table-title"> {{__('Include Services ')}}</h5>
                <table class="custom--table">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Unit Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $package_fee =0; @endphp
                        @foreach($order_includes as $include)
                        <tr>
                            <td>{{ $include->title }}</td>
                            <td>{{ float_amount_with_currency_symbol($include->price) }}</td>
                            <td>{{ $include->quantity }}</td>
                            <td>{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                            @php $package_fee += $include->price * $include->quantity @endphp
                        </tr>
                        @endforeach
                        <tr class="table_footer_row">
                            <td colspan="3"><strong>{{ __('Package Fee') }}</strong></td>
                            <td><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif

            @if($order_additionals->count() >=1)
            <div class="item-description">
                <div class="table-responsive">
                    <h5 class="table-title"> {{ __('Additional Services') }} </h5>
                    <table class="custom--table">
                        <thead class="head-bg">
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Unit Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $extra_service =0; @endphp
                            @foreach($order_additionals as $additional)
                            <tr>
                                <td>{{ $additional->title }}</td>
                                <td>{{ float_amount_with_currency_symbol($additional->price) }}</td>
                                <td>{{ $additional->quantity }}</td>
                                <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                @php $extra_service += $additional->price * $additional->quantity @endphp
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if(!empty($order_details->coupon_code))
            <div class="item-description page_break">
                <div class="table-responsive table-responsive--md">
                    <h5 class="table-title"> {{ __('Coupon Details') }} </h5>
                    <table class="custom--table">
                        <thead class="head-bg">
                            <tr>
                                <th>{{ __('Coupon Code') }}</th>
                                <th>{{ __('Coupon Type') }}</th>
                                <th>{{ __('Coupon Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order_details->coupon_code }}</td>
                                <td>{{ $order_details->coupon_type }}</td>
                                <td>
                                    @if($order_details->coupon_amount >0)
                                    {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="item-description">
                <div class="table-responsive">
                    <h5 class="table-title">{{ __('Orders Details') }}</h5>
                    <table class="custom--table">
                        <thead class="head-bg">
                            <tr>
                                <th>{{ __('Buyer Details') }}</th>
                                <th>{{ __('ID & Status') }}</th>
                                <th>{{ __('Date & Schedule') }}</th>
                                <th>{{ __('Amount Details') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                   <span class="data-span"> {{ __('Name:') }} </span>{{ $order_details->name }} <br>
                                   <span class="data-span"> {{ __('Email:') }} </span>{{ $order_details->email }} <br>
                                   <span class="data-span"> {{ __('Phone:') }} </span>{{ $order_details->phone }} <br>
                                   <span class="data-span"> {{ __('Address:') }} </span>{{ $order_details->address }}
                                </td>
                                <td>
                                    <span class="data-span"> {{ $order_details->id }}</span><br>
                                    @if ($order_details->status == 0)  <span>{{ __('Pending') }}</span>@endif
                                    @if ($order_details->status == 1) <span> {{ __('Active') }}</span>@endif
                                    @if ($order_details->status == 2) <span> {{ __('Completed') }}</span>@endif
                                    @if ($order_details->status == 3) <span> {{ __('Delivered') }}</span>@endif
                                    @if ($order_details->status == 4) <span> {{ __('Cancelled') }}</span>@endif
                                </td>
                                <td>
                                    {{ $order_details->date }} <br>
                                    {{ $order_details->schedule }}
                                </td>
                                <td>
                                   <span class="data-span"> {{ __('Package Fee:') }} </span>{{ float_amount_with_currency_symbol($order_details->package_fee) }} <br>
                                   <span class="data-span"> {{ __('Extra Service:') }} </span>{{ float_amount_with_currency_symbol($order_details->extra_service) }} <br> 
                                   <span class="data-span"> {{ __('Sub Total:') }} </span>{{ float_amount_with_currency_symbol($order_details->sub_total) }} <br>
                                   <span class="data-span"> {{ __('Tax:') }} </span>{{ float_amount_with_currency_symbol($order_details->tax) }} <br>
                                    @if(!empty($order_details->coupon_amount)) 
                                   <span class="data-span"> {{ __('Coupon Amount:') }} </span>{{ float_amount_with_currency_symbol($order_details->coupon_amount) }} <br>
                                    @endif
                                   <span class="data-span"> {{ __('Total:') }} </span>{{ float_amount_with_currency_symbol($order_details->total) }} <br> 
                                   <span class="data-span"> {{ __('Admin Charge:') }} </span> {{ float_amount_with_currency_symbol($order_details->commission_amount) }} <br>
                                   <span class="data-span"> {{ __('Payment Gateway:') }} </span {{ __(ucwords(str_replace("_", " ", $order_details->payment_gateway))) }} <br> 
                                   <span class="data-span"> {{ __('Payment Status:') }} </span>{{ ucfirst($order_details->payment_status) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

             {{-- extra service--}}
             @if($order_additionals->count() >= 1)
                <div class="item-description page_break">
                    <div class="table-responsive table-responsive--md">
                        <h5 class="table-title">{{ __('Extra Details') }}</h5>
                        <table class="custom--table">
                            <thead class="head-bg">
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Unit Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $extra_service =0; @endphp
                            @foreach($order_additionals as $additional)
                                <tr>
                                    <td>{{ $additional->title }}</td>
                                    <td>{{ float_amount_with_currency_symbol($additional->price) }}</td>
                                    <td>{{ $additional->quantity }}</td>
                                    <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                    @php $extra_service += $additional->price * $additional->quantity @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <footer>
                {!! get_footer_copyright_text() !!}
            </footer>

        </div>
    </div>
    <!-- Invoice area end -->
</body>
</html>


