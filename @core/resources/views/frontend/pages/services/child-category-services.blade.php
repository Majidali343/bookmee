@extends('frontend.frontend-page-master')

@section('site-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection

@section('page-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection
@section('page-meta-data')
    {!! render_site_title($child_category->name) !!}
    <meta name="title" content="{{$child_category->name}}">
    {!!  render_page_meta_data_for_child_category($child_category) !!}
@endsection

@section('inner-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection

@section('content')
    <!-- Child Category Service area starts -->
    <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            @php $current_page_url = Illuminate\Support\Facades\URL::current(); @endphp
            <form method="get" action="{{ $current_page_url }}" id="search_service_list_form">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <div class="form-group">
                            <input type="text" class="search-input form-control" id="search_by_query" placeholder="{{__('write minimum 3 character to search')}}" name="q" value="{{request()->get('q')}}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-category-service">
                            <div class="single-select">
                                <select id="search_by_rating" name="rating">
                                    <option value="">{{ __('Select Rating Star') }}</option>
                                    <option value="1" @if(!empty(request()->get('rating')) && request()->get('rating') == 1 ) selected @endif>{{ __('One Star') }}</option>
                                    <option value="2" @if(!empty(request()->get('rating')) && request()->get('rating') == 2 ) selected @endif>{{ __('Two Star') }}</option>
                                    <option value="3" @if(!empty(request()->get('rating')) && request()->get('rating') == 3 ) selected @endif>{{ __('Three Star') }}</option>
                                    <option value="4" @if(!empty(request()->get('rating')) && request()->get('rating') == 4 ) selected @endif>{{ __('Four Star') }}</option>
                                    <option value="5" @if(!empty(request()->get('rating')) && request()->get('rating') == 5 ) selected @endif>{{ __('Five Star') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-category-service flex-category-service">
                            <div class="single-select">
                                <select id="search_by_sorting" name="sortby">
                                    <option value="">{{ __('Sort By') }}</option>
                                    <option value="latest_service" @if(!empty(request()->get('sortby')) && request()->get('sortby') == 'latest_service') selected @endif>{{ __('Latest Service') }}</option>
                                    <option value="lowest_price" @if(!empty(request()->get('sortby')) && request()->get('sortby') == 'lowest_price') selected @endif>{{ __('Lowest Price') }}</option>
                                    <option value="highest_price" @if(!empty(request()->get('sortby')) && request()->get('sortby') == 'highest_price') selected @endif>{{ __('Highest Price') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="row">

                @if($all_services->count() >= 1)
                    @foreach($all_services as $service)

                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="{{ route('service.list.details',$service->slug) }}" class="service-thumb service-bg-thumb-format" {!! render_background_image_markup_by_attachment_id($service->image) !!}>

                                    @if($service->featured == 1)
                                        <div class="award-icons">
                                            <i class="las la-award"></i>
                                        </div>
                                    @endif
                                    <div class="country_city_location">
                                        <span class="single_location"> <i class="las la-map-marker-alt"></i> {{ optional($service->serviceCity)->service_city }}, {{ optional(optional($service->serviceCity)->countryy)->country }} </span>
                                    </div>
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
                                                    <span class="author-title"> {{ optional($service->seller)->name }} </span>
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
                                    <h5 class="common-title"> <a href="{{ route('service.list.details',$service->slug) }}"> {{ Str::limit($service->title) }} </a> </h5>
                                    <p class="common-para"> {{ Str::limit(strip_tags($service->description),100) }} </p>
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
                    @if($all_services->count() >= 9)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $all_services->links() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning">{{sprintf(__('No services found in %s'),optional($child_category)->name)}}</div>
                @endif

            </div>

        </div>
    </section>
    <!-- child Category Service area end -->

@endsection
