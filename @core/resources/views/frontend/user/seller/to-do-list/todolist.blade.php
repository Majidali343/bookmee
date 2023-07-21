@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('To Do List')}}
@endsection
@section('content')
  
    <x-frontend.seller-buyer-preloader/>

    <!-- Dashboard area Starts -->

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
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{__('To Do List')}} </h2>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrapper margin-top-50 text-right">
                        <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addTodoModal">{{ __('Add Todo List') }}</button>
                    </div>
                    
                    <div class="mt-5"> <x-msg.error/> </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($to_do_list as $key=>$data)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>
                                            @if($data->status==1) 
                                            <span class="text-success">{{ __('Completed') }}</span>
                                            @else 
                                            <span class="text-danger">{{ __('In Completed') }}</span>
                                            @endif
                                            <x-seller-coupon-status :url="route('seller.todolist.status',$data->id)"/>
                                        </td>
                                        <td width="50%">{{ $data->description }}</td>
                                        <td>
                                            <div class="dashboard-switch-single">
                                               <a href="#0" class="edit_todo_modal" 
                                               data-toggle="modal" 
                                               data-target="#editTodoModal"
                                               data-id="{{ $data->id }}"
                                               data-title="{{ $data->title }}"
                                               data-description="{{ $data->description }}"
                                               >
                                               <span class="dash-icon dash-edit-icon color-1"> <i class="las la-edit"></i> </span>
                                            </a>
                                               <x-seller-delete-popup :url="route('seller.todolist.delete',$data->id)"/>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            {!! $to_do_list->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <!-- Add Modal -->
    <div class="modal fade" id="addTodoModal" tabindex="-1" role="dialog" aria-labelledby="couponModal" aria-hidden="true">
        <form action="{{ route('seller.todolist.add') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="couponModal">{{ __('Add New Todo List') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" cols="20" rows="7"></textarea>
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


    
    <!-- Edit Modal -->
    <div class="modal fade" id="editTodoModal" tabindex="-1" role="dialog" aria-labelledby="editTodoModal" aria-hidden="true">
        <form action="{{ route('seller.todolist.update') }}" method="post">
            <input type="hidden" id="up_id" name="up_id" >
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTodoModal">{{ __('Edit Todo') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="up_title">{{ __('Coupon Code') }}</label>
                            <input type="text" name="up_title" id="up_title" class="form-control" placeholder="{{ __('Title') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_description">{{ __('Description') }}</label>
                            <textarea name="up_description" id="up_description" class="form-control" cols="20" rows="7"></textarea>
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

    @endsection  


@section('scripts')
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.edit_todo_modal',function(e){
                    e.preventDefault();
                    let todo_id = $(this).data('id');
                    let title = $(this).data('title');
                    let description = $(this).data('description');

                    $('#up_id').val(todo_id);
                    $('#up_title').val(title);
                    $('#up_description').val(description);
                });


                $(document).on('click','.swal_status_button',function(e){
                    e.preventDefault();
                        Swal.fire({
                        title: '{{__("Are you sure to change status?")}}',
                        text: '{{__("You will change it anytime!")}}',
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


                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                        Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
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