@extends('backend.admin-master')
@section('style')
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <x-media.css/>
    <x-datatable.css/>
    <style>
        #edit_user_info_modal .modal-body {
            max-height: calc(100vh -  150px);
            overflow-y: auto;
        }
    </style>
@endsection

@section('site-title')
    {{__('All Users')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                  <x-msg.success/>
                                  <x-msg.error/>
                                    <h4 class="header-title">{{__('All Users')}}</h4>
                                    @can('user-delete')
                                       <x-bulk-action/>
                                    @endcan
                                    <div class="data-tables datatable-primary table-wrap">
                                        <table class="text-center">
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('User Status')}}</th>
                                                <th>{{__('User Verified')}}</th>
                                                <th>{{__('Email Verify')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('newsletter-send-mail')
    <div class="modal fade" id="send_mail_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Send Mail To User')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.frontend.user.email.send.single') }}" id="send_mail_modal_form"  method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input type="text" readonly class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon">{{__('Subject')}}</label>
                            <input type="text" class="form-control"  id="subject" name="subject" placeholder="{{__('Subject')}}">
                        </div>
                        <div class="form-group">
                            <label for="message">{{__('Message')}}</label>
                            <input type="hidden" name="message" >
                            <div class="summernote"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button id="submit" type="submit" class="btn btn-primary">{{__('Send Mail')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

   <div class="modal fade" id="change_password_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Change User Password')}}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.frontend.user.password') }}" id="change_password_modal_form"  method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="text" readonly class="form-control"  id="user_new_password_email" name="user_new_password_email" placeholder="{{__('Email')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_icon">{{__('New Password')}}</label>
                                <input type="text" class="form-control"  id="user_new_password" name="user_new_password" placeholder="{{__('New Password')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <button id="submit" type="submit" class="btn btn-primary">{{__('Save & Send Mail')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <div class="modal fade" id="edit_user_info_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit User Info')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{ route('admin.user.info.update') }}" id="user_info_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="edit_email">{{__('Email')}}</label>
                            <input type="text" readonly class="form-control"  id="edit_email" name="edit_email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_username">{{__('Username')}}</label>
                            <input type="text" readonly class="form-control"  id="edit_username" name="edit_username" placeholder="{{__('username')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_name">{{__('Full Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name" name="edit_name" placeholder="{{__('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">{{__('Phone')}}</label>
                            <input type="text" class="form-control"  id="edit_phone" name="edit_phone" placeholder="{{__('phone')}}">
                            <small>{{ __('Please enter country code') }}</small>
                        </div>
                        <div class="form-group country-wrapper">
                            <label class="forms-label"> {{ __('Service Country*') }} </label>
                            <select name="edit_country" id="edit_country" class="form-control">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group service_city_wrapper">
                            <label class="forms-label"> {{ __('Service City*') }} </label>
                            <select name="edit_city" id="edit_city" class="get_service_city form-control">
                                <option value="">{{ __('Select City') }}</option>

                            </select>
                        </div>
                        <div class="form-group service_area_wrapper">
                            <label class="forms-label"> {{ __('Service Area*') }} </label>
                            <select name="edit_area" id="edit_area" class="get_service_area form-control">
                                <option value="">{{ __('Select Area') }}</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_username">{{__('Address')}}</label>
                            <textarea name="edit_address" id="edit_address" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="edit_image">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="{{__('Select Image')}}"
                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                        data-target="#media_upload_modal">
                                    {{__('Upload Profile Image')}}
                                </button>
                            </div>
                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button id="submit" type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<x-media.markup/>
@endsection

@section('script')

    <x-datatable.js nojs="true"/>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>

    <script>
        (function($){
        "use strict";
        $(document).ready(function() {


            $('.table-wrap > table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("admin.all.frontend.user")}}",
                columns: [
                    {data: 'checkbox', name: '', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'user_status', name: '', orderable: false},
                    {data: 'user_verify', name: ''},
                    {data: 'email_verify', name: '',orderable: false},
                    {data: 'action', name: '', orderable: false, searchable: false},
                ]
            });

            
            $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('Yes, change it!')}}",
                    cancelButtonText: "{{__('cancel')}}"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            });

            $(document).on('click','.edit_user_info_btn',function(){
                let el = $(this);
                let email = el.data('email');
                let username = el.data('username');
                let name = el.data('name');
                let phone = el.data('phone');
                let country = el.data('country');
                let city = el.data('city');
                let area = el.data('area');
                let address = el.data('address');

                let form = $('#user_info_modal_form');
                form.find('#edit_email').val(email);
                form.find('#edit_username').val(username);
                form.find('#edit_name').val(name);
                form.find('#edit_phone').val(phone);
                form.find('#edit_country').val(country);
                form.find('#edit_city').val(city);
                form.find('#edit_area').val(area);
                form.find('#edit_address').val(address);

                var image = el.data('image');
                var imageid = el.data('imageid');

                if (imageid != '') {
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered">' +
                        '<img class="avatar user-thumb" src="' + image + '" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
            });

            // change country and get city
            $('#edit_country').on('change', function() {
                var country_id = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('admin.user.country.city') }}",
                    data: {
                        country_id: country_id
                    },
                     success: function(res) {
                        if (res.status == 'success') {
                            var alloptions = "<option value=''>{{__('Select City')}}</option>";
                            var allCity = res.cities;
                            $.each(allCity, function(index, value) {
                                alloptions += "<option value='" + value.id +
                                    "'>" + value.service_city + "</option>";
                            });
                            $(".get_service_city").html(alloptions);
                        }
                    }
                })
            })

            // select city and area
             $('#edit_city').on('change', function() {
                 var city_id = $(this).val();
                 $.ajax({
                     method: 'post',
                     url: "{{ route('admin.user.city.area') }}",
                     data: {
                         city_id: city_id
                     },
                     success: function(res) {
                         if (res.status == 'success') {
                             var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                             var allArea = res.areas;
                             $.each(allArea, function(index, value) {
                                 alloptions += "<option value='" + value.id +
                                     "'>" + value.service_area + "</option>";
                             });
                             $(".get_service_area").html(alloptions);
                         }
                     }
                 })
             })

            $(document).on('click','.change_password_modal_btn',function(){
                let el = $(this);
                let email = el.data('email');
                let form = $('#change_password_modal');
                form.find('#user_new_password_email').val(email);
            });

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();
                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.all.frontend.user.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $(document).on('click','.send_mail_modal_btn',function(){
                    var el = $(this);
                    var email = el.data('email');
                    var form = $('#send_mail_modal_form');
                    form.find('#email').val(email);
                });

            $('.summernote').summernote({
                height: 300,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

        });
        <x-btn.update/>
    })(jQuery);
        
    </script>
    <x-media.js/>
@endsection
