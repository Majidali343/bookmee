<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->
<script src="<?php echo e(asset('assets/frontend/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.nice-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>


<?php echo $__env->yieldContent('scripts'); ?>
<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>.js"></script>
<script>
    /*-----------------
     Select2
    ------------------*/
    $('select').not(".simple_select").select2({
         language: "<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>"
    });
</script>

</body>

</html>


<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/user/seller/partials/footer.blade.php ENDPATH**/ ?>