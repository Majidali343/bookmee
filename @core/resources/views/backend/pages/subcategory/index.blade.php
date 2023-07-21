@extends('backend.admin-master')
@section('site-title')
    {{__('All Subcategories')}}
@endsection

@section('style')
<x-datatable.css/>
<x-media.css/>

 <style>
     .attachment-preview{
         width: 95px;
         height: 95px;
     }
     .media_upload_section_image{
         margin-left: 18px;
     }
     .new_meta_section{
         margin-top: -44px;
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Subcategories')}}  </h4>
                                @can('subcategory-list')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('subcategory-create')
                            <div class="right-content">
                                <a href="{{ route('admin.subcategory.new')}}" class="btn btn-primary">{{__('Add New Subcategory')}}</a>
                            </div>
                             @endcan
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
                                <th>{{__('Subcategory')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Main Category')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($sub_categories as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>
                                                @php
                                                    $sub_cat_img = get_attachment_image_by_id($data->image,null,true);
                                                    $fb_sub_cat_img = get_attachment_image_by_id(optional($data->metaData)->facebook_meta_image, null, true);
                                                     $meta_fb_img_url = $fb_sub_cat_img['img_url'];
                                                @endphp
                                                @if (!empty($sub_cat_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                    src="{{$sub_cat_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $img_url = $sub_cat_img['img_url'];
                                                      @endphp
                                                @endif
                                                </td>
                                            <td>{{optional($data->category)->name}}</td>
                                            <td>
                                                @can('subcategory-status')
                                                    @if($data->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.subcategory.status',$data->id)"/></span>
                                                @endcan
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                            <td>
                                                @can('subcategory-delete')
                                                  <x-delete-popover :url="route('admin.subcategory.delete',$data->id)"/>
                                                @endcan
                                                @can('subcategory-edit')
                                                    <x-edit-icon :url="route('admin.subcategory.edit',$data->id)"/>
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

    <x-media.markup/>
@endsection

@section('script')
 <x-datatable.js/>
 <x-media.js/>
    <script type="text/javascript">

        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.subcategory.bulk.action')"/>

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

                $(document).on('click', '.subcategory_edit_btn', function () {
                    var el = $(this);
                    var id = el.data('id');
                    var name = el.data('name');
                    var slug_value_show_permalink = el.data('slug');
                    var category_id = el.data('categoryid');
                    var form = $('#subcategory_edit_modal');

                    form.find('#up_id').val(id);
                    form.find('#up_name').val(name);
                    form.find('#up_slug').val(slug_value_show_permalink);
                    form.find('#up_category_id').val(category_id);

                    var url = "{{url('/subcategory/')}}/" + slug_value_show_permalink;
                    var data = $('#slug_show').text(url).css('color', 'blue');

                    var image = el.data('image');
                    var imageid = el.data('imageid');

                    if (imageid != '') {
                        form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="' + image + '" > </div></div></div>');
                        form.find('.media-upload-btn-wrapper input').val(imageid);
                        form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                    }
                });

                //Permalink Code
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
                    $('.subcategory_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.subcategory_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `{{url('/subcategory/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.subcategory_slug').hide();
                });

            });
        })(jQuery);
    </script>
@endsection
