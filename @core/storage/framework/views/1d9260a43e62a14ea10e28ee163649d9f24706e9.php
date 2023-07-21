
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add Services')); ?>

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
                        <div class="col-lg-9" >
                            <div class="dashboard-settings margin-top-40" style="width:65pc;">
                        
                                <h2 class="dashboards-title"> <?php echo e(__('Add Service')); ?> </h2>
                                <div class="notice-board">
                                    <?php if(get_static_option('service_create_settings') == 'verified_seller'): ?>
                                        <p class="text-dark"><?php echo e(__('You can not add services if you are not verified.')); ?></p>
                                    <?php endif; ?>
                                    <p class="text-dark"><?php echo e(__('This part is common for both of/on line services. After create service you will redirect a page where you will create service attributes for offline or online.')); ?></p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 margin-top-30">
                            <div class="single-settings">

                                <div> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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

                                <form action="<?php echo e(route('seller.add.services')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="is_service_all_cities"  id="is_service_all_cities_id">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="category" class="info-title"> <?php echo e(__('Select Main Category*')); ?> </label>
                                            <select name="category" id="category">
                                                <option value=""><?php echo e(__('Select Category')); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        

                                        
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="title" class="info-title"> <?php echo e(__('Service Title*')); ?> </label>
                                            <input class="form--control" name="title" id="title" type="text" placeholder="<?php echo e(__('Add title')); ?>">
                                        </div>
                                        
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30 permalink_label">
                                            <label for="title" class="info-title text-dark"> <?php echo e(__('Permalink*')); ?> </label>
                                                <span id="slug_show" class="display-inline"></span>
                                            <span id="slug_edit" class="display-inline"> </span>
                                                <button class="btn btn-warning btn-sm slug_edit_button">  <i class="las la-edit"></i> </button>

                                            <input class="form--control service_slug" name="slug" id="slug" style="display: none" type="text">
                                            <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                        </div>
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="description" class="info-title"> <?php echo e(__('Service Description*')); ?> </label>
                                            <textarea class="form--control textarea--form summernote" name="description" placeholder="<?php echo e(__('Type Description')); ?>"></textarea>
                                        </div>
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
                                                        <?php echo e(__('Upload Main Image')); ?>

                                                    </button>
                                                    <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                                    <small><?php echo e(__('recommended size 1920x1280')); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
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

                                    


                                    <?php if(get_static_option('service_create_settings') == 'all_seller'): ?>
                                    <div class="btn-wrapper margin-top-40">
                                        <input type="submit" class="btn btn-success btn-bg-1" value="<?php echo e(__('Save & Next')); ?> ">
                                    </div>
                                    <?php else: ?>
                                        <?php
                                            $seller = App\SellerVerify::select('seller_id','status')->where('seller_id',Auth::guard('web')->user()->id)->first()
                                        ?>
                                        <?php if(!is_null($seller) && $seller->status==1): ?>
                                        <div class="btn-wrapper margin-top-40">
                                            <input type="submit" class="btn btn-success btn-bg-1" value="<?php echo e(__('Save & Next')); ?> ">
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
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
<script type="text/javascript">
    (function(){
    "use strict";
    $(document).ready(function(){

        //Permalink Code
        $('.permalink_label').hide();
        
        $(document).on('keyup', '#title', function (e) {
            var slug = converToSlug($(this).val());
            var url = "<?php echo e(url('/service/')); ?>/" + slug;
            $('.permalink_label').show();
            var data = $('#slug_show').text(url).css('color', 'blue');
            $('.service_slug').val(slug);

        });
        
        function converToSlug(slug){
           let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
            //remove multiple space to single
            finalSlug = slug.replace(/  +/g, ' ');
            // remove all white spaces single or multiple spaces
            finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
            return finalSlug;
        }

        //Slug Edit Code
        $(document).on('click', '.slug_edit_button', function (e) {
            e.preventDefault();
            $('.service_slug').show();
            $(this).hide();
            $('.slug_update_button').show();
        });

        //Slug Update Code
        $(document).on('click', '.slug_update_button', function (e) {
            e.preventDefault();
            $(this).hide();
            $('.slug_edit_button').show();
            var update_input = $('.service_slug').val();
            var slug = converToSlug(update_input);
            var url = `<?php echo e(url('/service/')); ?>/` + slug;
            $('#slug_show').text(url);
            $('.service_slug').hide();
        });

        // service category and sub category
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

                    }
                }
            })
        })


        // service sub category and child category
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
                        $(".child_category_wrapper").find(".current").html("Select Child Category");
                    }
                }
            })
        })


        $("#is_service_all_cities").on('change', function() {
            if ($("#is_service_all_cities").is(':checked')){
                $('#is_service_all_cities_id').val(1)
            }else {
                $('#is_service_all_cities_id').val('')
            }
        });

    })
})(jQuery);

 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/services/add-service.blade.php ENDPATH**/ ?>