@extends('backend.admin-master')
@section('site-title')
    {{__('All Services')}}
@endsection
@section('style')
<x-datatable.css/>
<x-media.css/>
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
                                <h4 class="header-title">{{__('All Services')}}  </h4>
                                @can('service-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th> 
                                <th>{{__('Featured')}}</th> 
                                 <th>{{__('Action')}}</th> 
                                </thead>
                                <tbody>
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
    @include('backend.partials.datatable.script-enqueue',['only_js' => true])
    <x-media.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                <x-bulk-action-js :url="route('admin.service.bulk.action')"/>
                $('.table-wrap > table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.services') }}",
                    columns: [
                        {data: 'checkbox', name: '', orderable: false, searchable: false},
                        {data: 'id', name: 'id'},
                        {data: 'title', name: '', orderable: true, searchable: true},
                        {data: 'price', name: '', orderable: true, searchable: true},
                        {data: 'status', name: ''},
                        {data: 'create_date', name: ''},
                        {data: 'featured', name: ''},
                        {data: 'action', name: '', orderable: false, searchable: true},
                    ]
                });

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
        })(jQuery);
    </script>
@endsection
