@extends('backend.admin-master')
@section('site-title')
    {{__('All Categories')}}
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
                                <h4 class="header-title">{{__('All Categories')}}  </h4>
                                @can('category-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('category-create')
                            <div class="right-content">
                                <a href="{{ route('admin.category.new')}}" class="btn btn-primary">{{__('Add New Category')}}</a>
                            </div>
                             @endcan
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
                                <th>{{__('Category')}}</th>
                                <th>{{__('Icon')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($categories as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td><i class="{{$data->icon}} btn btn-primary"></i></td>
                                            <td>{!! render_image_markup_by_attachment_id($data->image,'','thumb') !!}</td>
                                            <td>
                                                @can('category-status')
                                                    @if($data->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.category.status',$data->id)"/></span>
                                                @endcan
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @can('category-delete')
                                                  <x-delete-popover :url="route('admin.category.delete',$data->id)"/>
                                                @endcan
                                                @can('category-edit')
                                                  <x-edit-icon :url="route('admin.category.edit',$data->id)"/>
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
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.category.bulk.action')"/>

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });
                
              });
        })(jQuery);
    </script>
@endsection
