@php  $value = ($value)?? ''; @endphp
<div class="form-group">
    <label for="{{$name}}">{{$title}}</label>
    <select name="{{$name}}"  class="form-control">
        <option @if($value === 'publish') selected @endif value="publish">{{__('Publish')}}</option>
        <option @if($value === 'draft') selected @endif value="draft">{{__('Draft')}}</option>
    </select>
</div>