<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Select extends PageBuilderField
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
        $output .= '<select name="'.$this->name().'" class="'.$this->field_class().'">';
        $output .= !empty($this->args['placeholder']) ? ' <option value="">'.$this->args['placeholder'].'</option>' : '';
        foreach ($this->args['options'] as $value => $name){
            $selected = !empty($this->value()) && $this->value() == $value ? 'selected' : '';
            $output .= ' <option value="'.strip_tags($value).'" '.$selected.'>'.strip_tags($name).'</option>';
        }
        $output .= '</select>';
        $output .= $this->field_after();

        return $output;
    }
}