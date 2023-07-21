<?php


namespace App\MenuBuilder;


abstract class MegaMenuBase
{
    abstract function name();
    abstract function render($id,$lang);
    abstract function slug();
    abstract function query_type();
    abstract function enable();
    abstract function title_param();
    public function body_start(){
        $output =  '<div class="xg_mega_menu_wrapper">'."\n";
        $output .= '<div class="xg-mega-menu-container">'."\n";
        $output .= '<div class="row">'."\n";
        return $output;
    }
    public function body_end(){
        $output =  '</div>'."\n";
        $output .= '</div>'."\n";
        $output .= '</div>'."\n";
        return $output;
    }
}