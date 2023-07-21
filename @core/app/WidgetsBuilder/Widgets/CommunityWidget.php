<?php

namespace App\WidgetsBuilder\Widgets;

use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;

class CommunityWidget extends WidgetBase
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
            'name' => 'seller_title',
            'label' => __('Become Seller Title'),
            'value' => $widget_saved_values['seller_title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'seller_link',
            'label' => __('Become Seller Link'),
            'value' => $widget_saved_values['seller_link'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'buyer_title',
            'label' => __('Become Buyer Title'),
            'value' => $widget_saved_values['buyer_title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'buyer_link',
            'label' => __('Become Buyer Link'),
            'value' => $widget_saved_values['buyer_link'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        
        $settings = $this->get_settings();
        $title = purify_html($settings['title'] ?? '');
        $seller_title = purify_html($settings['seller_title'] ?? '');
        $seller_link = purify_html($settings['seller_link'] ?? '');
        $buyer_title = purify_html($settings['buyer_title'] ?? '');
        $buyer_link = purify_html($settings['buyer_link'] ?? '');

        $community_markup = '';

        if($seller_link==''){
            $seller_link = route('user.register',['type'=>'seller']);
        }

        if($buyer_link==''){
            $buyer_link = route('user.register',['type'=>'buyer']);
        }

        $community_markup.= <<<SOCIALICON
        <li class="lists">
            <li class="list"><a href='price-plan'>Subscribtion Plan</a></li>
        </li>
        <li class="lists">
            <li class="list"><a href='about'>About Us</a></li>
        </li>
        <li class="lists">
        <li class="list"><a href='contact'>Contact Us</a></li>
        </li>
       

SOCIALICON;

   
   return <<<HTML
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget widget">
                <h6 class="widget-title">{$title}</h6>
                <div class="footer-inner">
                    <ul class="footer-link-list">
                        {$community_markup}
                    </ul>
                </div>
            </div>
        </div>
HTML;
    }

    public function widget_title()
    {
        return __('Community');
    }

}