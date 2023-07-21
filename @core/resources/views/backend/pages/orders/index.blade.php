@extends('backend.admin-master')
@section('site-title')
    {{__('All Orders')}}
@endsection

@section('style')
<x-datatable.css/>
<x-media.css/>
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
                                <h4 class="header-title">{{__('All Orders')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Buyer Name')}}</th>
                                <th>{{__('Buyer Email')}}</th>
                                <th>{{__('Buyer Phone')}}</th>
                                <th>{{__('Buyer Address')}}</th>
                                <th>{{__('Total Amount')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Order Status')}}</th>
                                <th>{{__('Order Type')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="OrderStatusChangeModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('admin.change.order.status') }}" method="post">
            @csrf
            <input type="hidden" name="id" class="order_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Change Order Status ') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="status_id">{{ __('Select Status') }}</label>
                            <select name="status_id" id="status_id" class="form-control">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="2">{{ __('Completed') }}</option>
                                <option value="3">{{ __('Delivered') }}</option>
                                <option value="4">{{ __('Cancel') }}</option>
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

@section('script')
@include('backend.partials.datatable.script-enqueue',['only_js' => true])
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){


                //order status change
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let status_id = el.data('status_id');
                    let form = $('#OrderStatusChangeModal');
                    form.find('.order_id').val(status_id);
                });


                $('.table-wrap > table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.orders') }}",
                    columns: [
                        {data: 'checkbox', name: '', orderable: false, searchable: false},
                        {data: 'id', name: 'id'},
                        {data: 'name', name: '', orderable: true, searchable: true},
                        {data: 'email', name: '', orderable: true, searchable: true},
                        {data: 'phone', name: '', orderable: true, searchable: true},
                        {data: 'address', name: '', orderable: true, searchable: true},
                        {data: 'amount', name: '', orderable: true, searchable: true},
                        {data: 'payment_status', name: '',orderable: true, searchable: true},
                        {data: 'status', name: ''},
                        {data: 'is_order_online', name: '',orderable: true, searchable: true},
                        {data: 'action', name: '', orderable: false, searchable: true},
                    ]
                });


                $(document).on('click','.order_payment_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to change Payment status?")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_cancel_order_submit_btn').trigger('click');
                        }
                    });
                });


            });

        })(jQuery);
    </script>
@endsection
