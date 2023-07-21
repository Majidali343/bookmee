
<?php $__env->startSection('style'); ?>
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
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content-inner margin-top-30">
        <div class="row">
            <div class="col-lg-12">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="<?php echo e(route('admin.profile.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="username"><?php echo e(__('Username')); ?></label>
                                <input type="text" class="form-control" readonly value="<?php echo e(auth()->user()->username); ?> ">
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="<?php echo e(auth()->user()->name); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?php echo e(auth()->user()->email); ?> ">
                            </div>
                            
                              <div class="form-group">
                                <label for="email"><?php echo e(__('Designation')); ?></label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                       value="<?php echo e(auth()->user()->designation); ?> ">
                            </div>

                            <div class="form-group">
                                <label for="email"><?php echo e(__('Description')); ?></label>

                                <textarea class="form-control" name="description" cols="5"><?php echo e(auth()->user()->description); ?></textarea>
                            </div>
                            <div class="form-group">
                                <?php $image_upload_btn_label = __('Upload Image'); ?>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $profile_img = get_attachment_image_by_id(auth()->user()->image,null,true);
                                        ?>
                                        <?php if(!empty($profile_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($profile_img['img_url']); ?>" alt="<?php echo e(auth()->user()->name); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $image_upload_btn_label = __('Change Image'); ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="image" value="<?php echo e(auth()->user()->image); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Profile Picture')); ?>" data-modaltitle="<?php echo e(__('Upload Profile Picture')); ?>" data-imgid="<?php echo e(auth()->user()->image); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e(__($image_upload_btn_label)); ?>

                                    </button>
                                </div>
                                <small class="info-text"><?php echo e(__('Recommended Image Size 100x100. Only Accept: jpg,png.jpeg. Size less than 2MB')); ?></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
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
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/auth/admin/edit-profile.blade.php ENDPATH**/ ?>