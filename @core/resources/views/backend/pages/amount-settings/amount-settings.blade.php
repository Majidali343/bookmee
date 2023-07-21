@extends('backend.admin-master')
@section('site-title')
    {{__('Amount Settings')}}
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
                                <h4 class="header-title">{{__('Amount Settings')}} </h4>
                                <p class="mb-3">{{__('you can set minimum and maximum withdraw amount for seller')}}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="@if(!empty($amount_settings)){{ route('admin.amount.settings.update',$amount_settings->id) }} @else {{ route('admin.amount.settings.update') }} @endif" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Minimum Amount') }}</label>
                                    <input type="number" name="min_amount" class="form-control" @if(!empty($amount_settings)) value="{{ $amount_settings->min_amount }}" @else value="50" @endif>
                                </div>
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Maximum Amount') }}</label>
                                    <input type="number" name="max_amount" class="form-control" @if(!empty($amount_settings)) value="{{ $amount_settings->max_amount }}" @else value="250" @endif>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
