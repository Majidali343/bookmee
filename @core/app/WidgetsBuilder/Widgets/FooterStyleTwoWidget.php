<?php

namespace App\WidgetsBuilder\Widgets;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Mews\Purifier\Facades\Purifier;

class FooterStyleTwoWidget extends WidgetBase
{

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
                'name' => 'email_title_'.$lang->slug,
                'label' => __(' Email Title'),
                'value' => $widget_saved_values['email_title_'.$lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'email_'.$lang->slug,
                'label' => __(' Email'),
                'value' => $widget_saved_values['email_'.$lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'follow_title_'.$lang->slug,
                'label' => __(' Follow Title'),
                'value' => $widget_saved_values['follow_title_'.$lang->slug] ?? null,
            ]);


            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

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
        $image_id = SanitizeInput::esc_html($settings['site_logo']);
        $image_url = SanitizeInput::esc_html($settings['site_logo']);
        $image = render_image_markup_by_attachment_id($image_id,null,'full');

        $logo = render_image_markup_by_attachment_id($image_url);
        $logo_url = url('/');
        $facebook_url = $widget_saved_values['facebook_url'] ?? '';
        $twitter_url = $widget_saved_values['twitter_url'] ?? '';
        $instagram_url = $widget_saved_values['instagram_url'] ?? '';
        $google_url = $widget_saved_values['google_url'] ?? '';


        $output = $this->widget_before(); //render widget before content

        return <<<HTML
     <footer class="footer-area index-04">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="footer-widget">
                            <div class="content">
                                <h4 class="title">Email</h4>
                                <p class="email">contact@mail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="footer-widget">
                            <div class="logo-wrapper bodr">
                                <a href="index.html" class="logo">
                                    <img src="assets/img/logo/Logo-04.png" alt="logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="footer-widget">
                            <div class="content">
                                <h4 class="title">Follow me</h4>
                                <ul class="social-link-list">
                                    <li class="list-item">
                                        <a href="#">
                                            <i class="lab la-facebook-f icon-s"></i>
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#">
                                            <i class="lab la-instagram icon-s"></i>
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#">
                                            <i class="lab la-linkedin-in icon-s"></i>
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a href="#">
                                            <i class="lab la-pinterest-p icon-s"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
       
HTML;
    }

    public function widget_title()
    {
        return __('Footer Style : 02');
    }

}