
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
    <style>
        .form-group.extra-padding {
            padding-top: 30px;
            display: inline-block;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/codemirror.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/show-hint.css')); ?>">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
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
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Typography Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
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

                        <div class="form-group custom_font_title_button">
                            <label for="custom_font"><?php echo e(__('Use Custom Font')); ?></label>
                            <label class="switch">
                                <input type="checkbox" name="custom_font"  <?php if($custom_font >= 1): ?> checked  <?php else: ?>  <?php endif; ?> id="custom_font">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <!-- custom font -->
                          <div class="custom_font_upload">
                              <h4 class="header-title mt-4"><?php echo e(__('Upload Font')); ?></h4>
                            <form action="<?php echo e(route('admin.custom.font.add')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="file" name="files[]" placeholder="Choose files" multiple>
                                <button type="submit"  class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Upload')); ?></button>
                            </form>
                              <span class="text-danger"><?php echo e(__(' allowed file format: ttf, woff, woff2, eot')); ?></span>
                          </div>

                                <div class="row custom_font_hide_and_show">
                                    <div class="col-lg-12 mt-5">
                                        <div class="card">
                                            <h4 class="header-title mt-2"><?php echo e(__("Custom Font Typography Settings")); ?></h4>
                                            <div class="card-body">
                                                <div class="table-wrap table-responsive">
                                                    <table class="table table-default">
                                                        <thead>
                                                        <th><?php echo e(__('ID')); ?></th>
                                                        <th><?php echo e(__('Font Family')); ?></th>
                                                        <th><?php echo e(__('Status')); ?></th>
                                                        <th><?php echo e(__('Body Typography')); ?></th>
                                                        <th><?php echo e(__('Heading Typography')); ?></th>
                                                        <th><?php echo e(__('Action')); ?></th>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $all_fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($data->id); ?></td>
                                                                <td><?php echo e($data->file); ?></td>
                                                                <td>
                                                                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-font-status')): ?>
                                                                    <?php if($data->status==1): ?>
                                                                        <span class="btn btn-success btn-sm"><?php echo e(__('Active')); ?></span>
                                                                    <?php elseif($data->status==2): ?>
                                                                            <span class="btn btn-success btn-sm"><?php echo e(__('Active')); ?></span>
                                                                    <?php else: ?>
                                                                        <span class="btn btn-danger"><?php echo e(__('Inactive')); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-font-status')): ?>
                                                                        <?php if($data->status==1): ?>
                                                                            <i class="las la-check-circle" style="font-size: 32px;color: #28a745"></i>
                                                                        <?php endif; ?>
                                                                        <?php if($data->status==0): ?>
                                                                                <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.custom-body-font','data' => ['url' => route('admin.custom.font.status',$data->id)]]); ?>
<?php $component->withName('custom-body-font'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.custom.font.status',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                                        <?php endif; ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-font-status')): ?>
                                                                            <?php if($data->status==2): ?>
                                                                                <i class="las la-check-circle" style="font-size: 32px;color: #28a745"></i>
                                                                            <?php endif; ?>
                                                                            <?php if($data->status==0): ?>
                                                                            <span><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.custom-heading-font','data' => ['url' => route('admin.custom.heading.font.status',$data->id)]]); ?>
