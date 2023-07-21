<html>
<head>
    <title>{{__('Razorpay')}}</title>
</head>
<body>
<div class="stripe-payment-wrapper">
    <div class="srtipe-payment-inner-wrapper">
        <form action="{{$razorpay_data['route']}}" method="POST" >
            <!-- Note that the amount is in paise = 50 INR -->
            <input type="hidden" name="order_id" value="{{$razorpay_data['order_id']}}" />

        <!--amount need to be in paisa-->
            <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ $razorpay_data['api_key']}}"
                    data-currency="{{$razorpay_data['currency']}}"
                    data-amount="{{ceil($razorpay_data['price'] * 100)}}"
                    data-buttontext="{{'Pay '.$razorpay_data['price'].' INR'}}"
                    data-name="{{$razorpay_data['title']}}"
                    data-description="{{$razorpay_data['description']}}"
                    data-image=""
                    data-prefill.name=""
                    data-prefill.email=""
                    data-theme.color="#000">
            </script>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
</div>

<script>
    (function(){
    "use strict";
        var submitBtn = document.querySelector('input[type="submit"]');
        document.addEventListener('DOMContentLoaded',function (){
            submitBtn.dispatchEvent(new MouseEvent('click'));
        },false);

        submitBtn.addEventListener('click', function () {
            // Create a new Checkout Session using the server-side endpoint you
            submitBtn.value = "{{__('Do Not Close This page..')}}"
            // submitBtn.disabled = true;
            submitBtn.style.color = "#fff";
            submitBtn.style.backgroundColor = "#c54949";
            submitBtn.style.border = "none";
        });

    })();
</script>
</body>
</html>
