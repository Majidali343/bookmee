@extends('backend.admin-master')

@section('site-title')
    {{__('Edit Brand')}}
@endsection

@section('style')
    <x-media.css/>
@endsection

@section('content')
    <div class="col-lg-6 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Edit Brand')}} </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.brand')}}">{{__('All Brands')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.brand.edit',$brand->id )}}" method="post">
                            @csrf
                            <div class="tab-content margin-top-40">
                                <div class="form-group">
                                    <label for="title">{{__('Brand Title')}}</label>
                                    <input type="text" class="form-control" name="title" value="{{ $brand->title  }}"  placeholder="{{__('Title')}}">
                                </div>
                                <div class="form-group">
                                    <label for="url">{{__('Brand Url')}}</label>
                                    <input type="text" class="form-control" name="url" value="{{ $brand->url  }}" placeholder="{{__('Url')}}">
                                </div>
                                <div class="form-group ">
                                    <label for="image">{{__('Upload Brand Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Image')}}
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

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
 <x-media.js/>
@endsection

