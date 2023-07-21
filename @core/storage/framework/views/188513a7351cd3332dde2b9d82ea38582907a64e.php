


<?php $__env->startSection('page-meta-data'); ?>
<?php echo render_site_title($page_post->meta_title ?? $page_post->title); ?>

<!-- Primary Meta Tags -->
<meta name="title" content="<?php echo e(optional($page_post->meta_data)->meta_title); ?>">
<meta name="description" content="<?php echo e(optional($page_post->meta_data)->meta_description); ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(Illuminate\Support\Facades\URL::current()); ?>">
<meta property="og:title" content="<?php echo e(optional($page_post->meta_data)->meta_title); ?>">
<meta property="og:description" content="<?php echo e(optional($page_post->meta_data)->meta_description); ?>">
<?php echo render_og_meta_image_by_attachment_id(optional($page_post->meta_data)->facebook_meta_image); ?>


<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(Illuminate\Support\Facades\URL::current()); ?>">
<meta property="twitter:title" content="<?php echo e(optional($page_post->meta_data)->meta_title); ?>">
<meta property="twitter:description" content="<?php echo e(optional($page_post->meta_data)->meta_description); ?>">
<?php echo render_twitter_meta_image_by_attachment_id(optional($page_post->meta_data)->twitter_meta_image); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
<?php echo e(optional(getPageDetailsFromSlug('service_list_page'))->title); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('site-title'); ?>
<?php echo e(optional(getPageDetailsFromSlug('service_list_page'))->title); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>

    <!-- Category Service area starts -->
    <section class="category-services-slider dot-style-one dot-color-01 slick-initialized slick-slider slick-dotted padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">

                <?php if(!empty($all_services)): ?>
                    <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="<?php echo e(route('service.list.details',$service->slug)); ?>" class="service-thumb service-bg-thumb-format" <?php echo render_background_image_markup_by_attachment_id($service->image); ?>>

                                    <?php if($service->featured == 1): ?>
                                    <div class="award-icons">
                                        <i class="las la-award"></i>
                                    </div>
                                    <?php endif; ?>
                                </a>
                                <div class="services-contents">
                                    <ul class="author-tag">
                                        <li class="tag-list">
                                            <a href="<?php echo e(route('about.seller.profile',optional($service->seller)->username)); ?>">
                                                <div class="authors">
                                                    <div class="thumb">
                                                        <?php echo render_image_markup_by_attachment_id(optional($service->seller)->image); ?>

                                                        <span class="notification-dot"></span>
                                                    </div>
                                                    <span class="author-title"> <?php echo e(optional($service->seller)->name); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <?php if($service->reviews->count() >= 1): ?>
                                        <li class="tag-list">
                                            <a href="javascript:void(0)">
                                                <span class="icon"><?php echo e(__('Rating:')); ?></span>
                                                <span class="reviews"> 
                                                    <?php echo e(round(optional($service->reviews)->avg('rating'),1)); ?>

                                                    (<?php echo e(optional($service->reviews)->count()); ?>)
                                                </span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <h5 class="common-title"> <a href="<?php echo e(route('service.list.details',$service->slug)); ?>"> <?php echo e(Str::limit($service->title)); ?> </a> </h5>
                                    <p class="common-para"> <?php echo e(Str::limit(strip_tags($service->description,100))); ?> </p>
                                    <div class="service-price">
                                        <span class="starting"> <?php echo e(__('Starting at')); ?> </span>
                                        <span class="prices"> <?php echo e(amount_with_currency_symbol($service->price)); ?> </span>
                                    </div>
                                    <div class="btn-wrapper d-flex flex-wrap">
                                        <a href="<?php echo e(route('service.list.book',$service->slug)); ?>" class="cmn-btn btn-small btn-bg-1"> <?php echo e(__('Book Now')); ?> </a>
                                        <a href="<?php echo e(route('service.list.details',$service->slug)); ?>" class="cmn-btn btn-small btn-outline-1 ml-auto"> <?php echo e(__('View Details')); ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($all_services->count() >= 6): ?>
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    <?php echo $all_services->links(); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Category Service area end -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/services/service-static.blade.php ENDPATH**/ ?>