@extends('backend.admin-master')
@section('style')
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <x-media.css/>
    <x-datatable.css/>
@endsection

@section('site-title')
    {{__('All Seller')}}
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
                                    <h4 class="header-title">{{__('All Seller')}}</h4>
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
                                                <th>{{__('User Type')}}</th>
                                                <th>{{__('User Status')}}</th>
                                                <th>{{__('User Verified')}}</th>
                                                <th>{{__('Email')}}</th>
                                                <th>{{__('Username')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($all_user as $data)
                                                <tr>
                                                    <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>
                                                        @if($data->user_type==0)
                                                            <span class="text-danger">{{ __('Seller') }}</span>
                                                        @else
                                                            <span class="text-success">{{ __('Buyer') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->user_status==0)
                                                            <span class="text-warning">{{ __('Inactive') }}</span>
                                                        @else
                                                            <span class="text-info">{{ __('Active') }}</span>
                                                        @endif
                                                        <x-status-change :url="route('admin.frontend.user.status',$data->id)"/>
                                                    </td>
                                                    <td>
                                                        @if($data->user_type==0)
                                                            @if(optional($data->sellerVerify)->status==1)
                                                                <span class="text-warning">{{ __('Verified') }}</span>
                                                            @else
                                                                <span class="text-info">{{ __('Not Verified') }}</span>
                                                            @endif
                                                            <a class="btn btn-info" href="{{ route('admin.frontend.seller.profile.view',$data->id) }}"><i class="ti-eye"></i></a>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if($data->email_verified == 1)
                                                            {{$data->email}}
                                                        @else
                                                            {{$data->email}}
                                                            <i class="fas fa-times-circle text-danger"></i>
                                                            <a href="{{ route('admin.frontend.user.email.verify.code',$data->id) }}"
                                                               class="btn btn-primary btn-sm mb-3 mr-1 mt-3 subcategory_edit_btn">{{ __('Send Code ')}}</a>
                                                            <x-status-change :url="route('admin.frontend.seller.email.verify',$data->id)"/>
                                                        @endif
                                                    </td>
                                                    <td>{{$data->username}}</td>
                                                    <td>
                                                        @can('user-delete')
                                                            <x-delete-popover :url="route('admin.frontend.user.delete',$data->id)"/>
                                                        @endcan
                                                        @can('email-verify-code')
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#send_mail_modal"
                                                               class="btn btn-primary btn-xs mb-3 mr-1 send_mail_modal_btn"
                                                               data-id="{{$data->id}}"
                                                               data-email="{{$data->email}}">
                                                                {{ __('Send Email') }}
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

    <x-media.markup/>
@endsection

@section('script')

    <x-datatable.js/>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>

    <script>
        (function($){
            "use strict";
            $(document).ready(function() {

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
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <x-media.js/>
@endsection