<?php $component->withName('custom-heading-font'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.custom.heading.font.status',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?></span>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                </td>

                                                                <td>

                                                                    <?php if($data->status == 0): ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-font-delete')): ?>
                                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.delete-popover','data' => ['url' => route('admin.custom.delete.font.file',$data->id)]]); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.custom.delete.font.file',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>

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

                          <!-- custom font end -->
                        <div class="google_font_hide_and_show">
                        <h4 class="header-title"><?php echo e(__("Body Typography Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.typography.settings')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="body_font_family"><?php echo e(__('Font Family')); ?></label>
                                <select class="form-control nice-select wide" name="body_font_family" id="body_font_family">
                                    <?php $__currentLoopData = $google_fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font_family => $font_variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($font_family); ?>" <?php if($font_family == get_static_option('body_font_family')): ?> selected <?php endif; ?>><?php echo e($font_family); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group margin-top-50">
                                <label for="body_font_variant"><?php echo e(__('Font Variant')); ?></label>
                                <?php
                                    $font_family_selected = get_static_option('body_font_family') ?? get_static_option('body_font_family') ;
                                    $get_font_family_variants = property_exists($google_fonts,$font_family_selected) ? (array) $google_fonts->$font_family_selected : ['variants' => array('regular')];
                                ?>
                                <select class="form-control nice-select wide" multiple id="body_font_variant" name="body_font_variant[]">
                                    <?php $__currentLoopData = $get_font_family_variants['variants']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $selected_variant = !empty(get_static_option('body_font_variant')) ? unserialize(get_static_option('body_font_variant')) : [];
                                        ?>
                                        <option value="<?php echo e($variant); ?>" <?php if(in_array($variant,$selected_variant)): ?> selected <?php endif; ?>><?php echo e(str_replace(['0,','1,'],['','i'],$variant)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <h4 class="header-title margin-top-80"><?php echo e(__("Heading Typography Settings")); ?></h4>
                            <div class="form-group">
                                <label for="heading_font"><?php echo e(__('Heading Font')); ?></label>
                                <label class="switch">
                                    <input type="checkbox" name="heading_font"  <?php if(!empty(get_static_option('heading_font'))): ?> checked <?php endif; ?> id="heading_font">
                                    <span class="slider"></span>
                                </label>
                                <small><?php echo e(__('Use different font family for heading tags ( h1,h2,h3,h4,h5,h6)')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="heading_font_family"><?php echo e(__('Font Family')); ?></label>
                                <select class="form-control nice-select wide" name="heading_font_family" id="heading_font_family">
                                    <?php $__currentLoopData = $google_fonts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $font_family => $font_variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($font_family); ?>" <?php if($font_family == get_static_option('heading_font_family')): ?> selected <?php endif; ?>><?php echo e($font_family); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group margin-top-50">
                                <label for="heading_font_variant"><?php echo e(__('Font Variant')); ?></label>
                                <?php
                                    $font_family_selected = get_static_option('heading_font_family') ?? '';
                                    $get_font_family_variants = property_exists($google_fonts,$font_family_selected) ? (array) $google_fonts->$font_family_selected : ['variants' => array('regular')];
                                ?>
                                <select class="form-control nice-select wide" multiple name="heading_font_variant[]" id="heading_font_variant">
                                    <?php $__currentLoopData = $get_font_family_variants['variants']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $selected_variant = !empty(get_static_option('heading_font_variant')) ? unserialize(get_static_option('heading_font_variant')) : [];
                                        ?>
                                        <option value="<?php echo e($variant); ?>"
                                                <?php if(in_array($variant,$selected_variant)): ?> selected <?php endif; ?>><?php echo e(str_replace(['0,','1,'],['','i'],$variant)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <button type="submit" id="typography_submit_btn" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                       </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>

        <script src="<?php echo e(asset('assets/backend/js/codemirror.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/backend/js/css.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/backend/js/show-hint.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/backend/js/css-hint.js')); ?>"></script>
        <script>
            (function($) {
                "use strict";
                var editor = CodeMirror.fromTextArea(document.getElementById("custom_css_area"), {
                    lineNumbers: true,
                    mode: "text/css",
                    matchBrackets: true
                });
            })(jQuery);
        </script>


    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                //load font variant Four
                $(document).on('change','#body_font_family_three',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_three');
                });

                //load font variant Four
                $(document).on('change','#body_font_family_four',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_four');
                });

                //load font variant Five
                $(document).on('change','#body_font_family_five',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_five');
                });

                function getVariant(fontFamily,selector){
                    $.ajax({
                        url: "<?php echo e(route('admin.general.typography.single')); ?>",
                        type: "POST",
                        data:{
                            _token: "<?php echo e(csrf_token()); ?>",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#'+selector);
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });
                            variantSelector.niceSelect('update');
                        }
                    });
                }


                $(document).on('change','#body_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "<?php echo e(route('admin.general.typography.single')); ?>",
                        type: "POST",
                        data:{
                            _token: "<?php echo e(csrf_token()); ?>",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#body_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });
                            variantSelector.niceSelect('update');
                        }
                    });
                });

                $(document).on('change','#heading_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "<?php echo e(route('admin.general.typography.single')); ?>",
                        type: "POST",
                        data:{
                            _token: "<?php echo e(csrf_token()); ?>",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#heading_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });

                            variantSelector.niceSelect('update');
                        }
                    });

                });

                // google font use
                $(document).on('change','#google_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "<?php echo e(route('admin.general.typography.single')); ?>",
                        type: "POST",
                        data:{
                            _token: "<?php echo e(csrf_token()); ?>",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#heading_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });

                            variantSelector.niceSelect('update');
                        }
                    });

                });

                if($('.nice-select').length > 0){
                    $('.nice-select').niceSelect();
                }
                var dependendFields = $('select[name="heading_font_family"],#heading_font_variant');
                if(!$('input[name="heading_font"]').prop('checked')){
                    dependendFields.parent().hide()
                }

                // google heading font on off button
                $(document).on('change','input[name="heading_font"]',function (e) {
                    if(!$(this).prop('checked')){
                        dependendFields.parent().hide();
                    }else{
                        dependendFields.parent().show();
                    }
                });


                // custom font start
                if ($("#custom_font").is(':checked')){
                    $('.google_font_hide_and_show').hide();
                    $('.google_font_title_button').hide();
                }else{
                    $('.custom_font_hide_and_show').hide();
                    $('.custom_font_upload').hide();
                }

                $("#custom_font").on('change', function() {
                    if ($("#custom_font").is(':checked')){
                        $('.google_font_hide_and_show').hide();
                        $('.custom_font_hide_and_show').show();
                        $('.custom_font_title_button').show();
                        $('.custom_font_upload').show();
                    }else {
                        $('.google_font_hide_and_show').show();
                        $('.google_font_title_button').show();
                        $('.custom_font_hide_and_show').hide();
                        $('.custom_font_title_button').show();
                        $('.custom_font_upload').hide();
                    }
                });
                // custom font end



                $(document).on('click','#typography_submit_btn',function (e) {
                    e.preventDefault();
                    $(this).text('Updating...').prop('disabled',true);
                    $(this).parent().trigger('submit');
                })


                // custom heading font add
                $(document).on('click','.custom_heading_swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to make as this default heading font? ")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.custom_heading_font_form_submit_btn').trigger('click');
                        }
                    });
                });

                // custom heading font add
                $(document).on('click','.custom_body_swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to make as this default body font?")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.custom_body_font_form_submit_btn').trigger('click');
                        }
                    });
                });

            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/general-settings/typograhpy.blade.php ENDPATH**/ ?>