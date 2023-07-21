@extends('backend.admin-master')
@section('site-title')
    {{__('Blog Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Blog Page Settings')}}</h4>
                        <form action="{{route('admin.blog.page')}}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="blog_page_item">{{__('Post Item')}}</label>
                                <input type="text" class="form-control"  id="blog_page_item" value="{{get_static_option('blog_page_item')}}" name="blog_page_item" placeholder="{{__('Post Item')}}">
                                <small class="text-danger">{{__('Enter how many post you want to show in blog page')}}</small>
                            </div>


                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Blog Page Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
