@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Subscription')}}
@endsection
@section('content')

    <x-frontend.seller-buyer-preloader/>

    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.seller.partials.sidebar')

                    <div class="dashboard-right">
                        @if($subscription)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-settings margin-top-40">
                                        <h2 class="dashboards-title"> {{__('Current Subscription Details')}} </h2>
                                        <p class="text-info">{{ __('Note: Pending connect will be added to available connect only the payment status is completed.') }}, {{ get_static_option('set_number_of_connect') }}  {{ __('Connect will reduce for each order from available connects') }}</p>
                                        
                                    </div>
                                </div>
                                @if(moduleExists('Wallet'))
                                <div class="col-lg-12">
                                    <div class="dashboard-settings margin-top-40">
                                        <form action="{{ route('seller.subscription.renew') }}" method="post" id="renew_current_subscription_using_wallter_balance_form">
                                            @csrf
                                            <input type="hidden" value="{{ optional($subscription->subscription)->id }}" name="subscription_id">
                                             <button type="submit" id="renew_current_subscription_using_wallter_balance" class="btn btn-warning">{{ __('Renew Current Subscription') }} <br> {{ __('Before Expired') }}</button>
                                             <span  class="btn btn-success">
                                                 @php $balance =  \Modules\Wallet\Entities\Wallet::select('balance')->where('buyer_id',Auth::guard('web')->user()->id)->first() @endphp
                                                 {{ __('Wallet Balance') }}<br>
                                                 {{ float_amount_with_currency_symbol($balance->balance ?? 0) }}
                                             </span>
                                        </form>
                                        <p class="text-info">{{ __('Note: You can renew your current subscription from here using your wallet balance. Simply click on the above button and rest of the process will done automatically.') }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="dashboard-service-single-item border-1 margin-top-40">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive table-responsive--md">
                                            <table id="complete_order_table" class="custom--table">
                                                <thead>
                                                <tr>
                                                    <th> {{ __('Subscription Details') }} </th>
                                                    <th> {{ __('Type') }} </th>
                                                    <th> {{ __('Connect Details') }} </th>
                                                    <th> {{ __('Payment Details') }} </th>
                                                    <th> {{ __('Expire Date') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                          <span>{{ __('Title:') }} {{ optional($subscription->subscription)->title }} </span> <br>
                                                          <span>{{ __('Type:') }} {{ optional($subscription->subscription)->type }} </span> <br>
                                                          <span>{{ __('Connect:') }} {{ optional($subscription->subscription)->connect }} </span> <br>
                                                          <span>{{ __('Price:') }} {{ float_amount_with_currency_symbol(optional($subscription->subscription)->price) }} </span> <br>
                                                        </td>
                                                        <td> {{ ucfirst($subscription->type) }} </td>
                                                        <td>
                                                            @if($subscription->type == 'lifetime')
                                                                {{ __('Connect: ') }}  {{ __('No Limit') }} <br>
                                                            @else
                                                                {{ __('Available Connect: ') }}  {{$subscription->connect}} <br>
                                                                @if($subscription->payment_status == 'pending' || $subscription->payment_status == '')
                                                                    {{ __('Pending Connect: ') }}
                                                                    {{$subscription->initial_connect}} <br>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="service-review"> {{ __('Payment Gateway:') }} {{ ucfirst($subscription->payment_gateway) }} </span> <br>
                                                            <span class="service-review"> {{ __('Payment Status:') }}
                                                                {{ ucfirst($subscription->payment_status=='complete' ? 'complete' : 'pending') }} <br>
                                                                @if($subscription->payment_status == 'pending' || $subscription->payment_status == '')
                                                                    @if( $subscription->payment_gateway != 'manual_payment')
                                                                        <form action="{{route('seller.subscription.buy')}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="subscription_id" value="{{$subscription->id}}" >
                                                                            <input type="hidden" name="price" value="{{$subscription->initial_price}}" >
                                                                            <input type="hidden" name="type" value="{{$subscription->type}}" >
                                                                            <input type="hidden" name="seller_payment_later" value="later" >
                                                                            <input type="hidden" name="selected_payment_gateway" value="{{$subscription->payment_gateway}}">
                                                                            <button type="submit" class="small-btn btn-success margin-top-20">{{__('Pay Now')}}</button>
                                                                        </form>
                                                                    @endif
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($subscription->type == 'lifetime')
                                                                <span class="service-review">{{ __('Expire Date:') }}  {{ __('No Limit') }}</span> <br>
                                                            @else
                                                                <span class="service-review"> {{ __('Expire Date:') }}
                                                                    {{date('d-m-Y', strtotime($subscription->expire_date))}}
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h2 class="no_data_found">{{ __('No Subscription Found') }}</h2>
                        @endif

                        @if($subscription_history)
                            <div class="dashboard-service-single-item border-1 margin-top-40">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive table-responsive--md">
                                            <h2 class="dashboards-title">{{ __('Subscription History') }}</h2>
                                            <p class="text-info">{{ __('Your earlier subscription history list.') }}</p>
                                            <table id="complete_order_table" class="custom--table">
                                                <thead>
                                                <tr>
                                                    <th> {{ __('#No') }} </th>
                                                    <th> {{ __('Subscription Details') }} </th>
                                                    <th> {{ __('Payment Details') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($subscription_history as $key=>$data)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            {{ __('Title:') }} {{optional($data->subscription)->title}} <br>
                                                            {{ __('Price:') }}
                                                            @if($data->price == 0)
                                                                {{float_amount_with_currency_symbol($data->initial_price)}} <br>
                                                            @else
                                                                {{float_amount_with_currency_symbol($data->price)}} <br>
                                                            @endif
                                                            {{ __('Type:') }} {{ucfirst($data->type)}} <br>
                                                            @if($data->type != 'lifetime')
                                                                {{ __('Connect:') }}
                                                                @if($data->connect == 0)
                                                                    {{$data->initial_connect}} <br>
                                                                @else
                                                                    {{$data->connect}} <br>
                                                                @endif
                                                                {{ __('Expire Date:') }} {{date('d-m-Y', strtotime($data->expire_date))}}<br>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ __('Payment Gateway:') }} {{ ucfirst($data->payment_gateway) }} <br>
                                                            {{ __('Payment Status:') }} {{ ucfirst($data->payment_status=='complete' ? 'complete' : 'pending') }} <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="blog-pagination margin-top-55">
                                                <div class="custom-pagination mt-4 mt-lg-5">
                                                    {!! $subscription_history->links() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        (function($){
            "use strict";
            
            $(document).ready(function(){
                
                $(document).on('click','#renew_current_subscription_using_wallter_balance',function(e){
                    e.preventDefault();
                    
                    Swal.fire({
                      title:"{{__('Are you sure to renew subscription?')}}",
                      showDenyButton: true,
                      showCancelButton: false,
                      confirmButtonText: "{{__('Yes')}}",
                      denyButtonText: "{{__('No')}}",
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $('#renew_current_subscription_using_wallter_balance_form').trigger('submit');
                      } 
                    })

                });
                
            });

        })(jQuery);
    </script>
@endsection