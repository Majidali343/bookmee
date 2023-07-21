<?php

namespace App\PageBuilder\Addons\Contact;

use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;

class ContactInfo extends PageBuilderBase
{

    public function preview_image()
    {
        return 'contact_page/contact.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


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
                    'name' => 'description_1',
                    'label' => __('Description One'),
                    'info' => __('new line count as a separate text')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'description_2',
                    'label' => __('Description Two'),
                    'info' => __('new line count as a separate text')
                ],

            ]
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

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;

    }

    public function frontend_render()
    {

        $settings = $this->get_settings();

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];


        $repeater_data = $settings['contact_page_contact_info_01'];
        $contact_info_markup = '';

        foreach ($repeater_data['title_'] as $key => $title) {
            
            $title = $title;
            $icon = $repeater_data['icon_'][$key];
            $description_1 = $repeater_data['description_1_'][$key];
            $description_2 = $repeater_data['description_2_'][$key];
            

            $contact_info_markup.= <<<SERVICE
            <div class="col-lg-4 col-sm-6 margin-top-30">
                <div class="single-contacts wow fadeInUp" data-wow-delay=".2s">
                    <div class="contact-icon">
                        <i class="{$icon}"></i>
                    </div>
                    <div class="contacts-contents">
                        <h4 class="title"> {$title} </h4>
                        <div class="item-contents">
                            <span class="item"> <a href="#"> {$description_1} </a> </span>
                            <span class="item"> <a href="#"> {$description_2} </a> </span>
                        </div>
                    </div>
                </div>
            </div>

SERVICE;
    }
        


    return <<<HTML
    <section class="contact-promo-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                {$contact_info_markup}
            </div>
        </div>
    </section>
HTML;

    }

    public function addon_title()
    {
        return __('Contact Info');
    }
}