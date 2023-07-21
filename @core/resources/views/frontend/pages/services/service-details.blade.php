@extends('frontend.frontend-page-master')

@section('site-title')
    {{ $service_details->title }}
@endsection

@section('page-title')
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    {{ __(ucwords(str_replace("-", " ", $page_info))) }}
@endsection

@section('inner-title')
    {{ $service_details->title}}
@endsection

@section('page-meta-data')
    {!!  render_page_meta_data_for_service($service_details) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup.css')}}">
@endsection


@section('content')
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalvideo_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="single-slider">
                        <div class="gallery-images single-featured">
                            {!! $service_details->video !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
<style>
    .single-packages .details-available-price .available-list li::before{
        border: 1px solid rgba(35, 56, 87, 1);
        color: rgba(35, 56, 87, 1);
    }
</style>

    <!-- Service Details area starts -->
    <section class="service-details-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 margin-top-30 order-2 order-lg-1">
                    <div class="service-details-wrapper">
                        <div class="service-details-inner">
                            <div class="details-thumb">
                                <div class="main-img-box ">
                                    @if(!is_null($service_details->image_gallery))
                                        <div class="service-details-slider">
                                            @php
                                                $images = explode("|",$service_details->image_gallery);
                                            @endphp
                                            <div class="single-slider">
                                                <div class="gallery-images single-featured service-details-background-image" {!! render_background_image_markup_by_attachment_id($service_details->image) !!}> </div>
                                            </div>
                                            @foreach($images as $img)
                                                <div class="single-slider">
                                                    <div class="gallery-images single-featured service-details-background-image" {!! render_background_image_markup_by_attachment_id($img) !!}>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="gallery-images single-featured service-details-background-image" {!! render_background_image_markup_by_attachment_id($service_details->image) !!}>
                                        </div>

                                    @endif
                                </div>
                            </div>

                            <ul class="author-tag style-02 mt-4">
                                <li class="tag-list">
                                    <a href="{{ route('about.seller.profile',optional($service_details->seller)->username) }}">
                                        <div class="authors">
                                            <div class="thumb">
                                                {!! render_image_markup_by_attachment_id(optional($service_details->seller)->image) !!}
                                                <span class="notification-dot"></span>
                                            </div>
                                            <span class="author-title"> {{ optional($service_details->seller)->name }} </span>
                                        </div>
                                    </a>
                                </li>
                                @if(!empty($service_rating))
                                    <li class="tag-list">
                                        <a href="javascript:void(0)">
                                            <span class="icon">{{ __('Rating:') }}</span>
                                            <span class="reviews">
                                            {!! ratting_star($service_rating) !!}
                                            ({{ $service_reviews->count() }})
                                        </span>
                                        </a>
                                    </li>
                                @endif
                                @if($service_details->video)
                                    <li class="video-btn">
                                        <div class="btn-wrapper">
                                            <a href="#0" class="cmn-btn btn-bg-1 mt-3" data-toggle="modal" data-target="#exampleModalvideo_modal">
                                                {{__('Watch Video')}}
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            </ul>

                            <ul class="details-tabs tabs margin-top-55">
                                <li data-tab="tab1" class="list active">
                                    {{ get_static_option('service_details_overview_title') ?? __('Overview') }}
                                </li>
                                <li class="list" data-tab="tab2">
                                    {{ get_static_option('service_details_about_seller_title') ?? __('About Seller') }}
                                </li>
                                <li class="list" data-tab="tab3">
                                    {{ get_static_option('service_details_review_title') ?? __('Review') }}
                                </li>
                            </ul>
                            <div class="tab-content another-tab-content active" id="tab1">
                                <div class="details-content-tab padding-top-10">
                                    <p class="details-tap-para"> {!! $service_details->description !!} </p>
                                </div>
                                @if($service_includes->count() > 0)
                                    <div class="overview-single style-02 padding-top-60">
                                        <h4 class="title"> {{ get_static_option('service_details_what_you_get') ?? __('What you will get:') }} </h4>
                                        <ul class="overview-benefits margin-top-30">
                                            @foreach($service_includes as $include)
                                                <li class="list"> <a href="javascript:void(0)"> {{ $include['include_service_title'] }} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($service_benifits->count() > 0)
                                    <div class="overview-single style-02 padding-top-60">
                                        <h4 class="title">{{ get_static_option('service_details_benifits_title') ?? __('Benefits of the premium Package:') }} </h4>
                                        <ul class="overview-benefits margin-top-30">
                                            @foreach($service_benifits as $additional)
                                                <li class="list"> <a href="javascript:void(0)"> {{ $additional['benifits'] }} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif



                            <!-- FAQ Area starts -->
                                @if($service_details->serviceFaq()->count() >= 1)
                                    <div class="faq-area" data-padding-top="70" data-padding-bottom="100" >
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12 margin-top-30">
                                                    <div class="faq-contents">
                                                            @foreach($service_details->serviceFaq as $faq)
                                                                @php
                                                                    if (empty($faq->title)){
                                                                        continue;
                                                                    }
                                                                @endphp
                                                            <div class="faq-item wow fadeInLeft" data-wow-delay=".2s">
                                                                <div class="faq-title">
                                                                    {{ $faq->title }}
                                                                </div>
                                                                <div class="faq-panel">
                                                                    <p class="faq-para">{{ $faq->description }}</p>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!-- FAQ Area ends -->


                            </div>
                            <div class="tab-content another-tab-content" id="tab2">
                                <div class="details-content-tab padding-top-10">
                                    <div class="about-seller-tab margin-top-30">
                                        <div class="about-seller-flex-content">
                                            <div class="about-seller-thumb">
                                                {!! render_image_markup_by_attachment_id(optional($service_details->seller)->image,'','thumb') !!}
                                            </div>
                                            <div class="about-seller-content">
                                                <h5 class="title"> <a href="{{ route('about.seller.profile',optional($service_details->seller)->username) }}"> {{ optional($service_details->seller)->name }} </a> </h5>
                                                @if($completed_order >=1)
                                                    <div class="about-seller-list">
                                                        <span class="icon">{{ __('Order Completed') }}</span>
                                                        <span class="reviews">({{ $completed_order }}) </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="seller-details-box margin-top-40">
                                            <ul class="seller-box-list">
                                                <li class="box-list"> {{ __('From') }}
                                                    <strong>
                                                        {{ optional(optional($service_details->seller)->country)->country }}
                                                    </strong>
                                                </li>
                                                @if(!empty($seller_since))
                                                    <li class="box-list"> {{ __('Seller Since') }}
                                                        <strong>
                                                            {{ Carbon\Carbon::parse($seller_since->created_at)->year }}
                                                        </strong>
                                                    </li>
                                                @endif
                                                @if($order_completion_rate>=1)
                                                    <li class="box-list"> {{ __('Order Completion Rate') }}
                                                        <strong> {{ ceil($order_completion_rate) }}%
                                                        </strong>
                                                    </li>
                                                @endif
                                                @if($completed_order>=1)
                                                    <li class="box-list">{{ __('Order Completed') }}
                                                        <strong>
                                                            {{ $completed_order }}
                                                        </strong>
                                                    </li>
                                                @endif
                                            </ul>
                                            <p class="seller-details-para"> {{ optional($service_details->seller)->about }}  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content another-tab-content" id="tab3">

                                <div class="details-content-tab padding-top-10">
                                    <div class="about-review-tab">
                                        @if(!empty($service_reviews))
                                            @foreach($service_reviews as $review)
                                                <div class="about-seller-flex-content style-02">
                                                    <div class="about-seller-thumb">
                                                        <a href="javascript:void(0)"> {!! render_image_markup_by_attachment_id(optional($review->buyer)->image) !!} </a>
                                                    </div>
                                                    <div class="about-seller-content">
                                                        <a href="{{ route('about.buyer.profile',optional($review->buyer)->username) }}">
                                                        <h5 class="title"> <a href="javascript:void(0)">{{ $review->name }}</a> </h5>
                                                        </a>
                                                        <div class="about-seller-list">
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                        </div>
                                                        <p class="about-review-para">{{ $review->message }}</p>
                                                        <span class="review-date"> {{ optional($review->created_at)->toFormattedDateString() }} </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            @if(!empty($buyer_order_services))
                                @foreach($buyer_order_services as $service)
                                    @if($service->service_id==$service_details->id)
                                        <!-- Comment area Starts -->
                                            <div class="comment-area padding-top-100">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="section-title-two">
                                                                <h3 class="title">{{ get_static_option('service_post_reviews_title') ?? __('Post Your Review') }} </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 padding-top-20">
                                                            <div class="details-comment-content">
                                                                <form action="" class="service_review_form">
                                                                    @csrf
                                                                    <input type="hidden" id="service_id" value="{{ $service_details->id }}">
                                                                    <input type="hidden" id="seller_id" value="{{ $service_details->seller_id }}">

                                                                    <div class="comments-flex-item">
                                                                        <div class="single-commetns" style="font-size: 1em;">
                                                                            <label class="comment-label"> {{ __('Ratings*') }} </label>
                                                                            <div id="review"></div>
                                                                        </div>
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label" for="star_input">{{ __('Stars') }}</label>
                                                                            <input type="text" readonly id="rating" name="rating" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="comments-flex-item">
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label">{{ __('Your Name*') }}</label>
                                                                            <input type="text" class="form--control" id="name" name="name"
                                                                                   @if(Auth::guard('web')->check())
                                                                                   value="{{ Auth::guard('web')->user()->name }}"
                                                                                   @else
                                                                                   value=""
                                                                                   @endif
                                                                                   placeholder="{{ __('Type Name') }}">
                                                                        </div>
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label">{{ __('Email Address*') }}</label>
                                                                            <input type="text" class="form--control" id="email" name="email"
                                                                                   @if(Auth::guard('web')->check())
                                                                                   value="{{ Auth::guard('web')->user()->email }}"
                                                                                   @else
                                                                                   value=""
                                                                                   @endif
                                                                                   placeholder="{{ __('Type Email') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-commetns">
                                                                        <label class="comment-label">{{ __('Comments*') }}</label>
                                                                        <textarea id="message" name="message" class="form--control form--message" placeholder="{{ __('Post Comments') }}"></textarea>
                                                                    </div>
                                                                    <button type="submit">{{ __('Send Review') }}</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment area ends -->
                                            @php break; @endphp
                                        @endif
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </div>
                    @if($another_service->count() > 0)
                        <div class="another-details-wrapper padding-top-100">
                            <div class="section-title-two">
                                <h3 class="title">{{ get_static_option('service_details_another_service_title') ?? __('Another Service of this Seller') }}</h3>
                                <a href="{{ route('seller.service.all',$service_details->seller_id) }}" class="section-btn">{{ get_static_option('service_details_explore_all_title') ?? __('Explore All') }}</a>
                            </div>
                            <div class="row padding-top-20">

                                @foreach($another_service as $service)
                                    <div class="col-md-6 margin-top-30">
                                        <div class="single-service no-margin">
                                            <a href="{{ route('service.list.details',$service->slug) }}" class="service-thumb service-bg-thumb-format" {!! render_background_image_markup_by_attachment_id($service->image) !!}>

                                                @if($service->featured == 1)
                                                    <div class="award-icons">
                                                        <i class="las la-award"></i>
                                                    </div>
                                                @endif
                                                <!-- <div class="country_city_location">
                                                    <span class="single_location"> <i class="las la-map-marker-alt"></i> {{ optional($service->serviceCity)->service_city }}, {{ optional(optional($service->serviceCity)->countryy)->country }} </span>
                                                </div> -->
                                            </a>
                                            <div class="services-contents">
                                                <ul class="author-tag">
                                                    <li class="tag-list">
                                                        <a href="{{ route('about.seller.profile',optional($service->seller)->username) }}">
                                                            <div class="authors">
                                                                <div class="thumb">
                                                                    {!! render_image_markup_by_attachment_id(optional($service->seller)->image) !!}
                                                                    <span class="notification-dot"></span>
                                                                </div>
                                                                <span class="author-title"> {{ optional($service->seller)->name }}  </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @if($service->reviews->count() >= 1)
                                                        <li class="tag-list">
                                                            <a href="javascript:void(0)">
                                                    <span class="reviews">
                                                        {!! ratting_star(round(optional($service->reviews)->avg('rating'),1)) !!}
                                                        ({{ optional($service->reviews)->count() }})
                                                    </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <h5 class="common-title"> <a href="{{ route('service.list.details',$service->slug) }}">{{ $service->title }}</a> </h5>
                                                <span class="single_location"> <i class="las la-map-marker-alt"></i> {{ optional($service->serviceCity)->service_city }}, {{ optional(optional($service->serviceCity)->countryy)->country }} </span>

                                                <!-- <p class="common-para"> {{ Str::limit(strip_tags($service->description),100) }} </p> -->
                                                <div class="service-price mt-0" >
                                                    <span class="starting">{{ __('Starting at') }}</span>
                                                    <span class="prices" style="color: rgba(3, 152, 158, 1);" > ₹ {{ $service->price }} </span>
                                                </div>
                                                <div class="btn-wrapper d-flex flex-wrap">
                                                    <a href="{{ route('service.list.book',$service->slug) }}" class="cmn-btn btn-small btn-bg-1 form-control" style="background-color: rgba(3, 152, 158, 1);"> {{ __('Book Appointment') }} </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-lg-4 margin-top-30  order-1 order-lg-2">
                    <div class="service-details-package">
                        <div class="single-packages">
                            <ul class="package-price">
                                <li> {{ get_static_option('service_details_package_title') ?? __('Package') }} </li>
                                <li style="color: rgba(3, 152, 158, 1);"> ₹ {{ $service_details->price }} </li>
                            </ul>
                            <div class="details-available-price margin-top-20">
                                <span class="summery-title">
                                    @if($service_details->is_service_online != 1)
                                        <h6 class="tilte-available"> {{ get_static_option('service_details_package_subtitle') ?? __('Available Service Packages') }}</h6>
                                    @else
                                        <ul class='onlilne-special-list'>
                                            <li><i class="las la-clock"></i> {{ __('Delivery Days').': '.$service_details->delivery_days }}</li>
                                            <li><i class="las la-redo-alt"></i> {{ __('Revisions').': '.$service_details->revision }}</li>
                                        </ul>
                                    @endif
                                <ul class="available-list" style="color: rgba(3, 152, 158, 1);">
                                    @foreach($service_includes as $include)
                                        <li> {{ $include['include_service_title'] }} </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="btn-wrapper text-center margin-top-30">
                                <a class="cmn-btn btn-bg-1 d-block" href="{{ route('service.list.book',$service_details->slug) }}" style="background-color: rgba(3, 152, 158, 1);"> {{ get_static_option('service_details_button_title') ?? __('Book Appointment') }} </a>
                                <!-- @if(moduleExists("LiveChat"))
                                    @if(Auth::guard('web')->check())
                                        @if(Auth::guard('web')->user()->user_type == 1)
                                            <br><a class="cmn-btn btn-bg-1 chat-toggle open-button live-chat-button-class-for-style" data-id="{{ $service_details->seller_id }}" data-user="{{ optional($service_details->seller)->name }}"><i class="las la-comments"></i> {{ get_static_option('service_chat_title') ?? sprintf(__('Chat With %s'),optional($service_details->seller)->name) }} </a>
                                        @endif
                                    @endif
                                @endif -->
                            </div>
                        </div>
                        <div class="order-pagkages">
                            @if($completed_order >=1)
                                <span class="single-order"> <i class="las la-check"></i>
                                {{ $completed_order }} {{ __('Order Completed') }}
                            </span>
                            @endif
                            @if($seller_rating_percentage_value >=1)
                                <span class="single-order"> <i class="las la-star"></i>
                                {{ __('Seller Rating:') }}
                                    {{ ceil($seller_rating_percentage_value) }}%
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Details area end -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}"></script>
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
                $('.popup-gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">{{__("The image")}} #%curr%</a> {{__("could not be loaded.")}}',
                        titleSrc: function(item) {
                            return item.el.attr('title');
                        }
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
                                toastr.success(res.message);
                            }else if(res.status == 'danger'){
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
                                toastr.warning(res.message);
                            }
                            $('.service_review_form')[0].reset();
                        }
                    });
                })

            });
        })(jQuery);
    </script>
@endsection
