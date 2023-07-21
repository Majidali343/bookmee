<?php


namespace App\PageBuilder\Addons\WhyOurMarketplace;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;


class WhyOurMarketplace extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/why_our_marketplace.png';
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


        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
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
        $title =$settings['title'];
        $title_text_color =$settings['title_text_color'];
        $title_start = preg_replace('~\\s+\\S+$~', '', $title);
        $explode = explode(" ",$title);
        $title_end = end($explode);
        $subtitle = $settings['subtitle'];

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];


        $repeater_data = $settings['contact_page_contact_info_01'];
        $why_our_marketplace_markup = '';

        foreach ($repeater_data['title_'] as $key => $title) {
            $inner_title = $title;
            $icon = $repeater_data['icon_'][$key];
            $description = $repeater_data['description_'][$key];
            

            $why_our_marketplace_markup.= <<<SERVICE

            <div class="col-lg-3 col-md-6 margin-top-30 marketplace-child">
                <div class="single-marketplace wow fadeInUp h-100"data-wow-delay=".2s">
                    <div class="icon">
                        <i class="{$icon}"></i>
                    </div>
                    <div class="marketplace-contents">
                        <h5 class="common-title-services">{$inner_title} </h5>
                        <p class="common-para-services">{$description}</p>
                    </div>
                </div>
            </div>

SERVICE;
    }


return <<<HTML

    <!-- Marketplace area end -->
    <section class="margketplace-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10">
                    <div class="section-title">
                        <h2 class="title"> {$title_start} <span style="color:{$title_text_color}">{$title_end} </span> </h2>
                        <span class="section-para">{$subtitle}</span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                {$why_our_marketplace_markup}
            </div>
        </div>
    </section>
    <!-- Marketplace area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Why Our Marketplace');
    }
}