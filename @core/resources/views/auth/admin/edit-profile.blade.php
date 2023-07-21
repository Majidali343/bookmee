@extends('backend.admin-master')
@section('style')
    <x-media.css/>
@endsection
@section('site-title')
    {{__('Edit Profile')}}
@endsection
@section('content')
    <div class="main-content-inner margin-top-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        @include('backend.partials.error')
                        <form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="username">{{__('Username')}}</label>
                                <input type="text" class="form-control" readonly value="{{auth()->user()->username}} ">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{auth()->user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{auth()->user()->email}} ">
                            </div>
                            
                              <div class="form-group">
                                <label for="email">{{__('Designation')}}</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                       value="{{auth()->user()->designation}} ">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Description')}}</label>

                                <textarea class="form-control" name="description" cols="5">{{ auth()->user()->description }}</textarea>
                            </div>
                            <div class="form-group">
                                @php $image_upload_btn_label = __('Upload Image'); @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $profile_img = get_attachment_image_by_id(auth()->user()->image,null,true);
                                        @endphp
                                        @if (!empty($profile_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$profile_img['img_url']}}" alt="{{auth()->user()->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            @php $image_upload_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="image" value="{{auth()->user()->image}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Profile Picture')}}" data-modaltitle="{{__('Upload Profile Picture')}}" data-imgid="{{auth()->user()->image}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small class="info-text">{{__('Recommended Image Size 100x100. Only Accept: jpg,png.jpeg. Size less than 2MB')}}</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<x-media.markup/>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <x-media.js/>
@endsection
