@extends('backend.admin-master')
@section('site-title')
    {{__('Cancelled Orders')}}
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
                                <h4 class="header-title">{{__('Cancelled Orders')}}  </h4>
                                <small class="text-danger">{{ __('If a order payment is completed and the order is cancelled without completing then admin can change the return money status here.') }}</small>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Buyer Name')}}</th>
                                <th>{{__('Buyer Email')}}</th>
                                <th>{{__('Buyer Phone')}}</th>
                                <th>{{__('Buyer Address')}}</th>
                                <th>{{__('Total Amount')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Money Return')}}</th>
                                <th>{{__('Order Details')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($orders as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->address}}</td>
                                            <td>{{float_amount_with_currency_symbol($data->total)}}</td>
                                            <td>{{$data->payment_status}}</td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @if($data->cancel_order_money_return==0)
                                                <span class="btn text-danger">{{ __('No') }}</span>
                                                <span><x-status-change :url="route('admin.orders.cancel.money.return',$data->id)"/></span>
                                                @else
                                                <span class="btn text-success">{{ __('Yes') }}</span>
                                                @endif 
                                            </td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('admin.orders.details',$data->id) }}"> <i class="ti-eye"></i></a>
                                                <x-delete-popover :url="route('admin.order.cancel.delete',$data->id)" :class="''"/>
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
                    title: '{{__("Already Returned Money !! Want to Change Status !!")}}',
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
