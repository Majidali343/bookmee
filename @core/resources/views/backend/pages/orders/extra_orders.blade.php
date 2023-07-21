@extends('backend.admin-master')
@section('site-title')
    {{__('Extra Orders')}}
@endsection

@section('style')
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Extra Orders')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('Main Order ID')}}</th>
                                <th>{{__('Extra Order ID')}}</th>
                                <th>{{__('Buyer Details')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Payment Gateway')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($extra_services as $data)
                                        <tr>
                                            <td>{{$data->order_id}}</td>
                                            <td>{{$data->id}}</td>
                                            <td>
                                                <p><strong>{{ __('Name:') }}</strong> {{ optional(optional($data->order)->buyer)->name }}</p>
                                                <p><strong>{{ __('Email:') }}</strong> {{ optional(optional($data->order)->buyer)->email }}</p>
                                            </td>
                                            <td>
                                                <p><strong>{{ __('Name:') }}</strong> {{ optional(optional($data->order)->seller)->name }}</p>
                                                <p><strong>{{ __('Email:') }}</strong> {{ optional(optional($data->order)->seller)->email }}</p>
                                            </td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->payment_gateway}}</td>
                                            <td>
                                                {{ucfirst($data->payment_status)}}
                                                @if($data->payment_status == 'pending')
                                                    @can('complete-status')
                                                        <span><x-status-change :url="route('admin.extra.order.complete.payment.status',$data->id)"/></span>
                                                    @endcan
                                                @endif
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


