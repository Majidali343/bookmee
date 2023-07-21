<a tabindex="0" class="btn btn-danger btn-xs <?php echo e($class ?? 'mb-3'); ?> mr-1 swal_delete_button" data-toggle="tooltip" title="Delete">
    <i class="ti-trash"></i>
</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
<input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/delete-popover.blade.php ENDPATH**/ ?>