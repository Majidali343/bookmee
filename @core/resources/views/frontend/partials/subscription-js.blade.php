@php
    if(!moduleExists('Subscription')){
        return;
    }
@endphp
<x-payment-gateway-js/>
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

            @if(Route::has('seller.subscription.coupon.apply'))
            //coupon apply
            $(document).on('click','.coupon_apply_btn',function(e){
                e.preventDefault();
                let subscription_price = $('#subscription_price').val();
                let apply_coupon_code = $('#apply_coupon_code').val();

                $.ajax({
                    url: "{{ route('seller.subscription.coupon.apply') }}",
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
            @endif

        });
    })(jQuery);
</script>

