<?php


namespace Modules\Subscription\PageBuilder\Addons;

use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Subscription\Entities\Subscription;

class PricePlan extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'price_plan/price_plan.png';
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
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
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


    public function frontend_render(): string
    {
        if (!moduleExists('Subscription') || !Route::has('seller.subscription.buy')) {
            return '';
        }

        $settings = $this->get_settings();
        $title = $settings['title'];
        $title_text_color = $settings['title_text_color'];
        $explode = explode(" ", $title);
        $title_start = current($explode);
        $title_end = end($explode);
        $subtitle = $settings['subtitle'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $subscription_text = __('You must pay first to buy a subscription');
        $close_text = __('Close');
        $buy_now_text = __('Buy Now');
        $apply = __('Apply');
        $number_of_connect = get_static_option('set_number_of_connect',2);

        $connect_text = sprintf(__('Connect to get order from buyer, each order will deduct %d connect from seller account.'),$number_of_connect);
        $route = route('seller.subscription.buy');
        $csrf_token = csrf_token();

        $payment_gateway = \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(false);
         $wallet_gateway = '';
        if (moduleExists('Wallet')) {
            $wallet_gateway = \App\Helpers\PaymentGatewayRenderHelper::renderWalletForm();
        }

        $login_user_type='';
        if(Auth::guard('web')->check()){
            $login_user_type = Auth::guard('web')->user()->user_type == 0 ? 'seller' : '';
        }

        $abc = get_static_option('site_manual_payment_name');
        $abcd = get_static_option('site_manual_payment_description');
        $receipt = __('Receipt');

        $form = <<<FORM
    <div class="form-group">
        <div class="label mt-3 mb-2">$abc  $receipt</div>
        <input type="file" name="manual_payment_image" class="form-control" style="line-height: 1.15">
    </div>
    <div class="manual_description">
       $abcd
    </div>
FORM;

        // price plan Coupon code
        $coupon_placeholder = __('Enter Coupon Code');
        if(!empty(get_static_option('manual_payment_gateway'))){
            $form;
        }
        $price_plan_markup= '';
        $subscriptions = Subscription::where('status',1)->get();

        foreach($subscriptions as $subscription) {
            $s_id = $subscription->id;
            $s_title = $subscription->title;
            $type = $subscription->type;
            $price = float_amount_with_currency_symbol($subscription->price);
            $connect = $type == 'lifetime' ? __('No limit') : $subscription->connect;
            $price_without_currency_symbol = $subscription->price;
            $image = render_image_markup_by_attachment_id($subscription->image);
            $month_text = $type; //ucfirst(substr($type,0,2));
            $typeText = $type == 'lifetime' ? __('package user will charge only once') : __('billing cycle, system will deduct this amount from seller account, if seller has balance, otherwise will send an invoice mail to pay the bill');
            $buy_now_markup='';
            if ($type == 'lifetime'){
                $connect_text = __('this package will get unlimited number of connect, mean no need to purchase subscription again.');
            }
            if($login_user_type == 'seller'){
                $buy_now_markup.=<<<BUYNOWMARKUP
                <div class="btn-wrapper">
                    <a href="#"
                    class="cmn-btn btn-outline-1 get_subscription_id" 
                    data-toggle="modal"  
                    data-target="#buySubscriptionModal"
                    data-id="{$s_id}"
                    data-type="{$type}"
                    data-price="{$price_without_currency_symbol}"
                    data-connect="{$connect}"
                        >{$buy_now_text}</a>
                  </div>
                BUYNOWMARKUP;
            }else{
                $buy_now_markup.=<<<BUYNOWMARKUP
                <div class="btn-wrapper">
                    <span href="#" 
                    class="cmn-btn btn-outline-1 get_subscription_id"
                        style="cursor:no-drop; opacity:0.4">{$buy_now_text}</span>
                  </div>
                BUYNOWMARKUP;
            }
            $service = $subscription->type == 'lifetime' ? __('No limit') : $subscription->service;
            $job = $subscription->type == 'lifetime' ? __('No limit') : $subscription->job;
            $service_text = sprintf(__('Seller can create <strong>%s</strong> Services Maximum.'),$service );
            $job_text = sprintf(__('Seller can create <strong>%s</strong> Jobs Maximum.'), $job);
            $price_plan_markup.= <<<PRICEPLAN
               <div class="col-lg-4 col-md-6 mt-5">
                    <div class="pricing-table-10">
                        <div class="icon-area">
                            $image
                            <h3 class="title">$s_title</h3>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><b>$type</b> $typeText</li>
                                <li><b>$connect</b> $connect_text</li>                               
                                <li> $service_text</li>                               
                                <li>$job_text</li>                               
                            </ul>
                        </div>
                                              
                        
                        <div class="price-footer">
                            <div class="price">
                                <span class="dollar"></span>{$price}<span class="month">/$month_text</span>
                            </div>
                           {$buy_now_markup}
                        </div>
                    </div>
                </div>
            PRICEPLAN;
        }

        return <<<HTML

     <!-- About area Starts -->
     <section class="About-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-55">
                        <!-- <h2 class="title"> {$title_start} <span style="color:{$title_text_color}"> {$title_end} </span> </h2> -->
                        <span class="section-para">Here is a Default plan for you!We will add more in the future</span>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 mt-5">
                    <div class="pricing-table-10">
                        <div class="icon-area">
                            <img src="assets/uploads/media-uploader/gold-medal1662725592.png" />
                            <h3 class="title">Vendor</h3>
                        </div>
                        <div class="price-body">
                            <ul>
                                <li><b>Monthly</b> billing cycle, system will deduct this
                                amount from seller account, if seller has
                                balance, otherwise will send an invoice mail to
                                pay the bill</li>
                                <li><b>150</b> Connect to get order from buyer, each
                                order will deduct 2 connect from seller
                                account.</li>                               
                                <li>Seller can create 10 Services Maximum.</li>                               
                                <li>Seller can create 15 Jobs Maximum.</li>                               
                            </ul>
                        </div>
                                              
                        
                        <div class="price-footer">
                            <div class="price" style="color: #03989E;">
                                <span class="dollar"></span>Free<span class="month"> /monthly</span>
                            </div>
                            <button type="button" class="btn" style="margin-bottom:20px;background: #c1c7c7;color:#fff;">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About area ends -->
    
        <!-- Add Modal -->
    <div class="modal fade" id="buySubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="couponModal" aria-hidden="true">
        <form id="msform" class="ms-order-form" action="{$route}" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{$csrf_token}">
            <input type="hidden" name="subscription_id" class="subscription_id" value="">
            <input type="hidden" name="type" class="type" value="">
            <input type="hidden" name="price" class="price" value="">
            <input type="hidden" name="connect" class="connect" value="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning" id="couponModal">{$subscription_text}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="confirm-bottom-content">
                            {$wallet_gateway}
                            <div class="confirm-payment payment-border">
                                <div class="single-checkbox">
                                    <div class="checkbox-inlines">
                                        <label class="checkbox-label" for="check2">
                                            {$payment_gateway}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="order cart-total">
                                    <div class="form-group">
                                        <input type="hidden" value="" id="subscription_price">
                                        <p class="display_error_msg"></p>
                                        <p class="display_coupon_amount"></p>
                                       <div class="subscription-coupon-btn-group">
                                            <input type="text" name="apply_coupon_code" id="apply_coupon_code" class="form-control mt-2" style="line-height: 1.15" placeholder="{$coupon_placeholder}">
                                            <button type="button" class="btn btn-success coupon_apply_btn">{$apply}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{$close_text}</button>
                        <button type="submit" class="btn btn-primary order_create_from_jobs">{$buy_now_text}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
HTML;

    }

    public function addon_title()
    {
        return __('Price Plan');
    }
}


