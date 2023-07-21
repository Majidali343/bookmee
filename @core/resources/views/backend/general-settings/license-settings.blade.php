@extends('backend.admin-master')
@section('site-title')
    {{__('License Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("License Settings")}}</h4>
                        @if('verified' == get_static_option('item_license_status'))
                            <div class="alert alert-success">{{__('Your Application is Registered')}}</div>
                        @endif
                        <form action="{{route('admin.general.license.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="item_script_type">{{__('Script Type')}}</label>
                                <select class="form-control" name="item_script_type">
                                    <option @if(get_static_option('item_script_type') === 'individual') selected @endif value="individual">{{__('Individual')}}</option>
                                    <option @if(get_static_option('item_script_type') === 'bundle') selected @endif value="bundle">{{__('Bundle')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="item_purchase_key">{{__('Purchase Key')}}</label>
                                <input type="text" name="item_purchase_key"  class="form-control" value="{{get_static_option('item_purchase_key')}}" id="item_purchase_key">
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Submit Information')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <x-btn.custom :id="'submit'" :title="__('Verifying')" />
        });
        })(jQuery);
    </script>
@endsection