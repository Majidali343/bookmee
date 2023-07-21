@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Attendance Confirm')}}
@endsection
@section('breadcrumb')
    <li><a href="{{get_static_option('events_page_slug')}}">{{get_static_option('events_page_'.$user_select_lang_slug.'_name')}}</a></li>
    <li>{{get_static_option('events_page_'.$user_select_lang_slug.'_name').' '.__('Attendance Confirm')}}</li>
@endsection
@section('content')
<style>
    .msform fieldset {
        width: 100%!important;
    }
</style>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-confirm-area">
                        <h4 class="title">{{__('Attendance Details')}}</h4>
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        
                        <form action="{{route('frontend.event.payment.confirm')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                            $custom_fields = unserialize( $attendance_details->custom_fields);
                            $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                            $name = auth()->check() ? auth()->user()->name : '';
                            $email = auth()->check() ? auth()->user()->email :'';
                            @endphp
                            <input type="hidden" name="attendance_id" value="{{$attendance_details->id}}">
                            <input type="hidden" name="payment_gateway" value="{{$payment_gateway}}">
                             <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>{{__('Your Name')}}</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{$name}}" class="form-control" placeholder="{{__('Enter Your Name')}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Your Email')}}</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{$email}}" class="form-control" placeholder="{{__('Enter Your Email')}}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Event Name')}}</td>
                                    <td>{{$attendance_details->event_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Event Cost')}}</td>
                                    <td>
                                        <strong>{{amount_with_currency_symbol($attendance_details->event_cost * $attendance_details->quantity)}}</strong>
                                        @if(!check_currency_support_by_payment_gateway($payment_gateway))
                                            <br>
                                            <small>{{__('You will charge in '.get_charge_currency($payment_gateway).', you have to pay'. ' ')}} <strong>{{get_charge_amount($attendance_details->event_cost * $attendance_details->quantity,$payment_gateway).get_charge_currency($payment_gateway)}}</strong></small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{__('Quantity')}}</td>
                                    <td>{{$attendance_details->quantity}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Payment Gateway')}}</td>
                                    <td class="text-capitalize">
                                        @if($payment_gateway == 'manual_payment')
                                            {{get_static_option('site_manual_payment_name')}}
                                        @else
                                            {{$payment_gateway}}
                                        @endif
                                    </td>
                                </tr>
                                @if($payment_gateway == 'manual_payment')
                                    <tr>
                                        <td>{{__('Transaction ID')}}</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="trasaction_id" class="form-control">
                                                <small>{!! get_static_option('site_manual_payment_description') !!}</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="btn-wrapper">
                            <button type="submit" class="submit-btn style-01">{{__('Pay Now')}}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(!empty(get_static_option('site_google_captcha_v3_site_key')))
        <script
            src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    @endif
@endsection
