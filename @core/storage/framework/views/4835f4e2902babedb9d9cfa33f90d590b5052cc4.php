
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Reports')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
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
                <?php echo $__env->make('frontend.user.buyer.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($reports->count() >= 1): ?>
                    <div class="dashboard-right">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title"><?php echo e(__('All Reports')); ?></h2>
                                </div>
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div>
                                    <div class="table-responsive table-responsive--md">
                                        <table id="all_order_table" class="custom--table table-td-padding">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Order ID')); ?> </th>
                                                <th> <?php echo e(__('Report ID')); ?> </th>
                                                <th> <?php echo e(__('Report Details')); ?> </th>
                                                <th> <?php echo e(__('Seller Details')); ?> </th>
                                                <th> <?php echo e(__('Conversation')); ?> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td data-label="<?php echo e(__('Order ID')); ?>"> <?php echo e($report->order_id); ?> </td>
                                                    <td data-label="<?php echo e(__('Report ID')); ?>"> <?php echo e($report->id); ?> </td>
                                                    <td data-label="<?php echo e(__('Seller Name')); ?>">
                                                        <p><strong><?php echo e(__('Report From:')); ?></strong> <?php echo e(ucfirst($report->report_from)); ?></p>
                                                        <p><strong><?php echo e(__('Report To:')); ?></strong> <?php echo e(ucfirst($report->report_to)); ?></p>
                                                        <p><strong><?php echo e(__('Report Date:')); ?></strong> <?php echo e(date('d-m-Y', strtotime($report->created_at))); ?></p>
                                                        <p><strong><?php echo e(__('Description:')); ?></strong> <span class="btn btn-info report_description" data-toggle="modal" data-target="#reportModal" data-report="<?php echo e($report->report); ?>"><i class="ti-eye"></i></span></p>
                                                    </td>
                                                    <td>
                                                        <p><strong><?php echo e(__('Name:')); ?></strong> <?php echo e(optional($report->seller)->name); ?></p>
                                                        <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e(optional($report->seller)->email); ?></p>
                                                        <p><strong><?php echo e(__('Phone:')); ?></strong> <?php echo e(optional($report->seller)->phone); ?></p>
                                                    </td>
                                                    <td><a class="btn btn-info btn-sm" href="<?php echo e(route('buyer.order.report.chat.admin',$report->id)); ?>"><?php echo e(__('Chat To Admin')); ?></a></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="blog-pagination margin-top-55">
                                        <div class="custom-pagination mt-4 mt-lg-5">
                                            <?php echo $reports->links(); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <h2 class="no_data_found"><?php echo e(__('No Reports Found')); ?></h2>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModal"
         aria-hidden="true">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal"><?php echo e(__('Report Details')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="report_description"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                $(document).on('click','.report_description',function(e){
                    let report_description = $(this).data('report');
                    $('#report_description').text(report_description);
                });
            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/buyer/report/report-list.blade.php ENDPATH**/ ?>