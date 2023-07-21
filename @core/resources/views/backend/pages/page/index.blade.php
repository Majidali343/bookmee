@extends('backend.admin-master')
@section('site-title')
    {{__('All Pages')}}
@endsection

@section('style')
<x-datatable.css/>
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
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Pages')}}  </h4>
                                @can('pages-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                    @can('pages-create')
                                         <a href="{{ route('admin.page.new')}}" class="btn btn-primary">{{__('Add New Page')}}</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($all_pages as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->title ?? __('Untitled')}}
                                            @if($data->id == get_static_option('home_page'))
                                            <strong class="text-primary">-{{__('Home Page')}}</strong>
                                            @endif
                                            @if($data->id == get_static_option('blog_page'))
                                                <strong class="text-info">-{{__('Blog Page')}}</strong>
                                            @endif
                                            </td>
                                            <td>{{$data->created_at->diffForHumans()}}</td>
                                            <td><x-status-span :status="$data->status"/></td>
                                            <td>

                                                @can('pages-delete')
                                                @if($data->id != get_static_option('home_page') && $data->id != get_static_option('blog_page'))
                                                 <x-delete-popover-all-lang :url="route('admin.page.delete.lang.all',$data->id)"/>
                                                 <x-view-icon :url="route('frontend.dynamic.page',$data->slug)"/>
                                                 @endif
                                                @endcan

                                                @can('pages-edit')
                                                  <x-edit-icon :url="route('admin.page.edit',$data->id).'?lang='.$default_lang"/>
                                                @endcan

                                                @if(!empty($data->page_builder_status))
                                                    <a href="{{route('admin.dynamic.page.builder',['type' =>'dynamic-page','id' => $data->id])}}" target="_blank" class="btn btn-secondary mb-3 mr-1">{{__('Open Page Builder')}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.page.bulk.action')"/>
            });
        })(jQuery)
    </script>
@endsection
