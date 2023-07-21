<script>

        $(document).on('click','.login_to_chat',function(e){
            e.preventDefault()
            let user_login_email = $('#user_login_email').val();
            let user_login_password = $('#user_login_password').val();
            let el = $(this);
            el.text("{{__('Please wait')}}")
            if(user_login_email == '' || user_login_password == ''){
                $('.error_message').html('<p class="text-danger">{{__("Please fill both field")}}</p>');
            }
            $.ajax({
                url:"{{ route('chat.user.login') }}",
                method:"post",
                data:{user_login_email:user_login_email, user_login_password:user_login_password},
                success:function (res){
                    if(res.status == 'login'){
                        location.reload();
                    }
                    if(res.status == 'not_ok'){
                        el.text("{{__('Login')}}")
                        $('.error_message').html('<p class="text-danger">{{__("Invalid email or password")}}</p>');
                    }
                },
                error:function(response){
                    el.text("{{__('Login')}}")
                }
            });
        })

        $(document).on('click','.open-button', function(){
            $(this).toggleClass("open-btn")
            $("#myForm").toggleClass("popup-chat");
        });

        $(document).on('click','#chat_emoji_button', function(){
            $('#live_chat_widget_emoji_wrapper').toggleClass("show");
            $(this).attr('disabled',false);
        });

        $(document).on('click','.chat-showing-item .emoji-list.show ul > li', function(){
            $('.chat-showing-item .emoji-list').removeClass("show");
        });

        function minimizeForm() {
            $(".open-button").removeClass("open-btn")
            $("#myForm").removeClass("popup-chat");
        }


        $(document).on('keyup','.input-name-search-field',function(e){
            let search_text = $('#chat_name_search_text').val();
            $.ajax({
                url:"{{ route('chat.name.search') }}",
                method:'get',
                data:{search_text:search_text},
                success:function(res){
                    if(res.status == 'success') {
                        $('.seller_container').html(res.seller_container);
                    }
                    if(res.status == 'nothing') {
                        $('.seller_container').html('<h4>' + res.msg + '</h4>');
                    }
                }
            });
        });

    </script>
    <script>
        window.base_url = "{{url('/')}}";
        var pc_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    <script src="//js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{asset('./@core/public/js/app.js')}}"></script>