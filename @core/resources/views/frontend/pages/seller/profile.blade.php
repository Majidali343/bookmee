@extends('frontend.frontend-page-master')

@section('page-meta-data')
    <title> {{ $seller->name }}</title>
@endsection

@section('style')
    <style>
        .profile-flex-content {
            flex-wrap: nowrap !important;
        }

        .seller-social-links {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .seller-social-links a {
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 25px;
            width: 25px;
            background-color: #fff;
            color: var(--main-color-one);
            border-radius: 50%;
            transition: all .3s;
        }

        .seller-social-links a:hover {
            background-color: var(--main-color-one);
            color: #fff;
        }

        .seller-verified {
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            background-color: var(--main-color-one);
            color: #fff;
            border-radius: 50%;
        }

        .profile-flex-content .profile-contents .title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .info-box {
            background: #FAFAFA;
            border-radius: 10px;
            padding: 20px
        }

        .heading {
            color: var(--main-color-one);
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 13px;
            line-height: 46px;
            display: flex;
            align-items: center;
        }

        .heading-small {
            color: var(--main-color-one);
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 13px;
            line-height: 24px;
        }

        .info-box .center {
            display: flex;
            align-items: center;
            font-size: 13px;
        }


        .bold-text {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            font-size: 13px;
            line-height: 24px;
            display: flex;
            align-items: center;
            color: #333333;
            justify-content: center;

        }

        .space {
            margin-bottom: 30px;
        }

        .info-box .divider {
            border: 1px solid #CCCCCC;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .info-box .profile-pic>img {
            border-radius: 142px;
            object-fit: cover;
        }

        .info-box .staff-item>div {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .info-box .phone-action {
            background: #FFFFFF;
            border: 1px solid #233857;
            color: var(--main-color-one);
            border-radius: 5px;
            width: 69px;
            height: 34px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobilework {
            display: block;
        }


        .info-box .card-info {
            border-radius: 10px;
            height: 95px;

        }

        .bussiness-details .image>img {
            border-radius: 142px;
            object-fit: cover;
        }

        .text-recom {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 18px;
            display: flex;
            align-items: center;
            text-align: center;
            color: #FFFFFF;
        }

        .recommended-container {
            background: var(--main-color-one);
            width: 202.2px;
            height: 32px;
            opacity: 0.8;
            border-radius: 5px;
            align-items: center;
            justify-content: space-evenly;
            padding: 5px;
            margin-left: 20px;
        }

        .review-card {
            border: 1px solid #EBEBEB;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
            min-height: 200px;
            margin-bottom: 20px;
        }

        .review-star {
            color: #FFB700;
            border-radius: 1px;
            font-size: 32px;
        }

        .review-card .name {
            font-family: 'inter', sans-serif;
            font-style: italic;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            display: flex;
            align-items: center;
            color: #767676;
        }

        .review-card .icon-bg-circle {
            width: 20px;
            height: 20px;
            background: var(--main-color-two);
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ifmobilework {
            display: none;
        }

        .discount {

            z-index: 100;
            padding-left: 10px;
            padding-top: 7px;
            Width: 133px;
            Height: 36px;
            border-Radius: 60px;
            Gap: 10px;
            background-color: #03989E4D;
            Font-family: "Inter";
            font-Weight: 600;
            Size: 14px;
            color: #03989E;
        }


        .discountedprice {

            z-index: 100;
            color: #C3D0CF;
            Font-family: "Inter";
            font-Weight: 600;
            font-size: 14px;
            text-decoration-line: line-through;
            text-decoration-thickness:2px;

        }

        .time {

            z-index: 100;
            Font-family: "Inter";
            font-Weight: 500;
            padding-left: 16px;
            font-size: 14px;
        }


        @media only screen and (max-width: 1000px) {
            .sidebar-section {
                width: 100% !important;
            }

            .main-section {
                width: 100% !important;
            }

            .single-services-item {
                width: 100%;
            }
        }

        .single-prices {
            width: 86px;

            border-radius: 38px;
            color: white;
            background: var(--main-color-two);

            top: 365px;
            left: 1014px;
            padding: 7.5px 17.009995px 9.5px 28px;
            border-radius: 38px;

        }

        @media only screen and (max-width: 600px) {
            .sidebar-section {
                width: 100% !important;
            }

            .main-section {
                width: 100% !important;
            }

            .single-services-item {
                width: 100%;
            }

            .mobilework {
                display: none;
            }

            .ifmobilework {
                display: block;
                /* margin-left: -10px; */
            }

            .margin {
                margin: 20px 20px;
            }

            .marginleft {
                margin-left: 40px;
            }

            .marginboth {
                margin-left: 50px;
                margin-right: 50px;
                text-align: justify;
            }
            .discount {
                Width: 108px;
                Height: 31px;
                font-size: 11px;
            }

            .service-details-slider {
            width: calc(100% - 24px) ;
                height: 310px !important;
            }

            .service-details-background-image {
                height: 315px;
            }

            .single-prices {
                width: 58px;
                padding: 10px;
                border-radius: 34px;
                background: var(--main-color-two);
            }

            .slug{
            color: black;
            font-weight:700;
            font-size: 15px;
            }
            .single-service .services-contents .service-price .prices {
                font-size: 16px;
                font-weight: 700;
                width: 100px;
                line-height: 55px;
                color: #233857;
            }

        .time{
            padding-left: 2px;
        }

        }




        @media only screen and (max-width: 750px) {


            .single-services {
                width: 70%;
            }


        }

      

        @media only screen and (min-width: 1200px) {
            .center-mobile {
                justify-content: center !important;
            }

            .single-services-item {
                width: 100%;
            }

            .margin {
                margin: 20px 20px;
            }

            .marginleft {
                margin-left: 40px;
            }

            .marginboth {
                margin-left: 50px;
                margin-right: 50px;
                text-align: justify;
            }



        }


        .service-cotent-changes {
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        @media only screen and (max-width: 1490px) {
            .single-services-item {
                width: 100% !important;
            }
        }

        .price-container {
            display: flex;
            flex-direction: column;
            align-content: flex-start;
            flex-wrap: wrap;

        }

        .service-thumb {
            height: 236px;
        }

        .search-input::placeholder {
            font-family: 'inter', sans-serif;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 20px;
            display: flex;
            align-items: center;
            color: #999999;

        }

        .gallery-images {
            background-size: cover;
            object-fit: contain;
            background-repeat: no-repeat;
        }

        .service-details-slider .slick-dots li.slick-active {
            background-color: var(--main-color-two);
        }

        .slick-arrow {
            background: white !important;
            border-radius: 100% !important;
            height: 40px !important;
            width: 40px !important;
        }

        .slick-arrow i {
            color: var(--main-color-two)
        }

        .services-area {
            background: transparent;
        }

        .groupName .name {
            color: #999;
            font-family: Poppins;
            font-size: 22px;
            font-style: normal;
            font-weight: 500;
            line-height: 28px;
            min-width: fit-content;
            margin-right: 36px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .border {
            border: solid 2px #DEE2E6;

        }

        .title-main {
            font-family: 'Poppins';
            font-size: 28px;
            font-weight: 700;
            line-height: 46px;
            letter-spacing: 0em;
            text-align: left;

        }


        /* new style */
        .slug{
            color: black;
            font-weight:700;
        }

        .service-body-flex {
            display: flex;
            justify-content: space-between;
            margin: 30px 0px;
            padding: 12px 0px;
            border-radius: 20px;
            background: #FAFAFA;
        }

        .discount-title {
            padding-top: 15px;
            padding-left: 17px;
        }

        .right-container {
            padding-right: 19px;
            padding-top: 20px;
        }
        .service-price{
          display: flex;
          padding: 10px 14px 26px 11px;
        }

        .margincont{
            margin:0px 12px;
        }


    </style>
@endsection


@section('content')

    <div class=" align-items-center">


        <div class="d-flex flex-wrap">

            <div class="main-section m-1" style="width:74%">
                <!-- Banner Inner area Starts -->

                {{-- @dd($seller_rating_percentage_value); --}}
                @if (!empty($seller))

                    <div class="service-details-slider margincont mobilework">
                        @if ($seller->profile_gallery != null)
                            @forelse(explode("|", $seller->profile_gallery) as $id)
                                <div class="single-slider">
                                    <div class="gallery-images single-featured service-details-background-image"
                                        style="background-image: url({{ get_attachment_image_by_id($id)['img_url'] }}); ">
                                    </div>
                                </div>

                            @empty
                                <div></div>
                            @endforelse
                        @endif

                    </div>

                    <div class="ifmobilework">
                        @if ($seller->profile_gallery != null)
                            <div class=" service-details-slider margincont">
                                @forelse(explode("|", $seller->profile_gallery) as $id)
                                    <div class="single-slider">
                                        <div class="gallery-images single-featured service-details-background-image"
                                            style="background-image: url({{ get_attachment_image_by_id($id)['img_url'] }});">
                                        </div>
                                    </div>

                                @empty
                                    <div></div>
                                @endforelse
                            </div>
                        @endif
                    </div>




                @endif
                <!-- Banner Inner area end -->

                <!-- Featured Service area starts -->
                @if (!empty($services))
                    <section class="services-area " style="padding-top: 50px;padding-bottom:50px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="d-flex justify-content-between flex-wrap ">
                                        <h3 class=" title-main" style=" color:#333333;">
                                            {{ __('Services of this Seller') }} </h3>
                                        <div class="search d-flex flex-row align-items-center justify-content-between"
                                            style="padding-left:26px;height: 52px;border:solid 1px #E0E0E0; min-width:340px;max-width:430px;border-radius: 10px;">
                                            <div class="d-flex">
                                                <div class="icon"><img src="https://i.imgur.com/fgPbs95.png"
                                                        width="20px" height="20px"></div>
                                                <div class="input"><input type="text" class="search-input"
                                                        id="search-input"placeholder="Search Services"
                                                        style="margin-left:14px;border: none;height: 100%;"></div>
                                            </div>
                                            <div id="search-button"
                                                class="button d-flex justify-content-center align-items-center"
                                                style="cursor: pointer;height:100%;background:var(--main-color-two);width:80px;border-radius: 0px 10px 10px 0px;">
                                                <div class="icon"><img src="https://i.imgur.com/ubNkkR7.png"
                                                        width="20px" height="20px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- service work edit --}}

                            <div class="row margin-top-50">
                                <div class="col-lg-12">

                                    @php
                                        $discountsArray = $discounts->toArray();
                                        $Timearray = $Time->toArray();
                                        $counter = 0;
                                    @endphp

                                    <div class="">

                                        @foreach ($services as $idx => $group)
                                            <div class="groupName  d-flex align-items-center">

                                                <div class="name">
                                                    @if (!$group['group'] == null)
                                                        {{ $group['group'] }}
                                                    @else
                                                        Other Services
                                                    @endif
                                                </div>
                                                <span class="border w-100"></span>
                                            </div>

                                            <div class="services">
                                                @php
                                                    $services = $group['services'];
                                                    $group = count($services);
                                                @endphp

                                                @for ($i = 0; $i < $group; $i++)
                                                    @for ($di = 0; $di < $discountcount; $di++)
                                                        @if ($discountsArray[$di]['discountid'] == $services[$i]->id)
                                                            <div class="service-body-flex">

                                                                <div class="discount-title">


                                                                    <h5 class="">
                                                                        <a class="slug"  
                                                                            href="{{ route('service.list.details', $services[$i]->slug) }}">{{ $services[$i]->title }}

                                                                        </a>
                                                                    </h5>
                                                                    @if (!empty($discountsArray[$di]['discount']))
                                                                        <div class="discount">Save upto
                                                                            {{ \Illuminate\Support\Str::limit($discountsArray[$di]['discount'], 4, '') }}
                                                                            % </div>
                                                                    @endif

                                                                </div>
                                                                @php
                                                                    
                                                                    $discount_percent = $services[$i]->price * $discountsArray[$di]['discount'];
                                                                    
                                                                    $Percentage_amt = $discount_percent / 100;
                                                                    
                                                                    $percentage_Amount = $services[$i]->price - $Percentage_amt;
                                                                    
                                                                @endphp
                                                                <div class="right-container">

                                                                    <div class="min-right" style=" display: flex;">
                                                                        <div class="service-price " >
                                                                            @if (!empty($discountsArray[$di]['discount']))
                                                                                <div class="discountedprice">
                                                                                    {{ amount_with_currency_symbol($services[$i]->price) }}
                                                                                </div>
                                                                            @endif
                                                                            <span  class="prices" style="margin-left: 8px" >{{ amount_with_currency_symbol($percentage_Amount) }}
                                                                            </span>

                                                                        </div>

                                                                        <div>

                                                                            <div class="btn-wrapper single-prices">
                                                                                <a href="{{ route('service.list.book', $services[$i]->slug) }}"
                                                                                    class=" ">{{ __('Book') }}
                                                                                </a>
                                                                            </div>

                                                                            @if (!empty($Timearray[$di]))
                                                                                <div class="time"> {{ $Timearray[$di] }}
                                                                                    mins
                                                                                </div>
                                                                            @endif

                                                                        </div>


                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    @endfor
                                                @endfor
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>



                        </div>
                    </section>
                @endif
                <!-- Featured Service area ends -->

                <!-- Review seller area Starts -->
                @if ($service_reviews->count() >= 1)
                    <div class="review-seller-area padding-bottom-100">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="heading" style="font-size:32px; color:#333333; margin-bottom:40px; ">
                                        {{ get_static_option('service_reviews_title') ?? __('Reviews    ') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="review-seller-wrapper">
                                        <div class="about-review-tab">
                                            @foreach ($service_reviews as $review)
                                                <div class="review-card">
                                                    <div class="d-flex w-100 justify-content-between flex-wrap mb-2">
                                                        <div class="stars">
                                                            @for ($i = 0; $i < $review->rating; $i++)
                                                                <span class="icon review-star"> <i class="las la-star"></i>
                                                                </span>
                                                            @endfor
                                                        </div>
                                                        <div class="date  bold-text" style="color:var(--main-color-two);">
                                                            {{ $review->updated_at->toFormattedDateString() }}
                                                            <span class="icon ml-2 icon-bg-circle">
                                                                <i class="las la-check" style="color:white;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="service bold-text">
                                                        HairCut
                                                    </div>
                                                    <div class="name">
                                                        By {{ $review->name }}
                                                    </div>
                                                    <div class="space"></div>
                                                    <div class="review  bold-text" style="font-weight:400px;">
                                                        {{ $review->message }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-pagination margin-top-55">
                                    <div class="custom-pagination mt-4 mt-lg-5">
                                        {!! $service_reviews->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Review seller area ends -->
            </div>


            <div class="sidebar-section m-1" style="width: 24%;">
                <div class="profile-sidebar">

                    <div style="height:160px ;width:100% ;">

                        <div class="bussiness-details mt-3 d-flex w-100 justify-content-center p-3 container">
                            <div class="row d-flex align-items-center justify-content-between w-100 center-mobile">
                                <div class="d-flex flex-wrap align-items-center w-100 justify-content-start center-mobile"
                                    style="max-width: 600px;">
                                    <div class="image" style="min-width: 100px!important;margin-right:30px">
                                        <img src="{{ get_attachment_image_by_id($seller->image)['img_url'] }}"
                                            width="80px"height="80px"alt="">
                                    </div>
                                    <div class="details align-self-center" style="max-width: 450px;">
                                        <div class="heading flex-wrap justify-content-start  center-mobile"
                                            style="font-size:24px;">
                                            {{ $seller->name }}
                                            {{-- <div class="recommended-container d-flex">
                                    <div class="text-recom">
                                        Recommended Buisness
                                    </div>
                                    <img src="https://i.imgur.com/JHn4KfO.png"
                                        height="18px"width="18px"alt="">
                                </div> --}}
                                        </div>
                                        {{-- <div class="heading-small description marginboth">
                                {{ $seller->about ?? '' }}
                            </div> --}}
                                    </div>
                                </div>

                                {{-- <a class="directions heading-small"
                        href="https://www.google.com/maps/dir//{{ $seller->address ?? '' }}">
                        <img src="https://i.imgur.com/C8ABrq4.png" width="60px"height="60px" alt="">
                        <div class="bold-text" style="color: #000000;">
                            Directions
                        </div>
                    </a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="space"></div>
                        <div class="location-container d-flex">
                            <div class="heading-small m-2 center">
                                Location:
                            </div>
                            <div class="location m-2 center bold-text">
                                {{ $seller->address ?? '' }}
                                <img src="https://i.imgur.com/l4PuDMC.png" width="15px" height="20px"
                                    style="margin-left:2px">
                            </div>
                        </div>
                        <div class="since d-flex">
                            <div class="heading-small m-2 center">
                                Since:
                            </div>
                            <div class="year center m-2 bold-text">
                                {{ $seller->created_at->year ?? '' }}
                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="divider"></div>
                        @if ($seller->staff->count() > 0)
                            <div class="staffers-container margin">
                                <div class="heading">
                                    Staffers
                                </div>
                                <div class="divider"></div>
                                <div class="staff row center" style="min-height: 130px;">
                                    @foreach ($seller->staff as $staff)
                                        <div class="staff-item mr-2 ml-2">
                                            <div class="profile-pic">
                                                <img src="{{ get_attachment_image_by_id($staff->profile_image_id)['img_url'] }}"
                                                    width="60px" height="60px">
                                            </div>
                                            <div class="name bold-text">
                                                {{ $staff->name }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="contact-bussiness-hours margin">
                            <div class="heading">
                                Contacts & Business Hours
                            </div>
                            <div class="divider"></div>
                            <div class="phone ">
                                <div class="mt-3 ml-2 mb-3 d-flex justify-content-between">
                                    <div class="row bold-text">
                                        <img width="24px"
                                            height="24px"src="https://i.imgur.com/qmx26uC_d.webp?maxwidth=760&fidelity=grand"
                                            class="mr-3">
                                        {{ $formattedPhoneNumber ?? '' }}
                                    </div>
                                    <div class="">
                                        <a class="phone-action" href="tel:{{ $formattedPhoneNumber ?? '' }}">
                                            Call
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="space"></div>

                            <div class="hours-all">
                                @if (!empty($businesstimings))
                                    @foreach ($businesstimings as $businessTimings)
                                        <div class="hour d-flex justify-content-between mt-2 mb-2">
                                            <div style="display: flex;flex-direction:row;">
                                                <p class='heading-small' style="color: #233857;width: 95px;">
                                                    {{ $businessTimings->day }}
                                                    &nbsp;
                                                </p>
                                                <p class='heading-small' style="color: #233857;">
                                                    {{ $businessTimings->to_time . ' To ' . $businessTimings->from_time }}
                                                </p>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h5 style="color: rgb(255, 217, 0);">Business Hours Not added</h5>
                                @endif



                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="card-info row margin"style="background: var(--main-color-one);">
                            <div style="font-size:32px" class="icon col-4 center">
                                <i style="color:#FFB700;width:40px;height:37px;background:white;padding-left: 4px;
                                border-radius: 19px;"
                                    class="las la-star"></i>
                                {{-- <img src="https://i.imgur.com/5jiKo9A.png" width="40px" height="40px"alt=""> --}}
                            </div>
                            <div class="d-flex flex-column" style="align-items: flex-start;justify-content: center;">
                                <div class="heading bold-text"style="color: #FFFFFF;">Seller Rating</div>
                                <div class="review-percent bold-text"style="color: #FFFFFF;">
                                    {{ $seller_rating_percentage_value }}</div>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="card-info row margin"style="background: #03989E">
                            <div class="icon col-4 center">
                                <img src="https://i.imgur.com/atNXEkw.png" width="40px" height="40px"alt="">
                            </div>
                            <div class="d-flex flex-column" style="align-items: flex-start;justify-content: center;">
                                <div class="heading bold-text"style="color: #FFFFFF;">Services Completed</div>
                                <div class="review-percent bold-text"style="color: #FFFFFF;">{{ count($seller->order) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        $(document).ready(function() {
            $("#search-button").on("click", function() {
                var value = document.getElementById('search-input').value.toLowerCase().trim();
                $(".single-services-item").show().filter(function() {
                    return $(this).find('.service-title').text().toLowerCase().trim().indexOf(
                        value) == -1;
                }).hide();
            });
        });
    </script>
@endsection
