@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Popup')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">{{__('Edit New Popup')}}  </h4>
                            <h4 class="header-title">
                                <a href="{{route('admin.popup.builder.all')}}" class="btn btn-primary mt-4 pr-4 pl-4">{{__('All Popup')}}</a>
                            </h4>
                        </div>
                        <form action="{{route('admin.popup.builder.update',$popup->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option  @if($popup->lang == $lang->slug ) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{__('Name ( It will not show in frontend )')}}</label>
                                        <input type="text" class="form-control"  id="name" name="name" value="{{$popup->name}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{$popup->title}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="type"><strong>{{__('Type')}}</strong></label>
                                        <select name="type" id="popup_type" class="form-control">
                                            <option @if($popup->type == 'notice') selected @endif value="notice">{{__('Notice')}}</option>
                                            <option @if($popup->type == 'only_image') selected @endif value="only_image">{{__('Only Image')}}</option>
                                            <option @if($popup->type == 'promotion') selected @endif value="promotion">{{__('Promotion')}}</option>
                                            <option @if($popup->type == 'discount') selected @endif value="discount">{{__('Discount')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{__('Description')}}</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$popup->description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="offer_time_end">{{__('Offer End Date')}}</label>
                                        <input type="date" class="form-control datepicker"  id="offer_time_end" name="offer_time_end" value="{{$popup->offer_time_end}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_status"><strong>{{__('Button Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" @if($popup->btn_status) checked @endif name="btn_status" id="btn_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="button_text">{{__('Button Text')}}</label>
                                        <input type="text" class="form-control"  id="button_text" name="button_text" value="{{$popup->button_text}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="button_link">{{__('Button Link')}}</label>
                                        <input type="text" class="form-control"  id="button_link" name="button_link" value="{{$popup->button_link}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="background_image">{{__('Background Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $pop_bg_img = get_attachment_image_by_id($popup->background_image,'thumbnail',true);
                                                @endphp
                                                @if (!empty($pop_bg_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{$pop_bg_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="hidden" name="background_image" value="{{$popup->background_image}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 700x400')}}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                @php
                                                    $pop_img = get_attachment_image_by_id($popup->only_image,'thumbnail',true);
                                                @endphp
                                                @if (!empty($pop_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb" src="{{$pop_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="hidden" name="image" value="{{$popup->only_image}}">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 350x350')}}</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Popup')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            showHideFields($('#popup_type').val());
            $(document).on('change','#popup_type',function (e) {
                e.preventDefault();
                var el = $(this);
                var type = el.val();
                showHideFields(type);
            });
            function showHideFields(type) {
                if(type == 'notice'){
                    $('label[for="image"]').parent().hide();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                    $('label[for="background_image"]').parent().hide();
                    $('label[for="button_text"]').parent().hide();
                    $('label[for="button_link"]').parent().hide();
                    $('label[for="btn_status"]').parent().hide();
                    $('label[for="offer_time_end"]').parent().hide();

                }else if(type == 'only_image'){
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().hide();
                    $('label[for="button_text"]').parent().hide();
                    $('label[for="button_link"]').parent().hide();
                    $('label[for="btn_status"]').parent().hide();
                    $('label[for="offer_time_end"]').parent().hide();
                    $('label[for="description"]').parent().hide();
                    $('label[for="title"]').parent().hide();
                }else if(type == 'promotion'){
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().show();
                    $('label[for="button_text"]').parent().show();
                    $('label[for="button_link"]').parent().show();
                    $('label[for="btn_status"]').parent().show();
                    $('label[for="offer_time_end"]').parent().hide();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                }else{
                    $('label[for="image"]').parent().show();
                    $('label[for="background_image"]').parent().show();
                    $('label[for="button_text"]').parent().show();
                    $('label[for="button_link"]').parent().show();
                    $('label[for="btn_status"]').parent().show();
                    $('label[for="offer_time_end"]').parent().show();
                    $('label[for="description"]').parent().show();
                    $('label[for="title"]').parent().show();
                }
            }
        });     
        })(jQuery);
        
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
