@php
    use App\ServiceCity;
    if (Session::get('cityid')) {
        $cityid = Session::get('cityid');
    
        $all_cities = ServiceCity::whereNotIn('id', [$cityid])
            ->where('status', 1)
            ->get();
    } else {
        $all_cities = ServiceCity::where('status', 1)->get();
    }
@endphp



@if (Auth::guard('web')->check())
    <div class="selectingstyle">
        <select name="overallcity">
            <option value="">{{ Session::get('cityname') ?: 'Select City' }}</option>

            @foreach ($all_cities as $cities)
                <option value={{ $cities->id }}> {{ $cities->service_city }} </option>
            @endforeach
        </select>

    </div>


    <div class="login-account">
        <li>
            <div class="info-bar-item-two">
                <div class="author-thumb">
                    @if (!empty(Auth::guard('web')->user()->image))
                        {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
                    @else
                        <img src="{{ asset('assets/frontend/img/static/user_profile.png') }}" alt="No Image">
                    @endif

                </div>

                <a class="accounts loggedin" style="color: white;" href="javascript:void(0)">
                    <span class="title"> {{ Auth::guard('web')->user()->name }} </span>
                </a>
                <ul class="account-list-item mt-2">
                    <li class="list">
                        @if (Auth::guard('web')->user()->user_type == 0)
                            <a href="{{ route('seller.dashboard') }}"> {{ __('Dashboard') }} </a>
                        @else
                            <a href="{{ route('buyer.dashboard') }}"> {{ __('Dashboard') }} </a>
                        @endif
                    </li>
                    <li class="list"> <a href="{{ route('seller.logout') }}"> {{ __('Logout') }} </a> </li>
                </ul>
            </div>
        </li>
    </div>
@else
    <div class="selectingstyle">
        <select name="overallcity">
            <option value="">{{ Session::get('cityname') ?: 'Select City' }}</option>

            @foreach ($all_cities as $cities)
                <option value={{ $cities->id }}> {{ $cities->service_city }} </option>
            @endforeach
        </select>

    </div>
    <div class="login-account">

        <a class="accounts" style="color: rgb(255, 255, 255);" href="javascript:void(0)"> <span
                class="account">{{ __('Account') }}</span> <i class="las la-user coloruser"></i> </a>
        <ul class="account-list-item mt-2">
            <li class="list"> <a href="{{ route('user.register') }}"> {{ __('Register') }} </a> </li>
            <li class="list"> <a href="{{ route('user.login') }}">{{ __('Sign In') }} </a> </li>
        </ul>
    </div>
@endif
<style>
.selectingstyle .select2-container--default .select2-selection--single {
    
    
    background:transparent;
    border:1px solid #fff;
}

.selectingstyle .select2-container--default .select2-selection--single .select2-selection__rendered{color:white;}

.selectingstyle{
    position: relative;
    right: 23px;
}

.iconuser{
    color:white;
}
/* Smartphones */
@media (max-width: 767px) {
  /* CSS styles for smartphones and small mobile devices */
  .selectingstyle{
    width: 97px;
    left: 194px;
    top: -42px;
}

.coloruser{
         color: black;
        }
}


/* Tablets */
@media (min-width: 768px) and (max-width: 991px) {
  /* CSS styles for tablets */
  .selectingstyle{
   position: relative;
    left: 579px;
    
    top: -44px;
    width: 100px;
}
.coloruser{
         color: black;
        }

}

</style>


<script>
    $(document).ready(function() {
        $("select[name='overallcity']").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue) {

                $.ajax({
                    url: "{{ route('storeData') }}",
                    type: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'data': selectedValue
                    },
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = window.location.href;
                    }
                });
            }
        });
    });
</script>
@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    
@endsection
