@extends('backend.admin-master')
@section('site-title')
    {{__('Reading')}}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Reading Settings")}}</h4>
                        <form action="{{route('admin.general.reading')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                               <div class="form-group">
                                   <label for="site_logo">{{__('Home Page Display')}}</label>
                                   <select name="home_page" class="form-control">
                                       @foreach($all_home_pages as $page)
                                           <option value="{{$page->id}}" @if($page->id == get_static_option('home_page'))  selected @endif >{{$page->title}}</option>
                                       @endforeach
                                   </select>
                               </div>
              
                               <div class="form-group">
                                    <label for="site_logo">{{__('Service List Page')}}</label>
                                    <select name="service_list_page" class="form-control">
                                        
                                        @foreach($all_home_pages as $page)
                                        
                                            <option value="{{$page->id}}" @if($page->id == get_static_option('service_list_page'))  selected @endif>{{$page->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                               <div class="form-group">
                                   <label for="site_logo">{{__('Blog Page')}}</label>
                                   <select name="blog_page" class="form-control">
                                       @foreach($all_home_pages as $page)
                                           <option value="{{$page->id}}" @if($page->id == get_static_option('blog_page'))  selected @endif>{{$page->title}}</option>
                                       @endforeach
                                   </select>
                             </div>
                              <div class="form-group">
                                   <label for="site_logo">{{__('Price Plan Page')}}</label>
                                   <select name="price_plan_page" class="form-control">
                                       @foreach($all_home_pages as $page)
                                           <option value="{{$page->id}}" @if($page->id == get_static_option('price_plan_page'))  selected @endif>{{$page->title}}</option>
                                       @endforeach
                                   </select>
                             </div>
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
