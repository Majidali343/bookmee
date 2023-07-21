@if(Auth::guard('web')->check())
  @if(Auth::guard('web')->user()->user_type == 1)
      <br><a class="cmn-btn btn-bg-1 chat-toggle open-button" data-id="{{ $service_details->seller_id }}" data-user="{{ optional($service_details->seller)->name }}"><i class="las la-comments"></i> {{ get_static_option('service_chat_title') ?? sprintf(__('Chat With %s'),optional($service_details->seller)->name) }} </a>
  @endif
@else
  <br><a href="javascript:void(0);" class="cmn-btn btn-bg-1 d-block" data-toggle="modal" data-target="#LoginModal"><i class="las la-comments"></i> {{ __('Login To Chat') }} </a>
@endif