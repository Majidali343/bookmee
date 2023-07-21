<?php


namespace App\PageBuilder\Addons\BecomeSeller;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Fields\Image;

class BecomeSellerTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/become_seller_2.png';
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
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= ColorPicker::get([
            'name' => 'btn_color',
            'label' => __('Button Color'),
            'value' => $widget_saved_values['btn_color'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);
        $output .= Text::get([
            'name' => 'btn_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['btn_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'btn_link',
            'label' => __('Button Link'),
            'value' => $widget_saved_values['btn_link'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'circle_1',
            'label' => __('Circle One Image'),
            'value' => $widget_saved_values['circle_1'] ?? null,
            'max' => 500,
            'dimensions' => '70x70'
        ]);
        $output .= Image::get([
            'name' => 'circle_2',
            'label' => __('Circle Two Image'),
            'value' => $widget_saved_values['circle_2'] ?? null,
            'max' => 500,
            'dimensions' => '164x164'
        ]);
        $output .= Image::get([
            'name' => 'dot_square',
            'label' => __('Dot Square Image'),
            'value' => $widget_saved_values['dot_square'] ?? null,
            'max' => 500,
            'dimensions' => '138x138'
        ]);
        $output .= Image::get([
            'name' => 'line_cross',
            'label' => __('Line Cross Image'),
            'value' => $widget_saved_values['line_cross'] ?? null,
            'max' => 500,
            'dimensions' => '222x139'
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

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }
    

    public function frontend_render() : string
    {
        
        $settings = $this->get_settings();
        $title =$settings['title'];
        $subtitle = $settings['subtitle'];


        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $btn_color = $settings['btn_color'];
        $btn_text = $settings['btn_text'];
        $btn_link = $settings['btn_link'];
        if(empty($settings['btn_link'])){
            $btn_link = route('user.register',['type' => 'seller']);
        }
        $circle_1 = render_image_markup_by_attachment_id($settings['circle_1']);
        $circle_2 = render_image_markup_by_attachment_id($settings['circle_2']); 
        $dot_square = render_image_markup_by_attachment_id($settings['dot_square']); 
        $line_cross = render_image_markup_by_attachment_id($settings['line_cross']);

return <<<HTML

     <!-- Join Area Starts -->
     <section class="join-area gradient-bg-2"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="join-shapes">
           {$circle_1}
           {$circle_2}
           {$dot_square}
           {$line_cross}          
        </div>
        <div class="container container-two">
            <div class="join-content-wrapper">
                <div class="join-contents">
                    <h2 class="title">{$title}</h2>
                    <span class="join-para">{$subtitle}</span>
                    <div class="btn-wrapper margin-top-50">
                        <a href="{$btn_link}" class="cmn-btn btn-bg-3" style="background:{$btn_color}">{$btn_text} </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Join Area Ends -->
    
HTML;

}

    public function addon_title()
    {
        return __('Start As Seller: 02');
    }
}