@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('site-title')
    {{__('Email Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Email Settings")}}</h4>

                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                             @endforeach
                        @endif

                        <form action="{{route('admin.general.email.template')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_global_email">{{__('Global Email')}}</label>
                                <input type="text" name="site_global_email"  class="form-control" value="{{get_static_option('site_global_email')}}" >
                                <small class="form-text text-muted">{{__('use your web mail here')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_global_email_template">{{__('Email Template')}}</label>
                                <input type="hidden" name="site_global_email_template"  class="form-control" value="{{get_static_option('site_global_email_template')}}" >
                                <div class="summernote" data-content='{{get_static_option("site_global_email_template")}}'></div>
                                <small class="form-text text-muted">{{__('@username Will replace by username of user and @company will be replaced by site title also @message will be replaced by dynamically with message.')}}</small>
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>
    (function($){
        "use strict";
        $(document).ready(function(){
            $('.summernote').summernote({
                height: 150,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length ){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }
        })
    })(jQuery);

        

    </script>
@endsection
