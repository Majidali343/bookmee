
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Profile')); ?>

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
                        <div class="col-lg-12 margin-top-40">
                            <div class="dashboard-profile">
                                <div class="dashboard-profile-all">
                                    <div class="thumb-ad">
                                        <?php if(!empty(Auth::guard('web')->user()->profile_background)): ?>
                                            <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->profile_background); ?>

                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/frontend/img/static/ads.jpg')); ?>" alt="ads">
                                        <?php endif; ?>

                                    </div>
                                    <div class="profile-info-dashboard margin-top-40">
                                        <div class="profile-btn-flex">
                                            <h2 class="dashboards-title"> <?php echo e(__('Profile Information')); ?> </h2>
                                            <div class="btn-wrapper">
                                                <a href="<?php echo e(route('seller.profile.edit')); ?>" class="cmn-btn btn-bg-1">
                                                    <?php echo e(__('Edit Profile')); ?> </a>
                                            </div>
                                        </div>
                                        <div class="dashboard-profile-detail margin-top-40">
                                            <div class="dashboard-profile-flex">
                                                <div class="thumbs">
                                                    <?php if(!is_null(Auth::guard('web')->user()->image)): ?>
                                                        <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/frontend/img/static/user_profile.png')); ?>"
                                                            alt="No Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="dashboard-address-details">
                                                    <ul class="details-list">
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Name:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(Auth::guard('web')->user()->name); ?> </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Email:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(Auth::guard('web')->user()->email); ?> </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Phone:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(Auth::guard('web')->user()->phone); ?> </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('City:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(optional(optional(Auth::guard('web')->user())->city)->service_city); ?>

                                                            </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Area:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(optional(optional(Auth::guard('web')->user())->area)->service_area); ?>

                                                            </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Country:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(optional(optional(Auth::guard('web')->user())->country)->country); ?>

                                                            </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Post Code:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(Auth::guard('web')->user()->post_code); ?> </span>
                                                        </li>
                                                        <li class="lists">
                                                            <span class="list-span"> <?php echo e(__('Address:')); ?> </span>
                                                            <span class="list-strong">
                                                                <?php echo e(Auth::guard('web')->user()->address); ?> </span>
                                                        </li>
                                                    </ul>
                                                    <?php if(Auth::guard('web')->user()->about != null): ?>
                                                        <ul class="details-list column-count-one">
                                                            <li class="lists">
                                                                <span class="list-span"> <?php echo e(__('About:')); ?> </span>
                                                                <span class="list-strong">
                                                                    <?php echo e(Auth::guard('web')->user()->about); ?> </span>
                                                                <span class="para"> </span>
                                                            </li>
                                                        </ul>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <h3>Gallery</h3>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php echo render_gallery_image_attachment_preview(Auth::guard('web')->user()->profile_gallery ?? ''); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        img.avatar.user-thumb {
            margin: 10px;
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        .img-wrap {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
    <!-- Dashboard area end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/profile/seller-profile.blade.php ENDPATH**/ ?>