@extends('backend.admin-master')

@section('site-title')
    {{__('Order Success Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{__("Order Success Settings")}}</h4>
                        <small class="text-danger mb-5">{{ __('You can change order success page text from here.') }}</small>
                        <form action="{{route('admin.order.success.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="success_title">{{__('Order Success Title')}}</label>
                                <input type="text" name="success_title"  class="form-control" value="{{get_static_option('success_title')}}" id="success_title">
                            </div>
                            <div class="form-group">
                                <label for="success_subtitle">{{__('Order Success Subtitle')}}</label>
                                <input type="text" name="success_subtitle"  class="form-control" value="{{get_static_option('success_subtitle')}}" id="success_subtitle">
                            </div>
                            <div class="form-group">
                                <label for="success_details_title">{{__('Order Success Details Title')}}</label>
                                <input type="text" name="success_details_title"  class="form-control" value="{{get_static_option('success_details_title')}}" id="success_details_title">
                            </div>
                            <div class="form-group">
                                <label for="button_title">{{__('Order Success Button Title')}}</label>
                                <input type="text" name="button_title"  class="form-control" value="{{get_static_option('button_title')}}" id="button_title">
                            </div>
                            <div class="form-group">
                                <label for="button_url">{{__('Order Success Button Url')}}</label>
                                <input type="text" name="button_url"  class="form-control" value="{{get_static_option('button_url')}}" id="button_url">
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
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
            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>
            });
        }(jQuery));
    </script>
@endsection
