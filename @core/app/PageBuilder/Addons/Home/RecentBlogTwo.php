<?php


namespace App\PageBuilder\Addons\Home;

use App\Blog;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use Str;

class RecentBlogTwo extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home_three/recent_blog_2.png';
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
        $section_title =$settings['title'];
        if(empty($settings['explore_link'])){
            $explore_link = '#';
        }
        $order_by =$settings['order_by'];
        $IDorDate =$settings['order'];
        $items =$settings['items'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];

        $blogs = Blog::select('id','title','image','blog_content','slug','category_id','created_at')
        ->where(['status'=>'publish'])
        ->take($items)
        ->OrderBy($order_by,$IDorDate)
        ->get();
        
        $blog_markup = '';
        foreach ($blogs as $blog){

            $image =  render_background_image_markup_by_attachment_id($blog->image,'','','thumb');
            $blog_title =  $blog->title;    
            $route = route('frontend.blog.single',$blog->slug) ;
            $category_route = route('frontend.blog.category',optional($blog->category)->slug) ;
            $create_date = optional($blog->created_at)->diffForHumans();   
            $blog_content =  purify_html_raw(Str::words($blog->blog_content,15)); 
            $category_name =  optional($blog->category)->name; 

            $blog_markup.= <<<BLOG

            <div class="col-xl-3 col-md-6 margin-top-30">
                <div class="single-blog style-03 wow fadeInUp" data-wow-delay=".2s">
                    <a href="{$route}" class="blog-thumb service-bg-thumb-format" {$image}>
                    
                    </a>
                    <div class="blog-contents">
                        <ul class="tags">
                            <li>
                                <a href="javascript:void(0)"> <i class="las la-clock"></i> {$create_date} </a>
                            </li>
                            <li>
                                <a href="{$category_route}"> <i class="las la-tag"></i> {$category_name} </a>
                            </li>
                        </ul>
                        <h5 class="common-title"> <a href="{$route}"> {$blog_title} </a> </h5>
                        <p class="common-para">{$blog_content}</p>
                    </div>
                </div>
            </div>   

BLOG;
        
}


return <<<HTML
     <!-- Blog area starts -->
     <section class="blog-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-two">
                        <h3 class="title">{$section_title} </h3>
                    </div>
                </div>
            </div>
            <div class="row margin-top-10">
                $blog_markup
            </div>
        </div>
    </section>
    <!-- Blog area end -->

HTML;

}

    public function addon_title()
    {
        return __('Recent Blog: 02');
    }
}