@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Service History')}}
@endsection

@section('style')
    <x-datatable.css/>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Edit Service History')}}  </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('Service ID')}}</th>
                                <th>{{__('Seller Id')}}</th>
                                <th>{{__('Service Title')}}</th>
                                <th>{{__('Service Description')}}</th>
                                </thead>
                                <tbody>
                                @foreach($service_histories as $data)
                                    <tr>
                                        <td>{{$data->service_id}}</td>
                                        <td>{{$data->seller_id}}</td>
                                        <td>{{$data->service_title}}</td>
                                        <td>
                                            <p>{{ Str::limit(strip_tags($data->service_description),50) }}</p>
                                            <p><strong>{{ __('Description:') }}</strong> <span class="btn btn-info report_description" data-toggle="modal" data-target="#reportModal" data-service_description="{{ strip_tags($data->service_description) }}"><i class="ti-eye"></i></span></p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    Description modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">{{ __('Service Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="service_description"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                $(document).on('click','.report_description',function(e){
                    let service_description = $(this).data('service_description');
                    $('#service_description').text(service_description);
                });
            });

        })(jQuery);
    </script>
@endsection
