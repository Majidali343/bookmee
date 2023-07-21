@extends('backend.admin-master')
@section('site-title')
    {{__('All Menus')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Menus')}}</h4>
                        <div class="table-wrap">
                            <table class="table table-default">
                                <thead>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_menu as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>
                                            @can('appearance-menu-edit')
                                            @if($data->status == 'default')
                                                <span class="alert alert-success">{{__('Default Menu')}}</span>
                                            @else
                                                <form action="{{route('admin.menu.default',$data->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm mb-3 mr-1 set_default_menu">{{__('Set Default')}}</button>
                                                </form>
                                            @endif
                                             @endcan
                                        </td>
                                        <td>{{$data->created_at->format('d-M-Y')}}</td>
                                        <td>

                                            @can('appearance-menu-delete')
                                                @if($data->status != 'default')
                                                    <x-delete-popover :url="route('admin.menu.delete',$data->id)" />
                                                @endif
                                            @endcan


                                           @can('appearance-menu-edit')
                                            <x-edit-icon :url="route('admin.menu.edit',$data->id)"/>
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

          @can('appearance-menu-create')
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Menu')}}</h4>
                        <form action="{{route('admin.menu.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Create Menu')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          @endcan
        </div>
    </div>
@endsection
