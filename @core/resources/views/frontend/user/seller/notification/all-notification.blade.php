@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('All Notifications')}}
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
                                <h2 class="dashboards-title"> {{__('All Notification')}} </h2>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::guard('web')->user()->notifications()->paginate(20) as $key=>$notification)
                                    @if(isset($notification->data['order_id']))
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <a class="list-order" href="{{ route('seller.order.details',$notification->data['order_id']) }}">
                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                {{ __($notification->data['order_message']) }} #{{ $notification->data['order_id'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="pagination-wrapper">
                            {{Auth::guard('web')->user()->notifications()->paginate(20)->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

            });
            
        })(jQuery);
    </script>
@endsection