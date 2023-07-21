<a tabindex="0" class="btn btn-info btn-xs btn-sm mr-1 swal_status_change text-white"><?php echo e(__('Approve')); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
<input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/order-complete-request-approve.blade.php ENDPATH**/ ?>