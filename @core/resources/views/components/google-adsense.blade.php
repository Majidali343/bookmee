@if(get_static_option('enable_google_adsense'))
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="{{ get_static_option('google_adsense_publisher_id') }}"
     data-ad-slot="{{$slotid}}"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
@endif