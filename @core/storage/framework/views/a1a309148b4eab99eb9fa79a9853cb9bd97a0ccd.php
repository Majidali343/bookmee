

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add New Service')); ?>

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
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/flatpickr.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Add New Service')); ?>   </h4>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.add.service')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="single-dashboard-input">
                                <div class="single-info-input margin-top-30">
                                    <label for="category" class="info-title"> <?php echo e(__('Select Main Category*')); ?> </label>
                                    <select name="category" id="category" class="form-control">
                                        <option value=""><?php echo e(__('Select Category')); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="single-info-input margin-top-30" id="sub_category">
                                    <label for="subcategory" class="info-title"> <?php echo e(__('Select Sub Category*')); ?> </label>
                                    <select  name="subcategory" id="subcategory" class="subcategory form-control"></select>
                                </div>
                                <div class="single-info-input margin-top-30 child_category_wrapper">
                                    <label for="child_category" class="info-title"> <?php echo e(__('Select Child Category')); ?> </label>
                                    <select  name="child_category" id="child_category" class="form-control"></select>
                                </div>
                            </div>

                            <div class="single-dashboard-input">
                                <div class="single-info-input margin-top-30">
                                    <label for="seller_id" class="info-title"> <?php echo e(__('Select Seller*')); ?> </label>
                                    <select name="seller_id" id="seller_id" class="form-control">
                                        <option value=""><?php echo e(__('Select Seller')); ?></option>
                                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="single-info-input margin-top-30 mt-5">
                                    <label for="video" class="info-title"> <?php echo e(__('Service Video Url')); ?> </label>
                                    <input class="form-control" name="video" id="video" value="<?php echo e(old('video')); ?>" type="text" placeholder="<?php echo e(__('youtube embed code')); ?>">
                                    <small class="text-danger"><?php echo e(__('must be embed code from youtube.')); ?></small>
                                </div>
                            </div>

                            <div class="single-dashboard-input">
                                <div class="single-info-input margin-top-30">
                                    <label for="title" class="info-title"> <?php echo e(__('Service Title*')); ?> </label>
                                    <input class="form-control" name="title" id="title" value="<?php echo e(old('title')); ?>" type="text" placeholder="<?php echo e(__('Add title')); ?>">
                                </div>
                                
                            </div>

                            <div class="single-dashboard-input">
                                <div class="single-info-input margin-top-30 permalink_label">
                                    <label for="title" class="info-title text-dark"> <?php echo e(__('Permalink*')); ?> </label>
                                    <span id="slug_show" class="display-inline"></span>
                                    <span id="slug_edit" class="display-inline">
                                        <button class="btn btn-warning btn-sm slug_edit_button">  <i class="las la-edit"></i> </button>
                                        <input class="form-control service_slug" name="slug" value="<?php echo e(old('slug')); ?>" id="slug" style="display: none" type="text">
                                        <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none"><?php echo e(__('Update')); ?></button>
                                    </span>
                                </div>
                            </div>

                            <div class="single-dashboard-input">
                                <div class="single-info-input margin-top-30">
                                    <label for="description" class="info-title"> <?php echo e(__('Service Description*')); ?> </label>
                                    <textarea class="form-control textarea--form summernote" name="description" placeholder="<?php echo e(__('Type Description')); ?>"><?php echo e(old('description')); ?></textarea>
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
                                            <small><?php echo e(__('recommended size 730x497')); ?></small>
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
                                        <?php echo e(__('Upload Gallary Image')); ?>

                                    </button>
                                    <small><?php echo e(__('image format: jpg,jpeg,png')); ?></small> <br>
                                    <small><?php echo e(__('recommended size 730x497')); ?></small>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body meta">
                                            <h5 class="header-title"><?php echo e(__('Meta Section')); ?></h5>
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-3">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                         role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="v-pills-home-tab"
                                                           data-toggle="pill" href="#v-pills-home" role="tab"
                                                           aria-controls="v-pills-home"
                                                           aria-selected="true"><?php echo e(__('Service Meta')); ?></a>
                                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                                           href="#v-pills-profile" role="tab"
                                                           aria-controls="v-pills-profile"
                                                           aria-selected="false"><?php echo e(__('Facebook Meta')); ?></a>
                                                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                           href="#v-pills-messages" role="tab"
                                                           aria-controls="v-pills-messages"
                                                           aria-selected="false"><?php echo e(__('Twitter Meta')); ?></a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-lg-9">
                                                    <div class="tab-content meta-content" id="v-pills-tabContent">

                                                        <div class="tab-pane fade show active" id="v-pills-home"
                                                             role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="form-group">
                                                                <label for="title"><?php echo e(__('Meta Title')); ?></label>
                                                                <input type="text" class="form-control" name="meta_title" value="<?php echo e(old('meta_title')); ?>"
                                                                       placeholder="<?php echo e(__('Title')); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="slug"><?php echo e(__('Meta Tags')); ?></label>
                                                                <input type="text" class="form-control" name="meta_tags" value="<?php echo e(old('meta_tags')); ?>"
                                                                       placeholder="Slug" data-role="tagsinput">
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="title"><?php echo e(__('Meta Description')); ?></label>
                                                                    <textarea name="meta_description"
                                                                              class="form-control max-height-140"
                                                                              cols="20"
                                                                              rows="4"><?php echo e(old('meta_description')); ?></textarea>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                             aria-labelledby="v-pills-profile-tab">
                                                            <div class="form-group">
                                                                <label for="title"><?php echo e(__('Facebook Meta Title')); ?></label>
                                                                <input type="text" class="form-control" placeholder="<?php echo e(__('Title')); ?>" value="<?php echo e(old('tagsinput')); ?>"
                                                                       name="facebook_meta_tags">
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="title"><?php echo e(__('Facebook Meta Description')); ?></label>
                                                                    <textarea name="facebook_meta_description"
                                                                              class="form-control max-height-140"
                                                                              cols="20"
                                                                              rows="4"><?php echo e(old('facebook_meta_description')); ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="image"><?php echo e(__('Facebook Meta Image')); ?></label>
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap"></div>
                                                                    <input type="hidden" name="facebook_meta_image">
                                                                    <button type="button"
                                                                            class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                            data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Image')); ?>

                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                             aria-labelledby="v-pills-messages-tab">
                                                            <div class="form-group">
                                                                <label for="title"><?php echo e(__('Twitter Meta Title')); ?></label>
                                                                <input type="text" class="form-control" placeholder="<?php echo e(__('Title')); ?>"
                                                                       name="twitter_meta_tags">
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="title"><?php echo e(__('Twitter Meta Description')); ?></label>
                                                                    <textarea name="twitter_meta_description"
                                                                              class="form-control max-height-140"
                                                                              cols="20"
                                                                              rows="4"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="image"><?php echo e(__('Twitter Meta Image')); ?></label>
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap"></div>
                                                                    <input type="hidden" name="twitter_meta_image">
                                                                    <button type="button"
                                                                            class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>"
                                                                            data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Image')); ?>

                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                                <div class="btn-wrapper margin-top-40">
                                    <input type="submit" class="btn btn-success btn-bg-1" value="<?php echo e(__('Save & Next')); ?> ">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
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

<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
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
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                //Permalink Code
                $('.permalink_label').hide();

                $(document).on('keyup', '#title', function (e) {
                    var slug = converToSlug($(this).val());
                    var url = "<?php echo e(url('/service/')); ?>/" + slug;
                    $('.permalink_label').show();
                    var data = $('#slug_show').text(url).css('color', '#3c3cf7');
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

                $('#category').on('change',function(){
                    let category_id = $(this).val();
                    $.ajax({
                        method:'post',
                        url:"<?php echo e(route('admin.get.subcategory')); ?>",
                        data:{category_id:category_id},
                        success:function(res){
                            if(res.status=='success'){
                                let alloptions = '';
                                let allSubCategory = res.sub_categories;
                                $.each(allSubCategory,function(index,value){
                                    alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                                });
                                $(".subcategory").html(alloptions);
                                $('#subcategory').niceSelect('update');
                            }
                        }
                    })
                })

                // service sub category and child category
                $(document).on('click','#subcategory', function() {
                    var sub_cat_id = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('admin.get.subcategory.with.child.category')); ?>",
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

            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/backend/pages/services/admin-service/add_new_service.blade.php ENDPATH**/ ?>