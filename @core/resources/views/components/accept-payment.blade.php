<a tabindex="0" class="btn btn-success btn-xs mb-3 mr-1 swal_accept_payment_button">
    <i class="ti-check"></i>
</a>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
