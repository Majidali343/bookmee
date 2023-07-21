@extends('backend.admin-master')
@section('site-title')
    {{__('Service Area')}}
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
                                <h4 class="header-title">{{__('Service Area')}}  </h4>
                                @can('area-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('area-create')
                            <div class="right-content">
                                <a href="{{ route('admin.area.add')}}" class="btn btn-primary">{{__('Add New Area')}}</a>
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
                                <th>{{__('Service Area')}}</th>
                                <th>{{__('City')}}</th>
                                <th>{{__('Country')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($service_areas as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->service_area}}</td>
                                            <td>{{optional($data->city)->service_city}}</td>
                                            <td>{{optional($data->country)->country}}</td>
                                            <td>
                                                @can('area-status')
                                                    @if($data->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.area.status',$data->id)"/></span>
                                                @endcan        
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @can('area-delete')
                                                  <x-delete-popover :url="route('admin.area.delete',$data->id)"/>
                                                @endcan
                                                @can('area-edit')
                                                <a href="#"
                                                data-toggle="modal"
                                                data-target="#area_edit_modal"
                                                class="btn btn-primary btn-xs mb-3 mr-1 area_item_edit_btn"
                                                data-id="{{$data->id}}"
                                                data-area="{{$data->service_area}}"
                                                data-city="{{optional($data->city)->id}}"
                                                data-country="{{optional($data->country)->id}}"
                                                >
                                                <i class="ti-pencil"></i>
                                             </a>
                                             @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $service_areas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="area_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Area')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.area.edit')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="up_service_area">{{__('Service Area')}}</label>
                            <input type="text" class="form-control" name="up_service_area" id="up_service_area" placeholder="{{__('Service Area')}}">
                        </div>
                        <div class="form-group">
                            <label for="up_service_city_id">{{__('Service City')}}</label>
                            <select name="up_service_city_id" id="up_service_city_id" class="form-control" >
                                <option value="">{{ __('Select City') }}</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="up_country_id">{{__('Service Country')}}</label>
                            <select name="up_country_id" id="up_country_id" class="form-control" >
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button id="update" type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.area.bulk.action')"/>

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

                $(document).on('click', '.area_item_edit_btn', function () {
                    var el = $(this);
                    var id = el.data('id');
                    var area = el.data('area');
                    var city = el.data('city');
                    var country = el.data('country');
                    var form = $('#area_edit_modal');
                    form.find('#up_id').val(id);
                    form.find('#up_service_area').val(area);
                    form.find('#up_service_city_id').val(city);
                    form.find('#up_country_id').val(country);
                });

              });
        })(jQuery);
    </script>
@endsection
