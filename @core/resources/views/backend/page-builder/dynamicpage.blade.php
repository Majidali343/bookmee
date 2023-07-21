@extends('backend.admin-master')
@section('style')
    <x-pagebuilder.css/>
    <style>
        .dropdown-item + .note-icon-menu-check:before {
            visibility: hidden;
            opacity: 0;
            display: none;
        }
        
        .note-popover .popover-content .dropdown-menu.note-check a i, .card-header.note-toolbar .dropdown-menu.note-check a i {
            color: deepskyblue;
            visibility: visible;
        }
    </style>
@endsection

@section('site-title')
    {{$page->title}} {{__('Page Builder')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapper d-flex justify-content-between">
                            <h4 class="header-title">{{__('Page Builder')}}</h4>
                            <div class="btn-wrapper">
                                <a class="btn btn-lg btn-secondary btn-sm mb-3 mr-1"  href="{{route('admin.page.edit',$page->id)}}">
                                    {{__('Go Back')}}
                                </a>
                                <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1"  href="{{route('admin.page')}}">
                                    {{__('All pages')}}
                                </a>
                                <a class="btn btn-lg btn-info btn-sm mb-3 mr-1" target="_blank" href="{{route('frontend.dynamic.page',$page->slug)}}">
                                    <i class="fas fa-external-link-alt"></i> {{__('View Page')}}
                                </a>
                            </div>
                        </div>

                        <div id="page-builder-wrap"
                             class="margin-top-50 page-builder-content-wrap">

                            <div class="row">
                                <div class="col-lg-6">
                                    @if($page->layout === 'normal_layout' || $page->layout === 'home_page_layout' || $page->layout === 'home_page_layout_two')
                                    <div class="page-builder-area-wrapper extra-title">
                                        <h4 class="main-title">{{__(ucfirst(str_replace('_',' ',$page->layout)))}}</h4>
                                        <ul id="dynamic_page"
                                            class="sortable available-form-field main-fields sortable_widget_location">
                                            {!! \App\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page',$page->id) !!}
                                        </ul>
                                    </div>
                                    @endif
                                    @if($page->layout === 'home_page_layout' || $page->layout === 'home_page_layout_two')
                                        <div class="page-builder-area-wrapper extra-title">
                                            <h4 class="main-title">{{__('With Sidebar Layout')}}</h4>
                                            <ul id="dynamic_page_with_sidebar"
                                                class="sortable available-form-field main-fields sortable_widget_location margin-bottom-15">
                                                {!! \App\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page_with_sidebar',$page->id) !!}
                                            </ul>
                                        </div>
                                    @endif

                                    @if($page->layout === 'home_page_layout_two')
                                        <div class="page-builder-area-wrapper extra-title">
                                            <h4 class="main-title">{{__('Without Sidebar Layout')}}</h4>
                                            <ul id="dynamic_page_with_sidebar_two"
                                                class="sortable available-form-field main-fields sortable_widget_location margin-bottom-15">
                                                {!! \App\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page_with_sidebar_two',$page->id) !!}
                                            </ul>
                                        </div>
                                    @endif

                                    @if($page->layout === 'sidebar_layout')
                                        <div class="page-builder-area-wrapper extra-title">
                                            <h4 class="main-title">{{__('With Sidebar Layout')}}</h4>
                                            <ul id="dynamic_page_with_sidebar"
                                                class="sortable available-form-field main-fields sortable_widget_location margin-bottom-15">
                                                {!! \App\PageBuilder\PageBuilderSetup::get_saved_addons_for_dynamic_page('dynamic_page_with_sidebar',$page->id) !!}
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="col-lg-6">
                                    <div class="search-wrap">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="search_addon_field" placeholder="{{__('Search Addon')}}" name="s">
                                        </div>
                                    </div>
                                    <div class="all-addons-wrapper">
                                        <ul id="sortable_02" class="available-form-field all-widgets sortable_02">
                                            {!! \App\PageBuilder\PageBuilderSetup::get_admin_panel_widgets() !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-media.markup/>
@endsection

@section('script')
    <x-pagebuilder.js/>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                <x-pagebuilder.helper/>

            /*---------------------------------
            *   PREVIEW IMAGE
            * --------------------------------*/
                $(document).on('mouseover','.all-addons-wrapper ul.ui-sortable li.widget-handler',function (e){
                    var imgUrl = $(this).find('a').attr('href');
                    $(this).append('<div class="imageupshow"><img src="'+imgUrl+'" alt=""></div>');
                });
                $(document).on('mouseout','.all-addons-wrapper ul.ui-sortable li.widget-handler',function (e){
                    $(this).find('.imageupshow').remove();
                });


                $(document).on('change','.addon_advertisement_size',function(e){
                    e.preventDefault();
                    alert(1);
                });

                /*----------------------------------
                *   SEARCH WIDGETS
                * ---------------------------------*/
                $(document).on('keyup','#search_addon_field',function (){
                    var searchText = $(this).val();
                    var allWidgets = $('.available-form-field.sortable_02 li > h4');
                    $.each(allWidgets,function (index,value){
                        var text = $(this).text();
                        var found = text.toLowerCase().match(searchText.toLowerCase().trim());
                        if (!found){
                            $(this).parent().hide();
                        }else{
                            $(this).parent().show();
                        }
                    });
                });

                /*-----------------------------------
                *   PAGE BUILDER CORE SCRIPT
                * ---------------------------------*/
                $(".sortable").sortable({
                    handle: "h4.top-part",
                    axis: "y",
                    helper: "clone",
                    placeholder: "sortable-placeholder",
                    receive: function (event, li) {
                        resetOrder(this.id);
                        setAddonLocation(event);
                    },
                    stop: function (event, li) {
                        resetOrder(this.id);
                    }
                });


                function setAddonLocation(event){
                    var addonLocation = event.target.getAttribute('id');
                    var allDraggerdAddon = $('#'+event.target.getAttribute('id')).find('li');
                    allDraggerdAddon.each(function (index,value){
                       $(this).find('input[name="addon_location"]').val(addonLocation);
                       $(this).find('input[name="addon_page_type"]').val(addonLocation);
                       $(this).find('input[name="addon_order"]').val(index + 1);
                    });
                }

                function renderWidgetMarkup(event,li){

                    var addonClass = li.item.attr('data-name');
                    var namespace = li.item.attr('data-namespace');
                    var markup = '';
                    $.ajax({
                        'url': "{{route('admin.page.builder.get.addon.markup')}}",
                        'type': "POST",
                        'data': {
                            '_token': "{!! csrf_token() !!}",
                            'addon_class': addonClass,
                            'addon_namespace': namespace,
                            'addon_page_id': '{{$page->id}}',
                            'addon_page_type': event.target.getAttribute('id'),
                            'addon_location': event.target.getAttribute('id'),
                        },
                        async: false,
                        success: function (data) {
                            markup = data;
                        }
                    });

                    li.item.clone()
                        .html(markup)
                        .insertAfter(li.item);
                    return markup;
                }


                $(".sortable_02").sortable({
                    handle: "h4.top-part",
                    connectWith: '.sortable_widget_location',
                    helper: "clone",
                    remove: function (e, li) {
                        renderWidgetMarkup(e,li);
                        $(this).sortable('cancel');
                    }
                }).disableSelection();


                $('body').on('click', '.remove-widget', function (e) {
                    $(this).parent().remove();
                    $(".sortable_02").sortable("refreshPositions");
                    var parent = $(this).parent();
                    var widgetType = parent.find('input[name="addon_type"]').val();
                    resetOrder();

                    if (widgetType === 'update') {
                        var widget_id = parent.find('input[name="id"]').val();
                        $.ajax({
                            'url': "{{route('admin.page.builder.delete')}}",
                            'type': "POST",
                            'data': {
                                '_token': "{!! csrf_token() !!}",
                                'id': widget_id
                            },
                            success: function (data) {
                            }
                        });
                    }
                });

                $('body').on('click', '.expand', function (e) {
                    $(this).parent().siblings().find('.content-part').find('.nice-select').niceSelect('destroy');
                    $(this).parent().siblings().find('.content-part').removeClass('show');
                    $(this).parent().find('.content-part').find('.nice-select').niceSelect('destroy');
                    $(this).parent().find('.content-part').toggleClass('show');


                    var expand = $(this).children('i');
                    var parent = $(this).parent();
                    var classname = $(this).parent().data('name');
                    if (expand.hasClass('ti-angle-down')) {
                        expand.attr('class', 'ti-angle-up');
                        $('.note-editable').trigger('focus');
                        var colorPickerNode = $('li[data-name="'+classname+'"] .color_picker');
                        colorPickerInit(colorPickerNode);
                        var summerNote = $('li[data-name="'+classname+'"] .summernote');

                        summerNote.summernote({
                            disableDragAndDrop: true,
                            height: 200,   //set editable area's height
                            codeviewFilter: true,
                            codeviewIframeFilter: true,
                            toolbar: [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['Insert', ['link','table','video','picture']],
                            ],
                            styleTags: [
                                'p',
                                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                            ],
                            codemirror: { // codemirror options
                                theme: 'monokai'
                            },
                            callbacks: {
                                onPaste: function (e) {
                                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                                    e.preventDefault();
                                    document.execCommand('insertText', false, bufferText);
                                }
                            }
                        });
                    } else {
                        expand.attr('class', 'ti-angle-down');
                        $('body .color_picker').spectrum('destroy');
                        $('body .nice-select').niceSelect('destroy');
                        $('li[data-name="'+classname+'"] .summernote').summernote('destroy');
                    }
                    $('body .icp-dd').iconpicker('destroy');
                    $('body .icp-dd').iconpicker();
                    $(this).parent().find('.content-part').find('.nice-select').niceSelect();

                });

                $('body').on('click', '.widget_save_change_button', function (e) {
                    e.preventDefault();
                    var parent = $(this).parent().find('.widget_save_change_button');
                    parent.text('{{__('Saving...')}}').attr('disabled', true);
                    var form = $(this).parent();
                    var widgetType = $(this).parent().find('input[name="addon_type"]').val();
                    var formAction = $(this).parent().attr('action');
                    var udpateId = '';
                    var formContainer = $(this).parent();
                    var sortableId = formContainer.parent().parent().parent().attr('id');

                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: form.serializeArray(),
                        success: function (data) {
                            udpateId = data.id;
                            if (widgetType === 'new') {
                                formContainer.attr('action', "{{route('admin.page.builder.update')}}")
                                formContainer.find('input[name="addon_type"]').val('update');
                                formContainer.prepend('<input type="hidden" name="id" value="' + udpateId + '">');
                            }
                            if (data === 'ok') {
                                form.append('<span class="text-success">{{__('data saved success')}}</span>');
                            }
                            setTimeout(function () {
                                form.find('span.text-success').remove();
                            }, 2000);

                        }
                    });

                    parent.text('saved..');
                    setTimeout(function () {
                        parent.text('{{__('Save Changes')}}').attr('disabled', false);
                    }, 1000);
                });

                /**
                 * reset order function
                 * */
                function resetOrder(dropedOn) {
                    var allItems = $('#' + dropedOn + ' li');
                    $.each(allItems, function (index, value) {
                        $(this).find('input[name="addon_order"]').val(index + 1);
                        $(this).find('input[name="addon_location"]').val(dropedOn);
                        var id = $(this).find('input[name="id"]').val();
                        var widget_order = index + 1;
                        if (typeof id != 'undefined') {
                            reset_db_order(id, widget_order);
                        }
                    });
                }

                /**
                 * reorder function
                 * */
                function reset_db_order(id, addon_order) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.page.builder.update.addon.order')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id,
                            addon_order: addon_order
                        },
                        success: function (data) {
                            //response ok if it saved success
                        }
                    });
                }

                $(document).on('click', '.widget-area-expand', function (e) {
                    e.preventDefault();
                    var widgetbody = $(this).parent().parent().find('.widget-area-body');
                    widgetbody.toggleClass('hide');
                    var expand = $(this).children('i');
                    if (expand.hasClass('ti-angle-down')) {
                        expand.attr('class', 'ti-angle-up');
                    } else {
                        expand.attr('class', 'ti-angle-down');
                        var allWidgets = $(this).parent().parent().find('.widget-area-body ul li');
                        $.each(allWidgets, function (value) {
                            $(this).find('.content-part').removeClass('show');
                        });
                    }
                });


            });
        })(jQuery);

    </script>

@endsection
