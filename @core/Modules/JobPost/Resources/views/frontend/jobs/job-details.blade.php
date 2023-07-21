@extends('frontend.frontend-page-master')

@section('site-title')
    {{ $job_details->title }}
@endsection

@section('page-title')
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    {{ ucwords(str_replace("-", " ", $page_info)) }}
@endsection

@section('inner-title')
    {{ $job_details->title}}
@endsection

@section('page-meta-data')
    {!!  render_page_meta_data_for_service($job_details) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/job-post.css')}}">
@endsection

@section('content')
    <!-- Job Details area starts -->
    <div class="apply-job-area-wrapper inner-page-wrapper" data-padding-top="100" data-padding-bottom="100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="apply-job-inner-area">
                        <div class="inner-content">
                            <div class="img-box">
                                {!! render_image_markup_by_attachment_id($job_details->image) !!}
                            </div>
                        </div>
                        <div class="content">
                            <div class="single-job-details-item">
                                <div class="inner-content">
                                    @if(!empty($job_details->buyer))
                                    <div class="single-specific">
                                        <div class="buyer_informatoin">
                                            <a href="{{ route('about.buyer.profile',optional($job_details->buyer)->username) }}">
                                            <div class="image">
                                                {!! render_image_markup_by_attachment_id(optional($job_details->buyer)->image,'','','thumb'); !!}
                                            </div>
                                            </a>
                                            <div class="buyer_contnet_warp">
                                                <a href="{{ route('about.buyer.profile',optional($job_details->buyer)->username) }}">
                                                    <h4 class="buyer_name">{{ optional($job_details->buyer)->name }}</h4>
                                                </a>
                                              <div class="buyer_info_wrap">
                                                <span class="buyer_info"><i class="las la-briefcase"></i> {{__('Total Posted Jobs')}} :{{optional($job_details->buyer)->jobs?->count()}} </span>
                                                <span class="buyer_info"><i class="las la-calendar-day"></i> {{$job_details->created_at?->diffForHumans()}}</span>
                                                <span class="buyer_info"><i class="las la-eye"></i> {{__('Total View')}} {{$job_details->view }}</span>
                                                
                                              </div>
                                            </div>
                                        </div>
                                        <h4 class="job-section-title">{{__('Job Details')}}</h4>
                                        <p class="single-specific-details">{!! $job_details->description!!}</p>
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper">
                        <div class="widget">
                            <div class="single-recent-posted-job job-post-new-widget hired-profile-widget">
                                <h3 class="job-information">{{__("Job Overview")}}</h3>
                                <div class="hired-description-list mt-4">
                                    <div class="hired-description-item">
                                        <div class="icon">
                                            <i class="las la-coins"></i>
                                        </div>
                                        <div class="content_warp">
                                            <h6 class="hired-description-title subject salary">{{ __('Budget') }}</h6>
                                            <p class="hired-description-para object amount">{{ float_amount_with_currency_symbol($job_details->price) }}</p>
                                        </div>
                                    </div>
                                    <div class="hired-description-item">
                                        <div class="icon">
                                            <i class="las la-map-marked"></i>
                                        </div>
                                        <div class="content_warp">
                                            <h6 class="hired-description-title subject salary">{{__('Job Location')}}</h6>
                                            <p class="hired-description-para object amount">
                                                
                                                @if($job_details->is_job_online == 0)
                                                    {{ optional($job_details->country)->country }}
                                                    <span> , </span>
                                                    {{ optional($job_details->city)->service_city }}
                                                @else
                                                    <span>{{ __('Online Jobs') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                       
                                    </div>
                                    <div class="hired-description-item">
                                        <div class="icon">
                                            <i class="las la-calendar-week"></i>
                                        </div>
                                         <div class="content_warp">
                                            <h6 class="hired-description-title subject salary">{{__('Deadline')}}</h6>
                                            <p class="hired-description-para deadline">
                                                
                                                <span class="date">{{ Carbon\Carbon::parse($job_details->deadline)->format('Y-m-d') }} </span>
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <div class="hired-description-item">
                                        <div class="icon">
                                            <i class="las la-list"></i>
                                        </div>
                                        <div class="content_warp">
                                            <h6 class="hired-description-title subject salary">{{__('Category')}}</h6>
                                            <a href="{{ route('job.post.category.jobs',optional($job_details->category)->slug) }}">
                                                <p class="hired-description-para deadline">
                                                    
                                                    <span class="date">{{optional($job_details->category)->name}} </span>
                                                </p>
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="job-apply-button-wrap">
                                        @if($is_job_hired >= 1)
                                            <span class="cmn-btn btn-outline-1 danger w-100" disable>{{ __('Already Hired') }}</span>
                                        @else
                                            @if(Auth::guard('web')->check())
                                                @if($job_details?->job_request?->where('seller_id',Auth::guard('web')->id())?->first())
                                                    <a href="#0"class="cmn-btn btn-danger w-100">{{__('Already Applied')}}</a>
                                                @elseif(Carbon\Carbon::parse($job_details->deadline)->gt(Carbon\Carbon::now()))
                                                    <a href="#0" disabled class="cmn-btn btn-danger w-100">{{__('Job Expired')}}</a>
                                                @elseif(auth("web")->user()->user_type === 1 )
                                                    <a href="#0" disabled class="cmn-btn btn-danger w-100">{{__('Only Seller Can Apply')}}</a>
                                                @else
                                                <a href="#"
                                                   class="cmn-btn btn-outline-1 get_subscription_id w-100"
                                                   data-toggle="modal"
                                                   data-target="#jobRequestModal"
                                                   data-id="{{ $job_details->id }}"
                                                   data-buyer_id="{{ $job_details->buyer_id }}"
                                                   data-price="{{ $job_details->price }}">{{__('Apply Now')}}</a>
                                                @endif   
                                            @else
                                                <a class="cmn-btn btn-outline-1 w-100" href="{{ route('user.login').'?return='.request()->path()}}">{{__('Login To Apply')}}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($same_buyer_jobs) > 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single-recent-posted-job job-post-new-widget">
                                <h4 class="widget-title-new">{{ __('This Buyer Other Jobs') }}</h4>
                                <div class="row">
                                    @foreach($same_buyer_jobs as $job)
                                        @php
                                            $image =  render_background_image_markup_by_attachment_id($job->image,'','','thumb');
                                            $title =  $job->title;
                                            $slug =  $job->slug;
                                            $route = route('job.post.details',$slug);
                                            $description =  Str::limit(strip_tags($job->description),100);
                                            $price =  amount_with_currency_symbol($job->price);
                                            $buyer_image =  render_image_markup_by_attachment_id(optional($job->buyer)->image,'','','thumb');
                                            $buyer_name =  optional($job->buyer)->name;
                                            $job_country =  optional($job->country)->country;
                                            $job_city =  optional($job->city)->service_city;
                                            if($job_country){
                                                $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' '.$job_country .' , '. $job_city .'</span>';
                                            }else{
                                                $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .__('Online').'</span>';
                                            }
                                            $is_job_hired = $job->job_request->where('is_hired',1)->count() ?? 0;
                                            $hired = __('Already Hired');

                                            if($is_job_hired >= 1){
                                                $apply = '<a href="javascript:void(0)" class="btn btn-danger w-100" disabled>'.$hired.'</a>';
                                            }elseif($job->dead_line >= date('Y-m-d h:i:s')){
                                                $apply = '<a href="'.$route.'" class="cmn-btn btn-small btn-bg-1 w-100">'.__('Apply Now').' </a>';
                                            }else {
                                                $apply = __('Expired');
                                            }

                                        @endphp
                                        <div class="col-lg-4 col-md-6 margin-top-30">
                                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                                <a href="$route" class="service-thumb">
                                                    <div class="service-thumb service-bg-thumb-format" {!! $image !!}></div>
                                                    <div class="country_city_location">
                                                        {!! $job_location !!}
                                                    </div>
                                                </a>
                                                <div class="services-contents">
                                                    <ul class="author-tag">
                                                        <li class="tag-list">
                                                            <a href="#">
                                                                <div class="authors">
                                                                    <a href="{{ route('about.buyer.profile',optional($job->buyer)->username) }}">
                                                                    <div class="thumb">
                                                                        {!! $buyer_image !!}
                                                                        <span class="notification-dot"></span>
                                                                    </div>
                                                                    </a>
                                                                    <a href="{{ route('about.buyer.profile',optional($job->buyer)->username) }}">
                                                                    <span class="author-title"> {{ $buyer_name }} </span>
                                                                    </a>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <h5 class="common-title"> <a href="{{$route}}"> {{$title}} </a> </h5>
                                                    <p class="common-para">{{$description}}</p>
                                                    <div class="service-price">
                                                        <span class="starting"> {{__('Starting at')}} </span>
                                                        <span class="prices">{{$price}}</span>
                                                    </div>
                                                    <div class="btn-wrapper d-flex flex-wrap">
                                                        {!! $apply !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(count($similar_jobs) > 0)
                <div class="col-lg-12">
                     <div class="single-recent-posted-job job-post-new-widget  margin-top-60">
                        <h4 class="widget-title-new">{{ __('Similar Jobs') }}</h4>
                        <div class="row">
                        @foreach($similar_jobs as $job)
                                @php
                                
                                    $image =  render_background_image_markup_by_attachment_id($job->image,'','','thumb');
                                    $title =  $job->title;
                                    $slug =  $job->slug;
                                    $route = route('job.post.details',$slug);
                                    $description =  Str::limit(strip_tags($job->description),100);
                                    $price =  amount_with_currency_symbol($job->price);
                                    $buyer_image =  render_image_markup_by_attachment_id(optional($job->buyer)->image,'','','thumb');
                                    $buyer_name =  optional($job->buyer)->name;
                                    $job_country =  optional($job->country)->country;
                                    $job_city =  optional($job->city)->service_city;
                                    if($job_country){
                                        $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' '.$job_country .' , '. $job_city .'</span>';
                                    }else{
                                        $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .__('Online').'</span>';
                                    }
                    
                                    $is_job_hired = $job->job_request->where('is_hired',1)->count() ?? 0;
                                    $hired = __('Already Hired');
                    
                                    if($is_job_hired >= 1){
                                        $apply = '<a href="javascript:void(0)" class="btn btn-danger w-100" disabled>'.$hired.'</a>';
                                    }else{
                                        $apply = '<a href="'.$route.'" class="cmn-btn btn-small btn-bg-1 w-100">'.__('Apply Now').' </a>';
                                    }
                        
                                @endphp
                                <div class="col-lg-4 col-md-6 margin-top-30">
                                  <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                    <a href="$route" class="service-thumb">
                                        <div class="service-thumb service-bg-thumb-format" {!! $image !!}></div>
                                        <div class="country_city_location">
                                            {!! $job_location !!}
                                        </div>
                                    </a>
                                    <div class="services-contents">
                                        <ul class="author-tag">
                                            <li class="tag-list">
                                                <a href="#">
                                                    <div class="authors">
                                                        <div class="thumb">
                                                            {!! $buyer_image !!}
                                                            <span class="notification-dot"></span>
                                                        </div>
                                                        <span class="author-title"> {{ $buyer_name }} </span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <h5 class="common-title"> <a href="$route"> {{$title}} </a> </h5>
                                        <p class="common-para">{{$description}}</p>
                                        <div class="service-price">
                                            <span class="starting"> {{__('Starting at')}} </span>
                                            <span class="prices">{{$price}}</span>
                                        </div>
                                        <div class="btn-wrapper d-flex flex-wrap">
                                            {!! $apply !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Job Details area end -->


    <!-- Add Modal -->
    <div class="modal fade" id="jobRequestModal" tabindex="-1" role="dialog" aria-labelledby="jobRequestModal" aria-hidden="true">
        <form class="ms-order-form" action="{{ route('job.post.apply') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="buyer_id" value="{{ $job_details->buyer_id }}">
            <input type="hidden" name="job_post_id" value="{{ $job_details->id }}">
            <input type="hidden" name="title" value="{{ $job_details->title }}">
            <input type="hidden" name="buyer_email" value="{{ optional($job_details->buyer)->email }}">
            <input type="hidden" name="job_price" value="{{ $job_details->price }}">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobRequestModal">{{ __('Apply This Job') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="confirm-bottom-content">
                            <div class="col-lg-12">
                                <div class="order cart-total">
                                    <p class="display_error_msg"></p>
                                    <div class="form-group">
                                        <label for="your_offer">{{ __('Make Offer') }}</label>
                                        <input type="number" name="expected_salary" id="expected_salary" class="form-control mt-2" placeholder="{{ __('Enter Your Offer') }}">
                                        <p class="text-info">{{__('Enter your offer amount') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="details">{{ __('Short Description') }}</label>
                                        <textarea name="cover_letter" id="cover_letter" rows="5" class="form-control mt-2" placeholder="{{ __('Enter Short description') }}"></textarea>
                                        <p class="text-info">{{__('In short description enter your cover letter or something like that') }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success order_create_from_jobs">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $("#review").rating({
                    "value": 3,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });

                $(document).on('submit','.service_review_form',function(e){
                    e.preventDefault();
                    let service_id = $('#service_id').val();
                    let seller_id = $('#seller_id').val();
                    let rating = $('#rating').val();
                    let name = $('#name').val();
                    let email = $('#email').val();
                    let message = $('#message').val();

                    $.ajax({
                        url:"{{ route('service.review.add') }}",
                        method:"post",
                        data:{
                            service_id:service_id,
                            seller_id:seller_id,
                            rating:rating,
                            name:name,
                            email:email,
                            message:message,
                        },
                        success:function(res){
                            if (res.status == 'success') {
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
                                toastr.success('Success!! Thanks For Review---');
                            }
                            $('.service_review_form')[0].reset();
                        }
                    });
                })

            });
        })(jQuery);
    </script>
@endsection
