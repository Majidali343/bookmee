@extends('backend.admin-master')

@section('site-title')
    {{__('Login Register Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{__("Login Register Settings")}}</h4>
                        <form action="{{route('admin.login.register.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="login_form_title">{{__('Login Form Title')}}</label>
                                <input type="text" name="login_form_title"  class="form-control" value="{{get_static_option('login_form_title')}}" id="login_form_title">
                            </div>

                            <div class="form-group">
                                <label for="register_page_title">{{__('Register Page Title')}}</label>
                                <input type="text" name="register_page_title"  class="form-control" value="{{get_static_option('register_page_title')}}" id="register_page_title">
                            </div>

                            <div class="form-group">
                                <label for="register_seller_title">{{__('Register Page Seller Title')}}</label>
                                <input type="text" name="register_seller_title"  class="form-control" value="{{get_static_option('register_seller_title')}}" id="register_seller_title">
                            </div>

                            <div class="form-group">
                                <label for="register_buyer_title">{{__('Register Page Buyer Title')}}</label>
                                <input type="text" name="register_buyer_title"  class="form-control" value="{{get_static_option('register_buyer_title')}}" id="register_buyer_title">
                            </div>

                            @php
                                $all_pages = App\Page::select('id','title','slug')->latest()->get();
                            @endphp
                            <div class="form-group">
                                <label for="register_buyer_title">{{__('Set Terms & Condition')}}</label>
                                <select name="select_terms_condition_page" id="select_terms_condition_page" class="form-control">
                                    <option value="">{{ __('Select Page') }}</option>
                                    @foreach($all_pages as $page)
                                        <option @if(get_static_option('select_terms_condition_page') == $page->slug ) selected @endif value="{{ $page->slug }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <x-icon-picker/>
                <x-btn.update/>
            });
        }(jQuery));
    </script>
@endsection
