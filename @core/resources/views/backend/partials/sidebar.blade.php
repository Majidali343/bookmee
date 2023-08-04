<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.home') }}">
                @if (get_static_option('site_admin_dark_mode') == 'off')
                    {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                @else
                    {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                @endif
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ active_menu('admin-home') }}">
                        <a href="{{ route('admin.home') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>@lang('dashboard')</span>
                        </a>
                    </li>

                    {{-- @can('public-chat')
                        @if(moduleExists("LiveChat"))
                            <li class="{{ active_menu('admin-home/chat-users/seller') }}
                            @if (request()->is('admin-home/chat-users/*')) active @endif">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-comment-alt"></i>
                                    <span>{{ __('Live Chat') }} <small class="badge badge-danger">{{__('Addon')}}</small></span>
                                </a>
                                <ul class="collapse">
                                    <li class="{{ active_menu('admin-home/seller') }} @if (request()->is('admin-home/seller/*')) active @endif">
                                        <a href="{{ route('admin.chat.seller') }}">{{ __('Chat Users') }}</a>
                                    </li>
                                    <li class="{{ active_menu('admin-home/chat-users/login/text/show-hide') }} @if (request()->is('admin-home/chat-users/login/text/show-hide/*')) active @endif">
                                        <a href="{{ route('admin.chat.login.text.show.hide') }}">{{ __('Chat Login Text') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endcan --}}
{{-- 
                    @if(Route::has('admin.subscription.all'))
                        @canany(['subscription-list','seller-subscription-list','subscription-coupon-list','subscription-reminder'])
                            @if(moduleExists("Subscription"))
                                <li class="{{ active_menu('admin-home/subscription/all') }}
                                @if (request()->is('admin-home/subscription/*')) active @endif">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-list-thumb"></i>
                                        <span>{{ __('Subscription') }}</span> <small class="badge badge-danger">{{__('Addon')}}</small></a>
                                    <ul class="collapse">
                                        @can('subscription-list')
                                            <li class="{{ active_menu('admin-home/subscription/all') }} @if (request()->is('admin-home/subscription/edit-subscription/*')) active @endif"><a
                                                 href="{{ route('admin.subscription.all') }}">{{ __('All Subscription') }}</a></li>
                                        @endcan
                                        @can('seller-subscription-list')
                                            <li class="{{ active_menu('admin-home/subscription/seller-subscription') }} @if (request()->is('admin-home/subscription/seller-subscription/*')) active @endif"><a
                                                 href="{{ route('admin.seller.subscription') }}">{{ __('Seller Subscription') }}</a></li>
                                        @endcan
                                        @can('subscription-coupon-list')
                                            <li class="{{ active_menu('admin-home/subscription/coupon') }} @if (request()->is('admin-home/subscription/coupon/*')) active @endif"><a
                                                href="{{ route('admin.subscription.coupon') }}">{{ __('Subscription Coupons') }}</a></li>
                                        @endcan
                                        @can('subscription-reminder')
                                            <li class="{{ active_menu('admin-home/subscription/settings') }} @if (request()->is('admin-home/subscription/settings/*')) active @endif"><a
                                                href="{{ route('admin.subscription.settings') }}">{{ __('Email Alert Settings') }}</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                        @endcan
                    @endif --}}

                    {{-- @if(Route::has('admin.jobs.all'))
                        @canany(['job-list'])
                            @if(moduleExists("JobPost"))
                                <li class="{{ active_menu('admin-home/jobs/all') }}
                                @if (request()->is('admin-home/jobs/*')) active @endif">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-bag"></i>
                                        <span>{{ __('Jobs') }}</span> <small class="badge badge-danger">{{__('Addon')}}</small></a>
                                    <ul class="collapse">
                                        @can('job-list')
                                            <li class="{{ active_menu('admin-home/jobs/all') }} @if (request()->is('admin-home/subscription/edit-subscription/*')) active @endif"><a
                                                 href="{{ route('admin.jobs.all') }}">{{ __('All Jobs') }}</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                        @endcan
                    @endif --}}

                    {{-- @if(Route::has('admin.wallet.lists'))
                        @canany(['job-list'])
                            @if(moduleExists("Wallet"))
                                <li class="{{ active_menu('admin-home/wallet/lists') }}
                                @if (request()->is('admin-home/wallet/*')) active @endif">
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-wallet"></i>
                                        <span>{{ __('Wallet') }}</span> <small class="badge badge-danger">{{__('Addon')}}</small>
                                    </a>
                                    <ul class="collapse">
                                        @can('wallet-list')
                                            <li class="{{ active_menu('admin-home/wallet/lists') }} @if (request()->is('admin-home/wallet/lists')) active @endif">
                                                <a href="{{ route('admin.wallet.lists') }}">{{ __('Wallet Lists') }}</a>
                                            </li>
                                        @endcan
                                        @can('wallet-history')
                                            <li class="{{ active_menu('admin-home/wallet/history/records') }} @if (request()->is('admin-home/wallet/history/records')) active @endif">
                                                <a href="{{ route('admin.wallet.history') }}">{{ __('Wallet History') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endif
                        @endcan
                    @endif --}}

                    @if (auth()->guard('admin')->user()->hasRole('Super Admin'))
                        <li
                            class="
                        {{ active_menu('admin-home/admin/new') }}
                        {{ active_menu('admin-home/admin/role') }}
                        {{ active_menu('admin-home/admin/all') }}">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                                <span>{{ __('Admin Role Manage') }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/admin/all') }}"><a
                                        href="{{ route('admin.all.user') }}">{{ __('All Admin') }}</a></li>
                                <li class="{{ active_menu('admin-home/admin/new') }}"><a
                                        href="{{ route('admin.new.user') }}">{{ __('Add New Admin') }}</a></li>
                                <li class="{{ active_menu('admin-home/admin/role') }} "><a
                                        href="{{ route('admin.all.admin.role') }}">{{ __('All Admin Role') }}</a></li>
                            </ul>
                        </li>
                    @endif

                    @canany(['user-list', 'user-create'])
                        <li class="main_dropdown
                        @if (request()->is(['admin-home/frontend/new-user', 'admin-home/frontend/all-user', 'admin-home/frontend/all-user/role','admin-home/frontend/deactive-users','admin-home/frontend/seller-profile-view*'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                                <span>{{ __('Users Manage') }}</span></a>
                            <ul class="collapse">
                                @can('user-list')
                                    <li class="{{ active_menu('admin-home/frontend/all-user') }}"><a
                                            href="{{ route('admin.all.frontend.user') }}">{{ __('All Users') }}</a></li>
                                @endcan
                                @can('user-list')
                                    <li class="{{ active_menu('admin-home/frontend/deactive-users') }}">
                                        <a href="{{ route('admin.all.frontend.deactive.user') }}">{{ __('Deactive Users') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- @canany(['blog-list', 'blog-tag-list', 'blog-create', 'blog-trashed-list',
                        'blog-details'])
                        <li
                            class=" {{ active_menu('admin-home/blog') }}
                            @if (request()->is(['admin-home/blog/*', 'admin-home/blog-category', 'admin-home/blog-tags'])) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-comment-alt"></i>
                                <span>{{ __('Blogs') }}</span></a>
                            <ul class="collapse">
                                @can('blog-list')
                                    <li class="{{ active_menu('admin-home/blog') }} @if (request()->is('admin-home/blog-edit/*')) active @endif"><a
                                            href="{{ route('admin.blog') }}">{{ __('All Blogs') }}</a></li>
                                @endcan
                                @can('blog-tag-list')
                                    <li class="{{ active_menu('admin-home/blog-tags') }}"><a
                                            href="{{ route('admin.blog.tags') }}">{{ __('Tags') }}</a></li>
                                @endcan

                                @can('blog-create')
                                    <li class="{{ active_menu('admin-home/blog/new') }}">
                                        <a href="{{ route('admin.blog.new') }}">{{ __('Add New Post') }}</a>
                                    </li>
                                @endcan

                                @can('blog-trashed-list')
                                    <li class="{{ active_menu('admin-home/blog/trashed') }}"><a
                                            href="{{ route('admin.blog.trashed') }}">{{ __('All Trashed Items') }}</a></li>
                                @endcan

                                @can('blog-detail-setting')
                                    <li class="{{ active_menu('admin-home/blog/blog-details-settings') }}"><a
                                        href="{{ route('admin.blog.details.settings') }}">{{ __('Blog Details Settings') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany --}}

                    @canany(['pages-list', 'pages-create'])
                        <li
                            class="{{ active_menu('admin-home/dynamic-page') }}
                        {{ active_menu('admin-home/dynamic-page/new') }}
                        @if (request()->is('admin-home/page-edit/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{ __('Pages') }}</span></a>
                            <ul class="collapse">
                                @can('pages-list')
                                    <li class="{{ active_menu('admin-home/dynamic-page') }} @if (request()->is('admin-home/dynamic-page/edit/*')) active @endif"><a
                                            href="{{ route('admin.page') }}">{{ __('All Pages') }}</a></li>
                                @endcan
                                @can('pages-create')
                                    <li class="{{ active_menu('admin-home/dynamic-page/new') }}"><a
                                            href="{{ route('admin.page.new') }}">{{ __('Add New Page') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- @canany(['slider-list'])
                        <li class="{{ active_menu('admin-home/category') }}
                        @if (request()->is('admin-home/slider/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-mobile"></i>
                                <span>{{ __('Mobile Settings') }}</span></a>
                            <ul class="collapse">
                                @can('slider-list')
                                    <li class="{{ active_menu('admin-home/slider/add-new-slider') }} @if (request()->is('admin-home/slider/edit-slider/*')) active @endif"><a
                                         href="{{ route('admin.slider.new') }}">{{ __('Slider Settings') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}

                    @canany(['category-list', 'category-create'])
                        <li class="{{ active_menu('admin-home/category') }}
                    @if (request()->is('admin-home/category/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-view-list"></i>
                                <span>{{ __('Categories') }}</span></a>
                            <ul class="collapse">
                                @can('category-list')
                                    <li class="{{ active_menu('admin-home/category') }} @if (request()->is('admin-home/category/edit/*')) active @endif"><a
                                            href="{{ route('admin.category') }}">{{ __('All Categories') }}</a></li>
                                @endcan
                                @can('category-create')
                                    <li class="{{ active_menu('admin-home/category/new') }}"><a
                                            href="{{ route('admin.category.new') }}">{{ __('Add New Category') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    {{-- @canany(['subcategory-list', 'subcategory-create'])
                        <li
                            class="{{ active_menu('admin-home/subcategory') }}
                    @if (request()->is('admin-home/subcategory/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-cta-right"></i>
                                <span>{{ __('Sub Category') }}</span></a>
                            <ul class="collapse">
                                @can('subcategory-list')
                                    <li class="{{ active_menu('admin-home/subcategory') }} @if (request()->is('admin-home/location/edit/*')) active @endif"><a
                                            href="{{ route('admin.subcategory') }}">{{ __('All Sub Category') }}</a></li>
                                @endcan
                                @can('subcategory-create')
                                    <li class="{{ active_menu('admin-home/subcategory/new') }}"><a
                                            href="{{ route('admin.subcategory.new') }}">{{ __('Add New Subcategory') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}


                    {{-- @canany(['child-category-list', 'child-category-create'])
                        <li
                            class="{{ active_menu('admin-home/child-category') }}
                    @if (request()->is('admin-home/child-category/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-cta-right"></i>
                                <span>{{ __('Child Categories') }}</span></a>
                            <ul class="collapse">
                                @can('child-category-list')
                                    <li class="{{ active_menu('admin-home/child-category') }} @if (request()->is('admin-home/location/edit/*')) active @endif"><a
                                            href="{{ route('admin.child.category') }}">{{ __('All Child Category') }}</a></li>
                                @endcan
                                @can('child-category-create')
                                    <li class="{{ active_menu('admin-home/subcategory/new') }}"><a
                                            href="{{ route('admin.child.category.new') }}">{{ __('Add New Child Category') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan --}}


                    {{-- @canany(['brand-list', 'brand-create'])
                        <li class="{{ active_menu('admin-home/brand') }}
                    @if (request()->is('admin-home/brand/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dropbox"></i>
                                <span>{{ __('Brands') }}</span></a>
                            <ul class="collapse">
                                @can('brand-list')
                                    <li class="@if (request()->is('admin-home/brand')) active @endif"><a
                                            href="{{ route('admin.brand') }}">{{ __('All Brands') }}</a>
                                    </li>
                                @endcan

                                @can('brand-create')
                                    <li class="{{ active_menu('admin-home/brand/add') }} @if (request()->is('admin-home/brand/add')) active @endif"><a
                                            href="{{ route('admin.brand.add') }}">{{ __('Add New Brand') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany --}}

                    @canany(['country-list', 'country-create'])
                        <li class="{{ active_menu('admin-home/country') }}
                    @if (request()->is('admin-home/country/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-flag-alt"></i>
                                <span>{{ __('Service Country') }}</span></a>
                            <ul class="collapse">
                                @can('country-list')
                                    <li class="{{ active_menu('admin-home/city') }} @if (request()->is('admin-home/country')) active @endif"><a
                                            href="{{ route('admin.country') }}">{{ __('All Country') }}</a>
                                    </li>
                                @endcan

                                @can('country-create')
                                    <li class="{{ active_menu('admin-home/country/add') }} @if (request()->is('admin-home/country/add')) active @endif"><a
                                            href="{{ route('admin.country.add') }}">{{ __('Add New country') }}</a>
                                    </li>
                                @endcan

                                @can('country-import')
                                    <li class="{{ active_menu('admin-home/country/csv/import') }} @if (request()->is('admin-home/country/csv/import')) active @endif"><a
                                         href="{{ route('admin.import.csv.settings') }}">{{ __('Import country') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['city-list', 'city-create'])
                        <li class="{{ active_menu('admin-home/city') }}
                    @if (request()->is('admin-home/city/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-arrow-circle-right"></i>
                                <span>{{ __('Service City') }}</span></a>
                            <ul class="collapse">
                                @can('city-list')
                                    <li class="{{ active_menu('admin-home/city') }} @if (request()->is('admin-home/city')) active @endif"><a
                                            href="{{ route('admin.city') }}">{{ __('All Cities') }}</a>
                                    </li>
                                @endcan

                                @can('city-create')
                                    <li class="{{ active_menu('admin-home/city/add') }} @if (request()->is('admin-home/city/add')) active @endif"><a
                                            href="{{ route('admin.city.add') }}">{{ __('Add New City') }}</a>
                                    </li>
                                @endcan
                                @can('city-import')
                                    <li class="{{ active_menu('admin-home/city/csv/import') }} @if (request()->is('admin-home/city/csv/import')) active @endif"><a
                                         href="{{ route('admin.import.city.csv.settings') }}">{{ __('Import City') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['area-list', 'area-create'])
                        <li class="{{ active_menu('admin-home/area') }}
                            @if (request()->is('admin-home/area/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-back-right"></i>
                                <span>{{ __('Service Area') }}</span></a>
                            <ul class="collapse">
                                @can('area-list')
                                    <li class="{{ active_menu('admin-home/area') }} @if (request()->is('admin-home/area')) active @endif"><a
                                            href="{{ route('admin.area') }}">{{ __('All Areas') }}</a>
                                    </li>
                                @endcan

                                @can('area-create')
                                    <li class="{{ active_menu('admin-home/area/add') }} @if (request()->is('admin-home/area/add')) active @endif"><a
                                            href="{{ route('admin.area.add') }}">{{ __('Add New Area') }}</a>
                                    </li>
                                @endcan

                                @can('area-import')
                                    <li class="{{ active_menu('admin-home/area/csv/import') }} @if (request()->is('admin-home/area/csv/import')) active @endif"><a
                                        href="{{ route('admin.import.area.csv.settings') }}">{{ __('Import Area') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @can('tax-list')
                    <li class="{{ active_menu('admin-home/country/tax/all') }}">
                        <a href="{{ route('admin.country.tax') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{ __('Tax') }}</span>
                        </a>
                    </li>
                    @endcanany

                    @canany(['admin-service-list'])
                        <li class=" {{ active_menu('admin-home/services/admin-services') }}
                                @if (request()->is(['admin-home/services/admin-services/*',
                                                    'admin-home/services/admin-service/add-new-service',
                                                    'admin-home/services/admin-service/edit-service/*',
                                                    'admin-home/services/admin-service/add-service-attributes',
                                                    'admin-home/services/admin-service/add-service-attributes-by-id/*',
                                                    'admin-home/services/admin-service/edit-service-attributes-by-id/*',
                                                    'admin-home/services/admin-service/show-service-attributes-by-id/*',
                                                    ])) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-list-ol"></i>
                                <span>{{ __('Admin Services') }}</span></a>
                            <ul class="collapse">

                                @can('admin-service-list')
                                    <li class="{{ active_menu('admin-home/services/admin-services') }} @if (request()->is([
                                                    'admin-home/services/admin-services/*',
                                                    'admin-home/services/admin-service/edit-service/*',
                                                    'admin-home/services/admin-service/add-service-attributes',
                                                    'admin-home/services/admin-service/add-service-attributes-by-id/*',
                                                    'admin-home/services/admin-service/edit-service-attributes-by-id/*',
                                                    'admin-home/services/admin-service/show-service-attributes-by-id/*',
                                                    ])) active @endif">
                                        <a href="{{ route('admin.all.services') }}">{{ __('Admin Services') }}</a></li>
                                @endcan
                                @can('admin-service-add')
                                    <li class="{{ active_menu('admin-home/services/admin-service/add-new-service') }} @if (request()->is('admin-home/services/admin-service/add-new-service')) active @endif">
                                        <a href="{{ route('admin.add.service') }}">{{ __('Add Service') }}</a></li>
                                @endcan

                            </ul>
                        </li>
                    @endcanany

                    @canany(['service-list'])
                        <li
                            class=" {{ active_menu('admin-home/services') }}
                            @if (request()->is(['admin-home/services/*','admin-home/services/service-book-settings','admin-home/services/service-details-settings','admin-home/services/service-create-settings'])) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-list-ol"></i>
                                <span>{{ __('Services') }}</span></a>
                            <ul class="collapse">
                                @can('service-list')
                                    <li class="{{ active_menu('admin-home/services') }} @if (request()->is('admin-home/services')) active @endif">
                                        <a href="{{ route('admin.services') }}">{{ __('All Services') }}</a></li>
                                @endcan
{{--                                @can('coupon-list')--}}
{{--                                    <li class="{{ active_menu('admin-home/services/coupons/all') }} @if (request()->is('admin-home/services/coupons/all')) active @endif">--}}
{{--                                        <a href="{{ route('admin.service.coupons') }}">{{ __('Service Coupons') }}</a></li>--}}
{{--                                @endcan--}}
                                @can('service-book-setting')
                                    <li class="{{ active_menu('admin-home/services/login-register-settings') }}"><a
                                    href="{{ route('admin.service.book.settings') }}">{{ __('Login Register Settings') }}</a></li>
                                @endcan
                                @can('service-detail-setting')
                                <li class="{{ active_menu('admin-home/services/service-details-settings') }}"><a
                                href="{{ route('admin.service.details.settings') }}">{{ __('Service Details Settings') }}</a></li>
                                @endcan
                                @can('service-create-setting')
                                     <li class="{{ active_menu('admin-home/services/service-create-settings') }}"><a
                                     href="{{ route('admin.service.create.settings') }}">{{ __('Service Create Settings') }}</a></li>
                                @endcan
                                <li class="{{ active_menu('admin-home/services/service-book-settings') }}"><a
                                                href="{{ route('admin.service.book.settings') }}">{{ __('Service Book Settings') }}</a></li>
                                @can('order-create-setting')
                                    <li class="{{ active_menu('admin-home/services/order-create-settings') }}"><a
                                      href="{{ route('admin.order.create.settings') }}">{{ __('Order Create Settings') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @php
                        $all_order = App\Order::where('status', 0)->count();
                        $cancel_order = App\Order::where('status', 4)->count();
                    @endphp
                    @canany(['order-list','cancel-order-list','order-success-setting','order-request-complete'])
                    <li
                        class="{{ active_menu('admin-home/orders') }}
                        @if (request()->is(['admin-home/orders','admin-home/orders/cancel-orders','admin-home/orders/order-success-settings','admin-home/orders/order-details*','admin-home/orders/order-request-complete*','admin-home/orders/decline/complete-request/history*'])) active @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-list-ol"></i>
                            <span>{{ __('Orders') }}</span></a>
                        <ul class="collapse">
                            @can('order-list')
                            <li class="{{ active_menu('admin-home/orders') }}">
                                <a href="{{ route('admin.orders') }}">{{ __('All Orders') }}
                                    @if($all_order>=1)
                                    <span class="bage-notification"> {{ $all_order }} </span>
                                    @endif
                                </a>
                            </li>
                            @endcan
                            @can('cancel-order-list')
                            <li class="{{ active_menu('admin-home/orders/cancel-orders') }}">
                                <a href="{{ route('admin.orders.cancel') }}">{{ __('Cancelled Orders') }}
                                    @if($cancel_order>=1)
                                        <span class="bage-notification"> {{ $cancel_order }} </span>
                                    @endif
                                </a>
                            </li>
                            @endcan
                            @can('order-success-setting')
                            <li class="{{ active_menu('admin-home/orders/order-success-settings') }}">
                                <a href="{{ route('admin.order.success.settings') }}">{{ __('Order Success Settings') }}</a>
                            </li>
                            @endcan
                            @can('order-request-complete')
                                <li class="{{ active_menu('admin-home/orders/order-request-complete') }}">
                                    <a href="{{ route('admin.order.complete.request') }}">{{ __('Order Request Complete') }}</a>
                                </li>
                            @endcan
                                @can('order-request-complete')
                                    <li class="{{ active_menu('admin-home/orders/decline/complete-request/history') }}">
                                        <a href="{{ route('admin.orders.decline.history') }}">{{ __('Decline Complete Request') }}</a>
                                    </li>
                                @endcan
                            @can('extra-orders')
                                <li class="{{ active_menu('admin-home/orders/extra/orders') }}">
                                    <a href="{{ route('admin.extra.orders') }}"><i class="ti-list-ol"></i> {{ __('Extra Orders') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany
                    
                    @can('seller-buyer-report')
                        <li class="{{ active_menu('admin-home/orders/seller-buyer-report') }}">
                            <a href="{{ route('admin.order.seller.buyer.report') }}"><i class="ti-list-ol"></i> {{ __('Seller Buyer Report') }}</a>
                        </li>
                    @endcan

                    @canany(['ticket-list'])
                        <li class="{{ active_menu('admin-home/tickets') }}
                                @if (request()->is(['admin-home/tickets','admin-home/tickets/ticket-details'])) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-list-ol"></i>
                                <span>{{ __('Tickets') }}</span></a>
                            <ul class="collapse">
                                @can('ticket-list')
                                    <li class="{{ active_menu('admin-home/tickets') }}">
                                        <a href="{{ route('admin.tickets.all') }}">{{ __('All Tickets') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['payout-list', 'admin-commission','amount-settings','all-seller'])
                        <li class="{{ active_menu('admin-home/area') }}
                            @if (request()->is('admin-home/seller-settings/*') || request()->is('admin-home/frontend/seller-verify/all')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-back-right"></i>
                                <span>{{ __('Seller Settings') }}</span></a>
                            <ul class="collapse">
                                @canany(['payout-list'])
                                    <li class="{{ active_menu('admin-home/seller-settings/payout-request/all') }}">
                                        <a href="{{ route('admin.payout.request.all') }}" aria-expanded="true">{{ __('Payout Request') }}</a>
                                    </li>
                                @endcanany

                                @canany(['admin-commission'])
                                    <li class="{{ active_menu('admin-home/seller-settings/admin-commission/all') }}">
                                        <a href="{{ route('admin.commission.all') }}" aria-expanded="true"></i>{{ __('Admin Commission') }}</a>
                                    </li>
                                @endcanany

                                @canany(['amount-settings'])
                                    <li class="{{ active_menu('admin-home/seller-settings/amount-settings/all') }}">
                                        <a href="{{ route('admin.amount.settings') }}" aria-expanded="true">{{ __('Amount Settings') }}</a>
                                    </li>
                                @endcanany

                                @canany(['amount-settings'])
                                    <li class="{{ active_menu('admin-home/seller-settings/user/register/settings') }}">
                                        <a href="{{ route('admin.user.register.settings') }}" aria-expanded="true">{{ __('User Register Settings') }}</a>
                                    </li>
                                @endcanany

                                @canany(['all-seller'])
                                    <li class="{{ active_menu('admin-home/frontend/seller-verify/all') }}">
                                        <a href="{{ route('admin.frontend.seller.all') }}" aria-expanded="true">{{ __('All Seller') }}</a>
                                    </li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany

                    {{--//email template--}}
                    @if (auth()->guard('admin')->user()->hasRole('Super Admin'))
                        <li class="{{ active_menu('admin-home/email-template/all') }}
                        @if(request()->is('admin-home/email-template/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-back-right"></i>
                                <span>{{ __('Email Template Settings') }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/email-template/all') }}">
                                    <a href="{{ route('admin.email.template.all') }}" aria-expanded="true">{{ __('Email Templates') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{-- @can('form-builder')
                        <li class="main_dropdown @if (request()->is('admin-home/form-builder/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write mr-2"></i>
                                {{ __('Form Builder') }}
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/form-builder/all') }}">
                                    <a href="{{ route('admin.form.builder.all') }}">{{ __('All Custom Form') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endcan --}}

                    {{-- @canany(['appearance-media-image-manage', 'appearance-widget-builder',
                        'appearance-menu-list'])
                        <li
                            class="main_dropdown @if (request()->is(['admin-home/topbar-settings', 'admin-home/media-upload/page', 'admin-home/menu', 'admin-home/widgets', 'admin-home/menu-edit/*'])) active
                        @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i>
                                <span>{{ __('Appearance Settings') }}</span></a>
                            <ul class="collapse">

                                @can('appearance-media-image-manage')
                                    <li class="{{ active_menu('admin-home/media-upload/page') }}">
                                        <a href="{{ route('admin.upload.media.images.page') }}" aria-expanded="true">
                                            {{ __('Media Images Manage') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('appearance-widget-builder')
                                    <li class="{{ active_menu('admin-home/widgets') }}"><a
                                            href="{{ route('admin.widgets') }}">{{ __('Widget Builder') }}</a></li>
                                @endcan

                                @can('appearance-menu-list')
                                    <li
                                        class="{{ active_menu('admin-home/menu') }}
                            @if (request()->is('admin-home/menu-edit/*')) active @endif">
                                        <a href="{{ route('admin.menu') }}">{{ __('Menu Manage') }}</a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcanany --}}

                    @canany(['page-settings-404-page-manage', 'page-settings-maintain-page-manage'])
                        <li class="main_dropdown
                        @if (request()->is(['admin-home/contact-page/*', 'admin-home/404-page-manage', 'admin-home/maintains-page/settings'])) active @endif ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-panel"></i>
                                <span>{{ __('Other Page Settings') }}</span></a>
                            <ul class="collapse">

                                @can('page-settings-404-page-manage')
                                    <li class="{{ active_menu('admin-home/404-page-manage') }}">
                                        <a href="{{ route('admin.404.page.settings') }}">{{ __('404 Page Manage') }}</a>
                                    </li>
                                @endcan

                                @can('page-settings-maintain-page-manage')
                                    <li class="{{ active_menu('admin-home/maintains-page/settings') }}">
                                        <a
                                            href="{{ route('admin.maintains.page.settings') }}">{{ __('Maintain Page Manage') }}</a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcanany

                    @canany(['general-settings-reading-settings', 'general-settings-global-navbar-settings',
                        'general-settings-global-footer-settings', 'general-settings-site-identity',
                        'general-settings-basic-settings', 'general-settings-color-settings',
                        'general-settings-typography-settings', 'general-settings-seo-settings',
                        'general-settings-third-party-scripts', 'general-settings-email-template',
                        'general-settings-email-settings', 'general-settings-smtp-settings', 'general-settings-custom-css',
                        'general-settings-custom-js', 'general-settings-licence-settings',
                        'general-settings-cache-settings','database-upgrade'])
                        <li class="@if (request()->is('admin-home/general-settings/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                                <span>{{ __('General Settings') }}</span></a>
                            <ul class="collapse ">
                                @can('general-settings-reading-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/reading') }}"><a
                                            href="{{ route('admin.general.reading') }}">{{ __('Reading') }}</a>
                                    </li>
                                @endcan
                                @can('general-settings-global-navbar-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/global-variant-navbar') }}"><a
                                            href="{{ route('admin.general.global.variant.navbar') }}">{{ __('Navbar Global Variant') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-global-footer-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/global-variant-footer') }}"><a
                                            href="{{ route('admin.general.global.variant.footer') }}">{{ __('Footer Global Variant') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-payment-gateway')
                                    <li class="{{ active_menu('admin-home/general-settings/payment-gateway-settings') }}"><a
                                            href="{{ route('admin.general.global.payment.settings') }}">{{ __('Payment Gateway Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-pusher')
                                    <li class="{{ active_menu('admin-home/general-settings/pusher-settings') }}"><a
                                         href="{{ route('admin.general.global.pusher.settings') }}">{{ __('Live Chat Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-site-identity')
                                    <li class="{{ active_menu('admin-home/general-settings/site-identity') }}"><a
                                            href="{{ route('admin.general.site.identity') }}">{{ __('Site Identity') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-basic-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/basic-settings') }}"><a
                                            href="{{ route('admin.general.basic.settings') }}">{{ __('Basic Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-color-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/color-settings') }}"><a
                                            href="{{ route('admin.general.color.settings') }}">{{ __('Color Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-typography-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/typography-settings') }}"><a
                                            href="{{ route('admin.general.typography.settings') }}">{{ __('Typography Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-seo-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/seo-settings') }}"><a
                                            href="{{ route('admin.general.seo.settings') }}">{{ __('SEO Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-third-party-scripts')
                                    <li class="{{ active_menu('admin-home/general-settings/scripts') }}"><a
                                            href="{{ route('admin.general.scripts.settings') }}">{{ __('Third Party Scripts') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-email-template')
                                    <li class="{{ active_menu('admin-home/general-settings/email-template') }}"><a
                                            href="{{ route('admin.general.email.template') }}">{{ __('Email Template') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-email-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/email-settings') }}"><a
                                            href="{{ route('admin.general.email.settings') }}">{{ __('Email Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-smtp-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/smtp-settings') }}"><a
                                            href="{{ route('admin.general.smtp.settings') }}">{{ __('SMTP Settings') }}</a>
                                    </li>
                                @endcan

                                @can('general-settings-custom-css')
                                    <li class="{{ active_menu('admin-home/general-settings/custom-css') }}"><a
                                            href="{{ route('admin.general.custom.css') }}">{{ __('Custom CSS') }}</a></li>
                                @endcan

                                @can('general-settings-custom-js')
                                    <li class="{{ active_menu('admin-home/general-settings/custom-js') }}"><a
                                            href="{{ route('admin.general.custom.js') }}">{{ __('Custom JS') }}</a></li>
                                @endcan
                                @can('general-settings-licence-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/gdpr-setting') }}"><a
                                            href="{{ route('admin.general.gdpr.settings') }}">{{ __('Gdpr Settings') }}</a>
                                   
                                </li>
                                @endcan
                                @can('general-settings-licence-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/license-setting') }}"><a
                                            href="{{ route('admin.general.license.settings') }}">{{ __('Licence Settings') }}</a>
                                   
                                </li>
                                @endcan
                                @can('general-settings-cache-settings')
                                    <li class="{{ active_menu('admin-home/general-settings/cache-settings') }}"><a
                                            href="{{ route('admin.general.cache.settings') }}">{{ __('Cache Settings') }}</a>
                                    </li>
                                @endcan
                                @can('database-upgrade')
                                 <li class="{{active_menu('admin-home/general-settings/database-upgrade')}}"><a
                                        href="{{route('admin.general.database.upgrade')}}">{{__('Database Upgrade')}}</a>
                                  </li>
                                @endcan

                            </ul>
                        </li>
                    @endcanany

                    {{-- @can('language-list')
                        <li class="@if (request()->is('admin-home/languages/*') || request()->is('admin-home/languages')) active @endif">
                            <a href="{{ route('admin.languages') }}" aria-expanded="true"><i class="ti-signal"></i>
                                <span>{{ __('Languages') }}</span></a>
                        </li>
                    @endcan --}}

                </ul>
            </nav>
        </div>
    </div>
</div>
