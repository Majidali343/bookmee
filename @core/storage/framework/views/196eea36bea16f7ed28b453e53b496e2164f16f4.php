<?php  $value = ($value)?? ''; ?>
<div class="form-group">
    <label for="<?php echo e($name); ?>"><?php echo e($title); ?></label>
    <select name="<?php echo e($name); ?>"  class="form-control">
        <option <?php if($value === 'publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
        <option <?php if($value === 'draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?></option>
    </select>
</div><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/fields/status.blade.php ENDPATH**/ ?>