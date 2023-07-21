@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Order Cancelled Of:'.' '.$order_details->package_name)}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area">
                        <h1 class="title">{{get_static_option('site_order_cancel_page_' . get_user_lang() . '_title')}}</h1>
                        <h3 class="sub-title">
                            @php
                                $subtitle = get_static_option('site_order_cancel_page_' . get_user_lang() . '_subtitle');
                                $subtitle = str_replace('{pkname}',$order_details->package_name,$subtitle);
                            @endphp
                            {{$subtitle}}
                        </h3>
                        <p>
                            {{get_static_option('site_order_cancel_page_' . get_user_lang() . '_description')}}
                        </p>
                        <div class="btn-wrapper">
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
