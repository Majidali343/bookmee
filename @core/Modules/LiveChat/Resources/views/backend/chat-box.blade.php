<div class="chat-popup" id="myForm">
    <div class="conversation-container">


        <div class="chat-showing-person">
            <ul class="user-profile-chat margin-top-30" id="users">
                @foreach($buyers as $buyer)
                    @foreach($messages as $message)
                        @if($message->fromUser->user_type === 0)
                            <li>
                                <h5 class="chat-author-title">
                                    <span class="chat-author-title-image"> {!! render_image_markup_by_attachment_id(optional($message->fromUser)->image) !!} </span>
                                    <span class="chat-author-title-name">{{ optional($message->fromUser)->name }} <small> {{ $message->created_at->diffForHumans() }}  </small></span>
                                </h5>
                                <div class="chat-author-message-image">
                                    @if($message->message)
                                        <p class="chat-author-text-message heading-color" >{!! $message->message !!}</p>
                                    @elseif($message->image)
                                        <div class="chat-author-message-image-send">
                                            <img class="img-responsive" src="{{asset(('assets/uploads/chat_image/'.$message->image))}}" />
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endif
                        @if($message->fromUser->user_type === 1)
                            <li class="chat-message-reverse">
                            <h5 class="chat-author-title">
                                <span class="chat-author-title-image"> {!! render_image_markup_by_attachment_id(optional($message->fromUser)->image) !!} </span>
                                <span class="chat-author-title-name">{{ optional($message->fromUser)->name }} <small> {{ $message->created_at->diffForHumans() }}  </small></span>
                            </h5>
                            <div class="chat-author-message-image">
                                @if($message->message)
                                    <p class="chat-author-text-message heading-color" >{!! $message->message !!}</p>
                                @elseif($message->image)
                                    <div class="chat-author-message-image-send">
                                        <img class="img-responsive" src="{{asset(('assets/uploads/chat_image/'.$message->image))}}" />
                                    </div>
                                @endif
                            </div>
                        </li>
                         @endif
                @endforeach
                @endforeach
            </ul>
        </div>



    </div>
</div>
