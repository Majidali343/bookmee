@php
    $all_image_fields =  get_static_option($First_Image_title  ?? '');
    $all_image_fields = !empty($all_image_fields) ? unserialize($all_image_fields,['class' => false]) : [''];

@endphp

{{--<x-repeater.markup--}}
{{--        :First_Image_title="'home_page_02_mission_vission_area_left_bg_image'"--}}
{{--        :item_title="'home_page_02_mission_vission_area_right_item_{{$lang->slug}}_title'"--}}
{{--        :item_subtitle="'home_page_02_mission_vission_area_right_item_{{$lang->slug}}_subtitle'"/>--}}

@foreach($all_image_fields as $index => $image_field)
    <div class="iconbox-repeater-wrapper">
        <div class="all-field-wrap">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($all_languages as $key => $lang)
                    <li class="nav-item">
                        <a class="nav-link @if($key == 0) active @endif" data-toggle="tab"
                           href="#tab_{{$lang->slug}}_{{$key + $index}}" role="tab"
                           aria-selected="true">{{$lang->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content margin-top-30" id="myTabContent">
                @foreach($all_languages as $key => $lang)
                    @php
                        $all_item_title_fields = get_static_option($item_title ?? '');
                        $all_item_title_fields = !empty($all_item_title_fields) ? unserialize($all_item_title_fields,['class' => false]) : [''];

                        $all_item_subtitle_fields = get_static_option($item_subtitle ?? '');
                        $all_item_subtitle_fields = !empty($all_item_subtitle_fields) ? unserialize($all_item_subtitle_fields,['class' => false]) : [''];

                    @endphp

                    <div class="tab-pane fade @if($key == 0) show active @endif"
                         id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel">


                        <div class="form-group">
                            <label>{{__('Item Title')}}</label>
                            <input type="text"
                                   name="{{$item_title[]}}"
                                   class="form-control"
                                   value="{{$all_item_title_fields[$index] ?? ''}}">
                        </div>

                        <div class="form-group">
                            <label>{{__('Item Subtitle')}}</label>
                            <input type="text"
                                   name="{{$item_subtitle[]}}"
                                   class="form-control"
                                   value="{{$all_item_subtitle_fields[$index] ?? ''}}">
                        </div>


                    </div>
                @endforeach

                <div class="form-group">
                    <label >{{__(' Image')}}</label>
                    @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                    <div class="media-upload-btn-wrapper">
                        <div class="img-wrap">
                            @php
                                $signature_img = get_attachment_image_by_id($image_field,null,false);
                            @endphp
                            @if (!empty($signature_img))
                                <div class="attachment-preview">
                                    <div class="thumbnail">
                                        <div class="centered">
                                            <img class="avatar user-thumb"
                                                 src="{{$signature_img['img_url']}}">
                                        </div>
                                    </div>
                                </div>
                                @php $signature_image_upload_btn_label = 'Change Image'; @endphp
                            @endif
                        </div>
                        <input type="hidden" name="{{$First_Image_title[]}}"
                               value="{{$image_field}}">
                        <button type="button" class="btn btn-info media_upload_form_btn"
                                data-btntitle="{{__('Select Image')}}"
                                data-modaltitle="{{__('Upload Image')}}"
                                data-imgid="{{$image_field}}" data-toggle="modal"
                                data-target="#media_upload_modal">
                            {{__($signature_image_upload_btn_label)}}
                        </button>
                    </div>
                    <small>{{__('recommended image size is 384 x 445 pixel')}}</small>
                </div>




            </div>
            <div class="action-wrap">
                <span class="add"><i class="ti-plus"></i></span>
                <span class="remove"><i class="ti-trash"></i></span>
            </div>
        </div>
    </div>
@endforeach