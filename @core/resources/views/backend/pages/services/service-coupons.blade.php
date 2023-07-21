@extends('backend.admin-master')

@section('site-title')
    {{__('All Coupons')}}
@endsection
@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/common/css/flatpickr.min.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Coupons')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Code')}}</th>
                                <th>{{__('Discount')}}</th>
                                <th>{{__('Discount Type')}}</th>
                                <th>{{__('Expire Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($coupons as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->code}}</td>
                                        <td>{{$data->discount}}</td>
                                        <td>{{$data->discount_type}}</td>
                                        <td>{{$data->expire_date}}</td>
                                        <td>
                                            @if($data->status==0)
                                                <span class="text-warning">{{ __('Inactive') }}</span>
                                            @else
                                                <span class="text-info">{{ __('Active') }}</span>
                                            @endif
                                            <x-status-change :url="route('admin.service.coupon.status',$data->id)"/>
                                        </td>
                                        <td>
                                            @can('slider-delete')
                                                <x-delete-popover :url="route('admin.coupon.delete',$data->id)"/>
                                            @endcan
                                            @can('admin-coupon-edit')
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#admin_coupon_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 admin_coupon_edit_btn"
                                                   data-id="{{$data->id}}"
                                                   data-code="{{$data->code}}"
                                                   data-discount="{{$data->discount}}"
                                                   data-discount_type="{{$data->discount_type}}"
                                                   data-expire_date="{{$data->expire_date}}">
                                                    <i class="ti-pencil"></i>
                                                </a>
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
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Coupon')}}   </h4>
                            </div>
                        </div>
                        <form action="{{route('admin.service.coupons')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="code">{{__('Coupon Code')}}</label>
                                    <input type="text" class="form-control" name="code" id="code" placeholder="{{__('code')}}">
                                </div>
                                <div class="form-group">
                                    <label for="discount">{{__('Coupon Discount')}}</label>
                                    <input type="number" class="form-control" name="discount" id="discount" placeholder="{{__('discount')}}">
                                </div>
                                <div class="form-group">
                                    <label for="discount_type">{{__('Coupon Type')}}</label>
                                    <select name="discount_type" class="form-control">
                                        <option value="">{{ __('Select Discount') }}</option>
                                        <option value="percentage">{{ __('Percentage') }}</option>
                                        <option value="amount">{{ __('Amount') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expire_date">{{__('Expire Date')}}</label>
                                    <input type="text" class="form-control" name="expire_date" id="expire_date" placeholder="{{__('expire date')}}">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="admin_coupon_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Coupon')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.service.coupon.edit')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="up_code">{{__('Coupon Code')}}</label>
                            <input type="text" class="form-control" name="up_code" id="up_code" placeholder="{{__('code')}}">
                        </div>
                        <div class="form-group">
                            <label for="up_discount">{{__('Coupon Discount')}}</label>
                            <input type="number" class="form-control" name="up_discount" id="up_discount" placeholder="{{__('discount')}}">
                        </div>
                        <div class="form-group">
                            <label for="up_discount_type">{{__('Coupon Type')}}</label>
                            <select name="up_discount_type" id="up_discount_type" class="form-control">
                                <option value="">{{ __('Select Discount') }}</option>
                                <option value="percentage">{{ __('Percentage') }}</option>
                                <option value="amount">{{ __('Amount') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="up_expire_date">{{__('Expire Date')}}</label>
                            <input type="text" class="form-control" name="up_expire_date" id="up_expire_date" placeholder="{{__('expire date')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button id="update" type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-media.markup/>

@endsection

@section('script')
    <x-media.js />
    <script src="{{asset('assets/common/js/flatpickr.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <x-bulk-action-js :url="route('admin.slider.bulk.action')"/>
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
                $("#expire_date").flatpickr({
                    dateFormat: "Y-m-d",
                });

                $(document).on('click','.admin_coupon_edit_btn',function(){
                    let id = $(this).data('id');
                    let code = $(this).data('code');
                    let discount = $(this).data('discount');
                    let type = $(this).data('discount_type');
                    let expire_date = $(this).data('expire_date');
                    let form = $('#admin_coupon_edit_modal');
                    form.find('#up_id').val(id);
                    form.find('#up_code').val(code);
                    form.find('#up_discount').val(discount);
                    form.find('#up_discount_type').val(type);
                    form.find('#up_expire_date').val(expire_date);
                });
                $("#up_expire_date").flatpickr({
                    dateFormat: "Y-m-d",
                });
            });
        })(jQuery)
    </script>
@endsection

