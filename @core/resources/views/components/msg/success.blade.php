@if(session()->has('msg'))
    <div class="alert alert-{{session('type')}}">
        {!! Purifier::clean(session('msg')) !!}
    </div>
@endif
