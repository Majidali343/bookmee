@extends('backend.admin-master')
@section('site-title')
    {{__('All Tickets')}}
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
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Subject')}}</th>
                                <th>{{__('Priority')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_tickets as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->subject}}</td>
                                        <td>
                                            @if($data->priority=='low')<span class="btn btn-primary btn-bg-1">{{ ucfirst($data->priority) }}</span>@endif
                                            @if($data->priority=='high')<span class="btn btn-warning btn-bg-1">{{ ucfirst($data->priority) }}</span>@endif
                                            @if($data->priority=='medium')<span class="btn btn-info btn-bg-1">{{ ucfirst($data->priority) }}</span>@endif
                                            @if($data->priority=='urgent')<span class="btn btn-danger btn-bg-1">{{ ucfirst($data->priority) }}</span>@endif
                                        </td>
                                        <td>
                                            @if($data->status=='open')
                                                <span class="btn btn-primary btn-bg-1">{{ ucfirst($data->status) }}</span>
                                            @endif
                                            @if($data->status=='close')
                                                <span class="btn btn-danger btn-bg-1">{{ ucfirst($data->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                        <td>
                                            @can('ticket-delete')
                                                <x-delete-popover :url="route('admin.ticket.delete',$data->id)"/>
                                            @endcan
                                            @can('ticket-view')
                                                <a href="{{ route('admin.ticket.details',$data->id) }}" class="btn btn-info mb-3"> <i class="ti-eye"></i></a>
                                            @endcan
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
    <x-datatable.js/>
    <script type="text/javascript">
    </script>
@endsection
