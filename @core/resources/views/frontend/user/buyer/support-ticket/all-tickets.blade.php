@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('All Tickets')}}
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
                @include('frontend.user.buyer.partials.sidebar')

                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title"> {{__('All Tickets')}} </h2>
                                </div>
                            </div>
                        </div>

                        <div class="btn-wrapper margin-top-50 text-right">
                            <a href="#" class="cmn-btn btn-bg-1" data-toggle="modal"
                               data-target="#ticketModal" > {{__('Create Ticket For A Order' )}}</a>
                        </div>

                        @if($tickets->count() >= 1)
                        <div class="dashboard-service-single-item border-1 margin-top-40">
                            <div class="rows dash-single-inner">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Priority') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $key=>$data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{__('Order Id')}} #{{ $data->order_id }}, {{ $data->title }}</td>
                                            <td>
                                                @if($data->priority=='low')<span class="btn btn-primary btn-bg-1">{{ __(ucfirst($data->priority)) }}</span>@endif
                                                @if($data->priority=='high')<span class="btn btn-warning btn-bg-1">{{ __(ucfirst($data->priority)) }}</span>@endif
                                                @if($data->priority=='medium')<span class="btn btn-info btn-bg-1">{{ __(ucfirst($data->priority)) }}</span>@endif
                                                @if($data->priority=='urgent')<span class="btn btn-danger btn-bg-1">{{ __(ucfirst($data->priority)) }}</span>@endif
                                            </td>
                                            <td>
                                                @if($data->status=='open')
                                                    <span class="btn btn-primary btn-bg-1">{{ __(ucfirst($data->status)) }}</span>
                                                    <x-seller-coupon-status :url="route('buyer.support.ticket.status.change',$data->id)"/>
                                                @else
                                                   <span class="btn btn-danger btn-bg-1">{{ __(ucfirst($data->status)) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                <x-seller-delete-popup :url="route('buyer.support.ticket.delete',$data->id)"/>
                                                    <a href="{{ route('buyer.support.ticket.view', $data->id) }}">
                                                        <span class="icon dash-icon dash-eye-icon eye-icon" data-toggle="tooltip" data-placement="top" title="{{ __('View Details') }}">
                                                            <i class="las la-eye"></i>
                                                        </span>
                                                    </a>
                                                    <a href="#0" class="edit_priority_modal" 
                                                    data-toggle="modal"
                                                    data-target="#editPriorityModal" 
                                                    data-id="{{ $data->id }}"
                                                    data-priority="{{ $data->priority }}"
                                                    >
                                                    <span class="dash-icon dash-edit-icon color-1" data-toggle="tooltip" data-placement="top" title="{{ __('Change Priority') }}">
                                                        <i class="las la-edit"></i>
                                                    </span>
                                                </a>
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
                                {!! $tickets->links() !!}
                            </div>
                        </div>
                        @else
                            <h2 class="no_data_found">{{ __('No Tickets Found') }}</h2>
                        @endif
                    </div>
            </div>
        </div>
    </div>


     <!--priority Modal -->
     <div class="modal fade" id="editPriorityModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
     aria-hidden="true">
     <form action="{{ route('buyer.support.ticket.priority.change') }}" method="post">
         <input type="hidden" id="ticket_id" name="ticket_id">
         @csrf
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="editModal">{{ __('Change Priority') }}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                     <div class="form-group">
                         <label for="up_day_id">{{ __('Select Status') }}</label>
                         <select name="priority" id="priority" class="form-control nice-select">
                            <option value="low">{{__('Low')}}</option>
                            <option value="medium">{{__('Medium')}}</option>
                            <option value="high">{{__('High')}}</option>
                            <option value="urgent">{{__('Urgent')}}</option>
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
 
   <!--ticket api -->
    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="{{ route('buyer.support.ticket.new') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">{{ __('Create Ticket') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="single-dashboard-input">
                            <div class="single-info-input">
                                <label for="title" class="info-title"> {{__('Title*')}} </label>
                                <input class="form--control" name="title" id="title" value="{{ @old('title') }}" type="text" placeholder="{{__('Add tilte')}}">
                            </div>
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="subject" class="info-title"> {{__('Subject*')}} </label>
                                <input class="form--control" name="subject" id="subject" value="{{ @old('subject') }}" type="text" placeholder="{{__('Add Subject')}}">
                            </div>
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Select Order')}} </label>
                                <select name="order_id">
                                    <option value="">{{__('Select Order')}}</option>
                                    @foreach($orders as $order)
                                      <option value="{{ $order->id }}">{{ __('Order ID#') }} {{ $order->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> {{__('Priority*')}} </label>
                                <select name="priority" id="priority">
                                    <option value="low">{{__('Low')}}</option>
                                    <option value="medium">{{__('Medium')}}</option>
                                    <option value="high">{{__('High')}}</option>
                                    <option value="urgent">{{__('Urgent')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="description" class="info-title"> {{__('Description*')}} </label>
                                <textarea class="form--control textarea--form" name="description" placeholder="{{__('Type Description')}}"></textarea>
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
    @endsection  


@section('scripts')
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

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

                $(document).on('click','.swal_status_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to close status?")}}',
                        text: '{{__("You will not able to open it!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, change it!')}}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.edit_priority_modal', function(e) {
                    e.preventDefault();
                    let ticket_id = $(this).data('id');
                    let priority = $(this).data('priority');

                    $('#ticket_id').val(ticket_id);
                    $('#priority').val(priority);
                    $('.nice-select').niceSelect('update');
                });

            });

        })(jQuery);
    </script>
@endsection