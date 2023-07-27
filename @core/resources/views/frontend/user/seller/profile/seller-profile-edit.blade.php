@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Edit Seller Profile')}}
@endsection
@section('style')
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
                                        <h2 class="dashboards-title"> {{__('Edit Profile')}} </h2>
                                        <div class="dashboard-profile-flex">
                                            <div class="thumbs margin-top-40">
                                                {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
                                                <div class="edit-thumb">
                                                    <a href="javascript:void(0)"> <i class="lar la-image"></i> </a>
                                                </div>
                                            </div>
                                            <div class="dashboard-address-details">
                                                
                                                <div class="mt-5"> <x-msg.error/> </div>

                                                <form action="{{route('seller.profile.edit')}}" method="post">
                                                @csrf
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Your Name*')}} </label>
                                                            <input class="form--control" type="text" name="name" value="{{Auth::guard('web')->user()->name}}" placeholder="{{__('Type Your Name')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Your Email*')}} </label>
                                                            <input class="form--control" type="email" name="email"  value="{{Auth::guard('web')->user()->email}}"  placeholder="{{__('Type Your Email')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30 country-wrapper">
                                                            <label class="info-title"> {{__('Country*')}} </label>
                                                            <select name="country" id="country">
                                                                @if(!empty($countries))
                                                                    @foreach($countries as $country)
                                                                       <option value="{{ $country->id }}" @if($country->id==Auth::guard('web')->user()->country_id) selected @endif>{{ $country->country }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="single-info-input margin-top-30 service_city_wrapper">
                                                            <label class="info-title"> {{__('Service City*')}} </label>
                                                            <select name="service_city" id="service_city">

                                                                @foreach($cities as $city)
                                                                    <option value="{{ $city->id }}" @if(Auth::guard('web')->user()->service_city == $city->id) selected @endif>{{ $city->service_city  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        {{-- <div class="single-info-input margin-top-30 service_area_wrapper">
                                                            <label class="info-title"> {{__('Service Area*')}} </label>
                                                            <select name="service_area" id="service_area" class="get_service_city">
                                                                @foreach($areas as $area)
                                                                    <option value="{{ $area->id }}" @if(Auth::guard('web')->user()->service_area == $area->id) selected @endif>{{ $area->service_area  }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{ __('Phone Number*') }} </label>
                                                            <input class="form--control" type="text" name="phone" value="{{Auth::guard('web')->user()->phone}}" placeholder="{{__('Type Your Number')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Post Code')}} </label>
                                                            <input class="form--control" type="text" name="post_code" value="{{Auth::guard('web')->user()->post_code}}" placeholder="{{__('Type Post Code')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Your Address*')}} </label>
                                                            <input class="form--control" type="text" name="address" value="{{Auth::guard('web')->user()->address}}" placeholder="{{__('Type Your Address')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('About')}} </label>
                                                            <textarea class="form--control textarea--form" name="about" placeholder="Type Note">{{Auth::guard('web')->user()->about}}</textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Social Link --}}
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Facebook Link')}} </label>
                                                            <input class="form--control" type="text" name="fb_url" value="{{Auth::guard('web')->user()->fb_url}}" placeholder="{{__('Type Your Facebook Link')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Twitter Link')}} </label>
                                                            <input class="form--control" type="text" name="tw_url"  value="{{Auth::guard('web')->user()->tw_url}}"  placeholder="{{__('Type Your Twiter Link')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Google Link')}} </label>
                                                            <input class="form--control" type="text" name="go_url" value="{{Auth::guard('web')->user()->go_url}}" placeholder="{{__('Type Your Google Link')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Youtube Link')}} </label>
                                                            <input class="form--control" type="text" name="yo_url"  value="{{Auth::guard('web')->user()->yo_url}}"  placeholder="{{__('Type Your Youtube Link')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Linkedin Link')}} </label>
                                                            <input class="form--control" type="text" name="li_url" value="{{Auth::guard('web')->user()->li_url}}" placeholder="{{__('Type Your Linkedin Link')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Instragram Link')}} </label>
                                                            <input class="form--control" type="text" name="in_url"  value="{{Auth::guard('web')->user()->in_url}}"  placeholder="{{__('Type Your Instragram Link')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Dribble  Link')}} </label>
                                                            <input class="form--control" type="text" name="dr_url" value="{{Auth::guard('web')->user()->dr_url}}" placeholder="{{__('Type Your Dribble Link')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Twitch Link')}} </label>
                                                            <input class="form--control" type="text" name="twi_url"  value="{{Auth::guard('web')->user()->twi_url}}"  placeholder="{{__('Type Your Twitch Link')}}">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Pinterest  Link')}} </label>
                                                            <input class="form--control" type="text" name="pi_url" value="{{Auth::guard('web')->user()->pi_url}}" placeholder="{{__('Type Your Pinterest Link')}}">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> {{__('Reddit Link')}} </label>
                                                            <input class="form--control" type="text" name="re_url"  value="{{Auth::guard('web')->user()->re_url}}"  placeholder="{{__('Type Your Reddit Link')}}">
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image,'','thumb') !!}
                                                                    </div>
                                                                    <input type="hidden" id="image" name="image"
                                                                           value="{{Auth::guard('web')->user()->image}}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        {{__('Upload Profile Image')}}
                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger">{{ __('recomended size 500x443') }}</small>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->profile_background) !!}
                                                                    </div>
                                                                    <input type="hidden" id="profile_background" name="profile_background"
                                                                           value="{{Auth::guard('web')->user()->profile_background}}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        {{__('Upload Background Image')}}
                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="media-upload-btn-wrapper">
                                                            <div class="img-wrap">
                                                                {!! render_gallery_image_attachment_preview(Auth::guard('web')->user()->profile_gallery ?? '') !!}
                                                            </div>
                                                            <input type="hidden" name="image_gallery">
                                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                                    data-btntitle="{{__('Select Image')}}"
                                                                    data-modaltitle="{{__('Upload Image')}}"
                                                                    data-toggle="modal"
                                                                    data-mulitple="true"
                                                                    data-target="#media_upload_modal">
                                                                {{__('Upload Gallery Image')}}
                                                            </button>
                                                            <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                                            <small>{{ __('recommended size 1920x1280') }}</small>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger">{{ __('recomended size 1394x315') }}</small>
                                                    <div class="btn-wrapper margin-top-35">
                                                        <button type="submit" class="btn cmn-btn btn-bg-1">{{ __('Save Changes') }}</button>
                                                    </div>
                                                </form>
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
    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
    @endsection
    @section('scripts')
    <x-media.js :type="'web'"/>
    <script type="text/javascript">
        (function() {
            "use strict";
            $(document).ready(function() {
                $('.select_activation').select2();

                // change country and get city
                $(document).on('change','#country' ,function() {
                    let country_id = $("#country").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city").html(alloptions);
                                $("#service_city").parent().find(".current").html("{{__('Select City')}}");
                                $("#service_city").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                                $(".service_area_wrapper .list").html("");
                            }
                        }
                    })
                })

                // select city and area
                $(document).on('change','#service_city', function() {
                    var city_id = $("#service_city").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Area')}}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                            }
                        }
                    })
                })

            });
        })(jQuery);
       </script>


    @endsection    