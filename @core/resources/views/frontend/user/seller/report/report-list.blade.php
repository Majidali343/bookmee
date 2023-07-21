@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Reports') }}
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
                @if($reports->count() >= 1)
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title">{{ __('All Reports') }}</h2>
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
                                                <th> {{ __('Order ID') }} </th>
                                                <th> {{ __('Report ID') }} </th>
                                                <th> {{ __('Report Details') }} </th>
                                                <th> {{ __('Buyer Details') }} </th>
                                                <th> {{ __('Conversation') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($reports as $report)
                                                <tr>
                                                    <td data-label="{{__('Order ID')}}"> {{ $report->order_id }} </td>
                                                    <td data-label="{{__('Report ID')}}"> {{ $report->id }} </td>
                                                    <td data-label="{{ __('Report Details') }}">
                                                        <p><strong>{{ __('Report From:') }}</strong> {{ ucfirst($report->report_from) }}</p>
                                                        <p><strong>{{ __('Report To:') }}</strong> {{ ucfirst($report->report_to) }}</p>
                                                        <p><strong>{{ __('Report Date:') }}</strong> {{date('d-m-Y', strtotime($report->created_at))}}</p>
                                                        <p><strong>{{ __('Description:') }}</strong> <span class="btn btn-info report_description" data-toggle="modal" data-target="#reportModal" data-report="{{ $report->report }}"><i class="ti-eye"></i></span></p>
                                                    </td>
                                                    <td data-label="{{ __('Buyer Details') }} ">
                                                        <p><strong>{{ __('Name:') }}</strong> {{ optional($report->buyer)->name }}</p>
                                                        <p><strong>{{ __('Email:') }}</strong> {{ optional($report->buyer)->email }}</p>
                                                        <p><strong>{{ __('Phone:') }}</strong> {{ optional($report->buyer)->phone }}</p>
                                                    </td>
                                                    <td><a class="btn btn-info btn-sm" href="{{ route('seller.order.report.chat.admin',$report->id) }}">{{ __('Chat To Admin') }}</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="blog-pagination margin-top-55">
                                        <div class="custom-pagination mt-4 mt-lg-5">
                                            {!! $reports->links() !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h2 class="no_data_found">{{ __('No Reports Found') }}</h2>
                @endif
            </div>
        </div>
    </div>

    {{-- Report modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">{{ __('Report Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="report_description"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                $(document).on('click','.report_description',function(e){
                    let report_description = $(this).data('report');
                    $('#report_description').text(report_description);
                });
            });

        })(jQuery);
    </script>
@endsection
