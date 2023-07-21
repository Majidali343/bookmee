<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
   <?php if(!empty(get_static_option('site_google_analytics'))): ?>
        <?php echo get_static_option('site_google_analytics'); ?>

    <?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>


       <?php
        $custom_body_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 1)->latest()->first();
        $custom_heading_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 2)->latest()->first();
       ?>
       <?php if(!empty($custom_body_font_get) || !empty($custom_heading_font_get)): ?>
           <style>
               /*heading font*/
               @font-face {
                   font-family: <?php echo e(optional($custom_heading_font_get)->file); ?>;
                   src: url('<?php echo e(optional($custom_heading_font_get)->path); ?>') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               /*body font*/
               @font-face {
                   font-family: <?php echo e(optional($custom_body_font_get)->file); ?>;
                   src: url('<?php echo e(optional($custom_body_font_get)->path); ?>') format('woff');
                   font-weight: normal;
                   font-style: normal;
                   font-display: swap;
               }
               :root {
                   --heading-font: '<?php echo e(optional($custom_heading_font_get)->file); ?>', sans-serif !important;
                   --body-font: '<?php echo e(optional($custom_body_font_get)->file); ?>', sans-serif !important;
               }
           </style>
       <?php else: ?>
        <?php echo load_google_fonts(); ?>

       <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nice-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/new.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.min.css')); ?>">

    <?php if( get_user_lang_direction() === 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/rtl.css')); ?>">
    <?php endif; ?>

    <link rel="canonical" href="<?php echo e(canonical_url()); ?>" />
    <script src="<?php echo e(asset('assets/common/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/jquery-migrate-3.3.2.min.js')); ?>"></script>

    <?php
    $page_post = isset($page_post) ? $page_post : [];
    $page_type = isset($page_type) ? $page_post : [];
    ?>

    <?php echo $__env->make('frontend.partials.root-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>


    <?php if(request()->routeIs('homepage')): ?>
        <title><?php echo e(get_static_option('site_title')); ?> - <?php echo e(get_static_option('site_tag_line')); ?></title>

           <?php echo render_site_meta(); ?>


     <?php elseif( request()->routeIs('frontend.dynamic.page') && $page_type === 'page' ): ?>

           <?php echo render_site_title(optional($page_post)->title ); ?>


           <?php echo render_site_meta(); ?>  

    <?php else: ?>
        <?php echo $__env->yieldContent('page-meta-data'); ?>
    <?php endif; ?>
<?php if(!empty( get_static_option('site_third_party_tracking_code'))): ?>
 <?php echo get_static_option('site_third_party_tracking_code'); ?>

 <?php endif; ?>

</head>


<body>

<?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.navbar',$page_post, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php /**PATH C:\xampp\htdocs\Bookmee\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>