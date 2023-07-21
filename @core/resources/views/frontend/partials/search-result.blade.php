
 <div class="card text-white bg-secondary mb-3 mt-2" style="border:none">
    <div class="card-body home_servie_serach_wrapper">
        @if($vendors->count() >0)
            @foreach($vendors as $vendor)
              <a href="/{{ $vendor->username }}" class="search_servie_image_content text-left text-white">
                <div class="search_thumb bg-image" {!! render_background_image_markup_by_attachment_id($vendor->image,'','thumb') !!}></div>
                  <span class="search-text-item">
                    {{ $vendor->name }}
                    <br>
                    {{$vendor->address}}
                  </span>
                </a>
            @endforeach
        @else 
           <p class="text-left text-warning">{{ __("Nothing Found") }}</p>
        @endif
    </div>
  </div>