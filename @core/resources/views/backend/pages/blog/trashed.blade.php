@extends('backend.admin-master')
@section('site-title')
    {{__('All Trashed Blogs')}}
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
                                <h4 class="header-title">  {{__('All Trashed Blogs')}}   </h4>
                                @can('blog-trashed-delete')
                                    <x-bulk-action/>
                                @endcan
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                         <a href="{{route('admin.blog')}}" class="btn btn-info"> {{__('Go Back')}}</a>
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
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($trashed_blogs as $data)
                                            <tr>
                                              <td>
                                                  <x-bulk-delete-checkbox :id="$data->id"/>
                                              </td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>
                                                  @php
                                                       $blog_img = get_attachment_image_by_id($data->image,null,true);
                                                   @endphp
                                                   @if (!empty($blog_img))
                                                       <div class="attachment-preview">
                                                           <div class="thumbnail">
                                                               <div class="centered">
                                                                   <img class="avatar user-thumb" src="{{$blog_img['img_url']}}" alt="">
                                                               </div>
                                                           </div>
                                                       </div>
                                                   @endif
                                                </td>
                                                <td>{{ optional($data->category)->name }}</td>
                                                <td>{{$data->author}}</td>
                                                <td>
                                                    <x-status-span :status="$data->status"/>
                                                </td>
                                                <td>{{date_format($data->created_at,'d-M-Y')}}</td>
                                                <td>
                                                    @can('blog-trashed-delete')
                                                        <x-delete-popover-all-lang :url="route('admin.blog.trashed.delete',$data->id)"/>
                                                    @endcan

                                                  @can('blog-trashed-restore')
                                                    <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1" href="{{route('admin.blog.trashed.restore',$data->id)}}">
                                                       {{__('Restore')}}
                                                    </a>
                                                   @endcan

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
<x-media.js/>
<script>
(function ($){
    "use strict";
    $(document).ready(function () {
        <x-bulk-action-js :url="route('admin.blog.trashed.bulk.action')" />
        $(document).on('change','#langchange',function(e){
            $('#langauge_change_select_get_form').trigger('submit');
        });
    });
})(jQuery)
</script>
@endsection
