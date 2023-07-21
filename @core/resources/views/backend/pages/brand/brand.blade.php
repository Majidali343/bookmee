@extends('backend.admin-master')
@section('site-title')
    {{__('All Brands')}}
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
                                <h4 class="header-title">{{__('Brand')}}  </h4>
                                @can('brand-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('brand-create')
                            <div class="right-content">
                                <a href="{{ route('admin.brand.add')}}" class="btn btn-primary">{{__('Add New Brand')}}</a>
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
                                <th>{{__('Title')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($brands as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>
                                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @can('brand-delete')
                                                  <x-delete-popover :url="route('admin.brand.delete',$data->id)"/>
                                                @endcan
                                                @can('brand-edit')
                                                <a class="btn btn-success mb-3" href="{{ route('admin.brand.edit',$data->id) }}"><i class="ti-pencil"></i></a>
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
                <x-bulk-action-js :url="route('admin.brand.bulk.action')"/>
              });
        })(jQuery);
    </script>
@endsection
