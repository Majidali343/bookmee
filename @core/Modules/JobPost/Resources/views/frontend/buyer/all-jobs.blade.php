@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Jobs')}}
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
                <div class="dashboard-right">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title">{{ __('All Jobs') }}</h2>
                                <p class="text-info">{{ __('You can not delete any job if it has any order') }}</p>
                                <p class="text-info">{{ __('Yor jobs only published if the admin change the status inactive to active') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="btn-wrapper margin-top-50 text-right">
                        <a href="{{route('buyer.add.job')}}" class="cmn-btn btn-bg-1"> {{__('Create Jobs' )}}</a>
                    </div>
                    @if($jobs->count() > 0)
                        @foreach($jobs as $data)
                            <div class="dashboard-service-single-item border-1 margin-top-40">
                                <div class="rows dash-single-inner">
                                    <div class="dash-left-service">
                                        <div class="dashboard-services">
                                            <div class="dashboar-flex-services">
                                                <div class="thumb bg-image" {!! render_background_image_markup_by_attachment_id($data->image,'','thumb') !!}>
                                                </div>
                                                <div class="thumb-contents">
                                                    <h4 class="title"> <a href="{{route('buyer.edit.job',$data->id)}}"> {{ $data->title }} </a> </h4>
                                                    <span class="service-review style-02"> <i class="las la-eye"></i> {{ $data->view }} </span>
                                                    @if($data->status==1)
                                                        <span class="service-review style-02">
                                                 <small> {{ __('Status:') }}</small> <small class="text-danger"> {{ __('Active') }}</small>
                                            </span>
                                                    @else
                                                        <span class="service-review style-02">
                                                <small> {{ __('Status:') }}</small> <small class="text-danger"> {{ __('Inactive') }}</small>
                                            </span>
                                                    @endif
                                                    <div class="service-bottom-flex margin-top-30">
                                                        <a href="javascript:void(0)">
                                                            <div class="dashboard-service-bottom-flex color-2">
                                                                <div class="icon">
                                                                    {{ optional($data->orders)->count() }}
                                                                </div>
                                                                <div class="content">
                                                                    <span class="queue"> {{__('Request')}} </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div>
                                                            @php
                                                                $is_job_hired = Modules\JobPost\Entities\JobRequest::where('job_post_id',$data->id)->where('is_hired',1)->count();
                                                            @endphp
                                                            @if($is_job_hired >=1 )
                                                                <span class="btn btn-danger">{{ __('Hired') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash-righ-service">
                                        <div class="dashboard-switch-flex-content">
                                            <div class="dashboard-switch-single">
                                                <span class="dashboard-starting"> {{__('Starting From:')}} </span>
                                                <h2 class="title-price color-3"> {{ amount_with_currency_symbol($data->price)}} </h2>
                                            </div>
                                            <div class="dashboard-switch-single">
                                                <span class="dashboard-starting"> {{__('On/Off Job Post')}} </span>
                                                @if($data->is_job_on==1)
                                                    <input class="custom-switch style-02 service_on_off_btn" id="switch2_{{$data->id}}" type="checkbox" data-id="{{$data->id}}" />
                                                    <label class="switch-label style-02" for="switch2_{{$data->id}}"></label>
                                                @else
                                                    <input class="custom-switch service_on_off_btn" id="switch1_{{$data->id}}" type="checkbox" data-id="{{$data->id}}" />
                                                    <label class="switch-label" for="switch1_{{$data->id}}"></label>
                                                @endif
                                            </div>
                                            <div class="dashboard-switch-single">
                                                <a href="{{route('buyer.edit.job',$data->id)}}"> <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="{{ __('Edit Job Post') }}"> <i class="las la-pen"></i> </span> </a>
                                                <a href="{{route('job.post.details',$data->slug)}}"> <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="{{ __('Show Job Post') }}"> <i class="las la-eye"></i> </span> </a>
                                                @if(optional($data->orders)->count() == 0)
                                                    <x-seller-delete-popup :url="route('buyer.job.delete',$data->id)"/>
                                                @endif
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
                        <h2 class="no_data_found">{{ __('No Jobs Created Yet') }}</h2>
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

                $(document).on('change','.service_on_off_btn',function(e){
                    e.preventDefault();
                    if($(this).is(':checked')){
                        let job_post_id = $(this).data('id');
                        $.ajax({
                            method:'post',
                            url:"{{route('buyer.job.on.off')}}",
                            data:{job_post_id:job_post_id},
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
                                    toastr.success('Service On/Off Change Success---');
                                }
                            }
                        });
                    }else{
                        let job_post_id = $(this).data('id');
                        $.ajax({
                            method:'post',
                            url:"{{route('buyer.job.on.off')}}",
                            data:{job_post_id:job_post_id},
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
                                    toastr.success('Service On/Off Change Success---');
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