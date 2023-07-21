
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add Service Attributes')); ?>

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

<style>
    .serviceopt input {
        width: 200;
        height: 50px;
        top: 30.5px;
        padding: 0px 9.600006103515625px 0px 21.330078125px;
        border-radius: 5px;
        border: 1px solid #DDDDDD;

    }
    .serviceopt p ,label {
        font-family: Inter;
        font-size: 14px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;

    }
    .serviceopt h5 {
        font-family: Poppins;
        font-size: 24px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;

    }
    .serviceopt button {
        width: 235.42px;
        height: 54px;
        color: white;
        top: 79px;
        left: 436px;
        padding: 9.65999984741211px 35.41999816894531px 10.34000015258789px 34px;
        border-radius: 5px;
        background: #03989E;;

    }
   /* Customize the label (the container) */
   .checkbox-list {
      list-style-type: none;
      padding: 0;
      
    }
    
    /* CSS for each checkbox item */
    .checkbox-item {
      margin-bottom: 10px;
      display: flex;
      padding-left: 20px;
      flex-direction: row;
      height: 100px;
      align-items: center;
      
    }
    .label{
        font-family: "inter";
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        letter-spacing: 0em;
        padding-left: 10px;
        text-align: left;
        margin-bottom: 0px;
    }
    .modal-body {
        padding: 0px;
    }

    /* CSS for the checkbox input */
    .checkbox-item input[type="checkbox"] {
      margin-right: 5px;
    }
   .modalimage{
    height: 80px;
    width: 80px;
    margin: 0px 15px;
    border-radius: 10px;
   }


</style>


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
                        <div class="col-lg-6">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> <?php echo e(__('Add Service Attributes')); ?> </h2>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.error-message','data' => []]); ?>
