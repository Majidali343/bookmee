<?php

namespace App\Helpers\DataTableHelpers;

use App\Helpers\LanguageHelper;
use http\Env\Request;

class General
{
    public static function bulkCheckbox($id)
    {
        return <<<HTML
<div class="bulk-checkbox-wrapper">
    <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{$id}">
</div>
HTML;

    }

    public static function image($image_id)
    {
        return render_attachment_preview_for_admin($image_id);
    }

    public static function deletePopover($url)
    {
        $token = csrf_token();
        return <<<HTML
<a tabindex="0" class="btn btn-danger btn-xs mb-3 mr-1 swal_delete_button">
    <i class="ti-trash"></i>
</a>
<form method='post' action='{$url}' class="d-none">
<input type='hidden' name='_token' value='{$token}'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
HTML;

    }

    public static function pendingOrderCancel($id = null, $url, $status)
    {
        $markup = '';
        $markup .= self::orderStatus($status);
        $token = csrf_token();
            return $markup . <<<HTML
            <a tabindex="0"
               class="btn btn-danger btn-xs mx-2 mr-1 report_add_modal"
               data-toggle="modal"
               data-target="#OrderStatusChangeModal"
               data-status_id="{$id}"     
               >            
            <i class="ti-pencil"></i></a>            
            <form method='post' action='{$url}' class="d-none">
            <input type='hidden' name='_token' value='{$token}'>
            <input type='hidden' name='_token' value='{$token}'>
            <br>
            <button type="submit" class="swal_form_cancel_order_submit_btn d-none"></button>
             </form>
        HTML;
    }

    public static function statusChange($url){
        $token = csrf_token();
        return <<<HTML
<a tabindex="0" class="btn btn-warning btn-xs btn-sm mr-1 mb-3 swal_status_change">
    <i class="ti-check"></i>
</a>
<form method='post' action='{$url}' class="d-none">
<input type='hidden' name='_token' value='{$token}'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
HTML;

}

    public static function orderPaymentStatusChange($url, $status)
    {
        $markup = '';
        $markup .= self::orderStatus($status);
        $token = csrf_token();
        return $markup . <<<HTML
            <a href="#0" tabindex="0" class="btn btn-success btn-xs mr-1 order_payment_status_change"><i class="ti-pencil"></i></a>
            <form method='post' action='{$url}' class="d-none">
                <input type='hidden' name='_token' value='{$token}'>
                <input type='hidden' name='_token' value='{$token}'>
                <br>
                <button type="submit" class="swal_form_cancel_order_submit_btn d-none"></button>
            </form>
        HTML;
    }

public static function deleteSellerAccount(){
      $account_delete_message = __('Account has been deleted');

    return <<<HTML
<a tabindex="0" class="btn btn-danger btn-xs btn-sm mr-1 mb-3">
    {$account_delete_message}
</a>
HTML;

}

public static function featuredService($url,$featured){
    $token = csrf_token();
    $featured==1 ? $featured = __('Featured') : $featured = __('Make Featured'); 
    return <<<HTML
<a tabindex="0" class="btn btn-warning btn-xs btn-sm mr-1 mb-3 swal_status_change">
    {$featured }
</a>
<form method='post' action='{$url}' class="d-none">
<input type='hidden' name='_token' value='{$token}'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
HTML;

}

    public static function editIcon($url){
        return <<<HTML
<a class="btn btn-primary btn-xs mb-3 mr-1" href="{$url}">
    <i class="ti-pencil"></i>
</a>
HTML;

    }

    public static function viewIcon($url){
        return <<<HTML
            <a class="btn btn-info btn-xs mb-3 mr-1" target="_blank" href="{$url}">
                <i class="ti-eye"></i>
            </a>
            HTML;
    }

    public static function EditServiceHistory($url){
        $edit_history = __('Service Edit History');
        return <<<HTML
            <a class="btn btn-info btn-xs mb-3 mr-1" target="_blank" href="{$url}">
                <span>{$edit_history}</span>
            </a>
            HTML;
    }

    public static function cloneIcon($action,$id){
        $csrf = csrf_field();
        return <<<HTML
<form action="{$action}" method="post" class="d-inline">
{$csrf}
    <input type="hidden" name="item_id" value="{$id}">
    <button type="submit" title="clone this to new draft" class="btn btn-xs btn-secondary btn-sm mb-3 mr-1"><i class="far fa-copy"></i></button>
</form>
HTML;

    }

