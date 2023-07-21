<?php
use Illuminate\Support\Str;
use App\Review;
?>



<?php $__env->startSection('site-title'); ?>
    <?php if($category != ''): ?>
        <?php echo e($category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php if($category != ''): ?>
        <?php echo e($category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_site_title($category->name); ?>

    <meta name="title" content="<?php echo e($category->name); ?>">

    <?php echo render_page_meta_data_for_category($category); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('inner-title'); ?>
    <?php if($category != ''): ?>
        <?php echo e($category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<style>
    .service-thumb {
        background-size: cover;
        background-position: center !important;
    }

    .slick-slide,
    .single-service {
        min-height: 450px;
    }

    .single-service {
        display: flex;
        overflow: hidden;
        flex-direction: column;
        justify-content: flex-start;
        /* max-width: 330px;
        min-width: 330px; */

    }

    .services-contents {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* min-height: 370px;
        max-height: 380px; */
    }
    .sectionfontsize{
        font-size: 30px;
    line-height: 40px;
    font-weight: 600;
    }
    .discount{
    position: relative;
    left: 200px;
    top: 63px;
    z-index: 100;
    padding-left: 10px;
    padding-top: 7px;
    Width : 119px;
    Height : 36px;
    border-Radius :60px;
    Gap :10px;
    background-color: #03989E4D;
    Font-family :"Inter";
    font-Weight : 600;
    Size : 14px;
    color: #03989E;
}

</style>


<?php $__env->startSection('content'); ?>

    <section class="services-area" style="padding-top:60px;padding-bottom:60px;background-color:white">
        <div class="container">
            <div class="">
                <div class="">
                    <div class="section-title" style="text-align: left;">
                        <h2 class="sectionfontsize"><?php echo e(sprintf(__('Available Businesses in %s'), $category->name)); ?></h2>

                    </div>
                </div>
            </div>

            
             

        
            
        </div>


        <div class="row margin-top-50">
                
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-center">
                    <?php if($Vendors->count() > 0): ?>
                        <?php for(  $i=0 ; $i< $Vendors->count();  $i++): ?>

                            <div class="single-services-item wow fadeInUp" data-wow-delay=".2s" style="width: 390px;">
                                <div class="single-service">
                                        
                                            <?php if(!@empty($discounts[$i])): ?>
                                        
                                            <div class="discount" >save upto <?php echo e($discounts[$i]); ?>%</div>
                                            <?php else: ?>
                                            <div style=" margin-top: 38px" ></div>
                                            <?php endif; ?>

                                        
                                   
                                    
                                    <a href="/<?php echo e($Vendors[$i]->username); ?>"
                                        class="service-thumb location_relative service-bg-thumb-format"
                                        style="background-image: url(<?php echo e(get_attachment_image_by_id($Vendors[$i]->image)['img_url']); ?>);"></a>
                                    <div class="services-contents">
                                        <div>
                                            <ul class="author-tag">
                                                <li class="tag-list w-100">
                                                    <a href="/<?php echo e($Vendors[$i]->username); ?>" class="w-100">
                                                        <div
                                                            class="authors d-flex flex-wrap justify-content-between w-100">
                                                            <span class="author-title" style="font-size: 24px;">
                                                                <?php echo e(Str::limit($Vendors[$i]->name, 13, '...')); ?> </span>
                                                            <span
                                                                class="icon review-star"style="font-size: 24px; color:var(--main-color-two)">
                                                                
                                                                <span style="font-size: 18px;">  
                                                                    <?php if(Review:: where('seller_id', $Vendors[$i]->id)
                                                                    ->count('service_id') > 0): ?>

                                                                    (<?php echo e(Review:: where('seller_id', $Vendors[$i]->id)
                                                                    ->count('service_id')  ); ?> )

                                                                    <?php endif; ?>
                                                                </span>

                                                                <?php echo e($Reviews[$i]); ?>

                                                                <i class="las la-star"></i>
                                                            </span>

                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="tag-list">
                                                </li>
                                            </ul>
                                            <div>
                                                <div>
                                                    <span
                                                        class="icon review-star"style="font-size: 16px; color:var(--main-color-two)">
                                                        <?php echo e(Str::limit($Vendors[$i]->address, 20, '...')); ?>

                                                       
                                                        <i class="las la-map-marker"></i>
                                                    </span>
                                                </div>
                                                
                                                <p class="common-para" style="padding-bottom:10px;"></p>
                                            </div>

                                        </div>
                                        <div class="btn-wrapper">

                                            <a href="/<?php echo e($Vendors[$i]->username); ?>"

                                            <a href="/<?php echo e($Vendors[$i]->username); ?>"

                                                class="cmn-btn btn-appoinment btn-bg-1">View</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        <?php endfor; ?>

                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h2 class="text-warning"><?php echo e(__('Nothing Found...')); ?></h2>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>


    

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function($) {
            "use strict";

            $(document).on('click', '#load_more_btn', function(e) {
                e.preventDefault();

                let totalNo = $(this).data('total');
                let el = $(this);
                let container = $('#services_sub_category_load_wrap > .row');

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('service.list.load.more.subcategories')); ?>",
                    beforeSend: function(e) {
                        el.text("<?php echo e(__('loading...')); ?>")
                    },
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        total: totalNo,
                        catId: "<?php echo e($category->id); ?>"
                    },
                    success: function(data) {

                        el.text("<?php echo e(__('Load More')); ?>");
                        if (data.markup === '') {
                            el.hide();
                            container.append(
                                "<div class='col-lg-12'><div class='text-center text-warning mt-3'><?php echo e(__('no more subcategory found')); ?></div></div>"
                            );
                            return;
                        }

                        $('#load_more_btn').data('total', data.total);

                        container.append(data.markup);
                    }
                });

            });


        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/pages/services/category-services.blade.php ENDPATH**/ ?>