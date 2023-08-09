@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Service Coupons') }}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader />

    <!-- Dashboard area Starts -->

    <style>
        .check-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-height: 18px;
            min-width: 18px;
            cursor: pointer;
            background: #fff;
            border: 1px solid #dddddd;
            border-radius: 0px;
            margin-top: 3px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .check-input::after {
            content: "";
            font-family: "Line Awesome Free";
            font-weight: 900;
            font-size: 10px;
            color: #fff;
            visibility: hidden;
            opacity: 0;
            -webkit-transform: scale(1.6) rotate(90deg);
            transform: scale(1.6) rotate(90deg);
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
        }

        .check-input:checked {
            background: var(--main-color-one);
            border-color: var(--main-color-one);
            background: var(--main-color-one);
        }

        .check-input:checked::after {
            visibility: visible;
            opacity: 1;
            -webkit-transform: scale(1.2) rotate(0deg);
            transform: scale(1.2) rotate(0deg);
        }

        .checkbox-label {
            cursor: pointer;
            text-align: left;
            line-height: 26px;
            font-size: 18px;
            font-weight: 500;
            color: var(--heading-color);
        }

        @media only screen and (max-width: 575.98px) {
            .checkbox-label {
                font-size: 15px;
            }
        }
    </style>
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.seller.partials.sidebar')
                <div class="dashboard-right">
                    <div class="row">
                        <div class="d-flex w-100 justify-content-between col flex-wrap">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{ __('All Staff Members') }} </h2>
                            </div>
                            <div class="btn-wrapper margin-top-50 text-right">
                                <button class="cmn-btn btn-bg-1" data-toggle="modal"
                                    data-target="#addStaffModal">{{ __('Add New Staff') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <x-msg.error />
                    </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Staff ID') }}</th>
                                        {{-- <th>{{ __('Staff Image') }}</th> --}}
                                        <th>{{ __('Staff Name') }}</th>
                                        {{-- <th>{{ __('Staff Email') }}</th> --}}
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $key => $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            {{-- <td>  <div class="search_thumb bg-image" {!! render_background_image_markup_by_attachment_id($data->profile_image_id, '', 'thumb') !!}></div></td> --}}
                                            <td>{{ $data->name }}</td>
                                            {{-- <td>{{ $data->email }}</td> --}}
                                            <td>
                                                @if($data->profile_image_id)
                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_Staff_modal" data-toggle="modal"
                                                        data-target="#editStaffModal"
                                                        data-id ="{{ $data->id }}"
                                                        data-name ="{{ $data->name }}"
                                                        {{-- data-image ="{{$data->profile_image_id }}" --}}
                                                        {{-- data-email="{{$data->email }}" --}}
                                                        {{-- data-image_url="{{get_attachment_image_by_id($data->profile_image_id)['img_url']}}" --}}
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i
                                                                class="las la-edit"></i> </span>
                                                    </a>
                                                    <x-seller-delete-popup :url="route('seller.staff.delete', $data->id)" />
                                                </div>
                                                @else 

                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_Staff_modal" data-toggle="modal"
                                                        data-target="#editStaffModal"
                                                        data-id ="{{ $data->id }}"
                                                        data-name ="{{ $data->name }}"
                                                        {{-- data-image ="{{$data->profile_image_id }}" --}}
                                                        {{-- data-email="{{$data->email }}" --}}
                                                        {{-- data-image_url= {{null}} --}}
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i
                                                                class="las la-edit"></i> </span>
                                                    </a>
                                                    <x-seller-delete-popup :url="route('seller.staff.delete', $data->id)" />
                                                </div>

                                                @endif

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


    <!-- Add Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="staffModal"
        aria-hidden="true">
        <form action="{{ route('seller.staff.add') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block ">
                        <h5 class="modal-title" id="couponModal">{{ __('Add New Staff') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">  
                            <label for="staffName">{{ __('Name') }}</label>
                            <input type="text" name="staffName" id="staffName" class="form-control"
                                placeholder="{{ __('Name') }}">
                        </div>
                        {{-- <div class="form-group mt-3">
                            <label for="staffEmail">{{ __('Email') }}</label>
                            <input type="email" name="staffEmail" id="staffEmail" class="form-control"
                                placeholder="{{ __('Email') }}">
                        </div> --}}
                        {{-- <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <div class="form-group ">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Profile Image')}}
                                        </button>
                                        <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                        <small>{{ __('recommended size 1920x1280') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-staff-add btn-bg-1">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Edit Modal -->
    <div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModal"
        aria-hidden="true">
        <form action="{{ route('seller.staff.edit') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCouponModal">{{ __('Edit Staff') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="staffId" name="staffId" hidden>

                        <div class="form-group mt-3">  
                            <label for="staffName_up">{{ __('Name') }}</label>
                            <input type="text" name="staffName_up" id="staffName_up" class="form-control"
                                placeholder="{{ __('Name') }}">
                        </div>
                        {{-- <div class="form-group mt-3">
                            <label for="staffEmail_up">{{ __('Email') }}</label>
                            <input type="email" name="staffEmail_up" id="staffEmail_up" class="form-control"
                                placeholder="{{ __('Email') }}">
                        </div> --}}
                        {{-- <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <div class="form-group ">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="#" alt="" id="staff_up_image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_up" id="image_up">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Profile Image')}}
                                        </button>
                                        <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                        <small>{{ __('recommended size 1920x1280') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-staff-add btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <x-media.markup :type="'web'"/>

    <style>
        .search_thumb {
            border-radius: 10px;
            width: 75px;
            height: 75px;
        }
        .btn-staff-add{
            background-color: var(--main-color-two);
        }
    </style>
@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <x-media.js :type="'web'"/>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '.edit_Staff_modal', function(e) {
                    e.preventDefault();
                    let staff_id = $(this).data('id');
                    let name = $(this).data('name');
                    // let email = $(this).data('email');
                    // let image = $(this).data('image');
                    // let image_url = $(this).data('image_url');
                    $('#staffName_up').val(name);
                    // $('#staffEmail_up').val(email);
                    // $('#image_up').val(image);
                    // $('#staff_up_image').attr("src",image_url);
                    $('#staffId').val(staff_id);
                });

                $(document).on('click', '.swal_status_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure to change status?') }}',
                        text: '{{ __('You will change it anytime!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ __('Yes, delete it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });


                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ __('Yes, delete it!') }}"
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
