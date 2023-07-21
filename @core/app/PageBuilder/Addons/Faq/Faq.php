<?php


namespace App\PageBuilder\Addons\Faq;

use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Category;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\ServiceCity;
use App\User;

class Faq extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'faq/faq.png';
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
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];

        $repeater_data = $settings['contact_page_contact_info_01'];
        $faq_markup = '';

        foreach ($repeater_data['title_'] as $key => $title) {
            $title = $title;
            $description = $repeater_data['description_'][$key];
            

            $faq_markup.= <<<SERVICE

            <div class="faq-item wow fadeInLeft" data-wow-delay=".2s">
                <div class="faq-title">
                  {$title}
                </div>
                <div class="faq-panel">
                    <p class="faq-para">{$description}</p>
                </div>
            </div>

SERVICE;
    }


return <<<HTML
 <!-- FAQ Area starts -->
 <div class="faq-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 margin-top-30">
                    <div class="faq-contents">
                        {$faq_markup}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Area ends -->

    
HTML;
}

    public function addon_title()
    {
        return __('Faq');
    }
}