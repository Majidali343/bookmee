@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Days')}}
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
                                <h2 class="dashboards-title"> {{__('All Days')}} </h2>
                            </div>
                        </div>
                    </div>
                    <div class="total_service_day_count mt-4 mt-lg-5">
                        <form class="total_service_day" action="{{ route('seller.update.totalday') }}" method="post">
                            @csrf
                            <div class="form_service_day">
                                <label class="total_day_label"> {{ __('Select Service Day') }} </label>
                                <select name="total_day">
                                @if(empty($total_day)) 
                                    @for($i=1; $i<=30; $i++){ 
                                    <option value="{{ $i }}">{{ $i }} {{ __('Day') }}</option>
                                    }
                                    @endfor
                                @else
                                    @for($i=1; $i<=30; $i++){
                                    <option value="{{ $i }}" @if($total_day->total_day==$i) selected @endif>{{ $i }} {{ __('Day') }}</option>
                                    }
                                    @endfor
                                @endif
                                </select>
                            </div>
                            <div class="btn-wrapper mt-4">
                                <button type="submit" class="cmn-btn btn-bg-1">{{ __('Update') }}</button>
                            </div>
                        </form>
                        <div class="btn-wrapper text-right">
                            <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addDayModal">{{ __('Add New Service Day') }}</button>
                        </div>
                    </div>
                    <div class="notice-board">
                        <p style="text-align:left;" style="color:black">{{ __('selected days will show while booking an order') }}</p>
                    </div>

                    <div class="mt-5"> <x-msg.error/> </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Day') }}</th>
                                        <th>{{ __('Schedule') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ __($data->day) }}</td>
                                        <td>
                                            @if(isset($data['schedules']) && $data->schedules->count())
                                                @foreach($data['schedules'] as $schedule)
                                                <span class="btn btn-sm btn-success day_wise_service_schedule">{{ $schedule->schedule }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dashboard-switch-single">
                                               <x-seller-delete-popup :url="route('seller.day.delete',$data->id)"/>
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

    
    <!-- Add Modal -->
    <div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="dayModal" aria-hidden="true">
        <form action="{{ route('seller.add.day') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="dayModal">{{ __('Add New Day') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="day">{{ __('Day') }}</label>
                            <select name="day" id="day" class="form-control">
                                <option value="">{{ __('Select Day') }}</option>
                                <option value="Sat">{{ __('Saturday') }}</option>
                                <option value="Sun">{{ __('Sunday') }}</option>
                                <option value="Mon">{{ __('Monday') }}</option>
                                <option value="Tue">{{ __('Tuesday') }}</option>
                                <option value="Wed">{{ __('Wednesday') }}</option>
                                <option value="Thu">{{ __('Thursday') }}</option>
                                <option value="Fri">{{ __('Friday') }}</option>
                            </select>
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

                $(document).on('click','.edit_date_modal',function(e){
                    e.preventDefault();
                    let date_id = $(this).data('id');
                    let date = $(this).data('date');
                    $('#up_id').val(date_id)
                    $('#up_date').val(date)
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