    public static function statusSpan($status){
        $output = '';

        if($status === 'draft'){
            $output .= '<span class="alert alert-primary" >'.__('Draft').'</span>';
        }elseif($status === 'archive'){
            $output .= '<span class="alert alert-warning" >'.__('Archive').'</span>';
        }elseif($status === 'pending'){
            $output .= '<span class="alert alert-warning" >'.__('Pending').'</span>';
        }elseif($status === 'complete'){
            $output .= '<span class="alert alert-success" >'.__('Complete').'</span>';
        }elseif($status === 'close'){
            $output .= '<span class="alert alert-danger" >'.__('Close').'</span>';
        }elseif($status === 'in_progress'){
            $output .= '<span class="alert alert-info" >'.__('In Progress').'</span>';
        }elseif($status === 'publish'){
            $output .= '<span class="alert alert-success" >'.__('Publish').'</span>';
        }elseif($status === 'approved'){
            $output .= '<span class="alert alert-success" >'.__('Approved').'</span>';
        }elseif($status === 'confirm'){
            $output .= '<span class="alert alert-success" >'.__('Confirm').'</span>';
        }elseif($status === 'yes'){
            $output .= '<span class="alert alert-success" >'.__('Yes').'</span>';
        }elseif($status === 'no'){
            $output .= '<span class="alert alert-danger" >'.__('No').'</span>';
        }elseif($status === 'cancel'){
            $output .= '<span class="alert alert-danger" >'.__('Cancel').'</span>';
        }

        return $output;
    }

    public static function serviceStatusSpan($status){
        $output = '';
        if($status === 1){
            $output .= '<span class="btn btn-success btn-sm" >'.__('Approved').'</span>'; 
        }elseif($status === 0){
            $output .= '<span class="btn btn-danger" >'.__('Pending').'</span>';
        }
        return $output;
    }

    public static function orderStatus($status){
        $output = '';
        if($status === 0){
            $output .= '<span class="btn btn-warning btn-sm" >'.__('Pending').'</span>' ;
        }elseif($status === 1){
            $output .= '<span class="btn btn-success btn-sm" >'.__('Active').'</span>';
        }
        elseif($status === 2){
            $output .= '<span class="btn btn-secondary btn-sm" >'.__('Completed').'</span>';
        }
        elseif($status === 3){
            $output .= '<span class="btn btn-primary btn-sm" >'.__('Delivered').'</span>';
        }
        elseif($status === 4){
            $output .= '<span class="btn btn-danger btn-sm" >'.__('Cancelled').'</span>';
        }

        return $output;

    }

    public static function orderType($is_order_online){
        $output = '';

        if($is_order_online === 0){
            $output .= '<span class="btn btn-info btn-sm" >'.__('Offline').'</span>';
        }elseif($is_order_online === 1){
            $output .= '<span class="btn btn-success btn-sm" >'.__('Online').'</span>';
        }
        return $output;
    }

    public static function paymentAccept($url){
        $token = csrf_token();
        return <<<HTML
<a tabindex="0" class="btn btn-success btn-xs mb-3 mr-1 swal_change_approve_payment_button">
    <i class="ti-check"></i>
</a>
<form method='post' action='{$url}' class="d-none">
    <input type='hidden' name='_token' value='{$token}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>

HTML;

    }

    public static function invoiceBtn($url,$id){
        $csrf = csrf_field();
        $title = __('Invoice');
        return <<<HTML
 <form action="{$url}"  method="post">{$csrf}
    <input type="hidden" name="id" id="invoice_generate_order_field" value="{$id}">
    <button class="btn btn-secondary mb-2" type="submit">{$title}</button>
</form>
HTML;

    }

    public static function reminderMail($url,$id){
        $csrf = csrf_field();
        return <<<HTML
<form action="{$url}"  method="post">
{$csrf}
    <input type="hidden" name="id" value="{$id}">
    <button class="btn btn-secondary mb-2" type="submit"><i class="fas fa-bell"></i></button>
</form>
HTML;

    }

    public static function anchor($url,$text,$class='primary'){
        return <<<HTML
<a class="btn btn-xs mb-3 mr-1 btn-{$class}" href="{$url}">{$text}</a>
HTML;
    }

    public static function category($data){
        $colors = ['text-primary','text-danger','text-success','text-info','text-dark'];

        $markup = '';
        foreach($data as $key=> $cat) {
            $colo = $colors[random_int(0, 4)];
            $seperation =  ' ';

            $title = $cat->title;
            $markup.= ' <span class="'.$colo.'">'.$title.$seperation.'</span>';
        }

return <<<HTML
  {$markup}
HTML;

}



}//end class
