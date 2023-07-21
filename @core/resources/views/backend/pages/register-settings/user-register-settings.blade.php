@extends('backend.admin-master')
@section('site-title')
    {{__('User Register Settings')}}
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
                                <h4 class="header-title">{{__('Seller Register Settings')}} </h4>
                                <p class="mb-3 text-info">{{__('You can set the seller register on/off from here.')}}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="{{ route('admin.seller.register.settings.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Seller Register On/Off') }}</label>
                                    <select name="seller_register_on_off" id="seller_register_on_off" class="form-control">
                                        <option value="on" {{ get_static_option('seller_register_on_off')=== 'on'? 'selected': '' }}>{{ __('On') }}</option>
                                        <option value="off" {{ get_static_option('seller_register_on_off')=== 'off' ? 'selected': '' }} >{{ __('Off') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Buyer Register Settings')}} </h4>
                                <p class="mb-3 text-info">{{__('You can set the buyer register on/off from here.')}}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="{{ route('admin.buyer.register.settings.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Buyer Register On/Off') }}</label>
                                    <select name="buyer_register_on_off" id="buyer_register_on_off" class="form-control">
                                        <option value="on" {{ get_static_option('buyer_register_on_off')=== 'on'? 'selected' :'' }} >{{ __('On') }}</option>
                                        <option value="off" {{ get_static_option('buyer_register_on_off')=== 'off'? 'selected' :'' }}>{{ __('Off') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Register Notice')}} </h4>
                                <p class="mb-3 text-info">{{__('This notice will show in register page only if the seller and buyer registration off.')}}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="{{ route('admin.seller.buyer.register.off.notice.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="commission_charge">{{ __('Register Notice') }}</label>
                                    <textarea class="form-control" name="register_notice" id="register_notice" cols="30" rows="5">{{ get_static_option('register_notice') ?? '' }}</textarea>
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