<?php $component->withName('error-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <form action="<?php echo e(route('seller.services.attributes.add')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="service_id" value="<?php echo e($latest_service->id); ?> ">
                        <input type="hidden" name="is_service_online_id" id="is_service_online_id">
                        <div class="row">
                            <div class="col-xl-4 margin-top-50">
                                <div class="edit-service-wrappers">
                                    <div class="dashboard-edit-thumbs">
                                        <?php echo render_image_markup_by_attachment_id($latest_service->image); ?>

                                    </div>
                                    <div class="content-edit margin-top-40">
                                        <h4 class="title"> <?php echo e($latest_service->title); ?> </h4>
                                        <p class="edit-para"> <?php echo e(Str::limit(strip_tags($latest_service->description)), 200); ?>

                                        </p>
                                    </div>
                                    <div class="single-dashboard-input service-price-show-hide">
                                        <div class="single-info-input margin-top-50">
                                            <label class="info-title"> <?php echo e(__('Service Price')); ?></label>
                                            <input class="form--control" type="text" name="price"
                                                id="service_total_price" disabled>
                                        </div>
                                    </div>

                                    <div class="btn-wrapper margin-top-40">
                                        <button type="submit" class="cmn-btn btn-bg-1"><?php echo e(__('Save & Publish')); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 margin-top-50">
                                <div class="single-settings">
                                    <h4 class="input-title"> <?php echo e(__('Whats Included This Package')); ?> </h4>
                                    <div class="append-additional-includes">
                                        <div class="single-dashboard-input what-include-element">
                                            <div class="single-info-input margin-top-20">
                                                <label><?php echo e(__('Title')); ?></label>
                                                <input class="form--control" type="text" name="include_service_title[]"
                                                    placeholder="<?php echo e(__('Service title')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20 is_service_online_hide">
                                                <label><?php echo e(__('Unit Price')); ?></label>
                                                <input class="form--control include-price" type="number" step="0.01"
                                                    name="include_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20 is_service_online_hide">
                                                <label><?php echo e(__('Quantity')); ?></label>
                                                <input class="form--control numeric-value" type="text"
                                                    name="include_service_quantity[]" value="1"
                                                    placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="single-settings day_review_show_hide">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-20">
                                            <label><?php echo e(__('Delivery Days')); ?></label>
                                            <input class="form--control" type="number" step="0.01" name="delivery_days"
                                                placeholder="<?php echo e(__('Delivery Days')); ?>">
                                        </div>
                                        <div class="single-info-input margin-top-20">
                                            <label><?php echo e(__('Revisions')); ?></label>
                                            <input class="form--control" type="number" step="0.01" name="revision"
                                                placeholder="<?php echo e(__('Revision Times')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="single-settings online_service_price_show_hide">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-20">
                                            <label><?php echo e(__('Service Price')); ?></label>
                                            <input class="form--control" type="number" step="0.01"
                                                name="online_service_price" placeholder="<?php echo e(__('Service price')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="single-settings margin-top-40">


                                    <div class="append-additional-services">
                                        <div class="single-dashboard-input additional-services">
                                            <div class="serviceopt margin-top-20">
                                                <h5>Service Time</h5>
                                                <p>How much time service will take</p>
                                                <label>Time</label><br>
                                                <input type="number" id="points" name="time" step="1"  placeholder="Mins">
                                            </div>
                                            <div class="serviceopt margin-top-20">
                                           <h5 style="font-size: 20px;">Select Staff who can provide this Service</h5>
                                           <p>It can be all or any Specific</p><br>
                                           <button type="button"  data-toggle="modal" data-target="#addstaff">
                                            Select Staff Members
                                          </button>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <input type="text" name="staffs" id="services_ids" value="" style="display: none;">

                                <!-- Button trigger modal -->

  
        
                                

                                


                                <div class="single-settings margin-top-40 faq_show_hide">
                                    <h4 class="input-title"> <?php echo e(__('Faqs')); ?> </h4>
                                    <div class="append-faqs">
                                        <div class="single-dashboard-input faqs">
                                            <div class="single-info-input margin-top-20">
                                                <input class="form--control" type="text" name="faqs_title[]"
                                                    placeholder="<?php echo e(__('Faq Title')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20">
                                                <textarea class="form--control" name="faqs_description[]" cols="20" rows="5"
                                                    placeholder="<?php echo e(__('Faq Descriptiom')); ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-20">
                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-faqs">
                                            <?php echo e(__('Add More')); ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 style="font-size: 16px;" class="modal-title" id="exampleModalLabel">Staff Member’s who can provide This Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <ul class="checkbox-list">
            <li class="checkbox-item">
            <input type="checkbox" name="services_all" class="services_all check-input">
            <label class="label" for="checkbox1">All Staff</label>
            </li>

            <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="checkbox-item">
             
            <input type="checkbox" id="<?php echo e($data->id); ?>" class="select_services" name="select_services" value="<?php echo e($data->id); ?>">
            <img  class="modalimage" src="<?php echo e(get_attachment_image_by_id($data->profile_image_id)['img_url']); ?>" alt="">
            <label class="label" for="checkbox1"><?php echo e($data->name); ?></label>
            </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </ul>

        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary">Save Staff</button>
        </div>
    </div>
    </div>
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
    <!-- Dashboard area end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
            'use strict'
            $(document).ready(function() {
              
                function setServicesSelectedValues() {
                    var inputs = document.querySelectorAll('.select_services');
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
                    console.log(selectedIdsString);
                    document.getElementById(`services_ids`).value = selectedIdsString;
                }

                $('.services_all').change(
                    function() {
                        var inputs = document.querySelectorAll('.select_services');
                        if ($(this).is(':checked')) {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = true;
                            }
                        } else {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = false;
                            }
                        }
                        setServicesSelectedValues();
                    }
                );


                $(document).on('click', '.select_services', setServicesSelectedValues);

 
                // add what new inclue
                $(".add-what-includes").on('click', function() {
                    let total_element = $(".what-include-element").length;
                    let max = 15;
                    if (total_element < max) {
                        $(".append-additional-includes").append(
                            '<div class="single-dashboard-input what-include-element">\
                                <div class="single-info-input margin-top-20">\
                                    <label><?php echo e(__('Title')); ?></label>\
                                    <input class="form--control" type="text" name="include_service_title[]" placeholder="<?php echo e(__('Service title')); ?>">\
                                </div>\
                                <div class="single-info-input margin-top-20 is_service_online_hide">\
                                    <label><?php echo e(__('Unit Price')); ?></label>\
                                    <input class="form--control include-price" type="text" name="include_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">\
                                </div>\
                                <div class="single-info-input margin-top-20 is_service_online_hide">\
                                    <label><?php echo e(__('Quantity')); ?></label>\
                                    <input class="form--control numeric-value" name="include_service_quantity[]" value="1" type="text" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>\
                                </div><span class="btn btn-danger remove-include"><i class="las la-times"></i></span>\
                            </div>'
                        );
                    }
                    if ($("#is_service_online").is(':checked')) {
                        $('.is_service_online_hide').hide();
                    }
                })

                // remove include service
                $(document).on('click', ".remove-include", function() {
                    $(this).closest('.what-include-element').remove();
                })

                // add additional service
                $(".add-additional-services").on('click', function() {
                    let total_element = $(".additional-services").length;
                    let max = 5;
                    if (total_element < max) {
                        $(".append-additional-services").append(
                            '<div class="single-dashboard-input additional-services">\
                                <div class="single-info-input margin-top-20">\
                                    <label><?php echo e(__('Title')); ?></label>\
                                   <input class="form--control" type="text" name="additional_service_title[]" placeholder="<?php echo e(__('Service title')); ?>">\
                                </div>\
                                <div class="single-info-input margin-top-20">\
                                    <label><?php echo e(__('Unit Price')); ?></label>\
                                    <input class="form--control numeric-value" type="text" name="additional_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">\
                                </div>\
                                <div class="single-info-input margin-top-20">\
                                    <label><?php echo e(__('Quantity')); ?></label>\
                                    <input class="form--control numeric-value" type="text" name="additional_service_quantity[]" value="1" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>\
                                </div>\
                                <div class="single-info-input margin-top-30">\
                                    <div class="form-group ">\
                                        <div class="media-upload-btn-wrapper">\
                                            <div class="img-wrap"></div>\
                                            <input type="hidden" name="image[]">\
                                            <button type="button" class="btn btn-info media_upload_form_btn"\
                                                    data-btntitle="<?php echo e(__('Select Image')); ?>"\
                                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"\
                                                    data-target="#media_upload_modal">\
                                                <?php echo e(__('Upload Image')); ?>\
                                            </button>\
                                        </div>\
                                    </div>\
                                </div>\<span class="btn btn-danger remove-service"><i class="las la-times"></i></span>\
                          </div>');
                    }
                })

                // remove additional service
                $(document).on('click', ".remove-service", function() {
                    $(this).closest('.additional-services').remove();
                })

                // add benifits
                $(".add-benifits").on('click', function() {
                    let total_element = $(".benifits").length;
                    let max = 5;
                    if (total_element < max) {
                        $(".append-benifits").append(
                            '<div class="single-dashboard-input benifits faq_show_hide">\
                            <div class="single-info-input margin-top-20">\
                               <input class="form--control" type="text" name="benifits[]" placeholder="<?php echo e(__('Type Here')); ?>">\
                            </div><span class="btn btn-danger remove-benifits"><i class="las la-times"></i></span>\
                          </div>');
                    }
                })

                // remove benifits
                $(document).on('click', ".remove-benifits", function() {
                    $(this).closest('.benifits').remove();
                })

                // add faqs
                $(".add-faqs").on('click', function() {
                    let total_element = $(".faqs").length;
                    let max = 15;
                    if (total_element < max) {
                        $(".append-faqs").append(
                            '<div class="single-dashboard-input faqs">\
                            <div class="single-info-input margin-top-20">\
                            <input class="form--control" type="text" name="faqs_title[]" placeholder="<?php echo e(__('Faq Title')); ?>">\
                            </div>\
                            <div class="single-info-input margin-top-20">\
                            <textarea class="form--control" name="faqs_description[]" cols="20" rows="5" placeholder="<?php echo e(__('Faq Descriptiom')); ?>"></textarea>\
                        </div><span class="btn btn-danger remove-faqs"><i class="las la-times"></i></span>\
                    </div>');
                    }
                })

                // remove faqs
                $(document).on('click', ".remove-faqs", function() {
                    $(this).closest('.faqs').remove();
                })

                //total price
                $(document).on("change", ".include-price", function() {
                    var sum = 0;
                    $(".include-price").each(function() {
                        if (isNaN($(this).val())) {
                            alert('Please Enter Numeric Value only')
                        } else {
                            sum += +$(this).val();
                        }
                    });
                    $("#service_total_price").val(sum);
                });

                //include quantity
                $(document).on("change", ".numeric-value", function() {
                    if (isNaN($(this).val())) {
                        alert('Please Enter Numeric Value only')
                    }
                });


                // is service online
                $('.day_review_show_hide').hide()
                $('.faq_show_hide').hide()
                $('.online_service_price_show_hide').hide()

                $("#is_service_online").on('change', function() {
                    if ($("#is_service_online").is(':checked')) {
                        $('.is_service_online_hide').hide();
                        $('#is_service_online_id').val(1)
                        $('.day_review_show_hide').show()
                        $('.faq_show_hide').show()
                        $('.service-price-show-hide').hide()
                        $('.online_service_price_show_hide').show()
                    } else {
                        $('.is_service_online_hide').show();
                        $('#is_service_online_id').val('')
                        $('.day_review_show_hide').hide()
                        $('.faq_show_hide').hide()
                        $('.service-price-show-hide').hide()
                        $('.online_service_price_show_hide').hide()
                    }
                });
            })
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/service-attributes.blade.php ENDPATH**/ ?>