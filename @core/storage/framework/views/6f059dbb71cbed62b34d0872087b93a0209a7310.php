

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Details Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4"><?php echo e(__("Service Details Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.service.details.settings.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="service_details_overview_title"><?php echo e(__('Service Details Overview Title')); ?></label>
                                <input type="text" name="service_details_overview_title"  class="form-control" value="<?php echo e(get_static_option('service_details_overview_title')); ?>" id="service_details_overview_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_about_seller_title"><?php echo e(__('Service Details About Seller Title')); ?></label>
                                <input type="text" name="service_details_about_seller_title"  class="form-control" value="<?php echo e(get_static_option('service_details_about_seller_title')); ?>" id="service_details_about_seller_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_review_title"><?php echo e(__('Service Details Review Title')); ?></label>
                                <input type="text" name="service_details_review_title"  class="form-control" value="<?php echo e(get_static_option('service_details_review_title')); ?>" id="service_details_review_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_what_you_get"><?php echo e(__('Service Details What You Get')); ?></label>
                                <input type="text" name="service_details_what_you_get"  class="form-control" value="<?php echo e(get_static_option('service_details_what_you_get')); ?>" id="service_details_what_you_get">
                            </div>
                            <div class="form-group">
                                <label for="service_details_benifits_title"><?php echo e(__('Service Details Benifits')); ?></label>
                                <input type="text" name="service_details_benifits_title"  class="form-control" value="<?php echo e(get_static_option('service_details_benifits_title')); ?>" id="service_details_benifits_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_another_service_title"><?php echo e(__('Service Details Another Service Of This Seller')); ?></label>
                                <input type="text" name="service_details_another_service_title"  class="form-control" value="<?php echo e(get_static_option('service_details_another_service_title')); ?>" id="service_details_another_service_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_explore_all_title"><?php echo e(__('Service Details Explore All Title')); ?></label>
                                <input type="text" name="service_details_explore_all_title"  class="form-control" value="<?php echo e(get_static_option('service_details_explore_all_title')); ?>" id="service_details_explore_all_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_package_title"><?php echo e(__('Service Details Package Title')); ?></label>
                                <input type="text" name="service_details_package_title"  class="form-control" value="<?php echo e(get_static_option('service_details_package_title')); ?>" id="service_details_package_title">
                            </div>
                            <div class="form-group">
                                <label for="service_details_package_subtitle"><?php echo e(__('Service Details Package Subtitle')); ?></label>
                                <input type="text" name="service_details_package_subtitle"  class="form-control" value="<?php echo e(get_static_option('service_details_package_subtitle')); ?>" id="service_details_package_subtitle">
                            </div>
                            <div class="form-group">
                                <label for="service_details_button_title"><?php echo e(__('Service Details Button Title')); ?></label>
                                <input type="text" name="service_details_button_title"  class="form-control" value="<?php echo e(get_static_option('service_details_button_title')); ?>" id="service_details_button_title">
                            </div>
                            <div class="form-group">
                                <label for="service_reviews_title"><?php echo e(__('Service Reviews Title')); ?></label>
                                <input type="text" name="service_reviews_title"  class="form-control" value="<?php echo e(get_static_option('service_reviews_title')); ?>" id="service_reviews_title">
                            </div>
                            <div class="form-group">
                                <label for="service_post_reviews_title"><?php echo e(__('Service Post Reviews Title')); ?></label>
                                <input type="text" name="service_post_reviews_title"  class="form-control" value="<?php echo e(get_static_option('service_post_reviews_title')); ?>" id="service_post_reviews_title">
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/pages/services/service-details-settings.blade.php ENDPATH**/ ?>