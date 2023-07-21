@extends('backend.admin-master')

@section('site-title')
    {{__('Blog Details Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">{{__("Blog Details Settings")}}</h4>
                        <form action="{{route('admin.blog.details.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="blog_share_title">{{__('Blog Share Title')}}</label>
                                <input type="text" name="blog_share_title"  class="form-control" value="{{get_static_option('blog_share_title')}}" id="blog_share_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_tag_title">{{__('Blog Tags Title')}}</label>
                                <input type="text" name="blog_tag_title"  class="form-control" value="{{get_static_option('blog_tag_title')}}" id="blog_tag_title">
                            </div>
                            <div class="form-group">
                                <label for="related_blog_title">{{__('Related Blog Title')}}</label>
                                <input type="text" name="related_blog_title"  class="form-control" value="{{get_static_option('related_blog_title')}}" id="related_blog_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_title">{{__('Blog Comment Title')}}</label>
                                <input type="text" name="blog_comment_title"  class="form-control" value="{{get_static_option('blog_comment_title')}}" id="blog_comment_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_name_title">{{__('Blog Comment Name Title')}}</label>
                                <input type="text" name="blog_comment_name_title"  class="form-control" value="{{get_static_option('blog_comment_name_title')}}" id="blog_comment_name_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_email_title">{{__('Blog Comment Email Title')}}</label>
                                <input type="text" name="blog_comment_email_title"  class="form-control" value="{{get_static_option('blog_comment_email_title')}}" id="blog_comment_email_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_message_title">{{__('Blog Comment Message Title')}}</label>
                                <input type="text" name="blog_comment_message_title"  class="form-control" value="{{get_static_option('blog_comment_message_title')}}" id="blog_comment_message_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_button_title">{{__('Blog Comment Button Title')}}</label>
                                <input type="text" name="blog_comment_button_title"  class="form-control" value="{{get_static_option('blog_comment_button_title')}}" id="blog_comment_button_title">
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
