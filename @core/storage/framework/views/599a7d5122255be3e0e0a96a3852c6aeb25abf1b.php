
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Admin Commission')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Admin Commission')); ?> </h4>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="<?php if(!empty($commission)): ?><?php echo e(route('admin.commission.update',$commission->id)); ?> <?php else: ?> <?php echo e(route('admin.commission.update')); ?> <?php endif; ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="commission_charge_type"><?php echo e(__('System Type')); ?></label>
                                    <select name="system_type"  class="form-control">
                                        <option value=""><?php echo e(__('Select Type')); ?></option>
                                        <option value="commission" <?php if(!empty($commission) && $commission->system_type=='commission'): ?>  selected <?php endif; ?>><?php echo e(__('Commission')); ?></option>
                                        <option value="subscription" <?php if(!empty($commission) && $commission->system_type=='subscription'): ?>  selected <?php endif; ?>><?php echo e(__('Subscription')); ?></option>
                                    </select>
                                </div>
                                <?php if(!empty($commission) && $commission->system_type=='commission'): ?>
                                <div class="form-group">
                                    <label for="commission_charge_type"><?php echo e(__('Commission Type')); ?></label>
                                    <select name="commission_charge_type"  class="form-control">
                                         <option value="amount" <?php if(!empty($commission) && $commission->commission_charge_type=='amount'): ?>  selected <?php endif; ?>><?php echo e(__('Amount')); ?></option> 
                                         <option value="percentage" <?php if(!empty($commission) && $commission->commission_charge_type=='percentage'): ?>  selected <?php endif; ?>><?php echo e(__('Percentage')); ?></option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="commission_charge"><?php echo e(__('Commission Charge')); ?></label>
                                    <input type="text" name="commission_charge" <?php if(!empty($commission)): ?> value="<?php echo e($commission->commission_charge); ?>" <?php else: ?> value="10" <?php endif; ?> class="form-control">
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/pages/admin-commission/admin-commission-all.blade.php ENDPATH**/ ?>