@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Buyer Profile')}}
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
                        <div class="col-lg-12 margin-top-40">
                            <div class="dashboard-profile">
                                <div class="dashboard-profile-all">
                                    <div class="thumb-ad">
                                        @if(!empty(Auth::guard('web')->user()->profile_background))
                                        {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->profile_background) !!}
                                        @else
                                        <img src="{{ asset('assets/frontend/img/static/ads.jpg') }}" alt="ads">
                                        @endif
                                    </div>
                                    <div class="profile-info-dashboard margin-top-40">
                                        <div class="profile-btn-flex">
                                            <h2 class="dashboards-title"> {{ __('Profile Information') }} </h2>
                                            <div class="btn-wrapper">
                                                <a href="{{route('buyer.profile.edit')}}" class="cmn-btn btn-bg-1"> {{ __('Edit Profile') }} </a>
                                            </div>
                                        </div>
                                        <div class="dashboard-profile-detail margin-top-40">
                                            <div class="dashboard-profile-flex">
                                                <div class="thumbs">
                                                    @if(!is_null(Auth::guard('web')->user()->image))
                                                    {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
                                                    @else
                                                    <img src="{{ asset('assets/frontend/img/static/user_profile.png') }}" alt="No Image"> 
                                                    @endif
                                                </div>
                                                <div class="dashboard-address-details">
                                                    <ul class="details-list">
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Name:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->name }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Email:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->email }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Phone:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->phone }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('City:')}} </span>
                                                            <span class="list-strong"> {{ optional(optional(Auth::guard('web')->user())->city)->service_city }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Area:')}} </span>
                                                            <span class="list-strong"> {{ optional(optional(Auth::guard('web')->user())->area)->service_area }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Country:')}} </span>
                                                            <span class="list-strong"> {{ optional(optional(Auth::guard('web')->user())->country)->country }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Post Code:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->post_code }} </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('Address:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->address }} </span>
                                                        </li>
                                                    </ul>
                                                    @if(Auth::guard('web')->user()->about != NULL)
                                                    <ul class="details-list column-count-one">
                                                        <li class="lists">
                                                            <span class="list-span"> {{__('About:')}} </span>
                                                            <span class="list-strong"> {{ Auth::guard('web')->user()->about }}  </span>
                                                            <span class="para">  </span>
                                                        </li>
                                                    </ul>
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
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->
    @endsection  