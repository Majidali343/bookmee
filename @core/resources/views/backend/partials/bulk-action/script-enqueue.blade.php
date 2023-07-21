<script>
(function($){
"use strict";
$(document).ready(function (){
    //start bulk action js
    $(document).on('click','#bulk_delete_btn',function (e) {
        e.preventDefault();
        var bulkOption = $('#bulk_option').val();
        var allCheckbox =  $('.bulk-checkbox:checked');
        var allIds = [];
        allCheckbox.each(function(index,value){
            allIds.push($(this).val());
        });
        if(allIds != '' && bulkOption == 'delete'){
            $(this).text('{{__('Deleting...')}}');
            $.ajax({
                'type' : "POST",
                'url' : "{{route('admin.popup.builder.bulk.action')}}",
                'data' : {
                    _token: "{{csrf_token()}}",
                    ids: allIds
                },
                success:function (data) {
                    location.reload();
                }
            });
        }

    });

    $('.all-checkbox').on('change',function (e) {
        e.preventDefault();
        var value = $('.all-checkbox').is(':checked');
        var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
        //have write code here fr
        if( value == true){
            allChek.prop('checked',true);
        }else{
            allChek.prop('checked',false);
        }
    });
    //end bulk action js
});
        
})(jQuery);   
</script>