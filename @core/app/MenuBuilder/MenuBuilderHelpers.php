<?php


namespace App\MenuBuilder;


use App\Helpers\LanguageHelper;
use App\StaticOption;

class MenuBuilderHelpers
{
    protected  $menu_builder_setup_instance = null;
    public function __construct() {
        if ($this->menu_builder_setup_instance === null){
            $this->menu_builder_setup_instance = new MenuBuilderSetup();
        }
    }

    public function get_static_pages_list($lang): string
    {
        return $this->render_static_page_list($this->menu_builder_setup_instance->static_pages_list(),$lang);
    }

    /**
     * @throws \Exception
     */
    public function get_post_type_page_list($lang): string
    {
        return $this->render_dynamic_pages_list($this->menu_builder_setup_instance->register_dynamic_menus(),$lang);
    }

    public static function render_static_page_list($static_page_list,$lang ): string
    {
        $output = '';
        $default_language_slug = $lang ?? LanguageHelper::default_slug();
        foreach ($static_page_list as $page){
            $page_name = MenuBuilderSetup::multilang() ? '_page_'.$default_language_slug.'_name' : '_page_name';

            $static_field_data = StaticOption::whereIn('option_name',[$page.'_page_slug',$page.$page_name])
                ->get()
                ->mapWithKeys(function ($item) { return [$item->option_name => $item->option_value];})
                ->toArray();

            $output .= '<li data-ptype="static" data-pslug="'.$page.'" data-pname="'.htmlspecialchars(strip_tags($static_field_data[$page.$page_name] ??  __('set title from page settings'))).'">';
            $output .= '<label class="menu-item-title">';
            $output .= '<input type="checkbox" class="menu-item-checkbox"> ';
            $output .= htmlspecialchars(strip_tags($static_field_data[$page.$page_name] ?? __('set title from page settings')));
            $output .= '</label></li>';
        }

        return $output;
    }

    /**
     * @throws \Exception
     */
    public function render_dynamic_pages_list($dynamic_page_list,$lang): string
    {
        $output = '';
        $default_language_slug = $lang ?? LanguageHelper::default_slug();
        foreach ($dynamic_page_list as $key => $page_details){

            //enable when = give a static page name here
            if (isset($page_details['enable_when']) && empty(get_static_option($page_details['enable_when']))){
                continue;
            }
            //query type  = old_lang|new_lang
            $random_number = random_int(999,9999999);
            $output .= '<div class="card">';
            $output .= '<div class="card-header" id="id_'.$random_number.'-page-list-items"><h2 class="mb-0">';
            $output .= '<button class="btn btn-link" type="button"  data-toggle="collapse" data-target="#id_'.$random_number.'-page-list-items-content"  aria-expanded="true">';
            $dynamic_type_title = $this->dynamic_page_name($page_details['name'],$default_language_slug) ?? __(ucfirst(str_replace('_',' ',$key)));
            $output .= $dynamic_type_title.'</button></h2></div>';

            $output .= '<div id="id_'.$random_number.'-page-list-items-content" class="collapse" aria-labelledby="id_'.$random_number.'page-list-items" data-parent="#add_menu_item_accordion">';
            $output .= '<div class="card-body"><ul class="page-list-ul">';
            $query =  new $page_details['model']();
            $query =  $query->query();


            if ($page_details['query'] === 'old_lang'){
                $query->where(['lang' => $default_language_slug,'status' => 'publish']);
            }elseif($page_details['query'] === 'new_lang'){
                $query->with(['lang_query' => function ($query) use ($default_language_slug){
                    $query->where('lang',$default_language_slug);
                }])->where(['status' => 'publish']);
            }else{
                $query->where(['status' => 'publish']);
            }

            $all_items = $query->get();
            foreach ($all_items as $item){
                $output .= ' <li data-ptype="'.$key.'" data-pid="'.$item->id.'">';
                $output .= '<label class="menu-item-title">';
                $output .= ' <input type="checkbox" class="menu-item-checkbox"> ';

                $title_param = $page_details['title_param'];
                if ($page_details['query'] === 'old_lang'){
                    $title = $item->$title_param ?? '';
                }elseif($page_details['query'] === 'new_lang'){
                    $title = $item->lang_query->$title_param ?? '';
                }else{
                    $title = $item->$title_param ?? '';
                }

                $output .= htmlspecialchars(strip_tags($title)) ?? '';
                $output .= '</label></li>';
            }
            //menu item will be there
            $output .= '</ul>';
            $output .= '<div class="form-group">';
            $output .= '<button type="button"  class="btn btn-primary btn-xs mt-4 pr-4 pl-4 add_page_to_menu">'.__('Add To Menu').'</button>';
            $output .= '</div></div></div></div>';
        }

        return $output;
    }

    private function dynamic_page_name($name,$lang){
        return get_static_option(htmlspecialchars(strip_tags(str_replace('[lang]',$lang,$name))));
    }
}