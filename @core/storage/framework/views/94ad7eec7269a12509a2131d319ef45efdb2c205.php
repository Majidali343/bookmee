
 <div class="card text-white bg-secondary mb-3 mt-2" style="border:none">
    <div class="card-body home_servie_serach_wrapper">
        <?php if($vendors->count() >0): ?>
            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="/<?php echo e($vendor->username); ?>" class="search_servie_image_content text-left text-white">
                <div class="search_thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($vendor->image,'','thumb'); ?>></div>
                  <span class="search-text-item">
                    <?php echo e($vendor->name); ?>

                    <br>
                    <?php echo e($vendor->address); ?>

                  </span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?> 
           <p class="text-left text-warning"><?php echo e(__("Nothing Found")); ?></p>
        <?php endif; ?>
    </div>
  </div><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/partials/search-result.blade.php ENDPATH**/ ?>