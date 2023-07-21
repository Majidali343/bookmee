@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Admin')}}
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
                       <div class="header-wrap d-flex justify-content-between mb-4">
                           <h4 class="header-title">{{__('Edit Admin')}}</h4>
                           <div class="btn-wrapper">
                               <a class="btn btn-secondary" href="{{route('admin.all.user')}}">{{__("All Admin")}}</a>
                           </div>
                       </div>
                        @include('backend/partials/message')
                        @include('backend/partials/error')
                        <form action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$admin->id}}">
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  value="{{$admin->name}}" name="name" placeholder="{{__('Enter name')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control"  value="{{$admin->email}}" name="email" placeholder="{{__('Email')}}">
                            </div>
                            
                                 <div class="form-group">
                                <label for="email">{{__('Designation')}}</label>
                                <input type="text" class="form-control"  value="{{$admin->designation}}" name="designation" placeholder="{{__('Designation')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Description')}}</label>
                               <textarea class="form-control" cols="5" name="description" id="description"> {!! $admin->description !!} </textarea>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="role">{{'Role'}}</label>
                                <select name="role" class="form-control">
                                    <option value="">{{__('Select Role')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role}}" @if(in_array($role,$adminRole)) selected @endif>{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="site_favicon">{{__('Image')}}</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $image = get_attachment_image_by_id($admin->image,null,true);
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
                                    <input type="hidden" id="image" name="image" value="{{$admin->image}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($image_btn_label)}}
                                    </button>
                                </div>
                                <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                            </div>
                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update')}}</button>
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
    <script>
      <x-btn.update/>
    </script>
@endsection
