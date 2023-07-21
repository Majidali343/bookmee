@extends('frontend.frontend-page-master')


@section('site-title')
    {{ $blog_post->title }}
@endsection

@section('page-title')
    <?php 
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>  
    {{ ucfirst($page_info) }}
@endsection 

@section('inner-title')
    {{ $blog_post->title}}
@endsection 

@section('page-meta-data')
    <title>{{ $blog_post->title }}</title>
    {!!  render_page_meta_data($blog_post) !!}
@endsection

@section('content')
    <!-- Blog Details area starts -->
    <section class="blog-details-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-wrapper">
                        <div class="single-blog-details">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($blog_post->image,'','large') !!}
                            </div>
                            <ul class="tags">
                                <li class="list">
                                    <a href="javascript:void(0)"> <i class="las la-clock"></i> {{ optional($blog_post->created_at)->diffForHumans() }} </a>
                                </li>
                                <li class="list">
                                    <a href="{{ route('frontend.blog.category',optional($blog_post->category)->slug) }}"> <i class="las la-tag"></i> {{ optional($blog_post->category)->name }} </a>
                                </li>
                            </ul>
                            <p class="details-para">{!! $blog_post->blog_content!!}</p>
                            <blockquote>
                                <div class="content">
                                    <h3 class="blackquote-title">{{ $blog_post->excerpt }}</h3>
                                </div>
                            </blockquote>
                        </div>
                        <!-- Details Tag area starts -->
                        <div class="details-tag-area padding-top-10">
                            <div class="row align-items-center">
                                <div class="col-lg-6 margin-top-30">
                                    <div class="social-share">
                                        <h4 class="share-tiitle">{{ get_static_option('blog_share_title') ?? __('Share:') }} </h4>
                                        <ul>
                                            {!! single_post_share(route('frontend.blog.single',['id'=>$blog_post->id, 'slug'=> $blog_post->slug]),$blog_post->title,$blog_post->image) !!}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 margin-top-30">
                                    <div class="tag-list">
                                        <h4 class="tag-tiitle">{{ get_static_option('blog_tag_title') ?? __(' Tags:') }} </h4>
                                        <ul>
                                            @foreach($tags as $tag)
                                            <li>
                                                @foreach(json_decode($tag->tag_name) as $tag_name)
                                                <a href="{{ route('frontend.blog.tags',$tag_name) }}">{{ $tag_name }}</a>
                                                @endforeach
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details Tag area end -->

                      <!-- Related Blog area starts -->
                      <div class="related-blog-area padding-top-100">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title-two">
                                        <h3 class="title">{{ get_static_option('related_blog_title') ?? __('Related Blog') }} </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row padding-top-20">
                                @if(!empty($related_blog))
                                    @foreach($related_blog as $blog)
                                    <div class="col-lg-4 col-md-6 margin-top-30">
                                        <div class="single-blog no-margin wow fadeInUp" data-wow-delay=".2s">
                                            <a href="{{ route('frontend.blog.single',$blog->slug) }}" class="blog-thumb service-bg-thumb-format" {!! render_background_image_markup_by_attachment_id($blog->image) !!}>

                                            </a>
                                            <div class="blog-contents">
                                                <ul class="tags">
                                                    <li>
                                                        <a href="javascript:void(0)"> <i class="las la-clock"></i>{{ optional($blog_post->created_at)->diffForHumans() }} </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('frontend.blog.category',optional($blog->category)->slug) }}"> <i class="las la-tag"></i>{{ optional($blog->category)->name }} </a>
                                                    </li>
                                                </ul>
                                                <h5 class="common-title"> <a href="{{ route('frontend.blog.single',$blog->slug) }}"> {{ $blog->title }} </a> </h5>
                                                <p class="common-para">{!! Str::words(strip_tags($blog->blog_content),20)  !!} </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Related Blog area ends -->

                        <!-- Comment area Starts -->
                        <div class="comment-area padding-top-100">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="section-title-two">
                                            <h3 class="title">{{ get_static_option('blog_comment_title') ?? __('Post Your Comments') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 padding-top-20">
                                       @if(Auth::guard('web')->check())
                                        <form action="" class="blog_comment_form" method="post">
                                            @csrf 
                                            <input type="hidden" value="{{ $blog_post->id }}" name="blog_id" id="blog_id">
                                            
                                            <div class="details-comment-content">
                                                <div class="comments-flex-item">
                                                    <div class="single-commetns">
                                                        <label class="comment-label">{{ get_static_option('blog_comment_name_title') ?? __('Your Name*') }} </label>
                                                        <input type="text" class="form--control" name="name" id="name"
                                                        value="{{ Auth::guard('web')->user()->name ?? '' }}"
                                                         placeholder="{{ __('Type Name') }}">
                                                    </div>
                                                    <div class="single-commetns">
                                                        <label class="comment-label"> {{ get_static_option('blog_comment_email_title') ?? __('Email Address*') }} </label>
                                                        <input type="text" class="form--control" name="email" id="email"
                                                        value="{{ Auth::guard('web')->user()->email ?? '' }}"
                                                         placeholder="{{ __('Type Email') }}">
                                                    </div>
                                                </div>
                                                <div class="single-commetns">
                                                    <label class="comment-label"> {{ get_static_option('blog_comment_message_title') ?? __('Comments*') }} </label>
                                                    <textarea name="message" id="message" class="form--control form--message" placeholder="{{ __('Post Comments') }}"></textarea>
                                                </div>
                                                <button type="submit">{{ get_static_option('blog_comment_button_title') ?? __('Post Comments') }} </button>
                                            </div>
                                        </form>
                                        @else 
                                        <a class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#commentModal">{{ __('Sign in for comment') }}</a>
                                        @endif

                                        @foreach($blog_post->comments as $comment)
                                            <div class="comment-show-contents padding-top-30">
                                                <div class="about-seller-flex-content style-03">
                                                    <div class="about-seller-thumb">
                                                        <a href="javascript:void(0)"> 
                                                            {!! render_image_markup_by_attachment_id(optional($comment->user)->image,'','thumb') !!}
                                                        </a>
                                                    </div>
                                                    <div class="about-seller-content">
                                                        <h5 class="title"> <a href="javascript:void(0)"> {{ $comment->name }} </a> </h5>
                                                        <p class="about-review-para">{{ $comment->message }}</p>
                                                        <span class="review-date">{{ optional($comment->created_at)->diffForHumans() }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Comment area ends -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="display:block">
                <h5 class="modal-title" id="commentModalLabel">{{ __('Sign In For Comment') }}</h5>
                <p class="login_error_msg text-danger"></p>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.blog.comment.signin') }}" method="post">
                        <div class="form-group">
                            <label for="username">{{ __('User Name') }}</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary" id="login_form_for_comment">{{ __('Sign In') }}</button>
                </div>
            </div>
            </div>
        </div>

    </section>
    <!-- Blog Details area end -->
@endsection

@section('scripts')
<script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('submit','.blog_comment_form',function(e){
                    e.preventDefault();
                    let blog_id = $('#blog_id').val();
                    let name = $('#name').val();
                    let email = $('#email').val();
                    let message = $('#message').val();

                    $.ajax({
                        url:"{{ route('frontend.blog.comment') }}",
                        method:"post",
                        data:{
                            blog_id:blog_id,
                            name:name,
                            email:email,
                            message:message,
                        },
                        success:function(res){
                            if (res.status == 'success') {
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "100",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "show",
                                    "hideMethod": "hide"
                                };
                                toastr.success('Success!! Thanks For Comments---');
                            }
                            $('.blog_comment_form')[0].reset();
                        }
                    });
                })

                $(document).on('click','#login_form_for_comment',function (e){
                e.preventDefault();
                $.ajax({
                    url: "{{route('frontend.blog.comment.signin')}}",
                    type: "POST",
                    data: {
                        username : $('#username').val(),
                        password : $('#password').val(),
                    },
                    success:function (data){
                        if (data.status == 'success'){
                            location.reload();
                        }
                        if (data.status == 'error'){
                            $('.login_error_msg').text(data.msg);
                        }
                    }
                });
            });


            });
        })(jQuery);
    </script>
@endsection
