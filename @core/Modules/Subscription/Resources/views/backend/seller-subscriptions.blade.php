@extends('backend.admin-master')

@section('site-title')
    {{__('Seller Subscriptions')}}
@endsection

@section('style')
    <x-media.css/>
    <x-datatable.css/>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Seller Subscriptions')}}  </h4>
                                <a href="#" class="btn btn-info mb-3" data-toggle="modal"
                                   data-target="#ticketModal" > {{__('Assign Subscription' )}}
                                </a>
                                <p class="text-warning">{{ __('Pending connect will be added to available connect only the payment status is completed.') }}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Manual Payment Image')}}</th>
                                <th>{{__('Subscription Details')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Payment Details')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('History')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($seller_subscriptions as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{!! render_image_markup_by_attachment_id(optional($data->subscription)->image,'','thumb') !!}</td>
                                        <td>
                                            @if($data->manual_payment_image)
                                                <a href="{{ url('assets/uploads/subscription/manual-payment/'.$data->manual_payment_image) }}" target="_blank">
                                                    <img src="{{ url('assets/uploads/subscription/manual-payment/'.$data->manual_payment_image) }}" style="width:100px"alt="payment-image">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ __('Title:') }} {{optional($data->subscription)->title}} <br>
                                            {{ __('Price:') }}
                                            @if($data->price == 0)
                                                {{float_amount_with_currency_symbol($data->initial_price)}} <br>
                                            @else
                                                {{float_amount_with_currency_symbol($data->price)}} <br>
                                            @endif
                                            {{ __('Type:') }} {{ucfirst($data->type)}} <br>
                                            {{ __('Available Connect: ') }}  {{$data->connect}} <br>
                                            {{ __('Service: ') }}  {{$data->initial_service}} <br>
                                            {{ __('Job: ') }}  {{$data->initial_job}} <br>
                                            @if($data->payment_status == 'pending' || $data->payment_status == '')
                                            {{ __('Pending Connect: ') }}
                                            {{$data->initial_connect}} <br>
                                            @endif
                                            {{ __('Expire Date:') }} {{date('d-m-Y', strtotime($data->expire_date))}}<br>
                                        </td>
                                        <td>
                                            {{ __('Name:') }} {{optional($data->seller)->name}} <br>
                                            {{ __('Email:') }} {{optional($data->seller)->email}} <br>
                                            {{ __('Country:') }} {{ optional(optional($data->seller)->country)->country}} <br>
                                            {{ __('City:') }} {{ optional(optional($data->seller)->city)->service_city}} <br>
                                        </td>
                                        <td>
                                            {{ __('Payment Gateway:') }} {{ ucfirst($data->payment_gateway) }} <br>
                                            {{ __('Payment Status:') }} {{ ucfirst($data->payment_status=='complete' ? 'complete' : 'pending') }} <br>
                                            @if($data->payment_status == 'pending' || $data->payment_status == '')
                                                <span><x-status-change :url="route('admin.seller.subscription.payment.status',$data->id)"/></span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('subscription-status')
                                                @if($data->status == 1)
                                                    <span class="btn- btn-success p-2">{{ __('Active') }}</span>
                                                    @else
                                                    <span class="btn btn-danger p-2">{{ __('Inactive') }}</span>
                                                @endif
                                                <span><x-status-change :url="route('admin.seller.subscription.status',$data->id)"/></span>
                                            @endcan
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('admin.seller.subscription.history',$data->id) }}">{{ __('History') }}</a>
                                        </td>
                                        <td>
                                            @can('send-email')
                                                 <a href="{{ route('admin.seller.subscription.email',$data->id) }}" class="btn btn-info btn-sm mb-3 mr-1">{{ __('Send Email ')}}</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('admin.seller.subscription.buy') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Buy Subscription For  A Seller') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Select Package')}} </label>
                                <select name="subscription_id" class="form-control">
                                    <option value="">{{__('Select Package')}}</option>
                                    @foreach($subscriptions as $subs)
                                        <option value="{{ $subs->id }}">{{ $subs->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Select Seller')}} </label>
                                <br><small class="text-info">{{__('seller list who has no subscription')}}</small>
                                <select name="seller_id" class="form-control">
                                    <option value="">{{__('Select Seller')}}</option>
                                    @if($sellers)
                                        @foreach($sellers as $seller)
                                            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Payment Status')}} </label>
                                <select name="payment_status" class="form-control">
                                    <option value="">{{__('Select Payment Status')}}</option>
                                        <option value="{{ __('complete')}}">{{ __('Complete') }}</option>
                                        <option value="{{ __('pending')}}">{{ __('Pending') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Payment Gateway')}} </label>

                                <select name="payment_gateway" class="form-control">
                                    <option value="">{{__('Select Payment Gateway')}}</option>
                                    @php
                                        $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','marcadopago','instamojo','cashfree','payfast','midtrans','squareup','cinetpay','paytabs','billplz','zitopay'];
                                    @endphp
                                    @foreach($all_gateways as $gateway)
                                        @if(!empty(get_static_option($gateway.'_gateway')))
                                            <option value="{{$gateway}}" @if(get_static_option('site_default_payment_gateway') == $gateway) selected @endif>{{ucwords(str_replace('_',' ',$gateway))}}</option>
                                        @endif
                                    @endforeach
                                </select>
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


    <x-media.markup/>
@endsection

@section('script')
    <x-datatable.js/>
    <x-media.js />
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <x-bulk-action-js :url="route('admin.seller.subscription.bulk.action')"/>
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
        })(jQuery)
    </script>
@endsection

