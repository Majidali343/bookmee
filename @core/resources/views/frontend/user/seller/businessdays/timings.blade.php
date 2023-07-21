@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Business Hours')}}
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
                                <h2 class="dashboards-title"> {{__('Business Hours')}} </h2>
                            </div>
                        </div>
                    </div>




                    <div class="btn-wrapper text-right">
                        <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addDayModal">{{ __('Add Working Hours ') }}</button>
                    </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                     
                                        <th>{{ __('Day') }}</th>
                                        <th>{{ __('From') }}</th>
                                        <th>{{ __('To') }}</th>
                                        <th>{{ __('Edit') }}</th>
                                        <th>{{ __('Delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->day}}</td>
                                        <td>{{$item->to_time}}</td>
                                        <td>{{$item->from_time}}</td>
                                        <td >
                                        <a href="#0" class="edit_schedule_modal"
                                        data-toggle="modal" 
                                        data-target="#editDayModal"
                                        data-id="{{ $item->id }}"
                                        data-day="{{ $item->day }}"
                                        data-to="{{ $item->to_time }}"
                                        data-from="{{ $item->from_time }}"
                                        >
                                        <span class="dash-icon dash-edit-icon color-1" style="color:#03989E"> <i class="las la-edit" ></i> </span>
                                     </a>
                                        <td>
                                            <div class="dashboard-switch-single">
                                               <x-seller-delete-popup :url="route('timedelete',$item->id)"/>
                                            </div>
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
 

     
       <!-- Edit Modal -->
    <div class="modal fade" id="editDayModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <form action="{{ route('timeedit') }}" method="post">
            <input type="hidden" id="edit_id" name="up_id" >
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Edit Schedule') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="up_day_id">{{ __('Select Day') }}</label>
                            <select name="eday" id="eup_day_id" class="form-control nice-select" required>
                                <option value="">{{ __('Select Day') }}</option>
                                <option value="Monday" >{{ __('Monday') }}</option>
                                <option value="Tuesday">{{ __('Tuesday') }}</option>
                                <option value="Wednesday">{{ __('Wednesday') }}</option>
                                <option value="Thursday">{{ __('Thursday') }}</option>
                                <option value="Friday">{{ __('Friday') }}</option>
                                <option value="Saturday">{{ __('Saturday') }}</option>
                                <option value="Sunday">{{ __('Sunday') }}</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="schedule">{{ __('Opening Time') }}</label>
                            <input type="text" name="eopening_time" id="eschedule" class="form-control" placeholder="{{__('Opening Time')}}" required>
                            <span class="info">{{__('eg: 8:00Am ,11:00Am, The opening time will let the Customers know when You start Busniess on particular day')}}</span>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="schedule">{{ __('Closing Time ') }}</label>
                            <input type="text" name="eclosing_time" id="ecschedule" class="form-control" placeholder="{{__('Closing Time')}}" required>
                            <span class="info">{{__('eg: 6:00PM , 12:00PM, The Closing time will let the Customers know when You Close Business on particular day')}}</span>
                        </div>

                    {{-- i will write logic here --}}

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Update Timings') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="dayModal" aria-hidden="true">
        
    <form action="{{ route('addtimings') }}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="dayModal">{{ __('Edit Working Hours') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="up_day_id">{{ __('Select Day') }}</label>
                        <select name="day" id="up_day_id" class="form-control nice-select" required>
                            <option value="">{{ __('Select Day') }}</option>
                            <option value="Monday" >{{ __('Monday') }}</option>
                            <option value="Tuesday">{{ __('Tuesday') }}</option>
                            <option value="Wednesday">{{ __('Wednesday') }}</option>
                            <option value="Thursday">{{ __('Thursday') }}</option>
                            <option value="Friday">{{ __('Friday') }}</option>
                            <option value="Saturday">{{ __('Saturday') }}</option>
                            <option value="Sunday">{{ __('Sunday') }}</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="schedule">{{ __('Opening Time') }}</label>
                        <input type="text" name="opening_time" id="schedule" class="form-control" placeholder="{{__('Opening Time')}}" required>
                        <span class="info">{{__('eg: 8:00Am ,11:00Am, The opening time will let the Customers know when You start Busniess on particular day')}}</span>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="schedule">{{ __('Closing Time ') }}</label>
                        <input type="text" name="closing_time" id="schedule" class="form-control" placeholder="{{__('Closing Time')}}" required>
                        <span class="info">{{__('eg: 6:00PM , 12:00PM, The Closing time will let the Customers know when You Close Business on particular day')}}</span>
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

                $(document).on('click','.edit_schedule_modal',function(e){
                    e.preventDefault();
                    let edit_id = $(this).data('id');
                    let eday = $(this).data('day');
                    let day_to = $(this).data('to');
                    let day_from = $(this).data('from');

                    console.log(edit_id + eday+day_to + day_from);

                    $('#edit_id').val(edit_id);
                    $('#eup_day_id').val(eday);
                    $('#eschedule').val(day_to);
                    $('#ecschedule').val(day_from);

                    // $('.nice-select').niceSelect('update');
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
                        confirmButtonText: "{{__('Yes, delete it!')}}"
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