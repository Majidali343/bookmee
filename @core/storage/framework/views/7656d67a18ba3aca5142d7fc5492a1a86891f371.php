<?php if($status === 'draft'): ?>
    <span class="alert alert-primary" ><?php echo e(__('Draft')); ?></span>
<?php elseif($status === 'pending'): ?>
    <span class="alert alert-warning" ><?php echo e(__('Pending')); ?></span>
<?php elseif($status === 'complete'): ?>
    <span class="alert alert-success" ><?php echo e(__('Complete')); ?></span>
<?php elseif($status === 'close'): ?>
    <span class="alert alert-danger" ><?php echo e(__('Close')); ?></span>
<?php elseif($status === 'in_progress'): ?>
    <span class="alert alert-info" ><?php echo e(__('In Progress')); ?></span>
<?php elseif($status === 'archive'): ?>
    <span class="alert alert-info" ><?php echo e(__('Archive')); ?></span>
<?php elseif($status === 'schedule'): ?>
    <span class="alert alert-warning" ><?php echo e(__('Schedule')); ?></span>
<?php elseif($status === 'publish'): ?>
    <span class="alert alert-success" ><?php echo e(__('Publish')); ?></span>
<?php elseif($status === 'confirm'): ?>
    <span class="alert alert-success" ><?php echo e(__('Confirm')); ?></span>
<?php elseif($status === 'yes'): ?>
    <span class="alert alert-success" ><?php echo e(__('Yes')); ?></span>
<?php elseif($status === 'no'): ?>
    <span class="alert alert-danger" ><?php echo e(__('No')); ?></span>
<?php elseif($status === 'cancel'): ?>
    <span class="alert alert-danger" ><?php echo e(__('Cancel')); ?></span>
<?php endif; ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/components/status-span.blade.php ENDPATH**/ ?>