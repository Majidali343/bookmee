<a tabindex="0" class="btn btn-danger btn-xs mb-3 mr-1 swal_delete_all_lang_data_button" data-toggle="tooltip" title="Delete All Lang Data">
 <?php if(isset($type)): ?> <i class="las la-trash"></i> <?php else: ?> <i class="las la-trash"></i> <?php endif; ?>
</a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
<input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/delete-popover-all-lang.blade.php ENDPATH**/ ?>