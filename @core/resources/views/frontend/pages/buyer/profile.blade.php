@extends('frontend.frontend-page-master')
@section('page-meta-data')
    <title> {{ $buyer->name  }}</title>
@endsection
@section('style')
    <style>
        .profile-flex-content {
            flex-wrap: nowrap !important;
        }
        .seller-social-links {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }
        .seller-social-links a {
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 25px;
            width: 25px;
            background-color: #fff;
            color: var(--main-color-one);
            border-radius: 50%;
            transition: all .3s;
        }
        .seller-social-links a:hover{
            background-color: var(--main-color-one);
            color: #fff;
        }
        .seller-verified{
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            background-color: var(--main-color-one);
            color: #fff;
            border-radius: 50%;
        }
        .profile-flex-content .profile-contents .title {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;
            position: absolute;
            z-index: 1;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
    </style>
@endsection
@section('content')
    <!-- Banner Inner area Starts -->
    @if(!empty($buyer))
        <div class="banner-inner-area section-bg-2 padding-top-40 padding-bottom-70">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6 margin-top-30">
                        <div class="profile-author-contents">
                            <div class="profile-flex-content">
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($buyer->image) !!}
                                </div>
                                <div class="profile-contents">
                                    <h4 class="title">
                                        <a href="{{ route('about.buyer.profile',$buyer->username) }}"> {{ $buyer->name }} </a>
                                        @if($buyer->email_verified == 1)
                                            <div data-toggle="tooltip" data-placement="top" title="{{__('This Buyer is verified')}}">
                                                <span class="seller-verified"> <i class="las la-check"></i> </span>
                                            </div>
                                        @endif
                                    </h4>
                                    
                                    @if($job_rating >=1)
                                        <div class="profiles-review">
                                            <span class="reviews">
                                                <b>{!! ratting_star(round($job_rating,1) ) !!} </b>
                                                ({{ $job_reviews->count() }})
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 margin-top-30">
                        <div class="profile-author-contents">
                            <ul class="profile-about">
                                <li> {{ __('From:') }} <span> {{ optional($buyer->country)->country }} </span> </li>
                                <li> {{ __('Buyer Since:') }} <span> {{ Carbon\Carbon::parse($buyer_since->created_at)->year }}  </span> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 margin-top-30">
                        <div class="profile-author-contents">
                            <div class="profile-single-achieve">
                                <div class="single-achieve">
                                    <div class="achieve-inner">
                                        <div class="icon">
                                            <i class="las la-briefcase"></i>
                                        </div>
                                        <div class="contents margin-top-10">
                                            <h3 class="title">@if(!empty($total_job_posts)){{ $total_job_posts }} @endif</h3>
                                            <span class="ratings-span"> {{ __('Total Posted Jobs') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-achieve">
                                    <div class="achieve-inner">
                                        <div class="icon"><i class="las la-star"></i></div>
                                        <div class="contents margin-top-10">
                                            <h3 class="title">@if(!empty($buyer_rating_percentage_value)) {{ ceil($buyer_rating_percentage_value) }}% @endif</h3>
                                            <span class="ratings-span">{{ __('Buyer Rating') }} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Job Post starts -->
    @if(!empty($jobs))
        <section class="services-area padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-two">
                            <h3 class="title">{{ __('Job of this Buyer') }} </h3>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-50">
                    <div class="col-lg-12">
                        <div class="services-slider dot-style-one">
                            @forelse($jobs as $job)
                                <div class="single-services-item">
                                    <div class="single-service">
                                        <a href="{{ route('service.list.details',$job->slug) }}" class="service-thumb service-bg-thumb-format"  {!! render_background_image_markup_by_attachment_id($job->image) !!}>

                                            @php
                                                  $title =  $job->title;
                                                  $slug =  $job->slug;
                                                  $route = route('job.post.details',$slug);

                                                    // offline and online job location show
                                                   $job_country =  optional($job->country)->country;
                                                   $job_city =  optional($job->city)->service_city;
                                                   if($job_country){
                                                        $job_location = $job_country .' , '. $job_city;
                                                    }else{
                                                        $job_location = __('Online');
                                                    }

                                                  $is_job_hired = optional($job->job_request)->where('is_hired',1)->count() ?? 0;
                                                  $hired = __('Already Hired');

                                                  if($is_job_hired >= 1){
                                                      $apply = '<a href="javascript:void(0)" class="btn btn-danger w-100" disabled>'.$hired.'</a>';
                                                  }elseif($job->dead_line >= date('Y-m-d h:i:s')){
                                                      $apply = '<a href="'.$route.'" class="cmn-btn btn-small btn-bg-1 w-100">'.__('Apply Now').' </a>';
                                                  }else {
                                                      $apply = __('Expired');
                                                  }
                                            @endphp

                                            @if($job->featured == 1)
                                                <div class="award-icons">
                                                    <i class="las la-award"></i>
                                                </div>
                                            @endif
                                            <div class="country_city_location">
                                                <span class="single_location"> <i class="las la-map-marker-alt"></i>
                                                    {{ $job_location }}
                                                  </span>
                                            </div>
                                        </a>
                                        <div class="services-contents">
                                            <ul class="author-tag">
                                                <li class="tag-list">
                                                    <a href="{{ route('about.seller.profile',optional($job->buyer)->username) }}">
                                                        <div class="authors">
                                                            <a href="{{ route('about.buyer.profile',optional($job->buyer)->username) }}">
                                                            <div class="thumb">
                                                                {!! render_image_markup_by_attachment_id(optional($job->buyer)->image) !!}
                                                                <span class="notification-dot"></span>
                                                            </div>
                                                            </a>
                                                            <a href="{{ route('about.buyer.profile',optional($job->buyer)->username) }}">
                                                            <span class="author-title">{{ optional($job->buyer)->name }} </span>
                                                            </a>
                                                        </div>
                                                    </a>
                                                </li>
                                                    @if(!empty($job->reviews))
                                                        <li class="tag-list">
                                                            <a href="javascript:void(0)">
                                                            <span class="reviews">
                                                                {!! ratting_star(round(optional($job->reviews)->avg('rating'),1)) !!}
                                                                ({{ optional($job->reviews)->count() }})
                                                            </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                            </ul>

                                            <h5 class="common-title"> <a href="{{$route}}">{{ $job->title }} </a> </h5>
                                            <p class="common-para"> {{ \Illuminate\Support\Str::limit(strip_tags($job->description),100) }} </p>
                                            <div class="service-price">
                                                <span class="starting">{{ __('Starting at') }} </span>
                                                <span class="prices"> {{ amount_with_currency_symbol( $job->price) }} </span>
                                            </div>
                                            <div class="btn-wrapper d-flex flex-wrap">
                                                {!! $apply !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3 class="text-warning">{{__('No Job Found')}}</h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Job Post ends -->

    <!-- Review buyer area Starts -->
    @if($job_reviews-> count() >= 1)
        <div class="review-seller-area padding-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-two">
                            <h3 class="title">{{ __('Reviews as Buyer') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="review-seller-wrapper">
                            <div class="about-review-tab">
                                @foreach($job_reviews as $review)
                                    <div class="about-seller-flex-content style-02">
                                        <div class="about-seller-thumb">
                                            {!! render_image_markup_by_attachment_id(optional($review->seller)->image) !!}
                                        </div>
                                        <div class="about-seller-content">
                                            <h5 class="title"> {{ $review->name }} </h5>
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
                            </div>
                        </div>
                    </div>
                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            {!! $job_reviews->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Review buyer area ends -->

@endsection
