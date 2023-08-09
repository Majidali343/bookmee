<?php
use Illuminate\Support\Str;
use App\Review;
?>

@extends('frontend.frontend-page-master')

@section('site-title')
    @if ($category != '')
        {{ $category->name }}
    @endif
@endsection

@section('page-title')
    @if ($category != '')
        {{ $category->name }}
    @endif
@endsection
@section('page-meta-data')
    {!! render_site_title($category->name) !!}
    <meta name="title" content="{{ $category->name }}">

    {!! render_page_meta_data_for_category($category) !!}
@endsection
@section('inner-title')
    @if ($category != '')
        {{ $category->name }}
    @endif
@endsection

<style>
    .service-thumb {
        background-size: cover;
        background-position: center !important;
    }

    .slick-slide,
    .single-service {
        min-height: 450px;
    }

    .single-service {
        display: flex;
        overflow: hidden;
        flex-direction: column;
        justify-content: flex-start;
        /* max-width: 330px;
        min-width: 330px; */

    }

    .services-contents {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* min-height: 370px;
        max-height: 380px; */
    }

    .sectionfontsize {
        font-size: 30px;
        line-height: 40px;
        font-weight: 600;
    }

    .discount {
        position: relative;
        left: 200px;
        top: 63px;
        z-index: 100;
        padding-left: 10px;
        padding-top: 7px;
        Width: 119px;
        Height: 36px;
        border-Radius: 60px;
        Gap: 10px;
        background-color:#ffffffe6 ;
        Font-family: "Inter";
        font-Weight: 600;
        Size: 14px;
        color: black;
    }
</style>


