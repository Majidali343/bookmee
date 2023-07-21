@extends('backend.admin-master')

@section('site-title')
    {{__('Add New City/State')}}
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
                                <h4 class="header-title">{{__('Add New City/State')}} </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.city')}}">{{__('All Cities/States')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.city.add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>{{__('Service Country')}}</label>
                                <select name="country_id" class="form-control">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach($countries as $country) 
                                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_city">{{__('Service City/State')}}</label>
                                <input type="text" class="form-control" name="service_city" id="service_city" placeholder="{{__('Service City/State')}}">
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

