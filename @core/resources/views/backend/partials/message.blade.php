@if(session()->has('msg'))
    <div class="alert alert-{{session('type')}}">
        {!! purify_html(session('msg')) !!}
    </div>
@endif
