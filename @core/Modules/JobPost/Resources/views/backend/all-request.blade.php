@extends('backend.admin-master')

@section('site-title')
    {{__('Job All Request')}}
@endsection
@section('style')
    <x-media.css/>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Request')}}  </h4>
                                <p class="text-info mb-3">{{ __('Job request list') }}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_jobs">
                                <thead>
                                <th>{{__('Job Offer ID')}}</th>
                                <th>{{__('Job ID')}}</th>
                                <th>{{__('Seller Details')}}</th>
                                <th>{{__('Buyer Offer')}}</th>
                                <th>{{__('Seller Offer')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_request as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->job_post_id}}</td>
                                        <td>
                                            <ul>
                                                <li><strong>{{__('Name')}}: </strong>{{optional($data->seller)->name}}</li>
                                                <li><strong>{{__('Email')}}: </strong>{{ optional($data->seller)->email}}</li>
                                                <li><strong>{{__('Phone')}}: </strong>{{ optional($data->seller)->phone }}</li>
                                            </ul>
                                        </td>
                                        <td>{{float_amount_with_currency_symbol(optional($data->job)->price)}}</td>
                                        <td>{{ float_amount_with_currency_symbol($data->expected_salary) }}</td>
                                        <td>
                                            <a href="{{ route('admin.jobs.request.conversation.details',$data->id) }}" class="btn btn-info">{{ __('View Conversation') }}</a>
                                            @if($data->is_hired == 1)
                                                <span class="btn btn-danger">{{ __('Hired') }}</span>
                                            @endif
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
@endsection

@section('script')
    <x-media.js />
    <x-datatable.js/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click','.swal_status_change',function(e){
                    //
                });
            });
        })(jQuery)
    </script>
@endsection

