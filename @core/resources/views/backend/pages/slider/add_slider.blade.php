@extends('backend.admin-master')

@section('site-title')
    {{__('Add New Slider')}}
@endsection
@section('style')
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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Sliders')}}  </h4>
                                @can('slider-delete')
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
                                <th>{{__('Sub Title')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($sliders as $data)
                                    <tr>
                                        <td>
                                            <x-bulk-delete-checkbox :id="$data->id"/>
                                        </td>
                                        <td>{{$data->id}}</td>
                                        <td>{!! render_image_markup_by_attachment_id($data->background_image,'','thumb') !!}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->sub_title}}</td>
                                        <td>
                                            @can('slider-delete')
                                                <x-delete-popover :url="route('admin.slider.delete',$data->id)"/>
                                            @endcan
                                            @can('slider-edit')
                                                <x-edit-icon :url="route('admin.slider.edit',$data->id)"/>
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
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Slider')}}   </h4>
                            </div>
                        </div>
                        <form action="{{route('admin.slider.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="tab-content margin-top-40">

                                <div class="form-group">
                                    <label for="image">{{__('Upload Background Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="background_image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Slider Image')}}
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="{{__('Title')}}">
                                </div>

                                <div class="form-group">
                                    <label for="sub_title">{{__('Sub Title')}}</label>
                                    <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="{{__('Sub Title')}}">
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

                              </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
 <x-media.js />
 <script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            <x-bulk-action-js :url="route('admin.slider.bulk.action')"/>
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