@section('content')

    <section class="services-area" style="padding-top:60px;padding-bottom:60px;background-color:white">
        <div class="container">
            <div class="">
                <div class="">
                    <div class="section-title" style="text-align: left;">
                        <h2 class="sectionfontsize">{{ sprintf(__('Available Businesses in %s'), $category->name) }}</h2>

                    </div>
                </div>
            </div>


            {{-- <div class="row margin-top-50 " >
                <div class="col-lg-12">
                    <div class="services-slider dot-style-one">
                        @if ($Vendors->count() > 0)
                        @for ($i = 0; $i < $Vendors->count(); $i++)
                                <div class="single-services-item wow fadeInUp" data-wow-delay=".2s" >

                                    <div class="single-service">

                                        @if (!@empty($discounts[$i]))
                                                
                                                    <div class="discount" >save upto {{Str::limit($discounts[$i], 3, '')}}%</div>
                                                    @else
                                                    <div style=" margin-top: 38px" ></div>
                                                    @endif
                                        <a href="/{{  $Vendors[$i]->username }}"
                                            class="service-thumb location_relative service-bg-thumb-format"
                                            style="background-image: url({{ get_attachment_image_by_id($Vendors[$i]->image)['img_url'] }});"></a>
                                        <div class="services-contents">
                                            <div>
                                                <ul class="author-tag">
                                                    <li class="tag-list w-100">
                                                        <a href="/{$slug}" class="w-100">
                                                            <div
                                                                class="authors d-flex flex-wrap justify-content-between w-100">
                                                                <span class="author-title" style="font-size: 24px;"> {$title} </span>
                                                                <span class="author-title" style="font-size: 24px;">
                                                                    {{ Str::limit($Vendors[$i]->name, 10, '...') }} </span>
                                                                <span
                                                                    class="icon review-star"style="font-size: 24px; color:var(--main-color-two)">
                                                                   
                                                                    <span style="font-size: 18px;">  
                                                                        @if (Review::where('seller_id', $Vendors[$i]->id)->count('service_id') > 0)

                                                                        ({{ Review:: where('seller_id', $Vendors[$i]->id)
                                                                        ->count('service_id')  ;}} )

                                                                        @endif
                                                                    </span>

                                                                    {{ $Reviews[$i] ? :''}}
                                                                    <i class="las la-star"></i>
                                                                </span>

                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="tag-list">

                                                    </li>
                                                </ul>
                                                <div>
                                                    <div>
                                                        <span
                                                            class="icon review-star"style="font-size: 16px; color:var(--main-color-two)">
                                                            {{  Str::limit($Vendors[$i]->address, 20, '...')   }}
                                                            <i class="las la-map-marker"></i>
                                                        </span>
                                                    </div>
                                                    <p class="common-para" style="height:115px">
                                                        {{ Str::limit($Vendors[$i]->about, 150, '...') }}</p> 
                                                    <p class="common-para" style="padding-bottom:10px;"></p>
                                                </div>

                                            </div>
                                            <div class="btn-wrapper">
                                                <a href="/{{ $Vendors[$i]->username }}"
                                                    class="cmn-btn btn-appoinment btn-bg-1">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>

            </div>  
            </div>  --}}



        </div>


        <div class="row margin-top-50">

            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-center">
                    @if ($Vendors->count() > 0)
                        @for ($i = 0; $i < $Vendors->count(); $i++)
                            <div class="single-services-item wow fadeInUp" data-wow-delay=".2s" style="width: 390px;   ">

                                <div class="single-service">

                                    @if (!@empty($discounts[$i]))
                                        <div class="discount">save upto {{ $discounts[$i] }}%</div>
                                    @else
                                        <div></div>
                                    @endif
      

                                    @if (
                                        $Vendors[$i]->image !== null &&
                                            $Vendors[$i]->image !== "NULL" &&
                                            $Vendors[$i]->image !== "" &&
                                            get_attachment_image_by_id($Vendors[$i]->image)['img_url'] !== "")
                                        <a href="/{{ $Vendors[$i]->username }}"
                                            class="service-thumb location_relative service-bg-thumb-format"
                                            style="background-image: url({{ get_attachment_image_by_id($Vendors[$i]->image)['img_url'] }});"></a>
                                    @else
                                        <a href="/{{ $Vendors[$i]->username }}"
                                            class="service-thumb location_relative service-bg-thumb-format"> <img
                                                style="height: 233px; object-fit: contain "
                                                src={{ asset('/assets/uploads/no-profile.png') }} alt=""></a>
                                    @endif


                                    <div class="services-contents">
                                        <div>
                                            <ul class="author-tag">
                                                <li class="tag-list w-100">
                                                    <a href="/{{ $Vendors[$i]->username }}" class="w-100">
                                                        <div class="authors d-flex flex-wrap justify-content-between w-100">
                                                            <span class="author-title" style="font-size: 24px;">
                                                                {{ Str::limit($Vendors[$i]->name, 13, '...') }} </span>
                                                            <span
                                                                class="icon review-star"style="font-size: 24px; color:var(--main-color-two)">

                                                                <span style="font-size: 18px;">
                                                                    @if (Review::where('seller_id', $Vendors[$i]->id)->count('service_id') > 0)
                                                                        ({{ Review::where('seller_id', $Vendors[$i]->id)->count('service_id') }}
                                                                        )
                                                                    @endif
                                                                </span>

                                                                {{ $Reviews[$i] }}
                                                                <i style="color:#FFB700;" class="las la-star"></i>
                                                            </span>

                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tag-list">
                                                </li>
                                            </ul>
                                            <div>
                                                <div>
                                                    <span
                                                        class="icon review-star"style="font-size: 16px; color:var(--main-color-two)">
                                                        {{ Str::limit($Vendors[$i]->address, 20, '...') }}

                                                        <i class="las la-map-marker"></i>
                                                    </span>
                                                </div>
                                                {{-- <p class="common-para">{{ Str::limit($vendors[$i]->about, 150, '...') }}</p> --}}
                                                <p class="common-para" style="padding-bottom:10px;"></p>
                                            </div>

                                        </div>
                                        <div class="btn-wrapper">

                                            {{-- <a href="/{{$Vendors[$i]->username }}" --}}

                                            <a href="/{{ $Vendors[$i]->username }}"
                                                class="cmn-btn btn-appoinment btn-bg-1">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {{-- {!! $services->links() !!} --}}
                                </div>
                            </div>
                        </div>
                    @else
                        <h2 class="text-warning">{{ __('Nothing Found...') }}</h2>
                    @endif

                </div>

            </div>
        </div>
    </section>


    {{-- <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="mb-4">
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="section-sub-title ">{{ sprintf(__('Available services in %s'), $category->name) }}</h2>
                    @php $current_page_url = Illuminate\Support\Facades\URL::current(); @endphp
                   
                    <div class="category-service-search-form margin-top-50">
                        <form method="get" action="{{ $current_page_url }}" id="search_service_list_form">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="search-input form-control" id="search_by_query"
                                            placeholder="{{ __('write minimum 3 character to search') }}" name="q"
                                            value="{{ request()->get('q') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-category-service">
                                        <div class="single-select">
                                            <select id="search_by_rating" name="rating">
                                                <option value="">{{ __('Select Rating Star') }}</option>
                                                <option value="1" @if (!empty(request()->get('rating')) && request()->get('rating') == 1) selected @endif>
                                                    {{ __('One Star') }}</option>
                                                <option value="2" @if (!empty(request()->get('rating')) && request()->get('rating') == 2) selected @endif>
                                                    {{ __('Two Star') }}</option>
                                                <option value="3" @if (!empty(request()->get('rating')) && request()->get('rating') == 3) selected @endif>
                                                    {{ __('Three Star') }}</option>
                                                <option value="4" @if (!empty(request()->get('rating')) && request()->get('rating') == 4) selected @endif>
                                                    {{ __('Four Star') }}</option>
                                                <option value="5" @if (!empty(request()->get('rating')) && request()->get('rating') == 5) selected @endif>
                                                    {{ __('Five Star') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-category-service flex-category-service">
                                        <div class="single-select">
                                            <select id="search_by_sorting" name="sortby">
                                                <option value="">{{ __('Sort By') }}</option>
                                                <option value="latest_service"
                                                    @if (!empty(request()->get('sortby')) && request()->get('sortby') == 'latest_service') selected @endif>
                                                    {{ __('Latest Service') }}</option>
                                                <option value="lowest_price"
                                                    @if (!empty(request()->get('sortby')) && request()->get('sortby') == 'lowest_price') selected @endif>
                                                    {{ __('Lowest Price') }}</option>
                                                <option value="highest_price"
                                                    @if (!empty(request()->get('sortby')) && request()->get('sortby') == 'highest_price') selected @endif>
                                                    {{ __('Highest Price') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @if ($all_services->count() >= 1)
                    @foreach ($all_services as $service)
                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="{{ route('service.list.details', $service->slug) }}"
                                    class="service-thumb service-bg-thumb-format" {!! render_background_image_markup_by_attachment_id($service->image) !!}>

                                    @if ($service->featured == 1)
                                        <div class="award-icons">
                                            <i class="las la-award"></i>
                                        </div>
                                    @endif
                                    <div class="country_city_location">
                                        <span class="single_location"> <i class="las la-map-marker-alt"></i>
                                            {{ optional($service->serviceCity)->service_city }},
                                            {{ optional(optional($service->serviceCity)->countryy)->country }} </span>
                                    </div>
                                </a>
                                <div class="services-contents">
                                    <ul class="author-tag">
                                        <li class="tag-list">
                                            <a
                                                href="{{ route('about.seller.profile', optional($service->seller)->username) }}">
                                                <div class="authors">
                                                    <div class="thumb">
                                                        {!! render_image_markup_by_attachment_id(optional($service->seller)->image) !!}
                                                        <span class="notification-dot"></span>
                                                    </div>
                                                    <span class="author-title"> {{ optional($service->seller)->name }}
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                        @if ($service->reviews->count() >= 1)
                                            <li class="tag-list">
                                                <a href="javascript:void(0)">
                                                    <span class="reviews">
                                                        {!! ratting_star(round(optional($service->reviews)->avg('rating'), 1)) !!}
                                                        ({{ optional($service->reviews)->count() }})
                                                    </span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <h5 class="common-title"
                                        style="font-size: 16px; color: rgb(3, 152, 158);font-weight: 500; ">
                                        <a href="{{ route('service.list.details', $service->slug) }}">
                                            {{ Str::limit($service->title) }} </a>
                                    </h5>
                                    <p class="common-para"> {{ Str::limit(strip_tags($service->description), 100) }} </p>
                                    <div class="service-price">
                                        <span class="starting"> {{ __('Starting at') }} </span>
                                        <span class="prices"> {{ amount_with_currency_symbol($service->price) }} </span>
                                    </div>
                                    <div class="btn-wrapper d-flex flex-wrap">
                                        <a href="{{ route('service.list.book', $service->slug) }}"
                                            class="cmn-btn btn-small btn-bg-1"> {{ __('Book Now') }} </a>
                                        <a href="{{ route('service.list.details', $service->slug) }}"
                                            class="cmn-btn btn-small btn-outline-1 ml-auto"> {{ __('View Details') }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($all_services->count() >= 9)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $all_services->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning">
                        {{ sprintf(__('No services found in %s'), optional($category)->name) }}</div>
                @endif

            </div>

        </div>
    </section> --}}

@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";

            $(document).on('click', '#load_more_btn', function(e) {
                e.preventDefault();

                let totalNo = $(this).data('total');
                let el = $(this);
                let container = $('#services_sub_category_load_wrap > .row');

                $.ajax({
                    type: "POST",
                    url: "{{ route('service.list.load.more.subcategories') }}",
                    beforeSend: function(e) {
                        el.text("{{ __('loading...') }}")
                    },
                    data: {
                        _token: "{{ csrf_token() }}",
                        total: totalNo,
                        catId: "{{ $category->id }}"
                    },
                    success: function(data) {

                        el.text("{{ __('Load More') }}");
                        if (data.markup === '') {
                            el.hide();
                            container.append(
                                "<div class='col-lg-12'><div class='text-center text-warning mt-3'>{{ __('no more subcategory found') }}</div></div>"
                            );
                            return;
                        }

                        $('#load_more_btn').data('total', data.total);

                        container.append(data.markup);
                    }
                });

            });


        })(jQuery);
    </script>
@endsection
