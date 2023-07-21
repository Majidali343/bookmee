<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach($all_languages as $key => $lang)
            <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
        @endforeach
    </div>
</nav>