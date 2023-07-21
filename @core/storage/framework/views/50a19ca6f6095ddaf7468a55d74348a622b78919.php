
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Schedules')); ?>

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
                                <h2 class="dashboards-title"> <?php echo e(__('All Schedules')); ?> </h2>
                                <div class="notice-board">
                                    <p><?php echo e(__('schedules will show while a customer booking your order')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-5">
                            <form action="<?php echo e(route('seller.allow.multiple.schedule')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="allow_multiple_schedule">
                                    <?php
                                        $allow_or_not = App\Schedule::select('allow_multiple_schedule')->first();
                                    ?>
                                    <label class="total_day_label"> <?php echo e(__('Allow Multiple Order to Same Schedule ')); ?> </label>
                                    <select name="allow_multiple_schedule">
                                        <option value="<?php echo e(__('yes')); ?>" <?php if($allow_or_not?->allow_multiple_schedule=='yes'): ?> selected <?php endif; ?>> <?php echo e(__('Yes')); ?></option>
                                        <option value="<?php echo e(__('no')); ?>" <?php if($allow_or_not?->allow_multiple_schedule=='no'): ?> selected <?php endif; ?>> <?php echo e(__('No')); ?></option>
                                    </select>
                                    <p><?php echo e(__('If you select yes than buyer will place multiple order at the same schedule')); ?></p>
                                </div>
                                <input type="submit" value="<?php echo e(__('Submit')); ?>" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                    <div class="btn-wrapper margin-top-50 text-right">
                        <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addScheduleModal"><?php echo e(__('Add New Schedule')); ?></button>
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
                            <table class="table table-bordered" style="color: black">
                                <thead>
                                    <tr>
                                        <th><strong><?php echo e(__('No')); ?></strong></th>
                                        <th><strong><?php echo e(__('Date')); ?></strong></th>
                                        <th><strong><?php echo e(__('Schedule')); ?></strong></th>
                                        <th><strong><?php echo e(__('Action')); ?></strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e(__(optional($data->days)->day)); ?></td>
                                        <td><?php echo e($data->schedule); ?></td>
                                        <td>
                                            <div class="dashboard-switch-single">

                                               <a href="#0" class="edit_schedule_modal"
                                               data-toggle="modal" 
                                               data-target="#editScheduleModal"
                                               data-id="<?php echo e($data->id); ?>"
                                               data-dayid="<?php echo e($data->day_id); ?>"
                                               data-schedule="<?php echo e($data->schedule); ?>"
                                               >
                                               <span class="dash-icon dash-edit-icon color-1" style="color:#03989E"> <i class="las la-edit" ></i> </span>
                                            </a>
                                               <span style="color:#03989E"><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.schedule.delete',$data->id)]]); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.schedule.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            <?php echo $schedules->links(); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <!-- Add Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.add.schedule')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ScheduleModal"><?php echo e(__('Add New Schedule')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group margin-bottom-60 mb-5">
                            <label for="day_id"><?php echo e(__('Select Day')); ?></label>
                            <select name="day_id" id="day_id" class="form-control">
                                <option value=""><?php echo e(__('Select Day')); ?></option>
                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($day->id); ?>"><?php echo e(__($day->day)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <br>
                        <div class="form-group mt-3">
                            <div class="form-check">
                                <input class="form-check-input" name="schedule_for_all_days" type="checkbox"  id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <?php echo e(__('Add this schedule time for all days.')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="schedule"><?php echo e(__('Schedule Time')); ?></label>
                            <input type="text" name="schedule" id="schedule" class="form-control" placeholder="<?php echo e(__('Schedule Time')); ?>">
                            <span class="info"><?php echo e(__('eg: 10:00Am - 11:00PM, this schedule time will show in frontend, when anyone want to book your service, they will select this schedule time made by you')); ?></span>
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


    
    <!-- Edit Modal -->
    <div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.edit.schedule')); ?>" method="post">
            <input type="hidden" id="up_id" name="up_id" >
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal"><?php echo e(__('Edit Schedule')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="up_day_id"><?php echo e(__('Select Day')); ?></label>
                            <select name="up_day_id" id="up_day_id" class="form-control nice-select">
                                <option value=""><?php echo e(__('Select Day')); ?></option>
                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($day->id); ?>"><?php echo e($day->day); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="up_schedule"><?php echo e(__('Schedule')); ?></label>
                            <input type="text" name="up_schedule" id="up_schedule" class="form-control">
                            <span class="info"><?php echo e(__('eg: 10:00Am - 11:00PM, this schedule time will show in frontend, when anyone want to book your service, they will select this schedule time made by you')); ?></span>
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

                $(document).on('click','.edit_schedule_modal',function(e){
                    e.preventDefault();
                    let schedule_id = $(this).data('id');
                    let day_id = $(this).data('dayid');
                    let schedule = $(this).data('schedule');

                    console.log(schedule_id + day_id);

                    $('#up_id').val(schedule_id);
                    $('#up_day_id').val(day_id);
                    $('#up_schedule').val(schedule);
                    $('.nice-select').niceSelect('update');
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
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/day-and-schedule/schedules.blade.php ENDPATH**/ ?>