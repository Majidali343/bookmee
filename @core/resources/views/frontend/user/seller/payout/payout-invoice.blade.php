<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ __('Payout Invoice') }} </title>
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
            [dir="rtl"] .custom--table thead tr th {
                text-align: right !important;
            }
            [dir="rtl"] .products-item {
                text-align: right !important;
            }
            [dir="rtl"] footer {
                text-align: right;
            }
            [dir="rtl"] .seller_admin_notes_wrapper {
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
            padding: 0 5px;
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
            float: right;
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
        .seller_admin_notes_wrapper {
            margin-top: 20px;
        }
        .seller_admin_notes h6 {
            margin: 0;
        }
        .seller_admin_notes p {
            margin: 0;
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
                        <h2 class="invoice-title">{{ __('INVOICE') }} </h2>
                    </div>
                </div>
            </div>
            <div class="invoice-details">
                <div class="invoice-details-flex">
                    <div class="invoice-single-details">
                        <ul class="details-list">
                            <span>{{ __('Payment Status:') }}
                                @if ($payout_details->status == 0) <span class="text-danger">{{ __('Pending') }}</span>@endif
                                @if ($payout_details->status == 1) <span class="text-success">{{ __('Completed') }}</span>@endif
                            </span>
                        </ul>
                    </div>
                    <div class="invoice-single-details" style="float:right">
                        <ul class="details-list">
                            <li class="list"> <strong>{{ __('Payout ID:') }}</strong> #{{ $payout_details->id }} </li>
                            <li class="list"> <strong>{{ __('Payout Date:') }}</strong>{{ optional($payout_details->created_at)->toFormattedDateString() }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="item-description">
                <h5 class="table-title">{{ __('Invoice Details') }}</h5>
                <table class="custom--table">
                    <thead>
                        <tr>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Receipt') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Description">
                                <div class="products-item">
                                <span>{{ __('Payout ID:') }} {{ $payout_details->id }}</span> <br>
                                <span>{{ __('Payout Amount:') }} {{ float_amount_with_currency_symbol($payout_details->amount) }}</span><br>
                                <span>{{ __('Payment Gateway:') }} {{ __($payout_details->payment_gateway) }}</span><br>
                                <span>{{ __('Request Date:') }} {{ $payout_details->created_at->toFormattedDateString() }}</span><br>
                                <span>{{ __('Payment Status:') }}
                                    @if ($payout_details->status == 0) <span class="text-danger">{{ __('Pending') }}</span>@endif
                                    @if ($payout_details->status == 1) <span class="text-success">{{ __('Completed') }}</span>@endif
                                </span>
                            </td>
                            <td class="price-td" data-label="Amount"> 
                                @if(!empty($payout_details->payment_receipt))
                                    {!! render_image_markup_by_attachment_id($payout_details->payment_receipt,'','thumb') !!}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="seller_admin_notes_wrapper">
                @if(!is_null($payout_details->admin_note))
                <div class="seller_admin_notes">
                    <h6>{{ __('Seller Note') }}</h6>
                    <p>{{ $payout_details->seller_note }}</p>
                </div>
                @endif
                @if(!is_null($payout_details->admin_note))
                <div class="seller_admin_notes">
                    <h6>{{ __('Admin Note') }}</h6>
                    <p>{{ $payout_details->admin_note }}</p>
                </div>
                @endif
            </div>
            <hr>
            <footer>
                {!! get_footer_copyright_text() !!}
            </footer>
        </div>
    </div>
    <!-- Invoice area end -->

</body>

</html>
