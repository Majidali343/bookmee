@extends('frontend.frontend-master')
@section('content')
    @include('frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_details])
@endsection
