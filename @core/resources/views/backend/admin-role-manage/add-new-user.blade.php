@extends('backend.admin-master')
@section('site-title')
    {{__('Add New Admin')}}
@endsection
@section('style')
<x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Admin')}}</h4>
                        <x-msg.success/>
                        <x-msg.error/>
                        <form action="{{route('admin.new.user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{__('Username')}}</label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="{{__('Username')}}">
                                <small class="text text-danger">{{__('Remember this username, user will login using this username')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                            </div>
                            
                              <div class="form-group">
                                <label for="email">{{__('Designation')}}</label>
                                <input type="text" class="form-control"  id="designation" name="designation" placeholder="{{__('Designation')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Description')}}</label>
                               <textarea class="form-control" cols="5" name="description" id="description"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">{{__('Password')}}</label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="{{__('Password')}}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{__('Password Confirm')}}</label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="{{__('Password Confirmation')}}">
                            </div>
                            <div class="form-group">
                                <label for="role">{{'Role'}}</label>
                                <select name="role" class="form-control">
                                    <option value="">{{__('Select Role')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="site_favicon">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image = get_attachment_image_by_id(get_static_option('image'),null,true);
                                            $image_btn_label = __( 'Upload Image');
                                        @endphp
                                        @if (!empty($image))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$image['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $image_btn_label = __('Change Image'); @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" id="image" name="image" value="{{get_static_option('image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New User')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
    <x-media.js/>
@endsection
