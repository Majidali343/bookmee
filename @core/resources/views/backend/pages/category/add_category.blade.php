@extends('backend.admin-master')

@section('site-title')
    {{__('Add New Category')}}
@endsection
@section('style')
    <x-media.css/>
    <style>
        .left-side-meta{
            /*margin-left: 100px;*/
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Category')}}   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.category')}}">{{__('All Categories')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.category.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="tab-content margin-top-40">
                                
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{__('Name')}}">
                                </div>

                                <div class="form-group permalink_label">
                                    <label class="text-dark">{{__('Permalink * : ')}}
                                        <span id="slug_show" class="display-inline"></span>
                                        <span id="slug_edit" class="display-inline">
                                             <button class="btn btn-warning btn-sm slug_edit_button"> <i class="fas fa-edit"></i> </button>
    
                                            <input type="text" name="slug" class="form-control category_slug mt-2" style="display: none">
                                              <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                        </span>
                                    </label>
                                </div>

                                 <div class="form-group">
                                    <label for="icon" class="d-block">{{__('Category Icon')}}</label>
                                    <div class="btn-group icon">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="fas fa-phone" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{__('Toggle Dropdown')}}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" name="icon" id="icon" value="fas fa-exclamation-triangle">
                                </div> 

                                <div class="form-group">
                                    <label for="image">{{__('Upload Category Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="image">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Image')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">{{__('Mobile Icon Image')}}</label>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap"></div>
                                        <input type="hidden" name="mobile_icon">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-toggle="modal"
                                                data-target="#media_upload_modal">
                                            {{__('Upload Image')}}
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body meta">
                                                <h5 class="header-title">{{__('Meta Section')}}</h5>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-3">
                                                        <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                             role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-home-tab"
                                                               data-toggle="pill" href="#v-pills-home" role="tab"
                                                               aria-controls="v-pills-home"
                                                               aria-selected="true">{{__('Category Meta')}}</a>

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
                                                    <div class="col-xl-8 col-lg-9">
                                                        <div class="tab-content meta-content left-side-meta" id="v-pills-tabContent">
                                                            <!-- category meta section start -->
                                                            <div class="tab-pane fade show active" id="v-pills-home"
                                                                 role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <div class="form-group">
                                                                    <label for="title">{{__('Meta Title')}}</label>
                                                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="{{__('Title')}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="slug">{{__('Meta Tags')}}</label>
                                                                    <input type="text" class="form-control" name="meta_tags" value="{{ old('meta_tags') }}"
                                                                           placeholder="Slug" data-role="tagsinput">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title">{{__('Meta Description')}}</label>
                                                                        <textarea name="meta_description" class="form-control max-height-140" cols="20"  rows="4">{{ old('meta_description') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- category meta section end -->
                                                            <!-- facebook meta section start -->
                                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                                 aria-labelledby="v-pills-profile-tab">
                                                                <div class="form-group">
                                                                    <label for="title">{{__('Facebook Meta Title')}}</label>
                                                                    <input type="text" class="form-control" data-role="tagsinput" value="{{ old('tagsinput') }}" name="facebook_meta_tags">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="title">{{__('Facebook Meta Description')}}</label>
                                                                        <textarea name="facebook_meta_description"
                                                                                  class="form-control max-height-140"
                                                                                  cols="20"
                                                                                  rows="4">{{ old('facebook_meta_description') }}</textarea>
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
                                                            <!-- facebook meta section end -->
                                                            <!-- twitter meta section start -->
                                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                                 aria-labelledby="v-pills-messages-tab">
                                                                <div class="form-group">
                                                                    <label for="title">{{__('Twitter Meta Title')}}</label>
                                                                    <input type="text" class="form-control" data-role="tagsinput"
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
                                                            <!-- twitter meta section end -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Submit ')}}</button>

                              </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
<script>
  <x-icon-picker/> 
</script>
 <x-media.js />

 <script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            //Permalink Code
            $('.permalink_label').hide();
            $(document).on('keyup', '#name', function (e) {
                var slug = converToSlug($(this).val());
                var url = "{{url('/service-list/category/')}}/" + slug;
                $('.permalink_label').show();
                var data = $('#slug_show').text(url).css('color', 'blue');
                $('.category_slug').val(slug);

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
                $('.category_slug').show();
                $(this).hide();
                $('.slug_update_button').show();
            });

            //Slug Update Code
            $(document).on('click', '.slug_update_button', function (e) {
                e.preventDefault();
                $(this).hide();
                $('.slug_edit_button').show();
                var update_input = $('.category_slug').val();
                var slug = converToSlug(update_input);
                var url = `{{url('/service-list/category/')}}/` + slug;
                $('#slug_show').text(url);
                $('.category_slug').val(slug)
                $('.category_slug').hide();
            });

        });
    })(jQuery)
</script>
@endsection  

