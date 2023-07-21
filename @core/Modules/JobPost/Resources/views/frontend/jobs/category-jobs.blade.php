@extends('frontend.frontend-page-master')

@section('site-title')
    @if($category !='')
        {{ $category->name }}
    @endif
    @if($sub_category !='')
        {{ $sub_category->name }}
    @endif
@endsection

@section('page-title')
    @if($category !='')
        {{ $category->name }}
    @endif
    @if($sub_category !='')
        {{ $sub_category->name }}
    @endif
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/job-post.css')}}">
@endsection

@section('inner-title')

    @if($category !='')
        {{ __('Category:') }} {{ $category->name }}
    @endif
    @if($sub_category !='')
        {{ __('Category:') }} {{ $sub_category->name }}
    @endif
@endsection

@section('content')
    <!-- Category jobs area starts -->
    <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">

                @if($all_jobs->count() >= 1)
                    @foreach($all_jobs as $job)

                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="{{ route('job.post.details',$job->slug) }}" class="service-thumb">
                                    <div class="category_jobs bg-image" {!! render_background_image_markup_by_attachment_id($job->image) !!}></div>
                                    <div class="country_city_location">
                                        <span class="single_location" style="color:#fff">
                                            <i class="las la-map-marker-alt"></i>
                                            @if($job->is_job_online == 0)
                                                {{ optional($job->country)->country }}
                                                    <span> , </span>
                                                 {{ optional($job->city)->service_city }}
                                            @else
                                                <span>{{ __('Online') }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="services-contents">
                                    <ul class="author-tag">
                                        <li class="tag-list">
                                            <a href="#">
                                                <div class="authors">
                                                    <div class="thumb">
                                                        {!! render_image_markup_by_attachment_id(optional($job->buyer)->image) !!}
                                                        <span class="notification-dot"></span>
                                                    </div>
                                                    <span class="author-title"> {{ optional($job->buyer)->name }} </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <h5 class="common-title"> <a href="{{ route('job.post.details',$job->slug) }}"> {{ Str::limit($job->title) }} </a> </h5>
                                    <p class="common-para"> {{ Str::limit(strip_tags($job->description),100) }} </p>
                                    <div class="service-price">
                                        <span class="starting"> {{ __('Starting at') }} </span>
                                        <span class="prices"> {{ amount_with_currency_symbol($job->price) }} </span>
                                    </div>
                                    <div class="btn-wrapper d-flex flex-wrap">
                                        <a href="{{ route('job.post.details',$job->slug) }}" class="cmn-btn btn-small btn-bg-1"> {{ __('Apply Now') }} </a>
                                        <a href="{{ route('job.post.details',$job->slug) }}" class="cmn-btn btn-small btn-outline-1 ml-auto"> {{ __('View Details') }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($all_jobs->count() >= 9)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $all_jobs->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning">{{sprintf(__('No services found in %s'),optional($category)->name)}}</div>
                @endif

            </div>
        </div>
    </section>
    <!-- Category jobs area end -->

@endsection
