@extends('backend.admin-master')

@section('site-title')
    {{__('Edit Service Attributes')}}
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
                    <h3 class="dashboards-title"> {{__('Edit Service Attributes')}} </h3>
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
                <form action="{{route('admin.edit.service.attributes.by.id',$service->id)}}" method="post">
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
                                    <h5 class="title"> {{$service->title}} </h5>
                                    <p class="edit-para"> {{ Str::limit(strip_tags($service->description)) ,200}} </p>
                                </div>

                                <div class="single-dashboard-input @if($service->is_service_online==1) service-price-show-hide @endif">
                                    <div class="single-info-input margin-top-50">
                                        <label class="info-title"> {{__('Service Price')}}</label>
                                        <input class="form-control" type="text" name="price" id="service_total_price" value="{{$service->price}}">
                                    </div>
                                </div>

                                <div class="btn-wrapper margin-top-40">
                                    <button type="submit" class="btn btn-sm btn-success">{{ __('Update Attributes') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 margin-top-50">
                            @if($service->is_service_online == 1)
                                <div class="dashboard-switch-single margin-bottom-30">
                                    <a href="{{ route('admin.edit.service.attribute.offline.and.online', $service->id) }}" title="Online To Offline  Service">
                                    <input class="custom-switch is_service_online" id="is_service_online" type="checkbox" checked disabled />  {{__('Online Service')}}
                                    <label class="switch-label" for="is_service_online"></label>
                                    </a>
                                </div>
                            @else
                                <div class="dashboard-switch-single margin-bottom-30">
                                    <a href="{{ route('admin.edit.service.attribute.offline.and.online', $service->id) }}" title="Offline To Online Service">
                                    <input class="custom-switch is_service_online" id="is_service_online" type="checkbox" checked disabled/> {{__('Offline Service')}}
                                    <label class="switch-label" for="is_service_online"></label>
                                    </a>
                                </div>
                            @endif



                            <div class="single-settings">
                                <h5 class="input-title"> {{__('What is Included In This Package')}} </h5>
                                <div class="append-additional-includes">
                                    @foreach($service_includes as $include)
                                        <div class="single-dashboard-input what-include-element">
                                            <input type="hidden" name="service_include_id[]" value="{{ $include->id }}">
                                            <div class="single-info-input margin-top-20">
                                                <label>{{ __('Title') }}</label>
                                                <input class="form-control" type="text" name="include_service_title[]" placeholder="{{__('Service title')}}" value="{{$include->include_service_title}}">
                                            </div>
                                            <div class="single-info-input margin-top-20 @if($service->is_service_online==1) is_service_online_hide @endif">
                                                <label>{{ __('Unit Price') }}</label>
                                                <input class="form-control include-price" type="text" name="include_service_price[]" placeholder="{{__('Add Price')}}" value="{{$include->include_service_price}}">
                                            </div>
                                            <div class="single-info-input margin-top-20 @if($service->is_service_online==1) is_service_online_hide @endif">
                                                <label>{{ __('Quantity') }}</label>
                                                <input class="form-control numeric-value" type="text" name="include_service_quantity[]" placeholder="{{__('Add Quantity')}}" value="{{$include->include_service_quantity}}" readonly>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if($service->is_service_online==1)
                                <div class="single-settings day_review_show_hide">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Delivery Days') }}</label>
                                            <input class="form-control" type="number" value="{{ $service->delivery_days }}" step="0.01" name="delivery_days" placeholder="{{__('Delivery Days')}}">
                                        </div>
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Revisions') }}</label>
                                            <input class="form-control" type="number" value="{{ $service->revision }}"  step="0.01" name="revision" placeholder="{{__('Revision Times')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="single-settings online_service_price_show_hide">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-20">
                                            <label>{{ __('Service Price') }}</label>
                                            <input class="form-control" type="number" value="{{ $service->price }}"  step="0.01" name="online_service_price" placeholder="{{__('Service price')}}">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($service_additionals->count() >= 1)
                                <div class="single-settings margin-top-40">
                                    <h5 class="input-title"> {{__('Additional Services')}} </h5>
                                    <div class="append-additional-services">
                                        @foreach($service_additionals as $additional)
                                            <div class="single-dashboard-input additional-services">
                                                <input type="hidden" name="service_additional_id[]" value="{{ $additional->id }}">
                                                <div class="single-info-input margin-top-20">
                                                    <label>{{ __('Title') }}</label>
                                                    <input class="form-control" type="text" name="additional_service_title[]" placeholder="{{__('Service title')}}"  value="{{$additional->additional_service_title}}">
                                                </div>
                                                <div class="single-info-input margin-top-20">
                                                    <label>{{ __('Unit Price') }}</label>
                                                    <input class="form-control numeric-value" type="text" name="additional_service_price[]" placeholder="{{__('Add Price')}}" value="{{$additional->additional_service_price}}">
                                                </div>
                                                <div class="single-info-input margin-top-20">
                                                    <label>{{ __('Quantity') }}</label>
                                                    <input class="form-control numeric-value" type="text" name="additional_service_quantity[]" placeholder="{{__('Add Quantity')}}" value="{{$additional->additional_service_quantity}}" readonly>
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
                                                            <small>{{ __('recomended size 78x78') }}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($service_benifits->count() >= 1)
                                <div class="single-settings margin-top-40">
                                    <h5 class="input-title"> {{__('Benefit Of This Package')}} </h5>
                                    <div class="append-benifits">
                                        @foreach($service_benifits as $benifit)
                                            <div class="single-dashboard-input benifits">
                                                <input type="hidden" name="service_benifit_id[]" value="{{ $benifit->id }}">
                                                <div class="single-info-input margin-top-20">
                                                    <input class="form-control" type="text" name="benifits[]" placeholder="{{__('Type Here')}}" value="{{$benifit->benifits}}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($online_service_faq->count() >= 1)
                                <div class="single-settings margin-top-40">
                                    <h5 class="input-title"> {{__('Faqs')}} </h5>
                                    <div class="append-faqs">
                                        @foreach($online_service_faq as $faq)
                                            <div class="single-dashboard-input benifits">
                                                <input type="hidden" name="online_service_faq_id[]" value="{{ $faq->id }}">
                                                <div class="single-info-input margin-top-20">
                                                    <input class="form-control" type="text" name="faqs_title[]" value="{{$faq->title}}"  placeholder="{{__('Faq Title')}}">
                                                </div>
                                                <div class="single-info-input margin-top-20">
                                                    <textarea class="form-control" name="faqs_description[]" placeholder="{{__('Faq Description')}}">{{$faq->description}}</textarea>
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

