
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Services')); ?>

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
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.css','data' => []]); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <style>
        .meta-content .bootstrap-tagsinput .tag {
            margin-right: 2px !important;
            color: #444 !important;
            font-size: 14px!important;
            line-height: 24px !important;
            padding: 3px 10px !important;
            border-radius: 3px !important;
            border: 1px solid #e2e2e2 !important;
        }
        .meta-content .bootstrap-tagsinput {
            width: 100%;
        }
    </style>
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
                        <div class="col-lg-4">
                            <div class="dashboard-settings margin-top-40" style="width:65pc;">
                                <h2 class="dashboards-title"> <?php echo e(__('Edit Service')); ?> </h2>
                                <p class="text-warning"><?php echo e(__('Edit service will need to admin approval to activate.')); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-settings margin-top-40">
                                <a class="btn btn-success" href="<?php echo e(route('seller.services')); ?>"> <?php echo e(__('All Services')); ?></a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 margin-top-50">
                            <div class="single-settings">

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

                                <form action="<?php echo e(route('seller.edit.services',$service->id)); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="is_service_all_cities" id="is_service_all_cities_id" value="<?php echo e($service->is_service_all_cities); ?>">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="category" class="info-title"> <?php echo e(__('Select Parent Category*')); ?> </label>
                                            <select name="category" id="category">
                                                <option value=""><?php echo e(__('Select Category')); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat->id); ?>" <?php if($cat->id==$service->category_id): ?> selected <?php endif; ?>><?php echo e($cat->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        

                                        
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="title" class="info-title"> <?php echo e(__('Service Title*')); ?> </label>
                                            <input class="form--control" name="title" id="title" value="<?php echo e($service->title); ?>" type="text" placeholder="<?php echo e(__('Add title')); ?>">
                                        </div>
                                        
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30 permalink_label">
                                            <label for="title" class="info-title text-dark"> <?php echo e(__('Permalink*')); ?> </label>
                                                <span id="slug_show" class="display-inline" style="color: blue;"><?php echo e(url('/service-list/')); ?>/<?php echo e($service->slug); ?></span>
                                            <span id="slug_edit" class="display-inline"></span>
                                                <button class="btn btn-warning btn-sm slug_edit_button"> <i class="las la-edit"></i> </button>

                                            <input class="form--control service_slug" name="slug" id="slug" style="display: none" type="text" value="<?php echo e($service->slug); ?>">
                                            <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                        </div>
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="description" class="info-title"> <?php echo e(__('Service Description*')); ?> </label>
                                            <textarea class="form--control textarea--form summernote" name="description" placeholder="<?php echo e(__('Type Description')); ?>"><?php echo e($service->description); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <div class="form-group">
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap">
                                                        <?php echo render_image_markup_by_attachment_id($service->image,'','thumb'); ?>

                                                    </div>
                                                    <input type="hidden" id="image" name="image"
                                                            value="<?php echo e($service->image); ?>">
                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                            data-target="#media_upload_modal">
                                                        <?php echo e(__('Upload Service Image')); ?>

                                                    </button>
                                                </div>
                                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                <small class="text-danger"><?php echo e(__('recommended size 1920x1280')); ?></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php echo render_gallery_image_attachment_preview($service->image_gallery ?? ''); ?>

                                            </div>
                                            <input type="hidden" name="image_gallery">
                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                    data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                    data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                    data-toggle="modal"
                                                    data-mulitple="true"
                                                    data-target="#media_upload_modal">
                                                <?php echo e(__('Upload Gallery Image')); ?>

                                            </button>
                                            <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                            <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                        </div>
                                    </div>
                                    
                                    

                                    <div class="btn-wrapper margin-top-40">
                                        <input type="submit" class="btn btn-success btn-bg-1" value="<?php echo e(__('Update Service')); ?> ">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
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

<script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.js','data' => []]); ?>
<?php $component->withName('summernote.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

<script>
    $('.meta-content').show();
</script>

 <script>
    $(document).ready(function(){

        //Permalink Code
        
        //Slug Edit Code
        $(document).on('click', '.slug_edit_button', function (e) {
            e.preventDefault();
            $('.service_slug').show();
            $(this).hide();
            $('.slug_update_button').show();
        });

         function converToSlug(slug){
           let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
            //remove multiple space to single
            finalSlug = slug.replace(/  +/g, ' ');
            // remove all white spaces single or multiple spaces
            finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
            return finalSlug;
        }

        //Slug Update Code
        $(document).on('click', '.slug_update_button', function (e) {
            e.preventDefault();
            $(this).hide();
            $('.slug_edit_button').show();
            var update_input = $('.service_slug').val();
            var slug = converToSlug(update_input);
            var url = "<?php echo e(url('/service-list/')); ?>/" + slug;
            $('#slug_show').text(url);
            $('.service_slug').hide();
        });

        
        $('#category').on('change',function(){
            var category_id = $(this).val();
            $.ajax({
                method:'post',
                url:"<?php echo e(route('seller.subcategory')); ?>",
                data:{category_id:category_id},
                success:function(res){
                    if(res.status=='success'){
                        var alloptions = "<option value=''><?php echo e(__('Select Sub Category')); ?></option>";
                        var allSubCategory = res.sub_categories;
                        $.each(allSubCategory,function(index,value){
                            alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                        });  
                        $(".subcategory").html(alloptions);
                        $('#subcategory').niceSelect('update');
                    }
                }
            })
        })

        // service sub category and child category user.sub_category.child_category
        $(document).on('change','#subcategory', function() {
            var sub_cat_id = $(this).val();

            $.ajax({
                method: 'post',
                url: "<?php echo e(route('seller.subcategory.child.category')); ?>",
                data: {
                    sub_cat_id: sub_cat_id
                },
                success: function(res) {
                    if (res.status == 'success') {
                        var alloptions = "<option value=''><?php echo e(__('Select Child Category')); ?></option>";
                        var allList = "<li data-value='' class='option'><?php echo e(__('Select Child Category')); ?></li>";
                        var allChildCategory = res.child_category;

                        $.each(allChildCategory, function(index, value) {
                            alloptions += "<option value='" + value.id +
                                "'>" + value.name + "</option>";
                            allList += "<li class='option' data-value='" + value.id +
                                "'>" + value.name + "</li>";
                        });

                        $("#child_category").html(alloptions);
                        $(".child_category_wrapper ul.list").html(allList);
                        $(".child_category_wrapper").find(".current").html("<?php echo e(__('Select Child Category')); ?>");
                    }
                }
            })
        })




        $("#is_service_all_cities").on('change', function() {
            if ($("#is_service_all_cities").is(':checked')){
                $('#is_service_all_cities_id').val(1)
            }else {
                $('#is_service_all_cities_id').val(0)
            }
        });

    })
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/edit-service.blade.php ENDPATH**/ ?>