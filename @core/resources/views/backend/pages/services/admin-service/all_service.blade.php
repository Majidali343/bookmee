@extends('backend.admin-master')
@section('site-title')
    {{__('Admin Services')}}
@endsection

@section('style')
    <x-datatable.css/>
    <style>
        .btn-xs {
            padding: 5px 10px !important;
        }
    </style>
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
                                <h5 class="header-title">{{__('All Services')}}  </h5>
                                @can('category-delete')
                                    <x-bulk-action/>
                                @endcan
                            </div>
                            @can('category-create')
                                <div class="right-content">
                                    <a href="{{ route('admin.add.service')}}" class="btn btn-primary">{{__('Add New Service')}}</a>
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
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Service Type')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($services as $data)
                                    <tr>
                                        <td>
                                            <x-bulk-delete-checkbox :id="$data->id"/>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{{Str::limit($data->title, 40)}}</td>
                                        <td>{{float_amount_with_currency_symbol($data->price)}}</td>
                                        <td>
                                            @can('admin-service-status')
                                                @if($data->status==1)
                                                    <span class="btn btn-success btn-xs">{{__('Active')}}</span>
                                                @else
                                                    <span class="btn btn-danger btn-xs">{{__('Inactive')}}</span>
                                                @endif
                                                <span><x-status-change :url="route('admin.service.status',$data->id)"/></span>
                                            @endcan
                                        </td>
                                        <td><span>{{ $data->is_service_online==1 ? 'Online' : "Offline" }}</span></td>
                                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                        <td>
                                            @can('admin-service-edit')
                                                <a href="{{ route('admin.edit.service',$data->id) }}" class="btn btn-xs btn-success mb-3">{{ __('Edit Service') }}</a>
                                            @endcan
                                            @can('admin-service-attributes-add')
                                                <a href="{{ route('admin.add.service.attributes.by.id',$data->id) }}" class="btn btn-xs btn-dark mb-3">{{ __('Add Atributes') }}</a>
                                            @endcan
                                            @can('admin-service-attributes-edit')
                                                <a href="{{ route('admin.edit.service.attributes.by.id',$data->id) }}" class="btn btn-xs btn-danger mb-3">{{ __('Edit Atributes') }}</a>
                                            @endcan
                                            @can('admin-service-attributes-show')
                                                <a href="{{ route('admin.show.service.attributes.by.id',$data->id) }}" class="btn btn-xs btn-info mb-3">{{ __('Show Atributes') }}</a>
                                            @endcan
                                            @can('admin-service-delete')
                                                <x-delete-popover :url="route('admin.service.delete',$data->id)"/>
                                            @endcan
                                               <a href="{{ route('admin.service.view.details',$data->id) }}" class="btn btn-xs btn-primary mb-3"><i class="ti-eye"></i></a>
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
                <x-bulk-action-js :url="route('admin.service.bulk.action')"/>

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
