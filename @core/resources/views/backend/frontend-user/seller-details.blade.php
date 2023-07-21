@extends('backend.admin-master')
@section('site-title')
    {{__('Seller Details')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($seller_details))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong>{{ __('Seller ID:') }} </strong>#{{ $seller_details->id }}</label>
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
                                    <label><strong>{{ __('Name:') }} </strong>{{ $seller_details->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ $seller_details->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ $seller_details->phone }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ $seller_details->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional($seller_details->city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional($seller_details->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ $seller_details->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional($seller_details->country)->country }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('User Verify:') }} </strong>
                                        @if(optional($seller_details->sellerVerify)->status==1)
                                            <span class="text-warning">{{ __('Verified') }}</span>
                                        @else
                                            <span class="text-info">{{ __('Not Verified') }}</span>
                                        @endif
                                        <x-status-change :url="route('admin.frontend.seller.profile.verify',$seller_details->id)"/>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Seller National ID') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    {!! render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->national_id,'','large') !!}
                                </div>
                            </div>   
                            
                            <div class="border-bottom mt-5 mb-3">
                                <h5>{{ __('Seller Address') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    {!! render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->address,'','large') !!}
                                </div>
                                <br>

                            </div> 
                            
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script>
    (function($){
    "use strict";
    $(document).ready(function() {
        
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

    });
})(jQuery);
    
</script>

@endsection

