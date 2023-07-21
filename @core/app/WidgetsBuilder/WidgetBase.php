<?php


namespace App\WidgetsBuilder;


use App\Language;
use App\Widgets;

abstract class WidgetBase
{
    protected $args;
    protected $rand_number;

    public function __construct(array $args=[])
    {
        $defaults = [
            'id' => '',
            'name' => $this->widget_name(),
            'type' =>'',
            'order' =>'',
            'location' =>'',
            'before' => true,
            'after' => true
        ];
        $this->args = array_merge($defaults,$args);
        try {
            $this->rand_number = random_int(999, 99999);
        } catch (\Exception $e) {
        }
    }
    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    abstract public function admin_render();

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    abstract public function frontend_render();
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    abstract public function widget_title();
    /**
     * widget_name
     * this method must have to implement by all widget to register widget name
     * @since 1.0.0
     * */
    public function widget_name()
    {
        // TODO: Implement widget_name() method.
        return substr(strrchr(get_called_class(), "\\"), 1);
    }

    /**
     * default_fields
     * this method will return all the default field required by any widget
     * @since 1.0.0
     * */
    public function default_fields()
    {
        //all initial field
        $output = '';

        $output .= !empty($this->args['id']) ? '<input type="hidden" name="id" value="' . $this->args['id'] . '">' : '';
        $output .= '<input type="hidden" value="' . $this->args['name'] . '" name="widget_name">';
        $output .= '<input type="hidden" value="' . $this->args['type'] . '" name="widget_type">';
        $output .= '<input type="hidden" value="' . $this->args['location'] . '" name="widget_location">';
        $output .= '<input type="hidden" value="' . $this->args['order'] . '" name="widget_order">';

        return $output;
    }

    /**
     * get_settings
     * this method will return all the settings value saved for widget
     * @since 1.0.0
     * */

    public function get_settings()
    {
        $widget_data = !empty($this->args['id']) ? Widgets::find($this->args['id']) : [];
        $widget_data = !empty($widget_data) ? unserialize($widget_data->widget_content,['class' => false]) : [];
        return $widget_data;
    }
    /**
     * widget_column_start
     * this method will add widget column markup for frontend
     * @since 1.0.0
     */
    public function widget_column_start()
    {

        $default_class = 'col-lg-3 col-md-6';
        if (isset($this->args['column']) && $this->args['column']){
            $class_list = isset($this->args['column_class']) && !empty($this->args['column_class']) ? $this->args['column_class'] : $default_class;
            return '<div class="'.$class_list.'">';
        }
    }

    /**
     * widget_column_end
     * this method will add widget column markup for frontend
     * @since 1.0.0
     */
    public function widget_column_end()
    {
        if (isset($this->args['column']) && $this->args['column']){
            return '</div>';
        }
    }

    /**
     * widget_before
     * this method will add widget before html markup for widget in frontend
     * @since 1.0.0
    */
    public function widget_before($class = null)
    {
        return $this->widget_column_start().'<div class="'.$class.' '.$this->args['location'].'-widget widget">';
    }

    /**
     * widget_after
     * this method will add widget after html markup for widget in frontend
     * @since 1.0.0
     */
    public function widget_after()
    {
        return $this->widget_column_end().'</div>';
    }

    /**
     * admin_form_start
     * this method will init form markup for admin panel
     * @since 1.0.0
     */

    public function admin_form_start()
    {
        return '<form method="post" action="' . route('admin.widgets.' . $this->args['type']). '" enctype="multipart/form-data"><input type="hidden" value="' . csrf_token() . '" name="_token">';
    }
    /**
     * admin_form_end
     * this method will end tag form markup for admin panel
     * @since 1.0.0
     */
    public function admin_form_end()
    {
        return '</form>';
    }

    /**
     * admin_form_submit_button
     * this method will add a submit button for widget in admin panel
     * @since 1.0.0
     */

    public function admin_form_submit_button($text = null){
        $button_text = $text ?? __('Save Changes');
        return '<button class="btn btn-info btn-xs widget_save_change_button">' . $button_text . '</button>';
    }

    /**
     * admin_form_submit_button
     * this method will add a submit button for widget in admin panel
     * @since 1.0.0
     */

    public function admin_language_tab(){
        $all_languages = Language::all();
        $output = '<nav><div class="nav nav-tabs" role="tablist">';
        foreach ($all_languages as $key => $lang) {
            $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
            $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-home-'. $lang->slug .$this->rand_number. '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
        }
        $output .= '</div></nav>';
        return $output;
    }
    /**
     * admin_language_tab_start
     * this method will add language tab content start wrapper
     * @since 1.0.0
     * */

    public function admin_language_tab_start(){
        return '<div class="tab-content margin-top-30" >';
    }

    /**
     * admin_language_tab_end
     * this method will add language tab content end wrapper
     * @since 1.0.0
     * */
    public function admin_language_tab_end(){
        return '</div>';
    }

    /**
     * admin_language_tab_content_start
     * this method will add language tab panel start
     * @since 1.0.0
     * */

    public function admin_language_tab_content_start($args){
            return  '<div class="' . $args['class'] . '" id="'. $args['id'] .$this->rand_number .'" role="tabpanel">';
    }
    /**
     * admin_language_tab_content_end
     * this method will add language tab panel end
     * @since 1.0.0
     * */
    public function admin_language_tab_content_end(){
        return '</div>';
    }

    public function admin_form_before(){
        $markup = '';
        if ($this->args['before']){
            $markup .= '<li class="ui-state-default widget-handler" data-name="'.$this->widget_name().'">';
        }
        $markup .= '<h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$this->widget_title().'</h4>
        <span class="expand"><i class="ti-angle-down"></i></span>
        <span class="remove-widget"><i class="ti-close"></i></span>
        <div class="content-part">';
        return $markup;
    }
    public function admin_form_after(){
        $markup = '</div>';
        if ($this->args['after']){
            $markup .= '</li>';
        }
        return $markup;
    }
}