
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Orders')); ?>

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
    <style>
        .table-td-padding {
            border-collapse: separate;
            border-spacing: 10px 20px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/font-awesome.min.css')); ?>">
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
                <?php if($all_orders->count() >= 1): ?>
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"><?php echo e(__('All Service bookings')); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                        <div class="col-lg-12 margin-top-40">
                            <div class="dashboard-status-list">
                                <ul class="tabs status-order-list margin-bottom-10">
                                   <?php echo $__env->make('frontend.user.seller.partials.tab-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </ul>
                            </div>

                            <div>
                                <div class="table-responsive table-responsive--md">
                                    <table id="all_order_table" class="custom--table table-td-padding">
                                        <thead>
                                            <tr>
                                                <th> <?php echo e(__('Booking ID')); ?> </th>
                                                <th> <?php echo e(__('Customer Name')); ?> </th>
                                                <?php if(request()->path() == 'seller/job-orders'): ?>
                                                <!--job order title -->
                                                <th> <?php echo e(__('Service')); ?> </th>
                                                <th> <?php echo e(__('Service Date')); ?> </th>
                                                <?php else: ?>
                                                    <!--Service order title -->
                                                    <th> <?php echo e(__('Service Name')); ?> </th>
                                                    <th> <?php echo e(__('Service Date')); ?> </th>
                                                    <th> <?php echo e(__('Service Time')); ?> </th>
                                                <?php endif; ?>
                                                <th> <?php echo e(__('Order Pricing')); ?> </th>
                                                <th> <?php echo e(__('Payment Status')); ?> </th>
                                                <th> <?php echo e(__('Booking Status')); ?> </th>
                                                <th> <?php echo e(__('Booking Type')); ?> </th>
                                                <th> <?php echo e(__('Complete Request')); ?> </th>
                                                <th> <?php echo e(__('Actions')); ?> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $all_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td data-label="Order ID"> <?php echo e($order->id); ?> </td>
                                                    <td data-label="Buyer Name"> <?php echo e($order->name); ?> </td>

                                                    <!--service and job order info -->
                                                    <?php if(request()->path() == 'seller/job-orders'): ?>
                                                        <td data-label="Job Title"> <?php echo e(Str::limit(optional($order->job)->title,20)); ?> </td>
                                                        <td data-label="Order Date"> <?php echo e(Carbon\Carbon::parse( strtotime($order->created_at))->format('d/m/y')); ?> </td>
                                                    <?php else: ?>
                                                        <td data-label="Service Name"> <?php echo e(optional($order->service)->title); ?> </td>
                                                        <td data-label="Service Date">
                                                            <?php if($order->date === 'No Date Created'): ?>
                                                                <span><?php echo e(__('No Date Created')); ?></span>
                                                            <?php else: ?>
                                                                <?php echo e(Carbon\Carbon::parse( strtotime($order->date))->format('d/m/y')); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td data-label="Service Time"> <?php echo e(__($order->schedule)); ?></td>
                                                    <?php endif; ?>

                                                    <td data-label="Order Pricing"> <?php echo e(float_amount_with_currency_symbol($order->total)); ?></td>
                                                    <td data-label="Payment Status">
                                                        <?php if($order->payment_status == 'pending'): ?>
                                                            <span class="text-danger"><?php echo e(__('Pending')); ?></span>
                                                            <?php if($order->payment_gateway == 'cash_on_delivery'): ?>
                                                                <span class="text-info"><strong><?php echo e(__('Payment Type: ')); ?></strong><?php echo e(__('Cash on Delivery')); ?></span>
                                                                <br>
                                                                <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.cancel-order','data' => ['url' => route('seller.order.cancel.cod.payment.pending',$order->id)]]); ?>
<?php $component->withName('cancel-order'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.order.cancel.cod.payment.pending',$order->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if($order->payment_status == 'complete'): ?>
                                                            <span class="text-success"><?php echo e(__('Complete')); ?></span>
                                                        <?php endif; ?>
                                                            <?php if(empty($order->payment_status)): ?>
                                                                <span class="text-danger"><?php echo e(__('Pending')); ?></span>
                                                            <?php endif; ?>
                                                    </td>

                                                    <?php if($order->status == 0): ?> <td data-label="Order Status" class="pending"><span><?php echo e(__('Pending')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 1): ?> <td data-label="Order Status" class="order-active"><span><?php echo e(__('Active')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 2): ?> <td data-label="Order Status" class="completed"><span><?php echo e(__('Completed')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 3): ?> <td data-label="Order Status" class="order-deliver"><span><?php echo e(__('Delivered')); ?></span></td><?php endif; ?>
                                                    <?php if($order->status == 4): ?> <td data-label="Order Status" class="canceled"><span><?php echo e(__('Cancelled')); ?></span></td><?php endif; ?>

                                                    <td data-label="Order Pricing">
                                                        <?php if($order->is_order_online==1): ?>
                                                        <span class="btn btn-success"><?php echo e(__('Online')); ?></span>
                                                        <?php else: ?>
                                                        <span class="btn btn-info"><?php echo e(__('Offline')); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td data-label="Order Status" style="color: beige" >
                                                        <span class="<?php echo e(in_array($order->order_complete_request,[0,1]) ? 'pending' : 'completed'); ?> d-block" style="background-color: rgb(29 54 90);">
                                                            <?php if( in_array($order->order_complete_request,[0,1])): ?>
                                                            <?php if($order->payment_status != 'pending'): ?>
                                                                <?php if($order->order_complete_request == 0): ?>
                                                                    <a href="#0" class="edit_status_modal"
                                                                       data-toggle="modal"
                                                                       data-target="#editStatusModal"
                                                                       data-id="<?php echo e($order->id); ?>"
                                                                       data-status="<?php echo e($order->status); ?>">
                                                                        <span class="dash-icon color-1-2" >
                                                                            <?php echo e(__('Is it Completed?')); ?>

                                                                        </span>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <span><?php echo e(__('Request Pending')); ?></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <?php elseif($order->order_complete_request == 2): ?>
                                                                <?php echo e(__('Completed')); ?>

                                                            <?php endif; ?>
                                                            
                                                            <?php if($order->order_complete_request == 3): ?>
                                                                    <a href="#0" class="edit_status_modal"
                                                                       data-toggle="modal"
                                                                       data-target="#editStatusModal"
                                                                       data-id="<?php echo e($order->id); ?>"
                                                                       data-status="<?php echo e($order->status); ?>">
                                                                        <span class="dash-icon color-1">
                                                                            <?php echo e(__('Create Complete Request')); ?>

                                                                        </span>
                                                                    </a> <br>
                                                                <?php if(optional($order->completedeclinehistory)->count() >=1): ?>
                                                                <span class="btn btn-warning"><a href="<?php echo e(route('seller.order.request.decline.history',$order->id)); ?>"> <?php echo e(__('View History')); ?> </a></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </span>

                                                            
                                                    </td>

                                                    <td data-label="Action">

                                                        <?php if($order->order_complete_request == 2): ?>
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#reviewModal"
                                                               data-buyer_id="<?php echo e($order->buyer_id); ?>"
                                                               data-service_id="<?php echo e($order->service_id); ?>"
                                                               data-order_id="<?php echo e($order->id); ?>"
                                                               class="review_add_modal"
                                                            >
                                                                <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Review')); ?>"> <i class="las la-star"></i> </span>
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('View Details')); ?>">
                                                                <i class="las la-eye"></i>
                                                            </span>
                                                        </a>
                                                       
                                                        <?php if($order->is_order_online != 1): ?>
                                                             <a href="<?php echo e(route('seller.support.ticket.new', $order->id)); ?>">
                                                            <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Create Ticket')); ?>">
                                                             <i class="las la-ticket-alt"></i>
                                                            </span>
                                                            </a>
                                                        <?php else: ?> 
                                                            <?php if(!empty($order->online_order_ticket->id)): ?>
                                                             <a href="<?php echo e(route('seller.support.ticket.view',optional($order->online_order_ticket)->id)); ?>">
                                                                <span class="icon eye-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('View Ticket')); ?>">
                                                                    <i class="las la-eye-slash"></i>
                                                                </span>
                                                            </a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending'): ?>
                                                                <a href="javascript:void(0)"
                                                                   class="edit_payment_status_modal"
                                                                   data-toggle="modal"
                                                                   data-target="#editPaymentStatusModal"
                                                                   data-id="<?php echo e($order->id); ?>">
                                                                    <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Change Payment Status')); ?>">
                                                                        <i class="las la-money-check-alt"></i>
                                                                    </span>
                                                                </a>
                                                        <?php endif; ?>
                                                        <a href="<?php echo e(route('seller.order.invoice.details',$order->id)); ?>">
                                                            <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Print Pdf')); ?>"> 
                                                                <i class="las la-print"></i>
                                                            </span>
                                                        </a>
                                                        <?php if($order->status != 2): ?>
                                                            <a href="#"
                                                               data-toggle="modal"
                                                               data-target="#reportModal"
                                                               data-buyer_id="<?php echo e($order->buyer_id); ?>"
                                                               data-service_id="<?php echo e($order->service_id); ?>"
                                                               data-order_id="<?php echo e($order->id); ?>"
                                                               class="report_add_modal">
                                                                <span class="icon print-icon" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Report')); ?>">
                                                                    <i class="las la-file"></i>
                                                                </span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        <?php echo $all_orders->links(); ?>

                                    </div>
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
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Create Order Complete Request')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="up_day_id"><?php echo e(__('Select Status')); ?></label>
                            <select name="status" id="status" class="form-control">
                                <option value=""><?php echo e(__('Select Status')); ?></option>
                                <option value="2"><?php echo e(__('Completed')); ?></option>
                            </select>
                            <p class="text-info"><?php echo e(__('Completed: Order is completed and closed.')); ?></p>
                        </div>

                        <div class="form-group ">
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="image">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="<?php echo e(__('Select Image')); ?>"
                                        data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                        data-target="#media_upload_modal">
                                    <?php echo e(__('Upload Main Image')); ?>

                                </button>
                                <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small>
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

    
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.order.report')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Report')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="comments-flex-item">
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block pt-4" for="amount"><?php echo e(__('Report Us')); ?></label>
                            <textarea id="report" rows="5" name="report" class="form-control form--message" placeholder="<?php echo e(__('Report Here')); ?>"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Send Report')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    
    <div class="modal fade" id="extraServiceRequest" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.order.extra.service')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" ><?php echo e(__('Request For Extra Service')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="comments-flex-item">
                            <input type="hidden" name="order_id" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="amount"><?php echo e(__('Title')); ?></label>
                            <input type="text" name="title" class="form-control" placeholder="<?php echo e(__('title')); ?>">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="quantity"><?php echo e(__('Quantity')); ?></label>
                            <input type="number" name="quantity" class="form-control" placeholder="<?php echo e(__('Quantity')); ?>">
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block" for="price"><?php echo e(__('Price')); ?></label>
                            <input type="number" name="price" class="form-control" step="0.05" placeholder="<?php echo e(__('price')); ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--For the Job order Seller to buyer Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.to.buyer.review')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Review')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="comments-flex-item">
                            <div class="single-commetns" style="font-size: 1em;">
                                <label class="comment-label"> <?php echo e(__('Ratings*')); ?> </label>
                                <div id="review"></div>
                            </div>

                            <input type="hidden" id="rating" name="rating" class="form-control form-control-sm">
                            <input type="hidden" id="buyer_id" name="buyer_id" class="form-control form-control-sm">
                            <input type="hidden" id="service_id" name="service_id" class="form-control form-control-sm">
                            <input type="hidden" id="order_id" name="order_id" class="form-control form-control-sm">

                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block pt-4" for="amount"><?php echo e(__('Comments')); ?></label>
                            <textarea id="message" rows="5" name="message" class="form-control form--message" placeholder="<?php echo e(__('Post Comments')); ?>"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Send Review')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/rating.js')); ?>"></script>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => ['type' => 'web']]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                //order cancel status
                $(document).on('click','.swal_status_change_order_cancel',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to cancel the order")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, cancel it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn_cancel_order').trigger('click');
                        }
                    });
                });

                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });

                /* ------------------------------
                *   Request for extra service
                * -----------------------------*/
                $(document).on('click', '.extra_submit_request_btn', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let modalContainer = $('#extraServiceRequest');

                    modalContainer.find('input[name="order_id"]').val(order_id);
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

                //report us
                $(document).on('click', '.report_add_modal', function () {
                    let el = $(this);
                    let buyer_id = el.data('buyer_id');
                    let service_id = el.data('service_id');
                    let order_id = el.data('order_id');
                    let form = $('#reportModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });


                // seller to buyer review start
                $(document).on('click', '.review_add_modal', function () {
                    let el = $(this);

                    let buyer_id = el.data('buyer_id');

                    let service_id = el.data('service_id');

                    let order_id = el.data('order_id');

                    let form = $('#reviewModal');
                    form.find('#buyer_id').val(buyer_id);
                    form.find('#service_id').val(service_id);
                    form.find('#order_id').val(order_id);
                });

                // rating
                $("#review").rating({
                    "value": 5,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });

            });

        })(jQuery);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/order/orders.blade.php ENDPATH**/ ?>