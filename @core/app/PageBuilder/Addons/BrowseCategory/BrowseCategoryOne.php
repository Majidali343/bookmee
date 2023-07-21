<?php


namespace App\PageBuilder\Addons\BrowseCategory;

use App\Category;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class BrowseCategoryOne extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/browse_category.png';
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
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
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
        $title_start = $explode[0];
        $title_mid = $explode[1];
        $title_end = $explode[2];

        $subtitle = $settings['subtitle'];
 
        $order_by =$settings['order_by'];
        $IDorDate =$settings['order'];
        $items =$settings['items'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];


        //static text helpers
        $static_text = static_text();

        $all_category = Category::with('services')
         ->where('status',1)
        ->whereHas('services')
        ->take($items)
        ->OrderBy($order_by,$IDorDate)
        ->get();
        $route = route('service.list.category');

        $category_markup = '';
        foreach ($all_category as $cat){
           
            $name = $cat->name;
            $slug = $cat->slug;
            $icon = $cat->icon;
            $service_count = $cat->services->count();

        

 $category_markup.= <<<CATEGORY
        <div class="">
        <div class=" about">
            <div class="icon-position">
                <img src="{$icon}" />
            </div>
            <div class="title-margin">
                <h3 class=" about-margin  title"> <a href="{$route}/{$slug}"> {$name} </a> </h3>
                
            </div>
        </div>
        </div>
        

CATEGORY;

}


return <<<HTML
<section class="category-area section-bg-1" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10">
                <div class="section-title">
                    <h3 class="title">  <span style="color:{$title_text_color}">{$title_start} {$title_mid} {$title_end} </span> </h3>
                    <span class="section-para">{$subtitle}</span>
                </div>
            </div>
        </div>
        <div class="row margin-top-50">
            <div class="col-lg-12">
                <div class="about-category">
                    {$category_markup}
                </div>
                
            </div>
        </div>
    </div>
</section>
    
HTML;

}

    public function addon_title()
    {
        return __('Browse Category: 01');
    }
}