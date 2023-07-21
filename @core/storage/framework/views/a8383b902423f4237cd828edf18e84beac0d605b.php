
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
    <?php echo $page_post->title; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('nav-style'); ?>
    <?php echo e($page_post->navbar_variant); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if($page_post->page_builder_status === 'on'): ?>

        <?php if(!auth()->guard('web')->check() && $page_post->visibility === 'all'): ?>
            <?php echo $__env->make('frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(auth()->guard('web')->check()): ?>
            <?php echo $__env->make('frontend.partials.pages-portion.dynamic-page-builder-part',['page_post' => $page_post], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
           <section class="padding-top-100 padding-bottom-100">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="alert alert-warning">
                               <p><a class="text-primary" href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a> <?php echo e(__(' to see this page')); ?> </p>
                           </div>
                       </div>
                   </div>
               </div>
           </section>
        <?php endif; ?>
    <?php else: ?>
        <?php echo $__env->make('frontend.partials.dynamic-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/dynamic-single.blade.php ENDPATH**/ ?>