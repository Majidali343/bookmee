<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(!in_array(Route::currentRouteName(),['about.seller.profile','about.buyer.profile'])): ?>
    <div class="banner-inner-area section-bg-2 padding-top-40 padding-bottom-40
        <?php if(request()->routeIs('homepage') || request()->routeIs('frontend.dynamic.page')  &&  empty($page_post->breadcrumb_status)): ?>
            d-none
        <?php endif; ?>"
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-inner-contents">
                        <ul class="inner-menu">
                            <li class="list"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?> </a></li>
                            <li class="list"><?php echo $__env->yieldContent('page-title'); ?>  </li>
                        </ul>
                        <h2 class="banner-inner-title"> <?php echo e($page_post->title ?? ''); ?> <?php echo $__env->yieldContent('inner-title'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Bookmee\@core\resources\views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>