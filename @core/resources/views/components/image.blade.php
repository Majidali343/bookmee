@php $id = isset($id) ? $id : null; @endphp
@php $class = isset($class) ? $class : null; @endphp

<div class="form-group {{$class}}">
    <label for="{{$name}}">{{__($title)}}</label>
    @php $signature_image_upload_btn_label = __('Upload Image'); @endphp
    <div class="media-upload-btn-wrapper">
        <div class="img-wrap">
            @php
                if (is_null($id)){
                    $id = get_static_option($name);
                }
                $signature_img = get_attachment_image_by_id($id,null,false);
            @endphp
            @if (!empty($signature_img))
                <div class="rmv-span"><i class="{{isset($type) && $type === 'user' ? 'las la-trash' : 'ti-trash' }}"></i></div>
                <div class="attachment-preview">
                    <div class="thumbnail">
                        <div class="centered">
                            <img class="avatar user-thumb" src="{{$signature_img['img_url']}}" >
                        </div>
                    </div>
                </div>
                @php $signature_image_upload_btn_label = __('Change Image'); @endphp
            @endif
        </div>
        <br>
        <input type="hidden" name="{{$name}}" value="{{$id}}">
        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$id ?? ''}}" data-toggle="modal" data-target="#media_upload_modal">
            {{__($signature_image_upload_btn_label)}}
        </button>
    </div>
    @if(isset($dimentions) && !empty($dimentions)) <small>{{__('recommended image size is')}} {{$dimentions ?? ''}}</small> @endif
</div>