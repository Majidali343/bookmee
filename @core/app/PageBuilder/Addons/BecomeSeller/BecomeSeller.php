<?php


namespace App\PageBuilder\Addons\BecomeSeller;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Fields\Image;

class BecomeSeller extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/start_as_a_seller.png';
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
        $output .= ColorPicker::get([
            'name' => 'title_text_color',
            'label' => __('Title Text Color'),
            'value' => $widget_saved_values['title_text_color'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);
        $output .= Textarea::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
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
            'name' => 'seller_image',
            'label' => __('Upload Image'),
            'value' => $widget_saved_values['seller_image'] ?? null,
        ]);

        
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'benifits',
                    'label' => __('Benifits')
                ],

            ]
        ]);

        $output .= Switcher::get([
            'name' => 'content_list_show_hide',
            'label' => __('Benefits show/hide'),
            'value' => $widget_saved_values['content_list_show_hide'] ?? null,
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
    

    public function frontend_render() : string
    {
        
        $settings = $this->get_settings();
        $title =$settings['title'];
        $title_text_color =$settings['title_text_color'];
        $explode = explode(" ",$title);
        $title_start = preg_replace('~\\s+\\S+$~', '', $title);
        $title_end = end($explode);
        $subtitle = $settings['subtitle'];
        $content_list_show_hide = $settings['content_list_show_hide'] ??  '';
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $btn_color = $settings['btn_color'];
        $btn_text = $settings['btn_text'];
        $btn_link = $settings['btn_link'];
        if($btn_link==''){
            $btn_link = route('user.register',['type' => 'seller']);
        }
        $seller_image = render_image_markup_by_attachment_id($settings['seller_image']); 
        $repeater_data = $settings['contact_page_contact_info_01'];
        $benifits_markup = '';
        $benifits_markupicon= '<span class="markupicon"><i class="las la-angle-right"></i></span>';

        foreach ($repeater_data['benifits_'] as $key => $benifits) {

            $benifits = $benifits_markupicon.$benifits;
            $benifits_markup.= <<<BENIFITS
            <li class="list">{$benifits}</li>

BENIFITS;
    }
    $content_list_markup = '';
    if(!empty($content_list_show_hide)){
    $content_list_markup .=<<<ABOUNTLIST
    <ul class="seller-list">
        {$benifits_markup}
    </ul>
ABOUNTLIST;
    }

return <<<HTML

    <!-- Seller area starts -->
    <section class="seller-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row align-items-center">
                <div class="col-lg-6 margin-top-30">
                    <div class="seller-wrapper">
                        <div class="section-title text-left ">
                            <h2 class="title text-left"> {$title_start} <span style="color:{$title_text_color}"> {$title_end} </span> </h2>
                            <span class="section-para">{$subtitle}</span>
                        </div>
                        <div class="seller-contents">
                        
                            {$content_list_markup}
                            <div class="btn-wrapper">
                                <a href="{$btn_link}" class="cmn-btn btn-bg-1" style="background:{$btn_color}"> {$btn_text} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 margin-top-30">
                    <div class="seller-thumbs wow slideInRight" data-wow-delay=".2s">
                        {$seller_image}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Seller area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Start As Seller');
    }
}