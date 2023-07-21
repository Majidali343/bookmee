@extends('backend.admin-master')
@section('site-title')
    {{__('Popup Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Popup Settings")}}</h4>
                        <form action="{{route('admin.general.popup.settings')}}" method="Post" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="popup_selected_{{$lang->slug}}_id">{{__('Select Popup')}}</label>
                                            <select name="popup_selected_{{$lang->slug}}_id" class="form-control" id="popup_selected_{{$lang->slug}}_id">
                                                @if(isset($all_popup[$lang->slug]))
                                                @foreach($all_popup[$lang->slug] as $item)
                                                    <option @if(get_static_option('popup_selected_'.$lang->slug.'_id') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="popup_enable_status"><strong>{{__('Popup Enable/Disable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="popup_enable_status" @if(!empty(get_static_option('popup_enable_status'))) checked @endif id="popup_enable_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="popup_delay_time">{{__('Popup Delay Time')}}</label>
                                <input type="number" class="form-control" name="popup_delay_time" id="popup_delay_time" value="{{get_static_option('popup_delay_time')}}">
                                <p class="info-text">{{__('put number in miliseconds')}}</p>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="db_backup_btn">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
