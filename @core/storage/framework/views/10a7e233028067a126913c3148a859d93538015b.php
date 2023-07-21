







 <?php
 if(!isset($page_post)){https://bitbucket.org/xgenious/widget-builder-laravel/src/master/
     return;
 }
?>

<!-- <?php echo e($page_post); ?> -->
<?php if($page_post->layout === 'normal_layout' || $page_post->layout === 'home_page_layout' || $page_post->layout === 'home_page_layout_two'): ?>
<?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page',$page_post->id); ?>

<?php endif; ?>
<?php if($page_post->layout === 'home_page_layout'): ?>
 <div data-padding-top="100">
     <div class="container <?php echo e($page_post->page_class); ?>">
         <div class="row">
             <div class="col-lg-8 <?php echo e($page_post->left_column); ?>">
                 <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

             </div>

             <div class="col-md-6 col-lg-4 <?php echo e($page_post->right_column); ?> widg ">
                 <div class="widget-area-wrapper custom-margin-widget <?php if(get_static_option('site_frontend_dark_mode') === 'on'): ?>   dark-version  <?php endif; ?> style-<?php echo e($page_post->widget_style); ?>" data-padding-bottom="100">
                     <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                 </div>
             </div>

         </div>
     </div>
 </div>

<?php endif; ?>

<?php if($page_post->layout === 'home_page_layout_two'): ?>
 <div class="blog-list-area-wrapper index-01" data-padding-top="100">
     <div class="container <?php echo e($page_post->page_class); ?>">
         <div class="row">
             <div class="col-lg-8 <?php echo e($page_post->left_column); ?>">
                 <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

             </div>

             <div class="col-md-6 col-lg-4 <?php echo e($page_post->right_column); ?> widg">
                 <div class="widget-area-wrapper style-<?php echo e($page_post->widget_style); ?>">
                     <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                 </div>
             </div>

         </div>
     </div>
     <div class="container-fluid">
         <div class="col-lg-12">
             <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar_two',$page_post->id); ?>

         </div>
     </div>
 </div>
<?php endif; ?>



<?php if($page_post->layout === 'sidebar_layout'): ?>
 <div class="blog-list-area-wrapper index-01">
     <div class="container <?php echo e($page_post->page_class); ?>">
         <div class="row">
             <div class="col-lg-8 col-xl-9">
                 <?php echo \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page('dynamic_page_with_sidebar',$page_post->id); ?>

             </div>
             <div class="col-md-6 col-lg-4 col-xl-3 widg">
                 <div class="widget-area-wrapper style-02">
                     <?php echo render_frontend_sidebar($page_post->sidebar_layout,['column' => false]); ?>

                 </div>
             </div>
         </div>
     </div>
 </div>
<?php endif; ?>


<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/partials/pages-portion/dynamic-page-builder-part.blade.php ENDPATH**/ ?>