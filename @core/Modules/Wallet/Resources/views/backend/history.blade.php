@extends('backend.admin-master')

@section('site-title')
    {{__('History Lists')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <x-media.css/>
    <x-datatable.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Wallet History Lists')}}</h4>
                                <p class="text-info mb-3">{{ __('All users wallet history lists.') }}</p>
                            </div>
                            <div class="right-content">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payoutRequestModal">{{ __('Deposit To User Wallet') }}</button>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_jobs">
                                <thead>
                                <th>{{__('#No')}}</th>
                                <th>{{__('User Details')}}</th>
                                <th>{{__('Payment Gateway')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Manual Payment Image')}}</th>
                                </thead>
                                <tbody>
                                @foreach($wallet_history_lists as $key=>$data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <ul>
                                                <li><strong>{{__('User Type')}}: </strong>{{optional($data->user)->user_type==1 ? 'Buyer' : 'Seller'}}</li>
                                                <li><strong>{{__('Name')}}: </strong>{{optional($data->user)->name}}</li>
                                                <li><strong>{{__('Email')}}: </strong>{{ optional($data->user)->email}}</li>
                                                <li><strong>{{__('Phone')}}: </strong>{{ optional($data->user)->phone }}</li>
                                            </ul>
                                        </td>
                                        <td>{{ ucfirst($data->payment_gateway) }}</td>
                                        <td>
                                            {{ ucfirst($data->payment_status) }}
                                            @if($data->payment_status == 'pending')
                                                <span><x-status-change :url="route('admin.wallet.history.status',$data->id)"/></span>
                                            @endif
                                        </td>
                                        <td>{{ float_amount_with_currency_symbol($data->amount) }}</td>
                                        <td>
                                            @if($data->manual_payment_image)
                                                <img style="width:100px;" src="{{ asset('assets/uploads/manual-payment/'.$data->manual_payment_image) }}" alt="payment-image">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="payoutRequestModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <form action="{{ route('admin.wallet.deposit.create') }}" method="post" enctype="multipart/form-data">
              @csrf
            <input type="hidden" name="selected_payment_gateway" value="added_by_admin">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-warning" id="couponModal">{{ __('Deposit To User Wallet') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="single-info-input margin-top-30">
                            <label for="user_id" class="info-title"> {{__('Select User*')}} </label>
                            <select name="user_id" id="user_id" class="form-control  nice-select wide">
                                <option value="">{{__('Select User')}}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="">{{ __('Deposit Amount') }}</label>
                        <input type="number" class="form-control" name="amount" placeholder="{{ __('Enter Deposit Amount') }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <x-media.js />
    <x-datatable.js/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click','.swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to change status?")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                // for nice select search js
                if($('.nice-select').length > 0){
                    $('.nice-select').niceSelect();
                }

            });
        })(jQuery)
    </script>
@endsection

