<?php

namespace App\MenuBuilder;

use App\Helpers\LanguageHelper;
use App\Menu;


class MenuBuilderAdminRender
{
    protected $page_id;
    public function render_admin_panel_menu($id){
        $output = '';
        if (empty($id)){
            return $output;
        }
        $menu_details_from_db = Menu::find($id);
        $default_lang = $menu_details_from_db->lang ?? LanguageHelper::default_slug();
        $menu_data = json_decode($menu_details_from_db->content);
        $this->page_id = 1;
        foreach ($menu_data as $menu_item){
            $this->page_id++;
            $output .= $this->render_menu_item($menu_item,$this->page_id,$default_lang);
            // close li tag
        }
        return $output;
    }
    private function get_attribute_string(array $li_attributes):string
    {
        $attr_val = '';
        foreach ($li_attributes as $attr => $value){
            $attr_val .= ($attr === 'class') ? $attr.'="'.$value.'"' : 'data-'.$attr.'="'.$value.'"';
        }
        return $attr_val;
    }
    private function render_li_start(string $title, array $attributes_string,$default_lang)
    {
        $output = '<li '.$this->get_attribute_string($attributes_string).'> '."\n";
        $output .= $this->get_draggable_handole_markup($title);
        $output .= $this->get_draggable_remove_item_markup();
        $output .= $this->get_draggable_expand_markup();
        $output .= $this->get_draggable_fields_markup($attributes_string,$default_lang);
        return $output;
    }
    private function get_draggable_handole_markup(string $title)
    {
        return '<div class="dd-handle">'.strip_tags($title).'</div>';
    }
    private function get_draggable_remove_item_markup()
    {
        return '<span class="remove_item">x</span>';
    }
    private function get_draggable_expand_markup()
    {
        return '<span class="expand"><i class="ti-angle-down"></i></span>';
    }
    private function get_draggable_fields_markup(array $attributes_string,$lang)
    {
        $output = '<div class="dd-body hide">';
        //add common field for all menu
        $output .= '<input type="text" class="anchor_target" placeholder="eg: _target" value="'.$attributes_string['antarget'].'">';
        $output .= '<input type="text" class="icon_picker" placeholder="eg: fas-fa-facebook" value="'.$attributes_string['icon'].'">';

        //check menu type
        preg_match('/MegaMenus/', $attributes_string['ptype'], $matches);
        if (!empty($matches[0])) {
            $output .= '<label for="items_id">' . __('Select Items') . '</label>';
            $output .= '<select name="items_id" multiple="" class="form-control">';
            $instance = new $attributes_string['ptype']();
            $model_name = '\\'.$instance->model();
            $model = new $model_name();
            if ($instance->query_type() === 'old_lang'){
                $all_items = $model->where(['lang' => $lang])->where(['status' => 'publish'])->get();
            }elseif($instance->query_type() === 'new_lang'){
                $all_items =  $model->with(['lang_query' => function($query) use ($lang){
                  $query->where('lang' , $lang);
                }])->where(['status' => 'publish'])->get();
            }else{
                $all_items = $model->where(['status' => 'publish'])->get();
            }
            //fetch mega menu item
            foreach ($all_items as $item) {
                $selected = in_array($item->id, explode(',', $attributes_string['items_id']),false) ? 'selected' : '';
                $title_param = $instance->title_param();;
                if ($instance->query_type() === 'old_lang'){
                    $title = $item->$title_param ?? '';
                }elseif($instance->query_type() === 'new_lang'){
                    $title = $item->lang_query->$title_param ?? '';
                }else{
                    $title = $item->$title_param ?? '';
                }
                $output .= '<option value="' . $item->id . '" ' .$selected. '>' . $title . '</option>';
            }
            $output .= '</select>';

        }elseif ($attributes_string['ptype'] === 'custom'){
            //add field by menu type
            $output .= '<input type="text" class="static_pname" placeholder="eg: fas-fa-facebook" value="'.$attributes_string['pname'].'">';
        }else{
            $attributes_label = $attributes_string['menulabel'] ?? '';
            $output .= '<input type="text" class="menu_label" placeholder="eg: menu label" value="'. $attributes_label .'">';
        }
        $output .= '</div>';
        return $output;
    }
    private function render_menu_item($menu_item, int $page_id, $default_lang)
    {
        if (empty((array)$menu_item)){return;}

        //check multilang enable or disable
        $multi_lang = MenuBuilderSetup::multilang();

        $menu_item = (object) $menu_item ;
        $ptype =  property_exists($menu_item,'ptype') ? $menu_item->ptype : '';
        $pname =  property_exists($menu_item,'pname') ? $menu_item->pname : '';
        $attributes = [
            'icon' => $menu_item->icon ?? '',
            'antarget' => $menu_item->antarget ?? '',
            'id' => $page_id,
            'ptype' => $ptype,
            'class' => 'dd-item'
        ];
        $output = '';
        if ($ptype === 'custom'){
            $attributes_string = array_merge([
                'purl' =>  $menu_item->purl,
                'pname' =>  $pname,
            ],$attributes);
            $output .=  $this->render_li_start( $pname,$attributes_string,$default_lang);
        }elseif ($ptype === 'static'){
            $attributes_string = array_merge([
                'pname' =>  $pname,
                'pslug' => $menu_item->pslug,
            ],$attributes);
            $page_name = $multi_lang ? '_page_'.$default_lang.'_name' : '_page_name';
            $title = get_static_option(str_replace('-','_',$menu_item->pslug).$page_name) ?? '';


            $output .=  $this->render_li_start($title,$attributes_string,$default_lang);
        }else{
            //check is mega menu
            preg_match('/MegaMenus/',$ptype,$matches);
            if (!empty($matches[0])){
                //load mega menu content
                $attributes_string = array_merge($attributes,[
                    'items_id' => $menu_item->items_id ?? '',
                ]);
                $instance = new $attributes_string['ptype']();
                $static_name = str_replace('[lang]',$default_lang,$instance->name());
                $title = htmlspecialchars(strip_tags(get_static_option($static_name))).' '.__('Mega Menu');
                $output .=  $this->render_li_start($title,$attributes_string,$default_lang);
            }else {
                $menu_setup_instance = new MenuBuilderSetup();
                $all_dynamic_menus =  $menu_setup_instance->register_dynamic_menus();
                $dynamic_menu_type = $all_dynamic_menus[$ptype] ?? null;
                if ($dynamic_menu_type){
                    //load dynamic page item
                    $attributes_string = array_merge([
                        'pid' => $menu_item->pid,
                        'menulabel' => property_exists($menu_item,'menulabel') ? $menu_item->menulabel : '',
                    ],$attributes);
                    $model_name = '\\'.$dynamic_menu_type['model'];
                    $model = new $model_name();

                    if ($dynamic_menu_type['query'] === 'old_lang'){
                        $item_details =  $model->where('id',$menu_item->pid)->first();
                    }elseif($dynamic_menu_type['query'] === 'new_lang'){
                        $item_details =  $model->with(['lang_query' => function($query) use ($default_lang){
                            $query->where('lang',$default_lang);
                        }])->where('id',$menu_item->pid)->first();
                    }else{
                        $item_details = $model->where(['id' => $menu_item->pid,'status' => 'publish'])->first();
                    }

                    $title_param = $dynamic_menu_type['title_param'];
                    if ($dynamic_menu_type['query'] === 'old_lang'){
                        $title = $item_details->$title_param ?? '';
                    }elseif($dynamic_menu_type['query'] === 'new_lang'){
                        $title = $item_details->lang_query->$title_param ?? '';
                    }else{
                        $title = $item_details->$title_param ?? '';
                    }

                    $output .=  $this->render_li_start($title,$attributes_string,$default_lang);
                }
            }
        }
        //check it has children
        if (property_exists($menu_item,'children')){
            $output .= $this->render_children_item($menu_item->children,$default_lang);
        }
        $output .= '</li>';
        return $output;
    }
    protected function render_children_item($menu_item,$default_lang){
        if (empty((array)$menu_item)){return;}
        $output= '';
        $output .= '<ol class="dd-list">';
        foreach ( $menu_item as $ch_item) {
            $this->page_id +=1;
            $output .=  $this->render_menu_item( $ch_item, $this->page_id, $default_lang);
            $output .= '<li>';
        }
        $output .= '</ol>';
        return $output;
    }
}