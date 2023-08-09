<?php

namespace App\PageBuilder\Addons\FeatureService;

use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Review;
use App\User;
use App\Service;
use App\ServiceCoupon;
use Illuminate\Support\Str;
use Session;

class TopSalons extends \App\PageBuilder\PageBuilderBase

{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/featured_service.png';
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
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {

        $settings = $this->get_settings();
        $title = $settings['title'];
        $explode = explode(" ", $title);
        $title_start = current($explode);
        $title_end = end($explode);
        $subtitle = $settings['subtitle'];

        //static text helpers
        $static_text = static_text();


        $usersUnfiltered = User::where(['user_status' => 1])->where('service_city', Session('cityid'))->whereNotNull("profile_background")->inRandomOrder()->get();



        $usersFiltered = collect([]);

        foreach ($usersUnfiltered as $user) {
            foreach ($user->services as $service) {
                if ($service->category_id == 8) {
                    $usersFiltered->push($user);
                    break;
                }
            }
            if ($usersFiltered->count() >= 3) {
                break;
            }
        }
        $service_markup = '';
        foreach ($usersFiltered as $service) {
            $image = render_background_image_markup_by_attachment_id($service->profile_background, '', '', 'thumb');
            $title = $service->name;

            $description = \Illuminate\Support\Str::limit($service->about, 150, $end = '...');
            $slug = $service->username;
            // dd($service);

            $seller_rating = Review::where('seller_id', $service->id)->avg('rating');

            ///disount work is here


            $discount_type = ServiceCoupon::where('seller_id', $service->id)
                ->where('status','1')
                ->orderBy('discount', 'desc')
                ->get('discount_type')
                ->first();

            $discount = ServiceCoupon::where('seller_id', $service->id)
                ->max('discount');

            if ($discount_type != null && $discount_type->discount_type == "percentage") {

                $discount = $discount;
            } else if($discount_type != null) {

                $discount_id = ServiceCoupon::where('seller_id', $service->id)
                    ->orderBy('discount', 'desc')
                    ->get('services_ids')
                    ->first();

                if ($discount_id != null) {

                    $discount = $discount;

                    $multiid = $discount_id->services_ids;
                    $arryornot = is_array($multiid);

                    if ($arryornot == false) {


                        $price = Service::where('id', $multiid)->get('price')->first();

                        if ($price) {
                            $percentage = ($discount / $price->price) * 100;

                            $discount = $percentage;
                        }
                    } else {
                        $discount = $discount;

                        $multiid = json_decode($multiid);
                        $id = $multiid[0];
                        $price = Service::where('id', $id)->get('price')->first();


                        $percentage = ($discount / $price->price) * 100;
                        $discount = $percentage;
                    }
                }
            }



            //  dd($seller_rating);
            $numberofratings = Review::where('seller_id', $service->id)
                ->count('service_id');


            $seller_rating_percentage_value = $seller_rating;

            // $ratingsshow =  __($numberofratings . $seller_rating_percentage_value);
            if ($numberofratings > 0) {
                $ratingsshow = "<span  style='font-size:18px;'>  ($numberofratings)  </span>" . "<span>  $seller_rating_percentage_value </span>";
            } else {
                $ratingsshow = "";
            }


            $Title = Str::limit($title, 12, '...');
            $Address = Str::limit($service->address, 26, '...');
            $discount = explode('.', $discount);


            $discountdom = '';
            if (!empty($discount[0])) {
                $discountdom = '<div class="discount" >save upto ' . $discount[0] . '%</div>';
            } else {
                $discountdom = '<div style=" margin-top: 53px" ></div>';
            }


            $service_markup .= <<<SERVICE
            <div class="single-services-item wow fadeInUp" data-wow-delay=".2s"> 
            <div>{$discountdom}</div> 
                <div class="single-service">
                <a href="/{$slug}" class="service-thumb location_relative service-bg-thumb-format" {$image}></a>
                
                    <div class="services-contents">
                        <div>
                            <ul class="author-tag">
                                <li class="tag-list w-100">
                                    <a href="/{$slug}" class="w-100">
                                        <div class="authors d-flex flex-wrap justify-content-between w-100">
                                            <span class="author-title" style="font-size: 24px;"> {$Title}  </span>
                                            <span class="icon review-star"style="font-size: 24px; color:var(--main-color-two)">
                                            {$ratingsshow}
                                               <i style="color:#FFB700;" class="las la-star"></i>
                                            </span>

                                        </div>
                                    </a>
                                </li>
                                <li class="tag-list">

                                </li>
                            </ul>
                            <div>
                                <div>
                                    <span class="icon review-star"style="font-size: 16px; color:var(--main-color-two)">
                                        {$Address}
                                        <i class="las la-map-marker"></i>
                                    </span>
                                </div>
                               
                                <p class="common-para" style="padding-bottom:10px;"></p>
                            </div>

                        </div>
                        <div class="btn-wrapper">
                            <a href="/{$slug}" class="cmn-btn btn-appoinment btn-bg-1" ">View</a>
                        </div>
                    </div>
                </div>
            </div>

SERVICE;
        }

        return <<<HTML

    <!-- Featured Service area starts -->
    <section class="services-area" style="padding-top:60px;padding-bottom:60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10">
                <div class="section-title">
                        <h2 class="title"> <span style="color:#03989E"> {$title_start} </span> {$title_end} </h2>
                        <span class="section-para" >{$subtitle} </span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-50">
                <div class="col-lg-12">
                    <div class="services-slider dot-style-one">
                        {$service_markup}
                    </div>
                </div> 
            </div>
        </div>
    </section>


    <style>
    .service-thumb{
        background-size: cover; 
        background-position: center!important;
    }
    .slick-slide,  .single-service{
        min-height: 450px;
    }
    .single-service{
        display: flex;
        overflow: hidden;
        flex-direction: column;
        justify-content: flex-start;
    }
    .services-contents{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 215px;
        max-height: 350px;
    }
   

      

    .discount{
        position: relative;
        left: 238px;
        top: 63px;
        z-index: 100;
        padding-left: 10px;
        padding-top: 7px;
        Width : 119px;
        Height : 36px;
        border-Radius :60px;
        Gap :10px;
        background-color: #ffffffe6;
        Font-family :"Inter";
        font-Weight : 600;
        Size : 14px;
        color: black;
    }
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px)  {
            .discount{

          left: 210px;
            top: 63px;
        }
        }
   

    </style>
    <!-- Featured Service area end -->

HTML;
    }

    public function addon_title()
    {
        return __('Top Salons');
    }
}
