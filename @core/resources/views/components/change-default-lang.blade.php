<a tabindex="0" class="btn btn-warning btn-xs mb-3 mr-1 swal_change_language_button">
    {{__('Make Change')}}
</a>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>
