@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Histories') }}
@endsection
@section('style')
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
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
                @if($decline_histories->count() >= 1)
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title">#{{$order_id}}-{{ __('Order Decline History') }}</h2>
                                    <br>
                                    <a class="btn btn-success" href="{{ route('seller.orders') }}">{{__('Back To Orders')}}</a>
                                </div>
                                <x-msg.success/>
                                <x-msg.error/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div>
                                    <div class="table-responsive table-responsive--md">
                                        <table id="all_order_table" class="custom--table table-td-padding">
                                            <thead>
                                            <tr>
                                                <th> {{ __('ID') }} </th>
                                                <th> {{ __('Buyer Details') }} </th>
                                                <th>{{ __('Status') }} ({{ __('Decline Reason') }})</th>
                                                <th> {{ __('Image File') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($decline_histories as $history)
                                                <tr>
                                                    <td data-label="{{__('ID')}}"> {{ $history->id }} </td>
                                                    <td data-label="{{ __('Buyer Details') }}">
                                                        <strong>{{ __('Name: ') }}</strong> {{ optional($history->buyer)->name }} <br>
                                                        <strong>{{ __('Email: ') }}</strong> {{ optional($history->buyer)->email }} <br>
                                                        <strong>{{ __('Phone: ') }}</strong> {{ optional($history->buyer)->phone }} <br>
                                                    </td>
                                                    <td data-label="{{ __('Status') }} ({{ __('Decline Reason') }})"><strong>{{ __('Decline Reason: ') }}</strong> {{ $history->decline_reason }} </td>
                                                    <td data-label="{{ __('Image File') }}">{!! render_image_markup_by_attachment_id($history->image,'','thumb') !!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="blog-pagination margin-top-55">
                                        <div class="custom-pagination mt-4 mt-lg-5">
                                            {!! $decline_histories->links() !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h2 class="no_data_found">{{ __('No History Found') }}</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                //order complete status approve
            });

        })(jQuery);
    </script>
@endsection
