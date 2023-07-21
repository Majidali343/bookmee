<script>
    (function ($){

        $(document).ready(function (){

            //todo: if the wallet checkbox is checked need to show this value as current seleted payment gateway
            $(document).on('click', '.wallet_selected_payment_gateway',function(){
                let wallet_value = $(this).val();
                $('.payment-gateway-wrapper li').removeClass('active');
                $('.payment-gateway-wrapper li').removeClass('selected');
                $('.wallet-payment-gateway-wrapper .wallet_selected_payment_gateway').addClass('selected');
                $('.payment-gateway-wrapper #order_from_user_wallet').val('wallet');
            });

            $(document).on('click', '.current_balance_selected_gateway',function(){
                $('.payment-gateway-wrapper li').removeClass('active');
                $('.payment-gateway-wrapper li').removeClass('selected');
                $('.current-balance-wrapper .current_balance_selected_gateway').addClass('selected');
                $('.payment-gateway-wrapper #order_from_user_wallet').val('current_balance');
            });

            //select payment gateway
            $(document).on('click', '.payment_getway_image ul li',function(){
                //wallet start
                $('.wallet_selected_payment_gateway').removeClass('selected')
                $( ".wallet_selected_payment_gateway" ).prop( "checked", false );
                //wallet end

                //current balance start
                $('.current_balance_selected_gateway').addClass('selected');
                $( ".current_balance_selected_gateway" ).prop( "checked", false );

                //current balance end

                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                let payment_gateway_name = $(this).data('gateway');
                $('#msform input[name=selected_payment_gateway]').val();

                $('.payment_gateway_extra_field_information_wrap > div').hide();
                $('.payment_gateway_extra_field_information_wrap div.'+payment_gateway_name+'_gateway_extra_field').show();

                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val(payment_gateway_name);
            });

            $('.payment_getway_image ul li.selected.active').trigger('click');
        });

    })(jQuery);

</script>