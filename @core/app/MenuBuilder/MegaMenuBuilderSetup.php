<?php

namespace App\MenuBuilder;

use App\Helpers\LanguageHelper;

class MegaMenuBuilderSetup  {


    public  function register_mega_menu(){
        return [

            // 'App\MenuBuilder\MegaMenus\KnowledgebaseMegaMenu',

        ];
    }

    public function render_mega_menu_list($lang){

        $output = '';
        $output .= '<div class="card"> <div class="card-header" id="megamenu-page-list-items">';
        $output .= '<h2 class="mb-0"><button class="btn btn-link" type="button"  data-toggle="collapse" data-target="#megamenu-page-list-items-content" aria-expanded="true" aria-controls="page-list-items-content"> ';
        $output .= __('Mega Menus').' </button> </h2> </div>';
        $output .= ' <div id="megamenu-page-list-items-content" class="collapse" aria-labelledby="page-list-items"  data-parent="#add_menu_item_accordion"> <div class="card-body">';
        $output .= '<ul class="page-list-ul">';

        foreach ($this->register_mega_menu() as $item){
            $instance = new $item();
            $lang = $lang ?? LanguageHelper::default_slug();
            $name = str_replace('[lang]',$lang,$instance->name());
            $name = htmlspecialchars(strip_tags(get_static_option($name)));
            $output .= '<li data-ptype="'.$item.'"><label class="menu-item-title"> <input type="checkbox" class="menu-item-checkbox"> ';
            $output .= $name.__(' Mega Menu').'</label></li>';
        }

        $output .= '</ul>';
        $output .= ' <div class="form-group"> <button type="button" id="add_dynamic_page_to_menu"  class="btn btn-primary btn-xs mt-4 pr-4 pl-4 add_mega_menu_to_menu">';
        $output .=__('Add MegaMenu').'</button> </div> </div></div> </div>';
        return $output;
    }

}
