<?php


namespace App\PageBuilder\Addons\Header;

use App\Country;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Category;
use App\ServiceCity;
use App\User;

class HeaderStyleFour extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_four/header_4.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'service_type',
            'label' => __('Service Type'),
            'value' => $widget_saved_values['service_type'] ?? null,
        ]);
        $output .= IconPicker::get([
            'name' => 'service_icon',
            'label' => __('Service Icon'),
            'value' => $widget_saved_values['service_icon'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'service_link',
            'label' => __('Service Link'),
            'value' => $widget_saved_values['service_link'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'dot_image',
            'label' => __('Banner Dot Image'),
            'value' => $widget_saved_values['dot_image'] ?? null,
            'dimensions' => '163x163'
        ]);
        $output .= Image::get([
            'name' => 'banner_image',
            'label' => __('Banner Image'),
            'value' => $widget_saved_values['banner_image'] ?? null,
            'dimensions' => '46x46'
        ]);

        $output .= Image::get([
            'name' => 'image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['image'] ?? null,
            'dimensions' => '795x1139'
        ]);

        $output .= Switcher::get([
            'name' => 'country_show_hide',
            'label' => __('Country'),
            'value' => $widget_saved_values['country_show_hide'] ?? null,
            'info' => __('Country wise Service Search Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'city_show_hide',
            'label' => __('City'),
            'value' => $widget_saved_values['city_show_hide'] ?? null,
            'info' => __('City wise Service Search Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'area_show_hide',
            'label' => __('Area'),
            'value' => $widget_saved_values['area_show_hide'] ?? null,
            'info' => __('Area wise Service Search Hide/Show')
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render() : string
    {
        $settings = $this->get_settings();

        $title = $settings['title'];
        $subtitle = $settings['subtitle'];
        $service_icon = $settings['service_icon'] ?? '';

        $country_show_hide =$settings['country_show_hide'] ?? '';
        $city_show_hide =$settings['city_show_hide'] ?? '';
        $area_show_hide =$settings['area_show_hide'] ?? '';

        $explode = explode(" ",$title);
        $title_end = end($explode);
        $last_space_position = strrpos($title, ' ');
        $title_start = substr($title, 0, $last_space_position);

        $service_type = $settings['service_type'];
        $service_link = $settings['service_link'];
        $image = render_image_markup_by_attachment_id($settings['image']);
        $banner_dot_image = render_image_markup_by_attachment_id($settings['dot_image']);
        $banner_image = render_image_markup_by_attachment_id($settings['banner_image']);
        $happy_clients = __('Happy Clients');
        $happy_clients_count = User::where('user_type','1')->where('user_status','1')->count();
        $search_placeholder = __('What are you looking for?');
        $select_country = __('Select Country');
        $select_city = __('Select City');
        $route = route('service.list.category');
        $search_route = route('frontend.home.search.single');
        $popular = __('Popular:');

        $service_countries = Country::where('status',1)->get();
        $categories = Category::whereHas('services')->select('id','name','slug')->take(5)->inRandomOrder()->get();
        $country_markup = '';
        $service_markup = '';
        $category_markup = '';

        foreach ($service_countries as $country){
            $country_id = $country->id;
            $country_name = $country->country;
            $country_markup.= <<<COUNTRYMARKUP
            <option value="{$country_id}">{$country_name}</option>
            COUNTRYMARKUP;
        }

        foreach ($categories as $cat){
            $category_name = $cat->name;
            $category_slug = $cat->slug;
            $service_markup.= <<<SERVICECATEGORY
            <option value="{$category_name}">{$category_name}</option>
SERVICECATEGORY;
        }
foreach ($categories as $cat){
    $category_name = $cat->name;
    $category_slug = $cat->slug;
    $category_markup.= <<<CATEGORY
    <li><a href="{$route}/{$category_slug}"> {$category_name} </a></li>
CATEGORY;
}

        $country_show_hide_markup = '';
        $city_show_hide_markup = '';
        $area_show_hide_markup = '';
        $country_city_area_show_hide_markup = '';

        if ($country_show_hide == 'on'){
            $country_show_hide_markup.= <<<COUNTRYSHOWHIDE
         <div class="banner-address-select">
            <select name="service_country_id" id="service_country_id" class="country-wrapper">
                <option value="">{$select_country}</option>
                {$country_markup}
            </select>
        </div> 
COUNTRYSHOWHIDE;
        }
        if ($city_show_hide == 'on'){

            $fetch_cities = '';
            if($country_show_hide !== 'on'){
                $all_cities = ServiceCity::where("status" ,1)->get();

                foreach ($all_cities as $cities){
                    $fetch_cities .= '<option value='.$cities->id.'>'.$cities->service_city.'</option>';
                }
            }

            $city_show_hide_markup.= <<<CITYSHOWHIDE
          <div class="banner-address-select">
            <select name="service_city_id" id="service_city_id">
                <option value="">{$select_city}</option>
                {$fetch_cities}
            </select>
        </div>
CITYSHOWHIDE;
        }

        if ($area_show_hide == 'on'){
            $area_show_hide_markup.= <<<AREASHOWHIDE
         <div class="banner-address-select">
            <select name="service_area_id" id="service_area_id">
                <option value="">Select Area</option>                                            
            </select>
        </div>
AREASHOWHIDE;
        }

        if ($country_show_hide == 'on' || $city_show_hide == 'on' || $area_show_hide == 'on'){
            $country_city_area_show_hide_markup .=<<<COUNTRYCITYAREASHOWHIDE
         <form action="{$search_route}" class="banner-search-form" method="get">
            <div class="header_03_form_select_wrap">
               {$country_show_hide_markup}
               {$city_show_hide_markup}
               {$area_show_hide_markup}
            </div>
            <div class="single-input">
                <input class="form--control" name="home_search" id="home_search" type="text" placeholder="{$search_placeholder}" autocomplete="off">
                <div class="icon-search">
                    <i class="las la-search"></i>
                </div>
                <button type="submit"> <i class="las la-search"></i> </button>
            </div>
        </form>
COUNTRYCITYAREASHOWHIDE;
        }

return <<<HTML

    <div class="banner-area home-four-banner gradient-bg-1">
        <div class="container container-two">
            <div class="row flex-row-reverse flex-xl-row align-items-center">
                <div class="col-xl-7">
                    <div class="banner-contents style-03">
                        <h1 class="banner-title">{$title_start}<span class="color-three"> {$title_end} </span> </h1>
                        <span class="title-top">{$subtitle} </span>
                        <div class="banner-bottom-content">
                             {$country_city_area_show_hide_markup}
                            <span id="all_search_result"></span>                            
                            <div class="banner-keywords">
                                <span class="keyword-title"> {$popular} </span>
                                <ul class="keyword-tag">
                                    {$category_markup}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="banner-right-contents style-03">
                        <div class="banner-right-thumb wow fadeInUp" data-wow-delay=".2s">
                              {$image}
                            <div class="banner-dot-shape">
                              {$banner_dot_image} 
                            </div>
                        </div>
                        <div class="banner-cleaning-service">
                            <div class="icon">
                                <i class="{$service_icon}"></i>
                            </div>
                            <div class="icon-contents">
                                <span class="thumb-cleaning-title"> <a href="{$service_link}"> {$service_type} </a> </span>
                                <ul class="review-cleaning">
                                    <li> <i class="las la-star"></i> </li>
                                    <li> <i class="las la-star"></i> </li>
                                    <li> <i class="las la-star"></i> </li>
                                    <li> <i class="las la-star"></i> </li>
                                    <li> <i class="las la-star"></i> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="banner-client">
                            <div class="smile-contents-all">
                                <div class="thumb-smile">
                                   {$banner_image}
                                </div>
                                <div class="smile-content">
                                    <span class="smile-title">{$happy_clients_count} </span>
                                    <span class="smile-para">{$happy_clients}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
}

    public function addon_title()
    {
        return __('Header: 04');
    }
}