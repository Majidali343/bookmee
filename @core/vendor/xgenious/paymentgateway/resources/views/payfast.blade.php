<html>
<head>
    <title>{{__('Payfast Payment Gateway')}}</title>
</head>
<body>
{!! $submit_form !!}
<script>
    (function($){
        "use strict";
        var submitBtn = document.querySelector('button[type="submit"]');
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
