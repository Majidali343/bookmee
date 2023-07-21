<?php


namespace App\PageBuilder\Addons\OnlineService;

use App\PageBuilder\Fields\ColorPicker;
use App\Service;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Str;

class OnlineService extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/featured_service.png';
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
            'name' => 'dot_color_slider',
            'label' => __('Select Color'),
            'options' => [
                'dot-color-01' => __('Green'),
                'dot-color-02' => __('Blue'),
            ],
            'value' => $widget_saved_values['dot_color_slider'] ?? null,
            'info' => __('Select your color')
        ]);
        $output .= Text::get([
            'name' => 'book_appointment',
            'label' => __('Book Appoinment Button Text'),
            'value' => $widget_saved_values['book_appointment'] ?? null,
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
        $btn_color = $settings['btn_color'];
        $dot_color_slider = $settings['dot_color_slider'] ?? null;
        $book_appoinment = $settings['book_appointment'] ?? 'Book Appoinment';


        //static text helpers
        $static_text = static_text();

        $services = Service::select('id','title','image','description','price','slug','seller_id','service_city_id','is_service_online')
        ->where(['status'=>1,'is_service_on'=>1,'is_service_online'=>1])
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
            $description = Str::limit(strip_tags($service->description),100);
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
            $rating_text =__('Rating:');
            if($rating >= 1){
                $rating_and_review .='<a href="javascript:void(0)">
                    <span class="icon">' .$rating_text.'</span>
                    <span class="reviews">'.$rating. '('.$total_count.')'. '</span>
                </a>';
            }

            $service_markup.= <<<SERVICE

            <div class="single-services-item wow fadeInUp" data-wow-delay=".2s">
                <div class="single-service {$dot_color_slider}">
                    <a href="{$route}" class="service-thumb location_relative service-bg-thumb-format" {$image}>
                        <div class="award-icons">
                            <i class="las la-award"></i>
                        </div>

                        <div class="country_city_location">
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
                        <h5 class="common-title"> <a href="{$route}"> {$title} </a> </h5>
                        <p class="common-para">{$description}</p>
                        <div class="service-price">
                            <span class="starting"> {$static_text['start_at']} </span>
                            <span class="prices">{$price} </span>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{$book_now}" class="cmn-btn btn-appoinment btn-bg-1" style="background:{$btn_color}"> {$book_appoinment} </a>
                        </div>
                    </div>
                </div>
            </div>

SERVICE;
        
}


return <<<HTML

    <!-- Featured Service area starts -->
    <section class="services-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10">
                    <div class="section-title">
                        <h2 class="title"> <span style="color:{$title_text_color}"> {$title_start} </span> {$title_end} </h2>
                        <span class="section-para">{$subtitle} </span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-50">
                <div class="col-lg-12">
                    <div class="services-slider dot-style-one {$dot_color_slider}">
                        {$service_markup}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Service area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Online Service');
    }
}