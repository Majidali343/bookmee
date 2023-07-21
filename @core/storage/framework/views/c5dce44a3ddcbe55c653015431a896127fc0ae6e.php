
<?php
$footer_variant = !is_null(get_footer_style()) ? get_footer_style() : '02';
?>
<?php echo $__env->make('frontend.partials.pages-portion.footers.footer-'.$footer_variant, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(preg_match('/(bytesed)/',url('/'))): ?>
   <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank"href="https://bytesed.com/docs-category/quixer-on-demand-service-marketplace-and-service-finder/" data-container="body" data-toggle="popover" data-placement="left" data-content="<?php echo e(__('Documentation')); ?>"><i class="lar la-file-alt"></i></a></li>
            <li><a target="_blank"href="https://codecanyon.net/item/Bookmi-multivendor-on-demand-service-marketplace-and-service-finder/36475708"><i class="las la-shopping-cart"></i></a></li>
            <li><a target="_blank"href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
        </ul>
    </div>
<?php endif; ?>

<!-- back to top area start -->
<div class="back-to-top <?php echo e($page_post->back_to_top ?? ''); ?>">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->


<?php if(moduleExists("LiveChat")): ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.livechat.widget-markup','data' => []]); ?>
<?php $component->withName('livechat.widget-markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php endif; ?>


<script src="<?php echo e(asset('assets/frontend/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.nice-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
    }
});
</script>

<?php echo $__env->make('frontend.pages.services.partials.service-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.home-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.inline-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(moduleExists("JobPost")): ?>
    <?php echo $__env->make('jobpost::frontend.jobs.job-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(!empty( get_static_option('tawk_api_key'))): ?>
 <?php echo get_static_option('tawk_api_key'); ?>

 <?php endif; ?>

<?php if(!empty(get_static_option('site_google_captcha_v3_site_key'))  ): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        (function() {
            "use strict";
            grecaptcha.ready(function () {
                grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                    if(document.getElementById('gcaptcha_token') != null){
                        document.getElementById('gcaptcha_token').value = token;
                    }
                });
            });

        })(jQuery);
    </script>
<?php endif; ?>

<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>



<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
<?php if(request()->routeIs('frontend.order.payment.success')): ?>
<script>
    var myCalendar = createCalendar({
        options: {
            class: 'my-class',
            // You can pass an ID. If you don't, one will be generated for you
            id: 'my-id'
        },
        data: {
            // Event title
            title: "<?php echo e(optional($order_details->service)->title); ?>",

            // Event start date
            start: new Date('<?php echo e(Carbon\Carbon::parse(strtotime($order_details->date))->format('F d, Y H:i')); ?>'),

            // Event duration (IN MINUTES)
            Minutes: 120,

            // You can also choose to set an end time
            // If an end time is set, this will take precedence over duration
            end: new Date('<?php echo e(Carbon\Carbon::parse(strtotime($order_details->date))->format('F d, Y H:i')); ?>'),

            // Event Address
            address: "<?php echo e(optional($order_details->buyer)->address); ?>",

            // Event Description
            description: 'Order Sucessfully Created'
        }
    });

    document.querySelector('.new-cal').appendChild(myCalendar);
</script>
<?php endif; ?>

<?php if(moduleExists("LiveChat")): ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.livechat.widget-js','data' => []]); ?>
<?php $component->withName('livechat.widget-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php endif; ?>

<?php if(moduleExists("Subscription")): ?>
   <?php echo $__env->make('frontend.partials.subscription-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>.js"></script>
<script>
    /*-----------------
     Select2
    ------------------*/
    $('select').select2({
         language: "<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>"
    });
</script>


<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Bookmee\@core\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>