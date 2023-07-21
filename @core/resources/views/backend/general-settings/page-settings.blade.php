@extends('backend.admin-master')
@section('site-title')
    {{__('Page Settings')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Page Name & Slug Settings")}}</h4>
                        <form action="{{route('admin.general.page.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @php
                                $page_names = [
                                    ['name'=>'gallery','slug_example'=>'gallery'],
                                    ['name'=>'blog','slug_example'=>'blog'],
                                    ['name'=>'contact','slug_example'=>'contact-us'],


                                ];
                            @endphp
                            <div class="row">
                                <div class="col-lg-6">
                                    @foreach ($page_names as $key => $page_name)
                                        <div class="from-group mb-3">
                                            <label for="{{$page_name['name']}}_page_slug">{{__(Str::ucfirst(str_replace('_',' ',$page_name['name'])).' '.'Page Slug')}}</label>
                                            <input type="text" class="form-control" id="{{$page_name['name']}}_page_slug" value="{{get_static_option($page_name['name'].'_page_slug')}}" name="{{$page_name['name']}}_page_slug" placeholder="{{__('Slug')}}" >
                                            <small>{{__('slug example:'.$page_name['slug_example'])}}</small>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="col-lg-6">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            @foreach($all_languages as $key => $lang)
                                                <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                            @endforeach
                                        </div>
                                    </nav>
                                    <div class="tab-content margin-top-30" id="nav-tabContent">
                                        @foreach($all_languages as $key => $lang)
                                            <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                                @foreach ($page_names as $key => $page_name)
                                                    <div class="accordion-wrapper">
                                                        <div id="accordion-{{$lang->slug}}">
                                                            <div class="card">
                                                                <div class="card-header" id="{{$page_name['name']}}_page_{{$lang->slug}}">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$page_name['name']}}_page_content_{{$lang->slug}}" aria-expanded="true" >
                                                                            <span class="page-title">@if(!empty(get_static_option($page_name['name'].'_page_'.$lang->slug.'_name'))) {{get_static_option($page_name['name'].'_page_'.$lang->slug.'_name')}} @else {{__(Str::ucfirst($page_name['name']))}}  @endif</span>
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                                <div id="{{$page_name['name']}}_page_content_{{$lang->slug}}" class="collapse"  data-parent="#accordion-{{$lang->slug}}">
                                                                    <div class="card-body">
                                                                        <div class="from-group">
                                                                            <label for="{{$page_name['name']}}_page_{{$lang->slug}}_name">{{__('Name')}}</label>
                                                                            <input type="text" class="form-control" name="{{$page_name['name']}}_page_{{$lang->slug}}_name" id="{{$page_name['name']}}_page_{{$lang->slug}}_name" value="{{get_static_option($page_name['name'].'_page_'.$lang->slug.'_name')}}"  placeholder="{{__('Name')}}" >
                                                                        </div>
                                                                        <div class="form-group margin-top-20">
                                                                            <label for="{{$page_name['name']}}_page_{{$lang->slug}}_meta_tags">{{__('Meta Tags')}}</label>
                                                                            <input type="text" name="{{$page_name['name']}}_page_{{$lang->slug}}_meta_tags"  class="form-control" data-role="tagsinput" value="{{get_static_option($page_name['name'].'_page_'.$lang->slug.'_meta_tags')}}" id="{{$page_name['name']}}_page_{{$lang->slug}}_meta_tags">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="{{$page_name['name']}}_page_{{$lang->slug}}_meta_description">{{__('Meta Description')}}</label>
                                                                            <textarea name="{{$page_name['name']}}_page_{{$lang->slug}}_meta_description"  class="form-control" rows="5" id="{{$page_name['name']}}_page_{{$lang->slug}}_meta_description">{{get_static_option($page_name['name'].'_page_'.$lang->slug.'_meta_description')}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function (e) {
                <x-btn.update/>
                $('.page-name').on('bind','change paste keyup',function (e) {
                    $(this).parent().parent().parent().prev().find('.page-title').text($(this).val());
                })
            })
        })(jQuery);

    </script>
@endsection
