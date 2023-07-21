@extends('backend.admin-master')
@section('site-title')
    {{__('Cache Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Cache Settings")}}</h4>
                        <form action="{{route('admin.general.cache.settings')}}" method="POST" id="cache_settings_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="cache_type" id="cache_type" class="form-control">
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" id="view" data-value="view">{{__('Clear View Cache')}}</button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" id="route" data-value="route">{{__('Clear Route Cache')}}</button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" id="config" data-value="config">{{__('Clear Configure Cache')}}</button><br>
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" id="clear" data-value="cache">{{__('Clear Cache')}}</button>
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
            $(document).on('click','.clear-cache-submit-btn',function(e){
                e.preventDefault();
                $(this).addClass("disabled")
                $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{__("Cleaning Cache")}}');
                $('#cache_type').val($(this).data('value'));
                $('#cache_settings_form').trigger('submit');
            });
        });
    })(jQuery);
</script>
@endsection