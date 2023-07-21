$(document).on('click','#bulk_delete_btn',function (e) {
    e.preventDefault();

    var bulkOption = $('#bulk_option').val();
    var allCheckbox =  $('.bulk-checkbox:checked');
    var allIds = [];
    allCheckbox.each(function(index,value){
        allIds.push($(this).val());
    });
    if(allIds != '' && bulkOption == 'delete'){
        $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i><?php echo e(__("Deleting")); ?>');
        $.ajax({
            'type' : "POST",
            'url' : "<?php echo e($url); ?>",
            'data' : {
                _token: "<?php echo e(csrf_token()); ?>",
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
    if( value == true){
        allChek.prop('checked',true);
    }else{
        allChek.prop('checked',false);
    }
});<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/bulk-action-js.blade.php ENDPATH**/ ?>