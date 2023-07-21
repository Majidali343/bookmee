@extends('backend.admin-master')

@section('site-title')
    {{__('All Chat Users')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Chat Login Text')}}  </h4>
                            </div>
                        </div>
                        <div class="chat-showing-person">
                            <form action="{{ route('admin.chat.login.text.show.hide') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="login_text_show_hide">{{ __('Show or Hide Login Text') }}</label>
                                    <select name="login_text_show_hide" class="form-control">
                                        <option value="">{{ __('Select One') }}</option>
                                        <option value="yes" @if(!empty(get_static_option('login_text_show_hide')) && get_static_option('login_text_show_hide')=='yes')  selected @endif>{{ __('Yes') }}</option>
                                        <option value="no" @if(!empty(get_static_option('login_text_show_hide')) && get_static_option('login_text_show_hide')=='no')  selected @endif>{{ __('No') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')

@endsection

