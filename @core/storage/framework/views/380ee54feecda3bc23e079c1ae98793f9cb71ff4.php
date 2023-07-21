<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div style="padding-top: 20px;color:white ;font-family:poppins ;font-weight: 700;font-size:26px;line-height: 31px;">Buyer</div>
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top padding-top-40">

        
            <div class="thumb">
                <?php if(!is_null(Auth::guard('web')->user()->image)): ?>
                <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                <?php else: ?>
                <img src="<?php echo e(asset('assets/frontend/img/static/user_profile.png')); ?>" alt="<?php echo e(__('No Image')); ?>"> 
                <?php endif; ?>
            </div>
            <div class="author-content">
                <h4 class="title"> <?php echo e(Auth::guard('web')->user()->name); ?> </h4>
                
            </div>

        </div>


          <div class="dashboard-bottom margin-top-35 margin-bottom-50">
            <ul class="dashboard-list ">

                <li class="list <?php if(request()->is('buyer/dashboard*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.dashboard')); ?>"> <i class="las la-th"></i> <?php echo e(__('Dashboard')); ?> </a>
                </li>
                
                
                <li class="list <?php if(request()->is('buyer/orders*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.orders')); ?>"> <i class="las la-tasks"></i><?php echo e(__('Your Bookings')); ?></a>
                </li>

                

                <li class="list <?php if(request()->is('buyer/all-tickets*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.support.ticket')); ?>"> <i class="lar la-star"></i><?php echo e(__('Support Ticket')); ?></a>
                </li>
                <li class="list <?php if(request()->is('buyer/report/list*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.order.report.list')); ?>"> <i class="las la-file-alt"></i> <?php echo e(__('Reports List')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('buyer/profile*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.profile')); ?>"> <i class="las la-user"></i> <?php echo e(__('Profile')); ?> </a>
                </li>
                <li class="list <?php if(request()->is('buyer/account-settings*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.account.settings')); ?>"> <i class="las la-cog"></i> <?php echo e(__('Settings')); ?> </a>
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
</div><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/buyer/partials/sidebar.blade.php ENDPATH**/ ?>