@extends('backend.admin-master')

@section('site-title')
    {{__('Subscription History')}}
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
                                <h4 class="header-title">{{__('Seller Subscription History')}}  </h4>
                                <p class="text-warning">{{ __('Seller earlier subscription history list.') }}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Subscription Details')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Payment Details')}}</th>
                                </thead>
                                <tbody>
                                @foreach($subscription_history as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>
                                            {{ __('Title:') }} {{optional($data->subscription)->title}} <br>
                                            {{ __('Price:') }}
                                            @if($data->price == 0)
                                                {{float_amount_with_currency_symbol($data->initial_price)}} <br>
                                            @else
                                                {{float_amount_with_currency_symbol($data->price)}} <br>
                                            @endif
                                            {{ __('Type:') }} {{ucfirst($data->type)}} <br>
                                            {{ __('Connect:') }}
                                            @if($data->connect == 0)
                                                {{$data->initial_connect}} <br>
                                            @else
                                                {{$data->connect}} <br>
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

