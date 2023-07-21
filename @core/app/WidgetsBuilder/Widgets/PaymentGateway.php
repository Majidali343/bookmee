<?php

namespace App\WidgetsBuilder\Widgets;

use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;

class PaymentGateway extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image')
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

        $repeater_data = $settings['contact_page_contact_info_01'];
        $payment_gateway_markup = '';

        foreach ($repeater_data['url_'] as $key => $url) {
            $image = render_image_markup_by_attachment_id($repeater_data['image_'][$key]); 
            $url = $url;
            $payment_gateway_markup.= <<<PAYMENTGATEWAY
            <li class="list">
                <a href="{$url}">{$image}</a>
            </li>

PAYMENTGATEWAY;
    }
   
   return <<<HTML
    <div class="col-lg-4 col-md-6">
    <div class="copyright-payment">
        <!-- <ul class="payment-list">
            {$payment_gateway_markup}
        </ul> -->
    </div>
</div>
HTML;
    }

    public function widget_title()
    {
        return __('Payment Gateway');
    }

}