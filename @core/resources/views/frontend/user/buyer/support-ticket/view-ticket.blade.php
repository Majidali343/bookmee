@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('View Tickets')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <style>
        span.low,
        span.status-open {
            display: inline-block;
            background-color: #6bb17b;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
            font-size: 10px;
            margin: 3px;
        }

        span.high,
        span.status-close {
            display: inline-block;
            background-color: #c66060;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
            font-size: 10px;
            margin: 3px;
        }

        span.medium {
            display: inline-block;
            background-color: #70b9ae;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
            font-size: 10px;
            margin: 3px;
        }

        span.urgent {
            display: inline-block;
            background-color: #bfb55a;
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;
            text-transform: capitalize;
            border: none;
            font-weight: 600;
            font-size: 10px;
            margin: 3px;
        }

        /* support ticket  */

        .reply-message-wrap {
            padding: 40px;
            background-color: #fbf9f9;
        }

        .gig-message-start-wrap {
            margin-top: 60px;
            margin-bottom: 60px;
            background-color: #fbf9f9;
            padding: 40px;
        }

        .single-message-item {
            background-color: #e7ebec;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-right: 80px;
        }

        .reply-message-wrap .title {
            font-size: 22px;
            line-height: 32px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .single-message-item.customer {
            background-color: #dadde0;
            text-align: left;
            margin-right: 0;
        }

        .reply-message-wrap .title {
            font-size: 22px;
            line-height: 32px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .gig-message-start-wrap .boxed-btn {
            padding: 8px 10px;
        }

        .reply-message-wrap .boxed-btn {
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .reply-message-wrap textarea:focus {
            outline: none;
            box-shadow: none;
        }

        .reply-message-wrap textarea {
            border: 1px solid #e2e2e2;
        }

        .gig-message-start-wrap .title {
            font-size: 20px;
            line-height: 30px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .single-message-item .thumb .title {
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #c7e5ec;
            display: inline-block;
            border-radius: 5px;
            text-align: center;
        }

        .single-message-item .title {
            font-size: 16px;
            line-height: 20px;
            margin: 10px 0 0px 0;
        }

        .single-message-item .time {
            display: block;
            font-size: 13px;
            margin-bottom: 20px;
            font-weight: 500;
            font-style: italic;
        }

        .single-message-item .thumb i {
            display: block;
            width: 100%;
        }

        .single-message-item.customer .thumb .title {
            background-color: #efd2d2;
        }

        .single-message-item .top-part {
            display: flex;
            margin-bottom: 25px;
        }

        .single-message-item .top-part .content {
            flex: 1;
            margin-left: 15px;
        }


        .anchor-btn {
            border-bottom: 1px solid var(--main-color-one);
            color: var(--main-color-one);
            display: inline-block;
        }

        .all-message-wrap.msg-row-reverse {
            display: flex;
            flex-direction: column-reverse;
            position: relative;
        }

        .load_all_conversation:focus {
            outline: none;
        }

        .load_all_conversation {
            border: none;
            background-color: #111D5C;
            border-radius: 30px;
            font-size: 14px;
            line-height: 20px;
            padding: 10px 30px;
            color: #fff;
            cursor: pointer;
            text-transform: capitalize;
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 500;
        }

        .single-message-item ol, .single-message-item ul {
            padding-left: 15px;
        }

        .anchor-btn {
            color: #345990;
            text-decoration: underline;
            margin: 5px 0;
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
                @include('frontend.user.buyer.partials.sidebar')

                <div class="dashboard-right">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-settings margin-top-40">
                                <h2 class="dashboards-title"> {{__('Ticket Details')}} </h2>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="gig-chat-message-heading">
                                        <div class="header-wrap d-flex justify-content-between">
                                            <h4 class="header-title">{{__('Support Ticket Details')}}</h4>
                                            <a class="btn btn-primary btn-xs" href="{{route('buyer.support.ticket')}}">{{__('All Tickets')}}</a>
                                        </div>
                                        
                                        <div class="gig-order-info">
                                            <p><strong>{{__('Ticket ID:') }}</strong> #{{ $ticket_details->id }}</p>
                                            <p><strong>{{__('Title:') }}</strong> {{ $ticket_details->title }}</p>
                                            <p><strong>{{__('Subject:') }}</strong> {{ $ticket_details->subject }}</p>
                                            <p><strong>{{__('Description:') }}</strong> {{ $ticket_details->description }}</p>
                                            <p><strong>{{__('Status:') }}</strong> <span class="status-{{ $ticket_details->status }}">{{ __(ucfirst($ticket_details->status )) }}</span></p>
                                            <p><strong>{{__('Priority:') }}</strong> <span class="{{ $ticket_details->priority }}">{{ __(ucfirst($ticket_details->priority)) }}</span></p>
                                            <p><strong>{{__('Order ID:') }}</strong> #{{ $ticket_details->order_id }}</p>
                                        </div>
            
                                        <div class="gig-message-start-wrap">
                                            <h2 class="title">{{__('All Conversation')}}</h2>
                                            <div class="all-message-wrap @if($q == 'all') msg-row-reverse @endif">
                                                @if($q == 'all' && count($all_messages) > 1)
                                                    <form action="" method="get">
                                                        <input type="hidden" value="all" name="q">
                                                        <button class="load_all_conversation" type="submit">{{__('load all message')}}</button>
                                                    </form>
                                                @endif
                                                @forelse($all_messages as $msg)
                                                    <div class="single-message-item @if($msg->type == 'buyer') customer @endif">
                                                        <div class="top-part">
                                                            <div class="thumb">
                                                            <span class="title">
                                                                 @if($msg->type == 'buyer')
                                                                    {{substr($ticket_details->ticket_buyer->name ?? 'B',0,1)}}
                                                                @else
                                                                    {{substr($ticket_details->ticket_seller->name ?? 'S',0,1)}}
                                                                @endif
                                                            </span>
                                                                @if($msg->notify == 'on')
                                                                    <i class="fas fa-envelope mt-2" title="{{__('Notified by email')}}"></i>
                                                                @endif
                                                            </div>
                                                            <div class="content">
                                                                <h6 class="title">
                                                                    @if($msg->type == 'buyer')
                                                                        {{$ticket_details->ticket_buyer->name ?? 'B'}}
                                                                    @else
                                                                        {{$ticket_details->ticket_seller->name ?? 'S'}}
                                                                    @endif
                                                                </h6>
                                                                <span class="time">{{date_format($msg->created_at,'d/m/y H:i:s')}} | {{$msg->created_at->diffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <div class="message-content">
                                                                {!! $msg->message !!}
                                                            </div>
                                                            @if(file_exists('assets/uploads/ticket/'.$msg->attachment))
                                                                <a href="{{asset('assets/uploads/ticket/'.$msg->attachment)}}" download class="anchor-btn">{{$msg->attachment}}</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="alert alert-warning">{{__('no message found')}}</p>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="reply-message-wrap ">
                                            <h5 class="title">{{__('Reply To Message')}}</h5>
            
                                            <x-msg.success/>
                                            <x-msg.error/>
            
                                            <form action="{{route('buyer.support.ticket.message.send')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{$ticket_details->id}}" name="ticket_id">
                                                <input type="hidden" value="buyer" name="user_type">
                                                <div class="form-group">
                                                    <label for="">{{__('Message')}}</label>
                                                    <textarea name="message" class="form-control d-none" cols="30" rows="5" ></textarea>
                                                    <div class="summernote"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">{{__('File')}}</label>
                                                    <input type="file" name="file" accept="zip">
                                                    <small class="info-text d-block text-danger">{{__('max file size 200mb, only zip file is allowed')}}</small>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="send_notify_mail" id="send_notify_mail">
                                                    <label for="send_notify_mail">{{__('Notify Via Mail')}}</label>
                                                </div>
                                                <button class="btn-primary btn btn-md" type="submit">{{__('Send Message')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    

                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
    @endsection  


@section('scripts')
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>

<script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
<script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
{{-- @include('backend.partials.media-upload.media-js') --}}

    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                        Swal.fire({
                        title: '{{__("Are you sure?")}}',
                        text: '{{__("You would not be able to revert this item!")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, delete it!')}}"
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $('.summernote').summernote({
                    height: 200,   //set editable area's height
                    codemirror: { // codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('textarea').val(contents);
                        }
                    }
                });

            });

        })(jQuery);
    </script>
@endsection
