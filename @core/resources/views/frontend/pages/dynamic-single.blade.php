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
    {!! $page_post->title !!}
@endsection
@section('nav-style')
    {{$page_post->navbar_variant}}
@endsection

@section('content')

    @if($page_post->page_builder_status === 'on')

        @if(!auth()->guard('web')->check() && $page_post->visibility === 'all')
            @include('frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_post])
        @elseif(auth()->guard('web')->check())
            @include('frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_post])
        @else
           <section class="padding-top-100 padding-bottom-100">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="alert alert-warning">
                               <p><a class="text-primary" href="{{route('user.login')}}">{{__('Login')}}</a> {{__(' to see this page')}} </p>
                           </div>
                       </div>
                   </div>
               </div>
           </section>
        @endif
    @else
        @include('frontend.partials.dynamic-content')
    @endif
@endsection
