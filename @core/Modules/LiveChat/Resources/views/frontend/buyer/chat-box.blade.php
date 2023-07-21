<div id="chat_box" class="chat_box pull-right" style="display: none">
    <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-comment"></span>
                        <span class="img-text">
                            <img class="user-image-avater" src="{{ asset('assets/frontend/img/static/user_profile.png') }}" alt="img"> <i class="chat-user"></i>
                        </span>
                    </h3>
                    <span class="glyphicon glyphicon-remove las la-times pull-right close-chat"></span>
                </div>
                <div class="panel-body chat-area">
                </div>
                <div class="panel-footer">
                    <div class="footer-panel-input-flex">
                        <form method="post" enctype="multipart/form-data" class="upload-frm" data-to-user-prefix="buyer" >
                            <input type="file" name="image" class="image" accept="image/png, image/gif, image/jpeg"  />
                        </form>
                        <div class="input-group form-controls">
                            <div class="chat-text-area-warp">
                                <textarea class="form-control input-sm chat_input" placeholder="{{__('Write your message here...')}}"></textarea>
                                <button class="btn btn-primary btn-sm btn-chat chat_send_message_paper_button" type="button" data-to-user="" data-to-user-prefix="buyer" disabled>
                                        <i class="las la-paper-plane"></i>
                                </button>
                            </div>
                            <div class="chat_button_group">
                                <button type="button" class="btn btn-default btn-sm upload-btn">
                                    <i class="las la-image"></i>
                                </button>
                                <button type="button" id="chat_emoji_button" class="emoji-btn btn btn-primary btn-sm btn-chat">&#128512;</button>
                            </div>
                        </div>
                    </div>

                    <div class="emoji-list" id="live_chat_widget_emoji_wrapper">
                        <ul>
                            <li><a href="javascript:void(0);" class="emoji">&#128512;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128513;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128514;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128515;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128516;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128517;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128518;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128519;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128520;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128521;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128522;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128523;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128524;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128525;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128526;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128527;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128528;</a></li>
                            <li><a href="javascript:void(0);" class="emoji">&#128529;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    <input type="hidden" class="to_user_id" value="" />
</div>
