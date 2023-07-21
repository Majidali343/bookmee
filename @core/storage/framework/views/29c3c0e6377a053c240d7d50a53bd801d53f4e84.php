
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Change Password')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner margin-top-30">
        <div class="row">
            <div class="col-lg-12">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('admin.password.change')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="old_password"><?php echo e(__('Old Password')); ?></label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                       placeholder="<?php echo e(__('Old Password')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo e(__('New Password')); ?></label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="<?php echo e(__('New Password')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation" placeholder="<?php echo e(__('Confirm Password')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/auth/admin/change-password.blade.php ENDPATH**/ ?>