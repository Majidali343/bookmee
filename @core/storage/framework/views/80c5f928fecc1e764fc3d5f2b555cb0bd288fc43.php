<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Subscriptions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Seller Subscriptions')); ?>  </h4>
                                <a href="#" class="btn btn-info mb-3" data-toggle="modal"
                                   data-target="#ticketModal" > <?php echo e(__('Assign Subscription' )); ?>

                                </a>
                                <p class="text-warning"><?php echo e(__('Pending connect will be added to available connect only the payment status is completed.')); ?></p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Image')); ?></th>
                                <th><?php echo e(__('Manual Payment Image')); ?></th>
                                <th><?php echo e(__('Subscription Details')); ?></th>
                                <th><?php echo e(__('Seller Details')); ?></th>
                                <th><?php echo e(__('Payment Details')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('History')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $seller_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($data->id); ?></td>
                                        <td><?php echo render_image_markup_by_attachment_id(optional($data->subscription)->image,'','thumb'); ?></td>
                                        <td>
                                            <?php if($data->manual_payment_image): ?>
                                                <a href="<?php echo e(url('assets/uploads/subscription/manual-payment/'.$data->manual_payment_image)); ?>" target="_blank">
                                                    <img src="<?php echo e(url('assets/uploads/subscription/manual-payment/'.$data->manual_payment_image)); ?>" style="width:100px"alt="payment-image">
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(__('Title:')); ?> <?php echo e(optional($data->subscription)->title); ?> <br>
                                            <?php echo e(__('Price:')); ?>

                                            <?php if($data->price == 0): ?>
                                                <?php echo e(float_amount_with_currency_symbol($data->initial_price)); ?> <br>
                                            <?php else: ?>
                                                <?php echo e(float_amount_with_currency_symbol($data->price)); ?> <br>
                                            <?php endif; ?>
                                            <?php echo e(__('Type:')); ?> <?php echo e(ucfirst($data->type)); ?> <br>
                                            <?php echo e(__('Available Connect: ')); ?>  <?php echo e($data->connect); ?> <br>
                                            <?php echo e(__('Service: ')); ?>  <?php echo e($data->initial_service); ?> <br>
                                            <?php echo e(__('Job: ')); ?>  <?php echo e($data->initial_job); ?> <br>
                                            <?php if($data->payment_status == 'pending' || $data->payment_status == ''): ?>
                                            <?php echo e(__('Pending Connect: ')); ?>

                                            <?php echo e($data->initial_connect); ?> <br>
                                            <?php endif; ?>
                                            <?php echo e(__('Expire Date:')); ?> <?php echo e(date('d-m-Y', strtotime($data->expire_date))); ?><br>
                                        </td>
                                        <td>
                                            <?php echo e(__('Name:')); ?> <?php echo e(optional($data->seller)->name); ?> <br>
                                            <?php echo e(__('Email:')); ?> <?php echo e(optional($data->seller)->email); ?> <br>
                                            <?php echo e(__('Country:')); ?> <?php echo e(optional(optional($data->seller)->country)->country); ?> <br>
                                            <?php echo e(__('City:')); ?> <?php echo e(optional(optional($data->seller)->city)->service_city); ?> <br>
                                        </td>
                                        <td>
                                            <?php echo e(__('Payment Gateway:')); ?> <?php echo e(ucfirst($data->payment_gateway)); ?> <br>
                                            <?php echo e(__('Payment Status:')); ?> <?php echo e(ucfirst($data->payment_status=='complete' ? 'complete' : 'pending')); ?> <br>
                                            <?php if($data->payment_status == 'pending' || $data->payment_status == ''): ?>
                                                <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.status-change','data' => ['url' => route('admin.seller.subscription.payment.status',$data->id)]]); ?>
<?php $component->withName('status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.seller.subscription.payment.status',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('subscription-status')): ?>
                                                <?php if($data->status == 1): ?>
                                                    <span class="btn- btn-success p-2"><?php echo e(__('Active')); ?></span>
                                                    <?php else: ?>
                                                    <span class="btn btn-danger p-2"><?php echo e(__('Inactive')); ?></span>
                                                <?php endif; ?>
                                                <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.status-change','data' => ['url' => route('admin.seller.subscription.status',$data->id)]]); ?>
<?php $component->withName('status-change'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.seller.subscription.status',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo e(route('admin.seller.subscription.history',$data->id)); ?>"><?php echo e(__('History')); ?></a>
                                        </td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send-email')): ?>
                                                 <a href="<?php echo e(route('admin.seller.subscription.email',$data->id)); ?>" class="btn btn-info btn-sm mb-3 mr-1"><?php echo e(__('Send Email ')); ?></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('admin.seller.subscription.buy')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Buy Subscription For  A Seller')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> <?php echo e(__('Select Package')); ?> </label>
                                <select name="subscription_id" class="form-control">
                                    <option value=""><?php echo e(__('Select Package')); ?></option>
                                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subs->id); ?>"><?php echo e($subs->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> <?php echo e(__('Select Seller')); ?> </label>
                                <br><small class="text-info"><?php echo e(__('seller list who has no subscription')); ?></small>
                                <select name="seller_id" class="form-control">
                                    <option value=""><?php echo e(__('Select Seller')); ?></option>
                                    <?php if($sellers): ?>
                                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> <?php echo e(__('Payment Status')); ?> </label>
                                <select name="payment_status" class="form-control">
                                    <option value=""><?php echo e(__('Select Payment Status')); ?></option>
                                        <option value="<?php echo e(__('complete')); ?>"><?php echo e(__('Complete')); ?></option>
                                        <option value="<?php echo e(__('pending')); ?>"><?php echo e(__('Pending')); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <label for="priority" class="info-title"> <?php echo e(__('Payment Gateway')); ?> </label>

                                <select name="payment_gateway" class="form-control">
                                    <option value=""><?php echo e(__('Select Payment Gateway')); ?></option>
                                    <?php
                                        $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','marcadopago','instamojo','cashfree','payfast','midtrans','squareup','cinetpay','paytabs','billplz','zitopay'];
                                    ?>
                                    <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty(get_static_option($gateway.'_gateway'))): ?>
                                            <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action-js','data' => ['url' => route('admin.seller.subscription.bulk.action')]]); ?>
<?php $component->withName('bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.seller.subscription.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    $(document).on('click','.swal_status_change',function(e){
                        e.preventDefault();
                        Swal.fire({
                            title: '<?php echo e(__("Are you sure to change status?")); ?>',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, change it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(this).next().find('.swal_form_submit_btn').trigger('click');
                            }
                        });
                    });
            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/Modules/Subscription/Resources/views/backend/seller-subscriptions.blade.php ENDPATH**/ ?>