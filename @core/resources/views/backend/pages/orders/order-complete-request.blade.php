@extends('backend.admin-master')
@section('site-title')
    {{__('Order Complete Request')}}
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
                                <h4 class="header-title">{{__('Order Complete Request')}}  </h4>
                                <small class="text-info py-2">{{ __('Request from seller to admin and buyer. Buyer will review the request and complete it. Or admin can complete it anytime if buyer not any response') }}</small>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('Order ID')}}</th>
                                <th>{{__('Order Price')}}</th>
                                <th>{{__('Request Date')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Buyer Details')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($orders as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{float_amount_with_currency_symbol($data->total)}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->updated_at))}}</td>
                                        <td>
                                            <p>{{ __('Name:') }} {{ optional($data->seller)->name }}</p>
                                            <p>{{ __('Email:') }} {{ optional($data->seller)->email }}</p>
                                            <p>{{ __('Phone:') }} {{ optional($data->seller)->phone }}</p>
                                        </td>
                                        <td>
                                            <p>{{ __('Name:') }} {{ optional($data->buyer)->name }}</p>
                                            <p>{{ __('Email:') }} {{ optional($data->buyer)->email }}</p>
                                            <p>{{ __('Phone:') }} {{ optional($data->buyer)->phone }}</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('admin.orders.details',$data->id) }}"> <i class="ti-eye"></i></a>
                                            <span><x-order-complete-request-approve :url="route('admin.order.complete.request',$data->id)"/></span>
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
                        title: '{{__("Are you sure to change status complete? Once you done you can not revert this !!")}}',
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
