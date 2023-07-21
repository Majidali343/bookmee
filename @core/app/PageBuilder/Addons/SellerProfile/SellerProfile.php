<?php
namespace App\PageBuilder\Addons\SellerProfile;
use App\Order;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Review;
use App\User;
use Session;
class SellerProfile extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;
    public function preview_image()
    {
        return 'seller/profile.png';
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
            'info' => __('enter title')
        ]);
        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 100,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 100,
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
    public function frontend_render(): string
    {
        $newdata = '';
        $seller ='';
        $settings = $this->get_settings();
        $order_by = $settings['order_by'];
        $IDorDate = $settings['order'];
        $items = $settings['items'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $profile_markup = '';
        $section_title = $settings['title'];
        $seller_lists = User::whereNotNull('image')->where(['user_type' => 0, 'user_status' => 1])->where('service_city', Session('cityid'))->orderBy($order_by, $IDorDate)->take($items)->get();
        foreach ($seller_lists as $seller) {
            $seller_name =  $seller->name;
            $seller_username =  $seller->username;
            $img_url = get_attachment_image_by_id($seller->image);
            if (isset($img_url['img_url'])) {
                $seller_image =  render_background_image_markup_by_attachment_id($seller->image);
            } else {
                $seller_image = 'style="background-image:url(' . asset('assets/uploads/no-image.png') . ')"';
            }
            $seller_since = User::select('created_at')->where('id', $seller->id)->where('user_status', 1)->first();
            $completed_order = Order::where('seller_id', $seller->id)->where('status', 2)->count() ?? ' ';
            $seller_rating = Review::where('seller_id', $seller->id)->avg('rating');
            $seller_rating_percentage_value = ceil($seller_rating * 20) ?? ' ';
            $service_rating = Review::where('seller_id', $seller->id)->avg('rating');
            $service_reviews = Review::where('seller_id', $seller->id)->get();
            $verify_text = __('This seller is verified by the site admin according his national id card.');
            $from = __('From');
            $since = __('Seller Since');
            $staricon = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#03989e}</style><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>';
            $order_completed_text = __($seller_rating_percentage_value . '%  ' . 'Customer Satisfaction ' . '<span class="star">' . $staricon . '</span>');
            $str = $section_title;
            $data =  explode(' ', $str, 3);
            $newdata = __('<span class="halftext">' . $data[0] . " " . $data[1] . '</span>' . " " . $data[2]);
            $seller_rating_text = __('Seller Rating');
            $profile_page = route('about.seller.profile', $seller_username);
            $seller_verify = '';
            if (optional($seller->sellerVerify)->status == 1) {
                $seller_verify = '<div data-toggle="tooltip" data-placement="top" title="' . $verify_text . '">
                        <span class="seller-verified"> <i class="las la-check"></i> </span>
                    </div>';
            }
            $service_rating_and_review = '';
            if ($service_rating >= 1) {
                $service_rating_and_review = '<div class="profiles-review">
                    <span class="reviews">
                        <b>' . ratting_star(round($service_rating, 1)) . '</b>
                        (' . $service_reviews->count() . ')
                    </span>
                </div>';
            }
            $seller_country = '<li>' . $from . '<span>' . optional($seller->country)->country . '</span> </li>';
            $seller_since = '<li>' . $since . '<span>' . \Carbon\Carbon::parse($seller_since->created_at)->year . '</span> </li>';
            // $profile_markup.=<<<PROFILE
            // <div class="col-lg-3 col-md-6">
            //     <div class="single_seller_profile">
            //         <div class="thumb" {$seller_image}></div>
            //         <div class="content_area_wrap">
            //             <h4 class="title">
            //                 <a href="{$profile_page}">$seller_name</a>
            //                 {$seller_verify}
            //             </h4>
            //             $service_rating_and_review
            //             <span class="order_completation"> {$order_completed_text}</span>
            //         </div>
            //     </div>
            // </div>
            // PROFILE;
                $profile_markup .= <<<PROFILE
                <div class="col-lg-3 col-md-6">
                    <div class="single_seller_profile">
                        <div class="thumb" {$seller_image}></div>
                        <div class="content_area_wrap">
                            <h4 class="title">
                                <a href="{$profile_page}">$seller_name</a>
                                {$seller_verify}
                            </h4>
                            $service_rating_and_review
                            <span class="order_completation"> {$order_completed_text}</span>
                        </div>
                    </div>
                </div>
            PROFILE;
        }
        // {$completed_order}
        $explore_link = route('all.sellers');
        $explore_text = __('Explore All');
        if (!is_null($seller)) :
            return <<<HTML
        <div class="banner-inner-area section-bg-2" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
            <div class="container container-two">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-two-seller mb-5">
                            <h3 class="title">{$newdata}</h3>
                            <!-- <a href="{$explore_link}" class="section-btn">{$explore_text}</a> -->
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    {$profile_markup}
                </div>
            </div>
        </div>
HTML;
        endif;
    }
    public function addon_title()
    {
        return __('Seller Profile');
    }
}