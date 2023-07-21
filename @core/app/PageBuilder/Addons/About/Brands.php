<?php


namespace App\PageBuilder\Addons\About;

use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Brand;

class Brands extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'about/brand.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

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


        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];

        $brand_markup = '';
        $brands = Brand::select('title','url','image')->get();
        foreach ($brands as $brand) {
            $image =  render_image_markup_by_attachment_id($brand->image,'','','thumb');
            $url = $brand->url;
            $title = $brand->title;

            $brand_markup.= <<<BRANDS
            <div class="clientlogo-item">
                <div class="single-clientlogo">
                    <div class="thumb">
                        <a target="_blank" href="$url" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{$title}"> {$image} </a>
                    </div>
                </div>
            </div>

BRANDS;
    }


return <<<HTML

    <!-- Client Logo area Starts -->
    <div class="clientlogo-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="clientlogo-wrapper">
                        <div class="clientlogo-slider dot-style-one dot-02">
                            { $brand_markup}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Client Logo area ends -->
    
HTML;

}

    public function addon_title()
    {
        return __('Brands :About');
    }
}