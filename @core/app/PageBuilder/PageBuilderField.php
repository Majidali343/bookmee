<?php


namespace App\PageBuilder;


abstract class PageBuilderField
{
    /**
     * @var array $args ;
     * this will store all field param as array
     * */
    public array $args;

    public function __construct(array $args)
    {
        $default = [
          'class' => ['form-control'],
          'name' => null,
          'value' => null,
          'label' => null
        ];
        $this->args = array_merge($default,$args);
    }


    abstract public static function get(array $args);

    /**
     * add label to form field
     * @return string
     * */
    public function label($class = null): string
    {
        $classes = $class ? 'class="'.$class.'"' : '';
        return '<label '.$classes.'>' . $this->args['label'] . '</label>';
    }

    /**
     * add name to form field
     * @return string
     * */
    public function name(): string
    {
        return $this->args['name'];
    }
    /**
     * add name to form field
     * @return string
     * */
    public function placeholder(): string
    {
        return $this->args['placeholder'] ?? '';
    }

    /**
     * add parent wrapper for field
     * @return string
     * */
    public function field_before(): string
    {
        return '<div class="form-group">';
    }
    public function info():string
    {
        return $this->args['info'] ?? '';
    }
    /**
     * add parent wrapper for end div
     * @return string
     * */
    public function field_after(): string
    {   $markup = '';
        if (!empty($this->info())){
            $markup .= '<span class="page-builder-info-text">'.$this->info().'</span>';
        }
        return $markup.'</div>';
    }

    public function field_class(): string
    {
        if (isset($this->args['class']) && !is_array($this->args['class'])) {
            return 'form-control';
        }
        return implode(' ', $this->args['class']);
    }

    /**
     * get field value
     * */
     public function value(){
         return $this->args['value'];
     }

    /**
     * render field markup
     * */
    abstract public function render();
}