<?php
    if(request()->is('/')){
        $page__id = get_static_option('home_page');
        $page_details = App\Page::find($page__id);
        $page_post = isset($page_post) && is_null($page_details) ? $page_post : $page_details;
    }
?>

<nav style="background-color: black" class="navbar navbar-area navbar-two <?php echo e($page_post->page_class ?? ''); ?> navbar-expand-lg" style="background:rgba(0, 0, 0, 0.7);">
    <div class="container container-two nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="<?php echo e(route('homepage')); ?>" class="logo">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </a>
            </div>

            <div class="onlymobile-device-account-navbar navtwo">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.user-menu','data' => []]); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            
        </div>

        

        <div class="nav-right-content">
            <div class="navbar-right-inner">
                <div class="info-bar-item">
                    <?php if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0): ?>
                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                            <div class="notification-icon icon">
                                <?php if(Auth::guard('web')->check()): ?>
                                    <i class="las la-bell"></i>
                                    <span class="notification-number style-02">
                                <?php echo e(Auth()->user()->unreadNotifications()->where('data->order_message' , 'You have a new order')->count()); ?>

                            </span>
                                <?php endif; ?>

                                <div class="notification-list-item mt-2" >
                                    <h5 class="notification-title"><?php echo e(__('Notifications')); ?></h5>
                                    <div class="list">
                                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->where('data->order_message' , 'You have a new order')->count() >=1): ?>
                                            <span>
                                        <?php $__currentLoopData = Auth::user()->unreadNotifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($notification->data['order_id'])): ?>
                                                        <a class="list-order" href="<?php echo e(route('seller.order.details',$notification->data['order_id'])); ?>">
                                                    <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                    <?php echo e($notification->data['order_message']); ?> #<?php echo e($notification->data['order_id']); ?>

                                                </a>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                            <a class="p-2 text-center d-block" href="<?php echo e(route('seller.notification.all')); ?>"><?php echo e(__('View All Notification')); ?></a>
                                        <?php else: ?>
                                            <p class="text-center padding-3"><?php echo e(__('No New Notification')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.user-menu','data' => []]); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</nav><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/partials/pages-portion/navbars/navbar-02.blade.php ENDPATH**/ ?>