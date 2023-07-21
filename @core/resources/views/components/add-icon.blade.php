<div class="form-group">
    <label for="{{ $name }}" class="d-block"> {{ $title }} </label>
    <div class="btn-group {{ $id }}">
        <button type="button" class="btn btn-info bt-xl iconpicker-component">
            <i class="{{ (isset($value))? get_static_option($value) : (($setval)??'fas fa-phone') }}"></i>
        </button>
        <button type="button" class="icp icp-dd btn bt-xl btn-info dropdown-toggle"
                data-selected="{{ (isset($value))? get_static_option($value) : (($setval)??'fas fa-phone') }}" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">{{__("Toggle Dropdown")}}</span>
        </button>
        <div class="dropdown-menu"></div>
    </div>
    <input type="hidden" class="form-control"  id="{{ $id }}" name="{{ $name }}" value="{{ (isset($value))? get_static_option($value) : (($setval)??'fas fa-phone') }}">
</div>
