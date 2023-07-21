@if(!empty($services))
    @if(!empty($single_service))
    <input type="hidden" name="seller_id" id="seller_id" value="{{ $single_service->seller_id }}">
    @endif
    @foreach($services as $service)
    <div class="col-lg-4 col-md-6 margin-top-30 all-services">
        <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
            <a href="{{ route('service.list.details',$service->slug) }}" class="service-thumb">
                {!! render_image_markup_by_attachment_id($service->image) !!}
                <div class="award-icons">
                    <i class="las la-award"></i>
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
                    <li class="tag-list">
                        @if($service->reviews->count() >= 1)
                        <a href="javascript:void(0)">
                            <span class="icon">{{ __('Rating:') }}</span>
                            <span class="reviews">
                                {{ round(optional($service->reviews)->avg('rating'),1) }} 
                                ({{ optional($service->reviews)->count() }})
                            </span>
                        </a>
                        @endif
                    </li>
                </ul>
                <h5 class="common-title"> <a href="{{ route('service.list.details',$service->slug) }} "> {{ $service->title }} </a> </h5>
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
@else 
<h2>{{ __('No Service Found') }}</h2>    
@endif