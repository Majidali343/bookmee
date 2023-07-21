(function () {
    "use strict";

    const currentUrl = window.location.href;

    (function () {

        var lastScrollTop = 0;
        var scrollEvery = 0;
        var noMoreMessages = false;
        var alreadyLoadedLatestMessages = false;

        $(document).on("click", ".chat-toggle", function (e) {
            e.preventDefault();
            var ele = $(this);
            var user_id = ele.attr("data-id");
            var username = ele.attr("data-user");
            var user_image = ele.attr("data-user_image");

            // Js For Mobile Device Start
            $('#col-lg-4-item').hide();
            console.log(username)
            openChatBox(user_id, username, function () {
                var chatBox = $("#chat_box_" + user_id);
                if (!chatBox.hasClass("chat-opened")) {
                    chatBox.addClass("chat-opened").slideDown("fast");

                    if (!alreadyLoadedLatestMessages) {
                        loadLatestMessages(chatBox, user_id, $(".btn-chat").attr("data-to-user-prefix"), function (response) {
                            // alreadyLoadedLatestMessages = true;
                        });
                    }

                    chatBox.find(".chat-area").animate({
                        scrollTop: chatBox.find(".chat-area").outerHeight(true)
                    }, 800, 'swing');
                }
            });

            $("#chat_box_" + user_id).find(".panel-title .img-text img").attr("src", user_image);
        }); // on close chat close the chat box but don't remove it from the dom

        $(document).on("click", ".close-chat", function (e) {
            $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
            $(".open-button").removeClass("open-btn")
            $("#myForm").removeClass("popup-chat");
            $('#col-lg-4-item').show();
        }); // on click the btn send the message

        $(document).on("click", ".btn-chat.chat_send_message_paper_button", function (e) {
            if($('.chat-text-area-warp textarea').val() != ''){
                let chatButton = $(".btn-chat.chat_send_message_paper_button");
                $(this).html('<i class="las la-spinner la-spin"></i>');
                chatButton.attr('disabled',true);
                send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(".chat_input").val(), null, $(this).attr('data-to-user-prefix'));
            }
        });
        $(document).on("keypress", ".chat-text-area-warp textarea", function (e) {
            if(e.key == 'Enter' && !e.shiftKey && $(this).val()  != '' && $(window).width() > 991){
                let chatButton = $(".btn-chat.chat_send_message_paper_button");
                chatButton.html('<i class="las la-spinner la-spin"></i>');
                chatButton.attr('disabled',true);
                send(chatButton.attr('data-to-user'), $("#chat_box_" + chatButton.attr('data-to-user')).find(".chat_input").val(), null, chatButton.attr('data-to-user-prefix'));
            }

        });

        $(document).on("click", ".emoji", function (e) {
            e.preventDefault();
            var textinput = $(this).parents(".chat-opened").find(".chat_input");
            textinput.val(textinput.val() + $(this).text());
            $(this).parents(".chat-opened").find(".btn-chat");
            $(".btn-chat.chat_send_message_paper_button").prop("disabled", false);
        });

        $(document).on("click", ".upload-btn", function () {
            $(this).html('<i class="las la-spinner la-spin"></i>');
            $(this).parents(".panel-footer").find(".image").trigger("click");
        });
        $(document).on("change", ".image", function () {
            $(this).parent(".upload-frm").submit();
        });

        $(document).on("submit", ".upload-frm", function (e) {
            e.preventDefault();
            send($(this).parents(".chat-opened").find('.to_user_id').val(), null, $(this).find('.image')[0].files[0], $(this).attr('data-to-user-prefix') );
        }); // on change chat input text toggle the chat btn disabled state

        $(document).on("change keyup", ".chat_input", function (e) {
            if ($(this).val() != "") {
                $(this).parents(".form-controls").find(".btn-chat.chat_send_message_paper_button").prop("disabled", false);
            } else {
                $(this).parents(".form-controls").find(".btn-chat.chat_send_message_paper_button").prop("disabled", true);
            }
        }); // handle the scroll top of any chat box
        // the idea is to load the last messages by date depending on last message
        // that's already loaded on the chat box

        $(document).on("scroll", ".chat-area", function (e) {
            var _this = this;

            if (noMoreMessages) {
                return;
            }

            var st = $(this).scrollTop();

            if (st < lastScrollTop) {
                scrollEvery += 1;

                if (scrollEvery % 10 == 0) {
                    fetchOldMessages($(this).parents(".chat-opened").find(".to_user_id").val(), $(this).find(".msg_container:first-child").attr("data-message-id"), $(".btn-chat").attr("data-to-user-prefix"), function (response) {
                        noMoreMessages = response.no_more_messages;

                        if (noMoreMessages) {
                            var chatArea = $(_this).parents(".chat-opened").find(".chat-area");
                            chatArea.prepend(noMoreTemplate());
                            setTimeout(function () {
                                chatArea.find(".no-more-messages").remove();
                            }, 1500);
                        }
                    });
                }
            }

            lastScrollTop = st;
        });

        // here listen for pusher events
        setTimeout(() => {
            let current_user_id = $("#current_user").val();
            window.Echo.private(`chat-message.${current_user_id}`)
                .listen('.message.sent', (e) => {
                    displayReceiverMessage(e.message);
                });
        }, 200);


    })();

    function openChatBox(user_id, username, callback) {
        if ($("#chat_box_" + user_id).length == 0) {
            var cloned = $("#chat_box").clone(true); // change cloned box id;

            cloned.attr("id", "chat_box_" + user_id);
            cloned.find(".chat-user").text(username);
            cloned.find(".btn-chat").attr("data-to-user", user_id);
            cloned.find(".to_user_id").val(user_id);

            let id = "chat_box_" + user_id;
            let html = cloned.html();
            $("#chat-overlay").html(`<div id="` + id + `" class="chat_box pull-right" style="display: none">` + html + `</div>`);
        }

        $("#chat_box_" + user_id).show();

        if (callback) {
            callback();
        }
    }

    /**
     * send message function
     *
     * @param to_user
     * @param message
     */


    function send(to_user, message, file, prefix = 'seller') {
        var chat_box = $("#chat_box_" + to_user);
        var chat_area = chat_box.find(".chat-area");
        var formData = new FormData();
        formData.append("to_user", to_user);
        formData.append("_token", $("meta[name='csrf-token']").attr("content"));
        formData.append("message", message);
        formData.append("image", file);
        $.ajax({
            url: window.base_url + "/" + prefix + "/send",
            data: formData,
            method: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            beforeSend: function beforeSend() {
                if (chat_area.find(".loader").length == 0) {
                    chat_area.append(loaderHtml());
                }
            },
            success: function success(response) {
                displaySenderMessage(response.message);
            },
            complete: function complete() {
                chat_area.find(".loader").remove();
                chat_box.find(".btn-chat.chat_send_message_paper_button").prop("disabled", true);
                chat_box.find(".chat_input").val("");
                //todo scroll down to last height
                var chatBox = $("#chat_box_" + to_user);
                chat_box.find(".btn-chat.chat_send_message_paper_button").html('<i class="las la-paper-plane"></i>')
                chat_box.find(".upload-btn").html('<i class="las la-image"></i>')

                chatBox.find(".chat-area").animate({
                    scrollTop: chatBox.find(".chat-area")[0].scrollHeight
                }, 800, 'swing');
            }
        });
    }

    function loaderHtml() {
        return "<i class=\"glyphicon glyphicon-refresh loader\"></i>";
    }

    /**
     * display message on the sender side
     *
     * @param message
     */


    function displaySenderMessage(message) {
        if ($("#current_user").val() == message.from_user.id) {
            var messageLine = getMessageSenderTemplate(message);
            $("#chat_box_" + message.to_user.id).find(".chat-area").append(messageLine);
        }
    }

    /**
     * display message on the receiver side
     *
     * @param message
     */


    function displayReceiverMessage(message) {
        if ($("#current_user").val() == message.to_user.id) {
            var alert_sound = document.getElementById("chat-alert-sound");
            alert_sound.play(); // for the receiver user check if the chat box is already opened otherwise open it

            openChatBox(message.from_user.id, message.from_user.name, function () {
                var chatBox = $("#chat_box_" + message.from_user.id);

                if (!chatBox.hasClass("chat-opened")) {
                    chatBox.addClass("chat-opened").slideDown("fast");
                    loadLatestMessages(chatBox, message.from_user.id, $(".btn-chat").attr("data-to-user-prefix"));
                    chatBox.find(".chat-area").animate({
                        scrollTop: chatBox.find(".chat-area")[0].scrollHeight
                    }, 800, 'swing');
                } else {
                    if ($("#message-line-" + message.id).length == 0) {
                        var messageLine = getMessageReceiverTemplate(message); // append the message for the receiver user
                        $("#chat_box_" + message.from_user.id).find(".chat-area").append(messageLine);
                        chatBox.find(".chat-area").animate({
                            scrollTop: chatBox.find(".chat-area")[0].scrollHeight
                        }, 800, 'swing');
                    }
                }
            });
        }
    }

    /**
     * loadLatestMessages
     *
     */

    function loadLatestMessages(container, user_id, prefix = 'seller') {
        var callback = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
        var chat_area = container.find(".chat-area");
        chat_area.html(""); 
        $.ajax({
            url: window.base_url + "/" + prefix + "/load-latest-messages",
            data: {
                user_id: user_id,
                // _token: $("meta[name='csrf-token']").attr("content")
            },
            method: "GET",
            dataType: "json",
            beforeSend: function beforeSend() {
                if (chat_area.find(".loader").length == 0) {
                    chat_area.html(loaderHtml());
                }
            },
            success: function success(response) {
                if (response.state == 1) {
                    response.messages.map(function (val, index) {
                        $(val).appendTo(chat_area);
                    });

                    if (callback) {
                        callback(response);
                    }
                    var chatBox = $("#chat_box_" + user_id);
                    //todo animate
                    chatBox.find(".chat-area").animate({
                        scrollTop: chatBox.find(".chat-area")[0].scrollHeight
                    }, 800, 'swing');
                }
            },
            complete: function complete() {
                chat_area.find(".loader").remove();
            }
        });
    }

    /**
     * fetchOldMessages
     *
     * this function load the old messages if scroll up triggerd
     */


    function fetchOldMessages(to_user, old_message_id, prefix = 'seller') {
        var callback = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
        var chat_box = $("#chat_box_" + to_user);
        var chat_area = chat_box.find(".chat-area");
        $.ajax({
            url: window.base_url + "/" + prefix + "/fetch-old-messages",
            data: {
                to_user: to_user,
                old_message_id: old_message_id,
                _token: $("meta[name='csrf-token']").attr("content")
            },
            method: "GET",
            dataType: "json",
            beforeSend: function beforeSend() {
                if (chat_area.find(".loader").length == 0) {
                    chat_area.prepend(loaderHtml());
                }
            },
            success: function success(response) {
                response.messages.map(function (val, index) {
                    $(chat_area).prepend(val);
                });

                if (callback) {
                    callback(response);
                }
            },
            complete: function complete() {
                chat_area.find(".loader").remove();
            }
        });
    }

    /**
     * getMessageSenderTemplate
     *
     * this is the message template for the sender
     *
     * @param message
     * @returns {string}
     */
    let image = '                                                                                       '

    function getMessageSenderTemplate(message) {
        var body = getMessageBody(message);
        return "\n   <div class=\"row conversation-wrapper-flex msg_container base_sent\" data-message-id=\"".concat(message.id, "\" id=\"message-line-").concat(message.id, "\">\n    <div class=\"conversation-message-contents\">\n   <div class=\"messages msg_sent text-right\">\n  ").concat(body, "\n  <time datetime=\"").concat(message.date_time_str, "\"> ").concat(message.from_user.name, " \u2022 ").concat(message.date_human_readable, ` </time>\n            </div>\n        </div>\n        <div class=\"conversation-bg-thumb bg-image\">\n ` + message.profile_image + ` \n        </div>\n  </div>\n    `);
    }

    /**
     * getMessageReceiverTemplate
     *
     * this is the message template for the receiver
     *
     * @param message
     * @returns {string}
     */


    function getMessageReceiverTemplate(message) {
        var body = getMessageBody(message);
        return ` <div class="row conversation-wrapper-flex msg_container base_receive" data-message-id="` + message.id + `"` + `id="message-line-` + message.id + `"><div class="conversation-bg-thumb bg-image">` + message.sender_profile_image + `</div>` + `<div class="conversation-message-contents"><div class="messages msg_receive text-left"> ` + body + `<time datetime="` + message.date_time_str + `">` +
            message.from_user.name + `\u2022 ` + message.date_human_readable + ` </time></div></div></div>`;
    }

    function getMessageBody(message) {
        var content = '';

        if (message.message) {
            content = '<p style="color:#333">' + message.message + '</p>';
        } else if (message.image) {
            content = '<div style="width: 100%;"><img class="img-responsive style="width: 70px; height:70px;" src="' + message.image_url + '" /></div>';
        }

        return content;
    }

    function noMoreTemplate() {
        return "<div class=\"no-more-messages text-center\">No more messages</div>";
    }

})();


