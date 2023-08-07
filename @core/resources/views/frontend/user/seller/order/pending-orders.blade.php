@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Pending Orders') }}
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
                @if($pending_orders->count() >= 1)
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{ __('Pending Bookings') }}({{ $pending_orders->total() }}) </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($pending_orders as $order)
                            <div class="dashboard-order-single margin-top-40">
                                <div class="dashboard-thumb-flex">
                                    {{-- <div class="thumb">
                                        <a href="{{ route('seller.order.details', $order->id) }}">
                                        {!! render_image_markup_by_attachment_id(optional($order->service)->image) !!}
                                        </a>
                                    </div> --}}
                                    <div class="contents">
                                        <h4 class="title"> <a href="{{ route('seller.order.details', $order->id) }}">{{ optional($order->service)->title }} </a> </h4>
                                        <span class="orders"> {{ __('Booking').' #'.$order->id }} </span>
                                        <div class="btn-wrapper margin-top-30">
                                            {{-- @if($order->status==0)
                                            <span class="cmn-btn pending"> {{ __('New Request') }} </span>
                                            @endif --}}
                                            @if($order->status==1)
                                            <span class="cmn-btn completed">{{ __('Active Orders') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="single-oreder-request">
                                    <span class="orders" style="color: #03989E">
                                        <h2 class="title color-three" style="color: #03989E" > {{ float_amount_with_currency_symbol($order->total) }} </h2>

                                          @if($order->date === 'No Date Created')
                                             <span>{{ __('No Date Created') }}</span>
                                             @else
                                             </strong>{{ Carbon\Carbon::parse($order->date)->format('d/m/y') }}
                                            @endif
                                    </span>
                                    <span class="orders" style="color: #03989E">{{ __($order->schedule) }}</span>
                                </div>
                                <div class="dashboard-request-cancel">
                                    <div class="btn-wrapper" >
                                        <a  style="background-color: #03989E"
                                          href="javascript:void(0)" 
                                            class="cmn-btn btn-bg-3 edit_status_modal"
                                            data-toggle="modal"
                                            data-target="#editStatusModal"
                                            data-id="{{ $order->id }}">{{ __('Change Status') }}
                                        </a>
                                    </div>
                                    @if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending')
                                    <div class="btn-wrapper mt-2">
                                        <a style="background-color: #03989E" href="javascript:void(0)"
                                           class="cmn-btn btn-bg-3 edit_payment_status_modal"
                                           data-toggle="modal"
                                           data-target="#editPaymentStatusModal"
                                           data-id="{{ $order->id }}">{{ __('Payment Status') }}
                                        </a>
                                    </div>
                                    @endif


                                    
                                    <div class="dashboard-icons margin-top-30">
                                        <a href="{{ route('seller.order.details', $order->id) }}">
                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('View Details') }}">
                                             <i class="las la-eye"></i>
                                            </span> 
                                        </a>
                                       
                                        <a href="{{ route('seller.order.invoice.details',$order->id) }}">
                                            <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="{{ __('Print Pdf') }}"> 
                                                <i class="las la-print"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                           @endforeach
                            
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {!! $pending_orders->links() !!}
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
                        <h5 class="modal-title" id="editModal">{{ __('Change Status') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="mb-3 text-danger">
                            <li><strong>{{ __( 'Status Meaning:') }}</strong></li>
                            <li>{{ __('Pending: Did not start the job yet.') }}</li>
                            <li>{{ __('Active: Job already started.') }}</li>
                            <li>{{ __('Delivered: Order Deliverd For Checking.') }}</li>
                            <li>{{ __('Completed: Order is completed and closed.') }}</li>
                        </ul>

                        <div class="form-group">
                            <label for="up_day_id">{{ __('Select Status') }}</label>
                            <select name="status" id="status" class="form-control nice-select">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="0">{{ __('Pending') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="2">{{ __('Completed') }}</option>
                                <option value="3">{{ __('Delivered') }}</option>
                                <option value="4">{{ __('Cancelled') }}</option>
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

@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    $('#order_id').val(order_id);
                    $('.nice-select').niceSelect('update');
                });
                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });


                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, delete it!')}}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

            });

        })(jQuery);
    </script>
@endsection
