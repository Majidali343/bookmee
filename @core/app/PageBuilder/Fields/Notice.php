<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Notice extends PageBuilderField
{
    use FieldInstanceHelper;

    /**
     * render field markup
     * */
    public function render()
    {
        // TODO: Implement render() method.
        return  '<div class="alert alert-'.$this->args['type'].'">'.$this->args['text'].'</div>';
    }
}