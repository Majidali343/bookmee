

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Blog Details Settings')); ?>

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
                        <h4 class="header-title mb-4"><?php echo e(__("Blog Details Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.blog.details.settings.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="blog_share_title"><?php echo e(__('Blog Share Title')); ?></label>
                                <input type="text" name="blog_share_title"  class="form-control" value="<?php echo e(get_static_option('blog_share_title')); ?>" id="blog_share_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_tag_title"><?php echo e(__('Blog Tags Title')); ?></label>
                                <input type="text" name="blog_tag_title"  class="form-control" value="<?php echo e(get_static_option('blog_tag_title')); ?>" id="blog_tag_title">
                            </div>
                            <div class="form-group">
                                <label for="related_blog_title"><?php echo e(__('Related Blog Title')); ?></label>
                                <input type="text" name="related_blog_title"  class="form-control" value="<?php echo e(get_static_option('related_blog_title')); ?>" id="related_blog_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_title"><?php echo e(__('Blog Comment Title')); ?></label>
                                <input type="text" name="blog_comment_title"  class="form-control" value="<?php echo e(get_static_option('blog_comment_title')); ?>" id="blog_comment_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_name_title"><?php echo e(__('Blog Comment Name Title')); ?></label>
                                <input type="text" name="blog_comment_name_title"  class="form-control" value="<?php echo e(get_static_option('blog_comment_name_title')); ?>" id="blog_comment_name_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_email_title"><?php echo e(__('Blog Comment Email Title')); ?></label>
                                <input type="text" name="blog_comment_email_title"  class="form-control" value="<?php echo e(get_static_option('blog_comment_email_title')); ?>" id="blog_comment_email_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_message_title"><?php echo e(__('Blog Comment Message Title')); ?></label>
                                <input type="text" name="blog_comment_message_title"  class="form-control" value="<?php echo e(get_static_option('blog_comment_message_title')); ?>" id="blog_comment_message_title">
                            </div>
                            <div class="form-group">
                                <label for="blog_comment_button_title"><?php echo e(__('Blog Comment Button Title')); ?></label>
                                <input type="text" name="blog_comment_button_title"  class="form-control" value="<?php echo e(get_static_option('blog_comment_button_title')); ?>" id="blog_comment_button_title">
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/pages/blog/blog-details-settings.blade.php ENDPATH**/ ?>