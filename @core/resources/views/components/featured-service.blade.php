<a tabindex="0" class="btn btn-warning btn-xs btn-sm mr-1 swal_status_change">
    <i class="ti-pencil"></i>
</a>
<form method='post' action='{{$url}}' class="d-none">
<input type='hidden' name='_token' value='{{csrf_token()}}'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>