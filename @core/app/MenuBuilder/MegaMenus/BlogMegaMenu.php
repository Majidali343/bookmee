<?php


namespace App\MenuBuilder\MegaMenus;


use App\Blog;
use App\BlogCategory;
use App\MenuBuilder\MegaMenuBase;

class BlogMegaMenu extends MegaMenuBase
{

    function model(){
        return 'App\Blog';
    }
    function render($ids,$lang)
    {
        //it will have all html markup for the mega menu
        $ids = explode(',',$ids);
        $output = '';
        if (empty($ids)){
            return $output;
        }
        $output .= $this->body_start();

        $mega_menu_items = Blog::whereIn('id',$ids)->get()->groupBy('blog_categories_id');
        foreach ($mega_menu_items as $cat => $posts) {
            $output .= '<div class="col-lg-3 col-md-6">' ."\n";
            $output .= '<div class="xg-mega-menu-single-column-wrap">'."\n";
            $output .= '<h4 class="mega-menu-title">' . $this->category($cat). '</h4>'."\n";
            $output .= '<ul>'."\n";
            foreach ($posts as $post) {
                $output .= '<li><a href="'.route('frontend.blog.single',$post->slug).'">' . $post->title . '</a></li>'."\n";
            }
            $output .= '</ul>'."\n";
            $output .= '</div>'."\n";
            $output .= '</div>'."\n";
        }

        $output .= $this->body_end();
        // TODO: return all makrup data for render it to frontend
        return $output;
    }

    function category($id)
    {
        $category = BlogCategory::where(['id' => $id])->first();
        return $category->name ?? __('Uncategorized');
    }

    function route()
    {
        // TODO: Implement route() method.
        return 'frontend.news.single';
    }

    function routeParams()
    {
        // TODO: Implement routeParams() method.
        return ['slug'];
    }

    function name()
    {
        // TODO: Implement name() method.
        return 'blog_page_[lang]_name';
    }
    function enable()
    {
        // TODO: Implement enable() method.
        return true;
    }

    function query_type()
    {
        // TODO: Implement query_type() method.
        return 'old_lang'; // old_lang|new_lang
    }
    function title_param()
    {
        // TODO: Implement title_param() method.
        return 'title';
    }
    function slug()
    {
        // TODO: Implement name() method.
        return 'blog_page_slug';
    }
}