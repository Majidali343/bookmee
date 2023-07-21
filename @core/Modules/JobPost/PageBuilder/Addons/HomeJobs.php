<?php


namespace Modules\JobPost\PageBuilder\Addons;

use App\PageBuilder\Fields\ColorPicker;
use App\JobPost;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Modules\JobPost\Entities\BuyerJob;
use Str;


class HomeJobs extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/popular_service_2.png';
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
            'name' => 'explore_all',
            'label' => __('Explore Text'),
            'value' => $widget_saved_values['explore_all'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'explore_link',
            'label' => __('Explore Link'),
            'value' => $widget_saved_values['explore_link'] ?? null,
            'info' => __('enter the link where you want to redirect users after click'),
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
        $output .= Text::get([
            'name' => 'book_appointment',
            'label' => __('Apply Now Button Text'),
            'value' => $widget_saved_values['book_appointment'] ?? 'Apply Now',
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }


    public function frontend_render() : string
    {
        $settings = $this->get_settings();
        $section_title =$settings['title'] ?? 'New Jobs';
        $explore_text =$settings['explore_all'] ?? 'Explore All';
        $explore_link =$settings['explore_link']?? '#';
        $items =$settings['items'] ?? 4;
        $book_now_text = $settings['book_now'] ??  'Apply Now';
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];

        $job_markup ='';
        $no_job_found = __('No Jobs Found');
        $current_date = date('Y-m-d h:i:s');

        $all_jobs = BuyerJob::where('status', 1)
            ->where('is_job_on', 1)
            ->where('dead_line', '>=' ,$current_date)
            ->OrderBy('id','DESC')
            ->take($items)->get();

        if($all_jobs->count() > 0){

            foreach ($all_jobs as $job)
            {
                $image =  render_background_image_markup_by_attachment_id($job->image,'','','thumb');
                $title =  $job->title;
                $slug =  $job->slug;
                $route = route('job.post.details',$slug);
                $buyer_about_route = route('about.buyer.profile',optional($job->buyer)->username);
                $description =  Str::limit(strip_tags($job->description),100);
                $price =  amount_with_currency_symbol($job->price);
                $buyer_image =  render_image_markup_by_attachment_id(optional($job->buyer)->image,'','','thumb');
                $buyer_name =  optional($job->buyer)->name;
                $job_country =  optional($job->country)->country;
                $job_city =  optional($job->city)->service_city;
                if($job_country){
                    $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' '.$job_country .' , '. $job_city .'</span>';
                }else{
                    $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' Online'.'</span>';
                }

                $is_job_hired = $job->job_request->where('is_hired',1)->count() ?? 0;
                $hired = __('Already Hired');

                if($is_job_hired >= 1){
                    $apply = '<a href="javascript:void(0)" class="btn btn-danger w-100" disabled>'.$hired.'</a>';
                }else{
                    $apply = '<a href="'.$route.'" class="cmn-btn btn-small btn-bg-1 w-100">'.$book_now_text.' </a>';
                }
                $stating_at = __('Starting at');
                $job_markup.= <<<JOBS
                <div class="col-lg-3 col-md-6 margin-top-30">
                      <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                        <a href="$route" class="service-thumb">
                            <div class="service-thumb service-bg-thumb-format" {$image}></div>
                            <div class="country_city_location">
                                {$job_location}
                            </div>
                        </a>
                        <div class="services-contents">
                            <ul class="author-tag">
                                <li class="tag-list">
                                    <a href="#">
                                        <div class="authors">                                        
                                            <div class="thumb">
                                                {$buyer_image}
                                                <span class="notification-dot"></span>
                                            </div>
                                           <a href="{$buyer_about_route}">
                                             <span class="author-title"> {$buyer_name} </span>
                                             </a>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <h5 class="common-title"> <a href="$route"> {$title} </a> </h5>
                            <p class="common-para">{$description}</p>
                            <div class="service-price">
                                <span class="starting"> {$stating_at} </span>
                                <span class="prices">{$price}</span>
                            </div>
                            <div class="btn-wrapper d-flex flex-wrap">
                                {$apply}
                            </div>
                        </div>
                    </div>
                </div>
            JOBS;
            }
        }else{
            $job_markup.= <<<JOBS
                <div class="col-lg-12 margin-top-30">
                   <h5 class="common-title text-center text-danger"> {$no_job_found}</h5>
                </div>
            JOBS;
        }

        return <<<HTML
    <!-- Popular Service area starts -->
    <section class="services-area"  data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title">{$section_title}</h3>
                        <a href="{$explore_link}" class="section-btn">{$explore_text}</a>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                    {$job_markup}
            </div>
        </div>
    </section>
    <!-- Popular Service area end -->
    
HTML;

    }

    public function addon_title()
    {
        return __('Home Jobs');
    }
}