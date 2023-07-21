@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Wallet') }}
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
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{ asset('assets/frontend/img/static/orders-shapes3.png') }}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-dollar-sign"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles">
                                            @if(empty($balance->balance))
                                                {{ float_amount_with_currency_symbol(0.00) }}
                                            @else
                                                {{ float_amount_with_currency_symbol($balance->balance) }}
                                            @endif
                                        </h2>
                                        <span class="order-para">{{ __('Wallet Balance') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="dashboard-settings">
                                <div class="mt-3"> 
                                    <x-msg.error/>
                                    <x-msg.success/>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="dashboard-settings margin-top-55">
                                <h2 class="dashboards-title">{{ __('Wallet History') }} </h2>
                                <div class="notice-board">
                                    <p class="text-danger">{{ __('You can deposit to your wallet from here.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="dashboard-settings margin-top-55">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payoutRequestModal">{{ __('Deposit To Your Wallet') }}</button>
                            </div>
                        </div>
                        <div class="col-lg-12 margin-top-20">
                            <div class="single-dashboard-order">
                                <div class="table-responsive table-responsive--md">
                                    <table class="custom--table">
                                        <thead>
                                        <tr>
                                            <th> {{ __('ID') }}</th>
                                            <th> {{ __('Payment Gateway') }} </th>
                                            <th> {{ __('Payment Status') }} </th>
                                            <th> {{ __('Deposit Amount') }} </th>
                                            <th> {{ __('Deposit Date') }} </th>
                                            <th> {{ __('Payment Image') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wallet_histories as $history)
                                            <tr>
                                                <td data-label="{{ __('ID') }}">{{ $history->id }} </td>
                                                <td data-label="{{ __('Payment Gateway') }}">{{ $history->payment_gateway }}</td>
                                                <td data-label="{{ __('Payment Status') }}">{{ $history->payment_status }}</td>
                                                <td data-label="{{ __('Request Amount') }}"> {{ float_amount_with_currency_symbol($history->amount) }} </td>
                                                <td data-label="{{ __('Request Date') }}">{{ $history->created_at->diffForHumans() }} </td>
                                                <td data-label="{{ __('Request Date') }}">
                                                    @if(empty($history->manual_payment_image))
                                                        {{ __('No Image') }}
                                                        @else
                                                        <img style="width:100px;" src="{{ asset('assets/uploads/manual-payment/'.$history->manual_payment_image) }}" alt="payment-image">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        {!! $wallet_histories->links() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="payoutRequestModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('seller.wallet.deposit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning" id="couponModal">{{ __('You can deposit to your wallet from the available payment gateway.') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">{{ __('Deposit Amount') }}</label>
                        <input type="number" class="form-control" name="amount" placeholder="{{ __('Enter Deposit Amount') }}">
                        <div class="confirm-bottom-content">
                            <br>
                                {!! \App\Helpers\PaymentGatewayRenderHelper::renderCurrentBalanceForm() !!}
                            <div class="confirm-payment payment-border">
                                <div class="single-checkbox">
                                    <div class="checkbox-inlines">
                                        <label class="checkbox-label" for="check2">
                                            {!! \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(false) !!}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <x-payment-gateway-js/>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

            });

        })(jQuery);
    </script>
@endsection
