@if(session()->has('msg'))
    <div class="alert alert-{{session('type')}}">
        {!! session('msg') !!}
    </div>
@endif
