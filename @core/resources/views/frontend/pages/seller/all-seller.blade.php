@extends('frontend.frontend-page-master')

@section('page-meta-data')
  <title> {{ __('All Sellers') }}</title>
@endsection

@section('page-title')
{{ __('All Sellers') }}
@endsection 

@section('inner-title')
{{ __('All Sellers') }}
@endsection

@section('content')

    <!-- Category Service area starts -->
    <section class="category-services-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">

                @if(!empty($seller_lists))
                
                    @foreach($seller_lists as $seller)
                    @php
                        $img_url = get_attachment_image_by_id($seller->image);
                        if($img_url['img_url']){
                            $seller_image =  render_background_image_markup_by_attachment_id($seller->image);
                        }else{
                            $seller_image = 'style="background-image:url('.asset('assets/uploads/no-image.png').')"';
                        }
                    @endphp
                
                        <div class="col-lg-3 col-md-6">
                        <div class="single_seller_profile gray_bg">
                            <div class="thumb" {!! $seller_image !!}></div>
                            <div class="content_area_wrap">
                                <h4 class="title">
                                    <a href="{{route('about.seller.profile',$seller->username)}}">{{$seller->name}}</a>
                                    @if(optional($seller->sellerVerify)->status==1)
                                        <div data-toggle="tooltip" data-placement="top" title="{{__('This seller is verified by the site admin according his national id card.')}}"> <span class="seller-verified"> <i class="las la-check"></i> </span></div>
                                    @endif
                                </h4>
                                 @if(optional($seller->review)->avg('rating') >=1) 
                                    <div class="profiles-review">
                                        <span class="reviews">
                                            <b>{!! ratting_star(round(optional($seller->review)->avg('rating'), 1)) !!}</b>
                                            ({{optional($seller->review)->count()}})
                                        </span>
                                    </div>
                                @endif
                                <span class="order_completation">{{$seller->order->where('status', 2)->count() ?? 0}} {{__('Order Completed')}}</span> 
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($seller_lists->count() >= 12)
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $seller_lists->links() !!}
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
