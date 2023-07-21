<html>
<head>
    <title>{{__('PayStack Payment')}}</title>
</head>
<body>
<form method="POST" action="{{ $paystack_data['route'] }}" accept-charset="UTF-8" class="form-horizontal" role="form">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <input type="hidden" name="name" value="{{$paystack_data['name']}}">
            <input type="hidden" name="email" value="{{$paystack_data['email']}}"> {{-- required --}}
            <input type="hidden" name="order_id" value="{{$paystack_data['order_id']}}">
            <input type="hidden" name="orderID" value="{{$paystack_data['order_id']}}">
            <input type="hidden" name="amount" value="{{$paystack_data['price'] * 100}}"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="{{$paystack_data['currency']}}">
            <input type="hidden" name="merchantEmail" value="{{$paystack_data['merchantEmail']}}">
            <input type="hidden" name="secretKey" value="{{base64_encode($paystack_data['secretKey'])}}">
            <input type="hidden" name="publicKey" value="{{$paystack_data['publicKey']}}">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['track' => $paystack_data['track'],'type' => $paystack_data['type'],'order_id' => $paystack_data['order_id']]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Unicodeveloper\Paystack\Facades\Paystack::genTranxRef() }}"> {{-- required --}}
            <p>
                <button id="submit_btn" type="submit" >{{__('Redirecting..')}}</button>
            </p>
        </div>
    </div>
</form>

<script>
    (function(){
        "use strict";
        var submitBtn = document.querySelector('#submit_btn');
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
