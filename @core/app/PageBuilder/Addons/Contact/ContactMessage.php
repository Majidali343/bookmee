<?php

namespace App\PageBuilder\Addons\Contact;

use App\FormBuilder;
use App\Helpers\FormBuilderCustom;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;

class ContactMessage extends PageBuilderBase
{

    public function preview_image()
    {
        return 'contact_page/contact_message.png';
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
            'value' => $widget_saved_values['title'] ?? 260,
            'max' => 500,
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
        $output .= Select::get([
            'name' => 'custom_form_id',
            'label' => __('Custom Form'),
            'placeholder' => __('Select form'),
            'options' => FormBuilder::all()->pluck('title','id')->toArray(),
            'value' =>   $widget_saved_values['custom_form_id'] ?? []
         ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;

    }

    public function frontend_render()
    {

        $settings = $this->get_settings();

        $static_text = static_text();
        $title = SanitizeInput::esc_html($this->setting_item('title'));
        $custom_form_id = SanitizeInput::esc_html($this->setting_item('custom_form_id'));
        $title = $title ?? $static_text['get_in_touch'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
  
      
        if (!empty($custom_form_id)){
            $form = FormBuilder::find($custom_form_id);
            $form_details =  FormBuilderCustom::render_form(optional($form)->id,null,null,'btn-default');
         
        }
        

        

    return <<<HTML
     <!-- Get in touch area Starts -->
     <section class="contact-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title">{$title} </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 padding-top-20">
                    {$form_details}
                </div>
            </div>
        </div>
    </section>
    <!-- Get in touch area ends -->

      
HTML;

    }

    public function addon_title()
    {
        return __('Contact Message');
    }
}