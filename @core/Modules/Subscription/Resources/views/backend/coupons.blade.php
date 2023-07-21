@extends('backend.admin-master')

@section('site-title')
    {{__('All Coupons')}}
@endsection
@section('style')
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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Coupons')}}  </h4>
                                @can('coupon-delete')
                                    <x-bulk-action/>
                                @endcan
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
                                <th>{{__('Code')}}</th>
                                <th>{{__('Discount')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Expire Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($coupons as $data)
                                    <tr>
                                        <td>
                                            <x-bulk-delete-checkbox :id="$data->id"/>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->code}}</td>
                                        <td>{{$data->discount}}</td>
                                        <td>{{ucfirst($data->discount_type)}}</td>
                                        <td>{{$data->expire_date}}</td>
                                        <td>
                                            @if($data->status==1)
                                                <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                            @else
                                                <span class="btn btn-danger">{{__('Inactive')}}</span>
                                            @endif
                                            <span><x-status-change :url="route('admin.subscription.coupon.status',$data->id)"/></span>
                                        </td>
                                        <td>
                                            @can('slider-edit')
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#editCouponModal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 edit_coupon_modal"
                                                   data-id="{{ $data->id }}"
                                                   data-code="{{ $data->code }}"
                                                   data-discount="{{ $data->discount }}"
                                                   data-discount_type="{{ $data->discount_type }}"
                                                   data-expire_date="{{ $data->expire_date }}">
                                                    <i class="ti-pencil"></i>
                                                </a>

                                            @endcan
                                            @can('slider-delete')
                                                <x-delete-popover :url="route('admin.subscription.coupon.delete',$data->id)"/>
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
                                <h4 class="header-title">{{__('Add New Coupon')}}</h4>
                            </div>
                        </div>
                        <form action="{{route('admin.subscription.coupon')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="tab-content margin-top-40">

                                <div class="form-group">
                                    <label for="coupon_code">{{__('Coupon Code')}}</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}" placeholder="{{__('Coupon Code')}}">
                                </div>

                                <div class="form-group">
                                    <label for="discount">{{__('Discount')}}</label>
                                    <input type="number" class="form-control" name="discount" id="discount" value="{{ old('discount') }}" placeholder="{{__('Discount')}}">
                                </div>

                                <div class="form-group">
                                    <label for="discount_type">{{__('Discount Type')}}</label>
                                    <select name="discount_type" id="discount_type" class="form-control">
                                        <option value="amount">{{ __('Amount') }}</option>
                                        <option value="percentage">{{ __('Percentage') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="expire_date">{{__('Expire Date')}}</label>
                                    <input type="date" class="form-control" name="expire_date" id="expire_date" placeholder="{{__('Expire Date')}}">
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



{{--   Edit Modal--}}
    <div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModal" aria-hidden="true">
        <form action="{{ route('admin.subscription.coupon.update') }}" method="post">
            <input type="hidden" id="up_id" name="up_id" >
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCouponModal">{{ __('Edit Coupon') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="up_code">{{ __('Coupon Code') }}</label>
                            <input type="text" name="up_code" id="up_code" class="form-control" placeholder="{{ __('Coupon Code') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_discount">{{ __('Coupon Discount') }}</label>
                            <input type="number" name="up_discount" id="up_discount" class="form-control" placeholder="{{ __('Discount') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_discount_type">{{ __('Coupon Type') }}</label>
                            <select name="up_discount_type" id="up_discount_type" class="form-control nice-select mb-3">
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="percentage">{{ __('Percentage') }}</option>
                                <option value="amount">{{ __('Amount') }}</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_expire_date">{{ __('Expire Date') }}</label>
                            <input type="date" name="up_expire_date" id="up_expire_date" class="form-control" placeholder="{{ __('Expire Date') }}">
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
    <x-media.js />
    <script src="{{asset('assets/common/js/flatpickr.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                    $(document).on('click','.edit_coupon_modal',function(e){
                        e.preventDefault();
                        let coupon_id = $(this).data('id');
                        let code = $(this).data('code');
                        let discount = $(this).data('discount');
                        let discount_type = $(this).data('discount_type');
                        let expire_date = $(this).data('expire_date');

                        $('#up_id').val(coupon_id);
                        $('#up_code').val(code);
                        $('#up_discount').val(discount);
                        $('#up_discount_type').val(discount_type);
                        $('#up_expire_date').val(expire_date);
                        $('.nice-select').niceSelect('update');
                    });

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

                $("#up_expire_date").flatpickr({
                    dateFormat: "Y-m-d",
                });

            });
        })(jQuery)
    </script>
@endsection

