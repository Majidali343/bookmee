@extends('backend.admin-master')
@section('site-title')
    {{__('All Blogs Copy')}}
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
                                    <form action="{{route('admin.blog')}}" method="get" id="langauge_change_select_get_form">
                                        <x-lang.select :name="'lang'" :selected="$default_lang" :id="'langchange'"/>
                                    </form>
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
                                        @foreach($all_blog as $data)
                                            <tr>
                                              <td>
                                                  <x-bulk-delete-checkbox :id="$data->id"/>
                                              </td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->getTranslation('title',$default_lang,true)}}</td>
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

                                                <td>
                                                    @php
                                                        $colors = ['text-primary','text-danger','text-success','text-info','text-dark']
                                                    @endphp
                                                    @foreach($data->category_id as $key => $cat)
                                                        @php $comma = !$loop->last ? ' | ' : ' '; @endphp
                                                        <span class="{{$colors[random_int(0,4)]}}">{{$cat->getTranslation('title',$default_lang,true) .$comma}}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{$data->author_data()->name ?? __('anonymous') }}</td>
                                                <td>{{$data->created_by ?? '' }}</td>
                                                <td>{{$data->views ?? 0 }}</td>
                                                <td>
                                                    <x-status-span :status="$data->status"/>
                                                </td>
                                                <td>{{date_format($data->created_at,'d-M-Y')}}</td>
                                                <td>
                                                    @can('blog-delete')
                                                        <x-delete-popover-all-lang :url="route('admin.blog.delete.all.lang',$data->id)"/>
                                                    @endcan
                                                   @can('blog-edit')
                                                    <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1" href="{{route('admin.blog.edit',$data->id).'?lang='.$default_lang}}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                    <form action="{{route('admin.blog.clone')}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        <input type="hidden" name="item_id" value="{{$data->id}}">
                                                        <button type="submit" title="clone this to new draft" class="btn btn-xs btn-secondary btn-sm mb-3 mr-1"><i class="far fa-copy"></i></button>
                                                    </form>
                                                            @if($data->status === 'pending')
                                                            <form action="{{route('admin.blog.approve')}}" method="post" style="display: inline-block">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                                <button type="submit" data-toggle="tooltip" data-title="Approve Blog" class="btn btn-xs btn-success btn-sm mb-3 mr-1"><i class="fa fa-check"></i></button>
                                                            </form>
                                                            @endif
                                                     @endcan
                                                    <a class="btn btn-info btn-xs mb-3 mr-1" data-toggle="tooltip" title="View Blog" target="_blank" href="{{route('frontend.blog.single',$data->slug)}}">
                                                      <i class="ti-eye"></i>
                                                    </a>
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
        <x-bulk-action-js :url="route('admin.blog.bulk.action')" />
        $(document).on('change','#langchange',function(e){
            $('#langauge_change_select_get_form').trigger('submit');
        });
    });
})(jQuery)
</script>
@endsection
