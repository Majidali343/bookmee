@extends('backend.admin-master')
@section('style')
    <x-datatable.css/>
@endsection

@section('site-title')
    {{__('All Deactive Users')}}
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
                                    <h4 class="header-title">{{__('Deactivated Users')}}</h4>
                                    <small>{{ __('User list who deactivated their account from frontend.') }}</small> <br><br>
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
                                                <th>{{__('Email')}}</th>
                                                <th>{{__('Reason')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Description')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_user as $data)
                                                <tr>
                                                    <td><x-bulk-delete-checkbox :id="$data->id"/></td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{optional($data->user)->name}}</td>
                                                    <td>{{optional($data->user)->email}}</td>
                                                    <td>{{$data->reason}}</td>
                                                    <td>
                                                        @if($data->status == 0)
                                                          <span class="btn btn-warning">{{ __('Deactivated') }}</span>
                                                        @endif
                                                        @if($data->account_status == 1)
                                                          <span class="btn btn-danger">{{ __('Deleted') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$data->description}}</td>
                                                        <td>  <x-admin-delete-user-account :url="route('admin.frontend.user.delete',$data->user_id )"/> </td>
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

@endsection

@section('script')
    <x-datatable.js/>
    <script>
        (function($){
            "use strict";
            $(document).ready(function() {

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure? permanently delete user account!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes')}}",
                        cancelButtonText: "{{__('cancel')}}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.admin_delete_account_swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endsection
