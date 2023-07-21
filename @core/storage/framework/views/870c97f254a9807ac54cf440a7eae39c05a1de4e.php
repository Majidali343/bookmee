
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Services')); ?>

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

        .cmn-btn:disabled {
            background: rgb(35 56 87 / 60%) !important;
            cursor: not-allowed !important;
        }
    </style>
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
                                <h2 class="dashboards-title"> <?php echo e(__('All Services')); ?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrapper margin-top-50 text-right">
                        <a onclick="onGroupByClick()" class="cmn-btn btn-bg-1" id="group-btn"> <?php echo e(__('Group By')); ?></a>
                        <button onclick="onGroupSaveClick()" class="cmn-btn btn-bg-2" id="save-group-btn"
                            style="display: none; background:var(--main-color-one)" disabled>
                            <?php echo e(__('Save Grouped Services')); ?></button>

                        <a href="<?php echo e(route('seller.add.services')); ?>" class="cmn-btn btn-bg-1"> <?php echo e(__('Add Services')); ?></a>

                    </div>
                    <?php if($services->count() > 0): ?>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dashboard-service-single-item border-1 margin-top-40">
                                <div class="rows dash-single-inner">
                                    <div class="dash-left-service">
                                        <div class="dashboard-services">
                                            <div class="dashboar-flex-services">
                                                <input type="checkbox" style="display: none"
                                                    name="select_services"class="select_group_by select_services check-input group-by-select"id="<?php echo e($data->id); ?>"value="<?php echo e($data->id); ?>">
                                                <div class="thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($data->image, '', 'thumb'); ?>>
                                                </div>
                                                <div class="thumb-contents">
                                                    <h4 class="title"> <a href="javascript:void(0)"> <?php echo e($data->title); ?>

                                                        </a> </h4>

                                                    <span class="service-review">
                                                        <i class="las la-star"></i>
                                                        <?php echo e(round(optional($data->reviews)->avg('rating'), 1)); ?>

                                                        <b>(<?php echo e(optional($data->reviews)->count()); ?>)</b>
                                                    </span>
                                                    <span class="service-review style-02"> <i class="las la-eye"></i>
                                                        <?php echo e($data->view); ?> </span>
                                                    <?php if($data->is_service_online == 1): ?>
                                                        <span class="service-review style-02"> <i
                                                                class="las la-map-marker"></i> <?php echo e(__('Online')); ?> </span>
                                                    <?php else: ?>
                                                        <span class="service-review style-02"> <i
                                                                class="las la-map-marker"></i> <?php echo e(__('Offline')); ?> </span>
                                                    <?php endif; ?>

                                                    <div class="service-bottom-flex margin-top-30">
                                                        <a href="<?php echo e(route('seller.pending.orders')); ?>">
                                                            <div class="dashboard-service-bottom-flex color-1">
                                                                <div class="icon">
                                                                    <i class="las la-sync-alt"></i>
                                                                </div>
                                                                <div class="content">
                                                                    <span class="num">
                                                                        <?php echo e(optional($data->pendingOrder)->count()); ?>

                                                                    </span>
                                                                    <span class="queue"> <?php echo e(__('In Queue')); ?> </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="dashboard-service-bottom-flex color-2">
                                                            <div class="icon">
                                                                <i class="las la-check"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span class="num">
                                                                    <?php echo e(optional($data->completeOrder)->count()); ?> </span>
                                                                <span class="queue"> <?php echo e(__('Completed')); ?> </span>
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-service-bottom-flex color-3">
                                                            <div class="icon">
                                                                <i class="las la-times"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span class="num">
                                                                    <?php echo e(optional($data->cancelOrder)->count()); ?> </span>
                                                                <span class="queue"> <?php echo e(__('Cancelled')); ?> </span>
                                                            </div>
                                                        </div>
                                                        <?php if($data->groupby != null): ?>
                                                        <div class="dashboard-service-bottom-flex color-1">
                                                            <div class="icon">
                                                                <i class="las la-object-ungroup"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span class="num">‎
                                                                <span class="queue"> <?php echo e($data->groupby); ?> </span>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dash-righ-service">
                                        <div class="dashboard-switch-flex-content">
                                            <div class="dashboard-switch-single">
                                                <span class="dashboard-starting"> <?php echo e(__('Price')); ?> </span>
                                                <h2 class="title-price color-3">
                                                    <?php echo e(amount_with_currency_symbol($data->price)); ?> </h2>
                                            </div>
                                            <div class="dashboard-switch-single">
                                                <span class="dashboard-starting"> <?php echo e(__('Service Available:')); ?> </span>
                                                <?php if($data->is_service_on == 1): ?>
                                                    <input class="custom-switch style-02 service_on_off_btn"
                                                        id="switch2_<?php echo e($data->id); ?>" type="checkbox"
                                                        data-id="<?php echo e($data->id); ?>" />
                                                    <label class="switch-label style-02"
                                                        for="switch2_<?php echo e($data->id); ?>"></label>
                                                <?php else: ?>
                                                    <input class="custom-switch service_on_off_btn"
                                                        id="switch1_<?php echo e($data->id); ?>" type="checkbox"
                                                        data-id="<?php echo e($data->id); ?>" />
                                                    <label class="switch-label" for="switch1_<?php echo e($data->id); ?>"></label>
                                                <?php endif; ?>

                                            </div>
                                            <div class="dashboard-switch-single">
                                                <a href="<?php echo e(route('seller.edit.services', $data->id)); ?>"> <span
                                                        class="dash-icon color-1" data-toggle="tooltip" data-placement="top"
                                                        title="<?php echo e(__('Edit Service')); ?>"> <i class="las la-pen"></i>
                                                    </span> </a>
                                                <a href="<?php echo e(route('seller.services.attributes.add.byid', $data->id)); ?>">
                                                    <span class="dash-icon color-1" data-toggle="tooltip"
                                                        data-placement="top" title="<?php echo e(__('Add Attributes')); ?>"> <i
                                                            class="las la-plus"></i> </span> </a>
                                                 
                                                <a href="<?php echo e(route('seller.services.attributes.show.byid', $data->id)); ?>">
                                                    <span class="dash-icon color-1" data-toggle="tooltip"
                                                        data-placement="top" title="<?php echo e(__('Show Attributes')); ?>"> <i
                                                            class="las la-eye"></i> </span> </a>
                                                <a href="<?php echo e(route('service.list.details', $data->slug ?? 'x')); ?>"
                                                    target="_blank"> <span class="dash-icon color-1"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="<?php echo e(__('Service in frontend')); ?>"> <i
                                                            class="las la-external-link-square-alt"></i> </span> </a>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.delete', $data->id)]]); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.delete', $data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $services->links(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <h2 class="no_data_found"><?php echo e(__('No Service Created Yet')); ?></h2>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>


    <!-- Group Services Modal -->
    <div class="modal fade" id="group-services-modal" tabindex="-1" role="dialog" aria-labelledby="couponModal"
        aria-hidden="true">
        <form action="<?php echo e(route('seller.service.group.add')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header d-block ">
                        <h5 class="modal-title" id="couponModal"><?php echo e(__('Grouping Services')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="group_name"><?php echo e(__('Group Services By Name:')); ?></label>
                            <input type="text" name="group_name" id="group_name" class="form-control"
                                placeholder="<?php echo e(__('Popular Services')); ?>">
                        </div>
                        <input type="text" id="services_ids_groupby" name="services_ids_groupby" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><?php echo e(__('Close')); ?></button>
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

                $(document).on('change', '.service_on_off_btn', function(e) {
                    e.preventDefault();
                    if ($(this).is(':checked')) {
                        var service_id = $(this).data('id');
                        $.ajax({
                            method: 'post',
                            url: "<?php echo e(route('seller.services.on.of')); ?>",
                            data: {
                                service_id: service_id
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success(
                                        "<?php echo e(__('Service On/Off Change Success---')); ?>");
                                }
                            }
                        });
                    } else {
                        var service_id = $(this).data('id');
                        $.ajax({
                            method: 'post',
                            url: "<?php echo e(route('seller.services.on.of')); ?>",
                            data: {
                                service_id: service_id
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "100",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "show",
                                        "hideMethod": "hide"
                                    };
                                    toastr.success(
                                        "<?php echo e(__('Service On/Off Change Success---')); ?>");
                                }
                            }
                        });
                    }

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

        function onGroupByClick() {
            $(".group-by-select").show();
            $("#group-btn").hide();
            $("#save-group-btn").show();
        }

        function onGroupSaveClick() {
            $("#group-services-modal").modal();
        }

        $(document).on('click', '.select_group_by', setServicesSelectedValues);

        function setServicesSelectedValues() {
            var inputs = document.querySelectorAll('.select_group_by');
            var selectedIds = [];
            var selectedIdsString = "";
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].checked == true) {
                    selectedIds.push(`${inputs[i].id}`);
                }
            }
            for (var i = 0; i < selectedIds.length; i++) {
                if (i == selectedIds.length - 1) {
                    selectedIdsString += `${selectedIds[i]}`;
                } else {
                    selectedIdsString += `${selectedIds[i]},`;
                }
            }
            if (selectedIds.length > 0) {
                $("#save-group-btn").prop("disabled", false);
            } else {
                $("#save-group-btn").prop("disabled", true);
            }
            document.getElementById(`services_ids_groupby`).value = selectedIdsString;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/services.blade.php ENDPATH**/ ?>