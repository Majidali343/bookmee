<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Summernote extends PageBuilderField
{
    use FieldInstanceHelper;

    public function render()
    {
        // TODO: Implement render() method.
        $output = '';
        $output .= $this->field_before();
        $output .= $this->label();
        $output .= '<textarea name="'.$this->name().'"  placeholder="'.$this->placeholder().'"  cols="10" rows="5"  class="summernote '.$this->field_class().'">'.$this->value().'</textarea>';
        $output .= $this->field_after();

        return $output;
    }
}