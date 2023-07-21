@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('New Jobs')}}
@endsection

@section('style')
    <style>
        .JobPost-item-seller-count {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;
            background-color: var(--main-color-one);
            color: #fff;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: -15px;
            z-index: 9;
            border-radius: 50%;
            transition: all .3s;
        }
        .dashboard-right {
            width: 100%;
            box-shadow: 0 0 40px #ebebeb;
            padding: 20px;
            border-radius: 10px;
        }
        .dash-left-service-fixed {
            flex-basis: 40%
        }
        .dashboar-flex-services .thumb {
            height: 100%;
            width: 240px;
            height: 140px;
            border-radius: 10px;
        }

        .dashboar-flex-services .thumb-contents .service-review.style-02 {
            margin-right: 30px;
            margin-left: 0;
        }
        .dash-provider-list .jobPost_item-title,
        .dash-budget-list .jobPost_item-title {
            position: relative;
            bottom: 20px;
        }
        .dashboar-flex-services .thumb-contents {
            flex: 1;
        }
        .dashboar-flex-services .thumb-contents .title {
            font-size: 24px;
            font-weight: 600;
            line-height: 28px;
        }
        .dash-provider-list.provider .jobPost_item-title {
            font-size: 24px;
            color: var(--heading-color);
            font-weight: 500;
            display: block;
        }
        @media screen and (max-width: 1600px) and (min-width: 992px) {
            .dashboar-flex-services .thumb {
                width: 170px;
            }
            .dashboar-flex-services .thumb-contents .service-review.style-02 {
                margin-right: 20px;
                margin-left: 0;
            }
            .dashboar-flex-services .thumb-contents .title {
                font-size: 20px;
            }
            .dashboard-switch-flex-content .dashboard-switch-single .title-price {
                font-size: 28px;
            }
        }
        @media screen and (max-width: 991px) {
            .dashboar-flex-services .thumb {
                min-width: auto;
                width: 200px;
            }
            .dash-provider-list .jobPost_item-title, .dash-budget-list .jobPost_item-title {
                bottom: 0px;
                margin-bottom: 10px;
            }
            .dash-provider-list {
                margin-top: 10px;
            }
        }
        @media screen and (max-width: 575px) {
            .dashboar-flex-services .thumb {
                width: 170px;
            }
        }
        @media screen and (max-width: 480px) {
            .dashboar-flex-services {
                display: grid;
            }
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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings">
                                <h2 class="dashboards-title">{{ __('All New Jobs') }}</h2>
                                <p class="text-warning">{{ __('All new jobs are listed bellow') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($jobs->count() > 0)
                        @foreach($jobs as $data)
                            <div class="dashboard-service-single-item border-1 margin-top-40">
                                <div class="rows dash-single-inner">
                                    <div class="dash-left-service dash-left-service-fixed">
                                        <div class="dashboard-services">
                                            <div class="dashboar-flex-services">
                                                <a href="{{ route('job.post.details',$data->slug) }}">
                                                    <div class="thumb bg-image" {!! render_background_image_markup_by_attachment_id($data->image) !!}></div>
                                                </a>
                                                <div class="thumb-contents">
                                                    <h4 class="title"> <a href="{{ route('job.post.details',$data->slug) }}"> {{ $data->title }} </a> </h4>
                                                    <span class="service-review style-02"> <i class="las la-eye"></i> {{ $data->view }} </span>
                                                    @if($data->status==1)
                                                        <span class="service-review style-02">
                                                             <small> {{ __('Status:') }}</small> <small class="text-success"> {{ __('Active') }}</small>
                                                        </span>
                                                    @else
                                                        <span class="service-review style-02">
                                                            <small> {{ __('Status:') }}</small> <small class="text-danger"> {{ __('Inactive') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash-provider-list provider">
                                        <div class="col-md-2">
                                            @if(optional($data->job_request)->count() >=1)
                                                <a href="{{ route('job.post.details',$data->slug) }}">
                                                    <span class="btn btn-info">{{ __('Total Offer:') }} {{ optional($data->job_request)->count() }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('job.post.details',$data->slug) }}">
                                                    <span class="btn btn-info">{{ __('No Offer Create Yet') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="dash-righ-service">
                                        <div class="dashboard-switch-flex-content">
                                            <div class="dashboard-switch-single budget dash-budget-list">
                                                <h2 class="title-price color-3"> {{ amount_with_currency_symbol($data->price)}} </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                {!! $jobs->links() !!}
                            </div>
                        </div>
                    @else
                        <h2 class="no_data_found">{{ __('No New Job Created') }}</h2>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, delete it!')}}",
                        cancelButtonText: "{{__('Cancel')}}"
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