@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Add New Ticket')}}
@endsection

@section('style')
    <x-media.css/>
@endsection

@section('content')
   
    <x-frontend.seller-buyer-preloader/>

    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.seller.partials.sidebar')
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{__('Add New Ticket')}} </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 margin-top-50">
                            <div class="single-settings">

                                <div class="mt-5"> <x-msg.error/></div>
                                <h4 class="mb-3">{{ __('Ticket For:') }} {{ optional($order->service)->title }}</h4>
                                <h4 class="mb-5">{{ __('Order ID:') }} #{{ $order->id }}</h4>

                                <form action="{{route('seller.support.ticket.new')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="buyer_id" value="{{ $order->buyer_id }}">
                                    <input type="hidden" name="service_id" value="{{ $order->service_id }}">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input">
                                            <label for="title" class="info-title"> {{__('Title*')}} </label>
                                            <input class="form--control" name="title" id="title" value="{{ @old('title') }}" type="text" placeholder="{{__('Add tilte')}}">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="subject" class="info-title"> {{__('Subject*')}} </label>
                                            <input class="form--control" name="subject" id="subject" value="{{ @old('subject') }}" type="text" placeholder="{{__('Add Subject')}}">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="priority" class="info-title"> {{__('Priority*')}} </label>
                                            <select name="priority" id="priority">
                                                <option value="low">{{__('Low')}}</option>
                                                <option value="medium">{{__('Medium')}}</option>
                                                <option value="high">{{__('High')}}</option>
                                                <option value="urgent">{{__('Urgent')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="description" class="info-title"> {{__('Description*')}} </label>
                                            <textarea class="form--control textarea--form" name="description" placeholder="{{__('Type Description')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-40">
                                        <input type="submit" class="btn btn-success btn-bg-1" value="{{__('Submit Ticket')}} ">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
@endsection  

@section('scripts')
<x-media.js :type="'web'"/>
@endsection