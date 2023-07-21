<html>
<head>
    <title>{{__('Zitopay Payment Gateway')}}</title>
</head>
<body>
{{--@dd($args)--}}
<form class="redirectForm" method="post" action="https://zitopay.africa/sci">
    <input type='hidden' name='amount' value='{{$args['amount']}}' />
    <input type='hidden' name='currency' value='{{$args['currency']}}' />
    <input type='hidden' name='receiver' value='{{$args['username']}}' />
    <input type='hidden' name='ref' value='{{$args['payment_type']."_#".$args['order_id']}}' />
    <input type='hidden' name='success_url' value='{{$args['success_url']}}' />
    <input type='hidden' name='cancel_url' value='{{$args['cancel_url']}}' />
    <input type='hidden' name='memo' value='{{$args['description']}}' />
    {{--    payment description is called as memo--}}
    <input type='hidden' name='notification_url' value='{{$args['ipn_url']}}' />
    {{--    When a transaction has been completed, the transaction reference (under an HTTP POST key 'ref') will be posted to this url (even before the payer gets redirected to the success_url or cancel_url).--}}
    {{--    It is then advisable to rather perform all the needed confirmation check & updates on this urlF--}}


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
