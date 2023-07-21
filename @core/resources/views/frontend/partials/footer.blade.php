
@php
$footer_variant = !is_null(get_footer_style()) ? get_footer_style() : '02';
@endphp
@include('frontend.partials.pages-portion.footers.footer-'.$footer_variant)

@if(preg_match('/(bytesed)/',url('/')))
   <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank"href="https://bytesed.com/docs-category/quixer-on-demand-service-marketplace-and-service-finder/" data-container="body" data-toggle="popover" data-placement="left" data-content="{{__('Documentation')}}"><i class="lar la-file-alt"></i></a></li>
            <li><a target="_blank"href="https://codecanyon.net/item/Bookmi-multivendor-on-demand-service-marketplace-and-service-finder/36475708"><i class="las la-shopping-cart"></i></a></li>
            <li><a target="_blank"href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
        </ul>
    </div>
@endif

<!-- back to top area start -->
<div class="back-to-top {{$page_post->back_to_top ?? ''}}">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->


@if(moduleExists("LiveChat"))
<x-livechat.widget-markup />
@endif


<script src="{{asset('assets/frontend/js/slick.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.nice-select.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/frontend/js/dynamic-script.js')}}"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
    }
});
</script>

@include('frontend.pages.services.partials.service-search')
@include('frontend.partials.home-search')
@include('frontend.partials.inline-scripts')
@include('frontend.partials.gdpr-cookie')

@if(moduleExists("JobPost"))
    @include('jobpost::frontend.jobs.job-search')
@endif

@if(!empty( get_static_option('tawk_api_key')))
 {!! get_static_option('tawk_api_key') !!}
 @endif

@if(!empty(get_static_option('site_google_captcha_v3_site_key'))  )
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        (function() {
            "use strict";
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    if(document.getElementById('gcaptcha_token') != null){
                        document.getElementById('gcaptcha_token').value = token;
                    }
                });
            });

        })(jQuery);
    </script>
@endif

<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}


<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
@if(request()->routeIs('frontend.order.payment.success'))
<script>
    var myCalendar = createCalendar({
        options: {
            class: 'my-class',
            // You can pass an ID. If you don't, one will be generated for you
            id: 'my-id'
        },
        data: {
            // Event title
            title: "{{ optional($order_details->service)->title }}",

            // Event start date
            start: new Date('{{ Carbon\Carbon::parse(strtotime($order_details->date))->format('F d, Y H:i') }}'),

            // Event duration (IN MINUTES)
            Minutes: 120,

            // You can also choose to set an end time
            // If an end time is set, this will take precedence over duration
            end: new Date('{{ Carbon\Carbon::parse(strtotime($order_details->date))->format('F d, Y H:i') }}'),

            // Event Address
            address: "{{ optional($order_details->buyer)->address }}",

            // Event Description
            description: 'Order Sucessfully Created'
        }
    });

    document.querySelector('.new-cal').appendChild(myCalendar);
</script>
@endif

@if(moduleExists("LiveChat"))
    <x-livechat.widget-js />
@endif

@if(moduleExists("Subscription"))
   @include('frontend.partials.subscription-js')
@endif
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/{{current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))}}.js"></script>
<script>
    /*-----------------
     Select2
    ------------------*/
    $('select').select2({
         language: "{{current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))}}"
    });
</script>


@yield('scripts')

</body>
</html>
