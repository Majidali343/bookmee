@extends('backend.admin-master')
@section('site-title')
    {{__('All Child Categories')}}
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
                                <h4 class="header-title">{{__('All Child Categories')}}  </h4>
                                @can('child-category-list')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('child-category-create')
                            <div class="right-content">
                                <a href="{{ route('admin.child.category.new')}}" class="btn btn-primary">{{__('Add New Child Category')}}</a>
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
                                <th>{{__('Child Category')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Subcategory')}}</th>
                                <th>{{__('Main Category')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($child_categories as $data)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$data->id"/>
                                            </td>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>
                                                @php
                                                    $child_cat_img = get_attachment_image_by_id($data->image,null,true);
                                                @endphp
                                                @if (!empty($child_cat_img))
                                                    <div class="attachment-preview">
                                                        <div class="thumbnail">
                                                            <div class="centered">
                                                                <img class="avatar user-thumb"
                                                                     src="{{$child_cat_img['img_url']}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php  $img_url = $child_cat_img['img_url']; @endphp
                                                @endif
                                            </td>

                                            <!--sub category -->
                                            <td>{{ optional($data->subcategory)->name}}</td>
                                            <!--Main category -->
                                            <td>{{optional($data->category)->name}}</td>
                                            <td>
                                                @can('child-category-status')
                                                    @if($data->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.child.category.status',$data->id)"/></span>
                                                @endcan
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>

                                            <td>
                                                @can('child-category-delete')
                                                  <x-delete-popover :url="route('admin.child.category.delete',$data->id)"/>
                                                @endcan

                                                    <x-edit-icon :url="route('admin.child.category.edit',$data->id)"/>

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
                <x-bulk-action-js :url="route('admin.child.category.bulk.action')"/>

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

                $(document).on('click', '.child_category_edit_btn', function () {
                    var el = $(this);
                    var id = el.data('id');
                    var name = el.data('name');
                    var slug_value_show_permalink = el.data('slug');
                    var category_id = el.data('categoryid');
                    var sub_category_id = el.data('sub_category_id');
                    var form = $('#child_category_edit_modal');

                    form.find('#up_id').val(id);
                    form.find('#up_name').val(name);
                    form.find('#up_slug').val(slug_value_show_permalink);
                    form.find('#up_category_id').val(category_id);
                    form.find('#up_sub_category_id').val(sub_category_id);

                    var url = "{{url('/child-category/')}}/" + slug_value_show_permalink;
                    var data = $('#slug_show').text(url).css('color', 'blue');


                    //category select change subcategory in modal data
                    $(document).on('change','#up_category_id',function(){
                        let category_id = $(this).val();
                        $.ajax({
                           url: '{{ route('admin.get.subcategory.by.category') }}',
                           type:'get',
                           data: {
                               category_id:category_id
                           },
                            success: function(data){
                                if(data.markup != ''){
                                    $('#up_sub_category_id').html(data.markup)
                                }
                            },
                            error: function (){
                            }
                        });
                    });

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
                    $('.child_category_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.child_category_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `{{url('/child-category/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.child_category_slug').hide();
                });


            });
        })(jQuery);
    </script>
@endsection
