
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/spectrum.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Color Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Color Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.color.settings')); ?>" method="POST" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                        
                            <div class="form-group">
                                <label for="site_main_color_one"><?php echo e(__('Site Main Color One')); ?></label>
                                <input type="text" name="site_main_color_one" style="background-color: <?php echo e(get_static_option('site_main_color_one')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('site_main_color_one')); ?>" id="site_main_color_one">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site main color- from here, it will replace the website main color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_two"><?php echo e(__('Site Main Color Two')); ?></label>
                                <input type="text" name="site_main_color_two" style="background-color: <?php echo e(get_static_option('site_main_color_two')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('site_main_color_two')); ?>" id="site_main_color_two">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site base color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="site_main_color_three"><?php echo e(__('Site Main Color Three')); ?></label>
                                <input type="text" name="site_main_color_three" style="background-color: <?php echo e(get_static_option('site_main_color_three')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('site_main_color_three')); ?>" id="site_main_color_three">
                                <small class="form-text text-muted"><?php echo e(__('you can change -site base color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="heading_color"><?php echo e(__('Heading Color')); ?></label>
                                <input type="text" name="heading_color" style="background-color: <?php echo e(get_static_option('heading_color')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('heading_color')); ?>" id="heading_color">
                                <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="light_color"><?php echo e(__('Light Color')); ?></label>
                                <input type="text" name="light_color" style="background-color: <?php echo e(get_static_option('light_color')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('light_color')); ?>" id="light_color">
                                <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                            </div>

                            <div class="form-group">
                                <label for="extra_light_color"><?php echo e(__('Extra Light Color')); ?></label>
                                <input type="text" name="extra_light_color" style="background-color: <?php echo e(get_static_option('extra_light_color')); ?>;" class="form-control spectrum_picker"
                                       value="<?php echo e(get_static_option('extra_light_color')); ?>" id="extra_light_color">
                                <small class="form-text text-muted"><?php echo e(__('you can change -heading color- from here, it will replace the website base color')); ?></small>
                            </div>

                           

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/spectrum.min.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                
                colorPickerInit($('.spectrum_picker'))
                
                function colorPickerInit(selector){

                $.each(selector,function (index,value){
                    var el = $(this);
                
                    el.spectrum({
                        preferredFormat: "hex",
                        showAlpha: true,
                        showPalette: true,
                        cancelText : '',
                        showInput: true,
                        allowEmpty:true,
                        chooseText : '',
                        maxSelectionSize: 2,
                        color: el.val(),
                        change: function(color) {
                            el.val( color ? color.toRgbString() : '');
                            el.css({
                            'background-color' : color ? color.toRgbString() : ''
                            });
                        },
                        move: function(color) {
                        el.val( color ? color.toRgbString() : '');
                        el.css({
                            'background-color' : color ? color.toRgbString() : ''
                            });
                        }
                });
                
                el.on("dragstop.spectrum", function(e, color) {
                    el.val( color.toRgbString());
                    el.css({
                        'background-color' : color.toHexString()
                        });
                    });
                });
            }
                
                
          
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/general-settings/color-settings.blade.php ENDPATH**/ ?>