@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Reviews')}}
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
                @if($services->count() >= 1)
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{__('Service Reviews')}} </h2>
                            </div>
                        </div>
                    </div>
                    @foreach($services as $data)
                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <div class="dash-left-service">
                                <div class="dashboard-services">
                                    <div class="dashboar-flex-services">
                                        <div class="thumb bg-image" {!! render_background_image_markup_by_attachment_id($data->image,'','thumb') !!}>
                                        </div>
                                        <div class="thumb-contents">
                                            <h4 class="title"> <a href="javascript:void(0)"> {{ $data->title }} </a> </h4>
                                            <span class="service-review"> <i class="las la-star"></i>
                                                 {{ round(optional($data->reviews)->avg('rating'),1) }}  
                                                 <b>({{ optional($data->reviews)->count() }})</b> 
                                            </span>
                                            <span class="service-review style-02"> <i class="las la-eye"></i> {{ $data->view }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-righ-service">
                                <div class="dashboard-switch-flex-content">
                                    <div class="dashboard-switch-single text-center">
                                        <span class="dashboard-starting"> {{__('Reviews:')}} </span>
                                        <h2 class="title-price color-3"> {{ optional($data->reviews)->count() }} </h2>
                                    </div>

                                    <div class="dashboard-switch-single text-center">
                                        <a href="{{route('service.review.all',$data->id)}}"> 
                                            <span class="service-review style-02"> <i class="las la-eye"></i> </span> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            {!! $services->links() !!}
                        </div>
                    </div>

                </div>
                @else 
                <h2 class="no_data_found">{{ __('No Reviews Found') }}</h2>
                @endif
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

                $(document).on('change','.service_on_off_btn',function(e){
                    e.preventDefault();
                    if($(this).is(':checked')){
                        var service_id = $(this).data('id');
                        $.ajax({                                                  
                            method:'post',
                            url:"{{route('seller.services.on.of')}}",
                            data:{service_id:service_id},
                            success:function(res){
                                if(res.status=='success'){
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success('Service On Success---');
                                }
                            }
                        });              
                    }else{
                        var service_id = $(this).data('id');
                        $.ajax({                                                  
                            method:'post',
                            url:"{{route('seller.services.on.of')}}",
                            data:{service_id:service_id},
                            success:function(res){
                                if(res.status=='success'){
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success('Service Off Success---');
                                }
                            }
                        }); 
                    }

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