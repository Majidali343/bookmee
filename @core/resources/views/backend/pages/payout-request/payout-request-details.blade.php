@extends('backend.admin-master')
@section('site-title')
    {{__('Payout Request Details')}}
@endsection

@section('style')
<x-datatable.css/>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        
        @if(!empty($request_details))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <h5><strong>{{ __('Payout Request ID: ') }}</strong>#{{ $request_details->id }}</h5>
                                <p class="text-info"><small>{{__('checkout all the info of seller before process the payment. you should get seller payout request details which payment gateway seller want to get paid, and seller payment account details should show in place of seller note. you have to check these thing and have to pay seller manually, then you will change the payment status with a screenshort of proof of payment.')}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Seller Details') }}</h5>
                            </div>

                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ optional($request_details->seller)->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ optional($request_details->seller)->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ optional($request_details->seller)->phone }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ optional($request_details->seller)->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional(optional($request_details->seller)->city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional(optional($request_details->seller)->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ optional($request_details->seller)->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional(optional($request_details->seller)->country)->country }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Amount:') }} </strong>{{ float_amount_with_currency_symbol($request_details->amount) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Gateway:') }} </strong>{{ $request_details->payment_gateway }}</label>
                                </div>                            
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Request Status:') }}</strong></label>
                                        @if($request_details->status==0) <span class="text-danger">{{ __('Pending') }}</span>@endif
                                        @if($request_details->status==1) <span class="text-primary">{{ __('Completed') }}</span>@endif
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Remaining Balance:') }} </strong>{{ $remaining_balance }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Request Date:') }} </strong>{{ $request_details->created_at->toFormattedDateString() }}</label>
                                </div>
                                <br>
                                <div class="checkbox-inlines">
                                    <p><strong>{{ __('Seller Note: ') }}</strong>{{ $request_details->seller_note }}</p>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                    </div>

                
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Payment Receipt') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    @if(!empty($request_details->payment_receipt))
                                    {!! render_image_markup_by_attachment_id($request_details->payment_receipt) !!}
                                    @endif
                                </div>
                            </div>           
                            
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
@endsection

