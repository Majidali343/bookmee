@extends('backend.admin-master')
@section('site-title')
    {{__('Service City/State')}}
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
                                <h4 class="header-title">{{__('City/State')}}  </h4>
                                @can('city-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('city-create')
                            <div class="right-content">
                                <a href="{{ route('admin.city.add')}}" class="btn btn-primary">{{__('Add New City/State')}}</a>
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
                                <th>{{__('Service City/State')}}</th>
                                <th>{{__('Service Country')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($service_cities as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->service_city}}</td>
                                            <td>{{ optional($data->countryy)->country }}</td>
                                            <td>
                                                @can('city-status')
                                                    @if($data->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.city.status',$data->id)"/></span>
                                                @endcan    
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @can('city-delete')
                                                  <x-delete-popover :url="route('admin.city.delete',$data->id)"/>
                                                @endcan
                                                @can('city-edit')
                                                <a href="#"
                                                data-toggle="modal"
                                                data-target="#city_edit_modal"
                                                class="btn btn-primary btn-xs mb-3 mr-1 city_item_edit_btn"
                                                data-id="{{$data->id}}"
                                                data-name="{{$data->service_city}}"
                                                data-country_id="{{optional($data->countryy)->id}}"
                                                data-country="{{optional($data->countryy)->country}}">
                                                <i class="ti-pencil"></i>
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


    <div class="modal fade" id="city_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit City/State')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.city.edit')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="up_country_id">{{__('Service Country')}}</label>
                            <select name="up_country_id" id="up_country_id" class="form-control">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach($countries as $country) 
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_city">{{__('Service City/State')}}</label>
                            <input type="text" class="form-control" name="up_service_city" id="up_service_city" placeholder="{{__('Service City')}}">
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
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.city.bulk.action')"/>

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('Yes, change it!')}}",
                    cancelButtonText: "{{__('Cancel')}}",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });

                $(document).on('click', '.city_item_edit_btn', function () {
                    var el = $(this);
                    var id = el.data('id');
                    var name = el.data('name');
                    var country_id = el.data('country_id');
                    var form = $('#city_edit_modal');
                    form.find('#up_id').val(id);
                    form.find('#up_service_city').val(name);
                    form.find('#up_country_id').val(country_id);
                });

              });
        })(jQuery);
    </script>
@endsection
