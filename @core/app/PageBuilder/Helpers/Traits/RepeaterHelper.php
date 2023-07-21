<?php
namespace App\PageBuilder\Helpers\Traits;


use App\Helpers\SanitizeInput;

trait RepeaterHelper
{
    /**
     * @param array $args
     * name
     * label
     * value
     * */
    public function get_repeater_field_value($name, $index = null, $lang = null): string
    {
        $field_name = $name . '_' . $lang;
        $value = '';
        if (isset($this->args['repeater'][$field_name]) && is_array($this->args['repeater'][$field_name])) {
            $value = $this->args['repeater'][$field_name][$index];
        } elseif (isset($this->args['repeater'][$field_name])) {
            $value = $this->args['repeater'][$field_name];
        }
        return SanitizeInput::esc_html($value);
    }


}
