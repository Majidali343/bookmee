<?php

namespace App\WidgetsBuilder\Widgets;
use App\Helpers\LanguageHelper;
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

class SocialMediaTwoWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $this->setting_item('title_' . $lang->slug) ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab



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
            'name' => 'pinterest_icon',
            'label' => __('Pinterest Icon'),
            'value' => $widget_saved_values['pinterest_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'pinterest_url',
            'label' => __('Pinterest URL'),
            'value' => $widget_saved_values['pinterest_url'] ?? null,
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
            'name' => 'linkedin_icon',
            'label' => __('Linkedin Icon'),
            'value' => $widget_saved_values['linkedin_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'linkedin_url',
            'label' => __('Linkedin URL'),
            'value' => $widget_saved_values['linkedin_url'] ?? null,
          ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $title =  purify_html($settings['title_'.$current_lang]);

        $facebook_icon = $settings['facebook_icon'];
        $facebook_url =  $settings['facebook_url'];
        $linkedin_icon = $settings['linkedin_icon'];
        $linkedin_url =  $settings['linkedin_url'];
        $instagram_icon = $settings['instagram_icon'];
        $instagram_url =  $settings['instagram_url'];
        $pinterest_icon = $settings['pinterest_icon'];
        $pinterest_url =  $settings['pinterest_url'];


    return <<<HTML

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="footer-widget">
            <div class="content">
                <h4 class="title">{$title}</h4>
                <ul class="social-link-list">
                    <li class="list-item">
                        <a href="{$facebook_url}">
                            <i class="{$facebook_icon} icon-s"></i>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{$instagram_url}">
                            <i class="{$instagram_icon} icon-s"></i>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{$linkedin_url}">
                            <i class="{$linkedin_icon} icon-s"></i>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{$pinterest_url}">
                            <i class="{$pinterest_icon} icon-s"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
HTML;
}

    public function widget_title()
    {
        return __('Social Media Two');
    }

}