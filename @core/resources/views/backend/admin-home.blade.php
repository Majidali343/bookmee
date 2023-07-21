@extends('backend.admin-master')
@section('site-title')
    {{__('Dashboard')}}
@endsection

@section('style')
    <style>
    .bg_card_color_one{
        background: rgb(2,0,36);
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(65,107,125,1) 35%, rgba(0,212,255,1) 100%); 
    }
    .bg_card_color_two{
        background: rgb(34,193,195);
        background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(50,120,119,1) 100%);  
    }

    .orders-child:nth-child(4n+2) .single-orders {
      background: #1dbf73;
    }
    .orders-child:nth-child(4n+2) .single-orders .icon {
      color: #1dbf73;
    }
    
    .orders-child:nth-child(4n+3) .single-orders {
      background: #C71F66;
    }
    .orders-child:nth-child(4n+3) .single-orders .icon {
      color: #C71F66;
    }
    
    .orders-child:nth-child(4n+4) .single-orders {
      background: #6560FF;
    }
    .orders-child:nth-child(4n+4) .single-orders .icon {
      color: #6560FF;
    }
      
    .single-orders {
      background: #f3733c;
      padding: 35px 30px;
      border-radius: 10px;
      position: relative;
      z-index: 2;
      overflow: hidden;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders {
        padding: 20px 20px;
      }
    }
    .single-orders .orders-shapes img {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    .single-orders .orders-flex-content {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      gap: 30px;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .icon {
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      height: 67px;
      width: 67px;
      font-size: 40px;
      background: #fff;
      color: var(--main-color-three);
      border-radius: 50%;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
    .single-orders .orders-flex-content .contents .order-titles {
      font-size: 35px;
      font-weight: 700;
      line-height: 55px;
      color: #fff;
      margin: 0;
    }
    .single-orders .orders-flex-content .contents .order-para {
      font-size: 18px;
      font-weight: 500;
      line-height: 20px;
      color: #fff;
    }
    
    @media (min-width: 1400px) and (max-width: 1730px) {
      .single-orders {
        padding: 20px 20px;
      }
    
      .single-orders .orders-flex-content {
        display: block;
        text-align: center;
      }
    
      .single-orders .orders-flex-content .icon {
        margin: 0 auto;
        text-align: center;
      }
    }
         
</style>
@endsection

@section('content')
    
    <div class="main-content-inner">
        <div class="row">
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles">{{ $total_admin }} </h2>
                            <span class="order-para">{{ __('Total Admin') }} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes2.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles">{{ $total_seller }} </h2>
                            <span class="order-para"> {{ __('Total Seller') }} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes3.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> {{ $total_buyer }} </h2>
                            <span class="order-para"> {{ __('Total Buyer') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes4.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-file-invoice-dollar"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles">{{ float_amount_with_currency_symbol($total_earning) }} </h2>
                            <span class="order-para">{{ __('Total Earning') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-tasks"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> {{ $pending_order }} </h2>
                            <span class="order-para">{{ __('Order Pending') }} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes2.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-handshake"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> {{ $pending_service }} </h2>
                            <span class="order-para">{{ __('Pending Service')}} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes3.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles"> {{ $pending_payout_request }}</h2>
                            <span class="order-para"> {{ __('New Payout Request') }} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                <div class="single-orders">
                    <div class="orders-shapes">
                        <img src="{{ asset('assets/frontend/img/static/orders-shapes4.png') }}" alt="">
                    </div>
                    <div class="orders-flex-content">
                        <div class="icon">
                            <i class="las la-user-circle"></i>
                        </div>
                        <div class="contents">
                            <h2 class="order-titles">{{ $new_user_today }}</h2>
                            <span class="order-para">{{ __('New User Today') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h4 class="mb-3 earning-title">{{ __('Most Viewed Services') }}</h4>
                <div class="table-wrap table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('View')}}</th>
                        <th>{{__('Details')}}</th>
                        </thead>
                        <tbody>
                            @foreach($most_viewed_10_services as $key=>$service)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ float_amount_with_currency_symbol($service->price) }}</td>
                                    <td>{{ $service->view }}</td>
                                    <td>
                                         @if(!empty($service->id))
                                            <a class="btn btn-success" href="{{route('admin.service.view.details',$service->id)}}"> <i class="ti-eye"></i</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="mb-3 earning-title">{{ __('Most Ordered Services') }}</h4>
                <div class="table-wrap table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('View')}}</th>
                        <th>{{__('Details')}}</th>
                        </thead>
                        <tbody>
                            @foreach($most_sell_10_services as $service)
                                <tr>
                                    <td>{{ optional($service->service)->id }}</td>
                                    <td>{{ optional($service->service)->title }}</td>
                                    <td>{{ float_amount_with_currency_symbol(optional($service->service)->price) }}</td>
                                    <td>{{ optional($service->service)->view }}</td>
                                    <td>
                                        @if(!empty($service->service))
                                            <a class="btn btn-success" href="{{route('admin.service.view.details',optional($service->service)->id)}}"> <i class="ti-eye"></i</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title">{{ __('Last 12 Month Income Overview') }} </h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title">{{ __('Daily Income Overview Last 30 Days') }}</h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title">{{ __('Last 12 Month Order Overview') }}</h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="line-charts-wrapper">
                    <div class="line-top-contents">
                        <h5 class="earning-title">{{ __('Daily Order Overview Last 30 Days') }}</h5>
                    </div>
                    <div class="line-charts">
                        <canvas id="line-chart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
 @php

 @endphp

@section('script')
    <script src="{{asset('assets/backend/js/chart.js')}}"></script>
    <script>
    /* Line Charts */
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [@foreach($month_list as $list) "{{ $list }}", @endforeach],
            datasets: [{
                data: [@foreach($monthly_income_list as $list) "{{ $list }}", @endforeach],
                label: "Monthly Income",
                borderColor: "#1DBF73",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart2"), {
        type: 'bar',
        data: {
            labels: [@foreach($days_list as $list) "{{ $list }}", @endforeach],
            datasets: [{
                data: [@foreach($daily_income_list as $list) "{{ $list }}", @endforeach],
                label: "Daily Income",
                borderColor: "#D9E268",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart3"), {
        type: 'line',
        data: {
            labels: [@foreach($month_list as $list) "{{ $list }}", @endforeach],
            datasets: [{
                data: [@foreach($monthly_order_list as $list) "{{ $list }}", @endforeach],
                label: "Monthly Order",
                borderColor: "#2F98DC",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    new Chart(document.getElementById("line-chart4"), {
        type: 'bar',
        data: {
            labels: [@foreach($days_list as $list) "{{ $list }}", @endforeach],
            datasets: [{
                data: [@foreach($daily_order_list as $list) "{{ $list }}", @endforeach],
                label: "Daily Order",
                borderColor: "#ED27AB",
                borderWidth: 3,
                fill: false,
                pointBorderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#1DBF73",
            }]
        },
    });

    </script>
@endsection
