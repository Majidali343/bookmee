@extends('backend.admin-master')
@section('site-title')
    {{__('Site Identity')}}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
              <x-msg.success/>
              <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Site Identity Settings")}}</h4>
                        <form action="{{route('admin.general.site.identity')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                            <x-image :title="__('Site Logo')" :name="'site_logo'" :dimentions="'160x50'"/>
                            <x-image :title="__('Site White Logo')" :name="'site_white_logo'" :dimentions="'160x50'"/>
                            <x-image :title="__('Favicon')" :name="'site_favicon'" :dimentions="'40x40'"/>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-media.markup/>
@endsection
@section('script')
<x-media.js/>
<script>
    (function($){
    "use strict";
        $(document).ready(function () {
            <x-btn.update/>
            <x-icon-picker/>
        });
    })(jQuery);
</script>
@endsection
