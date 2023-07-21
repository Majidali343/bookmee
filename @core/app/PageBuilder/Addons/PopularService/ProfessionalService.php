<?php


namespace App\PageBuilder\Addons\PopularService;

use App\PageBuilder\Fields\ColorPicker;
use App\Category;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class ProfessionalService extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/popular_professional_service.png';
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
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }
    

    public function frontend_render() : string
    {
        $appImageLink  = asset('/assets/frontend/img/static/app.png');
        $appStoreImageLink  = asset('/assets/frontend/img/static/istore.svg');
        $playStoreImageLink  = asset('/assets/frontend/img/static/gstore.svg');

        
        $settings = $this->get_settings();
        $title =$settings['title'];
        $title_text_color =$settings['title_text_color'];
        $explode = explode(" ",$title);
        $title_start = current($explode);
        $title_end = preg_replace("/^(\w+\s)/", "", $title);
        $subtitle = $settings['subtitle'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];

        $categories = Category::WhereHas('services')->select('id','name','image','slug')
        ->where('status','1')
        ->take(6)
        ->inRandomOrder()
        ->get();

        $route = route('service.list.category');

        $category_markup = '';
        foreach ($categories as $category){

            $image =  render_background_image_markup_by_attachment_id($category->image,'','','thumb');
            $category_name = $category->name;
            $category_slug = $category->slug;

            $category_markup.= <<<CATEGORY
              
            <div class="single-professional-item wow fadeInUp" data-wow-delay=".2s">
                <div class="single-professional">
                    <a href="{$route}/{$category_slug}" class="professional-thumb category-bg-thumb-format" {$image}>
                        
                    </a>
                    <div class="professional-contents">
                        <h6 class="professional-title"> <a href="{$route}/{$category_slug}"> {$category_name} </a> </h6>
                    </div>
                </div>
            </div>

CATEGORY;
        
}


return <<<HTML



       <!-- Professional Service area end -->
    <section class="professional-area section-bg-1 section-bg-1" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2 class="title"> {$title_start} <span style="color:{$title_text_color}"> {$title_end} </span> </h2>
                        <span class="section-para extra-padding">{$subtitle}</span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-50">
                <div class="col-lg-12">
                    <div class="professional-slider nav-style-one">
                        {$category_markup}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="appCTA">
        <div class="content">
            <h3 class="head-ing">Download the Bookmi App Today </h3>
            <p class="p">Download now to access a seamless booking experience, browse top-rated salons, spas, and wellness centers, and schedule appointments with ease. Get the Bookmi app today and embark on a journey of self-care!</p>
            <div class="btns">
                <button class="btn"><img src="{$playStoreImageLink}" />&nbsp; PlayStore</button>
                <button class="btn"><img src="{$appStoreImageLink}" />&nbsp; AppStore</button>
            </div>
        </div>
        <div class="img">
        <img src="{$appImageLink}" height="90%"/>
        </div>
    </section>
    <!-- Professional Service area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Popular Professional Services');
    }
}