<form action="{{$url}}" method="post" class="d-inline-block">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <button type="submit" title="clone this to new draft"
            class="btn btn-xs btn-secondary btn-sm mb-3 mr-1"><i
                class="far fa-copy"></i></button>
</form>