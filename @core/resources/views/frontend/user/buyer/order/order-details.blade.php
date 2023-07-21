@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{ __('Order Details') }}
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
                @include('frontend.user.buyer.partials.sidebar')
                <div class="dashboard-right">
                    @if(!empty($order_details))
                        <div class="row">

                            <div class="col-md-4">
                                <div class="single-flex-middle">
                                    <div class="single-flex-middle-inner">
                                        <div class="line-charts-wrapper margin-top-40">

                                            <div class="line-top-contents">
                                                <h5 class="earning-title">{{ __('Seller Details') }}</h5>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Name:') }} </strong>{{ optional($order_details->seller)->name }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Email:') }} </strong>{{ optional($order_details->seller)->email }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Phone:') }} </strong>{{ optional($order_details->seller)->phone }}</label>
                                                </div>
                                                @if($order_details->is_order_online !=1)
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Address:') }} </strong>{{ optional($order_details->seller)->address }}</label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('City:') }} </strong>{{ optional(optional($order_details->seller)->city)->service_city }}</label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Area:') }} </strong>{{ optional(optional($order_details->seller)->area)->service_area }}</label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Post Code:') }} </strong>{{ optional($order_details->seller)->post_code }}</label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Country:') }} </strong>{{ optional(optional($order_details->seller)->country)->country }}</label>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($order_details->is_order_online !=1)
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Date & Schedule') }}</h5>
                                                </div>
                                                <div class="single-checbox">
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Date:') }}
                                                                @if($order_details->date === 'No Date Created')
                                                                    <span>{{ __('No Date Created') }}</span>
                                                                @else
                                                            </strong>{{ Carbon\Carbon::parse($order_details->date)->format('d/m/y') }}
                                                            @endif

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Schedule:') }} </strong>{{ $order_details->schedule }}</label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="line-top-contents">
                                                <h5 class="earning-title">{{ __('Amount Details') }}</h5>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Package Fee:') }} </strong>{{ float_amount_with_currency_symbol($order_details->package_fee) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Extra Service:') }} </strong>{{ float_amount_with_currency_symbol($order_details->extra_service) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Sub Total:') }}</strong>{{ float_amount_with_currency_symbol($order_details->sub_total) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Tax:') }} </strong>{{ float_amount_with_currency_symbol($order_details->tax) }}</label>
                                                </div>
                                                @if(!empty($order_details->coupon_amount))
                                                    <div class="checkbox-inlines">
                                                        <label><strong>{{ __('Coupon Amount:') }} </strong>{{ float_amount_with_currency_symbol($order_details->coupon_amount) }}</label>
                                                    </div>
                                                @endif
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->total) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Admin Charge:') }} </strong>{{ float_amount_with_currency_symbol($order_details->commission_amount) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Payment Gateway:') }} </strong>{{ __(ucwords(str_replace("_", " ", $order_details->payment_gateway))) }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Payment Status:') }} </strong>{{ __(ucfirst($order_details->payment_status)) }}</label>
                                                </div>
                                            </div>

                                            <div class="line-top-contents">
                                                <h5 class="earning-title">{{ __('Order Details') }}</h5>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Order ID:') }} </strong>{{ $order_details->id }}</label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong>{{ __('Order Status: ') }}</strong>
                                                        @if ($order_details->status == 0) <span>{{ __('Pending') }}</span>@endif
                                                        @if ($order_details->status == 1) <span>{{ __('Active') }}</span>@endif
                                                        @if ($order_details->status == 2) <span>{{ __('Completed') }}</span>@endif
                                                        @if ($order_details->status == 3) <span>{{ __('Delivered') }}</span>@endif
                                                        @if ($order_details->status == 4) <span>{{ __('Cancelled') }}</span>@endif
                                                    </label>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                @if($order_details->order_from_job != 'yes')
                                    <div class="single-flex-middle">
                                    <div class="single-flex-middle-inner">
                                        <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                            <div class="line-top-contents">
                                                <h5 class="earning-title">{{ __('Include Details') }}</h5>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('Title') }}</th>
                                                    @if($order_details->is_order_online !=1)
                                                        <th>{{ __('Unit Price') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Total') }}</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $package_fee =0; @endphp
                                                @foreach($order_includes as $include)
                                                    <tr>
                                                        <td>{{ $include->title }}</td>
                                                        @if($order_details->is_order_online !=1)
                                                            <td>{{ float_amount_with_currency_symbol($include->price) }}</td>
                                                            <td>{{ $include->quantity }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                                                            @php $package_fee += $include->price * $include->quantity @endphp
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    @if($order_details->is_order_online !=1)
                                                        <td colspan="3"><strong>{{ __('Package Fee') }}</strong></td>
                                                        <td><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                                                    @else
                                                        <td colspan="3"><strong>{{ __('Package Fee ') .float_amount_with_currency_symbol($order_details->package_fee)}}</strong></td>
                                                    @endif
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($order_additionals->count() >= 1)
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Additional Details') }}</h5>
                                                </div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Unit Price') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Total') }}</th>
                                                        <th>{{ __('Action') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $extra_service =0; @endphp
                                                    @foreach($order_additionals as $additional)
                                                        <tr>
                                                            <td>{{ $additional->title }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($additional->price) }}</td>
                                                            <td>{{ $additional->quantity }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                                            @php $extra_service += $additional->price * $additional->quantity @endphp
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                                        <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(optional($order_details->extraSevices)->count() >= 1)
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Extra Service Details') }}</h5>
                                                </div>
                                                <span class="info-text d-block mb-4">{{__('This is not included in the main service order calculation')}}</span>
                                                <div> <x-msg.error/> </div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Unit Price') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_details->extraSevices as $ex_service)
                                                        <tr>
                                                            <td>{{ $ex_service->title }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($ex_service->price) }}</td>
                                                            <td>{{ $ex_service->quantity }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity) }}</td>
                                                            <td>
                                                                @php
                                                                    $class_arry = ['pending' => 'warning','decline' => 'danger','complete' => 'success'];
                                                                @endphp
                                                                @if($ex_service->payment_status === 'pending')
                                                                    <a href="#"
                                                                       data-toggle="modal"
                                                                       data-order_id="{{$ex_service->order_id}}"
                                                                       data-id="{{$ex_service->id}}"
                                                                       data-target="#acceptExtraServiceModal"
                                                                       class="btn btn-success extra_service_accept_button"
                                                                    >{{__('Accept')}}</a>
                                                                    <a href="#" class="btn btn-danger extra_service_decline_button" data-order_id="{{$ex_service->order_id}}" data-id="{{$ex_service->id}}">
                                                                        {{__('Decline')}}
                                                                    </a>
                                                                    @if($ex_service->status === 2 && $ex_service->payment_status === 'pending') <span class="btn btn-dark">{{ __('Wait for admin approval') }}</span>@endif
                                                                @else
                                                                    <span class="alert alert-{{$class_arry[$ex_service->payment_status]}}">{{__($ex_service->payment_status)}}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(!empty($order_details->coupon_code))
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Coupon Details') }}</h5>
                                                </div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Coupon Code') }}</th>
                                                        <th>{{ __('Coupon Type') }}</th>
                                                        <th>{{ __('Coupon Amount') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $order_details->coupon_code }}</td>
                                                        <td>{{ $order_details->coupon_type }}</td>
                                                        <td>
                                                            @if($order_details->coupon_amount >0)
                                                                {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="col-sm-12">
                                @if(!empty($order_declines_history->count() >= 1))
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Order Decline History') }}</h5>
                                                </div>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('History ID') }}</th>
                                                        <th>{{ __('Seller Details') }}</th>
                                                        <th>{{ __('Status') }} ({{ __('Decline Reason') }})</th>
                                                        <th>{{ __('Image File') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_declines_history as $history)
                                                        <tr>
                                                            <td>{{ $history->id }}</td>
                                                            <td>
                                                                <strong>{{ __('Name: ') }}</strong> {{ optional($history->seller)->name }} <br>
                                                                <strong>{{ __('Email: ') }}</strong>{{ optional($history->seller)->email }} <br>
                                                                <strong>{{ __('Phone: ') }}</strong>{{ optional($history->seller)->phone }} <br>
                                                            </td>
                                                            <td><strong>{{ __('Decline Reason: ') }}</strong>{{ $history->decline_reason }}</td>
                                                            <td>{!! render_image_markup_by_attachment_id($history->image,'','thumb') !!}</td>
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
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{--  accept extra service modal --}}
    <div class="modal fade" id="acceptExtraServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('buyer.order.extra.service.accept') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{ __('Accept Extra Service Request') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="comments-flex-item">
                            <input type="hidden"  name="id" class="form-control form-control-sm">
                            <input type="hidden"  name="order_id" class="form-control form-control-sm">
                        </div>
                        {!! \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(false) !!}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Pay Now') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <x-payment-gateway-js/>
    <script>
        (function($){

            "use strict";

            $(document).ready(function (){

                /* Delete */
                $(document).on('click','.extra_service_accept_button',function (e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    var order_id = $(this).data('order_id');

                    let modalContainer = $('#acceptExtraServiceModal');
                    modalContainer.find('input[name="id"]').val(id);
                    modalContainer.find('input[name="order_id"]').val(order_id);
                });

                $(document).on('click','.extra_service_decline_button',function (e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    var order_id = $(this).data('order_id');
                    var url = "{{route('buyer.order.extra.service.decline')}}";
                    Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, Decline it!')}}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                "type" :"POST",
                                'url' : url,
                                data: {
                                    _token : "{{csrf_token()}}",
                                    id: id,
                                    order_id: order_id,
                                },
                                success: function (data){
                                    Swal.fire({
                                        icon: 'warning',
                                        title: "{{__('request declined')}}",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    location.reload();
                                }
                            });
                        }
                    });

                });

            });


        })(jQuery);
    </script>
@endsection