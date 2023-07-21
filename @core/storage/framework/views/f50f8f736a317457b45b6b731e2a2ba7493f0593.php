
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Account Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .btn-bg-4{
            background-color: #E80000FF !important;
            color: #f0f0f0;
        }
    </style>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('Account Settings')); ?> </h2>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
                    
                    <div class="row align-items-center">
                        <div class="col-lg-6 margin-top-30">

                            <form action="<?php echo e(route('seller.account.settings')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="single-settings">
                                    <h4 class="input-title"> <?php echo e(__('Change Password')); ?> </h4>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> <?php echo e(__('Current Password*')); ?> </label>
                                            <input class="form--control" type="password" name="current_password" id="current_password" placeholder="<?php echo e(__('Current Password')); ?>">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> <?php echo e(__('New Password*')); ?> </label>
                                            <input class="form--control" type="password" name="new_password" id="new_password" placeholder="<?php echo e(__('New Password')); ?>">
                                        </div>
                                    </div>
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label class="info-title"> <?php echo e(__('Re-Type Password*')); ?> </label>
                                            <input class="form--control" type="password" name="confirm_password" id="confirm_password" placeholder="<?php echo e(__('Retype Password')); ?>">
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-40">
                                        <button class="cmn-button btn-bg-1" type="submit"> <?php echo e(__('Update Password')); ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <?php if(empty($user)): ?>
                            <div class="col-lg-6 margin-top-30">
                                <form action="<?php echo e(route('seller.account.deactive')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="single-settings">
                                        <h4 class="input-title"> <?php echo e(__('Deactivate or Delete Account')); ?> </h4>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Choose Reason*')); ?> </label>
                                                <select name="reason" id="reason" class="delete_reason_title">
                                                    <option value="For Vacation"><?php echo e(__('For Vacation')); ?></option>
                                                    <option value="Personal Reasons"><?php echo e(__('Personal Reasons')); ?></option>
                                                    <option value="Others"><?php echo e(__('Others')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="single-dashboard-input">
                                            <div class="single-info-input margin-top-30">
                                                <label class="info-title"> <?php echo e(__('Short Description*')); ?> </label>
                                                <textarea class="form--control textarea--form account_detactive_description pass_description_data" name="description" id="description" placeholder="<?php echo e(__('Describe Your Reason')); ?>"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-wrapper margin-top-40">
                                                    <button class="cmn-button btn-bg-3" type="submit"> <?php echo e(__('Deactivate Account')); ?> </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="btn-wrapper margin-top-40">
                                                    <button type="button" class="cmn-button btn-bg-4" data-toggle="modal" data-target="#accountDeleteModal">
                                                        <?php echo e(__('Delete Account')); ?>

                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <?php endif; ?>

                        <?php if(!empty($user)): ?>
                        <?php if($user->status === 0): ?>
                            <div class="col-lg-6 margin-top-30 text-lg-center text-left">
                                <a  class="cmn-button btn-bg-3" href="<?php echo e(route('seller.account.deactive.cancel',$user->user_id)); ?>"> <?php echo e(__('Activate Your Account')); ?></a> <br>
                                <small><?php echo e(__('Currently your account is deactivated. You can activate from here. ')); ?></small>
                            </div>
                        <?php else: ?>
                        <div class="col-lg-6 margin-top-30 text-lg-center text-left">
                                <a  class="cmn-button btn-bg-4" href="#" > <?php echo e(__('Already Delete Account')); ?></a> <br>
                                <small><?php echo e(__('Your account has been deleted')); ?></small>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- Account Delete Modal -->
    <div class="modal fade" id="accountDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?php echo e(route('seller.account.delete')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="description"  class="delete_desc" id="delete_desc">
            <input type="hidden" name="reason"  class="choose_delete_reason_title" id="choose_delete_reason_title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Delete Account')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <h4 class="text-danger text-center"><b><?php echo e(__('Are You sure?')); ?></b></h4>
                      <h4 class="text-danger text-center"><?php echo e(__('Delete Your Account!')); ?></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger"><?php echo e(__('Submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        // Account Delete Description
        $(document).on('keyup','.pass_description_data',function(){
            let delete_info = $(this).val();
            $('#delete_desc').val(delete_info);
        });
        // Account Delete reason title
        $(document).on('change','.delete_reason_title',function(){
            let reason_title = $(this).val();
            $('#choose_delete_reason_title').val(reason_title);

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/profile/seller-account-settings.blade.php ENDPATH**/ ?>