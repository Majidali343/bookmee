<?php

namespace App\WidgetsBuilder\Widgets;

use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;

class ContactInfoWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

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
            'name' => 'address',
            'label' => __('Address'),
            'value' => $widget_saved_values['address'] ?? null,
        ]);
        $output .= IconPicker::get([
            'name' => 'address_icon',
            'label' => __('Address Icon'),
            'value' => $widget_saved_values['address_icon'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'phone',
            'label' => __('Phone'),
            'value' => $widget_saved_values['phone'] ?? null,
        ]);
        $output .= IconPicker::get([
            'name' => 'phone_icon',
            'label' => __('Phone Icon'),
            'value' => $widget_saved_values['phone_icon'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'email',
            'label' => __('Email'),
            'value' => $widget_saved_values['email'] ?? null,
        ]);
        $output .= IconPicker::get([
            'name' => 'email_icon',
            'label' => __('Email Icon'),
            'value' => $widget_saved_values['email_icon'] ?? null,
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
                    'name' => 'url',
                    'label' => __('Url')
                ],
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = purify_html($settings['title']);
        $address = purify_html($settings['address']);
        $address_icon = purify_html($settings['address_icon']);
        $phone = purify_html($settings['phone']);
        $phone_icon = purify_html($settings['phone_icon']);
        $email = purify_html($settings['email']);
        $email_icon = purify_html($settings['email_icon']);

        $repeater_data = $settings['contact_page_contact_info_01'];
        $social_icon_markup = '';

        foreach ($repeater_data['icon_'] as $key => $icon) {
            $icon = $icon;
            $url = $repeater_data['url_'][$key];
            $social_icon_markup.= <<<SOCIALICON
            <li class="lists">
                <a class="facebook" href="{$url}"> <i class="{$icon}"></i> </a>
            </li>

SOCIALICON;
    }
   
   return <<<HTML
   <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer-widget widget">
            <h6 class="widget-title">{$title}</h6>
            <div class="footer-inner">
                <ul class="footer-link-address">
                    <li class="list"><span class="address"> <i class="{$address_icon}"></i> {$address}</span></li>
                    <li class="list"> <span class="address"> <i class="{$phone_icon}"></i> {$phone}</span></li>
                    <li class="list"> <span class="address"> <i class="{$email_icon}"></i> {$email}</span></li>
                </ul>
                <div class="footer-socials">
                    <ul class="footer-social-list">
                        {$social_icon_markup}
                    </ul>
                </div>
            </div>
        </div>
</div>    
HTML;
    }

    public function widget_title()
    {
        return __('Contact Info');
    }

}