@extends('backend.admin-master')
@section('site-title')
    {{__('All Blogs')}}
@endsection
@section('style')
<x-datatable.css/>
<x-media.css/>
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
                                <h4 class="header-title">{{__('All Blog Items')}}   </h4>
                                @can('blog-delete')
                                    <x-bulk-action/>
                                @endcan
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                     @can('blog-create')
                                         <a href="{{route('admin.blog.new')}}" class="btn btn-info"> {{__('Add New')}}</a>
                                         <a href="{{route('admin.blog.trashed')}}" class="btn btn-danger"> {{__('Trashed Blogs')}}</a>
                                     @endcan
                                </div>
                            </div>
                        </div>

                                  <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_blog_table">
                                        <thead>
                                          <th class="no-sort">
                                           <div class="mark-all-checkbox">
                                               <input type="checkbox" class="all-checkbox">
                                           </div>
                                        </th>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Author')}}</th>
                                        <th>{{__('Created By')}}</th>
                                        <th>{{__('Views')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
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
    @include('backend.partials.datatable.script-enqueue',['only_js' => true])
<x-media.js/>
<script>
(function ($){
    "use strict";
    $(document).ready(function () {
        <x-bulk-action-js :url="route('admin.blog.bulk.action')" />

        $('.table-wrap > table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.blog',['lang' => $default_lang]) }}",
            columns: [
                {data: 'checkbox', name: '', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
                {data: 'title', name: '', orderable: false, searchable: false},
                {data: 'image', name: '', orderable: false, searchable: false},
                {data: 'category', name: ''},
                {data: 'author', name: ''},
                {data: 'created_by', name: ''},
                {data: 'views', name: ''},
                {data: 'status', name: ''},
                {data: 'date', name: ''},
                {data: 'action', name: '', orderable: false, searchable: false},
            ]
        });
    });
})(jQuery)
</script>
@endsection
