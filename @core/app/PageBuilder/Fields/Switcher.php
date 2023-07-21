<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Switcher extends PageBuilderField
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
        $checked = !empty($this->value()) ? 'checked' : '';
        $output .='<label class="switch"><input type="checkbox" name="'.$this->name().'"  '.$checked.' ><span class="slider"></span></label>';
        $output .= $this->field_after();

        return $output;
    }
}