<a tabindex="0" class="btn btn-info btn-xs btn-sm mr-1 swal_status_change_order_cancel text-white"><?php echo e(__('Cancel Order')); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn_cancel_order d-none"></button>
</form><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/cancel-order.blade.php ENDPATH**/ ?>