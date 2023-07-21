@extends('backend.admin-master')
@section('site-title')
    {{__('All Payout Request')}}
@endsection

@section('style')
<x-datatable.css/>
<x-media.css/>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Payout Request')}}  </h4>
                                @can('payout-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Payment Gateway')}}</th>
                                <th>{{__('Request Date')}}</th>
                                <th>{{__('Request Amount')}}</th>
                                <th>{{__('Image')}}</th>

                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($all_payout_request as $data)
                                    <tr>
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td>#{{$data->id}}</td>
                                        <td>{{$data->payment_gateway}}</td>
                                        <td>{{ $data->created_at->toFormattedDateString()}}</td>
                                        <td>{{ float_amount_with_currency_symbol($data->amount) }}</td>
                                        <td>
                                        @php
                                            $testimonial_img = get_attachment_image_by_id($data->payment_receipt,null,true);
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
                                        </td>
                                        <td>
                                            @if($data->status==0) <span class="text-danger">{{ __('Pending') }}</span>@endif
                                            @if($data->status==1) <span class="text-primary">{{ __('Completed') }}</span>@endif
                                        </td>
                                        <td>
                                            @can('payout-edit')
                                                <a href="#"
                                                    data-toggle="modal"
                                                    data-target="#payout_request_edit_modal"
                                                    class="btn btn-primary btn-xs mb-3 mr-1 payout_request_edit_btn"
                                                    data-id="{{$data->id}}"
                                                    data-status="{{$data->status}}"
                                                    data-note="{{$data->admin_note}}"
                                                    data-imageid="{{$data->payment_receipt}}"
                                                    data-image="{{$img_url}}">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            @endcan
                                            @if($data->status==0)
                                                @can('payout-delete')
                                                    <x-delete-popover :url="route('admin.payout.request.delete',$data->id)"/>
                                                @endcan
                                            @endif
                                            @can('payout-view')
                                                <a class="btn btn-info btn-xs mb-3 mr-1" target="_blank" href="{{route('admin.payout.request.view',$data->id)}}">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            @endcan
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

    <div class="modal fade" id="payout_request_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Payout Request')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.payout.request.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        
                        <input type="hidden" name="payout_request_id" id="payout_request_id">
                        <div class="form-group">
                            <label for="status" class="d-block">{{__('Status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="0">{{ __('Pending') }}</option>
                                <option value="1">{{ __('Completed') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Upload Payment Receipt')}}</label>
                        
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" name="payment_receipt">
                                <button type="button" class="btn btn-info media_upload_form_btn"
                                        data-btntitle="{{__('Select Image')}}"
                                        data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                        data-target="#media_upload_modal">
                                    {{__('Upload Image')}}
                                </button>
                            </div>
                            <small class="text-info">{{__('upload your payment proof for, seller so that seller understand you have processed the payment')}}</small>
                        </div>

                        <div class="form-group mt-5">
                            <label for="amount">{{ __('Note') }}</label>
                            <textarea class="form-control" name="admin_note" id="admin_note" cols="30" rows="7"></textarea>
                            <small class="text-info">{{__('you can write additional note for seller, to explain your payout process, if you have any')}}</small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button id="update" type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
 <x-datatable.js/>
 <x-media.js />
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.payout.request.bulk.action')"/>

                $(document).on('click', '.payout_request_edit_btn', function () {
                    var el = $(this);
                    var payout_request_id = el.data('id');
                    var status = el.data('status');
                    var admin_note = el.data('note');
                 
                    var form = $('#payout_request_edit_modal');
                    form.find('#payout_request_id').val(payout_request_id);
                    form.find('#status').val(status);
                    form.find('#admin_note').val(admin_note);

                    var image = el.data('image');
                    var imageid = el.data('imageid');

                    if (imageid != '') {
                        form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' + image + '" > </div></div></div>');
                        form.find('.media-upload-btn-wrapper input').val(imageid);
                        form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                    }

                });

              });
        })(jQuery);
    </script>
@endsection
