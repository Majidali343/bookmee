@extends('frontend.frontend-page-master')

@section('site-title')
{{ __('Order Details') }}
@endsection

@section('content')

    <!-- Seller Order View area starts -->
    <div class="seller-view-area padding-bottom-100 padding-top-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="seller-order-view-details">
                        <h3 class="title-seller">{{ __('Your Order Details') }}</h3>
                        <div class="seller-order-view-all border-bg-1 border-2px margin-top-55">
                            <div class="single-order-views">
                                <h4 class="common-title-two">{{ optional($order_details->service)->title }} </h4>
                                <div class="seller-status-flex-content">
                                    <div class="status-flex-single">
                                        <h6 class="date-titles"> {{ $order_details->created_at->toFormattedDateString() }} </h6>
                                        <div class="checkbox-inlines">
                                            <input class="check-input" type="checkbox" id="Paypal">
                                            <label class="checkbox-label" for="Paypal"> {{ $order_details->payment_gateway }} </label>
                                        </div>
                                    </div>
                                    <div class="status-flex-single">
                                        <div class="btn-wrapper margin-bottom-15">
                                            <a href="javascript:void(0)" class="cmn-btn btn-bg-1 btn-small-height">{{ __('Pay Now') }} </a>
                                        </div>
                                        <h5 class="order-titles"> {{ __('Order') }} #{{ $order_details->id }} </h5>
                                        <span class="reviews"> <i class="las la-star"></i> </span>
                                        <span class="reviews"> <i class="las la-star"></i> </span>
                                        <span class="reviews"> <i class="las la-star"></i> </span>
                                        <span class="reviews"> <i class="las la-star"></i> </span>
                                        <span class="reviews"> <i class="las la-star"></i> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-info padding-top-50">
                                <h2 class="title">{{ __('Booking Information ') }}</h2>
                                <div class="booking-details">
                                    <ul class="booking-list style-02">
                                        <li class="lists">
                                            <span class="list-span"> {{ __('Name:') }}</span>
                                            <span class="list-strong">{{ $order_details->name }}</span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span">{{ __('Email:') }} </span>
                                            <span class="list-strong"> {{ $order_details->email }} </span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span">{{ __('Phone:') }} </span>
                                            <span class="list-strong">{{ $order_details->phone }}</span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span">{{ __('City: ') }}</span>
                                            <span class="list-strong"> {{ optional($order_details->city)->service_city }} </span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span"> {{ __('Area:') }} </span>
                                            <span class="list-strong">{{ optional($order_details->area)->service_city }} </span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span">{{ __('Post Code:') }} </span>
                                            <span class="list-strong">{{ $order_details->post_code }} </span>
                                        </li>
                                        <li class="lists">
                                            <span class="list-span"> {{ __('Address:') }}</span>
                                            <span class="list-strong"> {{ $order_details->address }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="seller-view-booking margin-top-50">
                                <h2 class="common-title-three"> Booking Summery </h2>
                                <div class="overview-summery-contents">
                                    <div class="single-summery">
                                        <span class="summery-title"> Appointment Service </span>
                                        <div class="summery-list-all">
                                            <ul class="summery-list">
                                                @foreach($order_includes as $include)
                                                <li class="list">
                                                    <span class="rooms"> Bed Room</span>
                                                    <span class="room-count">3</span>
                                                    <span class="value-count">$90</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <ul class="summery-result-list">
                                                <li class="result-list">
                                                    <span class="rooms"> <strong>Appoinment Fee</strong></span>
                                                    <span class="value-count"><strong>$150</strong></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-summery">
                                        <span class="summery-title"> Extra Service </span>
                                        <div class="summery-list-all">
                                            <ul class="summery-list">
                                                <li class="list">
                                                    <span class="rooms"> Kitchen</span>
                                                    <span class="room-count">1</span>
                                                    <span class="value-count">$50</span>
                                                </li>
                                                <li class="list">
                                                    <span class="rooms"> Fridge</span>
                                                    <span class="room-count">1</span>
                                                    <span class="value-count">$20</span>
                                                </li>
                                                <li class="list">
                                                    <span class="rooms"> Garden</span>
                                                    <span class="room-count">1</span>
                                                    <span class="value-count">$60</span>
                                                </li>
                                            </ul>
                                            <ul class="summery-result-list result-border padding-bottom-20">
                                                <li class="result-list">
                                                    <span class="rooms"> <strong>Subtotal</strong></span>
                                                    <span class="value-count"><strong>$280</strong></span>
                                                </li>
                                            </ul>
                                            <ul class="summery-result-list result-border padding-bottom-20">
                                                <li class="result-list">
                                                    <span class="rooms"> <strong>Tax(+)15%</strong></span>
                                                    <span class="value-count"><strong>$42</strong></span>
                                                </li>
                                            </ul>
                                            <ul class="summery-result-list">
                                                <li class="result-list">
                                                    <span class="rooms"> <strong>Total</strong></span>
                                                    <span class="value-count"><strong>$280</strong></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Service area end -->
@endsection
