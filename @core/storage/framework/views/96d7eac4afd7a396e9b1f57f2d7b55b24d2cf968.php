<li class="
    <?php if(request()->is('seller/orders/active-orders')): ?> active
    <?php elseif(request()->is('seller/orders/job/active-orders')): ?> active
    <?php else: ?>
    <?php endif; ?>">
    <a href="
    <?php if(request()->is('seller/orders/deliver-orders')): ?> <?php echo e(route('seller.active.orders')); ?>


     <?php elseif(request()->is('seller/orders/job/active-orders')): ?> <?php echo e(route('seller.job.active.orders')); ?>

     <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> <?php echo e(route('seller.job.active.orders')); ?>

     <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> <?php echo e(route('seller.job.active.orders')); ?>

     <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> <?php echo e(route('seller.job.active.orders')); ?>


     <?php elseif(request()->is('seller/job-orders')): ?> <?php echo e(route('seller.job.active.orders')); ?>

     <?php elseif(request()->is('seller/orders/active-orders')): ?> <?php echo e(route('seller.active.orders')); ?>

     <?php elseif(request()->is('seller/orders/cancel-orders')): ?> <?php echo e(route('seller.active.orders')); ?>

     <?php elseif(request()->is('seller/orders')): ?> <?php echo e(route('seller.active.orders')); ?>

    <?php else: ?>
    <?php endif; ?>">
        <?php echo e(__('Active')); ?>

        <span class="numbers">
            <?php if(!empty($active_orders)): ?><?php echo e($active_orders->count()); ?><?php endif; ?>
        </span>
    </a>
</li>

