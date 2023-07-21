<a tabindex="0" class="btn btn-info btn-xs btn-sm mr-1 swal_status_change text-white">{{ __('Approve') }}</a>
<form method='post' action='{{$url}}' class="d-none">
<input type='hidden' name='_token' value='{{csrf_token()}}'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>