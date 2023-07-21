
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Business Hours')); ?>

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
                                <h2 class="dashboards-title"> <?php echo e(__('Business Hours')); ?> </h2>
                            </div>
                        </div>
                    </div>




                    <div class="btn-wrapper text-right">
                        <button class="cmn-btn btn-bg-1" data-toggle="modal" data-target="#addDayModal"><?php echo e(__('Add Working Hours ')); ?></button>
                    </div>

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                     
                                        <th><?php echo e(__('Day')); ?></th>
                                        <th><?php echo e(__('From')); ?></th>
                                        <th><?php echo e(__('To')); ?></th>
                                        <th><?php echo e(__('Edit')); ?></th>
                                        <th><?php echo e(__('Delete')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->day); ?></td>
                                        <td><?php echo e($item->to_time); ?></td>
                                        <td><?php echo e($item->from_time); ?></td>
                                        <td >
                                        <a href="#0" class="edit_schedule_modal"
                                        data-toggle="modal" 
                                        data-target="#editDayModal"
                                        data-id="<?php echo e($item->id); ?>"
                                        data-day="<?php echo e($item->day); ?>"
                                        data-to="<?php echo e($item->to_time); ?>"
                                        data-from="<?php echo e($item->from_time); ?>"
                                        >
                                        <span class="dash-icon dash-edit-icon color-1" style="color:#03989E"> <i class="las la-edit" ></i> </span>
                                     </a>
                                        <td>
                                            <div class="dashboard-switch-single">
                                               <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.seller-delete-popup','data' => ['url' => route('timedelete',$item->id)]]); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('timedelete',$item->id))]); ?>
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
 

     
       <!-- Edit Modal -->
    <div class="modal fade" id="editDayModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <form action="<?php echo e(route('timeedit')); ?>" method="post">
            <input type="hidden" id="edit_id" name="up_id" >
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
                            <select name="eday" id="eup_day_id" class="form-control nice-select" required>
                                <option value=""><?php echo e(__('Select Day')); ?></option>
                                <option value="Monday" ><?php echo e(__('Monday')); ?></option>
                                <option value="Tuesday"><?php echo e(__('Tuesday')); ?></option>
                                <option value="Wednesday"><?php echo e(__('Wednesday')); ?></option>
                                <option value="Thursday"><?php echo e(__('Thursday')); ?></option>
                                <option value="Friday"><?php echo e(__('Friday')); ?></option>
                                <option value="Saturday"><?php echo e(__('Saturday')); ?></option>
                                <option value="Sunday"><?php echo e(__('Sunday')); ?></option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="schedule"><?php echo e(__('Opening Time')); ?></label>
                            <input type="text" name="eopening_time" id="eschedule" class="form-control" placeholder="<?php echo e(__('Opening Time')); ?>" required>
                            <span class="info"><?php echo e(__('eg: 8:00Am ,11:00Am, The opening time will let the Customers know when You start Busniess on particular day')); ?></span>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="schedule"><?php echo e(__('Closing Time ')); ?></label>
                            <input type="text" name="eclosing_time" id="ecschedule" class="form-control" placeholder="<?php echo e(__('Closing Time')); ?>" required>
                            <span class="info"><?php echo e(__('eg: 6:00PM , 12:00PM, The Closing time will let the Customers know when You Close Business on particular day')); ?></span>
                        </div>

                    

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Update Timings')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addDayModal" tabindex="-1" role="dialog" aria-labelledby="dayModal" aria-hidden="true">
        
    <form action="<?php echo e(route('addtimings')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="dayModal"><?php echo e(__('Edit Working Hours')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="up_day_id"><?php echo e(__('Select Day')); ?></label>
                        <select name="day" id="up_day_id" class="form-control nice-select" required>
                            <option value=""><?php echo e(__('Select Day')); ?></option>
                            <option value="Monday" ><?php echo e(__('Monday')); ?></option>
                            <option value="Tuesday"><?php echo e(__('Tuesday')); ?></option>
                            <option value="Wednesday"><?php echo e(__('Wednesday')); ?></option>
                            <option value="Thursday"><?php echo e(__('Thursday')); ?></option>
                            <option value="Friday"><?php echo e(__('Friday')); ?></option>
                            <option value="Saturday"><?php echo e(__('Saturday')); ?></option>
                            <option value="Sunday"><?php echo e(__('Sunday')); ?></option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="schedule"><?php echo e(__('Opening Time')); ?></label>
                        <input type="text" name="opening_time" id="schedule" class="form-control" placeholder="<?php echo e(__('Opening Time')); ?>" required>
                        <span class="info"><?php echo e(__('eg: 8:00Am ,11:00Am, The opening time will let the Customers know when You start Busniess on particular day')); ?></span>
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="schedule"><?php echo e(__('Closing Time ')); ?></label>
                        <input type="text" name="closing_time" id="schedule" class="form-control" placeholder="<?php echo e(__('Closing Time')); ?>" required>
                        <span class="info"><?php echo e(__('eg: 6:00PM , 12:00PM, The Closing time will let the Customers know when You Close Business on particular day')); ?></span>
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
                    let edit_id = $(this).data('id');
                    let eday = $(this).data('day');
                    let day_to = $(this).data('to');
                    let day_from = $(this).data('from');

                    console.log(edit_id + eday+day_to + day_from);

                    $('#edit_id').val(edit_id);
                    $('#eup_day_id').val(eday);
                    $('#eschedule').val(day_to);
                    $('#ecschedule').val(day_from);

                    // $('.nice-select').niceSelect('update');
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
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/businessdays/timings.blade.php ENDPATH**/ ?>