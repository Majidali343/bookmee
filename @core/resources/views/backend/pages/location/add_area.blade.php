@extends('backend.admin-master')

@section('site-title')
    {{__('Add New Area')}}
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
                                <h4 class="header-title">{{__('Add New Area')}} </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.area')}}">{{__('All Areas')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.area.add')}}" method="post">
                            @csrf
                            <div class="tab-content margin-top-40">
                                
                                <div class="form-group">
                                    <label for="country_id">{{__('Service Country')}}</label>
                                    <select name="country_id" id="country_id" class="form-control" >
                                        <option value="">{{ __('Select Country') }}</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">{{__('Service City')}}</label>
                                    <select name="service_city_id" id="service_city_id" class="form-control" >
                                        <option value="">{{ __('Select City') }}</option>
                                        {{-- @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="service_area">{{__('Service Area')}}</label>
                                    <input type="text" class="form-control" name="service_area" id="service_area" placeholder="{{__('Service Area')}}">
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
@section('script')

    <script>
        <x-icon-picker/> 
        (function ($) {
            "use strict";
            $(document).ready(function () {
                
               // change country and get city
                $(document).on('change','#country_id' ,function() {
                    let country_id = $("#country_id").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city_id").html(alloptions);
                                $(".service_area_wrapper .list").html("");
                            }
                        }
                    })
                })
                
            });
        })(jQuery);
    </script>
@endsection

