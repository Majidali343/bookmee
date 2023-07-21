
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Pending Orders')); ?>

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
                <?php if($pending_orders->count() >= 1): ?>
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('Pending Bookings')); ?>(<?php echo e($pending_orders->total()); ?>) </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php $__currentLoopData = $pending_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dashboard-order-single margin-top-40">
                                <div class="dashboard-thumb-flex">
                                    <div class="thumb">
                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                        <?php echo render_image_markup_by_attachment_id(optional($order->service)->image); ?>

                                        </a>
                                    </div>
                                    <div class="contents">
                                        <h4 class="title"> <a href="<?php echo e(route('seller.order.details', $order->id)); ?>"><?php echo e(optional($order->service)->title); ?> </a> </h4>
                                        <span class="orders"> <?php echo e(__('Booking').' #'.$order->id); ?> </span>
                                        <div class="btn-wrapper margin-top-30">
                                            
                                            <?php if($order->status==1): ?>
                                            <span class="cmn-btn completed"><?php echo e(__('Active Orders')); ?> </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-oreder-request">
                                    <span class="orders" style="color: #03989E">
                                        <h2 class="title color-three" style="color: #03989E" > <?php echo e(float_amount_with_currency_symbol($order->total)); ?> </h2>

                                          <?php if($order->date === 'No Date Created'): ?>
                                             <span><?php echo e(__('No Date Created')); ?></span>
                                             <?php else: ?>
                                             </strong><?php echo e(Carbon\Carbon::parse($order->date)->format('d/m/y')); ?>

                                            <?php endif; ?>
                                    </span>
                                    <span class="orders" style="color: #03989E"><?php echo e(__($order->schedule)); ?></span>
                                </div>
                                <div class="dashboard-request-cancel">
                                    <div class="btn-wrapper" >
                                        <a  style="background-color: #03989E"
                                          href="javascript:void(0)" 
                                            class="cmn-btn btn-bg-3 edit_status_modal"
                                            data-toggle="modal"
                                            data-target="#editStatusModal"
                                            data-id="<?php echo e($order->id); ?>"><?php echo e(__('Change Status')); ?>

                                        </a>
                                    </div>
                                    <?php if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending'): ?>
                                    <div class="btn-wrapper mt-2">
                                        <a style="background-color: #03989E" href="javascript:void(0)"
                                           class="cmn-btn btn-bg-3 edit_payment_status_modal"
                                           data-toggle="modal"
                                           data-target="#editPaymentStatusModal"
                                           data-id="<?php echo e($order->id); ?>"><?php echo e(__('Payment Status')); ?>

                                        </a>
                                    </div>
                                    <?php endif; ?>


                                    
                                    <div class="dashboard-icons margin-top-30">
                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('View Details')); ?>">
                                             <i class="las la-eye"></i>
                                            </span> 
                                        </a>
                                       
                                        <a href="<?php echo e(route('seller.order.invoice.details',$order->id)); ?>">
                                            <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Print Pdf')); ?>"> 
                                                <i class="las la-print"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    <?php echo $pending_orders->links(); ?>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php else: ?> 
                <h2 class="no_data_found"><?php echo e(__('No Orders Found')); ?></h2>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
        <form action="<?php echo e(route('seller.order.status')); ?>" method="post">
            <input type="hidden" id="order_id" name="order_id">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Change Status')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="mb-3 text-danger">
                            <li><strong><?php echo e(__( 'Status Meaning:')); ?></strong></li>
                            <li><?php echo e(__('Pending: Did not start the job yet.')); ?></li>
                            <li><?php echo e(__('Active: Job already started.')); ?></li>
                            <li><?php echo e(__('Delivered: Order Deliverd For Checking.')); ?></li>
                            <li><?php echo e(__('Completed: Order is completed and closed.')); ?></li>
                        </ul>

                        <div class="form-group">
                            <label for="up_day_id"><?php echo e(__('Select Status')); ?></label>
                            <select name="status" id="status" class="form-control nice-select">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="0"><?php echo e(__('Pending')); ?></option>
                                <option value="1"><?php echo e(__('Active')); ?></option>
                                <option value="2"><?php echo e(__('Completed')); ?></option>
                                <option value="3"><?php echo e(__('Delivered')); ?></option>
                                <option value="4"><?php echo e(__('Cancelled')); ?></option>
                            </select>
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
    <div class="modal fade" id="editPaymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
        aria-hidden="true">
        <form action="<?php echo e(route('seller.order.payment.status')); ?>" method="post">
            <input type="hidden"  name="order_id">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Change Payment Status')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="up_day_id"><?php echo e(__('Select Status')); ?></label>
                            <select name="status" id="status" class="form-control nice-select">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="complete"><?php echo e(__('Completed')); ?></option>
                            </select>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    $('#order_id').val(order_id);
                    $('.nice-select').niceSelect('update');
                });
                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });


                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__('Are you sure?')); ?>',
                        text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, delete it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/order/pending-orders.blade.php ENDPATH**/ ?>