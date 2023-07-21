@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <style>
        .form-group.extra-padding {
            padding-top: 30px;
            display: inline-block;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="{{asset('assets/backend/css/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/show-hint.css')}}">
    <x-datatable.css/>
@endsection
@section('site-title')
    {{__('Typography Settings')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <x-msg.success/>
                        <x-msg.error/>

                        <div class="form-group custom_font_title_button">
                            <label for="custom_font">{{__('Use Custom Font')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="custom_font"  @if($custom_font >= 1) checked  @else  @endif id="custom_font">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <!-- custom font -->
                          <div class="custom_font_upload">
                              <h4 class="header-title mt-4">{{ __('Upload Font') }}</h4>
                            <form action="{{ route('admin.custom.font.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="files[]" placeholder="Choose files" multiple>
                                <button type="submit"  class="btn btn-primary mt-4 pr-4 pl-4">{{__('Upload')}}</button>
                            </form>
                              <span class="text-danger">{{ __(' allowed file format: ttf, woff, woff2, eot')  }}</span>
                          </div>

                                <div class="row custom_font_hide_and_show">
                                    <div class="col-lg-12 mt-5">
                                        <div class="card">
                                            <h4 class="header-title mt-2">{{__("Custom Font Typography Settings")}}</h4>
                                            <div class="card-body">
                                                <div class="table-wrap table-responsive">
                                                    <table class="table table-default">
                                                        <thead>
                                                        <th>{{__('ID')}}</th>
                                                        <th>{{__('Font Family')}}</th>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Body Typography')}}</th>
                                                        <th>{{__('Heading Typography')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($all_fonts as $data)
                                                            <tr>
                                                                <td>{{$data->id}}</td>
                                                                <td>{{$data->file}}</td>
                                                                <td>
                                                                   @can('custom-font-status')
                                                                    @if($data->status==1)
                                                                        <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                                    @elseif($data->status==2)
                                                                            <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                                    @else
                                                                        <span class="btn btn-danger">{{__('Inactive')}}</span>
                                                                    @endif
                                                                @endcan
                                                                </td>

                                                                <td>
                                                                    @can('custom-font-status')
                                                                        @if($data->status==1)
                                                                            <i class="las la-check-circle" style="font-size: 32px;color: #28a745"></i>
                                                                        @endif
                                                                        @if($data->status==0)
                                                                                <span><x-custom-body-font :url="route('admin.custom.font.status',$data->id)"/></span>
                                                                        @endif

                                                                    @endcan
                                                                </td>
                                                                <td>
                                                                        @can('custom-font-status')
                                                                            @if($data->status==2)
                                                                                <i class="las la-check-circle" style="font-size: 32px;color: #28a745"></i>
                                                                            @endif
                                                                            @if($data->status==0)
                                                                            <span><x-custom-heading-font :url="route('admin.custom.heading.font.status',$data->id)"/></span>
                                                                            @endif
                                                                        @endcan
                                                                </td>

                                                                <td>

                                                                    @if($data->status == 0)
                                                                    @can('custom-font-delete')
                                                                        <x-delete-popover :url="route('admin.custom.delete.font.file',$data->id)"/>
                                                                    @endcan
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

                          <!-- custom font end -->
                        <div class="google_font_hide_and_show">
                        <h4 class="header-title">{{__("Body Typography Settings")}}</h4>
                        <form action="{{route('admin.general.typography.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="body_font_family">{{__('Font Family')}}</label>
                                <select class="form-control nice-select wide" name="body_font_family" id="body_font_family">
                                    @foreach($google_fonts as $font_family => $font_variant)
                                        <option value="{{$font_family}}" @if($font_family == get_static_option('body_font_family')) selected @endif>{{$font_family}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group margin-top-50">
                                <label for="body_font_variant">{{__('Font Variant')}}</label>
                                @php
                                    $font_family_selected = get_static_option('body_font_family') ?? get_static_option('body_font_family') ;
                                    $get_font_family_variants = property_exists($google_fonts,$font_family_selected) ? (array) $google_fonts->$font_family_selected : ['variants' => array('regular')];
                                @endphp
                                <select class="form-control nice-select wide" multiple id="body_font_variant" name="body_font_variant[]">
                                    @foreach($get_font_family_variants['variants'] as $variant)
                                        @php
                                            $selected_variant = !empty(get_static_option('body_font_variant')) ? unserialize(get_static_option('body_font_variant')) : [];
                                        @endphp
                                        <option value="{{$variant}}" @if(in_array($variant,$selected_variant)) selected @endif>{{str_replace(['0,','1,'],['','i'],$variant)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h4 class="header-title margin-top-80">{{__("Heading Typography Settings")}}</h4>
                            <div class="form-group">
                                <label for="heading_font">{{__('Heading Font')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="heading_font"  @if(!empty(get_static_option('heading_font'))) checked @endif id="heading_font">
                                    <span class="slider"></span>
                                </label>
                                <small>{{__('Use different font family for heading tags ( h1,h2,h3,h4,h5,h6)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="heading_font_family">{{__('Font Family')}}</label>
                                <select class="form-control nice-select wide" name="heading_font_family" id="heading_font_family">
                                    @foreach($google_fonts as $font_family => $font_variant)
                                        <option value="{{$font_family}}" @if($font_family == get_static_option('heading_font_family')) selected @endif>{{$font_family}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group margin-top-50">
                                <label for="heading_font_variant">{{__('Font Variant')}}</label>
                                @php
                                    $font_family_selected = get_static_option('heading_font_family') ?? '';
                                    $get_font_family_variants = property_exists($google_fonts,$font_family_selected) ? (array) $google_fonts->$font_family_selected : ['variants' => array('regular')];
                                @endphp
                                <select class="form-control nice-select wide" multiple name="heading_font_variant[]" id="heading_font_variant">
                                    @foreach($get_font_family_variants['variants'] as $variant)
                                        @php
                                            $selected_variant = !empty(get_static_option('heading_font_variant')) ? unserialize(get_static_option('heading_font_variant')) : [];
                                        @endphp
                                        <option value="{{$variant}}"
                                                @if(in_array($variant,$selected_variant)) selected @endif>{{str_replace(['0,','1,'],['','i'],$variant)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="typography_submit_btn" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                       </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-datatable.js/>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>

        <script src="{{asset('assets/backend/js/codemirror.js')}}"></script>
        <script src="{{asset('assets/backend/js/css.js')}}"></script>
        <script src="{{asset('assets/backend/js/show-hint.js')}}"></script>
        <script src="{{asset('assets/backend/js/css-hint.js')}}"></script>
        <script>
            (function($) {
                "use strict";
                var editor = CodeMirror.fromTextArea(document.getElementById("custom_css_area"), {
                    lineNumbers: true,
                    mode: "text/css",
                    matchBrackets: true
                });
            })(jQuery);
        </script>


    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                //load font variant Four
                $(document).on('change','#body_font_family_three',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_three');
                });

                //load font variant Four
                $(document).on('change','#body_font_family_four',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_four');
                });

                //load font variant Five
                $(document).on('change','#body_font_family_five',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();
                    getVariant($(this).val(),'body_font_variant_five');
                });

                function getVariant(fontFamily,selector){
                    $.ajax({
                        url: "{{route('admin.general.typography.single')}}",
                        type: "POST",
                        data:{
                            _token: "{{csrf_token()}}",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#'+selector);
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });
                            variantSelector.niceSelect('update');
                        }
                    });
                }


                $(document).on('change','#body_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "{{route('admin.general.typography.single')}}",
                        type: "POST",
                        data:{
                            _token: "{{csrf_token()}}",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#body_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });
                            variantSelector.niceSelect('update');
                        }
                    });
                });

                $(document).on('change','#heading_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "{{route('admin.general.typography.single')}}",
                        type: "POST",
                        data:{
                            _token: "{{csrf_token()}}",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#heading_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });

                            variantSelector.niceSelect('update');
                        }
                    });

                });

                // google font use
                $(document).on('change','#google_font_family',function (e) {
                    e.preventDefault();
                    var fontFamily =  $(this).val();

                    $.ajax({
                        url: "{{route('admin.general.typography.single')}}",
                        type: "POST",
                        data:{
                            _token: "{{csrf_token()}}",
                            font_family : fontFamily
                        },
                        success:function (data) {
                            var variantSelector = $('#heading_font_variant');
                            variantSelector.html('');
                            $.each(data.variants,function (index,value) {
                                var nameval = value.replace('0,','');
                                nameval = nameval.replace('1,','i');
                                variantSelector.append('<option value="'+value+'">'+nameval+'</option>');
                            });

                            variantSelector.niceSelect('update');
                        }
                    });

                });

                if($('.nice-select').length > 0){
                    $('.nice-select').niceSelect();
                }
                var dependendFields = $('select[name="heading_font_family"],#heading_font_variant');
                if(!$('input[name="heading_font"]').prop('checked')){
                    dependendFields.parent().hide()
                }

                // google heading font on off button
                $(document).on('change','input[name="heading_font"]',function (e) {
                    if(!$(this).prop('checked')){
                        dependendFields.parent().hide();
                    }else{
                        dependendFields.parent().show();
                    }
                });


                // custom font start
                if ($("#custom_font").is(':checked')){
                    $('.google_font_hide_and_show').hide();
                    $('.google_font_title_button').hide();
                }else{
                    $('.custom_font_hide_and_show').hide();
                    $('.custom_font_upload').hide();
                }

                $("#custom_font").on('change', function() {
                    if ($("#custom_font").is(':checked')){
                        $('.google_font_hide_and_show').hide();
                        $('.custom_font_hide_and_show').show();
                        $('.custom_font_title_button').show();
                        $('.custom_font_upload').show();
                    }else {
                        $('.google_font_hide_and_show').show();
                        $('.google_font_title_button').show();
                        $('.custom_font_hide_and_show').hide();
                        $('.custom_font_title_button').show();
                        $('.custom_font_upload').hide();
                    }
                });
                // custom font end



                $(document).on('click','#typography_submit_btn',function (e) {
                    e.preventDefault();
                    $(this).text('Updating...').prop('disabled',true);
                    $(this).parent().trigger('submit');
                })


                // custom heading font add
                $(document).on('click','.custom_heading_swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to make as this default heading font? ")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.custom_heading_font_form_submit_btn').trigger('click');
                        }
                    });
                });

                // custom heading font add
                $(document).on('click','.custom_body_swal_status_change',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to make as this default body font?")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.custom_body_font_form_submit_btn').trigger('click');
                        }
                    });
                });

            });
        }(jQuery));
    </script>
@endsection