<li class="
   <?php if(request()->is('seller/orders/deliver-orders')): ?> active
    <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> active
    <?php else: ?>
    <?php endif; ?>">
    <a href="
   <?php if(request()->is('seller/orders/deliver-orders')): ?> <?php echo e(route('seller.deliver.orders')); ?>


    <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> <?php echo e(route('seller.job.deliver.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> <?php echo e(route('seller.job.deliver.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/active-orders')): ?> <?php echo e(route('seller.job.deliver.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> <?php echo e(route('seller.job.deliver.orders')); ?>


      <?php elseif(request()->is('seller/job-orders')): ?> <?php echo e(route('seller.job.deliver.orders')); ?>

      <?php elseif(request()->is('seller/orders/complete-orders')): ?> <?php echo e(route('seller.deliver.orders')); ?>

      <?php elseif(request()->is('seller/orders/active-orders')): ?> <?php echo e(route('seller.deliver.orders')); ?>

      <?php elseif(request()->is('seller/orders/cancel-orders')): ?> <?php echo e(route('seller.deliver.orders')); ?>

      <?php elseif(request()->is('seller/orders')): ?> <?php echo e(route('seller.deliver.orders')); ?>


   <?php else: ?>
   <?php endif; ?>
    "><?php echo e(__('Delivered')); ?>

        <span class="numbers">
            <?php if(!empty($deliver_orders)): ?><?php echo e($deliver_orders->count()); ?><?php endif; ?>
        </span>
    </a>
</li>

<li class="
    <?php if(request()->is('seller/orders/complete-orders')): ?> active
     <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> active
     <?php else: ?>
     <?php endif; ?>">
    <a href="
   <?php if(request()->is('seller/orders/complete-orders')): ?> <?php echo e(route('seller.complete.orders')); ?>


    <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> <?php echo e(route('seller.job.complete.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> <?php echo e(route('seller.job.complete.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/active-orders')): ?> <?php echo e(route('seller.job.complete.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> <?php echo e(route('seller.job.complete.orders')); ?>


      <?php elseif(request()->is('seller/orders/cancel-orders')): ?> <?php echo e(route('seller.complete.orders')); ?>

      <?php elseif(request()->is('seller/job-orders')): ?> <?php echo e(route('seller.job.complete.orders')); ?>

      <?php elseif(request()->is('seller/orders/active-orders')): ?> <?php echo e(route('seller.complete.orders')); ?>

      <?php elseif(request()->is('seller/orders/deliver-orders')): ?> <?php echo e(route('seller.complete.orders')); ?>

      <?php elseif(request()->is('seller/orders')): ?> <?php echo e(route('seller.complete.orders')); ?>

   <?php else: ?>
   <?php endif; ?>">
        <?php echo e(__('Completed')); ?>

        <span class="numbers">
            <?php if(!empty($complete_orders)): ?><?php echo e($complete_orders->count()); ?><?php endif; ?>
        </span>
    </a>
</li>


<li class="
    <?php if(request()->is('seller/orders/cancel-orders')): ?> active
    <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> active
    <?php else: ?>
    <?php endif; ?>">
    <a href="
     <?php if(request()->is('seller/orders/cancel-orders')): ?> <?php echo e(route('seller.cancel.orders')); ?>

      <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> <?php echo e(route('seller.job.cancel.orders')); ?>

      <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> <?php echo e(route('seller.job.cancel.orders')); ?>

      <?php elseif(request()->is('seller/orders/job/active-orders')): ?> <?php echo e(route('seller.job.cancel.orders')); ?>

      <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> <?php echo e(route('seller.job.cancel.orders')); ?>


     <?php elseif(request()->is('seller/job-orders')): ?> <?php echo e(route('seller.job.cancel.orders')); ?>

     <?php elseif(request()->is('seller/orders/active-orders')): ?> <?php echo e(route('seller.cancel.orders')); ?>

     <?php elseif(request()->is('seller/orders/complete-orders')): ?> <?php echo e(route('seller.cancel.orders')); ?>

     <?php elseif(request()->is('seller/orders/deliver-orders')): ?> <?php echo e(route('seller.cancel.orders')); ?>

     <?php elseif(request()->is('seller/orders')): ?> <?php echo e(route('seller.cancel.orders')); ?>

     <?php else: ?>
      <?php endif; ?>">
        <?php echo e(__('Cancelled')); ?>

        <span class="numbers">
            <?php if(!empty($cancel_orders)): ?><?php echo e($cancel_orders->count()); ?><?php endif; ?>
        </span>
    </a>
</li>

<li class="
 <?php if(request()->is('seller/orders')): ?> active
 <?php elseif(request()->is('seller/job-orders')): ?> active
 <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?>
 <?php else: ?>
 <?php endif; ?>">
    <a href="
    <?php if(request()->is('seller/orders')): ?> <?php echo e(route('seller.orders')); ?>

    <?php elseif(request()->is('seller/job-orders')): ?> <?php echo e(route('seller.job.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/cancel-orders')): ?> <?php echo e(route('seller.job.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/complete-orders')): ?> <?php echo e(route('seller.job.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/deliver-orders')): ?> <?php echo e(route('seller.job.orders')); ?>

    <?php elseif(request()->is('seller/orders/job/active-orders')): ?> <?php echo e(route('seller.job.orders')); ?>

    <?php elseif(request()->is('seller/orders/cancel-orders')): ?> <?php echo e(route('seller.orders')); ?>

    <?php elseif(request()->is('seller/orders/complete-orders')): ?> <?php echo e(route('seller.orders')); ?>

    <?php elseif(request()->is('seller/orders/deliver-orders')): ?> <?php echo e(route('seller.orders')); ?>

    <?php elseif(request()->is('seller/orders/active-orders')): ?> <?php echo e(route('seller.orders')); ?>

    <?php else: ?>
    <?php endif; ?>"><?php echo e(__('All')); ?>

        <span class="numbers">
        <?php if(!empty($orders)): ?><?php echo e($orders->count()); ?><?php endif; ?>
    </span>
    </a>
</li>
<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/partials/tab-list.blade.php ENDPATH**/ ?>