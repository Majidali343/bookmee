

<?php $__env->startSection('page-meta-data'); ?>
    <title> <?php echo e($seller->name); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .profile-flex-content {
            flex-wrap: nowrap !important;
        }

        .seller-social-links {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .seller-social-links a {
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 25px;
            width: 25px;
            background-color: #fff;
            color: var(--main-color-one);
            border-radius: 50%;
            transition: all .3s;
        }

        .seller-social-links a:hover {
            background-color: var(--main-color-one);
            color: #fff;
        }

        .seller-verified {
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            background-color: var(--main-color-one);
            color: #fff;
            border-radius: 50%;
        }

        .profile-flex-content .profile-contents .title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .info-box {
            background: #FAFAFA;
            border-radius: 10px;
            padding: 20px
        }

        .heading {
            color: var(--main-color-one);
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 13px;
            line-height: 46px;
            display: flex;
            align-items: center;
        }

        .heading-small {
            color: var(--main-color-one);
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 13px;
            line-height: 24px;
        }

        .info-box .center {
            display: flex;
            align-items: center;
            font-size: 13px;
        }
       

        .bold-text {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            font-size: 13px;
            line-height: 24px;
            display: flex;
            align-items: center;
            color: #333333;
            justify-content: center;

        }

        .space {
            margin-bottom: 30px;
        }

        .info-box .divider {
            border: 1px solid #CCCCCC;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .info-box .profile-pic>img {
            border-radius: 142px;
            object-fit: cover;
        }

        .info-box .staff-item>div {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .info-box .phone-action {
            background: #FFFFFF;
            border: 1px solid #233857;
            color: var(--main-color-one);
            border-radius: 5px;
            width: 69px;
            height: 34px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobilework {
            display: block;
        }


        .info-box .card-info {
            border-radius: 10px;
            height: 95px;

        }

        .bussiness-details .image>img {
            border-radius: 142px;
            object-fit: cover;
        }

        .text-recom {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 18px;
            display: flex;
            align-items: center;
            text-align: center;
            color: #FFFFFF;
        }

        .recommended-container {
            background: var(--main-color-one);
            width: 202.2px;
            height: 32px;
            opacity: 0.8;
            border-radius: 5px;
            align-items: center;
            justify-content: space-evenly;
            padding: 5px;
            margin-left: 20px;
        }

        .review-card {
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
            min-height: 200px;
            margin-bottom: 20px;
        }

        .review-star {
            color:#FFB700;
            border-radius: 1px;
            font-size: 32px;
        }

        .review-card .name {
            font-family: 'inter', sans-serif;
            font-style: italic;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            display: flex;
            align-items: center;
            color: #767676;
        }

        .review-card .icon-bg-circle {
            width: 20px;
            height: 20px;
            background: var(--main-color-two);
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ifmobilework {
            display: none;
        }

        .discount {
            position: relative;
            left: 32px;
            top: 120px;
            z-index: 100;
            padding-left: 10px;
            padding-top: 7px;
            Width: 119px;
            Height: 36px;
            border-Radius: 60px;
            Gap: 10px;
            background-color: #03989E4D;
            Font-family: "Inter";
            font-Weight: 600;
            Size: 14px;
            color: #03989E;

        }
        .discountedprice {
                position: relative;
                left: -6px;
                top: -1px;
                z-index: 100;
                color: #C3D0CF;
                Font-family: "Inter";
                font-Weight: 600;
                font-size: 14px;
                
            }
        .time {
                position: relative;
                left: 447px;
                top: 84px;
                z-index: 100;
                Font-family: "Inter";
                font-Weight: 500;
                font-size: 14px;
            }


        @media  only screen and (max-width: 1000px) {
            .sidebar-section {
                width: 100% !important;
            }

            .main-section {
                width: 100% !important;
            }

            .single-services-item {
                width: 100%;
            }
        }

        .single-prices {
            min-width: 86px;

            border-radius: 38px;
            color: white;
            background: var(--main-color-two);

            top: 365px;
            left: 1014px;
            padding: 7.5px 17.009995px 9.5px 28px;
            border-radius: 38px;

        }

        @media  only screen and (max-width: 600px) {
            .sidebar-section {
                width: 100% !important;
            }

            .main-section {
                width: 100% !important;
            }

            .single-services-item {
                width: 100%;
            }

            .mobilework {
                display: none;
            }

            .ifmobilework {
                display: block;
            }

            .margin {
                margin: 20px 20px;
            }

            .marginleft {
                margin-left: 40px;
            }

            .marginboth {
                margin-left: 50px;
                margin-right: 50px;
                text-align: justify;
            }

            .service-details-slider {
                width: 405px !important;
                height: 310px !important;
            }

            .service-details-background-image {
                height: 315px;
            }

            .single-prices {
                min-width: 58px;
                padding: 10px;
                border-radius: 34px;
                background: var(--main-color-two);
            }

            .single-service .services-contents .service-price .prices {
                font-size: 16px;
                font-weight: 700;
                width: 100px;
                line-height: 55px;
                color: #233857;
            }

            .discount {
                position: relative;
                left: 14px;
                top: 127px;
                z-index: 100;
                padding-left: 10px;
                padding-top: 7px;
                Width: 118px;
                Height: 36px;
                border-Radius: 60px;
                Gap: 10px;
                background-color: #03989E4D;
                Font-family: "Inter";
                font-Weight: 600;
                font-size: 14px;
                color: #03989E;
            }

            .discountedprice {
                position: relative;
                left: 94px;
                top: -29px;
                z-index: 100;
             
                Width: 84px;

                Font-family: "Inter";
                font-Weight: 600;
                font-size: 14px;
             
            }
            
                .time {
                    left: 176px;
               top: 85px;
                width: 75px;
            }
            

        }




        @media  only screen and (max-width: 750px) {


            .single-services {
                width: 70%;
            }

            
        }
        @media (min-width: 481px) and (max-width: 1024px) {
            .time {
                left: 308px;
                top: 86px;
            }
    }

    @media  only screen and (min-width: 1400px) {

        .time{
            left: 485px;
                top: 86px;
        }
    }

        @media  only screen and (min-width: 1200px) {
            .center-mobile {
                justify-content: center !important;
            }

            .single-services-item {
                width: 100%;
            }

            .margin {
                margin: 20px 20px;
            }

            .marginleft {
                margin-left: 40px;
            }

            .marginboth {
                margin-left: 50px;
                margin-right: 50px;
                text-align: justify;
            }
           


        }


        .service-cotent-changes {
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        @media  only screen and (max-width: 1490px) {
            .single-services-item {
                width: 100% !important;
            }
        }

        .price-container {
            display: flex;
            flex-direction: column;
            align-content: flex-start;
            flex-wrap: wrap;

        }

        .service-thumb {
            height: 236px;
        }

        .search-input::placeholder {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 20px;
            display: flex;
            align-items: center;
            color: #999999;

        }

        .gallery-images {
            background-size: cover;
            object-fit: contain;
            background-repeat: no-repeat;
        }

        .service-details-slider .slick-dots li.slick-active {
            background-color: var(--main-color-two);
        }

        .slick-arrow {
            background: white !important;
            border-radius: 100% !important;
            height: 40px !important;
            width: 40px !important;
        }

        .slick-arrow i {
            color: var(--main-color-two)
        }

        .services-area {
            background: transparent;
        }

        .groupName .name {
            color: #999;
            font-family: Poppins;
            font-size: 22px;
            font-style: normal;
            font-weight: 500;
            line-height: 28px;
            min-width: fit-content;
            margin-right: 36px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .border {
            border: solid 2px #DEE2E6;

        }

        .title-main {
            font-family: 'Poppins';
            font-size: 28px;
            font-weight: 700;
            line-height: 46px;
            letter-spacing: 0em;
            text-align: left;

        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="content align-items-center">


        <div class="d-flex flex-wrap">

            <div class="main-section m-1" style="width:74%">
                <!-- Banner Inner area Starts -->

                
                <?php if(!empty($seller)): ?>

                    <div class="service-details-slider container mobilework">
                        <?php if($seller->profile_gallery != null): ?>
                            <?php $__empty_1 = true; $__currentLoopData = explode("|", $seller->profile_gallery); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="single-slider">
                                    <div class="gallery-images single-featured service-details-background-image"
                                        style="background-image: url(<?php echo e(get_attachment_image_by_id($id)['img_url']); ?>); ">
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div></div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>

                    <div class="ifmobilework">
                        <?php if($seller->profile_gallery != null): ?>
                            <div class=" service-details-slider container">
                                <?php $__empty_1 = true; $__currentLoopData = explode("|", $seller->profile_gallery); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="single-slider">
                                        <div class="gallery-images single-featured service-details-background-image"
                                            style="background-image: url(<?php echo e(get_attachment_image_by_id($id)['img_url']); ?>);">
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>




                <?php endif; ?>
                <!-- Banner Inner area end -->

                <!-- Featured Service area starts -->
                <?php if(!empty($services)): ?>
                    <section class="services-area " style="padding-top: 50px;padding-bottom:50px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="d-flex justify-content-between flex-wrap ">
                                        <h3 class=" title-main" style=" color:#333333;">
                                            <?php echo e(__('Services of this Seller')); ?> </h3>
                                        <div class="search d-flex flex-row align-items-center justify-content-between"
                                            style="padding-left:26px;height: 52px;border:solid 1px #E0E0E0; min-width:340px;max-width:430px;border-radius: 10px;">
                                            <div class="d-flex">
                                                <div class="icon"><img src="https://i.imgur.com/fgPbs95.png"
                                                        width="20px" height="20px"></div>
                                                <div class="input"><input type="text" class="search-input"
                                                        id="search-input"placeholder="Search Services"
                                                        style="margin-left:14px;border: none;height: 100%;"></div>
                                            </div>
                                            <div id="search-button"
                                                class="button d-flex justify-content-center align-items-center"
                                                style="cursor: pointer;height:100%;background:var(--main-color-two);width:80px;border-radius: 0px 10px 10px 0px;">
                                                <div class="icon"><img src="https://i.imgur.com/ubNkkR7.png"
                                                        width="20px" height="20px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="row margin-top-50">
                                <div class="col-lg-12">

                                    <?php
                                        $discountsArray = $discounts->toArray();
                                        $Timearray=$Time->toArray();
                                    ?>
                                 
                                    <div class="">
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="groupName  d-flex align-items-center">
                                                <div class="name">
                                                    <?php if(!$group['group'] == null): ?>
                                                        <?php echo e($group['group']); ?>

                                                    <?php else: ?>
                                                        Other Services
                                                    <?php endif; ?>
                                                </div>
                                                <span class="border w-100"></span>
                                            </div>

                                            <div class="services">
                                                <?php
                                                    $services = $group['services'];
                                                    $group = count($services);
                                                ?>

                                             
                                                <?php for($i = 0; $i < $group ; $i++): ?>
                                                    <div class="single-services-item ">
                                                        <?php if(!empty($discountsArray[$idx])): ?>
                                                        <div class="discount">Save upto <?php echo e($discountsArray[$idx]); ?> % </div>
                                                        <?php endif; ?>
                                                        <div style="margin:15px 0px" class="single-service">
                                                            <div class="services-contents service-cotent-changes">
                                                                <h5 class="common-title">
                                                                    <a class="service-title"

                                                                        style="color: black;font-weight:700;line-height:113px;"
                                                                        href="<?php echo e(route('service.list.details', $services[$i]->slug)); ?>"><?php echo e($services[$i]->title); ?>


                                                                    </a>

                                                                </h5>
                                                                <?php if(!empty($Timearray[$idx])): ?>
                                                                <div class="time"> <?php echo e($Timearray[$idx]); ?> mins</div>
                                                                <?php endif; ?>

                                                               <?php
                                                                
                                                                
                                                                 $Percentage = ($services[$i]->price * $discountsArray[$idx]) / 100;
                                                                
                                                                 $percentage_Amount = $services[$i]->price + $Percentage;

                                                              ?>


                                                                <div class="service-price ">
                                                                    <?php if(!empty($discountsArray[$idx])): ?>
                                                                        <div class="discountedprice"> <?php echo e(amount_with_currency_symbol($percentage_Amount)); ?></div>
                                                                        <?php endif; ?>
                                                                    <div class="price-container">
                                                                        
                                                                        <span
                                                                            class="prices"><?php echo e(amount_with_currency_symbol($services[$i]->price)); ?>

                                                                        </span>
                                                                        
                                                                    </div>

                                                                    <div class="btn-wrapper single-prices">
                                                                        <a href="<?php echo e(route('service.list.book', $services[$i]->slug)); ?>"
                                                                            class=" "><?php echo e(__('Book')); ?>

                                                                        </a>
                                                                    </div>
                                                                   
                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </section>
                <?php endif; ?>
                <!-- Featured Service area ends -->

                <!-- Review seller area Starts -->
                <?php if($service_reviews->count() >= 1): ?>
                    <div class="review-seller-area padding-bottom-100">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="heading" style="font-size:32px; color:#333333; margin-bottom:40px; ">
                                        <?php echo e(get_static_option('service_reviews_title') ?? __('Reviews    ')); ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="review-seller-wrapper">
                                        <div class="about-review-tab">
                                            <?php $__currentLoopData = $service_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="review-card">
                                                    <div class="d-flex w-100 justify-content-between flex-wrap mb-2">
                                                        <div class="stars">
                                                            <?php for($i = 0; $i < $review->rating; $i++): ?>
                                                                <span class="icon review-star"> <i class="las la-star"></i>
                                                                </span>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <div class="date  bold-text" style="color:var(--main-color-two);">
                                                            <?php echo e($review->updated_at->toFormattedDateString()); ?>

                                                            <span class="icon ml-2 icon-bg-circle">
                                                                <i class="las la-check" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="service bold-text">
                                                        HairCut
                                                    </div>
                                                    <div class="name">
                                                        By <?php echo e($review->name); ?>

                                                    </div>
                                                    <div class="space"></div>
                                                    <div class="review  bold-text" style="font-weight:400px;">
                                                        <?php echo e($review->message); ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        <?php echo $service_reviews->links(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Review seller area ends -->
            </div>


            <div class="sidebar-section m-1" style="width: 24%;">
                <div class="profile-sidebar">

                    <div style="height:160px ;width:100% ;">

                        <div class="bussiness-details mt-3 d-flex w-100 justify-content-center p-3 container">
                            <div class="row d-flex align-items-center justify-content-between w-100 center-mobile">
                                <div class="d-flex flex-wrap align-items-center w-100 justify-content-start center-mobile"
                                    style="max-width: 600px;">
                                    <div class="image" style="min-width: 100px!important;margin-right:30px">
                                        <img src="<?php echo e(get_attachment_image_by_id($seller->image)['img_url']); ?>"
                                            width="80px"height="80px"alt="">
                                    </div>
                                    <div class="details align-self-center" style="max-width: 450px;">
                                        <div class="heading flex-wrap justify-content-start  center-mobile"
                                            style="font-size:24px;">
                                            <?php echo e($seller->name); ?>

                                            
                                        </div>
                                        
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="space"></div>
                        <div class="location-container d-flex">
                            <div class="heading-small m-2 center">
                                Location:
                            </div>
                            <div class="location m-2 center bold-text">
                                <?php echo e($seller->address ?? ''); ?>

                                <img src="https://i.imgur.com/l4PuDMC.png" width="15px" height="20px"
                                    style="margin-left:2px">
                            </div>
                        </div>
                        <div class="since d-flex">
                            <div class="heading-small m-2 center">
                                Since:
                            </div>
                            <div class="year center m-2 bold-text">
                                <?php echo e($seller->created_at->year ?? ''); ?>

                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="divider"></div>
                        <?php if($seller->staff->count() > 0): ?>
                            <div class="staffers-container margin">
                                <div class="heading">
                                    Staffers
                                </div>
                                <div class="divider"></div>
                                <div class="staff row center" style="min-height: 130px;">
                                    <?php $__currentLoopData = $seller->staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="staff-item mr-2 ml-2">
                                            <div class="profile-pic">
                                                <img src="<?php echo e(get_attachment_image_by_id($staff->profile_image_id)['img_url']); ?>"
                                                    width="60px" height="60px">
                                            </div>
                                            <div class="name bold-text">
                                                <?php echo e($staff->name); ?>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="contact-bussiness-hours margin">
                            <div class="heading">
                                Contacts & Business Hours
                            </div>
                            <div class="divider"></div>
                            <div class="phone ">
                                <div class="mt-3 ml-2 mb-3 d-flex justify-content-between">
                                    <div class="row bold-text">
                                        <img width="24px"
                                            height="24px"src="https://i.imgur.com/qmx26uC_d.webp?maxwidth=760&fidelity=grand"
                                            class="mr-3">
                                        <?php echo e($formattedPhoneNumber ?? ''); ?>

                                    </div>
                                    <div class="">
                                        <a class="phone-action" href="tel:<?php echo e($formattedPhoneNumber ?? ''); ?>">
                                            Call
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="space"></div>

                            <div class="hours-all">
                                <?php if(!empty($businesstimings)): ?>
                                    <?php $__currentLoopData = $businesstimings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $businessTimings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="hour d-flex justify-content-between mt-2 mb-2">
                                            <div style="display: flex;flex-direction:row;">
                                                <p class='heading-small' style="color: #233857;width: 137px;">
                                                    <?php echo e($businessTimings->day); ?>

                                                    &nbsp;
                                                </p>
                                                <p class='heading-small' style="color: #233857;">
                                                    <?php echo e($businessTimings->to_time . ' To ' . $businessTimings->from_time); ?>

                                                </p>

                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h5 style="color: rgb(255, 217, 0);">Business Hours Not added</h5>
                                <?php endif; ?>



                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="card-info row margin"style="background: var(--main-color-one);">
                            <div style="font-size:32px" class="icon col-4 center">
                                <i style="color:#FFB700;width:40px;height:37px;background:white;padding-left: 4px;
                                border-radius: 19px;" class="las la-star" ></i>
                                
                            </div>
                            <div class="d-flex flex-column" style="align-items: flex-start;justify-content: center;">
                                <div class="heading bold-text"style="color: #FFFFFF;">Seller Rating</div>
                                <div class="review-percent bold-text"style="color: #FFFFFF;">
                                    <?php echo e($seller_rating_percentage_value); ?></div>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="card-info row margin"style="background: #03989E">
                            <div class="icon col-4 center">
                                <img src="https://i.imgur.com/atNXEkw.png" width="40px" height="40px"alt="">
                            </div>
                            <div class="d-flex flex-column" style="align-items: flex-start;justify-content: center;">
                                <div class="heading bold-text"style="color: #FFFFFF;">Services Completed</div>
                                <div class="review-percent bold-text"style="color: #FFFFFF;"><?php echo e(count($seller->order)); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        $(document).ready(function() {
            $("#search-button").on("click", function() {
                var value = document.getElementById('search-input').value.toLowerCase().trim();
                $(".single-services-item").show().filter(function() {
                    return $(this).find('.service-title').text().toLowerCase().trim().indexOf(
                        value) == -1;
                }).hide();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/seller/profile.blade.php ENDPATH**/ ?>