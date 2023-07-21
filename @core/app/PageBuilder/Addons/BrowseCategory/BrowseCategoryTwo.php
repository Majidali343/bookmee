<?php


namespace App\PageBuilder\Addons\BrowseCategory;

use App\Category;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class BrowseCategoryTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/browse_category_2.png';
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
            'info' => __('add page link where you want to redirect')
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
        $explore_text =$settings['explore_all'];
        $explore_link =$settings['explore_link'];
        if($explore_link==''){
            $explore_link = route('all.category.subcategory');
        }
 
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
            $category_image = render_background_image_markup_by_attachment_id($cat->image,'','grid');
            $service_count = $cat->services->count();

 $category_markup.= <<<CATEGORY
    <div class="col-xl-2 col-lg-3 col-sm-6 margin-top-30 category-child">
        <div class="single-category style-02 wow fadeInUp" data-wow-delay=".2s">
            <div class="icon category-bg-thumb-format"  {$category_image}>
               
            </div>
            <div class="category-contents">
                <h4 class="category-title"> <a href="{$route}/{$slug}"> {$name} </a> </h4>
                <span class="category-para"> {$service_count}+ {$static_text['service']} </span>
            </div>
        </div>
    </div>

CATEGORY;
        
}


return <<<HTML
<!-- Category area starts -->
<section class="category-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title"> {$title} </h3>
                        <a href="{$explore_link}" class="section-btn"> {$explore_text} </a>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                {$category_markup}
            </div>
        </div>
    </section>
    <!-- Category area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Browse Category: 02');
    }
}