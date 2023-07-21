@extends('frontend.frontend-page-master')

@section('site-title')
{{ __('Category') }}
@endsection
@section('inner-title')
{{ __('All Category') }}
@endsection 

@section('content')
<section class="category-area padding-top-100 padding-bottom-100">
    <div class="container container-two">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-two">
                    <h3 class="title">{{ __('Categories') }}</h3>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            @foreach($all_category as $cat)
            <div class="col-xl-2 col-lg-3 col-sm-6 margin-top-30 category-child">
                <div class="single-category style-02 wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="icon">
                        {!! render_image_markup_by_attachment_id($cat->image,'','','thumb'); !!}
                    </div>
                    <div class="category-contents">
                        <h4 class="category-title"> <a href="{{ route('service.list.category',$cat->slug) }}"> {{ $cat->name }} </a> </h4>
                        <span class="category-para"> {{ $cat->services->count() }}+ {{ __('Service') }} </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
