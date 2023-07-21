@php
    $testimonial_img = get_attachment_image_by_id($image,null,true);
@endphp

@if (!empty($testimonial_img))
    <div class="attachment-preview">
        <div class="thumbnail">
            <div class="centered">
                <img class="avatar user-thumb"
                     src="{{$testimonial_img['img_url']}}" alt="">
            </div>
        </div>
    </div>
    @php  $img_url = $testimonial_img['img_url']; @endphp
@endif