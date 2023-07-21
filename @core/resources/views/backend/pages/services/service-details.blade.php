@extends('backend.admin-master')
@section('site-title')
    {{__('Service Details')}}
@endsection
@section('style')
    <style>
        p{
            color: #f0f0f0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($service))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <h3><strong>{{ __('Title:') }} </strong>{{ $service->title }}</h3>
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
                                <h5>{{ __('Service Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Price:') }} </strong> {{ float_amount_with_currency_symbol($service->price) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Tax:') }} </strong> {{ $service->tax }}%</label>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#taxUpdateModal">
                                        {{ __('Update') }}
                                      </button>
                                </div>
                                <div class="checkbox-inlines">
                                    @if($service->status==1)
                                    <label><strong>{{ __('Status:') }} </strong> <span class="text-success">{{ __('Approve') }}</span></label>
                                    @else 
                                    <label><strong>{{ __('Status:') }} </strong> <span class=" text-danger">{{ __('Pending') }}</span></label>
                                    @endif
                                </div>
                                <div class="checkbox-inlines">
                                    @if($service->status==1)
                                    <label><strong>{{ __('Service off on Status:') }}</strong> <span class="text-success">{{ __('On') }}</span></label>
                                    @else 
                                    <label><strong>{{ __('Service off on Status::') }}</strong> <span class="text-danger">{{ __('Off') }}</span></label>
                                    @endif
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('View Count:') }}</strong> {{ $service->view }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label> <strong>{{ __('Description:') }}</strong>  </label> <p class="text-dark">{{ Str::limit(strip_tags($service->description),700) }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                       
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Service Image') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    {!! render_image_markup_by_attachment_id($service->image,'','thumb') !!}
                                </div>
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
                                <h5>{{ __('Service Benefits') }}</h5>
                            </div>
                            <div class="single-checbox">
                                @foreach($service_benifits as $benifit)
                                <div class="checkbox-inlines">
                                    <label>{{ $benifit->benifits }}</label>
                                </div>
                                @endforeach
                                
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Seller Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Seller:') }}</strong> {{ optional($service->seller)->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }}</strong> {{ optional(optional($service->seller)->city)->service_city  }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }}</strong> {{ optional(optional($service->seller)->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }}</strong> {{ optional(optional($service->seller)->country)->country }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Seller Since:') }}</strong> {{ Carbon\Carbon::parse(optional($seller_since)->created_at)->year }}</label>
                                </div>
                                
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <h5>{{ __('Include Details: ')}}</h5> <br>
                            @if($service->is_service_online == 1)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($service_includes as $include)
                                        <tr>
                                            <td>{{ $include->include_service_title }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Unit Price') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $package_fee =0; @endphp
                                    @foreach($service_includes as $include)
                                        <tr>
                                            <td>{{ $include->include_service_title }}</td>
                                            <td>{{ float_amount_with_currency_symbol($include->include_service_price) }}</td>
                                            <td>{{ $include->include_service_quantity }}</td>
                                            <td>{{ float_amount_with_currency_symbol($include->include_service_price* $include->include_service_quantity) }}</td>
                                            @php $package_fee += $include->include_service_price * $include->include_service_quantity @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong>{{ __('Package Fee') }}</strong></td>
                                        <td><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                            <br>
                            <h5>{{ __('Additional Services: ')}}</h5> <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Unit Price') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $extra_service =0; @endphp
                                    @foreach($service_additionals as $additional)
                                    <tr>
                                        <td>{{ $additional->additional_service_title }}</td>
                                        <td>{{ float_amount_with_currency_symbol($additional->additional_service_price) }}</td>
                                        <td>{{ $additional->additional_service_quantity }}</td>
                                        <td>{{ float_amount_with_currency_symbol($additional->additional_service_price * $additional->additional_service_quantity) }}</td>
                                        @php $extra_service += $additional->additional_service_price * $additional->additional_service_quantity @endphp
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                        <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            @if($service->is_service_online == 1)
                            <h5>{{ __('Service Faqs: ')}}</h5> <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->title }}</td>
                                        <td>{{ $faq->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif

                            
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

  
  <!-- Modal -->
  <div class="modal fade" id="taxUpdateModal" tabindex="-1" role="dialog" aria-labelledby="taxModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="taxModalLabel">{{ __('Update Tax') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.service.tax.update') }}" method="post">
            <div class="modal-body">
                @csrf 
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="form-group">
                    <label for="tax">{{ __('Tax') }}</label>
                    <input type="text" name="tax" value="{{ $service->tax }}" class="form-control">
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

