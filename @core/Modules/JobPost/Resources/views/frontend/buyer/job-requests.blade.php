@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{ __('Job Requests') }}
@endsection
@section('style')
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
        .dashboard-right {
            width: 100%;
            box-shadow: 0 0 40px #ebebeb;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
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
                @include('frontend.user.buyer.partials.sidebar')
                @if($all_job_requests->count() >= 1)
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-flex-title">
                                    <div class="dashboard-settings margin-top-40">
                                        <h2 class="dashboards-title">{{ __('Request For Your Jobs') }}</h2>
                                        <p class="text-warning">{{ __('You can delete those request that has not hired yet') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div class="table-responsive table-responsive--md">
                                    <table id="all_order_table" class="custom--table table-td-padding">
                                        <thead>
                                        <tr>
                                            <th> {{ __('Job Offer ID') }} </th>
                                            <th> {{ __('Job ID') }} </th>
                                            <th> {{ __('Job Type') }} </th>
                                            <th> {{ __('Job Title') }} </th>
                                            <th> {{ __('Seller Name') }} </th>
                                            <th> {{ __('Seller Offer') }} </th>
                                            <th> {{ __('Your Offer') }} </th>
                                            <th> {{ __('Action') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($all_job_requests as $job_req)
                                            <tr>
                                                <td data-label="{{ __('Job Offer ID') }}"> {{ $job_req->id }} </td>
                                                <td data-label="{{ __('Job ID') }}"> {{ optional($job_req->job)->id }} </td>
                                                <td data-label="{{ __('Job Type') }}">
                                                    {{ optional($job_req->job)->is_job_online ? 'Online' : 'Offline' }}
                                                </td>
                                                <td data-label="{{ __('Job Title') }}"> {{ Str::limit(optional($job_req->job)->title,50) }} </td>
                                                <td data-label="{{ __('Seller Name') }}">

                                                    {{ optional($job_req->seller)->name }}
                                                    @if(optional($job_req->jobRequestTicket)->is_hired == 1)
                                                        <span class="btn btn-info">{{ __('Hired') }}</span>
                                                    @endif
                                                </td>
                                                <td data-label="{{ __('Seller Offer') }}">{{ float_amount_with_currency_symbol($job_req->expected_salary) }}</td>
                                                <td data-label="{{ __('Your Offer') }}">{{ float_amount_with_currency_symbol(optional($job_req->job)->price) }}</td>
                                                <td data-label="{{ __('Action') }}">
                                                    <a href="{{ route('job.post.details', optional($job_req->job)->slug) }}" target="_blank">
                                                        <span class="btn btn-info btn-sm">{{__('View Details')}}</span>
                                                    </a>
                                                    <a href="{{ route('buyer.job.request.conversation', $job_req->id) }}">
                                                        <span class="btn btn-success btn-sm">{{ __('Conversation') }}</span>
                                                    </a>
                                                    @if($job_req->is_hired != 1)
                                                        <span class="btn btn-outline-danger mt-1"> <x-seller-delete-popup :url="route('buyer.job.request.delete',$job_req->id)"/></span>
                                                    @endif
                                                    @if($job_req->is_hired == 1)
                                                        <span class="btn btn-danger btn-sm mt-1">{{ __('Hired') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        {!! $all_job_requests->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h2 class="no_data_found">{{ __('No Job Request Found') }}</h2>
                @endif
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                //order complete status approve
                $(document).on('click','.swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to change status? Once you done you can not revert this !!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

            });

        })(jQuery);
    </script>
@endsection
