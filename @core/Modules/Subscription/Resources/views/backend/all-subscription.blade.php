@extends('backend.admin-master')

@section('site-title')
    {{__('All Subscriptions')}}
@endsection
@section('style')
    <x-media.css/>
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Subscriptions')}}  </h4>
                                <a href="#" class="btn btn-info" data-toggle="modal"
                                   data-target="#ticketModal" > {{__('Connect Settings' )}}
                                </a>
                                @can('subscription-delete')
                                    <x-bulk-action/>
                                @endcan
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
                                <th>{{__('Image')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $data)
                                    <tr>
                                        <td>
                                            <x-bulk-delete-checkbox :id="$data->id"/>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{!! render_attachment_preview_for_admin($data->image,'max-width-100') !!}</td>
                                        <td>
                                            <ul>
                                                <li><strong>{{__('Title')}}: </strong>{{$data->title}}</li>
                                                <li><strong>{{__('Type')}}: </strong>{{ucfirst($data->type)}}</li>
                                                <li><strong>{{__('Price')}}: </strong>{{float_amount_with_currency_symbol($data->price)}}</li>
                                                <li><strong>{{__('Connect')}}: </strong>{{$data->connect}}</li>
                                                <li><strong>{{__('Service')}}: </strong>{{$data->service}}</li>
                                                <li><strong>{{__('Job')}}: </strong>{{$data->job}}</li>
                                                <li><strong>{{__('Seller Using This Subscription')}}: </strong>{{optional($data->seller)->count()}}</li>
                                            </ul>

                                        </td>
                                        <td>
                                            @can('subscription-delete')
                                                <x-delete-popover :url="route('admin.subscription.delete',$data->id)"/>
                                            @endcan
                                            @can('subscription-edit')
                                                <x-edit-icon :url="route('admin.subscription.edit',$data->id)"/>
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Subscription')}}   </h4>
                            </div>
                        </div>
                        <form action="{{route('admin.subscription.all')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="image">{{__('Upload Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Image')}}
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="{{__('Title')}}">
                                </div>

                                <div class="form-group">
                                    <label for="type">{{__('Subscription Type')}}</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="monthly">{{__('Monthly')}}</option>
                                        <option value="yearly">{{__('Yearly')}}</option>
                                        <option value="lifetime">{{__('Lifetime')}}</option>
                                    </select>
                                    <small class="text-info">{{__('Lifetime means unlimited number of connection')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="price">{{__('Price')}}</label>
                                    <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" placeholder="{{__('Price')}}">
                                </div>

                                <div class="form-group connect_show_hide">
                                    <label for="connect">{{__('Connect')}}</label>
                                    <input type="number" class="form-control" name="connect" id="connect" value="{{ old('connect') ?? 0 }}" placeholder="{{__('No of Connect')}}">
                                    <span>{{ __('Connect for order') }}</span>
                                </div>
                                <div class="form-group connect_show_hide">
                                    <label for="service">{{__('Service')}}</label>
                                    <input type="number" class="form-control" name="service" id="service" value="{{ old('service') ?? 0 }}" placeholder="{{__('No of Service')}}">
                                    <span>{{ __('Maximum Service Create') }}</span>
                                </div>

                                <div class="form-group connect_show_hide">
                                    <label for="job">{{__('Job')}}</label>
                                    <input type="number" class="form-control" name="job" id="job" value="{{ old('job') ?? 0 }}" placeholder="{{__('No of Job')}}">
                                    <span> {{ __('Maximum Apply Job') }}</span>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('admin.connect.settings') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Set how much connect will reduce from each order') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Number of connects')}} </label>
                                <input type="number" class="form-control" name="set_number_of_connect" value="{{get_static_option('set_number_of_connect')}}" id="set_number_of_connect">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-media.markup/>
@endsection

@section('script')
    <x-media.js />
    <x-datatable.js/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <x-bulk-action-js :url="route('admin.subscription.bulk.action')"/>

                    $(document).on('change','#type',function(){
                        $('.connect_show_hide').show();
                        let type = $(this).val();
                        if(type=='lifetime'){
                            $('.connect_show_hide').hide();
                        }
                    })

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
        })(jQuery)
    </script>
@endsection  

