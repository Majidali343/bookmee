@extends('backend.admin-master')
@section('site-title')
    {{__('Admin Commission')}}
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Admin Commission')}} </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="@if(!empty($commission)){{ route('admin.commission.update',$commission->id) }} @else {{ route('admin.commission.update') }} @endif" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="commission_charge_type">{{ __('System Type') }}</label>
                                    <select name="system_type"  class="form-control">
                                        <option value="">{{ __('Select Type') }}</option>
                                        <option value="commission" @if(!empty($commission) && $commission->system_type=='commission')  selected @endif>{{ __('Commission') }}</option>
                                        <option value="subscription" @if(!empty($commission) && $commission->system_type=='subscription')  selected @endif>{{ __('Subscription') }}</option>
                                    </select>
                                </div>
                                @if(!empty($commission) && $commission->system_type=='commission')
                                <div class="form-group">
                                    <label for="commission_charge_type">{{ __('Commission Type') }}</label>
                                    <select name="commission_charge_type"  class="form-control">
                                         <option value="amount" @if(!empty($commission) && $commission->commission_charge_type=='amount')  selected @endif>{{ __('Amount') }}</option> 
                                         <option value="percentage" @if(!empty($commission) && $commission->commission_charge_type=='percentage')  selected @endif>{{ __('Percentage') }}</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Commission Charge') }}</label>
                                    <input type="text" name="commission_charge" @if(!empty($commission)) value="{{ $commission->commission_charge }}" @else value="10" @endif class="form-control">
                                </div>
                                @endif

                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
