
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        p{
            color: #f0f0f0 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <?php if(!empty($service)): ?>
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <h3><strong><?php echo e(__('Title:')); ?> </strong><?php echo e($service->title); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Price:')); ?> </strong> <?php echo e(float_amount_with_currency_symbol($service->price)); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Tax:')); ?> </strong> <?php echo e($service->tax); ?>%</label>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#taxUpdateModal">
                                        <?php echo e(__('Update')); ?>

                                      </button>
                                </div>
                                <div class="checkbox-inlines">
                                    <?php if($service->status==1): ?>
                                    <label><strong><?php echo e(__('Status:')); ?> </strong> <span class="text-success"><?php echo e(__('Approve')); ?></span></label>
                                    <?php else: ?> 
                                    <label><strong><?php echo e(__('Status:')); ?> </strong> <span class=" text-danger"><?php echo e(__('Pending')); ?></span></label>
                                    <?php endif; ?>
                                </div>
                                <div class="checkbox-inlines">
                                    <?php if($service->status==1): ?>
                                    <label><strong><?php echo e(__('Service off on Status:')); ?></strong> <span class="text-success"><?php echo e(__('On')); ?></span></label>
                                    <?php else: ?> 
                                    <label><strong><?php echo e(__('Service off on Status::')); ?></strong> <span class="text-danger"><?php echo e(__('Off')); ?></span></label>
                                    <?php endif; ?>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('View Count:')); ?></strong> <?php echo e($service->view); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label> <strong><?php echo e(__('Description:')); ?></strong>  </label> <p class="text-dark"><?php echo e(Str::limit(strip_tags($service->description),700)); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                       
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Image')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <?php echo render_image_markup_by_attachment_id($service->image,'','thumb'); ?>

                                </div>
                            </div>           
                            
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Service Benefits')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <?php $__currentLoopData = $service_benifits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benifit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="checkbox-inlines">
                                    <label><?php echo e($benifit->benifits); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5><?php echo e(__('Seller Details')); ?></h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Seller:')); ?></strong> <?php echo e(optional($service->seller)->name); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('City:')); ?></strong> <?php echo e(optional(optional($service->seller)->city)->service_city); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Area:')); ?></strong> <?php echo e(optional(optional($service->seller)->area)->service_area); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Country:')); ?></strong> <?php echo e(optional(optional($service->seller)->country)->country); ?></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong><?php echo e(__('Seller Since:')); ?></strong> <?php echo e(Carbon\Carbon::parse(optional($seller_since)->created_at)->year); ?></label>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <h5><?php echo e(__('Include Details: ')); ?></h5> <br>
                            <?php if($service->is_service_online == 1): ?>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($include->include_service_title); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Unit Price')); ?></th>
                                        <th><?php echo e(__('Quantity')); ?></th>
                                        <th><?php echo e(__('Total')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $package_fee =0; ?>
                                    <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($include->include_service_title); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($include->include_service_price)); ?></td>
                                            <td><?php echo e($include->include_service_quantity); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($include->include_service_price* $include->include_service_quantity)); ?></td>
                                            <?php $package_fee += $include->include_service_price * $include->include_service_quantity ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="3"><strong><?php echo e(__('Package Fee')); ?></strong></td>
                                        <td><strong><?php echo e(float_amount_with_currency_symbol($package_fee)); ?></strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <br>
                            <h5><?php echo e(__('Additional Services: ')); ?></h5> <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Unit Price')); ?></th>
                                        <th><?php echo e(__('Quantity')); ?></th>
                                        <th><?php echo e(__('Total')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $extra_service =0; ?>
                                    <?php $__currentLoopData = $service_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($additional->additional_service_title); ?></td>
                                        <td><?php echo e(float_amount_with_currency_symbol($additional->additional_service_price)); ?></td>
                                        <td><?php echo e($additional->additional_service_quantity); ?></td>
                                        <td><?php echo e(float_amount_with_currency_symbol($additional->additional_service_price * $additional->additional_service_quantity)); ?></td>
                                        <?php $extra_service += $additional->additional_service_price * $additional->additional_service_quantity ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="3"><strong><?php echo e(__('Extra Service')); ?></strong></td>
                                        <td><strong><?php echo e(float_amount_with_currency_symbol($extra_service)); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <?php if($service->is_service_online == 1): ?>
                            <h5><?php echo e(__('Service Faqs: ')); ?></h5> <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $service_faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($faq->title); ?></td>
                                        <td><?php echo e($faq->description); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php endif; ?>

                            
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

  
  <!-- Modal -->
  <div class="modal fade" id="taxUpdateModal" tabindex="-1" role="dialog" aria-labelledby="taxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="taxModalLabel"><?php echo e(__('Update Tax')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo e(route('admin.service.tax.update')); ?>" method="post">
            <div class="modal-body">
                <?php echo csrf_field(); ?> 
                <input type="hidden" name="service_id" value="<?php echo e($service->id); ?>">
                <div class="form-group">
                    <label for="tax"><?php echo e(__('Tax')); ?></label>
                    <input type="text" name="tax" value="<?php echo e($service->tax); ?>" class="form-control">
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/pages/services/service-details.blade.php ENDPATH**/ ?>