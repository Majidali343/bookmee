@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Add Services')}}
@endsection

@section('style')
    <x-media.css/>
    <x-summernote.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <style>
        .meta-content .bootstrap-tagsinput .tag {
            margin-right: 2px !important;
            color: #444 !important;
            font-size: 14px!important;
            line-height: 24px !important;
            padding: 3px 10px !important;
            border-radius: 3px !important;
            border: 1px solid #e2e2e2 !important;
        }
        .meta-content .bootstrap-tagsinput {
            width: 100%;
        }
    </style>
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
                    <div class="row">
                        <div class="col-lg-9" >
                            <div class="dashboard-settings margin-top-40" style="width:65pc;">
                        
                                <h2 class="dashboards-title"> {{__('Add Service')}} </h2>
                                <div class="notice-board">
                                    @if(get_static_option('service_create_settings') == 'verified_seller')
                                        <p class="text-dark">{{__('You can not add services if you are not verified.')}}</p>
                                    @endif
                                    <p class="text-dark">{{__('This part is common for both of/on line services. After create service you will redirect a page where you will create service attributes for offline or online.')}}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3">
                            <div class="available-all-city-area">
                                <span class="text-info">{{__('Is Available All Cities and Area')}}</span>
                                <div class="dashboard-switch-single">
                                    <input class="custom-switch is_service_all_cities" id="is_service_all_cities" type="checkbox"/>
                                    <label class="switch-label" for="is_service_all_cities"></label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-12 margin-top-30">
                            <div class="single-settings">

                                <div> <x-msg.error/> </div>

                                <form action="{{route('seller.add.services')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="is_service_all_cities"  id="is_service_all_cities_id">
                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="category" class="info-title"> {{__('Select Main Category*')}} </label>
                                            <select name="category" id="category">
                                                <option value="">{{__('Select Category')}}</option>
                                                @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="single-info-input margin-top-30 sub_category_wrapper">
                                            <label for="subcategory" class="info-title"> {{__('Select Sub Category*')}} </label>
                                            <select  name="subcategory" id="subcategory" class="subcategory"></select>
                                        </div> --}}

                                        {{-- <div class="single-info-input margin-top-30 child_category_wrapper">
                                            <label for="child_category" class="info-title"> {{__('Select Child Category*')}} </label>
                                            <select  name="child_category" id="child_category"></select>
                                        </div> --}}
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="title" class="info-title"> {{__('Service Title*')}} </label>
                                            <input class="form--control" name="title" id="title" type="text" placeholder="{{__('Add title')}}">
                                        </div>
                                        {{-- <div class="single-info-input margin-top-30 mt-5">
                                            <label for="video" class="info-title"> {{__('Service Video Url')}} </label>
                                            <input class="form--control" name="video" id="video" type="text" placeholder="{{__('youtube embed code')}}">
                                            <small class="text-danger">{{__('must be embed code from youtube.')}}</small>
                                        </div> --}}
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30 permalink_label">
                                            <label for="title" class="info-title text-dark"> {{__('Permalink*')}} </label>
                                                <span id="slug_show" class="display-inline"></span>
                                            <span id="slug_edit" class="display-inline"> </span>
                                                <button class="btn btn-warning btn-sm slug_edit_button">  <i class="las la-edit"></i> </button>

                                            <input class="form--control service_slug" name="slug" id="slug" style="display: none" type="text">
                                            <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                        </div>
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <label for="description" class="info-title"> {{__('Service Description*')}} </label>
                                            <textarea class="form--control textarea--form summernote" name="description" placeholder="{{__('Type Description')}}"></textarea>
                                        </div>
                                    </div>

                                    <div class="single-dashboard-input">
                                        <div class="single-info-input margin-top-30">
                                            <div class="form-group ">
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap"></div>
                                                    <input type="hidden" name="image">
                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                            data-btntitle="{{__('Select Image')}}"
                                                            data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                            data-target="#media_upload_modal">
                                                        {{__('Upload Main Image')}}
                                                    </button>
                                                    <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                                    <small>{{ __('recommended size 1920x1280') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" name="image_gallery">
                                            <button type="button" class="btn btn-info media_upload_form_btn"
                                                    data-btntitle="{{__('Select Image')}}"
                                                    data-modaltitle="{{__('Upload Image')}}"
                                                    data-toggle="modal"
                                                    data-mulitple="true"
                                                    data-target="#media_upload_modal">
                                                {{__('Upload Gallery Image')}}
                                            </button>
                                            <small>{{ __('image format: jpg,jpeg,png')}}</small> <br>
                                            <small>{{ __('recommended size 1920x1280') }}</small>
                                        </div>
                                    </div>

                                    {{-- <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body meta">
                                                    <h5 class="header-title">{{__('Meta Section')}}</h5>
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-3">
                                                            <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                                 role="tablist" aria-orientation="vertical">
                                                                <a class="nav-link active" id="v-pills-home-tab"
                                                                   data-toggle="pill" href="#v-pills-home" role="tab"
                                                                   aria-controls="v-pills-home"
                                                                   aria-selected="true">{{__('Service Meta')}}</a>
                                                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                                                   href="#v-pills-profile" role="tab"
                                                                   aria-controls="v-pills-profile"
                                                                   aria-selected="false">{{__('Facebook Meta')}}</a>
                                                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill"
                                                                   href="#v-pills-messages" role="tab"
                                                                   aria-controls="v-pills-messages"
                                                                   aria-selected="false">{{__('Twitter Meta')}}</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-9">
                                                            <div class="tab-content meta-content" id="v-pills-tabContent">
                    
                                                                <div class="tab-pane fade show active" id="v-pills-home"
                                                                     role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                    <div class="form-group">
                                                                        <label for="title">{{__('Meta Title')}}</label>
                                                                        <input type="text" class="form-control" name="meta_title"
                                                                               placeholder="{{__('Title')}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="slug">{{__('Meta Tags')}}</label>
                                                                        <input type="text" class="form-control" name="meta_tags"
                                                                               placeholder="Slug" data-role="tagsinput">
                                                                    </div>
                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="title">{{__('Meta Description')}}</label>
                                                                            <textarea name="meta_description"
                                                                                      class="form-control max-height-140"
                                                                                      cols="20"
                                                                                      rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                    
                                                                </div>
                    
                                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                                     aria-labelledby="v-pills-profile-tab">
                                                                    <div class="form-group">
                                                                        <label for="title">{{__('Facebook Meta Title')}}</label>
                                                                        <input type="text" class="form-control" placeholder="{{__('Title')}}"
                                                                               name="facebook_meta_tags">

                                                                    </div>
                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="title">{{__('Facebook Meta Description')}}</label>
                                                                            <textarea name="facebook_meta_description"
                                                                                      class="form-control max-height-140"
                                                                                      cols="20"
                                                                                      rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="form-group">
                                                                        <label for="image">{{__('Facebook Meta Image')}}</label>
                                                                        <div class="media-upload-btn-wrapper">
                                                                            <div class="img-wrap"></div>
                                                                            <input type="hidden" name="facebook_meta_image">
                                                                            <button type="button"
                                                                                    class="btn btn-info media_upload_form_btn"
                                                                                    data-btntitle="{{__('Select Image')}}"
                                                                                    data-modaltitle="{{__('Upload Image')}}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#media_upload_modal">
                                                                                {{__('Upload Image')}}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                    
                                                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                                     aria-labelledby="v-pills-messages-tab">
                                                                    <div class="form-group">
                                                                        <label for="title">{{__('Twitter Meta Title')}}</label>
                                                                        <input type="text" class="form-control" placeholder="{{__('Title')}}"
                                                                               name="twitter_meta_tags">
                                                                    </div>
                    
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="title">{{__('Twitter Meta Description')}}</label>
                                                                            <textarea name="twitter_meta_description"
                                                                                      class="form-control max-height-140"
                                                                                      cols="20"
                                                                                      rows="4"></textarea>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="form-group">
                                                                        <label for="image">{{__('Twitter Meta Image')}}</label>
                                                                        <div class="media-upload-btn-wrapper">
                                                                            <div class="img-wrap"></div>
                                                                            <input type="hidden" name="twitter_meta_image">
                                                                            <button type="button"
                                                                                    class="btn btn-info media_upload_form_btn"
                                                                                    data-btntitle="{{__('Select Image')}}"
                                                                                    data-modaltitle="{{__('Upload Image')}}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#media_upload_modal">
                                                                                {{__('Upload Image')}}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                            </div>
                    
                                        </div>
                                    </div> --}}


                                    @if(get_static_option('service_create_settings') == 'all_seller')
                                    <div class="btn-wrapper margin-top-40">
                                        <input type="submit" class="btn btn-success btn-bg-1" value="{{__('Save & Next')}} ">
                                    </div>
                                    @else
                                        @php
                                            $seller = App\SellerVerify::select('seller_id','status')->where('seller_id',Auth::guard('web')->user()->id)->first()
                                        @endphp
                                        @if(!is_null($seller) && $seller->status==1)
                                        <div class="btn-wrapper margin-top-40">
                                            <input type="submit" class="btn btn-success btn-bg-1" value="{{__('Save & Next')}} ">
                                        </div>
                                        @endif
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
@endsection  

@section('scripts')
<script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
<x-summernote.js/>

<script>
    $('.meta-content').show();
</script>

<x-media.js :type="'web'"/>
<script type="text/javascript">
    (function(){
    "use strict";
    $(document).ready(function(){

        //Permalink Code
        $('.permalink_label').hide();
        
        $(document).on('keyup', '#title', function (e) {
            var slug = converToSlug($(this).val());
            var url = "{{url('/service/')}}/" + slug;
            $('.permalink_label').show();
            var data = $('#slug_show').text(url).css('color', 'blue');
            $('.service_slug').val(slug);

        });
        
        function converToSlug(slug){
           let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
            //remove multiple space to single
            finalSlug = slug.replace(/  +/g, ' ');
            // remove all white spaces single or multiple spaces
            finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
            return finalSlug;
        }

        //Slug Edit Code
        $(document).on('click', '.slug_edit_button', function (e) {
            e.preventDefault();
            $('.service_slug').show();
            $(this).hide();
            $('.slug_update_button').show();
        });

        //Slug Update Code
        $(document).on('click', '.slug_update_button', function (e) {
            e.preventDefault();
            $(this).hide();
            $('.slug_edit_button').show();
            var update_input = $('.service_slug').val();
            var slug = converToSlug(update_input);
            var url = `{{url('/service/')}}/` + slug;
            $('#slug_show').text(url);
            $('.service_slug').hide();
        });

        // service category and sub category
        $('#category').on('change',function(){
            var category_id = $(this).val();
            $.ajax({
                method:'post',
                url:"{{route('seller.subcategory')}}",
                data:{category_id:category_id},
                success:function(res){
                    if(res.status=='success'){
                        var alloptions = "<option value=''>{{ __('Select Sub Category') }}</option>";
                        var allSubCategory = res.sub_categories;
                        $.each(allSubCategory,function(index,value){
                            alloptions +="<option value='" + value.id + "'>" + value.name + "</option>";
                        });

                        $(".subcategory").html(alloptions);

                    }
                }
            })
        })


        // service sub category and child category
        $(document).on('change','#subcategory', function() {
            var sub_cat_id = $(this).val();
            $.ajax({
                method: 'post',
                url: "{{ route('seller.subcategory.child.category') }}",
                data: {
                    sub_cat_id: sub_cat_id
                },
                success: function(res) {

                    if (res.status == 'success') {
                        var alloptions = "<option value=''>{{__('Select Child Category')}}</option>";
                        var allList = "<li data-value='' class='option'>{{__('Select Child Category')}}</li>";
                        var allChildCategory = res.child_category;

                        $.each(allChildCategory, function(index, value) {
                            alloptions += "<option value='" + value.id +
                                "'>" + value.name + "</option>";
                            allList += "<li class='option' data-value='" + value.id +
                                "'>" + value.name + "</li>";
                        });

                        $("#child_category").html(alloptions);
                        $(".child_category_wrapper ul.list").html(allList);
                        $(".child_category_wrapper").find(".current").html("Select Child Category");
                    }
                }
            })
        })


        $("#is_service_all_cities").on('change', function() {
            if ($("#is_service_all_cities").is(':checked')){
                $('#is_service_all_cities_id').val(1)
            }else {
                $('#is_service_all_cities_id').val('')
            }
        });

    })
})(jQuery);

 </script>
@endsection