
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Profile Verify')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
    .single-dashboard-input .attachment-preview {
    width: 500px;
    height: 500px;
}
</style>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
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

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.seller-buyer-preloader','data' => []]); ?>
<?php $component->withName('frontend.seller-buyer-preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                <?php echo $__env->make('frontend.user.seller.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="dashboard-right">
                    <div class="profile-dashboards">
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div class="edit-profile">
                                    <div class="profile-info-dashboard">
                                        <h2 class="dashboards-title"> <?php echo e(__('Profile Verify')); ?> </h2>
                                        <div class="notice-board">
                                            <p class="text-danger"><?php echo e(__('Submit your original documents so that the admin can verify you. Once verified a badge will show in your profile that increase your order possibility')); ?></p>
                                        </div>
                                            <?php if(!is_null($seller_verify_info) && $seller_verify_info->status === 1): ?>
                                            <div class="alert alert-success"><?php echo e(__('Profile Verified')); ?></div>
                                        <?php else: ?>
                                        <div class="dashboard-profile-flex">
                                            <div class="dashboard-address-details">
                                            
                                                <div class="mt-5"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?> </div>

                                                <form action="<?php echo e(route('seller.profile.verify')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        <?php echo render_image_markup_by_attachment_id(optional($seller_verify_info)->national_id ?? '','','large'); ?>

                                                                    </div>
                                                                    <input type="hidden" id="national_id" name="national_id"
                                                                           value="<?php echo e(optional($seller_verify_info)->national_id ?? ''); ?>">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Your National ID')); ?>

                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                                <br>
                                                                <small class="text-danger"><?php echo e(__('recomended size 740x504')); ?></small>
                                                            </div>
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        <?php echo render_image_markup_by_attachment_id(optional($seller_verify_info)->address ?? '','','large'); ?>

                                                                    </div>
                                                                    <input type="hidden" id="address" name="address"
                                                                           value="<?php echo e(optional($seller_verify_info)->address ?? ''); ?>">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Your Address Document')); ?>

                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small> 
                                                                <br>
                                                                <small class="text-danger"><?php echo e(__('recomended size 740x504')); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="btn-wrapper margin-top-35">
                                                        <button type="submit" class="btn cmn-btn btn-bg-1"><?php echo e(__('Send Verify Request')); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <!-- Dashboard area end -->
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php $__env->stopSection(); ?>    
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/profile-verify/seller-profile-verify.blade.php ENDPATH**/ ?>