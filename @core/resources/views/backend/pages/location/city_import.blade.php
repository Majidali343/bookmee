@extends('backend.admin-master')
@section('site-title')
    {{__('Import Cities/States')}}
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
                        <h2 class="title margin-bottom-20">{{__('Import City/State')}}</h2>
                        @if(empty($import_data))
                            <form action="{{route('admin.city.import')}}" method="post" enctype="multipart/form-data">
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
                            <form action="{{route('admin.city.import.database')}}" method="post" enctype="multipart/form-data">
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
                                                <select class="form-control">
                                                    <option value="">{{ __('Select Country') }}</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="country_id">
                                            </div>
                                            <p class="text-info">{{ __('Select your cities country ') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('City')}}</h6></td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control mapping_select">
                                                    <option value="">{{__('Select Field')}}</option>
                                                    {!! $option_markup !!}
                                                </select>
                                                <input type="hidden" name="city">
                                            </div>
                                            <p class="text-info">{{ __('Select city and only unique cities added automatically according to the selected country.') }}</p>
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
        })(jQuery);
    </script>
@endsection



