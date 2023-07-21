<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class NiceSelect extends PageBuilderField
{
    use FieldInstanceHelper;

    /**
     * render field markup
     * */
    public function render()
    {
        // TODO: Implement render() method.
        $output = '';
        $output .= $this->field_before();
        $output .= $this->label();
        $multiple = isset($this->args['multiple'] ) ? 'multiple' : '';
        $name = $this->name();
        if ($multiple){
            $name.= '[]';
        }
        $output .= '<select name="'.$name.'" class="nice-select wide '.$this->field_class().'" '.$multiple.'>';
        $output .= !empty($this->args['placeholder']) ? ' <option >'.$this->args['placeholder'].'</option>' : '';
        foreach ($this->args['options'] as $value => $name){
            if ($multiple){
                $selected = is_array($this->value()) && in_array($value,$this->value()) ? 'selected' : '';
            }else{
                $selected = !empty($this->value()) && $this->value() == $value ? 'selected' : '';
            }
            $output .= ' <option value="'.strip_tags($value).'" '.$selected.'>'.strip_tags($name).'</option>';
        }
        $output .= '</select>';
        $output .= $this->field_after();

        return $output;
    }
}