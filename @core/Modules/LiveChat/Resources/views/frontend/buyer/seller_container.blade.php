<ul class="user-profile-chat margin-top-30" id="users">
    @foreach($sellers as $seller)
        <li>
            <a href="javascript:void(0);" class="chat-toggle"data-id="{{ optional($seller->seller)->id }}"data-user="{{ optional($seller->seller)->name }}">
                <div class="chat-bg bg-image" {!! render_background_image_markup_by_attachment_id(optional($seller->seller)->image) !!}> <span class="notification-dot active"></span> </div>
                <h4 class="chat-author-title"> {{ optional($seller->seller)->name  }} </h4>
            </a>
        </li>
    @endforeach
</ul>
