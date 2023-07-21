<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class ColorPicker extends PageBuilderField
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
        $output .= $this->label('d-block');
        $output .= '<div class="color_picker" title="'.__('Click to change color').'" style="background-color: '.$this->value().'"></div>';
        $output .= '<input type="hidden" value="'.$this->value().'" name="'.$this->name().'"  class="'.$this->field_class().'"/>';
        $output .= $this->field_after();

        return $output;
    }
}