<?php


namespace App\PageBuilder\Addons\PopularService;

use App\PageBuilder\Fields\ColorPicker;
use App\Service;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class PopularServiceTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/popular_service_2.png';
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
            'name' => 'explore_all',
            'label' => __('Explore Text'),
            'value' => $widget_saved_values['explore_all'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'explore_link',
            'label' => __('Explore Link'),
            'value' => $widget_saved_values['explore_link'] ?? null,
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
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
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);
        $output .= Text::get([
            'name' => 'book_appointment',
            'label' => __('Book Appoinment Button Text'),
            'value' => $widget_saved_values['book_appointment'] ?? 'Book Now',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }
    

    public function frontend_render() : string
    {
        
        $settings = $this->get_settings();
        $section_title =$settings['title'];
        $explore_text =$settings['explore_all'];
        $explore_link =$settings['explore_link'];
        $explore_link =$settings['explore_link']?? route('service.all.popular');

        $items =$settings['items'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $book_appoinment = $settings['book_appointment'] ?? 'Book Now';


        //static text helpers
        $static_text = static_text();

        $services = Service::select('id','title','image','description','price','slug','seller_id','featured', 'service_city_id','is_service_online')
        ->where(['status'=>1,'is_service_on'=>1])
        ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
            $q->whereHas('seller_subscription');
        })
        ->orderBy('view','DESC')
        ->take($items)
        ->inRandomOrder()
        ->get();

        $service_markup = '';
        foreach ($services as $service){

            $image =  render_background_image_markup_by_attachment_id($service->image,'','','thumb');
            $title =  $service->title;    
            $route = route('service.list.details',$service->slug);   
            $book_now = route('service.list.book',$service->slug);   
            $price =  amount_with_currency_symbol($service->price); 
            $seller_image =  render_image_markup_by_attachment_id(optional($service->seller)->image,'','','thumb');
            $seller_name =  optional($service->seller)->name;
            if($service->is_service_online==1){
                $service_city =  __('Service');
                $service_country =  __('Online');
            }else{
                $service_city =  optional($service->serviceCity)->service_city;
                $service_country =  optional(optional($service->serviceCity)->countryy)->country;
            }

            //calculate each service rating and count review
            $total_review = optional($service->reviews);
            $total_count = $total_review ->count();
            $rating = round($total_review->avg('rating'),1);
            $seller_profile = route('about.seller.profile',optional($service->seller)->username);

            $rating_and_review='';
            if($rating >= 1){
                $rating_and_review .='<a href="javascript:void(0)">
                    <span class="reviews">'.ratting_star($rating). '('.$total_count.')'. '</span>
                </a>';
            }
            $featured ='';
            if($service->featured == 1){
                $featured .='<div class="award-icons">
                <i class="las la-award"></i>
                </div>';
            }

            $service_markup.= <<<SERVICE

                <div class="col-xl-3 col-lg-4 col-md-6 margin-top-30 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-service service-two style-03 section-bg-2">
                        <a href="{$route}" class="service-thumb service-bg-thumb-format" {$image}>
                        {$featured}
                        <div class="country_city_location color-three">
                        <span class="single_location"> <i class="las la-map-marker-alt"></i> {$service_country}, {$service_city} </span>
                        </div>
                        </a>
                        <div class="services-contents">
                            <ul class="author-tag">
                                <li class="tag-list">
                                    <a href="{$seller_profile}">
                                        <div class="authors">
                                            <div class="thumb">
                                            {$seller_image}
                                                <span class="notification-dot"></span>
                                            </div>
                                            <span class="author-title"> {$seller_name} </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    {$rating_and_review}
                                </li>
                            </ul>
                            <h5 class="common-title"> <a href="{$route}">{$title} </a> </h5>
                            <div class="service-price-wrapper">
                                <div class="service-price">
                                    <span class="prices style-02"> {$price} </span>
                                </div>
                                <div class="btn-wrapper">
                                    <a href="{$book_now}" class="cmn-btn btn-small btn-outline-3"> {$book_appoinment} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

SERVICE;
        
}

return <<<HTML
    <!-- Popular Service area starts -->
    <section class="services-area"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title">{$section_title}</h3>
                        <a href="{$explore_link}" class="section-btn">{$explore_text}</a>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                    {$service_markup}
            </div>
        </div>
    </section>
    <!-- Popular Service area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Popular Service: 02');
    }
}