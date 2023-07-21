<html>
<head>
    <title>{{__('CinetPay Payment Gateway')}}</title>
</head>
<body>
{!! $payButton !!}
<script>
    (function(){
        "use strict";

        var submitBtn = document.querySelector('#goCinetPay button.cpButton');
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
