<div class="form-group">
    <label for="lang">{{__('Languages')}}</label>
    <select name="lang" id="language" class="form-control">
        @foreach(get_all_language() as $lang)
            <option value="{{$lang->slug}}">{{$lang->name}}</option>
        @endforeach
    </select>
</div>