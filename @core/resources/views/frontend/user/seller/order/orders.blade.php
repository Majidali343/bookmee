@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Orders') }}
@endsection
@section('style')
    <x-media.css/>
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/common/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/font-awesome.min.css')}}">
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
                @if($all_orders->count() >= 1)
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title">{{ __('All Service bookings') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <x-msg.error/>
                        </div>
                        <div class="col-lg-12 margin-top-40">
                            <div class="dashboard-status-list">
                                <ul class="tabs status-order-list margin-bottom-10">
                                   @include('frontend.user.seller.partials.tab-list')
                                </ul>
                            </div>

                            <div>
                                <div class="table-responsive table-responsive--md">
                                    <table id="all_order_table" class="custom--table table-td-padding">
                                        <thead>
                                            <tr>
                                                <th> {{ __('Booking ID') }} </th>
                                                <th> {{ __('Customer Name') }} </th>
                                                @if(request()->path() == 'seller/job-orders')
                                                <!--job order title -->
                                                <th> {{ __('Service') }} </th>
                                                <th> {{ __('Service Date') }} </th>
                                                @else
                                                    <!--Service order title -->
                                                    <th> {{ __('Service Name') }} </th>
                                                    <th> {{ __('Service Date') }} </th>
                                                    <th> {{ __('Service Time') }} </th>
                                                @endif
                                                <th> {{ __('Order Pricing') }} </th>
                                                <th> {{ __('Payment Status') }} </th>
                                                <th> {{ __('Booking Status') }} </th>
                                                {{-- <th> {{ __('Booking Type') }} </th> --}}
                                                <th> {{ __('Complete Request') }} </th>
                                                <th> {{ __('Actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_orders as $order)
                                                <tr>
                                                    <td data-label="Order ID"> {{ $order->id }} </td>
                                                    <td data-label="Buyer Name"> {{ $order->name }} </td>

                                                    <!--service and job order info -->
                                                    @if(request()->path() == 'seller/job-orders')
                                                        <td data-label="Job Title"> {{ Str::limit(optional($order->job)->title,20) }} </td>
                                                        <td data-label="Order Date"> {{ Carbon\Carbon::parse( strtotime($order->created_at))->format('d/m/y') }} </td>
                                                    @else
                                                        <td data-label="Service Name"> {{ optional($order->service)->title }} </td>
                                                        <td data-label="Service Date">
                                                            @if($order->date === 'No Date Created')
                                                                <span>{{ __('No Date Created') }}</span>
                                                            @else
                                                                {{ Carbon\Carbon::parse( strtotime($order->date))->format('d/m/y') }}
                                                            @endif
                                                        </td>
                                                        <td data-label="Service Time"> {{ __($order->schedule) }}</td>
                                                    @endif

                                                    <td data-label="Order Pricing"> {{ float_amount_with_currency_symbol($order->total) }}</td>
                                                    <td data-label="Payment Status">
                                                        @if ($order->payment_status == 'pending')
                                                            <span class="text-danger">{{ __('Pending') }}</span>
                                                            @if($order->payment_gateway == 'cash_on_delivery')
                                                                <span class="text-info"><strong>{{__('Payment Type: ')}}</strong>{{ __('Cash on Delivery') }}</span>
                                                                <br>
                                                                <span><x-cancel-order :url="route('seller.order.cancel.cod.payment.pending',$order->id)"/></span>
                                                            @endif
                                                        @endif
                                                        @if ($order->payment_status == 'complete')
                                                            <span class="text-success">{{ __('Complete') }}</span>
                                                        @endif
                                                            @if(empty($order->payment_status))
                                                                <span class="text-danger">{{ __('Pending') }}</span>
                                                            @endif
                                                    </td>

                                                    @if ($order->status == 0) <td data-label="Order Status" class="pending"><span>{{ __('Pending') }}</span></td>@endif
                                                    @if ($order->status == 1) <td data-label="Order Status" class="order-active"><span>{{ __('Active') }}</span></td>@endif
                                                    @if ($order->status == 2) <td data-label="Order Status" class="completed"><span>{{ __('Completed') }}</span></td>@endif
                                                    @if ($order->status == 3) <td data-label="Order Status" class="order-deliver"><span>{{ __('Delivered') }}</span></td>@endif
                                                    @if ($order->status == 4) <td data-label="Order Status" class="canceled"><span>{{ __('Cancelled') }}</span></td>@endif

                                                    {{-- <td data-label="Order Pricing">
                                                        @if($order->is_order_online==1)
                                                        <span class="btn btn-success">{{ __('Online') }}</span>
                                                        @else
                                                        <span class="btn btn-info">{{ __('Offline') }}</span>
                                                        @endif
                                                    </td> --}}
                                                    <td data-label="Order Status" style="color: beige" >
                                                        <span class="{{ in_array($order->order_complete_request,[0,1]) ? 'pending' : 'completed' }} d-block" style="background-color: rgb(29 54 90);">
                                                            @if ( in_array($order->order_complete_request,[0,1]))
                                                            @if($order->payment_status != 'pending')
                                                                @if($order->order_complete_request == 0)
                                                                    <a href="#0" class="edit_status_modal"
                                                                       data-toggle="modal"
                                                                       data-target="#editStatusModal"
                                                                       data-id="{{ $order->id }}"
                                                                       data-status="{{ $order->status }}">
                                                                        <span class="dash-icon color-1-2" >
                                                                            {{ __('Is it Completed?') }}
                                                                        </span>
                                                                    </a>
                                                                @else
                                                                    <span>{{ __('Request Pending') }}</span>
                                                                @endif
                                                            @endif

                                                            @elseif($order->order_complete_request == 2)
                                                                {{ __('Completed') }}
                                                            @endif
                                                            
                                                            @if ($order->order_complete_request == 3)
                                                                    <a href="#0" class="edit_status_modal"
                                                                       data-toggle="modal"
                                                                       data-target="#editStatusModal"
                                                                       data-id="{{ $order->id }}"
                                                                       data-status="{{ $order->status }}">
                                                                        <span class="dash-icon color-1">
                                                                            {{ __('Create Complete Request') }}
                                                                        </span>
                                                                    </a> <br>
                                                                @if(optional($order->completedeclinehistory)->count() >=1)
                                                                <span class="btn btn-warning"><a href="{{ route('seller.order.request.decline.history',$order->id) }}"> {{ __('View History') }} </a></span>
                                                                @endif
                                                            @endif
                                                        </span>

                                                            {{-- <a href="#0"
                                                               data-toggle="modal"
                                                               data-id="{{ $order->id }}"
                                                               data-target="#extraServiceRequest"
                                                               class="mt-2 btn btn-secondary extra_submit_request_btn">{{__('Extra Services')}}</a> --}}
                                                    </td>

                                                    <td data-label="Action">

                                                        @if ($order->order_complete_request == 2)
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#reviewModal"
                                                               data-buyer_id="{{ $order->buyer_id }}"
                                                               data-service_id="{{ $order->service_id }}"
                                                               data-order_id="{{  $order->id }}"
                                                               class="review_add_modal"
                                                            >
                                                                <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('Review') }}"> <i class="las la-star"></i> </span>
                                                            </a>
                                                        @endif

                                                        <a href="{{ route('seller.order.details', $order->id) }}">
                                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('View Details') }}">
                                                                <i class="las la-eye"></i>
                                                            </span>
                                                        </a>
                                                       
                                                        @if($order->is_order_online != 1)
                                                             <a href="{{ route('seller.support.ticket.new', $order->id) }}">
                                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('Create Ticket') }}">
                                                             <i class="las la-ticket-alt"></i>
                                                            </span>
                                                            </a>
                                                        @else 
                                                            @if(!empty($order->online_order_ticket->id))
                                                             <a href="{{ route('seller.support.ticket.view',optional($order->online_order_ticket)->id) }}">
                                                                <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('View Ticket') }}">
                                                                    <i class="las la-eye-slash"></i>
                                                                </span>
                                                            </a>
                                                            @endif
                                                        @endif
                                                        @if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending')
                                                                <a href="javascript:void(0)"
                                                                   class="edit_payment_status_modal"
                                                                   data-toggle="modal"
                                                                   data-target="#editPaymentStatusModal"
                                                                   data-id="{{ $order->id }}">
                                                                    <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="{{ __('Change Payment Status') }}">
                                                                        <i class="las la-money-check-alt"></i>
                                                                    </span>
                                                                </a>
                                                        @endif
                                                        <a href="{{ route('seller.order.invoice.details',$order->id) }}">
                                                            <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="{{ __('Print Pdf') }}"> 
                                                                <i class="las la-print"></i>
                                                            </span>
                                                        </a>
                                                        @if($order->status != 2)
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#reportModal"
                                                               data-buyer_id="{{ $order->buyer_id }}"
                                                               data-service_id="{{ $order->service_id }}"
                                                               data-order_id="{{  $order->id }}"
                                                               class="report_add_modal">
                                                                <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="{{ __('Report') }}">
                                                                    <i class="las la-file"></i>
                                                                </span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        {!! $all_orders->links() !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @else 
                <h2 class="no_data_found">{{ __('No Orders Found') }}</h2>
                @endif
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
        <form action="{{ route('seller.order.status') }}" method="post">
            <input type="hidden" id="order_id" name="order_id">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Create Order Complete Request') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="up_day_id">{{ __('Select Status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="2">{{ __('Completed') }}</option>
                            </select>
                            <p class="text-info">{{ __('Completed: Order is completed and closed.') }}</p>
                        </div>

                        <div class="form-group ">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="image">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="{{__('Select Image')}}"
                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                        data-target="#media_upload_modal">
                                    {{__('Upload Main Image')}}
                                </button>
                                <small>{{ __('image format: jpg,jpeg,png')}}</small>
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

    {{--    edit payment status--}}
    <div class="modal fade" id="editPaymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('seller.order.payment.status') }}" method="post">
            <input type="hidden"  name="order_id">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Change Payment Status') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="up_day_id">{{ __('Select Status') }}</label>
                            <select name="status" id="status" class="form-control nice-select">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="complete">{{ __('Completed') }}</option>
                            </select>
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

    {{--    Report modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <form action="{{ route('seller.order.report') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Report') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="comments-flex-item">
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block pt-4" for="amount">{{ __('Report Us') }}</label>
                            <textarea id="report" rows="5" name="report" class="form-control form--message" placeholder="{{ __('Report Here') }}"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Send Report') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    {{-- Extra Service Request Modal Start --}}
    <div class="modal fade" id="extraServiceRequest" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <form action="{{ route('seller.order.extra.service') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{ __('Request For Extra Service') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="comments-flex-item">
                            <input type="hidden" name="order_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="amount">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" placeholder="{{ __('title') }}">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="quantity">{{ __('Quantity') }}</label>
                            <input type="number" name="quantity" class="form-control" placeholder="{{ __('Quantity') }}">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="price">{{ __('Price') }}</label>
                            <input type="number" name="price" class="form-control" step="0.05" placeholder="{{ __('price') }}">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--For the Job order Seller to buyer Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('seller.to.buyer.review') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Review') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="comments-flex-item">
                            <div class="single-commetns" style="font-size: 1em;">
                                <label class="comment-label"> {{ __('Ratings*') }} </label>
                                <div id="review"></div>
                            </div>

                            <input type="hidden" id="rating" name="rating" class="form-control form-control-sm">
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">

                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block pt-4" for="amount">{{ __('Comments') }}</label>
                            <textarea id="message" rows="5" name="message" class="form-control form--message" placeholder="{{ __('Post Comments') }}"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Send Review') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <x-media.markup :type="'web'"/>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
    <x-media.js :type="'web'"/>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                //order cancel status
                $(document).on('click','.swal_status_change_order_cancel',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to cancel the order")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, cancel it!')}}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn_cancel_order').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });

                /* ------------------------------
                *   Request for extra service
                * -----------------------------*/
                $(document).on('click', '.extra_submit_request_btn', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let modalContainer = $('#extraServiceRequest');

                    modalContainer.find('input[name="order_id"]').val(order_id);
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

                //report us
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let buyer_id = el.data('buyer_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#reportModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });


                // seller to buyer review start
                $(document).on('click', '.review_add_modal', function () {
                    let el = $(this);

                    let buyer_id = el.data('buyer_id');

                    let service_id = el.data('service_id');

                    let order_id = el.data('order_id');

                    let form = $('#reviewModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });

                // rating
                $("#review").rating({
                    "value": 5,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });

            });

        })(jQuery);

    </script>
@endsection
