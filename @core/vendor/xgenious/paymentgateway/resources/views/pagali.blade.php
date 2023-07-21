<html>
<head>
    <title> {{__('Pagali Payment Gateway')}}</title>
</head>
<body>
<form id="pagali_form" name="pagali_form" method="post" action="https://www.pagali.cv/pagali/index.php?r=pgPaymentInterface/ecommercePayment">
    <input type="hidden" name="item_name[]" value="{{$pagali_data['title']}}" />
    <input type="hidden" name="quantity[]" value="1" />
    <input type="hidden" name="item_number[]" value="1" />
    <input type="hidden" name="amount[]" value="{{$pagali_data['charge_amount']}}" >
    <input type="hidden" name="total_item[]" value="1" />
    <input type="hidden" name="order_id" value="{{$pagali_data['order_id']}}" >
    <input type="hidden" name="id_ent" value="{{$pagali_data['entity_id']}}">
    <input type="hidden" name="currency_code" value="1" />
    <input type="hidden" name="total" value="{{$pagali_data['charge_amount']}}" />
    <input type="hidden" name="notify" value="{{$pagali_data['ipn_url']}}" />
    <input type="hidden" name="id_temp" value="{{$pagali_data['page_id']}}" />
    <input type="hidden" name="return" value="{{$pagali_data['success_url']}}" />
    <button type="submit" id="payment_submit_btn" form="pagali_form" value="Submit">{{__('Submit')}}</button>
    <form>

        <script>
            (function($){
                "use strict";
                // Create a Stripe client
                var submitBtn = document.getElementById('payment_submit_btn');

                document.addEventListener('DOMContentLoaded',function (){
                    submitBtn.dispatchEvent(new MouseEvent('click'));
                },false);

                submitBtn.addEventListener('click', function () {
                    // Create a new Checkout Session using the server-side endpoint you
                    submitBtn.innerText = "{{__('Do Not Close This page..')}}"
                    // submitBtn.disabled = true;
                    submitBtn.style.color = "#fff";
                    submitBtn.style.backgroundColor = "#c54949";
                    submitBtn.style.border = "none";
                });



            })();
        </script>
</body>
</html>
