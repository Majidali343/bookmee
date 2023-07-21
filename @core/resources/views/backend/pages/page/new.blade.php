@extends('backend.admin-master')
@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <style>
        #slug_edit .form-control {
            height: 30px;
            width: 100%;
        }

        .slug_edit_button {
            line-height: 0px;
            margin: 0;
            padding: 8px 8px;
        }

        .slug_update_button {
            line-height: 0px;
            margin: 0;
            padding: 12px;
        }

        .meta .flex-column{
            background-color: #f2f2f2;
        }

        .meta .flex-column a{
            color: #0c0c0c;
        }




    </style>
@endsection
@section('site-title')
    {{__('New Page')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Page')}}   </h4>
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">
                                    <a href="{{ route('admin.page') }}" class="btn btn-primary">{{__('All Pages')}}</a>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('admin.page.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="lang" value="{{$default_lang}}">
                            <div class="tab-content margin-top-40">

                                <div class="form-group">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" name="title" placeholder="{{__('Title')}}" id="title">
                                </div>


                                <div class="form-group permalink_label">
                                    <label class="text-dark">{{__('Permalink * : ')}}
                                        <span id="slug_show" class="display-inline"></span>
                                        <span id="slug_edit" class="display-inline">
                                         <button class="btn btn-warning btn-sm slug_edit_button"> <i class="fas fa-edit"></i> </button>

                                        <input type="text" name="slug" class="form-control blog_slug mt-2" style="display: none">
                                          <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                    </span>
                                    </label>
                                </div>

                                <div class="form-group classic-editor-wrapper">
                                    <label>{{__('Content')}}</label>
                                    <input type="hidden" name="page_content">
                                    <div class="summernote"></div>
                                </div>

                            </div>

                            <div class="row mt-5">
                                <x-backend.page-meta-data-create
                                        :sidebarHeading="'Page Meta'"
                                />
                            </div>

                      </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Navbar Variant')}}</h4>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="navbar_variant" value="01" name="navbar_variant">
                            </div>
                            <div class="row">
                                @for($i = 1; $i < 3; $i++)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="img-select selected">
                                            <div class="img-wrap">
                                                <img src="{{asset('assets/frontend/navbar-variant/'.$i.'.jpg')}}" data-home_id="0{{$i}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Footer Variant')}}</h4>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="footer_variant" value="01" name="footer_variant">
                        </div>
                        <div class="row">
                            @for($i = 1; $i < 3; $i++)
                                <div class="col-lg-12 col-md-12">
                                    <div class="img-select selected">
                                        <div class="img-wrap">
                                            <img src="{{asset('assets/frontend/footer-variant/'.$i.'.jpg')}}" data-home_id="0{{$i}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body meta">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="page_builder_status"><strong>{{__('Page Builder Enable/Disable')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="page_builder_status">
                                        <span class="slider onff"></span>
                                    </label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="page_builder_status"><strong>{{__('Breadcrumb Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" checked name="breadcrumb_status">
                                        <span class="slider onff"></span>
                                    </label>
                                </div>


                                <div class="form-group col-md-12">
                                    <div class="btn-wrapper page-builder-btn-wrapper d-none">
                                        <a href="#" class="btn btn-primary">{{__('Open Page Builder')}}</a> <br>
                                        <small class="info-text">{{__('Page builder option is available in page edit only')}}</small>
                                    </div>
                                </div>


                                <div class="form-group col-md-12 layout d-none">
                                    <label>{{__('Page Layout')}}</label>
                                    <select name="layout" class="form-control">
                                        <option value="normal_layout" >{{__('Normal Layout')}}</option>
                                        <option value="home_page_layout">{{__('Home Page')}}</option>
                                        <option value="home_page_layout_two">{{__('Home Page Layout Two')}}</option>
                                        <option value="sidebar_layout">{{__('Sidebar Layout')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 page_class d-none">
                                    <label>{{__('Page Class')}}</label>
                                    <select name="page_class" class="form-control">
                                        <option value="" >{{__('None')}}</option>
                                        <option value="nav-absolute">{{__('Custom Class')}}</option>
                                    </select>
                                    <small class="">{{ __('Adjust page frontend view selecting by none or custom class') }}</small>
                                </div>
                                <div class="form-group col-md-12 page_class d-none">
                                    <label>{{__('Back To Top Icon Color')}}</label>
                                    <select name="back_to_top" class="form-control">
                                        <option value="" >{{__('Default Color')}}</option>
                                        <option value="style-02" >{{__('Blue')}}</option>
                                        <option value="style-03" >{{__('Orange')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>{{__('Visibility')}}</label>
                                    <select name="visibility" class="form-control">
                                        <option value="all">{{__('All')}}</option>
                                        <option value="user">{{__('Only Logged In User')}}</option>
                                    </select>
                                </div>
                            </div>
                            <x-fields.status :name="'status'" :title="__('Status')"/>
                            <button type="submit" id="submit" class="btn btn-info mt-4 pr-4 pl-4">{{__('Submit')}}</button>
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
    <x-media.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('change','input[name="page_builder_status"]',function(){
                    if($(this).is(':checked')){
                        $('.classic-editor-wrapper').addClass('d-none');
                        $('.page-builder-btn-wrapper').removeClass('d-none');
                        $('.layout').removeClass('d-none');
                        $('.page_class').removeClass('d-none');
                    }else {
                        $('.classic-editor-wrapper').removeClass('d-none');
                        $('.page-builder-btn-wrapper').addClass('d-none');
                        $('.layout').addClass('d-none');
                        $('.page_class').addClass('d-none');
                    }
                });
                <x-btn.submit/>
                
                function makeSlug(slug){
                   let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    //remove multiple space to single
                    finalSlug = slug.replace(/  +/g, ' ');
                    // remove all white spaces single or multiple spaces
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Permalink Code
                $('.permalink_label').hide();

                $(document).on('keyup', '#title', function (e) {
                    var slug = makeSlug($(this).val());
                    var url = `{{url('/')}}/` + slug;
                    $('.permalink_label').show();
                    var data = $('#slug_show').text(url).css('color', 'blue');
                    $('.blog_slug').val(slug);

                });

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.blog_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.blog_slug').val();
                    var slug = makeSlug(update_input);
                    var url = `{{url('/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.blog_slug').val(slug);
                    $('.blog_slug').hide();
                });

                $(document).on('change','#langchange',function(e){
                    $('#langauge_change_select_get_form').trigger('submit');
                });

                $('.summernote').summernote({
                    height: 400,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function (contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    }
                });
                if ($('.summernote').length > 1) {
                    $('.summernote').each(function (index, value) {
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });

            //For Navbar
            var imgSelect = $('.img-select');
            var id = $('#navbar_variant').val();
            imgSelect.removeClass('selected');
            $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
            $(document).on('click','.img-select img',function (e) {
                e.preventDefault();
                imgSelect.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#navbar_variant').val($(this).data('home_id'));
            })

            //For Footer
            var imgSelect = $('.img-select');
            var id = $('#footer_variant').val();
            imgSelect.removeClass('selected');
            $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
            $(document).on('click','.img-select img',function (e) {
                e.preventDefault();
                imgSelect.removeClass('selected');
                $(this).parent().parent().addClass('selected').siblings();
                $('#footer_variant').val($(this).data('home_id'));
            })

        })(jQuery);
    </script>
@endsection

