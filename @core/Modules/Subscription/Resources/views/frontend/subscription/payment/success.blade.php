@extends('frontend.frontend-page-master')
@section('page-meta-data')
    <title>{{ __('Subscription Success') }}</title>
@endsection

@section('inner-title')
    {{ __('Subscription') }}
@endsection

@section('content')
    <!-- Location Overview area starts -->
    <section class="location-overview-area padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="msform" class="msform">
                        <!-- Successful Complete -->
                        <fieldset class="padding-top-80 padding-bottom-100">
                            <div class="form-card successful-card">
                                <h2 class="title-step"> {{ get_static_option('success_title') ?? __('SUCCESSFUL') }}</h2>
                                <a href="{{ route('homepage') }}" class="succcess-icon">
                                    <i class="las la-check"></i>
                                </a>
                                <h5 class="purple-text text-center">{{ __('Your Subscription Successfully Completed') }}</h5>
                                @if($subscription_details->payment_status == 'pending')
                                    <h5 class="purple-text text-center">{{ __('Your subscription will usable after payment status completed') }}</h5>
                                @endif
                                <div class="btn-wrapper margin-top-35">
                                    <h4 class="mb-3">{{ __('Your Subscription Details') }}</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Connect') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ ucfirst($subscription_details->type) }}</td>
                                            @if($subscription_details->status == 0)
                                                @if($subscription_details->type == 'lifetime')
                                                    <td>{{ float_amount_with_currency_symbol($subscription_details->initial_price) }}</td>
                                                    <td>{{ __('Connect: Unlimited')}}</td>
                                                @else
                                                    <td>{{ float_amount_with_currency_symbol($subscription_details->initial_price) }}</td>
                                                    <td>{{ $subscription_details->initial_connect }}</td>
                                                @endif
                                            @else
                                                @if($subscription_details->type == 'lifetime')
                                                    <td>{{ float_amount_with_currency_symbol($subscription_details->initial_price) }}</td>
                                                    <td>{{ __('Connect: Unlimited')}}</td>
                                                @else
                                                    <td>{{ float_amount_with_currency_symbol($subscription_details->price) }}</td>
                                                    <td>{{ $subscription_details->connect }}</td>
                                                @endif
                                            @endif
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btn-wrapper text-center margin-top-35">
                                    <a href="{{ get_static_option('button_url') ?? route('homepage') }}" class="cmn-btn btn-bg-1">{{ get_static_option('button_title') ?? __('Back To Home') }}</a>
                                    @if(auth('web')->check())
                                        @php
                                            $user_details = auth('web')->user();
                                            $route_prefix = $user_details->user_type === 0 ? 'seller' : 'buyer';
                                        @endphp
                                        <a href="{{ route($route_prefix.'.dashboard') }}" class="cmn-btn btn-bg-1">{{__('Go To Dashboard') }}</a>
                                        <a href="{{ route($route_prefix.'.subscription.all') }}" class="cmn-btn btn-bg-1">{{__('All Subscriptions') }}</a>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Location Overview area end -->
@endsection





