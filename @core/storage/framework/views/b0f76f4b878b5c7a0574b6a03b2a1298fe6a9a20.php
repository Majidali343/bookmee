


<?php $__env->startSection('page-meta-data'); ?>
    <title><?php echo e(__('Seller all Services')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php 
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>  
    <?php echo e(ucfirst($page_info)); ?>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('inner-title'); ?>
<?php echo e(__('Seller all Services')); ?>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('content'); ?>

    <!-- Category Service area starts -->
    <section class="category-services-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <?php if(!empty($categories)): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-category-service">
                        <div class="single-select">
                            <select id="search_by_category">
                                <option><?php echo e(__('Select Category')); ?></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-category-service">
                        <div class="single-select">
                            <select id="search_by_subcategory">
                                <option><?php echo e(__('Select Subcategory')); ?></option>
                                <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-category-service">
                        <div class="single-select">
                            <select id="search_by_rating">
                                <option><?php echo e(__('Select Star')); ?></option>
                                <option value="1"><?php echo e(__('One Star')); ?></option>
                                <option value="2"><?php echo e(__('Two Star')); ?></option>
                                <option value="3"><?php echo e(__('Three Star')); ?></option>
                                <option value="4"><?php echo e(__('Four Star')); ?></option>
                                <option value="5"><?php echo e(__('Five Star')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-category-service flex-category-service">
                        <div class="single-select">
                            <span class="select-sort"><?php echo e(__('Sort By:')); ?></span>
                            <select id="search_by_sorting">
                                <option><?php echo e(__('Sort By')); ?></option>
                                <option value="latest_service"><?php echo e(__('Latest Service')); ?></option>
                                <option value="price_lowest"><?php echo e(__('Lowest Price')); ?></option>
                                <option value="price_highest"><?php echo e(__('Highest Price')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20" id="search_result">

                <?php if(!empty($single_service)): ?>
                <input type="hidden" name="seller_id" id="seller_id" value="<?php echo e($single_service->seller_id); ?>">
                <?php endif; ?>

                <?php if(!empty($all_services)): ?>
                    <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="col-lg-4 col-md-6 margin-top-30 all-services">
                            <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                                <a href="<?php echo e(route('service.list.details',$service->slug)); ?>" class="service-thumb">
                                    <?php echo render_image_markup_by_attachment_id($service->image); ?>

                                    <?php if($service->featured == 1): ?>
                                    <div class="award-icons">
                                        <i class="las la-award"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="country_city_location">
                                        <span class="single_location"> <i class="las la-map-marker-alt"></i> <?php echo e(optional($service->serviceCity)->service_city); ?>, <?php echo e(optional(optional($service->serviceCity)->countryy)->country); ?> </span>
                                    </div>
                                </a>
                                <div class="services-contents">
                                    <ul class="author-tag">
                                        <li class="tag-list">
                                            <a href="<?php echo e(route('about.seller.profile',optional($service->seller)->username)); ?>">
                                                <div class="authors">
                                                    <div class="thumb">
                                                        <?php echo render_image_markup_by_attachment_id(optional($service->seller)->image); ?>

                                                        <span class="notification-dot"></span>
                                                    </div>
                                                    <span class="author-title"> <?php echo e(optional($service->seller)->name); ?> </span>
                                                </div>
                                            </a>
                                        </li>
                                        <?php if($service->reviews->count() >= 1): ?>
                                        <li class="tag-list">
                                            <a href="javascript:void(0)">
                                                <span class="icon"><?php echo e(__('Rating:')); ?></span>
                                                <span class="reviews"> 
                                                    <?php echo e(round(optional($service->reviews)->avg('rating'),1)); ?>

                                                    (<?php echo e(optional($service->reviews)->count()); ?>)
                                                </span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <h5 class="common-title"> <a href="<?php echo e(route('service.list.details',$service->slug)); ?>"> <?php echo e($service->title); ?> </a> </h5>
                                    <p class="common-para"> <?php echo e(Str::limit(strip_tags($service->description,100))); ?> </p>

                                    <div class="service-price">
                                        <span class="starting"> <?php echo e(__('Starting at')); ?> </span>
                                        <span class="prices"> <?php echo e(amount_with_currency_symbol($service->price)); ?> </span>
                                    </div>
                                    <div class="btn-wrapper d-flex flex-wrap">
                                        <a href="<?php echo e(route('service.list.book',$service->slug)); ?>" class="cmn-btn btn-small btn-bg-1"> <?php echo e(__('Book Now')); ?> </a>
                                        <a href="<?php echo e(route('service.list.details',$service->slug)); ?>" class="cmn-btn btn-small btn-outline-1 ml-auto"> <?php echo e(__('View Details')); ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-lg-12">
                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $all_services->links(); ?>

                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Category Service area end -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('change','#search_by_category',function(e){
                    e.preventDefault();
                    let category_id = $(this).val();
                    let seller_id = $('#seller_id').val();

                    $.ajax({
                        url:"<?php echo e(route('service.search.category')); ?>",
                        method:"get",
                        data:{
                            category_id:category_id,
                            seller_id:seller_id,
                        },
                        success:function(res){
                            if (res.status == 'success') {
                                $('#search_result').html(res.result);
                            }
                        }
                    });
                })

                $(document).on('change','#search_by_subcategory',function(e){
                    e.preventDefault();
                    let subcategory_id = $(this).val();
                    let seller_id = $('#seller_id').val();

                    $.ajax({
                        url:"<?php echo e(route('service.search.subcategory')); ?>",
                        method:"get",
                        data:{
                            subcategory_id:subcategory_id,
                            seller_id:seller_id,
                        },
                        success:function(res){
                            if (res.status == 'success') {
                                $('#search_result').html(res.result);
                            }
                        }
                    });
                })

                $(document).on('change','#search_by_rating',function(e){
                    e.preventDefault();
                    let rating = $(this).val();
                    let seller_id = $('#seller_id').val();

                    $.ajax({
                        url:"<?php echo e(route('service.search.rating')); ?>",
                        method:"get",
                        data:{
                            rating:rating,
                            seller_id:seller_id,
                        },
                        success:function(res){
                            if (res.status == 'success') {
                                $('#search_result').html(res.result);
                            }
                        }
                    });
                })

                $(document).on('change','#search_by_sorting',function(e){
                    e.preventDefault();
                    let sorting = $(this).val();
                    let seller_id = $('#seller_id').val();

                    $.ajax({
                        url:"<?php echo e(route('service.search.sorting')); ?>",
                        method:"get",
                        data:{
                            sorting:sorting,
                            seller_id:seller_id,
                        },
                        success:function(res){
                            if (res.status == 'success') {
                                $('#search_result').html(res.result);
                            }
                        }
                    });
                })

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/services/seller-all-services.blade.php ENDPATH**/ ?>