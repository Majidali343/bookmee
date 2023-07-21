@extends('backend.admin-master')

@section('site-title')
    {{__('All Country Tax')}}
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
                                <h4 class="header-title">{{__('All Country Tax')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Country')}}</th>
                                <th>{{__('Tax(%)')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($taxes as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{optional($data->country)->country}}</td>
                                        <td>{{$data->tax}}</td>
                                        <td>
                                            @can('slider-delete')
                                                <x-delete-popover :url="route('admin.country.tax.delete',$data->id)"/>
                                            @endcan
                                            @can('admin-coupon-edit')
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#tax_edit_modal"
                                                   class="btn btn-primary btn-xs mb-3 mr-1 tax_edit_btn"
                                                   data-id="{{$data->id}}"
                                                   data-tax="{{$data->tax}}"
                                                   data-country_id="{{$data->country_id}}">
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
                                <h4 class="header-title">{{__('Add country Tax')}}   </h4>
                            </div>
                        </div>
                        <form action="{{route('admin.country.tax')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="tax">{{__('Tax')}}(%)</label>
                                    <input type="number" class="form-control" step="0.05" name="tax" placeholder="{{__('Enter tax percentage')}}">
                                </div>
                                <div class="form-group">
                                    <label for="country_id">{{__('Country')}}</label>
                                    <select name="country_id" class="form-control">
                                        <option value="">{{ __('Select Country') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{$country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="tax_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Tax')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.country.tax.edit')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="up_code">{{__('Coupon Code')}}</label>
                            <input type="text" class="form-control" name="tax" id="tax" step="0.05" placeholder="{{__('Enter tax')}}">
                        </div>
                        <div class="form-group">
                            <label for="country_id">{{__('Country')}}</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{$country->country }}</option>
                                @endforeach
                            </select>
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
                $(document).on('click','.tax_edit_btn',function(){
                    let id = $(this).data('id');
                    let tax = $(this).data('tax');
                    let country_id = $(this).data('country_id');
                    let form = $('#tax_edit_modal');
                    form.find('#up_id').val(id);
                    form.find('#tax').val(tax);
                    form.find('#country_id').val(country_id);
                });
            });
        })(jQuery)
    </script>
@endsection

