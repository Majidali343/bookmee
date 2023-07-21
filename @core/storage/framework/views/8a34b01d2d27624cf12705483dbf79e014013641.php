<?php
    $footer_variant = !is_null(get_navbar_style()) ? get_navbar_style() : '02';
?>
<?php echo $__env->make('frontend.partials.pages-portion.navbars.navbar-'. $footer_variant, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Bookmee\@core\resources\views/frontend/partials/navbar.blade.php ENDPATH**/ ?>