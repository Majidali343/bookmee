@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Seller Profile Verify')}}
@endsection
@section('style')
<style>
    .single-dashboard-input .attachment-preview {
    width: 500px;
    height: 500px;
}
</style>
    <x-media.css/>
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
                    <div class="profile-dashboards">
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div class="edit-profile">
                                    <div class="profile-info-dashboard">
                                        <h2 class="dashboards-title"> {{__('Profile Verify')}} </h2>
                                        <div class="notice-board">
                                            <p class="text-danger">{{ __('Submit your original documents so that the admin can verify you. Once verified a badge will show in your profile that increase your order possibility') }}</p>
                                        </div>
                                            @if(!is_null($seller_verify_info) && $seller_verify_info->status === 1)
                                            <div class="alert alert-success">{{__('Profile Verified')}}</div>
                                        @else
                                        <div class="dashboard-profile-flex">
                                            <div class="dashboard-address-details">
                                            
                                                <div class="mt-5"> <x-msg.error/> </div>

                                                <form action="{{route('seller.profile.verify')}}" method="post">
                                                @csrf
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_image_markup_by_attachment_id(optional($seller_verify_info)->national_id ?? '','','large') !!}
                                                                    </div>
                                                                    <input type="hidden" id="national_id" name="national_id"
                                                                           value="{{optional($seller_verify_info)->national_id ?? ''}}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        {{__('Upload Your National ID')}}
                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                                <br>
                                                                <small class="text-danger">{{ __('recomended size 740x504') }}</small>
                                                            </div>
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_image_markup_by_attachment_id(optional($seller_verify_info)->address ?? '','','large') !!}
                                                                    </div>
                                                                    <input type="hidden" id="address" name="address"
                                                                           value="{{optional($seller_verify_info)->address ?? ''}}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        {{__('Upload Your Address Document')}}
                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small> 
                                                                <br>
                                                                <small class="text-danger">{{ __('recomended size 740x504') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="btn-wrapper margin-top-35">
                                                        <button type="submit" class="btn cmn-btn btn-bg-1">{{ __('Send Verify Request') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
    @endsection
    @section('scripts')
    <x-media.js :type="'web'"/>
    @endsection    