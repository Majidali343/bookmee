

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div style="padding-top: 20px;color:white ;font-family:poppins ;font-weight: 700;font-size:26px;line-height: 31px;">Seller</div>
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top padding-top-40">
            <div class="thumb">
                @if(!is_null(Auth::guard('web')->user()->image))
                {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
                @else
                <img src="{{ asset('assets/frontend/img/static/user_profile.png') }}" alt="No Image"> 
                @endif
            </div>
            <div class="author-content">
                <h4 class="title"> {{ Auth::guard('web')->user()->name }} </h4>
                {{-- <strong><a href="{{ route('homepage') }}" target="_blank">{{ __('Visit Site') }}</a></strong> --}}
            </div>
        </div>
              
        
        <div class="dashboard-bottom margin-top-35 margin-bottom-50">
            <ul class="dashboard-list ">
                <li class="list @if(request()->is('seller/dashboard*')) active @endif">
                    <a href="{{ route('seller.dashboard') }}"> <i class="las la-th"></i> {{__('Dashboard')}} </a>
                </li>
                {{-- @if(moduleExists('LiveChat'))
                <li class="list @if(request()->is('seller/live-chat*')) active @endif">
                    <a href="{{ route('seller.live.chat') }}"> <i class="las la-th"></i> {{__('Live Chat')}} </a>
                </li>
                @endif --}}
                @if(moduleExists('Subscription') && $commissionGlobal->system_type === 'subscription' && Route::has('seller.subscription.all'))
                    <li class="list @if(request()->is('seller/subscription*')) active @endif">
                        <a href="{{ route('seller.subscription.all') }}"> <i class="las la-th"></i> {{__('Subscriptions')}} </a>
                    </li>
                @endif
                {{-- @if(moduleExists('JobPost'))
                    @php
                        $jobs = \Modules\JobPost\Entities\BuyerJob::whereDoesntHave('sellerViewJobs', function ($list){
                           $list->where('seller_id', Auth::guard('web')->user()->id);
                        })
                        ->latest()->count();
                    @endphp
                    <li class="list @if(request()->is('seller/job/notification/new/jobs*')) active @endif">
                        <a href="{{ route('seller.new.jobs') }}"> <i class="las la-cog"></i> {{__('New Jobs')}} <span class="badge badge-danger">{{ $jobs }}</span></a>
                    </li>
                    <li class="list @if(request()->is('seller/job/request/*')) active @endif">
                        <a href="{{ route('seller.all.jobs.request') }}"> <i class="las la-th"></i> {{__('All Jobs Request')}} </a>
                    </li>
                @endif --}}
                
                {{-- @if(moduleExists('Wallet'))
                    <li class="list @if(request()->is('seller/wallet-history*')) active @endif">
                        <a href="{{ route('seller.wallet.history') }}"> <i class="las la-th"></i> {{__('Wallet')}} </a>
                    </li>
                @endif --}}

                <li class="list @if(request()->is('seller/coupons*')) active @endif">
                    <a href="{{ route('seller.service.coupon') }}"> <i class="las la-gifts"></i> {{__('Discounts')}} </a>
                </li>
                <li class="list @if(request()->is('seller/services*') || request()->is('seller/add-services*') || request()->is('seller/service-attributes*') || request()->is('seller/edit-services*') || request()->is('seller/edit-service-attributes*') || request()->is('seller/add-service-attributes-by-id*')) active @endif">
                    <a href="{{ route('seller.services') }}"> <i class="las la-cogs"></i>{{ __('Services') }} </a>
                </li>
                <li class="list @if(request()->is('seller/staff*')) active @endif">
                    <a href="{{ route('seller.staff') }}"> <i class="las la-user-friends"></i>{{ __('Staff') }} </a>
                </li>
                <li class="list @if(request()->is('seller/days*') || request()->is('seller/add-day*')) active @endif">
                    <a href="{{ route('seller.days') }}"> <i class="las la-calendar-week"></i>{{ __('Create Day') }} </a>
                </li>

                <li class="list">
                    <a href="{{ route('seller.timings') }}"> <i class="las la-calendar-week"></i>{{ __('Business Timing') }} </a>
                </li>
 {{--
                <li class="list @if(request()->is('seller/schedules*') || request()->is('seller/add-schedule*')) active @endif">
                    <a href="{{ route('seller.schedules') }}"> <i class="las la-clock"></i>{{ __('Create Schedule') }} </a>
                </li>
				
				--}}
				
                <li class="list @if(request()->is('seller/pending-orders')) active @endif">
                    <a href="{{ route('seller.pending.orders') }}"> <i class="las la-tasks"></i> {{ __('Pending Booking') }} </a>
                </li>

                <li class="list
                @if(request()->is('seller/orders')) active
                 @elseif(request()->is('seller/orders/cancel-orders')) active
                 @elseif(request()->is('seller/orders/complete-orders')) active
                 @elseif(request()->is('seller/orders/deliver-orders')) active
                 @elseif(request()->is('seller/orders/active-orders')) active
                 @else
                 @endif">
                    <a href="{{ route('seller.orders') }}"> <i class="las la-list-alt"></i> {{ __('All Bookings') }} </a>
                </li>

                {{-- @if(moduleExists('JobPost'))
                <li class="list
                @if(request()->is('seller/job-orders')) active
                 @elseif((request()->is('seller/orders/job/cancel-orders'))) active
                 @elseif((request()->is('seller/orders/job/complete-orders'))) active
                 @elseif((request()->is('seller/orders/job/deliver-orders'))) active
                 @elseif((request()->is('seller/orders/job/active-orders'))) active
                 @else
                 @endif">
                    <a href="{{ route('seller.job.orders') }}"> <i class="las la-list-alt"></i> {{ __('All Job Orders') }} </a>
                </li>
                @endif --}}

                <li class="list @if(request()->is('seller/notification/all-notifications*')) active @endif">
                    <a href="{{ route('seller.notification.all') }}"> <i class="las la-bell"></i> {{ __('All Notifications') }} </a>
                </li>
                {{-- <li class="list @if(request()->is('seller/payout-request*')) active @endif">
                    <a href="{{ route('seller.payout') }}"> <i class="las la-dollar-sign"></i>{{ __('Payout History') }} </a>
                </li> --}}
                <li class="list @if(request()->is('seller/service-reviews*')) active @endif">
                    <a href="{{ route('seller.service.review') }}"> <i class="lar la-star"></i>{{ __('Review') }}</a>
                </li>
                {{-- <li class="list @if(request()->is('seller/all-tickets*')) active @endif">
                    <a href="{{ route('seller.support.ticket') }}"> <i class="las la-headset"></i>{{ __('Support Ticket') }}</a>
                </li> --}}
                <li class="list @if(request()->is('seller/report/list*')) active @endif">
                    <a href="{{ route('seller.order.report.list')}}"> <i class="las la-user"></i> {{__('Reports List')}} </a>
                </li>
                {{-- <li class="list @if(request()->is('seller/to-do-list*')) active @endif">
                    <a href="{{ route('seller.todolist') }}"> <i class="las la-list"></i>{{ __('Todo List') }}</a>
                </li> --}}
                <li class="list @if(request()->is('seller/profile*')) active @endif">
                    <a href="{{ route('seller.profile')}}"> <i class="las la-user"></i> {{__('Profile')}} </a>
                </li>
                <li class="list @if(request()->is('seller/seller-profile-verify*')) active @endif">
                    <a href="{{ route('seller.profile.verify')}}"> <i class="las la-user"></i> {{__('Profile Verify')}} </a>
                </li>
                <li class="list @if(request()->is('seller/account-settings*')) active @endif">
                    <a href="{{ route('seller.account.settings') }}"> <i class="las la-cog"></i> {{__('Settings')}} </a>
                </li>
                <li class="list">
                    <a href="{{ route('seller.logout')}}"> <i class="las la-sign-out-alt"></i> {{__('Log Out' )}} </a>
                </li>
            </ul>
        </div>
        <div class="dashboard-logo">
            <a href="{{ route('homepage') }}" class="logo">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>
</div>