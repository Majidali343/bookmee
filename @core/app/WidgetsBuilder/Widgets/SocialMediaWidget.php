<?php

namespace App\WidgetsBuilder\Widgets;
use App\Helpers\SanitizeInput;
use App\Language;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use Mews\Purifier\Facades\Purifier;

class SocialMediaWidget extends WidgetBase
{

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();



        $output .= IconPicker::get([
            'name' => 'facebook_icon',
            'label' => __('Facebook Icon'),
            'value' => $widget_saved_values['facebook_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'facebook_url',
            'label' => __('Facebook URL'),
            'value' => $widget_saved_values['facebook_url'] ?? null,
        ]);

        $output .= IconPicker::get([
            'name' => 'twitter_icon',
            'label' => __('Twitter Icon'),
            'value' => $widget_saved_values['twitter_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'twitter_url',
            'label' => __('Twitter URL'),
            'value' => $widget_saved_values['twitter_url'] ?? null,
        ]);

        $output .= IconPicker::get([
            'name' => 'instagram_icon',
            'label' => __('Instagram Icon'),
            'value' => $widget_saved_values['instagram_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'instagram_url',
            'label' => __('Instagram URL'),
            'value' => $widget_saved_values['instagram_url'] ?? null,
        ]);

        $output .= IconPicker::get([
            'name' => 'google_icon',
            'label' => __('Google Icon'),
            'value' => $widget_saved_values['google_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'google_url',
            'label' => __('Google URL'),
            'value' => $widget_saved_values['google_url'] ?? null,
          ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();

        $facebook_icon = $settings['facebook_icon'];
        $facebook_url =  $settings['facebook_url'];
        $twitter_icon = $settings['twitter_icon'];
        $twitter_url =  $settings['twitter_url'];
        $instagram_icon = $settings['instagram_icon'];
        $instagram_url =  $settings['instagram_url'];
        $google_icon = $settings['google_icon'];
        $google_url =  $settings['google_url'];


    return <<<HTML
     <div class="col-md-12 col-lg-3">
        <div class="footer-widget">
            <ul class="social-icon-list">
                 <ul class="social-icon-list">
                        <li class="list-item"><a href="{$facebook_url}">
                                <i class="{$facebook_icon} icon"></i>
                            </a></li>
                        <li class="list-item"><a href="{$twitter_url}">
                                <i class="{$twitter_icon} icon"></i>
                            </a></li>
                        <li class="list-item"><a href="{$instagram_url}">
                                <i class="{$instagram_icon} icon"></i>
                            </a></li>
                        <li class="list-item"><a href="{$google_url}">
                                <i class="{$google_icon} icon"></i>
                            </a></li>
                    </ul>
            </ul>
        </div>
    </div>
    
HTML;
}

    public function widget_title()
    {
        return __('Social Media');
    }

}