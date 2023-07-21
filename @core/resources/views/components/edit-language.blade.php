<div class="form-group">
    <label for="edit_language">{{__('Languages')}}</label>
    <select name="lang" id="edit_language" class="form-control">
        @foreach(get_all_language() as $lang)
        <option value="{{$lang->slug}}">{{$lang->name}}</option>
        @endforeach
    </select>
</div>