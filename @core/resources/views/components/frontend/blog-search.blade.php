
    $(document).on('keyup','#search',function (e){
        e.preventDefault();
        $('a#tag_view_all').show();

        let el_val = $(this).val()

        let link = $('#tag_view_all').data('url');
        $('#tag_view_all').attr('href', link + '?term=' + el_val);

        $.ajax({
            type: 'get',
            url :  "{{ route('frontend.blog.autocomplete.search') }}",
            data: {
                query: $(this).val()
            },
            beforeSend: function (){
                $('.ajax-preloader-wrap').parent().find('.form-btn-2 i').addClass('fa-spinner fa-spin').removeClass('fa-search')
            },
            success: function (data){
            
                $('#show-autocomplete ul').html('');
                if($('#search').val() != '' && data != ''){
                    $('#show-autocomplete ul').html(data);
                    $('#show-autocomplete').show();
                }else{
                    $('#show-autocomplete').hide();
                    $('#tag_view_all').hide();
                }


                $('.ajax-preloader-wrap').parent().find('.form-btn-2 i').removeClass('fa-spinner fa-spin').addClass('fa-search')
            },
            error: function (res){

            }
        });
        
        
        $(document).on('click','#search_icon_up',function(e){
            e.preventDefault();
             $('#show-autocomplete').hide();
              $('#tag_view_all').hide();
            
        });
    });
