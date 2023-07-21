@extends('frontend.frontend-page-master')


@section('page-meta-data')
{!! render_site_title($page_post->meta_title ?? $page_post->title) !!}
<!-- Primary Meta Tags -->
<meta name="title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta name="description" content="{{optional($page_post->meta_data)->meta_description}}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{Illuminate\Support\Facades\URL::current()}}">
<meta property="og:title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta property="og:description" content="{{optional($page_post->meta_data)->meta_description}}">
{!! render_og_meta_image_by_attachment_id(optional($page_post->meta_data)->facebook_meta_image) !!}

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{Illuminate\Support\Facades\URL::current()}}">
<meta property="twitter:title" content="{{optional($page_post->meta_data)->meta_title}}">
<meta property="twitter:description" content="{{optional($page_post->meta_data)->meta_description}}">
{!! render_twitter_meta_image_by_attachment_id(optional($page_post->meta_data)->twitter_meta_image) !!}
@endsection

@section('page-title')
{{  optional(getPageDetailsFromSlug('service_list_page'))->title }}
@endsection 
@section('site-title')
{{  optional(getPageDetailsFromSlug('service_list_page'))->title }}
@endsection 
@section('content')

    <!-- Category Service area starts -->
    <section class="category-services-slider dot-style-one dot-color-01 slick-initialized slick-slider slick-dotted padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">

                @if(!empty($all_services))
                    @foreach($all_services as $service)
                        
                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="{{ route('service.list.details',$service->slug) }}" class="service-thumb service-bg-thumb-format" {!! render_background_image_markup_by_attachment_id($service->image) !!}>

                                    @if($service->featured == 1)
                                    <div class="award-icons">
                                        <i class="las la-award"></i>
                                    </div>
                                    @endif
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
                                                    <span class="author-title"> {{ optional($service->seller)->name }}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @if($service->reviews->count() >= 1)
                                        <li class="tag-list">
                                            <a href="javascript:void(0)">
                                                <span class="icon">{{ __('Rating:') }}</span>
                                                <span class="reviews"> 
                                                    {{ round(optional($service->reviews)->avg('rating'),1) }}
                                                    ({{ optional($service->reviews)->count() }})
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                    <h5 class="common-title"> <a href="{{ route('service.list.details',$service->slug) }}"> {{ Str::limit($service->title) }} </a> </h5>
                                    <p class="common-para"> {{ Str::limit(strip_tags($service->description,100)) }} </p>
                                    <div class="service-price">
                                        <span class="starting"> {{ __('Starting at') }} </span>
                                        <span class="prices"> {{ amount_with_currency_symbol($service->price) }} </span>
                                    </div>
                                    <div class="btn-wrapper d-flex flex-wrap">
                                        <a href="{{ route('service.list.book',$service->slug) }}" class="cmn-btn btn-small btn-bg-1"> {{ __('Book Now') }} </a>
                                        <a href="{{ route('service.list.details',$service->slug) }}" class="cmn-btn btn-small btn-outline-1 ml-auto"> {{ __('View Details') }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($all_services->count() >= 6)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $all_services->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
    <!-- Category Service area end -->

@endsection
