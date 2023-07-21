
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
    .bg_card_color_one{
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(65,107,125,1) 35%, rgba(0,212,255,1) 100%); 
    }
    .bg_card_color_two{
        background: rgb(34,193,195);
        background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(50,120,119,1) 100%);  
    }

    .orders-child:nth-child(4n+2) .single-orders {
      background: #1dbf73;
    }
    .orders-child:nth-child(4n+2) .single-orders .icon {
      color: #1dbf73;
    }
    
    .orders-child:nth-child(4n+3) .single-orders {
      background: #C71F66;
    }
    .orders-child:nth-child(4n+3) .single-orders .icon {
      color: #C71F66;
    }
    
    .orders-child:nth-child(4n+4) .single-orders {
      background: #6560FF;
    }
    .orders-child:nth-child(4n+4) .single-orders .icon {
      color: #6560FF;
    }
      
    .single-orders {
      background: #f3733c;
      padding: 35px 30px;
      border-radius: 10px;
      position: relative;
      z-index: 2;
      overflow: hidden;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders {
        padding: 20px 20px;
      }
    }
    .single-orders .orders-shapes img {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    .single-orders .orders-flex-content {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      gap: 30px;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .icon {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      height: 67px;
      width: 67px;
      font-size: 40px;
      background: #fff;
      color: var(--main-color-three);
      border-radius: 50%;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .contents .order-titles {
      font-size: 35px;
      font-weight: 700;
      line-height: 55px;
      color: #fff;
      margin: 0;
    }
    .single-orders .orders-flex-content .contents .order-para {
      font-size: 18px;
      font-weight: 500;
      line-height: 20px;
      color: #fff;
    }
    
    @media (min-width: 1400px) and (max-width: 1730px) {
      .single-orders {
        padding: 20px 20px;
      }
    
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
         
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="main-content-inner">
        <div class="row">
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"><?php echo e($total_admin); ?> </h2>
                            <span class="order-para"><?php echo e(__('Total Admin')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes2.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"><?php echo e($total_seller); ?> </h2>
                            <span class="order-para"> <?php echo e(__('Total Seller')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes3.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> <?php echo e($total_buyer); ?> </h2>
                            <span class="order-para"> <?php echo e(__('Total Buyer')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes4.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"><?php echo e(float_amount_with_currency_symbol($total_earning)); ?> </h2>
                            <span class="order-para"><?php echo e(__('Total Earning')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-tasks"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> <?php echo e($pending_order); ?> </h2>
                            <span class="order-para"><?php echo e(__('Order Pending')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes2.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-handshake"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> <?php echo e($pending_service); ?> </h2>
                            <span class="order-para"><?php echo e(__('Pending Service')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes3.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> <?php echo e($pending_payout_request); ?></h2>
                            <span class="order-para"> <?php echo e(__('New Payout Request')); ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="<?php echo e(asset('assets/frontend/img/static/orders-shapes4.png')); ?>" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"><?php echo e($new_user_today); ?></h2>
                            <span class="order-para"><?php echo e(__('New User Today')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h4 class="mb-3 earning-title"><?php echo e(__('Most Viewed Services')); ?></h4>
                <div class="table-wrap table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th><?php echo e(__('ID')); ?></th>
                        <th><?php echo e(__('Title')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('View')); ?></th>
                        <th><?php echo e(__('Details')); ?></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $most_viewed_10_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($service->title); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($service->price)); ?></td>
                                    <td><?php echo e($service->view); ?></td>
                                    <td>
                                         <?php if(!empty($service->id)): ?>
                                            <a class="btn btn-success" href="<?php echo e(route('admin.service.view.details',$service->id)); ?>"> <i class="ti-eye"></i</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="mb-3 earning-title"><?php echo e(__('Most Ordered Services')); ?></h4>
                <div class="table-wrap table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th><?php echo e(__('ID')); ?></th>
                        <th><?php echo e(__('Title')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('View')); ?></th>
                        <th><?php echo e(__('Details')); ?></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $most_sell_10_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(optional($service->service)->id); ?></td>
                                    <td><?php echo e(optional($service->service)->title); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol(optional($service->service)->price)); ?></td>
                                    <td><?php echo e(optional($service->service)->view); ?></td>
                                    <td>
                                        <?php if(!empty($service->service)): ?>
                                            <a class="btn btn-success" href="<?php echo e(route('admin.service.view.details',optional($service->service)->id)); ?>"> <i class="ti-eye"></i</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title"><?php echo e(__('Last 12 Month Income Overview')); ?> </h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title"><?php echo e(__('Daily Income Overview Last 30 Days')); ?></h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title"><?php echo e(__('Last 12 Month Order Overview')); ?></h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title"><?php echo e(__('Daily Order Overview Last 30 Days')); ?></h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
 <?php

 ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/chart.js')); ?>"></script>
    <script>
    /* Line Charts */
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [<?php $__currentLoopData = $month_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            datasets: [{
                data: [<?php $__currentLoopData = $monthly_income_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                label: "Monthly Income",
                borderColor: "#1DBF73",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart2"), {
        type: 'bar',
        data: {
            labels: [<?php $__currentLoopData = $days_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            datasets: [{
                data: [<?php $__currentLoopData = $daily_income_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                label: "Daily Income",
                borderColor: "#D9E268",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart3"), {
        type: 'line',
        data: {
            labels: [<?php $__currentLoopData = $month_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            datasets: [{
                data: [<?php $__currentLoopData = $monthly_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                label: "Monthly Order",
                borderColor: "#2F98DC",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart4"), {
        type: 'bar',
        data: {
            labels: [<?php $__currentLoopData = $days_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            datasets: [{
                data: [<?php $__currentLoopData = $daily_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                label: "Daily Order",
                borderColor: "#ED27AB",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/admin-home.blade.php ENDPATH**/ ?>