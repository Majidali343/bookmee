@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Seller Account Settings')}}
@endsection
@section('style')
    <style>
        .btn-bg-4{
            background-color: #E80000FF !important;
            color: #f0f0f0;
        }
    </style>
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
                                <h2 class="dashboards-title"> {{__('Account Settings')}} </h2>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4"> <x-msg.error/> </div>
                    
                    <div class="row align-items-center">
                        <div class="col-lg-6 margin-top-30">

                            <form action="{{route('seller.account.settings')}}" method="post">
                                @csrf
                                <div class="single-settings">
                                    <h4 class="input-title"> {{__('Change Password')}} </h4>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> {{__('Current Password*')}} </label>
                                            <input class="form--control" type="password" name="current_password" id="current_password" placeholder="{{__('Current Password')}}">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> {{__('New Password*')}} </label>
                                            <input class="form--control" type="password" name="new_password" id="new_password" placeholder="{{__('New Password')}}">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> {{__('Re-Type Password*')}} </label>
                                            <input class="form--control" type="password" name="confirm_password" id="confirm_password" placeholder="{{__('Retype Password')}}">
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-40">
                                        <button class="cmn-button btn-bg-1" type="submit"> {{__('Update Password')}} </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if(empty($user))
                            <div class="col-lg-6 margin-top-30">
                                <form action="{{route('seller.account.deactive')}}" method="post">
                                    @csrf
                                    <div class="single-settings">
                                        <h4 class="input-title"> {{__('Deactivate or Delete Account')}} </h4>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> {{__('Choose Reason*')}} </label>
                                                <select name="reason" id="reason" class="delete_reason_title">
                                                    <option value="For Vacation">{{__('For Vacation')}}</option>
                                                    <option value="Personal Reasons">{{__('Personal Reasons')}}</option>
                                                    <option value="Others">{{__('Others')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> {{__('Short Description*')}} </label>
                                                <textarea class="form--control textarea--form account_detactive_description pass_description_data" name="description" id="description" placeholder="{{__('Describe Your Reason')}}"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-wrapper margin-top-40">
                                                    <button class="cmn-button btn-bg-3" type="submit"> {{__('Deactivate Account')}} </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="btn-wrapper margin-top-40">
                                                    <button type="button" class="cmn-button btn-bg-4" data-toggle="modal" data-target="#accountDeleteModal">
                                                        {{__('Delete Account')}}
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            @endif

                        @if(!empty($user))
                        @if($user->status === 0)
                            <div class="col-lg-6 margin-top-30 text-lg-center text-left">
                                <a  class="cmn-button btn-bg-3" href="{{route('seller.account.deactive.cancel',$user->user_id)}}"> {{__('Activate Your Account')}}</a> <br>
                                <small>{{ __('Currently your account is deactivated. You can activate from here. ') }}</small>
                            </div>
                        @else($user->status === 1)
                        <div class="col-lg-6 margin-top-30 text-lg-center text-left">
                                <a  class="cmn-button btn-bg-4" href="#" > {{__('Already Delete Account')}}</a> <br>
                                <small>{{ __('Your account has been deleted') }}</small>
                            </div>
                        @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- Account Delete Modal -->
    <div class="modal fade" id="accountDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('seller.account.delete') }}" method="post">
            @csrf
            <input type="hidden" name="description"  class="delete_desc" id="delete_desc">
            <input type="hidden" name="reason"  class="choose_delete_reason_title" id="choose_delete_reason_title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Account') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <h4 class="text-danger text-center"><b>{{ __('Are You sure?') }}</b></h4>
                      <h4 class="text-danger text-center">{{ __('Delete Your Account!') }}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection

@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        // Account Delete Description
        $(document).on('keyup','.pass_description_data',function(){
            let delete_info = $(this).val();
            $('#delete_desc').val(delete_info);
        });
        // Account Delete reason title
        $(document).on('change','.delete_reason_title',function(){
            let reason_title = $(this).val();
            $('#choose_delete_reason_title').val(reason_title);

        });
    </script>
@endsection