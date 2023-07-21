@php
    use App\Review;
    use Illuminate\Support\Str;
@endphp

@extends('frontend.frontend-page-master')

@section('site-title')
    {{ __('Home') }}
@endsection

@section('page-title')
    {{ __('Search') }}
@endsection

@section('inner-title')
    {{ __('Businesses | '.$query) }}
@endsection

@section('content')
    <!-- Category Service area starts -->
    <section class="category-services-area padding-top-100 padding-bottom-100">
        
        <div class="container">
            <div class="row margin-top-20">
                <style>
                    .service-thumb{
                        background-size: cover;
                        background-position: center!important;
                    }
                    .slick-slide,  .single-service{
                        min-height: 450px;
                    }
                    .single-service{
                        display: flex;
                        overflow: hidden;
                        flex-direction: column;
                        justify-content: flex-start;
                    }
                    .services-contents{
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        /* min-height: 370px;
                        max-height: 370px; */
                    }
                    .discount{
                    position: relative;
                    left: 238px;
                    top: 63px;
                    z-index: 100;
                    padding-left: 10px;
                    padding-top: 7px;
                    Width : 119px;
                    Height : 36px;
                    border-Radius :60px;
                    Gap :10px;
                    background-color: #03989E4D;
                    Font-family :"Inter";
                    font-Weight : 600;
                    Size : 14px;
                    color: #03989E;
                }
                </style>
               
                <div class="row margin-top-50">
                
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap justify-content-center">
                            @if ($vendors->count() > 0)
                                @for (  $i=0 ; $i< $vendors->count();  $i++)
 
                                    <div class="single-services-item wow fadeInUp" data-wow-delay=".2s" style="width: 390px;">
                                        <div class="single-service">
                                                                                           
                                                    @if (!@empty($discounts[$i]))
                                                
                                                    <div class="discount" >save upto {{$discounts[$i]}}%</div>
                                                    @else
                                                    <div style=" margin-top: 38px" ></div>
                                                    @endif

                                                
                                           
                                            
                                            <a href="/{{ $vendors[$i]->username }}"
                                                class="service-thumb location_relative service-bg-thumb-format"
                                                style="background-image: url({{ get_attachment_image_by_id($vendors[$i]->image)['img_url'] }});"></a>
                                            <div class="services-contents">
                                                <div>
                                                    <ul class="author-tag">
                                                        <li class="tag-list w-100">
                                                            <a href="/{{ $vendors[$i]->username }}" class="w-100">
                                                                <div
                                                                    class="authors d-flex flex-wrap justify-content-between w-100">
                                                                    <span class="author-title" style="font-size: 24px;">
                                                                        {{ Str::limit($vendors[$i]->name, 13, '...') }} </span>
                                                                    <span
                                                                        class="icon review-star"style="font-size: 24px; color:var(--main-color-two)">
                                                                        
                                                                        <span style="font-size: 18px;">  
                                                                            @if(Review:: where('seller_id', $vendors[$i]->id)
                                                                            ->count('service_id') > 0)

                                                                            ({{ Review:: where('seller_id', $vendors[$i]->id)
                                                                            ->count('service_id')  ;}} )

                                                                            @endif
                                                                        </span>

                                                                        {{ $reviews[$i] }}
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
                                                                {{  Str::limit($vendors[$i]->address, 20, '...')   }}
                                                               
                                                                <i class="las la-map-marker"></i>
                                                            </span>
                                                        </div>
                                                        {{-- <p class="common-para">{{ Str::limit($vendors[$i]->about, 150, '...') }}</p> --}}
                                                        <p class="common-para" style="padding-bottom:10px;"></p>
                                                    </div>

                                                </div>
                                                <div class="btn-wrapper">
                                                    <a href="/{{ $vendors[$i]->username }}"
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
            </div>
        </div>

    </section>
    <!-- Category Service area end -->

@endsection
