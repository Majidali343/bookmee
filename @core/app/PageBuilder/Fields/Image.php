<?php


namespace App\PageBuilder\Fields;


use App\PageBuilder\Helpers\Traits\FieldInstanceHelper;
use App\PageBuilder\PageBuilderField;

class Image extends PageBuilderField
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
        $image_upload_btn_label  = __('Upload Image');
        $output .= '<div class="media-upload-btn-wrapper"> <div class="img-wrap">';
        $img = !empty($this->value()) ? get_attachment_image_by_id($this->value(),'medium',false) : '';
        if (!empty($img)){
            $output .= ' <div class="rmv-span"><i class="fas fa-trash"></i></div>';
            $output .= '<div class="attachment-preview"><div class="thumbnail"><div class="centered">';
            $output .= '<img class="avatar user-thumb" src="'.$img['img_url'].'" />';
            $output .= '</div></div></div>';
            $image_upload_btn_label = __('Change Image');
        }
        $output .= '</div><br>';
        $output .= '<input type="hidden" value="'.$this->value().'" name="'.$this->name().'" />';
        $output .= ' <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="'.__('Select Image').'" data-modaltitle="'.__('Upload Image').'" data-imgid="'.$this->value().'" data-toggle="modal" data-target="#media_upload_modal">'.$image_upload_btn_label.'</button>';
        $output .= '</div>';

        if (isset( $this->args['dimensions'])){
            $output .= '<small>'.__('recommended image size is').' '. $this->args['dimensions'].'</small>';
        }

        $output .= $this->field_after();

        return $output;
    }
}