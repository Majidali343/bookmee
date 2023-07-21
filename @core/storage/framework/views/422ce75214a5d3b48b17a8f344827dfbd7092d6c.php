
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Reviews')); ?>

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
                        <div class="col-md-6">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"><?php echo e(__('All Reviews')); ?></h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-wrapper margin-top-50 text-right">
                                <a href="<?php echo e(route('seller.service.review')); ?>" class="cmn-btn btn-bg-1"> <?php echo e(__('Go Back' )); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $service_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-12 col-lg-6">
                            <div class="dashboard-reviews">
                                <div class="about-review-tab">
                                    <div class="about-seller-flex-content flex-start padding-top-40">
                                        <div class="about-seller-thumb">
                                            <?php echo render_image_markup_by_attachment_id(optional($review->buyer)->image,'','thumb'); ?>

                                        </div>
                                        <div class="about-seller-content">
                                            <h5 class="title"> 
                                                <a href="javascript:void(0)"> <?php echo e($review->name); ?> </a>
                                                
                                            </h5>
                                            <div class="about-seller-list">
                                                <span class="icon">
                                                    <?php echo e(__('Rating:')); ?> 
                                                    <?php echo e($review->rating); ?> 
                                                    <i class="las la-star"></i>
                                                </span>
                                            </div>
                                            <p class="about-review-para"><?php echo e($review->message); ?></p>
                                            <span class="review-date"><?php echo e($review->created_at->diffForHumans()); ?> </span>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            <?php echo $service_reviews->links(); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>  


<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                        Swal.fire({
                        title: '<?php echo e(__("Are you sure?")); ?>',
                        text: '<?php echo e(__("You would not be able to revert this item!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                        });
                    });

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/service-all-reviews.blade.php ENDPATH**/ ?>