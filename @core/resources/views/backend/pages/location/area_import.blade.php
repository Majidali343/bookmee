@extends('backend.admin-master')
@section('site-title')
    {{__('Import Areas')}}
@endsection
@section('style')

@endsection
@section('content')
    <br>
    <div class="col-lg-12 col-ml-12 padding-bottom-30 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-50">
                        <x-msg.success/>
                        <x-msg.error/>
                        <h2 class="title margin-bottom-20">{{__('Import Areas')}}</h2>
                        @if(empty($import_data))
                            <form action="{{route('admin.area.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="#">{{__('File')}}</label>
                                    <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                                    <div class="info-text">{{__('only csv file are allowed with separate by (,) comma.')}}</div>
                                </div>
                                <button type="submit" class="btn btn-info loading-btn">{{__('Submit')}}</button>
                            </form>
                        @else
                            @php
                                $option_markup = '';
                                    foreach(current($import_data) as $map_item ){
                                        $option_markup .= '<option value="'.trim($map_item).'">'.$map_item.'</option>';
                                    }
                            @endphp
                            <form action="{{route('admin.area.import.database')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                    <th style="width: 200px">{{{__('Field Name')}}}</th>
                                    <th>{{{__('Set Field')}}}</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><h6>{{__('Country')}}</h6></td>
                                        @php $countries = App\Country::where('status',1)->get(); @endphp
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="country_id" id="country_id">
                                                    <option value="">{{ __('Select Country') }}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-info">{{ __('Select your areas country ') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('City')}}</h6></td>
                                        @php $cities = App\ServiceCity::where('status',1)->get(); @endphp
                                        <td>
                                            <div class="form-group">
                                                <select name="service_city_id" id="service_city" class="get_service_city form-control">
                                                    <option value="">{{ __('Select City') }}</option>
                                                </select>
                                            </div>
                                            <p class="text-info">{{ __('Select your areas city ') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('Area')}}</h6></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control mapping_select">
                                                    <option value="">{{__('Select Field')}}</option>
                                                    {!! $option_markup !!}
                                                </select>
                                                <input type="hidden" name="area">
                                            </div>
                                            <p class="text-info">{{ __('Select area and only unique areas added automatically according to the selected country and city.') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('Status')}}</h6></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control mapping_select">
                                                    <option value="1">{{__('Publish')}}</option>
                                                    <option value="0">{{__('Draft')}}</option>
                                                </select>
                                                <input type="hidden" name="status" value="1">
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success loading-btn">{{__('Import')}}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function ($){
            "use strict";

            $(document).on('click','.loading-btn',function (){
                $(this).append('<i class="ml-2 fas fa-spinner fa-spin"></i>')
            });

            $(document).on('change','.mapping_select',function (){

                $('.mapping_select option').attr('disabled',false);
                $(this).next('input').val($(this).val());
                var allValue = $('.mapping_select');
                $.each(allValue,function (index,item){
                    $('.mapping_select option[value="'+$(this).val()+'"]').attr('disabled',true);
                });
            })

            // change country and get city
            $('#country_id').on('change',function(){
                let country_id = $(this).val();
                $.ajax({
                    method:'post',
                    url:"{{route('admin.area.import.country.city')}}",
                    data:{country_id:country_id},
                    success:function(res){
                        if(res.status=='success'){
                            let alloptions = '';
                            let allCity = res.cities;
                            $.each(allCity,function(index,value){
                                alloptions +="<option value='" + value.id + "'>" + value.service_city + "</option>";
                            });
                            $(".get_service_city").html(alloptions);
                        }
                    }
                })
            })

        })(jQuery);
    </script>
@endsection



