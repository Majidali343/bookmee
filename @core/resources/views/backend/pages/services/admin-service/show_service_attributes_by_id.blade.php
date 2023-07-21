@extends('backend.admin-master')

@section('site-title')
    {{__('Edit Attributes')}}
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
                    <h3 class="dashboards-title"> {{__('Show Service Attributes')}} </h3>
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
                <div class="show_service_all_attr">
                    <h5>{{ $service->title }}</h5>
                    <div class="dashboard-edit-thumbs mt-3">
                        {!! render_image_markup_by_attachment_id($service->image,'','thumb') !!}
                    </div>
                </div>
                <div class="dashboard-service-single-item border-1 margin-top-40">

                    <h5 class="mb-3">{{ __('Include Service Attributes') }}</h5>
                    <div class="rows dash-single-inner">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($include_service as $key=>$inc_service)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $inc_service->include_service_title }}</td>
                                    <td>{{ float_amount_with_currency_symbol($inc_service->include_service_price) }}</td>
                                    <td>{{ $inc_service->include_service_quantity }}</td>
                                    <td>
                                        <x-delete-popover :url="route('admin.services.includeservice.delete',$inc_service->id)"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($additional_service->count() >= 1)
                        <h5 class="mt-3 mb-3">{{ __('Additional Service Attributes') }}</h5>
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($additional_service as $key=>$addi_service)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $addi_service->additional_service_title }}</td>
                                        <td>{{ float_amount_with_currency_symbol($addi_service->additional_service_price) }}</td>
                                        <td>{{ $addi_service->additional_service_quantity }}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.services.additionalservice.delete',$addi_service->id)"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if($service_benifit->count() >= 1)
                        <h5 class="mt-3 mb-3">{{ __('Service Benefit') }}</h5>
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('No') }}</th>
                                    <th>{{ __('Benefit') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_benifit as $key=>$ser_benifit)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $ser_benifit->benifits }}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.services.benifit.delete',$ser_benifit->id)"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if($service_faqs->count() >= 1)
                        <h5 class="mt-3 mb-3">{{ __('Service Faqs') }}</h5>
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_faqs as $key=>$service_faq)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $service_faq->title }}</td>
                                        <td>{{ $service_faq->description }}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.services.faq.delete',$service_faq->id)"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
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
            $(document).ready(function(){

                <x-bulk-action-js :url="route('admin.category.bulk.action')"/>

                    $(document).on('click','.swal_status_change',function(e){
                        e.preventDefault();
                        Swal.fire({
                            title: '{{__("Are you sure to change status?")}}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, change it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(this).next().find('.swal_form_submit_btn').trigger('click');
                            }
                        });
                    });

            });
        })(jQuery)
    </script>
@endsection

