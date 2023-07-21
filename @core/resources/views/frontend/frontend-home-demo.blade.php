@include('frontend.partials.header')
@include('frontend.home-pages.home-'.$home_page,['home_variant' => $home_page])
@include('frontend.partials.footer')
