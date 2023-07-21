@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('All Reviews')}}
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
                        <div class="col-md-6">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title">{{ __('All Reviews') }}</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-wrapper margin-top-50 text-right">
                                <a href="{{route('seller.service.review')}}" class="cmn-btn btn-bg-1"> {{__('Go Back' )}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($service_reviews as $review)
                        <div class="col-sm-12 col-lg-6">
                            <div class="dashboard-reviews">
                                <div class="about-review-tab">
                                    <div class="about-seller-flex-content flex-start padding-top-40">
                                        <div class="about-seller-thumb">
                                            {!! render_image_markup_by_attachment_id(optional($review->buyer)->image,'','thumb') !!}
                                        </div>
                                        <div class="about-seller-content">
                                            <h5 class="title"> 
                                                <a href="javascript:void(0)"> {{ $review->name }} </a>
                                                
                                            </h5>
                                            <div class="about-seller-list">
                                                <span class="icon">
                                                    {{ __('Rating:') }} 
                                                    {{ $review->rating }} 
                                                    <i class="las la-star"></i>
                                                </span>
                                            </div>
                                            <p class="about-review-para">{{ $review->message }}</p>
                                            <span class="review-date">{{ $review->created_at->diffForHumans() }} </span>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            {!! $service_reviews->links() !!}
                        </div>
                    </div>

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