@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Payout Request Details') }}
@endsection
@section('style')
  <style>
      img {
          max-width: 39%;
      }
  </style>
@endsection
@section('content')
    
    <x-frontend.seller-buyer-preloader/>

    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.seller.partials.sidebar')
                <div class="dashboard-right">
                    @if(!empty($request_details))
                    <div class="row">

                        <div class="col-md-4">
                            <div class="single-flex-middle">
                                <div class="single-flex-middle-inner">
                                    <div class="line-charts-wrapper margin-top-40">

                                        <div class="line-top-contents">
                                            <h5 class="earning-title">{{ __('Payout Request Details') }}</h5>
                                        </div>
                                        <div class="single-checbox">
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('ID:') }} #</strong>{{ $request_details->id }}</label>
                                            </div>
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Amount:') }} </strong>{{ float_amount_with_currency_symbol($request_details->amount) }}</label>
                                            </div>
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Payment Gateway:') }} </strong>{{ __($request_details->payment_gateway) }}</label>
                                            </div>
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Request Date:') }} </strong>{{ $request_details->created_at->toFormattedDateString() }}</label>
                                            </div>
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Seller Note:') }} </strong>{{ $request_details->seller_note }}</label>
                                            </div>
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Admin Note:') }} </strong>{{ $request_details->admin_note }}</label>
                                            </div>
                                        </div>

                                        <div class="line-top-contents">
                                            <h5 class="earning-title">{{ __('Payout Request Status') }}</h5>
                                        </div>
                                        <div class="single-checbox">
                                            <div class="checkbox-inlines">
                                                <label><strong>{{ __('Status:') }} </strong>
                                                    @if ($request_details->status == 0) <span class="text-danger">{{ __('Pending') }}</span>@endif
                                                    @if ($request_details->status == 1) <span class="text-success">{{ __('Completed') }}</span>@endif
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="single-flex-middle">
                                <div class="single-flex-middle-inner">
                                    <div class="line-charts-wrapper margin-top-40">
                                        <div class="line-top-contents">
                                            <h5 class="earning-title">{{ __('Payout Receipt') }}</h5>
                                            <hr>
                                        </div>
                                        @if(!empty($request_details->payment_receipt))
                                        {!! render_image_markup_by_attachment_id($request_details->payment_receipt) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
