<a tabindex="0" class="btn btn-info btn-xs btn-sm mr-1 swal_status_change_order_cancel text-white">{{ __('Cancel Order') }}</a>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="swal_form_submit_btn_cancel_order d-none"></button>
</form>