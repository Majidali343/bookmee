@php
    $id = $id ?? 'langchange';
    $name = $name ?? 'lang';
    $selected = $selected ?? '';
@endphp

<div class="form-group">
    @if(isset($label))<label for="edit_language text-primary">{{__('Languages')}}</label> @endif
    <select name="{{$name}}" class="form-control lang-select" id="{{$id}}">
        @foreach(App\Helpers\LanguageHelper::all_languages() as $lang)
            <option value="{{$lang->slug}}" @if($lang->slug === $selected) selected @endif >{{$lang->name}}</option>
        @endforeach
    </select>
</div>
