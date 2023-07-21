@php
    $footer_variant = !is_null(get_navbar_style()) ? get_navbar_style() : '02';
@endphp
@include('frontend.partials.pages-portion.navbars.navbar-'. $footer_variant)
