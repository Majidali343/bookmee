<a tabindex="0" class="btn btn-danger btn-xs {{$class ?? 'mb-3'}} mr-1 swal_delete_button" data-toggle="tooltip" title="Delete User Account">
    <i class="ti-trash"></i>
</a>
<form method='post' action='{{$url}}' class="d-none">
<input type='hidden' name='_token' value='{{csrf_token()}}'>
<br>
<button type="submit" class="admin_delete_account_swal_form_submit_btn d-none"></button>
 </form>
