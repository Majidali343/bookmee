<?php

namespace App\PageBuilder\Addons\WhyOurMarketplace;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Fields\Image;

class WhyOurMarketplaceTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/why_our_marketplace_2.png';
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
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'info' => __('select color you want to show in frontend'),
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
            'name' => 'btn_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['btn_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'btn_link',
            'label' => __('Button Link'),
            'value' => $widget_saved_values['btn_link'] ?? null,
        ]);


        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description',
                    'label' => __('Details'),
                    'info' => __('new line count as a separate text')
                ],

            ]
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
        $subtitle = $settings['subtitle'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $background_image = render_image_markup_by_attachment_id($settings['background_image']); 
        $btn_text = $settings['btn_text'];
        $btn_link = $settings['btn_link'];
        if(empty($settings['btn_link'])){
            $btn_link = route('user.register',['type' => 'seller']);
        }


        $repeater_data = $settings['contact_page_contact_info_01'];
        $why_our_marketplace_markup = '';

        foreach ($repeater_data['title_'] as $key => $title) {
            $inner_title = $title;
            $image = render_image_markup_by_attachment_id($repeater_data['image_'][$key]); 
            $description = $repeater_data['description_'][$key];
            

            $why_our_marketplace_markup.= <<<SERVICE
                <div class="col-xl-6 col-lg-4 col-md-6 margin-top-30">
                    <div class="single-marketplace style-03 wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon">
                         {$image}
                        </div>
                        <div class="marketplace-contents">
                            <h5 class="common-title"> {$inner_title} </h5>
                            <p class="common-para">{$description}</p>
                        </div>
                    </div>
                </div>
SERVICE;
    }


return <<<HTML
    <section class="margketplace-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="market-shapes">
           {$background_image}
        </div>
        <div class="container container-two">
            <div class="row flex-row-reverse align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <div class="row">
                       {$why_our_marketplace_markup}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 margin-top-30">
                    <div class="marketplace-left-contents">
                        <h2 class="title"> {$section_title} </h2>
                        <p class="market-para">{$subtitle}</p>
                        <div class="btn-wrapper">
                            <a href="{$btn_link}" class="cmn-btn btn-bg-3"> {$btn_text} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
HTML;

}

    public function addon_title()
    {
        return __('Why Our Marketplace: 02');
    }
}