
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Reviews')); ?>

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
                <?php if($services->count() >= 1): ?>
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('Service Reviews')); ?> </h2>
                            </div>
                        </div>
                    </div>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <div class="dash-left-service">
                                <div class="dashboard-services">
                                    <div class="dashboar-flex-services">
                                        <div class="thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($data->image,'','thumb'); ?>>
                                        </div>
                                        <div class="thumb-contents">
                                            <h4 class="title"> <a href="javascript:void(0)"> <?php echo e($data->title); ?> </a> </h4>
                                            <span class="service-review"> <i class="las la-star"></i>
                                                 <?php echo e(round(optional($data->reviews)->avg('rating'),1)); ?>  
                                                 <b>(<?php echo e(optional($data->reviews)->count()); ?>)</b> 
                                            </span>
                                            <span class="service-review style-02"> <i class="las la-eye"></i> <?php echo e($data->view); ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-righ-service">
                                <div class="dashboard-switch-flex-content">
                                    <div class="dashboard-switch-single text-center">
                                        <span class="dashboard-starting"> <?php echo e(__('Reviews:')); ?> </span>
                                        <h2 class="title-price color-3"> <?php echo e(optional($data->reviews)->count()); ?> </h2>
                                    </div>

                                    <div class="dashboard-switch-single text-center">
                                        <a href="<?php echo e(route('service.review.all',$data->id)); ?>"> 
                                            <span class="service-review style-02"> <i class="las la-eye"></i> </span> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            <?php echo $services->links(); ?>

                        </div>
                    </div>

                </div>
                <?php else: ?> 
                <h2 class="no_data_found"><?php echo e(__('No Reviews Found')); ?></h2>
                <?php endif; ?>
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

                $(document).on('change','.service_on_off_btn',function(e){
                    e.preventDefault();
                    if($(this).is(':checked')){
                        var service_id = $(this).data('id');
                        $.ajax({                                                  
                            method:'post',
                            url:"<?php echo e(route('seller.services.on.of')); ?>",
                            data:{service_id:service_id},
                            success:function(res){
                                if(res.status=='success'){
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success('Service On Success---');
                                }
                            }
                        });              
                    }else{
                        var service_id = $(this).data('id');
                        $.ajax({                                                  
                            method:'post',
                            url:"<?php echo e(route('seller.services.on.of')); ?>",
                            data:{service_id:service_id},
                            success:function(res){
                                if(res.status=='success'){
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success('Service Off Success---');
                                }
                            }
                        }); 
                    }

                });


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
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/service-reviews.blade.php ENDPATH**/ ?>