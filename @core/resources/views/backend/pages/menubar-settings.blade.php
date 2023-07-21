@extends('backend.admin-master')
@section('site-title')
    {{__('Events Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Events Settings")}}</h4>
                        <form action="{{route('admin.menubar.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="disable_guest_mode_for_event_module"><strong>{{__('Enable/Disable Menubar Button')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="menubar_button" @if(!empty(get_static_option('menubar_button'))) checked @endif >
                                    <span class="slider onff"></span>
                                </label>
                            </div>


                            <x-lang-nav/>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group mt-3">
                                            <label>{{__('Menubar Button Text')}}</label>
                                            <input type="text" name="menubar_button_{{$lang->slug}}_text" class="form-control"
                                                   value="{{get_static_option('menubar_button_'.$lang->slug.'_text')}}">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label>{{__('Menubar Button URL')}}</label>
                                            <input type="text" name="menubar_button_{{$lang->slug}}_url" class="form-control"
                                                   value="{{get_static_option('menubar_button_'.$lang->slug.'_url')}}">
                                            <small class="text-danger">{{__('If you don"t have any custom url then leave this field blank...!')}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        <x-btn.update/>
    </script>
@endsection
