<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Email extends PageBuilderField
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
        $output .= '<input type="email" value="'.$this->value().'" name="'.$this->name().'"   placeholder="'.$this->placeholder().'" class="'.$this->field_class().'"/>';
        $output .= $this->field_after();

        return $output;
    }
}