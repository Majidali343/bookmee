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

class PaymentWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'site_logo',
            'label' => __('Site Logo'),
            'value' => $widget_saved_values['site_logo'] ?? null,
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $image_url = SanitizeInput::esc_html($this->setting_item('site_logo'));
        $image = render_image_markup_by_attachment_id($image_url,null,'full');;
        $logo_url = url('/');
        $condition_for_logo = get_static_option('site_frontend_dark_mode')  == 'on' ? render_image_markup_by_attachment_id(get_static_option('site_white_logo')) : $image;


        return <<<HTML
        <div class="col-md-12 col-lg-3">
            <div class="footer-widget">
                <div class="logo-wrapper">
                    <a href="{$logo_url}" class="logo">
                      {$condition_for_logo}
                    </a>
                </div>
            </div>
        </div>
HTML;
    }

    public function widget_title()
    {
        return __('Only Logo');
    }

}