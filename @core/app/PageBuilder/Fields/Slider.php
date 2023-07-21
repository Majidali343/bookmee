<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Slider extends PageBuilderField
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
        $max = !empty($this->args['max']) ? 'max="'.$this->args['max'].'"' : '';
        $step = !empty($this->args['step']) ? 'step="'.$this->args['step'].'"' : '';
        $unit_type =  $this->args['unit_type'] ?? 'px';
        $output .= '<div class="range-wrap"><input type="range" data-unit-type="'.$unit_type.'" value="'.$this->value().'" min="0" '.$max.' '.$step.' name="'.$this->name().'" class="'.$this->field_class().'"/><span class="range-val">'.$this->value().' '.$unit_type.'</span></div>';
        $output .= $this->field_after();

        return $output;
    }
}