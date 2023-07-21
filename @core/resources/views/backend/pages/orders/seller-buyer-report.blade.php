@extends('backend.admin-master')
@section('site-title')
    {{__('Seller Buyer Reports')}}
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
                                <h4 class="header-title">{{__('Seller Buyer Reports')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('Order ID')}}</th>
                                <th>{{__('Report Details')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Buyer Details')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($reports as $data)
                                    <tr>
                                        <td>{{$data->order_id}}</td>
                                        <td>
                                            <p><strong>{{ __('Report From:') }}</strong> {{ ucfirst($data->report_from) }}</p>
                                            <p><strong>{{ __('Report To:') }}</strong> {{ ucfirst($data->report_to) }}</p>
                                            <p><strong>{{ __('Report Date:') }}</strong> {{date('d-m-Y', strtotime($data->created_at))}}</p>
                                            <p><strong>{{ __('Description:') }}</strong> <span class="btn btn-info btn-sm report_description" data-toggle="modal" data-target="#reportModal" data-report="{{ $data->report }}"><i class="ti-eye"></i></span></p>
                                        </td>
                                        <td>
                                            <p><strong>{{ __('Name:') }}</strong> {{ optional($data->seller)->name }}</p>
                                            <p><strong>{{ __('Email:') }}</strong> {{ optional($data->seller)->email }}</p>
                                            <p><strong>{{ __('Phone:') }}</strong> {{ optional($data->seller)->phone }}</p>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.order.report.chat.seller',$data->id.'/'.$data->seller_id) }}">{{__('Chat To Seller')}}</a>
                                        </td>
                                        <td>
                                            <p><strong>{{ __('Name:') }}</strong> {{ optional($data->buyer)->name }}</p>
                                            <p><strong>{{ __('Email:') }}</strong> {{ optional($data->buyer)->email }}</p>
                                            <p><strong>{{ __('Phone:') }}</strong> {{ optional($data->buyer)->phone }}</p>
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.order.report.chat.buyer',$data->id.'/'.$data->buyer_id) }}">{{__('Chat To Buyer')}}</a>
                                        </td>
                                        <td>
                                            @can('report-delete')
                                                <x-delete-popover :url="route('admin.order.report.delete',$data->id)"/>
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


    {{--    Report modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">{{ __('Report Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="report_description"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
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
                        confirmButtonText: "{{ __('Yes, change it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click','.report_description',function(e){
                    let report_description = $(this).data('report');
                    $('#report_description').text(report_description);
                });
            });

        })(jQuery);
    </script>
@endsection
