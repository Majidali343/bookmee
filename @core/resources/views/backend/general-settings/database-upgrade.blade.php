@extends('backend.admin-master')
@section('site-title')
    {{__('Database Upgrade')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Database Upgrade")}}</h4>

                        <form action="{{route('admin.general.database.upgrade')}}" method="POST" id="cache_settings_form" enctype="multipart/form-data">
                            @csrf
                             <button class="btn btn-primary mt-4 pr-4 pl-4 clear-cache-submit-btn" data-value="cache">{{__('Database Upgrade')}}</button>
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
                $(this).html('<i class="fas fa-spinner fa-spin"></i> {{__("Proccesing")}}')
            });
        });

    })(jQuery);
</script>
@endsection