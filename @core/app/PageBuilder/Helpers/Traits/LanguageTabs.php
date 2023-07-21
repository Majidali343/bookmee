<?php


namespace App\PageBuilder\Helpers\Traits;


use App\Helpers\LanguageHelper;

class LanguageTabs
{
    private $rand_number;
    /**
     * @throws \Exception
     */
    public function __construct(array $args=[])
    {
        if ($this->rand_number === null){
            $this->rand_number = random_int(999, 99999);
        }
    }

    public static function init(){
        return new self();
    }
    /**
     * admin_form_submit_button
     * this method will add a submit button for widget in admin panel
     * @since 1.0.0
     */

    public function language_tab(): string
    {
        $all_languages = LanguageHelper::all_languages();
        $output = '<nav><div class="nav nav-tabs" role="tablist">';
        foreach ($all_languages as $key => $lang) {
            $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
            $output .= '<a class="' . $active_class . '"  data-toggle="tab" href="#nav-home-'. $lang->slug .$this->rand_number. '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
        }
        $output .= '</div></nav>';
        return $output;
    }

    /**
     * admin_language_tab_start
     * this method will add language tab content start wrapper
     * @since 1.0.0
     * */

    public function language_tab_start() : string
    {
        return '<div class="tab-content margin-top-30" >';
    }

    /**
     * admin_language_tab_end
     * this method will add language tab content end wrapper
     * @since 1.0.0
     * */
    public function language_tab_end() : string
    {
        return '</div>';
    }

    /**
     * admin_language_tab_content_start
     * this method will add language tab panel start
     * @since 1.0.0
     * */

    public function language_tab_content_start($args): string
    {
        return  '<div class="' . $args['class'] . '" id="'. $args['id'] .$this->rand_number .'" role="tabpanel">';
    }
    /**
     * admin_language_tab_content_end
     * this method will add language tab panel end
     * @since 1.0.0
     * */
    public function language_tab_content_end() : string
    {
        return '</div>';
    }

}