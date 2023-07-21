<?php
    if(!moduleExists('Subscription')){
        return;
    }
?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.payment-gateway-js','data' => []]); ?>
<?php $component->withName('payment-gateway-js'); ?>
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
    (function($){
        "use strict";

        $(document).ready(function(){

            // get subscription id
            $(document).on('click', '.get_subscription_id',function(){
                let get_subscription_id = $(this).data('id');
                let type = $(this).data('type');
                let price = $(this).data('price');
                let connect = $(this).data('connect');

                $('.subscription_id').val(get_subscription_id)
                $('.type').val(type)
                $('.price').val(price)
                $('.connect').val(connect)
                $('#subscription_price').val(price)
            });

            <?php if(Route::has('seller.subscription.coupon.apply')): ?>
            //coupon apply
            $(document).on('click','.coupon_apply_btn',function(e){
                e.preventDefault();
                let subscription_price = $('#subscription_price').val();
                let apply_coupon_code = $('#apply_coupon_code').val();

                $.ajax({
                    url: "<?php echo e(route('seller.subscription.coupon.apply')); ?>",
                    method:"POST",
                    data:{subscription_price:subscription_price,apply_coupon_code:apply_coupon_code},
                    success:function(res){
                        if(res.message != ''){
                            $('.display_error_msg').html('<p class="text-danger">'+res.message+'</p>');
                            $('.display_coupon_amount').html('');
                        }
                        if(res.discount >= 1){
                            $('.display_coupon_amount').html('<p class="text-success">Discounted Amount: ' +res.discount+'</p>');
                            $('.display_error_msg').html('');
                        }
                    }
                });
            });
            <?php endif; ?>

        });
    })(jQuery);
</script>

<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/frontend/partials/subscription-js.blade.php ENDPATH**/ ?>