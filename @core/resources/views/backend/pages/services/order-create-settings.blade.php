@extends('backend.admin-master')

@section('site-title')
    {{__('Order Create Settings')}}
@endsection
@section('content')
    <div class="col-lg-6 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Order Create Settings')}} </h4>
                            </div>
                        </div>
                        <form action="{{route('admin.order.create.settings.update')}}" method="post">
                            @csrf
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="service_city">{{__('Who Will Create Order?')}}</label>
                                    <select type="text" class="form-control" name="order_create_settings" id="order_create_settings" placeholder="{{__('Order Create Settings')}}">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="anyone" {{ get_static_option('order_create_settings')=='anyone' ? 'selected' : '' }} >{{ __('Anyone') }}</option>
                                        <option value="login_user" {{ get_static_option('order_create_settings')=='login_user' ? 'selected' : '' }} >{{ __('Only Login User') }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


