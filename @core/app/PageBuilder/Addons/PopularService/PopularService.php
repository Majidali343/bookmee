<?php


namespace App\PageBuilder\Addons\PopularService;

use App\PageBuilder\Fields\ColorPicker;
use App\Service;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Select;


class PopularService extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/popular_service.png';
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
        $output .= ColorPicker::get([
            'name' => 'title_text_color',
            'label' => __('Title Text Color'),
            'value' => $widget_saved_values['title_text_color'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
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
        $output .= ColorPicker::get([
            'name' => 'btn_color',
            'label' => __('Button Color'),
            'value' => $widget_saved_values['btn_color'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);
        $output .= Select::get([
            'name' => 'explore_btn_color',
            'label' => __('Select Color'),
            'options' => [
                'btn-outline-1' => __('Green'),
                'btn-outline-2' => __('Blue'),
            ],
            'value' => $widget_saved_values['explore_btn_color'] ?? null,
            'info' => __('Select your color')
        ]);
        $output .= Select::get([
            'name' => 'hover_color',
            'label' => __('Select Hover Color'),
            'options' => [
                'hover_color' => __('Green'),
                'style-02' => __('Blue'),
            ],
            'value' => $widget_saved_values['hover_color'] ?? null,
            'info' => __('Select your color')
        ]);
        $output .= Text::get([
            'name' => 'explore_more_link',
            'label' => __('Explore More'),
            'value' => $widget_saved_values['explore_more_link'] ?? null,
            'info' => 'put your link where to go',
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
        $title =$settings['title'];
        $title_text_color =$settings['title_text_color'];
        $explode = explode(" ",$title);
        $title_start = current($explode);
        $title_end = end($explode);
        $subtitle = $settings['subtitle'];

        $items =$settings['items'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $section_bg = $settings['section_bg'];
        $btn_color = $settings['btn_color'];
        $explore_btn_color = $settings['explore_btn_color'] ?? null;
        $hover_color = $settings['hover_color'] ?? null;
        $btn_text = __('Explore More');
        $explore_more_link =$settings['explore_more_link']?? route('service.all.popular');
        $book_appoinment = $settings['book_appointment'] ?? 'Book Now';


        //static text helpers
        $static_text = static_text();

        $services = Service::select('id','title','image','description','price','slug','seller_id','featured','service_city_id','is_service_online')
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
            // <span class="single_location"> <i class="las la-map-marker-alt"></i> {$service_country}, {$service_city} </span>

            $service_markup.= <<<SERVICE
            

            <div class="col-xl-4 col-md-6 margin-top-30">
                    <div class="single-service service-two wow fadeInUp {$hover_color}" data-wow-delay=".2s">
                        <a href="{$route}" class="service-thumb service-bg-thumb-format" {$image}>
                            {$featured}
                            <div class="country_city_location">
                           
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
                                            <span class="author-title-polularservice"> {$seller_name} </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="tag-list">
                                    {$rating_and_review}
                                </li>
                            </ul>
                            <h5 class="common-title-popularservice"> <a href="{$route}"> {$title} </a> </h5>
                            <div class="service-price-wrapper">
                                <div class="service-price style-02">
                                    <span class="starting"> {$static_text['start_at']}  </span>
                                    <span class="prices"> {$price} </span>
                                </div>
                                <div class="btn-wrapper">
                                    <a href="{$book_now}" class="cmn-btn btn-bg-1" style="background:{$btn_color}"> {$book_appoinment} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

SERVICE;
        
}


return <<<HTML

        <!-- Popular Service area starts -->
        <section class="services-area section-bg-1" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10">
                    <div class="section-title">
                        <h2 class="title"> <span style="color:{$title_text_color}"> {$title_start} </span> {$title_end} </h2>
                        <span class="section-para">{$subtitle}</span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                {$service_markup}
                <div class="explore-btn">
                    <div class="btn-wrapper">
                        <a href="{$explore_more_link}" class="cmn-btn {$explore_btn_color}" style="color:{$title_text_color}"> {$btn_text} </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Service area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Popular Service');
    }
}