@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Buyer Dashboard')}}
@endsection
@section('content')

    <x-frontend.seller-buyer-preloader/>

    @php
        $default_lang = get_default_language();

//        dd($default_lang);
//        dd(get_user_lang_direction());

    @endphp

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
                @include('frontend.user.buyer.partials.sidebar')
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-flex-title">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title">{{ __('Dashboard') }}</h2>
                                </div>
                                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==1)
                                    <div class="info-bar-item">
                                        <div class="notification-icon icon">
                                            @if(Auth::guard('web')->check())
                                                <span class="bell-icon"> {{__("Notifications")}} <i class="las la-bell"></i> </span>
                                                <span class="notification-number">
                                                            {{ Auth::user()->unreadNotifications->count() }}
                                                        </span>
                                            @endif
                                            <div class="notification-list-item mt-2">
                                                <h5 class="notification-title">{{ __('Notifications') }}</h5>
                                                <div class="list">
                                                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >=1)
                                                        <span>
                                                                @foreach(Auth::guard('web')->user()->unreadNotifications->take(10) as $notification)
                                                                <a class="list-order" href="{{ route('buyer.support.ticket.view',$notification->data['last_ticket_id']) }}">
                                                                        <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                                        {{ $notification->data['order_ticcket_message']  }} #{{ $notification->data['last_ticket_id'] }}
                                                                    </a>
                                                            @endforeach
                                                            </span>
                                                    @else
                                                        <p class="text-center padding-3" style="color:#111;">{{ __('No New Notification') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-tasks"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ $pending_order }} </h2>
                                        <span class="order-para">{{ __('Order Pending') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes2.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-handshake"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ $active_order }} </h2>
                                        <span class="order-para">{{ __('Order Active') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes3.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-dollar-sign"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ $complete_order }} </h2>
                                        <span class="order-para">{{ __('Order Completed') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes4.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-file-invoice-dollar"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles">{{ $total_order }} </h2>
                                        <span class="order-para"> {{ __('Order Total') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     --}}
                    <div class="dashboard-middle-flex ">
                        @if($last_10_order->count() >= 1)
                            <div class="single-flex-middle margin-top-40">
                                <div class="line-charts-wrapper oreder_details_rtl">
                                    <div class="table-responsive table-responsive--md">
                                        <h5 style="font-weight:bold">{{ __('Recent 10 Bookings') }}</h5>
                                        <table class="custom--table">
                                            <thead>
                                            <tr>
                                                <th> {{ __('Seller Name') }} </th>
                                                <th>{{ __('Status') }}</th>
                                                <th> {{ __('Location') }} </th>
                                                <th>{{ __('Price') }} </th>
                                                <th>{{ __('View') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($last_10_order as $order)
                                                <tr>
                                                    <td data-label="{{__('Seller Name')}}">{{ optional($order->seller)->name }} </td>
                                                    @if ($order->status == 0) <td data-label="{{__('Status')}}" class="pending"><span>{{ __('Pending') }}</span></td>@endif
                                                    @if ($order->status == 1) <td data-label="{{__('Status')}}" class="order-active"><span>{{ __('Active') }}</span></td>@endif
                                                    @if ($order->status == 2) <td data-label="{{__('Status')}}" class="completed"><span>{{ __('Completed') }}</span></td>@endif
                                                    @if ($order->status == 3) <td data-label="{{__('Status')}}" class="order-deliver"><span>{{ __('Delivered') }}</span></td>@endif
                                                    @if ($order->status == 4) <td data-label="{{__('Status')}}" class="canceled"><span>{{ __('Cancelled') }}</span></td>@endif
                                                    <td data-label="{{__('Location')}}">{{ optional(optional($order->seller)->city)->service_city }}</td>
                                                    <td data-label="{{__('Price')}}"> {{ float_amount_with_currency_symbol($order->total) }} </td>
                                                    <td data-label="{{__('View')}}">
                                                        <a href="{{ route('buyer.order.details', $order->id) }}">
                                                                <span class="icon eye-icon">
                                                                    <i class="las la-eye"></i>
                                                                </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($last_10_tickets->count() >= 1)
                            <div class="single-flex-middle margin-top-40">
                                <div class="line-charts-wrapper oreder_details_rtl">
                                    <div class="table-responsive table-responsive--md">
                                        <h5>{{ __('Last 10 Tickets') }}</h5>
                                        <table class="custom--table">
                                            <thead>
                                            <tr>
                                                <th class="text-left"> {{ __('Ticket') }} </th>
                                                <th>{{ __('Ticket Details') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($last_10_tickets as $ticket)
                                                <tr>
                                                    <td data-label="{{__('Ticket')}}" class="text-left">{{__('Order Id')}} #{{ $ticket->order_id }}, {{ $ticket->title }} </td>
                                                    <td data-label="{{__('Ticket Details')}}">
                                                        <a href="{{ route('buyer.support.ticket.view', $ticket->id) }}">
                                                            <span class="icon eye-icon"><i class="las la-eye"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->
@endsection
