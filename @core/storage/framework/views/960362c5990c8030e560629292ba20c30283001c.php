
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Dashboard')); ?>

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
                        <div class="col-lg-12">
                            <div class="dashboard-flex-title">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title"><?php echo e(__('Dashboard')); ?></h2>
                                </div>
                                <?php if(Auth()->user()->unreadNotifications()->count() > 0): ?>
                                    <div class="info-bar-item">
                                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                            <div class="notification-icon icon">
                                                <?php if(Auth::guard('web')->check()): ?>
                                                    <span class="bell-icon"> <?php echo e(__("Notifications")); ?> <i class="las la-bell"></i> </span>
                                                    <span class="notification-number">
                                                            <?php echo e(Auth()->user()->unreadNotifications()->where('data->order_ticcket_message' , 'You have a new order ticket')->count()); ?>

                                                        </span>
                                                <?php endif; ?>

                                                <div class="notification-list-item mt-2">
                                                    <h5 class="notification-title"><?php echo e(__('Notifications')); ?></h5>
                                                    <div class="list">
                                                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >0): ?>
                                                            <span>
                                                                <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(isset($notification->data['seller_last_ticket_id'])): ?>
                                                                        <a class="list-order" href="<?php echo e(route('seller.support.ticket.view',$notification->data['seller_last_ticket_id'])); ?>">
                                                                          <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                                          <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['seller_last_ticket_id']); ?>

                                                                       </a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </span>
                                                        <?php else: ?>
                                                            <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New Notification')); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(moduleExists('Subscription') && $commissionGlobal->system_type == 'subscription' && empty(auth('web')->user()->subscribedSeller)): ?>
                            <div class="col-lg-12">
                                <div class="alert alert-warning d-flex justify-content-between"><?php echo e(__('you must have to subscribe any of our package in order to start selling your services.')); ?>

                                    <a href="<?php echo e(getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')); ?>" target="_blank" class="btn btn-secondary"><?php echo e(__('view packages')); ?></a>    
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders" style="background-color: #FF6B2C;">
                                <div class="orders-shapes">
                                    
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-tasks"></i>
                                    </div>

                                    <div class="contents">
                                        <h2 class="order-titles"> <?php echo e($pending_order); ?> </h2>
                                        <span class="order-para"><?php echo e(__('Bookings Pending')); ?> </span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders " style="background-color: #03989E ; ">
                                <div class="orders-shapes" >
                                    
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-handshake"></i>
                                        
                                    </div>
                                    
                                    <div class="contents">
                                        <h2 class="order-titles"> <?php echo e($complete_order); ?> </h2>
                                        <span class="order-para"> <?php echo e(__('Service Completed ')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders"  style="background-color:#367CFF; ">
                                <div class="orders-shapes">
                                    
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-dollar-sign"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> <?php echo e(float_amount_with_currency_symbol($total_earnings)); ?> </h2>
                                        <span class="order-para"><?php echo e(__('Total Withdraw')); ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders"  style="background-color: #C71F66; ">
                                <div class="orders-shapes">
                                    
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-file-invoice-dollar"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"><?php echo e(float_amount_with_currency_symbol($remaning_balance - $total_earnings)); ?> </h2>
                                        <span class="order-para"> <?php echo e(__('Remaining Balance')); ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="dashboard-middle-flex">


                        <div class="single-flex-middle margin-top-40">
                            <div class="line-charts-wrapper">
                                <div class="line-top-contents">
                                    <h5 class="earning-title"><?php echo e(__('Total Bookings Overview')); ?></h5>
                                </div>
                                <div class="line-charts">
                                    <canvas id="line-chart"></canvas>
                                </div>
                            </div>
                        </div>


                        <div class="single-flex-middle">
                            <div class="single-flex-middle-inner">
                               
                                <div class="line-charts-wrapper margin-top-40">
                                    <div class="line-top-contents">
                                        <h5 class="earning-title"><?php echo e(__('This Month Summery')); ?> </h5>
                                    </div>

                                    
                                    <div class="chart-summery-inner">
                                        <div class="single-chart-summery">
                                            <div class="icon" style="background-color: #FF6B2C">
                                                <i class="las la-tasks"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"><?php echo e($this_month_order_count); ?> </h4>
                                                <span class="title-para"><?php echo e(__('Bookigs')); ?> </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-dollar-sign"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> <?php echo e(float_amount_with_currency_symbol($this_month_earnings)); ?> </h4>
                                                <span class="title-para"><?php echo e(__('Earning')); ?> </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-file-invoice-dollar"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> <?php echo e(float_amount_with_currency_symbol($this_month_balance_without_tax_and_admin_commission)); ?> </h4>
                                                <span class="title-para"> <?php echo e(__('Balance')); ?> </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-male"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> <?php echo e($buyer_count); ?> </h4>
                                                <span class="title-para"><?php echo e(__('Total Buyer')); ?> </span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        
                    </div>


                    <div class="dashboard-middle-flex style-02 " >
                        <?php if($last_five_order->count() >= 1): ?>
                            <div class="single-flex-middle margin-top-40">
                                <div class="line-charts-wrapper">
                                    <div class="table-responsive table-responsive--md">
                                        <h5 class="earning-title">Bookings progress</h5>
                                        <table class="custom--table">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Client Name')); ?> </th>
                                                <th><?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('Email')); ?> </th>
                                                <th><?php echo e(__('Price')); ?> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $last_five_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td data-label="<?php echo e(__('Client Name')); ?>"><?php echo e($order->name); ?> </td>
                                                    <?php if($order->status == 0): ?> <td data-label="<?php echo e(__('Status')); ?>" class="pending"><span><?php echo e(__('Pending')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 1): ?> <td data-label="<?php echo e(__('Status')); ?>" class="order-active"><span><?php echo e(__('Active')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 2): ?> <td data-label="<?php echo e(__('Status')); ?>" class="completed"><span><?php echo e(__('Completed')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 3): ?> <td data-label="<?php echo e(__('Status')); ?>" class="order-deliver"><span><?php echo e(__('Delivered')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 4): ?> <td data-label="<?php echo e(__('Status')); ?>" class="canceled"><span><?php echo e(__('Cancelled')); ?></span></td><?php endif; ?>
                                                    <td data-label="<?php echo e(__('Email')); ?>"><?php echo e($order->email); ?></td>
                                                    <td data-label="<?php echo e(__('Price')); ?>"> <?php echo e(float_amount_with_currency_symbol($order->total)); ?> </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="single-flex-middle margin-top-40" >
                            <div class="line-charts-wrapper">
                                <div class="line-top-contents">
                                    <h5 class="earning-title"><?php echo e(__('Booking Summary')); ?> </h5>
                                </div>
                                <div class="group-bar-charts">
                                    <canvas id="bar-chart-grouped"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        "use strict";
        $(document).ready(function () {

            $(document).on('click','.swal_status_button',function(e){
                e.preventDefault();
                Swal.fire({
                    title: '<?php echo e(__("Are you sure to change status?")); ?>',
                    text: '<?php echo e(__("You will change it anytime!")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            });

            /* Line Charts */
         new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: [<?php $__currentLoopData = $month_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                    datasets: [{
                        data: [<?php $__currentLoopData = $monthly_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                        label: "<?php echo e(__('Bookings')); ?>",
                        borderColor: "#03989E",
                        borderWidth: 1,
                        fill: true,
                        pointBorderWidth: 1,
                        pointBackgroundColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#03989E",
                    }]
                },

            });


            /* Group Bar Charts */
            new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
                    labels: [<?php $__currentLoopData = $days_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                    datasets: [
                        {
                            label: "<?php echo e(__('Pending')); ?>",
                            backgroundColor: "#2F98DC",
                            data: [<?php $__currentLoopData = $pending_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#2F98DC',
                            borderColor: '#fff',
                            borderWidth: 2,
                        },
                        {
                            label: "<?php echo e(__('Active')); ?>",
                            backgroundColor: "#FFB307",
                            data: [<?php $__currentLoopData = $active_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#FFB307',
                            borderColor: '#fff',
                            borderWidth: 2,
                        },
                        {
                            label: "<?php echo e(__('Complete')); ?>",
                            backgroundColor: "#6560FF",
                            data: [<?php $__currentLoopData = $complete_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#6560FF',
                            borderColor: '#fff',
                            borderWidth: 2,
                        }
                    ],
                },
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/dashboard/dashboard.blade.php ENDPATH**/ ?>