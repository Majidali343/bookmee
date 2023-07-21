<?php

namespace App\PageBuilder\Addons\Blog;

use App\Category;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\Blog;
use Str;

class AllBlog extends PageBuilderBase
{

    public function preview_image()
    {
        return 'blog-page/all.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();
        
        
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
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();



        return $output;

    }

    public function frontend_render()
    {

        $settings = $this->get_settings();
        $order_by =$settings['order_by'];
        $IDorDate =$settings['order'];
        $items =$settings['items'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];


        $all_blogs = Blog::where('status','publish')->OrderBy($order_by,$IDorDate)->paginate($items);
        $pagination = $all_blogs->links();
        $blog_markup = '';

        return $all_blogs;

        

foreach ($all_blogs as $blog)
{
    $title = $blog->title;
    $create_date = optional($blog->created_at)->diffForHumans();
    $category = $blog->category->name;
    $image = render_background_image_markup_by_attachment_id($blog->image,'','','thumb');
    $blog_content = purify_html_raw(Str::words($blog->blog_content,15));
    $route = route('frontend.blog.single',$blog->slug);  
    $category_blog_route = route('frontend.blog.category',optional($blog->category)->slug);
    
   
$blog_markup.= <<<BLOG
        <div class="col-lg-4 col-md-6 margin-top-30">
            <div class="single-blog no-margin wow fadeInUp" data-wow-delay=".2s">
                <a href="{$route}" class="blog-thumb service-bg-thumb-format" {$image}>
                </a>
                <div class="blog-contents">
                    <ul class="tags">
                        <li>
                            <a href="javascript:void(0)"> <i class="las la-clock"></i>{$create_date}</a>
                        </li>
                        <li>
                            <a href="{$category_blog_route}"> <i class="las la-tag"></i>{$category}</a>
                        </li>
                    </ul>
                    <h5 class="common-title"> <a href="{$route}">{$title}</a> </h5>
                    <p class="common-para">{$blog_content}</p>
                </div>
            </div>
        </div>
BLOG;      

}


return <<<HTML

<!-- Blog area starts -->
    <section class="blog-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row">
                {$blog_markup}
                
                <div class="col-lg-12">
                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            {$pagination}
                        </div>
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
        return __('All Blogs');
    }
}