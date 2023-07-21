<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Number extends PageBuilderField
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
        $output .= '<input type="number" value="'.$this->value().'"   placeholder="'.$this->placeholder().'" name="'.$this->name().'"  class="'.$this->field_class().'"/>';
        $output .= $this->field_after();

        return $output;
    }
}