@extends('backend.admin-master')
@section('site-title')
    {{__('Media Images Settings')}}
@endsection
@section('style')
    <x-media.css/>
    <style>
        .media-image-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .media-image-header h2 {
            font-size: 26px;
            line-height: 30px;
        }
        .media-uploader-image-list.media-page{
            width: 100%;
            max-height: 100%;
        }
        .attachment-preview {
            position: relative;
            box-shadow: inset 0 0 15px rgb(0 0 0 / 10%), inset 0 0 0 1px rgb(0 0 0 / 5%);
            background: #eee;
            cursor: pointer;
            width: 100px;
            height: 100px;
        }
        .media-uploader-image-info {
            padding: 20px;
            display: inline-block;
            width: 100%;
        }
        .img-alt-wrap input {
            width: calc(100% - 60px);
        }
        .display-none{
            display: none;
        }
    </style>
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
                        <div class="media-image-header">
                            <h3>{{__('Media Images')}}</h3>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#media_image_upload_modal">{{__('Add New Image')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <ul class="media-uploader-image-list media-page">
                                    @foreach($all_media_images as $image)
                                        <li
                                            data-date="{{$image->updated_at}}"
                                            data-imgid="{{$image->id}}"
                                            data-imgsrc="{{asset('assets/uploads/media-uploader/'.$image->path)}}"
                                            data-size="{{$image->size}}"
                                            data-dimension="{{$image->dimensions}}"
                                            data-title="{{$image->title}}"
                                            data-alt="{{$image->alt}}"
                                        >
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        {!! render_image_markup_by_attachment_id($image->id,'','thumb') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-2">
                                <div class="img-sticky-wrap" >
                                    <div class="media-uploader-image-info" id="media-uploader-image-info">
                                        <div class="img-wrapper">
                                            <img src="" alt="">
                                        </div>
                                        <div class="img-info">
                                            <h5 class="img-title"></h5>
                                            <ul class="img-meta display-none">
                                                <li class="date"></li>
                                                <li class="dimension"></li>
                                                <li class="size"></li>
                                                <li class="image_id display-none"></li>
                                                <li class="imgsrc"></li>
                                                <li class="imgalt">
                                                    <div class="img-alt-wrap">
                                                        <input type="text" name="img_alt_tag">
                                                        <button class="btn btn-success img_alt_submit_btn"><i class="fas fa-check"></i></button>
                                                    </div>
                                                </li>
                                            </ul>
                                            <form method="post" action="{{route('admin.upload.media.file.delete')}}" class="delete_image_form display-none">
                                                @csrf
                                                <input type="hidden" name="img_id" id="info_image_id_input">
                                                <button type="submit" class=" btn btn-lg btn-danger btn-sm mb-3 mr-1"><i class="ti-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="media_image_upload_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Upload Images')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">{{__('Reload the page to see latest uploaded images')}}</div>
                    <div class="dropzone-form-wrapper">
                        <form action="{{route('admin.upload.media.file')}}" method="post" class="dropzone" enctype="multipart/form-data">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
  <x-media.markup/>
@endsection
@section('script')
    <x-media.js/>
    <script>
        (function($){
        "use strict";
        
        $(document).ready(function (){
            $(window).on('scroll',function (e){
                var scrolltop = $(window).scrollTop();
                var mtop = scrolltop - 400;
                if (scrolltop > 450){
                    $('#media-uploader-image-info').css({marginTop: mtop+'px'});
                }else{
                    $('#media-uploader-image-info').css({marginTop: '0px'});
                }
            });
        });
        })(jQuery);
    </script>
@endsection
