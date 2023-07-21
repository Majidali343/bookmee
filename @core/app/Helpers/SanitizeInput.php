<?php


namespace App\Helpers;


use Mews\Purifier\Facades\Purifier;

class SanitizeInput
{
    /**
     * sanitize string to remove script
     * */
    public static function esc_html($val): string
    {
        return htmlspecialchars(strip_tags($val));
    }

    /**
     * sanitize url to remove script
     * */
    public static function esc_url($val): string
    {
        return htmlspecialchars(filter_var($val, FILTER_SANITIZE_URL));
    }

    /**kses_basic
     * kses will allow given html tag with attribute
     * */
    public static function kses($val, array $args): string
    {
        return strip_tags($val, $args);
    }

    /**
     * kses will allow given html tag with attribute
     * */
    public static function kses_basic($val): string
    {
        return Purifier::clean($val);
    }

}