@extends('backend.admin-master')
@section('site-title')
    {{__('Order Details')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($order_details))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong>{{ __('Order ID:') }} </strong>#{{ $order_details->id }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Seller Details') }}</h5>
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

                        </div>
                    </div>   
                </div>
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Service Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->service)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->service)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if($order_details->order_from_job == 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Job Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->job)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->job)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Buyer Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ $order_details->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ $order_details->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ $order_details->phone }}</label>
                                </div>
                                @if($order_details->is_order_online !=1)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ $order_details->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional($order_details->service_city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional($order_details->service_area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ $order_details->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional($order_details->service_country)->country }}</label>
                                </div>
                               @endif
                            </div>

                            @if($order_details->is_order_online !=1)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Date & Schedule') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Date:') }} </strong>{{ $order_details->date }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Schedule:') }} </strong>{{ $order_details->schedule }}</label>
                                </div>
                            </div>
                            @endif

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Amount Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Package Fee:') }} </strong>{{ float_amount_with_currency_symbol($order_details->package_fee) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Extra Service:') }} </strong>{{ float_amount_with_currency_symbol($order_details->extra_service) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Sub Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->sub_total) }}</label>
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
                                    <label><strong>{{ __('Admin Commission:') }} </strong>{{ float_amount_with_currency_symbol($order_details->commission_amount) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Gateway:') }} </strong><b class="text-success">{{ ucwords(str_replace("_", " ", $order_details->payment_gateway)) }}</b></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Status:') }} </strong>{{ ucfirst($order_details->payment_status) }}</label>
                                    <span>
                                        @if($order_details->payment_status=='pending') 
                                        <span><x-status-change :url="route('admin.order.change.status',$order_details->id)"/></span>
                                        @endif
                                    </span>
                                </div>
                                @if($order_details->payment_gateway=='manual_payment')
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Manual Payment Attachment:') }} </strong></label>
                                    <img src="{{ asset('assets/uploads/manual-payment/'.$order_details->manual_payment_image) }}" alt="">
                                </div>
                                @endif
                            </div>

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Order Status') }}</h5>
                            </div>
                            <div class="single-checbox">
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
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <h5>{{ __('Include Details:')}}</h5> <br>
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

                                @if($order_additionals->count() >= 1)
                                <h5>{{ __('Additional Services:')}}</h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Unit Price') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Total') }}</th>
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
                                @endif


                                @if(optional($order_details->extraSevices)->count() >= 1)
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Extra Service Details') }}</h5>
                                                </div>
                                                <span class="info-text d-block mb-4">{{__('This is not included in the main service order calculation')}}</span>

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

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($order_details->coupon_code))
                                <h5>{{ __('Coupon Details:')}}</h5> <br>
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
                                                @if(!empty($order_details->coupon_amount))
                                                {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection

@section('script')
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
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

