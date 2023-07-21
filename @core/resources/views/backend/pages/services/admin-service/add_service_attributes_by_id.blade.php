@extends('backend.admin-master')

@section('site-title')
    {{__('Add Service Attributes')}}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/common/css/flatpickr.min.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-6">
                <div class="dashboard-settings margin-top-40">
                    <h3 class="dashboards-title"> {{__('Add Service Attributes')}} </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.add.service.attributes.by.id',$get_service->id)}}" method="post">
                    @csrf

                    <input type="hidden" name="service_id" value="{{$get_service->id}} ">
                    @if($get_service->is_service_online == 1)
                        <input type="hidden" name="is_service_online_id" value="{{ $get_service->is_service_online }}"  id="is_service_online_id">
                    @endif

                    <div class="row">
                        <div class="col-xl-4 margin-top-50">
                            <div class="edit-service-wrappers">
                                <div class="dashboard-edit-thumbs">
                                    {!! render_image_markup_by_attachment_id($get_service->image) !!}
                                </div>
                                <div class="content-edit margin-top-40">
                                    <h5 class="title"> {{$get_service->title}} </h5>
                                    <p class="edit-para"> {{ Str::limit(strip_tags($get_service->description)) ,200}}</p>
                                </div>
                                <div class="single-dashboard-input service-price-show-hide">
                                    <div class="single-info-input margin-top-50">
                                        <label class="info-title"> {{__('Service Price')}}</label>
                                        <input class="form-control" type="text" name="price" id="service_total_price">
                                    </div>
                                </div>

                                <div class="btn-wrapper margin-top-40">
                                    <button type="submit" class="btn btn-sm btn-success">{{__('Save & Publish')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 margin-top-50">
                            @if($get_service->is_service_online == 1)
                                <div class="dashboard-switch-single margin-bottom-30">
                                    <input class="custom-switch is_service_online" id="is_service_online" type="checkbox" checked disabled/> {{__('Online Service')}}
                                    <label class="switch-label" for="is_service_online"></label>
                                </div>
                            @endif
                            <div class="single-settings">
                                <h5 class="input-title"> {{__('What is Included In This Package')}} </h5>
                                <div class="append-additional-includes">
                                    <div class="single-dashboard-input what-include-element">
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Title') }}</label>
                                            <input class="form-control" type="text" name="include_service_title[]" placeholder="{{__('Service title')}}">
                                        </div>
                                        <div class="single-info-input margin-top-20 @if($get_service->is_service_online == 1) is_service_online_hide @endif">
                                            <label>{{ __('Unit Price') }}</label>
                                            <input class="form-control include-price" type="number" step="0.01" name="include_service_price[]" placeholder="{{__('Add Price')}}">
                                        </div>
                                        <div class="single-info-input margin-top-20 @if($get_service->is_service_online == 1) is_service_online_hide @endif">
                                            <label>{{ __('Quantity') }}</label>
                                            <input class="form-control numeric-value" type="text" name="include_service_quantity[]" value="1" placeholder="{{__('Add Quantity')}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper margin-top-20">
                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-what-includes"> {{__('Add More')}} </a>
                                </div>
                            </div>

                            <div class="single-settings margin-top-40">
                                <h5 class="input-title"> {{__('Add Additional Services')}} </h5>

                                <div class="append-additional-services">
                                    <div class="single-dashboard-input additional-services">
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Title') }}</label>
                                            <input class="form-control" type="text" name="additional_service_title[]" placeholder="{{__('Service title')}}">
                                        </div>
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Unit Price') }}</label>
                                            <input class="form-control numeric-value" type="number" step="0.01" name="additional_service_price[]" placeholder="{{__('Add Price')}}">
                                        </div>
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Quantity') }}</label>
                                            <input class="form-control numeric-value" type="text" name="additional_service_quantity[]" value="1" placeholder="{{__('Add Quantity')}}" readonly>
                                        </div>

                                        <div class="single-info-input margin-top-30">
                                            <div class="form-group ">
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap"></div>
                                                    <input type="hidden" name="image[]">
                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                            data-btntitle="{{__('Select Image')}}"
                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                            data-target="#media_upload_modal">
                                                        {{__('Upload Image')}}
                                                    </button>
                                                    <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                                    <small>{{ __('recomended size 78x78') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="btn-wrapper margin-top-20">
                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-additional-services"> {{__('Add More')}} </a>
                                </div>
                            </div>
                            <div class="single-settings margin-top-40">
                                <h5 class="input-title"> {{__('Benefit Of This Package')}} </h5>
                                <div class="append-benifits">
                                    <div class="single-dashboard-input benifits">
                                        <div class="single-info-input margin-top-20">
                                            <input class="form-control" type="text" name="benifits[]" placeholder="{{__('Type Here')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper margin-top-20">
                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-benifits"> {{__('Add More')}} </a>
                                </div>
                            </div>

                            @if($get_service->is_service_online == 1)
                                <div class="single-settings margin-top-40 faq_show_hide">
                                    <h5 class="input-title"> {{__('Faqs')}} </h5>
                                    <div class="append-faqs">
                                        <div class="single-dashboard-input faqs">
                                            <div class="single-info-input margin-top-20">
                                                <input class="form-control" type="text" name="faqs_title[]" placeholder="{{__('Faq Title')}}">
                                            </div>
                                            <div class="single-info-input margin-top-20">
                                                <textarea class="form-control" name="faqs_description[]" cols="20" rows="5" placeholder="{{__('Faq Description')}}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-20">
                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-faqs"> {{__('Add More')}} </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-media.markup/>

@endsection

@section('script')
    <x-media.js />
    <x-summernote.js/>
    <script src="{{asset('assets/common/js/flatpickr.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function() {
                // add what new inclue
                $(".add-what-includes").on('click',function(){
                    let  total_element = $(".what-include-element").length;
                    let max = 15;
                    if(total_element < max ){
                        $(".append-additional-includes").append(
                            '<div class="single-dashboard-input what-include-element">\
                                <div class="single-info-input margin-top-20">\
                                    <label>{{ __('Title') }}</label>\
                                <input class="form-control" type="text" name="include_service_title[]" placeholder="{{__('Service title')}}">\
                            </div>\
                            <div class="single-info-input margin-top-20 @if($get_service->is_service_online == 1) is_service_online_hide @endif">\
                                <label>{{ __('Unit Price') }}</label>\
                                <input class="form-control include-price" type="number" step="0.01" name="include_service_price[]" placeholder="{{__('Add Price')}}">\
                            </div>\
                            <div class="single-info-input margin-top-20 @if($get_service->is_service_online == 1) is_service_online_hide @endif">\
                                <label>{{ __('Quantity') }}</label>\
                                <input class="form-control numeric-value" name="include_service_quantity[]" value="1" type="text" placeholder="{{__('Add Quantity')}}" readonly>\
                            </div><span class="btn btn-danger remove-include"><i class="las la-times"></i></span>\
                        </div>'
                        );
                    }
                    if ($("#is_service_online").is(':checked')){
                        $('.is_service_online_hide').hide();
                    }
                })

                // remove include service
                $(document).on('click', ".remove-include", function() {
                    $(this).closest('.what-include-element').remove();
                })



                // add additional service
                $(".add-additional-services").on('click',function(){
                    let  total_element = $(".additional-services").length;
                    let max = 5;
                    if(total_element < max ){
                        $(".append-additional-services").append(
                            '<div class="single-dashboard-input additional-services">\
                                  <div class="single-info-input margin-top-20">\
                                      <label>{{ __('Title') }}</label>\
                               <input class="form-control" type="text" name="additional_service_title[]" placeholder="{{__('Service title')}}">\
                            </div>\
                            <div class="single-info-input margin-top-20">\
                                <label>{{ __('Unit Price') }}</label>\
                                <input class="form-control numeric-value" type="text" name="additional_service_price[]" placeholder="{{__('Add Price')}}">\
                            </div>\
                            <div class="single-info-input margin-top-20">\
                                <label>{{ __('Quantity') }}</label>\
                                <input class="form-control numeric-value" type="number" step="0.01" name="additional_service_quantity[]" value="1" placeholder="{{__('Add Quantity')}}" readonly>\
                            </div>\
                            <div class="single-info-input margin-top-30">\
                                <div class="form-group ">\
                                    <div class="media-upload-btn-wrapper">\
                                        <div class="img-wrap"></div>\
                                        <input type="hidden" name="image[]">\
                                        <button type="button" class="btn btn-info media_upload_form_btn"\
                                                data-btntitle="{{__('Select Image')}}"\
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"\
                                                data-target="#media_upload_modal">\
                                            {{__('Upload Image')}}\
                                        </button>\
                                    </div>\
                                </div>\
                            </div><span class="btn btn-danger remove-service"><i class="las la-times"></i></span>\
                      </div>');
                    }
                })

                // remove additional service
                $(document).on('click', ".remove-service", function() {
                    $(this).closest('.additional-services').remove();
                })



                // add benifits
                $(".add-benifits").on('click',function(){
                    let  total_element = $(".benifits").length;
                    let max = 5;
                    if(total_element < max ){
                        $(".append-benifits").append(
                            '<div class="single-dashboard-input benifits">\
                              <div class="single-info-input margin-top-20">\
                                 <input class="form-control" type="text" name="benifits[]" placeholder="{{__('Type Here')}}">\
                        </div><span class="btn btn-danger remove-benifits"><i class="las la-times"></i></span>\
                      </div>');
                    }
                })

                // remove benifits
                $(document).on('click', ".remove-benifits", function() {
                    $(this).closest('.benifits').remove();
                })



                //total price
                $(document).on("change", ".include-price", function() {
                    var sum = 0;
                    $(".include-price").each(function() {
                        if(isNaN($(this).val())){
                            alert('Please Enter Numeric Value only')
                        }else{
                            sum += +$(this).val();
                        }
                    });
                    $("#service_total_price").val(sum);
                });

                //include quantity
                $(document).on("change", ".numeric-value", function() {
                    if(isNaN($(this).val())){
                        alert('Please Enter Numeric Value only')
                    }
                });

                //is service online
                $('.is_service_online_hide').hide();
                $('.service-price-show-hide').hide()

                // add faqs
                $(".add-faqs").on('click',function(){
                    let  total_element = $(".faqs").length;
                    let max = 15;
                    if(total_element < max ){
                        $(".append-faqs").append(
                            '<div class="single-dashboard-input faqs">\
                            <div class="single-info-input margin-top-20">\
                            <input class="form-control" type="text" name="faqs_title[]" placeholder="{{__('Faq Title')}}">\
                        </div>\
                        <div class="single-info-input margin-top-20">\
                        <textarea class="form-control" name="faqs_description[]" cols="20" rows="5" placeholder="{{__('Faq Descriptiom')}}"></textarea>\
                    </div><span class="btn btn-danger remove-faqs"><i class="las la-times"></i></span>\
                </div>');
                    }
                })

                // remove faqs
                $(document).on('click', ".remove-faqs", function() {
                    $(this).closest('.faqs').remove();
                })

            })
        })(jQuery)
    </script>
@endsection

