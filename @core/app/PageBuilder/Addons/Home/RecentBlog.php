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

class RecentBlog extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/recent_blog.png';
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
        $output .= Select::get([
            'name' => 'dot_color_slider',
            'label' => __('Select Dot Color'),
            'options' => [
                'dot-color-01' => __('Green'),
                'dot-color-02' => __('Blue'),
            ],
            'value' => $widget_saved_values['dot_color_slider'] ?? null,
            'info' => __('Select your color')
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
        $title_start = current($explode);
        $title_end = preg_replace("/^(\w+\s)/", "", $title);
        $subtitle = $settings['subtitle'];

        $order_by =$settings['order_by'];
        $IDorDate =$settings['order'];
        $items =$settings['items'];


        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $dot_color_slider = $settings['dot_color_slider'] ?? null;

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
            
            <div class="single-blog-item wow fadeInUp" data-wow-delay=".2s">
                <div class="single-blog {$dot_color_slider}">
                    <a href="{$route}" class="blog-thumb service-bg-thumb-format" {$image}>
                    
                    </a>
                    <div class="blog-contents">
                        <ul class="tags">
                            <li>
                                <a href="javascript:void(0)"> <i class="las la-clock"></i> {$create_date} </a>
                            </li>
                            <li>
                                <a href="{$category_route}"> <i class="las la-tag"></i>{$category_name} </a>
                            </li>
                        </ul>
                        <h5 class="common-title"> <a href="{$route}">{$blog_title} </a> </h5>
                        <p class="common-para">{$blog_content}</p>
                    </div>
                </div>
            </div>
               

BLOG;
        
}


return <<<HTML

       <!-- Blog area starts -->
       <section class="blog-area section-bg-1" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}" style="background-color:{$section_bg}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10">
                    <div class="section-title">
                        <h2 class="title">{$title_start} <span style="color:{$title_text_color}">{$title_end} </span> </h2>
                        <span class="section-para">{$subtitle}</span>
                    </div>
                </div>
            </div>
            <div class="row margin-top-50">
                <div class="col-lg-12">
                    <div class="services-slider dot-style-one dot-02 {$dot_color_slider}">
                        {$blog_markup}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog area end -->
    
HTML;

}

    public function addon_title()
    {
        return __('Recent Blog');
    }
}