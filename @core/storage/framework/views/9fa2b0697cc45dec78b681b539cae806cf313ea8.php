
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Days')); ?>

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
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('All Days')); ?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="total_service_day_count mt-4 mt-lg-5">
                        <form class="total_service_day" action="<?php echo e(route('seller.update.totalday')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form_service_day">
                                <label class="total_day_label"> <?php echo e(__('Select Service Day')); ?> </label>
                                <select name="total_day">
                                <?php if(empty($total_day)): ?> 
                                    <?php for($i=1; $i<=30; $i++): ?>{ 
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(__('Day')); ?></option>
                                    }
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <?php for($i=1; $i<=30; $i++): ?>{
                                    <option value="<?php echo e($i); ?>" <?php if($total_day->total_day==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> <?php echo e(__('Day')); ?></option>
                                    }
                                    <?php endfor; ?>
                                <?php endif; ?>
                                </select>
                            </div>
                            <div class="btn-wrapper mt-4">
                                <button type="submit" class="cmn-btn btn-bg-1"><?php echo e(__('Update')); ?></button>
                            </div>
                        </form>
                        <div class="btn-wrapper text-right">
                            <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addDayModal"><?php echo e(__('Add New Service Day')); ?></button>
                        </div>
                    </div>
                    <div class="notice-board">
                        <p style="text-align:left;" style="color:black"><?php echo e(__('selected days will show while booking an order')); ?></p>
                    </div>

                    <div class="mt-5"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?> </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('No')); ?></th>
                                        <th><?php echo e(__('Day')); ?></th>
                                        <th><?php echo e(__('Schedule')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(__($data->day)); ?></td>
                                        <td>
                                            <?php if(isset($data['schedules']) && $data->schedules->count()): ?>
                                                <?php $__currentLoopData = $data['schedules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="btn btn-sm btn-success day_wise_service_schedule"><?php echo e($schedule->schedule); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dashboard-switch-single">
                                               <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.day.delete',$data->id)]]); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.day.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
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

    
    <!-- Add Modal -->
    <div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="dayModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.add.day')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="dayModal"><?php echo e(__('Add New Day')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="day"><?php echo e(__('Day')); ?></label>
                            <select name="day" id="day" class="form-control">
                                <option value=""><?php echo e(__('Select Day')); ?></option>
                                <option value="Sat"><?php echo e(__('Saturday')); ?></option>
                                <option value="Sun"><?php echo e(__('Sunday')); ?></option>
                                <option value="Mon"><?php echo e(__('Monday')); ?></option>
                                <option value="Tue"><?php echo e(__('Tuesday')); ?></option>
                                <option value="Wed"><?php echo e(__('Wednesday')); ?></option>
                                <option value="Thu"><?php echo e(__('Thursday')); ?></option>
                                <option value="Fri"><?php echo e(__('Friday')); ?></option>
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
        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.edit_date_modal',function(e){
                    e.preventDefault();
                    let date_id = $(this).data('id');
                    let date = $(this).data('date');
                    $('#up_id').val(date_id)
                    $('#up_date').val(date)
                });


                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                        Swal.fire({
                        title: '<?php echo e(__("Are you sure?")); ?>',
                        text: '<?php echo e(__("You would not be able to revert this item!")); ?>',
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
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/day-and-schedule/days.blade.php ENDPATH**/ ?>