@extends('backend.admin-master')
@section('site-title')
    {{__('GDPR Compliant Cookie Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("GDPR Compliant Cookie Settings")}}</h4>
                        <form action="{{route('admin.general.gdpr.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_gdpr_cookie_title">{{__('GDPR Title')}}</label>
                                <input type="text" name="site_gdpr_cookie_title"  class="form-control" value="{{get_static_option('site_gdpr_cookie_title')}}" id="site_gdpr_cookie_title">
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_message">{{__('GDPR Message')}}</label>
                                <textarea name="site_gdpr_cookie_message"  class="form-control" rows="5" id="site_gdpr_cookie_message">{{get_static_option('site_gdpr_cookie_message')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_more_info_label">{{__('GDPR More Info Link Label')}}</label>
                                <input type="text" name="site_gdpr_cookie_more_info_label"  class="form-control" value="{{get_static_option('site_gdpr_cookie_more_info_label')}}" id="site_gdpr_cookie_more_info_label">
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_more_info_link">{{__('GDPR More Info Link')}}</label>
                                <input type="text" name="site_gdpr_cookie_more_info_link"  class="form-control" value="{{get_static_option('site_gdpr_cookie_more_info_link')}}" id="site_gdpr_cookie_more_info_link">
                                <small class="form-text text-muted">{{__('enter more info link user {url} to point the site address, example: {url}/about , it will be converted to www.yoursite.com/about')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_accept_button_label">{{__('GDPR Cookie Accept Button Label')}}</label>
                                <input type="text" name="site_gdpr_cookie_accept_button_label"  class="form-control" value="{{get_static_option('site_gdpr_cookie_accept_button_label')}}" id="site_gdpr_cookie_accept_button_label">
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_decline_button_label">{{__('GDPR Cookie Decline Button Label')}}</label>
                                <input type="text" name="site_gdpr_cookie_decline_button_label"  class="form-control" value="{{get_static_option('site_gdpr_cookie_decline_button_label')}}" id="site_gdpr_cookie_decline_button_label">
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_manage_button_label">{{__('GDPR Cookie Manage Button Label')}}</label>
                                <input type="text" name="site_gdpr_cookie_manage_button_label"  class="form-control" value="{{get_static_option('site_gdpr_cookie_manage_button_label')}}" >
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_manage_title">{{__('GDPR Cookie Manage Title')}}</label>
                                <input type="text" name="site_gdpr_cookie_manage_title"  class="form-control" value="{{get_static_option('site_gdpr_cookie_manage_title')}}" >
                            </div>
                                        
                            <div class="form-group">
                                <label for="site_gdpr_cookie_enabled"><strong>{{__('GDPR Cookie Enable/Disable')}}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="site_gdpr_cookie_enabled"  @if(!empty(get_static_option('site_gdpr_cookie_enabled'))) checked @endif id="site_gdpr_cookie_enabled">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_expire">{{__('Cookie Expire')}}</label>
                                <input type="text" name="site_gdpr_cookie_expire"  class="form-control" value="{{get_static_option('site_gdpr_cookie_expire')}}" id="site_gdpr_cookie_expire">
                                <small class="form-text text-muted">{{__('set cookie expire time, eg: 30, means 30days')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_gdpr_cookie_delay">{{__('Show Delay')}}</label>
                                <input type="text" name="site_gdpr_cookie_delay"  class="form-control" value="{{get_static_option('site_gdpr_cookie_delay')}}" id="site_gdpr_cookie_delay">
                                <small class="form-text text-muted">{{__('set GDPR cookie delay time, it mean the notification will show after this time. number count as mili seconds. eg: 5000, means 5seconds')}}</small>
                            </div>
                            @php
                                $all_title_fields = get_static_option('site_gdpr_cookie_manage_item_title');
                                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [''];
                                //
                                $all_description_fields = get_static_option('site_gdpr_cookie_manage_item_description');
                                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [''];
                            @endphp
                            @foreach($all_title_fields as $index => $title)
                                <div class="iconbox-repeater-wrapper">
                                    <div class="all-field-wrap">
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_manage_item_title" class="gdpr_title_text_color">{{__('Title')}}</label>
                                            <input type="text" name="site_gdpr_cookie_manage_item_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_gdpr_cookie_manage_item_description" class="gdpr_title_text_color">{{__('Description')}}</label>
                                            <textarea name="site_gdpr_cookie_manage_item_description[]" class="form-control max-height-120" cols="30" rows="5">{{$all_description_fields[$index] ?? ''}}</textarea>
                                        </div>
                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click','.all-field-wrap .action-wrap .add',function (e){
            e.preventDefault();
            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');
            var clonedData = parent.clone();
            var containerLength = container.length;
            clonedData.find('#myTab').attr('id','mytab_'+containerLength);
            clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
            var allTab =  clonedData.find('.tab-pane');
            allTab.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('id');
                el.attr('id',oldId+containerLength);
            });
            var allTabNav =  clonedData.find('.nav-link');
            allTabNav.each(function (index,value){
                var el = $(this);
                var oldId = el.attr('href');
                el.attr('href',oldId+containerLength);
            });

            parent.parent().append(clonedData);

            if (containerLength > 0){
                parent.parent().find('.remove').show(300);
            }
            parent.parent().find('.iconpicker-popover').remove();
            parent.parent().find('.icp-dd').iconpicker();

        });

        $(document).on('click','.all-field-wrap .action-wrap .remove',function (e){
            e.preventDefault();
            var el = $(this);
            var parent = el.parent().parent();
            var container = $('.all-field-wrap');

            if (container.length > 1){
                el.show(300);
                parent.hide(300);
                parent.remove();
            }else{
                el.hide(300);
            }
        });
        $('.icp-dd').iconpicker();
        $('body').on('iconpickerSelected','.icp-dd', function (e) {
            var selectedIcon = e.iconpickerValue;
            $(this).parent().parent().children('input').val(selectedIcon);
            $('body .dropdown-menu.iconpicker-container').removeClass('show');
        });
    </script>
@endsection
