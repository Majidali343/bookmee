@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{ __('Service Coupons') }}
@endsection
@section('style')
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader />

    <!-- Dashboard area Starts -->

    <style>
        .check-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-height: 18px;
            min-width: 18px;
            cursor: pointer;
            background: #fff;
            border: 1px solid #dddddd;
            border-radius: 0px;
            margin-top: 3px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .check-input::after {
            content: "";
            font-family: "Line Awesome Free";
            font-weight: 900;
            font-size: 10px;
            color: #fff;
            visibility: hidden;
            opacity: 0;
            -webkit-transform: scale(1.6) rotate(90deg);
            transform: scale(1.6) rotate(90deg);
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
        }

        .check-input:checked {
            background: var(--main-color-one);
            border-color: var(--main-color-one);
            background: var(--main-color-one);
        }

        .check-input:checked::after {
            visibility: visible;
            opacity: 1;
            -webkit-transform: scale(1.2) rotate(0deg);
            transform: scale(1.2) rotate(0deg);
        }

        .checkbox-label {
            cursor: pointer;
            text-align: left;
            line-height: 26px;
            font-size: 18px;
            font-weight: 500;
            color: var(--heading-color);
        }

        @media only screen and (max-width: 575.98px) {
            .checkbox-label {
                font-size: 15px;
            }
        }
    </style>

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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{ __('All Coupons') }} </h2>
                                <div class="notice-board">
                                    <p class="text-danger">
                                        {{ __('Coupon will applicable only for your services and coupon amount will be reduce from your earnings.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrapper margin-top-50 text-right">
                        <button class="cmn-btn btn-bg-1" data-toggle="modal"
                            data-target="#addCouponModal">{{ __('Add Coupon') }}</button>
                    </div>

                    <div class="mt-5">
                        <x-msg.error />
                    </div>
                    <div class="dashboard-service-single-item border-1 margin-top-40">
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Discount Type') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('Expire Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->code }}</td>
                                            <td>{{ $data->discount }}</td>

                                            <td>{{ __($data->discount_type_time) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->expire_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <span class="text-success">{{ __('Active') }}</span>
                                                @else
                                                    <span class="text-danger">{{ __('Inactive') }}</span>
                                                @endif
                                                <x-seller-coupon-status :url="route('seller.service.coupon.status', $data->id)" />
                                            </td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_coupon_modal" data-toggle="modal"
                                                        data-target="#editCouponModal" data-id="{{ $data->id }}"
                                                        data-code="{{ $data->code }}"
                                                        data-discount="{{ $data->discount }}"
                                                        data-discount_type="{{ __($data->discount_type) }}"
                                                        data-discount_type_time="{{ __($data->discount_type_time) }}"
                                                        data-start_date="{{ $data->start_date }}"
                                                        data-expire_date="{{ $data->expire_date }}">
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i
                                                                class="las la-edit"></i> </span>
                                                    </a>
                                                    <x-seller-delete-popup :url="route('seller.service.coupon.delete', $data->id)" />
                                                    <button id="services_add_btn" data-id="{{ $data->id }}"
                                                        data-discount="{{ $data->discount }}"
                                                        data-discount_type="{{ __($data->discount_type) }}"
                                                        data-services_selected="{{ __($data->services_ids) }}"
                                                        class="cmn-btn" data-toggle="modal" data-target="#addServices"
                                                        style="background-color: var(--main-color-two);color:white;padding: 10px;padding: 10px;">{{ __('Services') }}</button>
                                                </div>
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


    <!-- Add Modal -->
    <div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="couponModal"
        aria-hidden="true">
        <form action="{{ route('seller.service.coupon.add') }}" method="post">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header d-block ">
                        <h5 class="modal-title" id="couponModal">{{ __('Add New Coupon') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="code">{{ __('Coupon Code') }}</label>
                            <input type="text" name="code" id="code" class="form-control"
                                placeholder="{{ __('Coupon Code') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="discount">{{ __('Coupon Discount') }}</label>
                            <input type="number" name="discount" id="discount" class="form-control"
                                placeholder="{{ __('Discount') }}">
                        </div>
                        <div class="form-group d-flex justify-content-between mt-3">
                            <div class="element" style="width: 58%">
                                <label for="discount_type">{{ __('Criteria') }}</label>
                                <select name="discount_type" id="discount_type" class="simple_select form-control mb-3">
                                    <option value="">{{ __('Select Criteria E.g Percentage or Amount') }}</option>
                                    <option value="percentage">{{ __('Percentage') }}</option>
                                    <option value="amount">{{ __('Amount') }}</option>
                                </select>
                            </div>
                            <div class="element" style="width: 38%">
                                <label for="discount_type_time">{{ __('Coupon Type') }}</label>
                                <select name="discount_type_time" id="discount_type_time"
                                    class="simple_select form-control mb-3">
                                    <option value="">{{ __('Select Type') }}</option>
                                    <option value="Happy Hour">{{ __('Happy Hour') }}</option>
                                    <option value="Last Minute">{{ __('Last Minute') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between mt-3">
                            <div class="element" style="width: 48%">
                                <div class="form-group mt-3">
                                    <label for="start_date">{{ __('Start Date') }}</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control"
                                        placeholder="{{ __('Start Date') }}" style="display: none;">

                                    <input type="datetime-local" id="start_date_picker"class="form-control">
                                </div>
                            </div>
                            <div class="element" style="width: 48%">
                                <div class="form-group mt-3">
                                    <label for="expire_date">{{ __('Expire Date') }}</label>
                                    <input type="text" name="expire_date" id="expire_date" class="form-control"
                                        placeholder="{{ __('Expire Date') }}" style="display: none">

                                    <input type="datetime-local" id="expire_date_picker"class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Edit Modal -->
    <div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModal"
        aria-hidden="true">
        <form action="{{ route('seller.service.coupon.update') }}" method="post">
            <input type="hidden" id="up_id" name="up_id">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCouponModal">{{ __('Edit Coupon') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="up_code">{{ __('Coupon Code') }}</label>
                            <input type="text" name="up_code" id="up_code" class="form-control"
                                placeholder="{{ __('Coupon Code') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_discount">{{ __('Coupon Discount') }}</label>
                            <input type="number" name="up_discount" id="up_discount" class="form-control"
                                placeholder="{{ __('Discount') }}">
                        </div>
                        <div class="form-group d-flex justify-content-between mt-3">
                            <div class="element" style="width: 58%">
                                <label for="up_discount_type">{{ __('Criteria') }}</label>
                                <select name="up_discount_type" id="up_discount_type"
                                    class="simple_select form-control mb-3">
                                    <option value="">{{ __('Select Criteria E.g Percentage or Amount') }}</option>
                                    <option value="percentage">{{ __('Percentage') }}</option>
                                    <option value="amount">{{ __('Amount') }}</option>
                                </select>
                            </div>
                            <div class="element" style="width: 38%">
                                <label for="up_discount_type_time">{{ __('Coupon Type') }}</label>
                                <select name="up_discount_type_time" id="up_discount_type_time"
                                    class="simple_select form-control mb-3">
                                    <option value="">{{ __('Select Type') }}</option>
                                    <option value="Happy Hour">{{ __('Happy Hour') }}</option>
                                    <option value="Last Minute">{{ __('Last Minute') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between mt-3">
                            <div class="element" style="width: 48%">
                                <div class="form-group mt-3">
                                    <label for="up_start_date">{{ __('Start Date') }}</label>
                                    <input type="text" name="up_start_date" id="up_start_date" class="form-control"
                                        placeholder="{{ __('Start Date') }}" style="display: none">

                                    <input type="datetime-local" id="up_start_date_picker"class="form-control">
                                </div>
                            </div>
                            <div class="element" style="width: 48%">
                                <div class="form-group mt-3">
                                    <label for="up_expire_date">{{ __('Expire Date') }}</label>
                                    <input type="text" name="up_expire_date" id="up_expire_date" class="form-control"
                                        placeholder="{{ __('Expire Date') }}" style="display: none">

                                    <input type="datetime-local" id="up_expire_date_picker"class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Services -->
    <div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="addServices"
        aria-hidden="true">
        <form action="{{ route('coupon.add.services.add') }}" method="post">
            @csrf
            <input type="hidden" id="up_id_" name="up_id_">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServices">{{ __('Add Services To Discount') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="checkbox" name="services_all" class="services_all check-input">
                        <div class="form-group mt-3">
                            @foreach ($services as $service)
                                <a class="search_servie_image_content text-left text-white">
                                    <input type="checkbox"
                                        name="select_services"class="select_services check-input"id="{{ $service->id }}"value="{{ $service->id }}">
                                    <div class="search_thumb bg-image" {!! render_background_image_markup_by_attachment_id($service->image, '', 'thumb') !!}></div>
                                    <span class="search-text-item">
                                        {{ $service->title }}
                                        <br>
                                        <strong>Original Price : </strong><span
                                            style="margin-right:30px;">{{ $service->price }} £</span>
                                        <strong>Discounted Price : </strong><span
                                            id="service_discount_{{ $service->id }}">{{ $service->price }} £</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <input type="text" name="services_ids" id="services_ids" value="" style="display: none;">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <style>
        .search_thumb {
            border-radius: 10px;

        }
    </style>
@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dropzone.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                function datetimeLocal(datetime) {
                    const dt = new Date(datetime);
                    dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
                    return dt.toISOString().slice(0, 16);
                }

                function dateLocal(datetime) {
                    const dt = new Date(datetime);
                    return `${dt.getFullYear()}-${String(dt.getMonth() + 1).padStart(2, '0')}-${dt.getDate()}`;
                }

                function setServicesSelectedValues() {
                    var inputs = document.querySelectorAll('.select_services');
                    var selectedIds = [];
                    var selectedIdsString = "";
                    for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].checked == true) {
                            selectedIds.push(`${inputs[i].id}`);
                        }
                    }
                    for (var i = 0; i < selectedIds.length; i++) {
                        if (i == selectedIds.length - 1) {
                            selectedIdsString += `${selectedIds[i]}`;
                        } else {
                            selectedIdsString += `${selectedIds[i]},`;
                        }
                    }
                    document.getElementById(`services_ids`).value = selectedIdsString;
                }

                $('.services_all').change(
                    function() {
                        var inputs = document.querySelectorAll('.select_services');
                        if ($(this).is(':checked')) {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = true;
                            }
                        } else {
                            for (var i = 0; i < inputs.length; i++) {
                                inputs[i].checked = false;
                            }
                        }
                        setServicesSelectedValues();
                    }
                );

                $("#up_start_date_picker").change(function() {
                    document.getElementById("up_start_date").value = new Date($("#up_start_date_picker")
                        .val()).toUTCString()
                    console.log(new Date($("#up_start_date_picker").val()).toUTCString());
                });
                $("#up_expire_date_picker").change(function() {
                    document.getElementById("up_expire_date").value = new Date($(
                        "#up_expire_date_picker").val()).toUTCString()
                });

                $("#start_date_picker").change(function() {
                    document.getElementById("start_date").value = new Date($("#start_date_picker")
                        .val()).toUTCString()
                    console.log(new Date($("#start_date_picker").val()).toUTCString());
                });

                $("#expire_date_picker").change(function() {
                    document.getElementById("expire_date").value = new Date($(
                        "#expire_date_picker").val()).toUTCString()
                });

                $("#discount_type_time").change(function() {
                    if (document.getElementById("discount_type_time").value == "Last Minute") {
                        document.getElementById("start_date_picker").type = "date";
                        document.getElementById("expire_date_picker").type = "date";

                    } else {
                        document.getElementById("start_date_picker").type = "datetime-local";
                        document.getElementById("expire_date_picker").type = "datetime-local";
                    }
                });
                $("#up_discount_type_time").change(function() {
                    if (document.getElementById("up_discount_type_time").value == "Last Minute") {
                        document.getElementById("up_start_date_picker").type = "date";
                        document.getElementById("up_expire_date_picker").type = "date";

                    } else {
                        document.getElementById("up_start_date_picker").type = "datetime-local";
                        document.getElementById("up_expire_date_picker").type = "datetime-local";
                    }
                });


                $(document).on('click', '.select_services', setServicesSelectedValues);

                $(document).on('click', '#services_add_btn', function(e) {
                    e.preventDefault();

                    let coupon_id = $(this).data('id');
                    let discount = $(this).data('discount');
                    let discount_type = $(this).data('discount_type');
                    let services_selected = $(this).data('services_selected');
                    let all_services = @json($services);
                    all_services.forEach(service => {
                        let discount_price = get_discounted_price(discount_type, service.price,
                            discount)
                        document.getElementById(`service_discount_${service.id}`).innerText =
                            `${discount_price}  £`;
                        document.getElementById(service.id).checked = false;
                    });
                    $('#up_id_').val(coupon_id);
                    $('#services_ids').val(services_selected);
                    if (services_selected != null && services_selected != "") {
                        var services_ids = services_selected.toString().split(",")
                        services_ids.forEach(id => {
                            document.getElementById(id).checked = true;
                        });
                    }
                });

                $(document).on('click', '.edit_coupon_modal', function(e) {
                    e.preventDefault();
                    let coupon_id = $(this).data('id');
                    let code = $(this).data('code');
                    let discount = $(this).data('discount');
                    let discount_type = $(this).data('discount_type');
                    let discount_type_time = $(this).data('discount_type_time');
                    let expire_date = $(this).data('expire_date');
                    let start_date = $(this).data('start_date');
                    if (discount_type_time == "Last Minute") {
                        console.log(dateLocal(expire_date));
                        document.getElementById("up_start_date_picker").type = "date";
                        document.getElementById("up_expire_date_picker").type = "date";
                        $('#up_expire_date_picker').val(dateLocal(expire_date));
                        $('#up_start_date_picker').val(dateLocal(start_date));
                        $('#up_expire_date').val(dateLocal(expire_date));
                        $('#up_start_date').val(dateLocal(start_date));
                        
                    } else {
                        document.getElementById("up_start_date_picker").type = "datetime-local";
                        document.getElementById("up_expire_date_picker").type = "datetime-local";
                        $('#up_expire_date_picker').val(datetimeLocal(expire_date));
                        $('#up_start_date_picker').val(datetimeLocal(start_date));
                        $('#up_expire_date').val(datetimeLocal(expire_date));
                        $('#up_start_date').val(datetimeLocal(start_date));
                    }

                    $('#up_id').val(coupon_id);
                    $('#up_code').val(code);
                    $('#up_discount').val(discount);
                    $('#up_discount_type').val(discount_type);
                    $('#up_discount_type_time').val(discount_type_time);
                });

                $(document).on('click', '.swal_status_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure to change status?') }}',
                        text: '{{ __('You will change it anytime!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ __('Yes, change status!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });


                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{ __('Yes, delete it!') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });



            });

            function get_discounted_price(type, total, discount) {
                switch (type) {
                    case "amount":
                        return total - discount;
                        break;
                    case "percentage":
                        var discount_calculated = discount * total / 100;
                        return total - discount_calculated;
                        break;
                    default:
                        return total
                        break;
                }
            }
        })(jQuery);
    </script>
@endsection
