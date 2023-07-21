@if(request()->path() == '/' || \Request::is( 'home/*') )
<title>{{get_static_option('site_title')}} - {{get_static_option('site_tag_line')}}</title>
<meta name="og:title" content="{{get_static_option('og_meta_title')}}"/>
<meta name="og:description" content="{{get_static_option('og_meta_description')}}"/>
<meta name="og:site_name" content="{{get_static_option('og_meta_site_name')}}"/>
<meta name="og:url" content="{{get_static_option('og_meta_url')}}"/>
{!! render_og_meta_image_by_attachment_id(get_static_option('og_meta_image')) !!}
@endif


@if(request()->is([
    get_static_option('news_page_slug'),
    get_static_option('news_page_slug').'/*',
    'p/*',
    'news-tags/*',
    get_static_option('about_page_slug'),
    get_static_option('contact_page_slug'),
    get_static_option('event_page_slug'),
    get_static_option('event_page_slug').'/*',
    get_static_option('contribution_page_slug'),
    get_static_option('contribution_page_slug').'/*',

]))

<title>@yield('site-title') - {{get_static_option('site_title')}}</title>

@yield('page-meta-data')
@yield('og-meta')
@else
<title>{{get_static_option('site_title')}} - {{get_static_option('site_tag_line')}}</title>
<meta name="description" content="{{filter_static_option_value('site_meta_description',$global_static_field_data)}}">
<meta name="tags" content="{{filter_static_option_value('site_meta_tags',$global_static_field_data)}}">
@endif
