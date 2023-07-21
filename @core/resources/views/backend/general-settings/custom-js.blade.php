@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/show-hint.css')}}">
@endsection
@section('site-title')
    {{__('Custom Js')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Custom Js")}}</h4>
                        <p class="margin-bottom-30">{{__('you can only add js code here. no other code work here.')}}</p>
                        <form action="{{route('admin.general.custom.js')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <textarea name="custom_js_area" id="custom_js_area" cols="30" rows="10">{{$custom_js}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/codemirror.js')}}"></script>
    <script src="{{asset('assets/backend/js/javascript.js')}}"></script>
    <script src="{{asset('assets/backend/js/show-hint.js')}}"></script>
    <script src="{{asset('assets/backend/js/javascript-hint.js')}}"></script>
    <script>
        (function($) {
            "use strict";
            var editor = CodeMirror.fromTextArea(document.getElementById("custom_js_area"), {
                lineNumbers: true,
                mode: "text/javascript",
                matchBrackets: true
            });
        })(jQuery);
    </script>
@endsection
