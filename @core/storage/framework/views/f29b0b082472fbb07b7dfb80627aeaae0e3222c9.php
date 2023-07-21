
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add Services Attributes')); ?>

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
                    <form action="<?php echo e(route('seller.services.attributes.add.byid',$get_service->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="service_id" value="<?php echo e($get_service->id); ?> ">
                        <?php if($get_service->is_service_online == 1): ?>
                            <input type="hidden" name="is_service_online_id" value="<?php echo e($get_service->is_service_online); ?>"  id="is_service_online_id">
                        <?php endif; ?>

                    <div class="row">  
                        <div class="col-xl-4 margin-top-50">
                            <div class="edit-service-wrappers">
                                <div class="dashboard-edit-thumbs">
                                    <?php echo render_image_markup_by_attachment_id($get_service->image); ?>

                                </div>
                                <div class="content-edit margin-top-40">
                                    <h4 class="title"> <?php echo e($get_service->title); ?> </h4>
                                    <p class="edit-para"> <?php echo e(Str::limit(strip_tags($get_service->description)) ,200); ?></p>
                                </div>
                                <div class="single-dashboard-input service-price-show-hide">
                                    <div class="single-info-input margin-top-50">
                                        <label class="info-title"> <?php echo e(__('Service Price')); ?></label>
                                        <input class="form--control" type="text" name="price" id="service_total_price">
                                    </div>
                                </div>

                                <div class="btn-wrapper margin-top-40">
                                    <button type="submit" class="cmn-btn btn-bg-1"><?php echo e(__('Save & Publish')); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 margin-top-50">
                            <?php if($get_service->is_service_online == 1): ?>
                                <div class="dashboard-switch-single margin-bottom-30">
                                    <input class="custom-switch is_service_online" id="is_service_online" type="checkbox" checked disabled/> <?php echo e(__('Online Service')); ?>

                                    <label class="switch-label" for="is_service_online"></label>
                                </div>
                            <?php endif; ?>
                            <div class="single-settings">
                                <h4 class="input-title"> <?php echo e(__('What is Included In This Package')); ?> </h4>
                                    <div class="append-additional-includes">
                                        <div class="single-dashboard-input what-include-element">
                                            <div class="single-info-input margin-top-20">
                                                <label><?php echo e(__('Title')); ?></label>
                                                <input class="form--control" type="text" name="include_service_title[]" placeholder="<?php echo e(__('Service title')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20 <?php if($get_service->is_service_online == 1): ?> is_service_online_hide <?php endif; ?>">
                                                <label><?php echo e(__('Unit Price')); ?></label>
                                                <input class="form--control include-price" type="number" step="0.01" name="include_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20 <?php if($get_service->is_service_online == 1): ?> is_service_online_hide <?php endif; ?>">
                                                <label><?php echo e(__('Quantity')); ?></label>
                                                <input class="form--control numeric-value" type="text" name="include_service_quantity[]" value="1" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-20">
                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-what-includes"> <?php echo e(__('Add More')); ?> </a>
                                    </div>
                            </div>

                            <div class="single-settings margin-top-40">
                                <h4 class="input-title"> <?php echo e(__('Add Additional Services')); ?> </h4>
                                    
                                    <div class="append-additional-services">
                                        <div class="single-dashboard-input additional-services">
                                            <div class="single-info-input margin-top-20">
                                                <label><?php echo e(__('Title')); ?></label>
                                                <input class="form--control" type="text" name="additional_service_title[]" placeholder="<?php echo e(__('Service title')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20">
                                                <label><?php echo e(__('Unit Price')); ?></label>
                                                <input class="form--control numeric-value" type="number" step="0.01" name="additional_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">
                                            </div>
                                            <div class="single-info-input margin-top-20">
                                                <label><?php echo e(__('Quantity')); ?></label>
                                                <input class="form--control numeric-value" type="text" name="additional_service_quantity[]" value="1" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>
                                            </div>

                                            <div class="single-info-input margin-top-30">
                                                <div class="form-group ">
                                                    <div class="media-upload-btn-wrapper">
                                                        <div class="img-wrap"></div>
                                                        <input type="hidden" name="image[]">
                                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                                data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                data-target="#media_upload_modal">
                                                            <?php echo e(__('Upload Image')); ?>

                                                        </button>
                                                        <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                                        <small><?php echo e(__('recomended size 78x78')); ?></small>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-20">
                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-additional-services"> <?php echo e(__('Add More')); ?> </a>
                                    </div>
                            </div>
                            <div class="single-settings margin-top-40">
                                <h4 class="input-title"> <?php echo e(__('Benefit Of This Package')); ?> </h4>
                                    <div class="append-benifits">
                                        <div class="single-dashboard-input benifits">
                                            <div class="single-info-input margin-top-20">
                                                <input class="form--control" type="text" name="benifits[]" placeholder="<?php echo e(__('Type Here')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper margin-top-20">
                                        <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-benifits"> <?php echo e(__('Add More')); ?> </a>
                                    </div>
                            </div>

                            <div class="single-settings margin-top-40 faq_show_hide">
                                <h4 class="input-title"> <?php echo e(__('Faqs')); ?> </h4>
                                <div class="append-faqs">
                                    <div class="single-dashboard-input faqs">
                                        <div class="single-info-input margin-top-20">
                                            <input class="form--control" type="text" name="faqs_title[]" placeholder="<?php echo e(__('Faq Title')); ?>">
                                        </div>
                                        <div class="single-info-input margin-top-20">
                                            <textarea class="form--control" name="faqs_description[]" cols="20" rows="5" placeholder="<?php echo e(__('Faq Description')); ?>"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper margin-top-20">
                                    <a href="javascript:void(0)" class="btn-see-more style-02 color-3 add-faqs"> <?php echo e(__('Add More')); ?> </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
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
    (function ($) {
        'use strict'
        $(document).ready(function() {
            // add what new inclue
             $(".add-what-includes").on('click',function(){
                 let  total_element = $(".what-include-element").length;
                 let max = 15;
                if(total_element < max ){
                  $(".append-additional-includes").append(
                        '<div class="single-dashboard-input what-include-element">\
                            <div class="single-info-input margin-top-20">\
                                <label><?php echo e(__('Title')); ?></label>\
                                <input class="form--control" type="text" name="include_service_title[]" placeholder="<?php echo e(__('Service title')); ?>">\
                            </div>\
                            <div class="single-info-input margin-top-20 <?php if($get_service->is_service_online == 1): ?> is_service_online_hide <?php endif; ?>">\
                                <label><?php echo e(__('Unit Price')); ?></label>\
                                <input class="form--control include-price" type="number" step="0.01" name="include_service_price[]" placeholder="<?php echo e(__('Add Price')); ?>">\
                            </div>\
                            <div class="single-info-input margin-top-20 <?php if($get_service->is_service_online == 1): ?> is_service_online_hide <?php endif; ?>">\
                                <label><?php echo e(__('Quantity')); ?></label>\
                                <input class="form--control numeric-value" name="include_service_quantity[]" value="1" type="text" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>\
                            </div><span class="btn btn-danger remove-include"><i class="las la-times"></i></span>\
                        </div>'
                    );
                }
                 if ($("#is_service_online").is(':checked')){
                     $('.is_service_online_hide').hide();
                 }
             }) 

             // remove include service
            $(document).on('click', ".remove-include", function() {
                $(this).closest('.what-include-element').remove();
            })  



             // add additional service
             $(".add-additional-services").on('click',function(){
                 let  total_element = $(".additional-services").length;
                 let max = 5;
                 if(total_element < max ){
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
                                <input class="form--control numeric-value" type="number" step="0.01" name="additional_service_quantity[]" value="1" placeholder="<?php echo e(__('Add Quantity')); ?>" readonly>\
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
                            </div><span class="btn btn-danger remove-service"><i class="las la-times"></i></span>\
                      </div>');
                 } 
             })

            // remove additional service
            $(document).on('click', ".remove-service", function() {
                $(this).closest('.additional-services').remove();
            })   



              // add benifits
             $(".add-benifits").on('click',function(){
                 let  total_element = $(".benifits").length;
                 let max = 5;
                 if(total_element < max ){
                  $(".append-benifits").append(
                      '<div class="single-dashboard-input benifits">\
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



            //total price
            $(document).on("change", ".include-price", function() {
                var sum = 0;
                $(".include-price").each(function() {
                    if(isNaN($(this).val())){
                       alert('Please Enter Numeric Value only')  
                    }else{
                        sum += +$(this).val();
                    }
                });
                $("#service_total_price").val(sum);
            }); 

           //include quantity
           $(document).on("change", ".numeric-value", function() {
                if(isNaN($(this).val())){
                    alert('Please Enter Numeric Value only')  
                }
            });

            //is service online
            $('.is_service_online_hide').hide();
            $('.service-price-show-hide').hide()

            // add faqs
            $(".add-faqs").on('click',function(){
                let  total_element = $(".faqs").length;
                let max = 15;
                if(total_element < max ){
                    $(".append-faqs").append(
                        '<div class="single-dashboard-input faqs">\
                        <div class="single-info-input margin-top-20">\
                        <input class="form--control" type="text" name="faqs_title[]" placeholder="<?php echo e(__('Faq Title')); ?>">\
                        </div>\
                        <div class="single-info-input margin-top-20">\
                        <textarea class="form--control" name="faqs_description[]" cols="20" rows="5" placeholder="<?php echo e(__('Faq description')); ?>"></textarea>\
                    </div><span class="btn btn-danger remove-faqs"><i class="las la-times"></i></span>\
                </div>');
                }
            })

            // remove faqs
            $(document).on('click', ".remove-faqs", function() {
                $(this).closest('.faqs').remove();
            })

        })
    })(jQuery)
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/add-service-attributes-by-id.blade.php ENDPATH**/ ?>