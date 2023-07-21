
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Buyer Profile')); ?>

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
                <?php echo $__env->make('frontend.user.buyer.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="dashboard-right">
                    <div class="profile-dashboards">
                        <div class="row">
                            <div class="col-lg-12 margin-top-40">
                                <div class="edit-profile">
                                    <div class="profile-info-dashboard">
                                        <h2 class="dashboards-title"> <?php echo e(__('Edit Profile')); ?> </h2>
                                        <div class="dashboard-profile-flex">
                                            <div class="thumbs margin-top-40">
                                                <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                                                <div class="edit-thumb">
                                                    <a href="javascript:void(0)"> <i class="lar la-image"></i> </a>
                                                </div>
                                            </div>
                                            <div class="dashboard-address-details">
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
                                                <form action="<?php echo e(route('seller.profile.edit')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Your Name*')); ?> </label>
                                                            <input class="form--control" type="text" name="name" value="<?php echo e(Auth::guard('web')->user()->name); ?>" placeholder="<?php echo e(__('Type Your Name')); ?>">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Your Email*')); ?> </label>
                                                            <input class="form--control" type="email" name="email"  value="<?php echo e(Auth::guard('web')->user()->email); ?>"  placeholder="<?php echo e(__('Type Your Email')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Phone Number*')); ?> </label>
                                                            <input class="form--control" type="text" name="phone" value="<?php echo e(Auth::guard('web')->user()->phone); ?>" placeholder="<?php echo e(__('Type Your Number')); ?>">
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Country*')); ?> </label>
                                                            <select name="country" id="country">
                                                                <?php if(!empty($countries)): ?>
                                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                       <option value="<?php echo e($country->id); ?>" <?php if($country->id==Auth::guard('web')->user()->country_id): ?> selected <?php endif; ?>><?php echo e($country->country); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Service City*')); ?> </label>
                                                            <select name="service_city" id="service_city">
                                                                <?php if(!empty($cities)): ?>
                                                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                       <option value="<?php echo e($city->id); ?>" <?php if($city->id==Auth::guard('web')->user()->service_city): ?> selected <?php endif; ?>><?php echo e($city->service_city); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Service Area*')); ?> </label>
                                                            <select name="service_area" id="service_area">
                                                                <?php if(!empty($areas)): ?>
                                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                       <option value="<?php echo e($area->id); ?>" <?php if($area->id==Auth::guard('web')->user()->service_area): ?> selected <?php endif; ?>><?php echo e($area->service_area); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Post Code*')); ?> </label>
                                                            <input class="form--control" type="text" name="post_code" value="<?php echo e(Auth::guard('web')->user()->post_code); ?>" placeholder="<?php echo e(__('Type Post Code')); ?>">
                                                        </div>
                                                    </div>    
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('Your Address*')); ?> </label>
                                                            <input class="form--control" type="text" name="address" value="<?php echo e(Auth::guard('web')->user()->address); ?>" placeholder="<?php echo e(__('Type Your Address')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <label class="info-title"> <?php echo e(__('About*')); ?> </label>
                                                            <textarea class="form--control textarea--form" name="about" placeholder="<?php echo e(__('Type Note')); ?>"><?php echo e(Auth::guard('web')->user()->about); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image,'','thumb'); ?>

                                                                    </div>
                                                                    <input type="hidden" id="image" name="image"
                                                                           value="<?php echo e(Auth::guard('web')->user()->image); ?>">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Profile Image')); ?>

                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger"><?php echo e(__('recomended size 500x443')); ?></small>
                                                    <div class="single-dashboard-input">
                                                        <div class="single-info-input margin-top-30">
                                                            <div class="form-group">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->profile_background); ?>

                                                                    </div>
                                                                    <input type="hidden" id="profile_background" name="profile_background"
                                                                           value="<?php echo e(Auth::guard('web')->user()->profile_background); ?>">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                            data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal"
                                                                            data-target="#media_upload_modal">
                                                                        <?php echo e(__('Upload Background Image')); ?>

                                                                    </button>
                                                                </div>
                                                                <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="text-danger"><?php echo e(__('recomended size 1394x315')); ?></small>
                                                    <div class="btn-wrapper margin-top-35">
                                                        <button type="submit" class="btn cmn-btn btn-bg-1"><?php echo e(__('Save Changes')); ?></button>
                                                    </div>
                                                </form>
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

   
    <script type="text/javascript">
        (function() {
            "use strict";
            $(document).ready(function() {
                $('.select_activation').select2();

                // change country and get city
                $(document).on('change','#country' ,function() {
                    let country_id = $("#country").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.country.city')); ?>",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''><?php echo e(__('Select City')); ?></option>";
                                var allList = "<li class='option' data-value=''><?php echo e(__('Select City')); ?></li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city").html(alloptions);
                                $("#service_city").parent().find(".current").html("__('Select City')");
                                $("#service_city").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                                $(".service_area_wrapper .list").html("");
                            }
                        }
                    })
                })

                // select city and area
                $(document).on('change','#service_city', function() {
                    
                    var city_id = $("#service_city").val();
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('user.city.area')); ?>",
                        data: {
                            city_id: city_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''><?php echo e(__('Select Area')); ?></option>";
                                var allList = "<li data-value='' class='option'><?php echo e(__('Select Area')); ?></li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("<?php echo e(__('Select Area')); ?>");
                            }
                        }
                    })
                })

            });
        })(jQuery);
       </script>
    <?php $__env->stopSection(); ?>    
<?php echo $__env->make('frontend.user.seller.seller-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/buyer/profile/buyer-profile-edit.blade.php ENDPATH**/ ?>