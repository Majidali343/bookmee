<?php


namespace App\PageBuilder\Helpers\Traits;


trait FieldInstanceHelper
{
    /**
     * @param array $args
     * name
     * label
     * value
     * */

    public static function get(array $args): string
    {
        // TODO: Implement instance() method.
        return (new self($args))->render();
    }

}