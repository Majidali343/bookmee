@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Edit Service Attributes')}}
@endsection

@section('style')
    <x-media.css/>
    <style>
         .serviceopt input {
        width: 200;
        height: 50px;
        top: 30.5px;
        padding: 0px 9.600006103515625px 0px 21.330078125px;
        border-radius: 5px;
        border: 1px solid #DDDDDD;

    }
    .serviceopt p ,label {
        font-family: Inter;
        font-size: 14px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;

    }
    .serviceopt h5 {
        font-family: Poppins;
        font-size: 24px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;

    }
    .serviceopt button {
        width: 235.42px;
        height: 54px;
        color: white;
        top: 79px;
        left: 436px;
        padding: 9.65999984741211px 35.41999816894531px 10.34000015258789px 34px;
        border-radius: 5px;
        background: #03989E;;

    }
          /* Customize the label (the container) */
   .checkbox-list {
      list-style-type: none;
      padding: 0;
      
    }
    
    /* CSS for each checkbox item */
    .checkbox-item {
      margin-bottom: 10px;
      display: flex;
      padding-left: 20px;
      flex-direction: row;
      height: 100px;
      align-items: center;
      
    }
    .label{
        font-family: "inter";
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        letter-spacing: 0em;
        padding-left: 10px;
        text-align: left;
        margin-bottom: 0px;
    }
    .modal-body {
        padding: 0px;
    }

    /* CSS for the checkbox input */
    .checkbox-item input[type="checkbox"] {
      margin-right: 5px;
    }
   .modalimage{
    height: 80px;
    width: 80px;
    margin: 0px 15px;
    border-radius: 10px;
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
                        <div class="col-lg-6">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{__('Edit Service Attributes')}} </h2>
                            </div>
                        </div>

                    </div>
                    <x-error-message/>
                    <form action="{{route('seller.edit.service.attribute',$service->id)}}" method="post">
                        @csrf
                        @if($service->is_service_online == 1)
                            <input type="hidden" name="is_service_online_id" value="{{ $service->is_service_online }}"  id="is_service_online_id">
                        @endif
                        <div class="row">
                            <div class="col-xl-4 margin-top-50">
                                <div class="edit-service-wrappers">
                                    <div class="dashboard-edit-thumbs">
                                        {!! render_image_markup_by_attachment_id($service->image) !!}
                                    </div>
                                    <div class="content-edit margin-top-40">
                                        <h4 class="title"> {{$service->title}} </h4>
                                        <p class="edit-para"> {{ Str::limit(strip_tags($service->description)) ,200}} </p>
                                    </div>

                                    <div class="single-dashboard-input @if($service->is_service_online==1) service-price-show-hide @endif">
                                        <div class="single-info-input margin-top-50">
                                            <label class="info-title"> {{__('Service Price')}}</label>
                                            <input class="form--control" type="text" name="price" id="service_total_price" value="{{$service->price}}">
                                        </div>
                                    </div>

                                    <div class="btn-wrapper margin-top-40">
                                        <button type="submit" class="cmn-btn btn-bg-1">{{ __('Update Attributes') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 margin-top-50">
                                {{-- @if($service->is_service_online == 1)
                                    <div class="dashboard-switch-single margin-bottom-30">
                                        <a href="{{ route('seller.edit.service.attribute.offline.to.online', $service->id) }}" title="Offline To Online Service">
                                            <input class="custom-switch is_service_online"
                                                   id="is_service_online" type="checkbox" checked />
                                            {{__('Online Service')}}
                                            <br>  <i class="las la-toggle-on" style="font-size:48px; color: #1DBF73;"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="dashboard-switch-single margin-bottom-30">
                                        <a href="{{ route('seller.edit.service.attribute.offline.to.online', $service->id) }}" title="Offline To Online Service">
                                            <input class="custom-switch is_service_offline" id="is_service_offline" type="checkbox" disabled />
                                            {{__('Offline Service')}} <br>
                                            <i class="las la-toggle-off" style="font-size:48px;"></i>
                                        </a>
                                    </div>
                                @endif --}}
                                <div class="single-settings">
                                    <h4 class="input-title"> {{__('What is Included In This Package')}} </h4>
                                    <div class="append-additional-includes">
                                        @foreach($service_includes as $include)
                                            <div class="single-dashboard-input what-include-element">
                                                <input type="hidden" name="service_include_id[]" value="{{ $include->id }}">
                                                <div class="single-info-input margin-top-20">
                                                    <label>{{ __('Title') }}</label>
                                                    <input class="form--control" type="text" name="include_service_title[]" placeholder="{{__('Service title')}}" value="{{$include->include_service_title}}">
                                                </div>
                                                <div class="single-info-input margin-top-20 @if($service->is_service_online==1) is_service_online_hide @endif">
                                                    <label>{{ __('Unit Price') }}</label>
                                                    <input class="form--control include-price" type="text" name="include_service_price[]" placeholder="{{__('Add Price')}}" value="{{$include->include_service_price}}">
                                                </div>
                                                <div class="single-info-input margin-top-20 @if($service->is_service_online==1) is_service_online_hide @endif">
                                                    <label>{{ __('Quantity') }}</label>
                                                    <input class="form--control numeric-value" type="text" name="include_service_quantity[]" placeholder="{{__('Add Quantity')}}" value="{{$include->include_service_quantity}}" readonly>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="single-settings margin-top-40">


                                    <div class="append-additional-services">
                                        <div class="single-dashboard-input additional-services">
                                            <div class="serviceopt margin-top-20">
                                                <h5>Service Time</h5>
                                                <p>How much time service will take</p>
                                                <label>Time</label><br>
                                                <input type="number" id="points" name="time" step="15" value={{$service_time}}  placeholder="Mins">
                                            </div>
                                            <div class="serviceopt margin-top-20">
                                           <h5 style="font-size: 20px;">Select Staff who can provide this Service</h5>
                                           <p>It can be all or any Specific</p><br>
                                           <button type="button"  id="services_add_btn" data-toggle="modal" data-target="#addstaff"
                                           data-services_selected="{{ __($data) }}">
                                            Select Staff Members
                                          </button>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <input type="text" name="staffs" id="services_ids" value="" style="display: none;">


                                @if($service->is_service_online==1)
                                    <div class="single-settings day_review_show_hide">
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-20">
                                                <label>{{ __('Delivery Days') }}</label>
                                                <input class="form--control" type="number" value="{{ $service->delivery_days }}" step="0.01" name="delivery_days" placeholder="{{__('Delivery Days')}}">
                                            </div>
                                            <div class="single-info-input margin-top-20">
                                                <label>{{ __('Revisions') }}</label>
                                                <input class="form--control" type="number" value="{{ $service->revision }}"  step="0.01" name="revision" placeholder="{{__('Revision Times')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-settings online_service_price_show_hide">
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-20">
                                                <label>{{ __('Service Price') }}</label>
                                                <input class="form--control" type="number" value="{{ $service->price }}"  step="0.01" name="online_service_price" placeholder="{{__('Service price')}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- @if($service_additionals->count() >= 1)
                                    <div class="single-settings margin-top-40">
                                        <h4 class="input-title"> {{__('Aditional Services')}} </h4>
                                        <div class="append-additional-services">
                                            @foreach($service_additionals as $additional)
                                                <div class="single-dashboard-input additional-services">
                                                    <input type="hidden" name="service_additional_id[]" value="{{ $additional->id }}">
                                                    <div class="single-info-input margin-top-20">
                                                        <label>{{ __('Title') }}</label>
                                                        <input class="form--control" type="text" name="additional_service_title[]" placeholder="{{__('Service title')}}"  value="{{$additional->additional_service_title}}">
                                                    </div>
                                                    <div class="single-info-input margin-top-20">
                                                        <label>{{ __('Unit Price') }}</label>
                                                        <input class="form--control numeric-value" type="text" name="additional_service_price[]" placeholder="{{__('Add Price')}}" value="{{$additional->additional_service_price}}">
                                                    </div>
                                                    <div class="single-info-input margin-top-20">
                                                        <label>{{ __('Quantity') }}</label>
                                                        <input class="form--control numeric-value" type="text" name="additional_service_quantity[]" placeholder="{{__('Add Quantity')}}" value="{{$additional->additional_service_quantity}}" readonly>
                                                    </div>

                                                    <div class="single-info-input margin-top-30">
                                                        <div class="form-group ">
                                                            <div class="media-upload-btn-wrapper">
                                                                <div class="img-wrap">
                                                                    {!! render_image_markup_by_attachment_id($additional->additional_service_image) !!}
                                                                </div>
                                                                <input type="hidden" name="image[]">
                                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                                        data-btntitle="{{__('Select Image')}}"
                                                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                                        data-target="#media_upload_modal">
                                                                    {{__('Upload Image')}}
                                                                </button>
                                                                <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                                                <small>{{ __('recommended size 78x78') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif --}}
{{-- 
                                @if($service_benifits->count() >= 1)
                                    <div class="single-settings margin-top-40">
                                        <h4 class="input-title"> {{__('Benefit Of This Package')}} </h4>
                                        <div class="append-benifits">
                                            @foreach($service_benifits as $benifit)
                                                <div class="single-dashboard-input benifits">
                                                    <input type="hidden" name="service_benifit_id[]" value="{{ $benifit->id }}">
                                                    <div class="single-info-input margin-top-20">
                                                        <input class="form--control" type="text" name="benifits[]" placeholder="{{__('Type Here')}}" value="{{$benifit->benifits}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif --}}

                                @if($online_service_faq->count() >= 1)
                                    <div class="single-settings margin-top-40">
                                        <h4 class="input-title"> {{__('Faqs')}} </h4>
                                        <div class="append-faqs">
                                            @foreach($online_service_faq as $faq)
                                                <div class="single-dashboard-input benifits">
                                                    <input type="hidden" name="online_service_faq_id[]" value="{{ $faq->id }}">
                                                    <div class="single-info-input margin-top-20">
                                                        <input class="form--control" type="text" name="faqs_title[]" value="{{$faq->title}}"  placeholder="{{__('Faq Title')}}">
                                                    </div>
                                                    <div class="single-info-input margin-top-20">
                                                        <textarea class="form--control" name="faqs_description[]" placeholder="{{__('Faq Description')}}">{{$faq->description}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 style="font-size: 16px;" class="modal-title" id="exampleModalLabel">Staff Member’s who can provide This Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <ul class="checkbox-list">
            <li class="checkbox-item">
            <input type="checkbox" name="services_all" class="services_all check-input">
            <label class="label" for="checkbox1">All Staff</label>
            </li>

            @foreach($staff as $data)
            <li class="checkbox-item">
            <input type="checkbox" id="{{$data->id}}" class="select_services" name="select_services" value="{{$data->id}}">

            @if($data->profile_image_id !== null &&  $data->profile_image_id !== "NULL" && $data->profile_image_id !== "" && get_attachment_image_by_id($data->profile_image_id)['img_url']  !== "" )
            <img  class="modalimage" src="{{get_attachment_image_by_id($data->profile_image_id)['img_url']}}" alt="">
            @else
                <img  class="modalimage" src={{ asset('/assets/uploads/no-profile.png') }} alt="">
            @endif
            
            <label class="label" for="checkbox1">{{$data->name}}</label>
            </li>

            @endforeach
           
        </ul>

        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary">Save Staff</button>
        </div>
    </div>
    </div>
</div>

    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
@endsection


@section('scripts')

    <x-media.js :type="'web'"/>

    <script>
        (function ($) {
            'use strict'
            $(document).ready(function() {

      //staff

      function setServicesSelectedValues() {
                    var inputs = document.querySelectorAll('.select_services');
                    var selectedIds = [];
                    var selectedIdsString = "";
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].checked == true) {
                            selectedIds.push(`${inputs[i].id}`);
                        }
                    }
                    for (var i = 0; i < selectedIds.length; i++) {
                        if (i == selectedIds.length - 1) {
                            selectedIdsString += `${selectedIds[i]}`;
                        } else {
                            selectedIdsString += `${selectedIds[i]},`;
                        }
                    }
                    console.log(selectedIdsString);
                    document.getElementById(`services_ids`).value = selectedIdsString;
                }

                $('.services_all').change(
                    function() {
                        var inputs = document.querySelectorAll('.select_services');
                        if ($(this).is(':checked')) {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = true;
                            }
                        } else {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = false;
                            }
                        }
                        setServicesSelectedValues();
                    }
                );

                $(document).on('click', '.select_services', setServicesSelectedValues);


                $(document).on('click', '#services_add_btn', function(e) {
                    e.preventDefault();
                    let services_selected = $(this).data('services_selected');
                    $('#services_ids').val(services_selected);
                    if (services_selected != null && services_selected != "") {
                        var services_ids = services_selected.toString().split(",")
                        services_ids.forEach(id => {
                            document.getElementById(id).checked = true;
                        });
                    }

                });
                
                //total price
                $(document).on("change", ".include-price", function() {
                    var sum = 0;
                    $(".include-price").each(function() {
                        if(isNaN($(this).val())){
                            alert("{{__('Please Enter Numeric Value only')}}")
                        }else{
                            sum += +$(this).val();
                        }
                    });
                    $("#service_total_price").val(sum);
                });
                //include quantity
                $(document).on("change", ".numeric-value", function() {
                    if(isNaN($(this).val())){
                        alert("{{__('Please Enter Numeric Value only')}}")
                    }
                });
                //is service online
                $('.is_service_online_hide').hide();
                $('.service-price-show-hide').hide()
            })
        })(jQuery)
    </script>
@endsection