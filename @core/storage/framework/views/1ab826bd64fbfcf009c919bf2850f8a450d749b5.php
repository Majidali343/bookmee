

<?php $__env->startSection('site-title'); ?>
    <?php echo e($service_details->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    <?php echo e(__(ucwords(str_replace("-", " ", $page_info)))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('inner-title'); ?>
    <?php echo e($service_details->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_service($service_details); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalvideo_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="single-slider">
                        <div class="gallery-images single-featured">
                            <?php echo $service_details->video; ?>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
<style>
    .single-packages .details-available-price .available-list li::before{
        border: 1px solid rgba(35, 56, 87, 1);
        color: rgba(35, 56, 87, 1);
    }
</style>

    <!-- Service Details area starts -->
    <section class="service-details-area padding-top-70 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 margin-top-30 order-2 order-lg-1">
                    <div class="service-details-wrapper">
                        <div class="service-details-inner">
                            <div class="details-thumb">
                                <div class="main-img-box ">
                                    <?php if(!is_null($service_details->image_gallery)): ?>
                                        <div class="service-details-slider">
                                            <?php
                                                $images = explode("|",$service_details->image_gallery);
                                            ?>
                                            <div class="single-slider">
                                                <div class="gallery-images single-featured service-details-background-image" <?php echo render_background_image_markup_by_attachment_id($service_details->image); ?>> </div>
                                            </div>
                                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="single-slider">
                                                    <div class="gallery-images single-featured service-details-background-image" <?php echo render_background_image_markup_by_attachment_id($img); ?>>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="gallery-images single-featured service-details-background-image" <?php echo render_background_image_markup_by_attachment_id($service_details->image); ?>>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>

                            <ul class="author-tag style-02 mt-4">
                                <li class="tag-list">
                                    <a href="<?php echo e(route('about.seller.profile',optional($service_details->seller)->username)); ?>">
                                        <div class="authors">
                                            <div class="thumb">
                                                <?php echo render_image_markup_by_attachment_id(optional($service_details->seller)->image); ?>

                                                <span class="notification-dot"></span>
                                            </div>
                                            <span class="author-title"> <?php echo e(optional($service_details->seller)->name); ?> </span>
                                        </div>
                                    </a>
                                </li>
                                <?php if(!empty($service_rating)): ?>
                                    <li class="tag-list">
                                        <a href="javascript:void(0)">
                                            <span class="icon"><?php echo e(__('Rating:')); ?></span>
                                            <span class="reviews">
                                            <?php echo ratting_star($service_rating); ?>

                                            (<?php echo e($service_reviews->count()); ?>)
                                        </span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($service_details->video): ?>
                                    <li class="video-btn">
                                        <div class="btn-wrapper">
                                            <a href="#0" class="cmn-btn btn-bg-1 mt-3" data-toggle="modal" data-target="#exampleModalvideo_modal">
                                                <?php echo e(__('Watch Video')); ?>

                                            </a>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <ul class="details-tabs tabs margin-top-55">
                                <li data-tab="tab1" class="list active">
                                    <?php echo e(get_static_option('service_details_overview_title') ?? __('Overview')); ?>

                                </li>
                                <li class="list" data-tab="tab2">
                                    <?php echo e(get_static_option('service_details_about_seller_title') ?? __('About Seller')); ?>

                                </li>
                                <li class="list" data-tab="tab3">
                                    <?php echo e(get_static_option('service_details_review_title') ?? __('Review')); ?>

                                </li>
                            </ul>
                            <div class="tab-content another-tab-content active" id="tab1">
                                <div class="details-content-tab padding-top-10">
                                    <p class="details-tap-para"> <?php echo $service_details->description; ?> </p>
                                </div>
                                <?php if($service_includes->count() > 0): ?>
                                    <div class="overview-single style-02 padding-top-60">
                                        <h4 class="title"> <?php echo e(get_static_option('service_details_what_you_get') ?? __('What you will get:')); ?> </h4>
                                        <ul class="overview-benefits margin-top-30">
                                            <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list"> <a href="javascript:void(0)"> <?php echo e($include['include_service_title']); ?> </a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if($service_benifits->count() > 0): ?>
                                    <div class="overview-single style-02 padding-top-60">
                                        <h4 class="title"><?php echo e(get_static_option('service_details_benifits_title') ?? __('Benefits of the premium Package:')); ?> </h4>
                                        <ul class="overview-benefits margin-top-30">
                                            <?php $__currentLoopData = $service_benifits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list"> <a href="javascript:void(0)"> <?php echo e($additional['benifits']); ?> </a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>



                            <!-- FAQ Area starts -->
                                <?php if($service_details->serviceFaq()->count() >= 1): ?>
                                    <div class="faq-area" data-padding-top="70" data-padding-bottom="100" >
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12 margin-top-30">
                                                    <div class="faq-contents">
                                                            <?php $__currentLoopData = $service_details->serviceFaq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    if (empty($faq->title)){
                                                                        continue;
                                                                    }
                                                                ?>
                                                            <div class="faq-item wow fadeInLeft" data-wow-delay=".2s">
                                                                <div class="faq-title">
                                                                    <?php echo e($faq->title); ?>

                                                                </div>
                                                                <div class="faq-panel">
                                                                    <p class="faq-para"><?php echo e($faq->description); ?></p>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endif; ?>
                            <!-- FAQ Area ends -->


                            </div>
                            <div class="tab-content another-tab-content" id="tab2">
                                <div class="details-content-tab padding-top-10">
                                    <div class="about-seller-tab margin-top-30">
                                        <div class="about-seller-flex-content">
                                            <div class="about-seller-thumb">
                                                <?php echo render_image_markup_by_attachment_id(optional($service_details->seller)->image,'','thumb'); ?>

                                            </div>
                                            <div class="about-seller-content">
                                                <h5 class="title"> <a href="<?php echo e(route('about.seller.profile',optional($service_details->seller)->username)); ?>"> <?php echo e(optional($service_details->seller)->name); ?> </a> </h5>
                                                <?php if($completed_order >=1): ?>
                                                    <div class="about-seller-list">
                                                        <span class="icon"><?php echo e(__('Order Completed')); ?></span>
                                                        <span class="reviews">(<?php echo e($completed_order); ?>) </span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="seller-details-box margin-top-40">
                                            <ul class="seller-box-list">
                                                <li class="box-list"> <?php echo e(__('From')); ?>

                                                    <strong>
                                                        <?php echo e(optional(optional($service_details->seller)->country)->country); ?>

                                                    </strong>
                                                </li>
                                                <?php if(!empty($seller_since)): ?>
                                                    <li class="box-list"> <?php echo e(__('Seller Since')); ?>

                                                        <strong>
                                                            <?php echo e(Carbon\Carbon::parse($seller_since->created_at)->year); ?>

                                                        </strong>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($order_completion_rate>=1): ?>
                                                    <li class="box-list"> <?php echo e(__('Order Completion Rate')); ?>

                                                        <strong> <?php echo e(ceil($order_completion_rate)); ?>%
                                                        </strong>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($completed_order>=1): ?>
                                                    <li class="box-list"><?php echo e(__('Order Completed')); ?>

                                                        <strong>
                                                            <?php echo e($completed_order); ?>

                                                        </strong>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <p class="seller-details-para"> <?php echo e(optional($service_details->seller)->about); ?>  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content another-tab-content" id="tab3">

                                <div class="details-content-tab padding-top-10">
                                    <div class="about-review-tab">
                                        <?php if(!empty($service_reviews)): ?>
                                            <?php $__currentLoopData = $service_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="about-seller-flex-content style-02">
                                                    <div class="about-seller-thumb">
                                                        <a href="javascript:void(0)"> <?php echo render_image_markup_by_attachment_id(optional($review->buyer)->image); ?> </a>
                                                    </div>
                                                    <div class="about-seller-content">
                                                        <a href="<?php echo e(route('about.buyer.profile',optional($review->buyer)->username)); ?>">
                                                        <h5 class="title"> <a href="javascript:void(0)"><?php echo e($review->name); ?></a> </h5>
                                                        </a>
                                                        <div class="about-seller-list">
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                            <span class="icon">  <i class="las la-star"></i>  </span>
                                                        </div>
                                                        <p class="about-review-para"><?php echo e($review->message); ?></p>
                                                        <span class="review-date"> <?php echo e(optional($review->created_at)->toFormattedDateString()); ?> </span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php if(!empty($buyer_order_services)): ?>
                                <?php $__currentLoopData = $buyer_order_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($service->service_id==$service_details->id): ?>
                                        <!-- Comment area Starts -->
                                            <div class="comment-area padding-top-100">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="section-title-two">
                                                                <h3 class="title"><?php echo e(get_static_option('service_post_reviews_title') ?? __('Post Your Review')); ?> </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 padding-top-20">
                                                            <div class="details-comment-content">
                                                                <form action="" class="service_review_form">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" id="service_id" value="<?php echo e($service_details->id); ?>">
                                                                    <input type="hidden" id="seller_id" value="<?php echo e($service_details->seller_id); ?>">

                                                                    <div class="comments-flex-item">
                                                                        <div class="single-commetns" style="font-size: 1em;">
                                                                            <label class="comment-label"> <?php echo e(__('Ratings*')); ?> </label>
                                                                            <div id="review"></div>
                                                                        </div>
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label" for="star_input"><?php echo e(__('Stars')); ?></label>
                                                                            <input type="text" readonly id="rating" name="rating" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="comments-flex-item">
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label"><?php echo e(__('Your Name*')); ?></label>
                                                                            <input type="text" class="form--control" id="name" name="name"
                                                                                   <?php if(Auth::guard('web')->check()): ?>
                                                                                   value="<?php echo e(Auth::guard('web')->user()->name); ?>"
                                                                                   <?php else: ?>
                                                                                   value=""
                                                                                   <?php endif; ?>
                                                                                   placeholder="<?php echo e(__('Type Name')); ?>">
                                                                        </div>
                                                                        <div class="single-commetns">
                                                                            <label class="comment-label"><?php echo e(__('Email Address*')); ?></label>
                                                                            <input type="text" class="form--control" id="email" name="email"
                                                                                   <?php if(Auth::guard('web')->check()): ?>
                                                                                   value="<?php echo e(Auth::guard('web')->user()->email); ?>"
                                                                                   <?php else: ?>
                                                                                   value=""
                                                                                   <?php endif; ?>
                                                                                   placeholder="<?php echo e(__('Type Email')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-commetns">
                                                                        <label class="comment-label"><?php echo e(__('Comments*')); ?></label>
                                                                        <textarea id="message" name="message" class="form--control form--message" placeholder="<?php echo e(__('Post Comments')); ?>"></textarea>
                                                                    </div>
                                                                    <button type="submit"><?php echo e(__('Send Review')); ?></button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment area ends -->
                                            <?php break; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                    <?php if($another_service->count() > 0): ?>
                        <div class="another-details-wrapper padding-top-100">
                            <div class="section-title-two">
                                <h3 class="title"><?php echo e(get_static_option('service_details_another_service_title') ?? __('Another Service of this Seller')); ?></h3>
                                <a href="<?php echo e(route('seller.service.all',$service_details->seller_id)); ?>" class="section-btn"><?php echo e(get_static_option('service_details_explore_all_title') ?? __('Explore All')); ?></a>
                            </div>
                            <div class="row padding-top-20">

                                <?php $__currentLoopData = $another_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 margin-top-30">
                                        <div class="single-service no-margin">
                                            <a href="<?php echo e(route('service.list.details',$service->slug)); ?>" class="service-thumb service-bg-thumb-format" <?php echo render_background_image_markup_by_attachment_id($service->image); ?>>

                                                <?php if($service->featured == 1): ?>
                                                    <div class="award-icons">
                                                        <i class="las la-award"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <!-- <div class="country_city_location">
                                                    <span class="single_location"> <i class="las la-map-marker-alt"></i> <?php echo e(optional($service->serviceCity)->service_city); ?>, <?php echo e(optional(optional($service->serviceCity)->countryy)->country); ?> </span>
                                                </div> -->
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
                                                                <span class="author-title"> <?php echo e(optional($service->seller)->name); ?>  </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <?php if($service->reviews->count() >= 1): ?>
                                                        <li class="tag-list">
                                                            <a href="javascript:void(0)">
                                                    <span class="reviews">
                                                        <?php echo ratting_star(round(optional($service->reviews)->avg('rating'),1)); ?>

                                                        (<?php echo e(optional($service->reviews)->count()); ?>)
                                                    </span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                                <h5 class="common-title"> <a href="<?php echo e(route('service.list.details',$service->slug)); ?>"><?php echo e($service->title); ?></a> </h5>
                                                <span class="single_location"> <i class="las la-map-marker-alt"></i> <?php echo e(optional($service->serviceCity)->service_city); ?>, <?php echo e(optional(optional($service->serviceCity)->countryy)->country); ?> </span>

                                                <!-- <p class="common-para"> <?php echo e(Str::limit(strip_tags($service->description),100)); ?> </p> -->
                                                <div class="service-price mt-0" >
                                                    <span class="starting"><?php echo e(__('Starting at')); ?></span>
                                                    <span class="prices" style="color: rgba(3, 152, 158, 1);" > ₹ <?php echo e($service->price); ?> </span>
                                                </div>
                                                <div class="btn-wrapper d-flex flex-wrap">
                                                    <a href="<?php echo e(route('service.list.book',$service->slug)); ?>" class="cmn-btn btn-small btn-bg-1 form-control" style="background-color: rgba(3, 152, 158, 1);"> <?php echo e(__('Book Appointment')); ?> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-lg-4 margin-top-30  order-1 order-lg-2">
                    <div class="service-details-package">
                        <div class="single-packages">
                            <ul class="package-price">
                                <li> <?php echo e(get_static_option('service_details_package_title') ?? __('Package')); ?> </li>
                                <li style="color: rgba(3, 152, 158, 1);"> ₹ <?php echo e($service_details->price); ?> </li>
                            </ul>
                            <div class="details-available-price margin-top-20">
                                <span class="summery-title">
                                    <?php if($service_details->is_service_online != 1): ?>
                                        <h6 class="tilte-available"> <?php echo e(get_static_option('service_details_package_subtitle') ?? __('Available Service Packages')); ?></h6>
                                    <?php else: ?>
                                        <ul class='onlilne-special-list'>
                                            <li><i class="las la-clock"></i> <?php echo e(__('Delivery Days').': '.$service_details->delivery_days); ?></li>
                                            <li><i class="las la-redo-alt"></i> <?php echo e(__('Revisions').': '.$service_details->revision); ?></li>
                                        </ul>
                                    <?php endif; ?>
                                <ul class="available-list" style="color: rgba(3, 152, 158, 1);">
                                    <?php $__currentLoopData = $service_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li> <?php echo e($include['include_service_title']); ?> </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="btn-wrapper text-center margin-top-30">
                                <a class="cmn-btn btn-bg-1 d-block" href="<?php echo e(route('service.list.book',$service_details->slug)); ?>" style="background-color: rgba(3, 152, 158, 1);"> <?php echo e(get_static_option('service_details_button_title') ?? __('Book Appointment')); ?> </a>
                                <!-- <?php if(moduleExists("LiveChat")): ?>
                                    <?php if(Auth::guard('web')->check()): ?>
                                        <?php if(Auth::guard('web')->user()->user_type == 1): ?>
                                            <br><a class="cmn-btn btn-bg-1 chat-toggle open-button live-chat-button-class-for-style" data-id="<?php echo e($service_details->seller_id); ?>" data-user="<?php echo e(optional($service_details->seller)->name); ?>"><i class="las la-comments"></i> <?php echo e(get_static_option('service_chat_title') ?? sprintf(__('Chat With %s'),optional($service_details->seller)->name)); ?> </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?> -->
                            </div>
                        </div>
                        <div class="order-pagkages">
                            <?php if($completed_order >=1): ?>
                                <span class="single-order"> <i class="las la-check"></i>
                                <?php echo e($completed_order); ?> <?php echo e(__('Order Completed')); ?>

                            </span>
                            <?php endif; ?>
                            <?php if($seller_rating_percentage_value >=1): ?>
                                <span class="single-order"> <i class="las la-star"></i>
                                <?php echo e(__('Seller Rating:')); ?>

                                    <?php echo e(ceil($seller_rating_percentage_value)); ?>%
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Details area end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/rating.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $("#review").rating({
                    "value": 3,
                    "click": function (e) {
                        $("#rating").val(e.stars);
                    }
                });
                $('.popup-gallery').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%"><?php echo e(__("The image")); ?> #%curr%</a> <?php echo e(__("could not be loaded.")); ?>',
                        titleSrc: function(item) {
                            return item.el.attr('title');
                        }
                    }
                });

                $(document).on('submit','.service_review_form',function(e){
                    e.preventDefault();
                    let service_id = $('#service_id').val();
                    let seller_id = $('#seller_id').val();
                    let rating = $('#rating').val();
                    let name = $('#name').val();
                    let email = $('#email').val();
                    let message = $('#message').val();

                    $.ajax({
                        url:"<?php echo e(route('service.review.add')); ?>",
                        method:"post",
                        data:{
                            service_id:service_id,
                            seller_id:seller_id,
                            rating:rating,
                            name:name,
                            email:email,
                            message:message,
                        },
                        success:function(res){
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
                                toastr.success(res.message);
                            }else if(res.status == 'danger'){
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
                                toastr.warning(res.message);
                            }
                            $('.service_review_form')[0].reset();
                        }
                    });
                })

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/services/service-details.blade.php ENDPATH**/ ?>