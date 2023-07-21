<html>
<head>
    <title>{{__('Cashfree Payment Gateway')}}</title>
</head>
<body>
<form class="redirectForm" method="post" action="{{$payment_data['action']}}">
    <input type="hidden" name="appId" value="{{$payment_data['app_id']}}"/>
    <input type="hidden" name="orderId" value="{{$payment_data['order_id']}}"/>
    <input type="hidden" name="orderAmount" value="{{$payment_data['amount']}}"/>
    <input type="hidden" name="orderCurrency" value="{{$payment_data['currency']}}"/>
    <input type="hidden" name="orderNote" value="{{$payment_data['order_id']}}"/>
    <input type="hidden" name="customerName" value="{{$payment_data['name']}}"/>
    <input type="hidden" name="customerEmail" value="{{$payment_data['email']}}"/>
    <input type="hidden" name="customerPhone" value="{{$payment_data['phone']}}"/>
    <input type="hidden" name="returnUrl" value="{{$payment_data['return_url']}}"/>
    <input type="hidden" name="notifyUrl" value="{{$payment_data['notify_url']}}"/>
    <input type="hidden" name="signature" value="{{$payment_data['signature']}}"/>

    <button type="submit" id="paymentbutton" class="btn btn-block btn-lg bg-ore continue-payment">Continue to Payment</button>

</form>
<script>
    (function(){
        "use strict";
        
        var submitBtn = document.querySelector('#paymentbutton');
        submitBtn.innerHTML = "{{__('Redirecting Please Wait...')}}";
        submitBtn.style.color = "#fff";
        submitBtn.style.backgroundColor = "#c54949";
        submitBtn.style.border = "none";
        document.addEventListener('DOMContentLoaded',function (){
            submitBtn.dispatchEvent(new MouseEvent('click'));
        },false);
    })();
</script>
</body>
</html>
