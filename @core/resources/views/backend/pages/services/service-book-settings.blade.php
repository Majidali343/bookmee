@extends('backend.admin-master')

@section('site-title')
    {{__('Service Book Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{__("Service Book Settings")}}</h4>
                        <form action="{{route('admin.service.book.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="service_main_attribute_title">{{__('Service Main Attribute Title')}}</label>
                                <input type="text" name="service_main_attribute_title"  class="form-control" value="{{get_static_option('service_main_attribute_title')}}" id="service_main_attribute_title">
                            </div>
                            <div class="form-group">
                                <label for="service_additional_attribute_title">{{__('Service Additional Attribute Title')}}</label>
                                <input type="text" name="service_additional_attribute_title"  class="form-control" value="{{get_static_option('service_additional_attribute_title')}}" id="service_additional_attribute_title">
                            </div>
                            <div class="form-group">
                                <label for="service_benifits_title">{{__('Service Benifits Title')}}</label>
                                <input type="text" name="service_benifits_title"  class="form-control" value="{{get_static_option('service_benifits_title')}}" id="service_benifits_title">
                            </div>
                            <div class="form-group">
                                <label for="service_booking_title">{{__('Service Booking Title')}}</label>
                                <input type="text" name="service_booking_title"  class="form-control" value="{{get_static_option('service_booking_title')}}" id="service_booking_title">
                            </div>
                            <div class="form-group">
                                <label for="service_appoinment_package_title">{{__('Service Appoinment Package Title')}}</label>
                                <input type="text" name="service_appoinment_package_title"  class="form-control" value="{{get_static_option('service_appoinment_package_title')}}" id="service_appoinment_package_title">
                            </div>
                            <div class="form-group">
                                <label for="service_package_fee_title">{{__('Service Package Fee Title')}}</label>
                                <input type="text" name="service_package_fee_title"  class="form-control" value="{{get_static_option('service_package_fee_title')}}" id="service_package_fee_title">
                            </div>
                            <div class="form-group">
                                <label for="service_extra_title">{{__('Service Extra Title')}}</label>
                                <input type="text" name="service_extra_title"  class="form-control" value="{{get_static_option('service_extra_title')}}" id="service_extra_title">
                            </div>
                            <div class="form-group">
                                <label for="service_subtotal_title">{{__('Service Subtotal Title')}}</label>
                                <input type="text" name="service_subtotal_title"  class="form-control" value="{{get_static_option('service_subtotal_title')}}" id="service_subtotal_title">
                            </div>
                            <div class="form-group">
                                <label for="service_total_amount_title">{{__('Service Total Amount Title')}}</label>
                                <input type="text" name="service_total_amount_title"  class="form-control" value="{{get_static_option('service_total_amount_title')}}" id="service_total_amount_title">
                            </div>
                            <div class="form-group">
                                <label for="service_available_date_title">{{__('Service Available Date Title')}}</label>
                                <input type="text" name="service_available_date_title"  class="form-control" value="{{get_static_option('service_available_date_title')}}" id="service_available_date_title">
                            </div>
                            <div class="form-group">
                                <label for="service_available_schudule_title">{{__('Service Available Schedule Title')}}</label>
                                <input type="text" name="service_available_schudule_title"  class="form-control" value="{{get_static_option('service_available_schudule_title')}}" id="service_available_schudule_title">
                            </div>
                            <div class="form-group">
                                <label for="service_booking_information_title">{{__('Service Booking Information Title')}}</label>
                                <input type="text" name="service_booking_information_title"  class="form-control" value="{{get_static_option('service_booking_information_title')}}" id="service_booking_information_title">
                            </div>
                            <div class="form-group">
                                <label for="terms_and_conditions_link">{{__('Trems and Conditions Link')}}</label> </br>
                                <small class="text-danger">{{ __('This link will be set in order confirmation terms and conditions.') }}</small>
                                <input type="text" name="terms_and_conditions_link"  class="form-control" value="{{get_static_option('terms_and_conditions_link')}}" id="terms_and_conditions_link">
                            </div>
                            <div class="form-group">
                                <label for="service_order_confirm_title">{{__('Service Order Confirm Title')}}</label>
                                <input type="text" name="service_order_confirm_title"  class="form-control" value="{{get_static_option('service_order_confirm_title')}}" id="service_order_confirm_title">
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>
            });
        }(jQuery));
    </script>
@endsection
