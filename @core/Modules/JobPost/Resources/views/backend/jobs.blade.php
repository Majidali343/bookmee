@extends('backend.admin-master')

@section('site-title')
    {{__('All Jobs')}}
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
                                <h4 class="header-title">{{__('All Jobs')}}  </h4>
                                <p class="text-info mb-3">{{ __('You can not delete those jobs which has any offer created by seller or order created by buyer') }}</p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_jobs">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Job Details')}}</th>
                                <th>{{__('Buyer Details')}}</th>
                                <th>{{__('Job Request')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_jobs as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{!! render_attachment_preview_for_admin($data->image,'max-width-100') !!}</td>
                                        <td>
                                            <ul>
                                                <li><strong>{{__('Title')}}: </strong>{{$data->title}}</li>
                                                <li><strong>{{__('Type')}}: </strong>{{ $data->is_job_online == 1 ? 'Online' : 'Offline' }}</li>
                                                <li><strong>{{__('Price')}}: </strong>{{float_amount_with_currency_symbol($data->price)}}</li>
                                                <li><strong>{{__('Job Offers')}}: </strong>{{ optional($data->job_request)->count() }}</li>
                                                @can('job-status')
                                                    <li>
                                                        <strong>{{__('Job Status')}}:</strong>
                                                        {{ $data->status == 0 ? __('Inactive') : __('Active') }}
                                                        <span><x-status-change :url="route('admin.jobs.status',$data->id)"/></span>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li><strong>{{__('Name')}}: </strong>{{optional($data->buyer)->name}}</li>
                                                <li><strong>{{__('Email')}}: </strong>{{ optional($data->buyer)->email}}</li>
                                                <li><strong>{{__('Phone')}}: </strong>{{ optional($data->buyer)->phone }}</li>
                                            </ul>
                                        </td>
                                        <td><a class="btn btn-info" href="{{ route('admin.jobs.request.all',$data->id) }}">{{ __('All Request') }}</a></td>
                                        <td>
                                            @if(optional($data->job_request)->count() === 0)
                                                @can('job-delete')
                                                    <x-delete-popover :url="route('admin.jobs.delete',$data->id)"/>
                                                @endcan
                                            @endif
                                             <a href="{{ route('job.post.details',$data->slug) }}" class="btn btn-success mb-3"><i class="ti-eye"></i></a>
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

