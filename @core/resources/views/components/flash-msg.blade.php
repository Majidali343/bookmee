@if(session()->has('msg'))
    <div class="alert alert-danger alert-{{session('type')}}">
        {!! session('msg') !!}
    </div>
@endif
