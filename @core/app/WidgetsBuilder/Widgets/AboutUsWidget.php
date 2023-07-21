<?php

namespace App\WidgetsBuilder\Widgets;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Fields\Image;

class AboutUsWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Textarea::get([
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'image',
            'label' => __('Site Logo'),
            'value' => $widget_saved_values['image'] ?? null,
            'dimensions' => '173x41'
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $description = purify_html($settings['description']);
        $route = route('homepage');
        $logo = render_image_markup_by_attachment_id($settings['image']);
   
   return <<<HTML
   <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer-widget widget ">
            <div class="about_us_widget">
                <a href="{$route}" class="footer-logo">{$logo}</a>
            </div>
            <div class="footer-inner">
                <p class="footer-para">{$description}</p>
            </div>
        </div>  
    </div>
HTML;
    }

    public function widget_title()
    {
        return __('About Us');
    }

}