<?php


namespace App\PageBuilder\Addons\FeatureService;

use App\PageBuilder\Fields\ColorPicker;
use App\Service;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Str;

class FeatureServiceTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/feature_service_2.png';
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
        $output .= ColorPicker::get([
            'name' => 'btn_color',
            'label' => __('Button Color'),
            'value' => $widget_saved_values['btn_color'] ?? null,
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
        if($explore_link==''){
            $explore_link = route('service.all.featured');
        }
        $items =$settings['items'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $btn_color = $settings['btn_color'];
        $book_appoinment = $settings['book_appointment'] ?? 'Book Now';


        //static text helpers
        $static_text = static_text();

        $services = Service::select('id','title','image','description','price','slug','seller_id', 'service_city_id','is_service_online')
        ->where(['status'=>1,'is_service_on'=>1,'featured'=>1])
        ->when(subscriptionModuleExistsAndEnable('Subscription'),function($q){
            $q->whereHas('seller_subscription');
        })
        ->take($items)
        ->inRandomOrder()
        ->get();

        $service_markup = '';
        foreach ($services as $service){
            
            $image =  render_background_image_markup_by_attachment_id($service->image,'','','thumb');
            $title =  $service->title;    
            $route = route('service.list.details',$service->slug);   
            $book_now = route('service.list.book',$service->slug);   
            $description =  Str::limit(strip_tags($service->description),100);
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
            $total_review = $service->reviews;
            $total_count = $total_review ->count();
            $rating = round($total_review->avg('rating'),1);
            $seller_profile = route('about.seller.profile',optional($service->seller)->username);


            $rating_and_review='';
            if($rating >= 1){
                $rating_and_review .='<a href="javascript:void(0)">
                    <span class="reviews">'.ratting_star($rating). '('.$total_count.')'. '</span>
                </a>';
            }

            $service_markup.= <<<SERVICE
            <div class="col-xl-3 col-md-6 margin-top-30">
            <div class="single-service service-two style-03 service-padding section-bg-2 wow fadeInUp" data-wow-delay=".2s">
                <a href="{$route}" class="service-thumb service-bg-thumb-format" {$image}>
                   
                    <div class="award-icons style-02">
                        <i class="las la-award"></i>
                    </div>
                    <div class="country_city_location color-three">
                    <span class="single_location"> <i class="las la-map-marker-alt"></i> {$service_country}, {$service_city} </span>
                    </div>
                </a>
                <div class="services-contents content-padding-reverse">
                    <ul class="author-tag">
                        <li class="tag-list">
                            <a href="{$seller_profile}">
                                <div class="authors">
                                    <div class="thumb">
                                    {$seller_image} 
                                        <span class="notification-dot"></span>
                                    </div>
                                    <span class="author-title"> {$seller_name}  </span>
                                </div>
                            </a>
                        </li>
                        <li class="tag-list">
                            {$rating_and_review}
                        </li>
                    </ul>
                    <h5 class="common-title"> <a href="{$route}"> {$title} </a> </h5>
                    <p class="common-para"> {$description} </p>
                    <div class="service-price-wrapper">
                        <div class="service-price style-02">
                            <span class="prices style-02">  {$price} </span>
                        </div>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{$book_now}" class="cmn-btn btn-bg-3" style="background:{$btn_color}"> {$book_appoinment} </a>
                    </div>
                </div>
            </div>
        </div>

SERVICE;
        
}


return <<<HTML

    <!-- Feature Service area starts -->
    <section class="services-area"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title"> {$section_title}  </h3>
                        <a href="{$explore_link}" class="section-btn"> {$explore_text} </a>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                {$service_markup}
            </div>
        </div>
    </section>
    <!-- Featured Service area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Featured Service: 02');
    }
}