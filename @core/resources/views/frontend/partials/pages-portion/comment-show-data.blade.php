<ul class="comment-list">
    @foreach($blogComments as $key => $data)
        <li>
            <div class="single-comment-wrap">
                <div class="thumb">
                    {!! render_image_markup_by_attachment_id(optional($data->user)->image ?? get_static_option('single_blog_page_comment_avatar_image')) !!}
                </div>
                <div class="content">
                    <div class="content-top">
                        <div class="left">
                            <h4 class="title" data-parent_name="{{optional($data->user)->name }}">{{optional($data->user)->name ?? ''}}</h4>
                            <ul class="post-meta">
                                <li class="meta-item">
                                    <a href="#">
                                        <i class="las la-calendar icon"></i>
                                        {{date('d F Y', strtotime($data->created_at ?? ''))}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @if(auth('web')->check() && auth('web')->id() != $data->user_id)
                        <div class="right">
                            <a href="#" data-comment_id="{{ $data->id }}" class="reply-btn"><i class="las la-reply"></i> {{__('Reply')}}</a>
                        </div>
                        @endif

                    </div>
                    <p class="comment">{!! $data->comment_content ?? '' !!}</p>
                </div>
            </div>
        </li>
        @foreach($data->reply as $repData)
            <li class="has-children">
                <div class="single-comment-wrap">
                    <div class="thumb">
                        {!! render_image_markup_by_attachment_id($repData->user->image ?? get_static_option('single_blog_page_comment_avatar_image')) !!}
                    </div>
                    <div class="content">
                        <div class="content-top">
                            <div class="left">
                                <h4 class="title">{{$repData->user->name ?? ''}}</h4>
                                <ul class="post-meta">
                                    <li class="meta-item">
                                        <a href="#">
                                            <i class="las la-calendar icon"></i>
                                            {{date('d F Y', strtotime($repData->created_at ?? ''))}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="comment">{!! $repData->comment_content ?? '' !!}</p>
                    </div>
                </div>
            </li>
        @endforeach

    @endforeach
</ul>
