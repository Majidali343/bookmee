<?php

namespace App\PageBuilder\Addons\Header;

use App\Category;
use App\Service;
use App\Country;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\ServiceCity;

class HeaderStyleOne extends \App\PageBuilder\PageBuilderBase

{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/header_1.png';
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
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '1920x1080',
        ]);

        $output .= Switcher::get([
            'name' => 'country_show_hide',
            'label' => __('Country'),
            'value' => $widget_saved_values['country_show_hide'] ?? null,
            'info' => __('Country wise Service Search Hide/Show'),
        ]);

        $output .= Switcher::get([
            'name' => 'city_show_hide',
            'label' => __('City'),
            'value' => $widget_saved_values['city_show_hide'] ?? null,
            'info' => __('City wise Service Search Hide/Show'),
        ]);

        $output .= Switcher::get([
            'name' => 'area_show_hide',
            'label' => __('Area'),
            'value' => $widget_saved_values['area_show_hide'] ?? null,
            'info' => __('Area wise Service Search Hide/Show'),
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

    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        $background_image = render_background_image_markup_by_attachment_id($this->setting_item('background_image'));
        $title = $settings['title'];
        $subtitle = $settings['subtitle'];

        $country_show_hide = $settings['country_show_hide'] ?? '';
        $city_show_hide = $settings['city_show_hide'] ?? '';
        $area_show_hide = $settings['area_show_hide'] ?? '';

        $explode = explode(" ", $title);
        $title_end = end($explode);
        $last_space_position = strrpos($title, ' ');
        $title_start = substr($title, 0, $last_space_position);
        $search_placeholder = __('What are you looking for?');
        $route = route('service.list.category');
        $search_route = route('frontend.home.search.single');
        $popular = __('Popular:');
        $select_country = __('Select Country');
        $select_city = __('Select City');
        $select_area = __('Select Area');

        $service_countries = Country::where('status', 1)->get();


        $categories = Category::whereHas('services')->get();
        $category_markup = '';
        $country_markup = '';
        $mapImageLink =  asset("/assets/frontend/img/static/map.svg");


        foreach ($service_countries as $country) {
            $country_id = $country->id;
            $country_name = $country->country;
            $country_markup .= <<<COUNTRYMARKUP
            <option value="{$country_id}">{$country_name}</option>
            COUNTRYMARKUP;
        }
   
        foreach ($categories as $cat) {
            $category_name = $cat->name;
            $category_slug = $cat->slug;
            $category_icon = get_attachment_image_by_id($cat->image)['img_url'];
            $category_markup .= <<<CATEGORY
            <li id="category">
            <a href="{$route}/{$category_slug}">
            <div class="icon">
            <img src="{$category_icon}"/>
            </div>
            <p>{$category_name}</p>
            </a>
            </li>
CATEGORY;
        }

        $country_show_hide_markup = '';
        $city_show_hide_markup = '';
        $area_show_hide_markup = '';
        $country_city_area_show_hide_markup = '';

        if ($country_show_hide == 'on') {
            $country_show_hide_markup .= <<<COUNTRYSHOWHIDE
         <div class="banner-address-select">
            <select name="service_country_id" id="service_country_id" class="country-wrapper">
            
                {$country_markup}
            </select>
        </div>
COUNTRYSHOWHIDE;
        }
        if ($city_show_hide == 'on' || $city_show_hide == 'off') {
            $fetch_cities = '';
            if ($country_show_hide !== 'on' || $country_show_hide == 'on') {
                $all_cities = ServiceCity::where("status", 1)->get();

                foreach ($all_cities as $cities) {
                    $fetch_cities .= '<option value=' . $cities->id . '>' . $cities->service_city . '</option>';
                }
            }

            $city_show_hide_markup .= <<<CITYSHOWHIDE
          <div class="banner-address-select">
            <select style="display: none;" name="service_city_id" id="service_city_id">
                <option value="">{$select_city}</option>
                {$fetch_cities}
            </select>
        </div>
CITYSHOWHIDE;
        }

        if ($area_show_hide == 'on') {
            $area_show_hide_markup .= <<<AREASHOWHIDE

        <div class="banner-address-select">
            <select style="display: none;" name="service_area_id" id="service_area_id">
                <option value="">{$select_area}</option>
            </select>
        </div>
AREASHOWHIDE;
        }
        // {$country_show_hide_markup}
        // {$city_show_hide_markup}
        // {$area_show_hide_markup}
        if ($country_show_hide == 'on' || $city_show_hide == 'on' || $area_show_hide == 'on') {
            $country_city_area_show_hide_markup .= <<<COUNTRYCITYAREASHOWHIDE
         <form action="{$search_route}" class="banner-search-form" method="get">
              
            <div class="single-input">
                <input class="form--control" type="text" name="home_search" id="home_search" placeholder="{$search_placeholder}" autocomplete="off">
                <div class="icon-search">
                    <i class="las la-search"></i>
                </div>
                <button type="submit"> <i class="las la-search"></i> </button>
            </div>
        </form>
COUNTRYCITYAREASHOWHIDE;
        }

        return <<<HTML
<div class="banner-area home-one-banner" style="color: white; background-color: var(--main-color-one) !important;" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="banner-contents">
                   <span class="title-top"> {$subtitle} </span>
                   <h1 class="banner-title"> {$title_start} <span class="title-span"> {$title_end} </span></h1>
                    <div class="banner-bottom-content">
            
                      {$country_city_area_show_hide_markup}
                        
                      <span id="all_search_result"> </span>
                          <div class="banner-keywords">
                                    <ul class="keyword-tag" style="padding-bottom:18px;">
                                        {$category_markup}
                                    </ul>
                                </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Commiting the location card from below the hero section -->
<!-- <section class="location-tracker-section">
    <div class="location-tracker-card">
        <div>
            <h3 class="head-ing">Turn on location Services</h3>
            <p class="p">Get recommendations of great Businesses!Turn on Location so we can show you what’s neearby.</p>
            <div class="btns">
            <button class="btn btn-sec">Not Now</button>
            <button class="btn btn-pri">Search Nearby</button>
            </div>
        </div>
        <img class="map" src="{$mapImageLink}" />
    </div>
</section> -->

HTML;
    }

    public function addon_title()
    {
        return __('Header: 01');
    }
}
