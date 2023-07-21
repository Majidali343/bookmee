

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div style="padding-top: 20px;color:white ;font-family:poppins ;font-weight: 700;font-size:26px;line-height: 31px;">Seller</div>
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top padding-top-40">
            <div class="thumb">
                <?php if(!is_null(Auth::guard('web')->user()->image)): ?>
                <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                <?php else: ?>
                <img src="<?php echo e(asset('assets/frontend/img/static/user_profile.png')); ?>" alt="No Image"> 
                <?php endif; ?>
            </div>
            <div class="author-content">
                <h4 class="title"> <?php echo e(Auth::guard('web')->user()->name); ?> </h4>
                
            </div>
        </div>
              
        
        <div class="dashboard-bottom margin-top-35 margin-bottom-50">
            <ul class="dashboard-list ">
                <li class="list <?php if(request()->is('seller/dashboard*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.dashboard')); ?>"> <i class="las la-th"></i> <?php echo e(__('Dashboard')); ?> </a>
                </li>
                
                <?php if(moduleExists('Subscription') && $commissionGlobal->system_type === 'subscription' && Route::has('seller.subscription.all')): ?>
                    <li class="list <?php if(request()->is('seller/subscription*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('seller.subscription.all')); ?>"> <i class="las la-th"></i> <?php echo e(__('Subscriptions')); ?> </a>
                    </li>
                <?php endif; ?>
                
                
                

                <li class="list <?php if(request()->is('seller/coupons*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.service.coupon')); ?>"> <i class="las la-gifts"></i> <?php echo e(__('Discounts')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('seller/services*') || request()->is('seller/add-services*') || request()->is('seller/service-attributes*') || request()->is('seller/edit-services*') || request()->is('seller/edit-service-attributes*') || request()->is('seller/add-service-attributes-by-id*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.services')); ?>"> <i class="las la-cogs"></i><?php echo e(__('Services')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('seller/staff*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.staff')); ?>"> <i class="las la-user-friends"></i><?php echo e(__('Staff')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('seller/days*') || request()->is('seller/add-day*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.days')); ?>"> <i class="las la-calendar-week"></i><?php echo e(__('Create Day')); ?> </a>
                </li>

                <li class="list">
                    <a href="<?php echo e(route('seller.timings')); ?>"> <i class="las la-calendar-week"></i><?php echo e(__('Business Timing')); ?> </a>
                </li>
 
				
                <li class="list <?php if(request()->is('seller/pending-orders')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.pending.orders')); ?>"> <i class="las la-tasks"></i> <?php echo e(__('Pending Booking')); ?> </a>
                </li>

                <li class="list
                <?php if(request()->is('seller/orders')): ?> active
                 <?php elseif(request()->is('seller/orders/cancel-orders')): ?> active
                 <?php elseif(request()->is('seller/orders/complete-orders')): ?> active
                 <?php elseif(request()->is('seller/orders/deliver-orders')): ?> active
                 <?php elseif(request()->is('seller/orders/active-orders')): ?> active
                 <?php else: ?>
                 <?php endif; ?>">
                    <a href="<?php echo e(route('seller.orders')); ?>"> <i class="las la-list-alt"></i> <?php echo e(__('All Bookings')); ?> </a>
                </li>

                

                <li class="list <?php if(request()->is('seller/notification/all-notifications*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.notification.all')); ?>"> <i class="las la-bell"></i> <?php echo e(__('All Notifications')); ?> </a>
                </li>
                
                <li class="list <?php if(request()->is('seller/service-reviews*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.service.review')); ?>"> <i class="lar la-star"></i><?php echo e(__('Review')); ?></a>
                </li>
                
                <li class="list <?php if(request()->is('seller/report/list*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.order.report.list')); ?>"> <i class="las la-user"></i> <?php echo e(__('Reports List')); ?> </a>
                </li>
                
                <li class="list <?php if(request()->is('seller/profile*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.profile')); ?>"> <i class="las la-user"></i> <?php echo e(__('Profile')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('seller/seller-profile-verify*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.profile.verify')); ?>"> <i class="las la-user"></i> <?php echo e(__('Profile Verify')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('seller/account-settings*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.account.settings')); ?>"> <i class="las la-cog"></i> <?php echo e(__('Settings')); ?> </a>
                </li>
                <li class="list">
                    <a href="<?php echo e(route('seller.logout')); ?>"> <i class="las la-sign-out-alt"></i> <?php echo e(__('Log Out' )); ?> </a>
                </li>
            </ul>
        </div>
        <div class="dashboard-logo">
            <a href="<?php echo e(route('homepage')); ?>" class="logo">
                <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

            </a>
        </div>
    </div>
</div><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/partials/sidebar.blade.php ENDPATH**/ ?>