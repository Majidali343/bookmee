
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Coupons')); ?>

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

    <style>
        .check-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-height: 18px;
            min-width: 18px;
            cursor: pointer;
            background: #fff;
            border: 1px solid #dddddd;
            border-radius: 0px;
            margin-top: 3px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .check-input::after {
            content: "";
            font-family: "Line Awesome Free";
            font-weight: 900;
            font-size: 10px;
            color: #fff;
            visibility: hidden;
            opacity: 0;
            -webkit-transform: scale(1.6) rotate(90deg);
            transform: scale(1.6) rotate(90deg);
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
        }

        .check-input:checked {
            background: var(--main-color-one);
            border-color: var(--main-color-one);
            background: var(--main-color-one);
        }

        .check-input:checked::after {
            visibility: visible;
            opacity: 1;
            -webkit-transform: scale(1.2) rotate(0deg);
            transform: scale(1.2) rotate(0deg);
        }

        .checkbox-label {
            cursor: pointer;
            text-align: left;
            line-height: 26px;
            font-size: 18px;
            font-weight: 500;
            color: var(--heading-color);
        }

        @media  only screen and (max-width: 575.98px) {
            .checkbox-label {
                font-size: 15px;
            }
        }
    </style>
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
                        <div class="d-flex w-100 justify-content-between col flex-wrap">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('All Staff Members')); ?> </h2>
                            </div>
                            <div class="btn-wrapper margin-top-50 text-right">
                                <button class="cmn-btn btn-bg-1" data-toggle="modal"
                                    data-target="#addStaffModal"><?php echo e(__('Add New Staff')); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
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

                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Staff ID')); ?></th>
                                        <th><?php echo e(__('Staff Image')); ?></th>
                                        <th><?php echo e(__('Staff Name')); ?></th>
                                        <th><?php echo e(__('Staff Email')); ?></th>
                                        <th><?php echo e(__('Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($data->id); ?></td>
                                            <td>  <div class="search_thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($data->profile_image_id, '', 'thumb'); ?>></div></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->email); ?></td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_Staff_modal" data-toggle="modal"
                                                        data-target="#editStaffModal"
                                                        data-id ="<?php echo e($data->id); ?>"
                                                        data-name ="<?php echo e($data->name); ?>"
                                                        data-image ="<?php echo e($data->profile_image_id); ?>"
                                                        data-email="<?php echo e($data->email); ?>"
                                                        data-image_url="<?php echo e(get_attachment_image_by_id($data->profile_image_id)['img_url']); ?>"
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i
                                                                class="las la-edit"></i> </span>
                                                    </a>
                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.staff.delete', $data->id)]]); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.staff.delete', $data->id))]); ?>
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
    <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="staffModal"
        aria-hidden="true">
        <form action="<?php echo e(route('seller.staff.add')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block ">
                        <h5 class="modal-title" id="couponModal"><?php echo e(__('Add New Staff')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">  
                            <label for="staffName"><?php echo e(__('Name')); ?></label>
                            <input type="text" name="staffName" id="staffName" class="form-control"
                                placeholder="<?php echo e(__('Name')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="staffEmail"><?php echo e(__('Email')); ?></label>
                            <input type="email" name="staffEmail" id="staffEmail" class="form-control"
                                placeholder="<?php echo e(__('Email')); ?>">
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <div class="form-group ">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            <?php echo e(__('Upload Profile Image')); ?>

                                        </button>
                                        <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                        <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-staff-add btn-bg-1"><?php echo e(__('Save changes')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Edit Modal -->
    <div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModal"
        aria-hidden="true">
        <form action="<?php echo e(route('seller.staff.edit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCouponModal"><?php echo e(__('Edit Staff')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="staffId" name="staffId" hidden>

                        <div class="form-group mt-3">  
                            <label for="staffName_up"><?php echo e(__('Name')); ?></label>
                            <input type="text" name="staffName_up" id="staffName_up" class="form-control"
                                placeholder="<?php echo e(__('Name')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="staffEmail_up"><?php echo e(__('Email')); ?></label>
                            <input type="email" name="staffEmail_up" id="staffEmail_up" class="form-control"
                                placeholder="<?php echo e(__('Email')); ?>">
                        </div>
                        <div class="single-dashboard-input">
                            <div class="single-info-input margin-top-30">
                                <div class="form-group ">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="#" alt="" id="staff_up_image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_up" id="image_up">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            <?php echo e(__('Upload Profile Image')); ?>

                                        </button>
                                        <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                        <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-staff-add btn-primary"><?php echo e(__('Save changes')); ?></button>
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

    <style>
        .search_thumb {
            border-radius: 10px;
            width: 75px;
            height: 75px;
        }
        .btn-staff-add{
            background-color: var(--main-color-two);
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
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
                $(document).on('click', '.edit_Staff_modal', function(e) {
                    e.preventDefault();
                    let staff_id = $(this).data('id');
                    let name = $(this).data('name');
                    let email = $(this).data('email');
                    let image = $(this).data('image');
                    let image_url = $(this).data('image_url');
                    $('#staffName_up').val(name);
                    $('#staffEmail_up').val(email);
                    $('#image_up').val(image);
                    $('#staff_up_image').attr("src",image_url);
                    $('#staffId').val(staff_id);
                });

                $(document).on('click', '.swal_status_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__('Are you sure to change status?')); ?>',
                        text: '<?php echo e(__('You will change it anytime!')); ?>',
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

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/staff/staff.blade.php ENDPATH**/ ?>