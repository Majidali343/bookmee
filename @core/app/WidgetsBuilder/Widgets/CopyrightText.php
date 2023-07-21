<?php

namespace App\WidgetsBuilder\Widgets;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Text;

class CopyrightText extends WidgetBase
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
            'info' => __('use'). ' {copy} {year}'.__('for dynamicaly show year and copyright sign')
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = purify_html(str_replace(['{copy}','{year}'],['©',date('Y')],$settings['title']));
   
   return <<<HTML
   <div class="col-lg-4 col-md-6">
    <div class="copyright-contents">
        <span>{$title}</span>
    </div>
</div>
HTML;
    }

    public function widget_title()
    {
        return __('Copyright Text');
    }

}