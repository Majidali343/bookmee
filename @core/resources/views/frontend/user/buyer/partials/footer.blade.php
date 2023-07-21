<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->

<script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/common/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery-migrate-1.4.1.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/slick.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/chart.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.nice-select.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}
<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
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