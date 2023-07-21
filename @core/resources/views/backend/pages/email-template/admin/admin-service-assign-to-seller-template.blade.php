@extends('backend.admin-master')
@section('site-title')
    {{__('Service Assign Template')}}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp d-flex justify-content-between">
                            <h4 class="header-title">{{__('Service Assign Template')}}</h4>
                            <a class="btn btn-info" href="{{route('admin.email.template.all')}}">{{__('All Email Templates')}}</a>
                        </div>
                        <form action="{{route('admin.service.assign.seller.email')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30">
                                <div class="form-group">
                                    <label for="admin_service_assign_subject">{{__('Email Subject')}}</label>
                                    <input type="text" name="admin_service_assign_subject"  class="form-control" value="{{ get_static_option('admin_service_assign_subject') ?? __('Service Assign By Admin') }}">
                                </div>
                                <div class="form-group">
                                    <label for="admin_service_assign_message">{{ __('Email Message') }}</label>
                                    <textarea class="form-control summernote" name="admin_service_assign_message">{{ get_static_option('admin_service_assign_message') ?? '' }} </textarea>
                                </div>
                                    <small class="form-text text-muted text-danger margin-top-20"><code>@service_id</code> {{__('will be replaced by dynamically with service id.')}}</small>
                                </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-media.js />
    <x-summernote.js/>
    <script>
        $(document).ready(function () {
            //to do:
        });
    </script>
@endsection
