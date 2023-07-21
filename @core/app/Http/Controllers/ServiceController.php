<?php

namespace App\Http\Controllers;

use App\Category;
use App\ChildCategory;
use App\EditServiceHistory;
use App\Helpers\DataTableHelpers\General;
use App\Helpers\FlashMsg;
use App\Mail\BasicMail;
use App\OnlineServiceFaq;
use App\Service;
use App\Serviceadditional;
use App\Servicebenifit;
use App\ServiceCoupon;
use App\Serviceinclude;
use App\Subcategory;
use App\Tax;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-list|service-status|service-delete|service-view', ['only' => ['index']]);
        $this->middleware('permission:service-status', ['only' => ['change_status']]);
        $this->middleware('permission:service-delete', ['only' => ['delete_service', 'bulk_action']]);
        $this->middleware('permission:service-view', ['only' => ['viewServiceDetails']]);
        $this->middleware('permission:service-book-setting', ['only' => ['service_book_settings']]);
        $this->middleware('permission:service-detail-setting', ['only' => ['service_details_settings']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Service::select('*')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return General::bulkCheckbox($row->id);
                })
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('title', function ($row) {
                    return $row->title;
                })
                ->addColumn('price', function ($row) {
                    return float_amount_with_currency_symbol($row->price);
                })
                ->addColumn('status', function ($row) {
                    return General::serviceStatusSpan($row->status);
                })
                ->addColumn('create_date', function ($row) {
                    return date_format($row->created_at, 'd-M-Y');
                })
                ->addColumn('featured', function ($row) {
                    $row->featured == 1 ? $featured = __('Yes') : $featured = __('No');
                    return $featured;
                })
                ->addColumn('action', function ($row) {
                    $action = '';
                    $admin = auth()->guard('admin')->user();

                    // if seller account delete then message show start
                    if (empty(optional(optional($row->seller)->account_status)->account_status) || optional(optional($row->seller)->account_status)->account_status == 0) {
                        if ($admin->can('service-status')) {
                            $action .= General::statusChange(route('admin.service.status', $row->id));
                        }
                        if ($admin->can('service-view')) {
                            $action .= General::viewIcon(route('admin.service.view.details', $row->id));
                        }
                        if ($admin->can('service-delete')) {
                            $action .= General::deletePopover(route('admin.service.delete', $row->id));
                        }
                        if ($admin->can('service-featured')) {
                            $action .= General::featuredService(route('admin.service.featured', $row->id), $row->featured);
                        }
                        if ($admin->can('service-history')) {
                            $action .= General::EditServiceHistory(route('edit.service.history.list', $row->id));
                        }
                    } else {
//                        $action .= 'Your account has been deleted';
                        $action .= General::deleteSellerAccount();
                    }

                    return $action;
                })
                ->rawColumns(['checkbox', 'status', 'action'])
                ->make(true);
        }
        return view('backend.pages.services.index');
    }

    public function viewServiceDetails($id)
    {
        $service = Service::with('serviceInclude', 'serviceAdditional', 'serviceBenifit')->where('id', $id)->first();
        $service_includes = Serviceinclude::where('service_id', $id)->get();
        $service_additionals = Serviceadditional::where('service_id', $id)->get();
        $service_benifits = Servicebenifit::where('service_id', $id)->get();
        $service_faqs = OnlineServiceFaq::where('service_id', $id)->get();
        $seller_since = User::select('created_at')->where('id', $service->seller_id)->where('user_status', 1)->first();
        return view('backend.pages.services.service-details', compact(
            'service',
            'service_includes',
            'service_additionals',
            'service_benifits',
            'service_faqs',
            'seller_since'
        ));
    }

    public function change_status($id)
    {
        $service = Service::select('id', 'seller_id', 'status')->where('id', $id)->first();
        $service->status == 1 ? $status = 0 : $status = 1;
        Service::where('id', $id)->update(['status' => $status]);
        $service_seller_email = optional($service->seller)->email;
        $service_seller_name = optional($service->seller)->name;
        $service_status = Service::select('status')->where('id', $id)->first();
        if ($service_status->status == 1) {
            try {
                $message = get_static_option('admin_service_approve_message') ?? '';
                $message = str_replace(["@name"], [$service_seller_name], $message);
                Mail::to($service_seller_email)->send(new BasicMail([
                    'subject' => __('Service Approve Success'),
                    'message' => $message,
                ]));
            } catch (\Exception $e) {
                return redirect()->back()->with(FlashMsg::item_new($e->getMessage()));
            }
        }
        return redirect()->back()->with(FlashMsg::item_new(__('Status Change Success')));
    }

    public function tax_update(Request $request)
    {
        Service::where('id', $request->service_id)->update(['tax' => $request->tax]);
        return redirect()->back()->with(FlashMsg::item_new(__('Tax Update Success')));
    }

    public function bulk_action(Request $request)
    {
        Service::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }

    public function delete_service($id)
    {
        Serviceinclude::where('service_id', $id)->delete();
        Serviceadditional::where('service_id', $id)->delete();
        Servicebenifit::where('service_id', $id)->delete();
        OnlineServiceFaq::where('service_id', $id)->delete();
        Service::find($id)->delete();

        return redirect()->back()->with(FlashMsg::item_new(__('Service Deleted Success')));
    }

    public function service_featured($id)
    {
        $service = Service::select('featured')->where('id', $id)->first();
        $service->featured == 1 ? $featured = 0 : $featured = 1;
        Service::where('id', $id)->update(['featured' => $featured]);
        return redirect()->back()->with(FlashMsg::item_new(__('Status Change Success')));
    }

    public function service_coupons(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'code' => 'required|max:191|unique:service_coupons',
                'discount' => 'required|numeric',
                'discount_type' => 'required',
                'expire_date' => 'required',
            ]);
            ServiceCoupon::create([
                'code' => str_replace(' ', '', $request->code),
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'expire_date' => $request->expire_date,
                'status' => 1,
                'seller_id' => null,
                'user_type' => 'admin',

            ]);
            return redirect()->back()->with(FlashMsg::item_new(__('Coupon Added Success')));
        }
        $coupons = ServiceCoupon::where('user_type', 'admin')->latest()->get();
        return view('backend.pages.services.service-coupons', compact('coupons'));
    }

    public function edit_coupon(Request $request)
    {
        $request->validate([
            'up_code' => 'required|max:191|unique:service_coupons,code,' . $request->up_id,
            'up_discount' => 'required|numeric',
            'up_discount_type' => 'required|max:191',
            'up_expire_date' => 'required',
        ]);

        ServiceCoupon::where('id', $request->up_id)->update([
            'code' => str_replace(' ', '', $request->up_code),
            'discount' => $request->up_discount,
            'discount_type' => $request->up_discount_type,
            'expire_date' => $request->up_expire_date,
            'seller_id' => null,
            'user_type' => 'admin', 
        ]);
        return redirect()->back()->with(FlashMsg::item_new(__('Coupon Updated Success')));
    }

    public function add_services_coupon(Request $request)
    {
        $request->validate([
            'up_id_' => 'required|max:191',
        ]);
        ServiceCoupon::where('id', $request->up_id_)->get()->first()->update(['services_ids' => $request->services_ids]);
        return redirect()->back()->with(FlashMsg::item_new(__('Coupon Updated Success')));
    }

    public function change_coupon_status($id = null)
    {
        $status = ServiceCoupon::select('status')->where('id', $id)->first();
        if ($status->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        ServiceCoupon::where('id', $id)->update([
            'status' => $status,
        ]);
        return redirect()->back()->with(FlashMsg::item_new(__('Coupon Status Change Success')));
    }

    public function delete_coupon($id = null)
    {
        ServiceCoupon::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(__('Coupon Deleted Success')));
    }

    public function service_book_settings()
    {
        return view('backend.pages.services.service-book-settings');
    }

    public function service_book_settings_update(Request $request)
    {
        $this->validate($request, [
            'service_main_attribute_title' => 'nullable|string',
            'service_additional_attribute_title' => 'nullable|string',
            'service_benifits_title' => 'nullable|string',
            'service_booking_title' => 'nullable|string',
            'service_appoinment_package_title' => 'nullable|string',
            'service_package_fee_title' => 'nullable|string',
            'service_extra_title' => 'nullable|string',
            'service_subtotal_title' => 'nullable|string',
            'service_total_amount_title' => 'nullable|string',
            'service_available_date_title' => 'nullable|string',
            'service_available_schudule_title' => 'nullable|string',
            'service_booking_information_title' => 'nullable|string',
            'terms_and_conditions_link' => 'nullable|string',
            'service_order_confirm_title' => 'nullable|string',
        ]);

        $all_fields = [
            'service_main_attribute_title',
            'service_additional_attribute_title',
            'service_benifits_title',
            'service_booking_title',
            'service_appoinment_package_title',
            'service_package_fee_title',
            'service_extra_title',
            'service_subtotal_title',
            'service_total_amount_title',
            'service_available_date_title',
            'service_available_schudule_title',
            'service_booking_information_title',
            'terms_and_conditions_link',
            'service_order_confirm_title',
        ];
        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function service_details_settings()
    {
        return view('backend.pages.services.service-details-settings');
    }

    public function service_details_settings_update(Request $request)
    {
        $this->validate($request, [
            'service_details_overview_title' => 'nullable|string',
            'service_details_about_seller_title' => 'nullable|string',
            'service_details_review_title' => 'nullable|string',
            'service_details_what_you_get' => 'nullable|string',
            'service_details_benifits_title' => 'nullable|string',
            'service_details_another_service_title' => 'nullable|string',
            'service_details_explore_all_title' => 'nullable|string',
            'service_details_package_title' => 'nullable|string',
            'service_details_package_subtitle' => 'nullable|string',
            'service_details_button_title' => 'nullable|string',
            'service_reviews_title' => 'nullable|string',
            'service_post_reviews_title' => 'nullable|string',
        ]);

        $all_fields = [
            'service_details_overview_title',
            'service_details_about_seller_title',
            'service_details_review_title',
            'service_details_what_you_get',
            'service_details_benifits_title',
            'service_details_another_service_title',
            'service_details_explore_all_title',
            'service_details_package_title',
            'service_details_package_subtitle',
            'service_details_button_title',
            'service_reviews_title',
            'service_post_reviews_title',
        ];
        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function login_register_settings()
    {
        return view('backend.pages.services.login-register-settings');
    }

    public function login_register_settings_update(Request $request)
    {
        $this->validate($request, [
            'login_form_title' => 'nullable|string',
            'register_page_title' => 'nullable|string',
            'register_seller_title' => 'nullable|string',
            'register_buyer_title' => 'nullable|string',
            'select_terms_condition_page' => 'nullable|string',
        ]);

        $all_fields = [
            'login_form_title',
            'register_page_title',
            'register_seller_title',
            'register_buyer_title',
            'select_terms_condition_page',
        ];
        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(FlashMsg::settings_update());
    }

    public function service_create_settings()
    {
        return view('backend.pages.services.service-create-settings');
    }

    public function service_create_settings_update(Request $request)
    {
        update_static_option('service_create_settings', $request->service_create_settings);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));

    }

    public function order_create_settings()
    {
        return view('backend.pages.services.order-create-settings');
    }

    public function order_create_settings_update(Request $request)
    {
        update_static_option('order_create_settings', $request->order_create_settings);
        return redirect()->back()->with(FlashMsg::item_new('Update Success'));

    }

    public function add_new_service(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
                'title' => 'required|max:191|unique:services',
                'description' => 'required|min:150',
                'slug' => 'required',
                'seller_id' => 'required',
            ]);

            $seller_country = User::select('id', 'service_city', 'country_id', 'email')->where('id', $request->seller_id)->first();
            $country_tax = Tax::select('tax')->where('country_id', $seller_country->country_id)->first();

            $service = new Service();
            $service->category_id = $request->category;
            $service->subcategory_id = $request->subcategory;
            $service->child_category_id = $request->child_category;
            $service->title = $request->title;
            $service->slug = $request->slug;
            $service->description = $request->description;
            $service->image = $request->image;
            $service->image_gallery = $request->image_gallery;
            $service->video = $request->video;
            $service->seller_id = $request->seller_id;
            $service->service_city_id = $seller_country->service_city;
            $service->status = 1;
            $service->tax = $country_tax->tax ?? 0;
            $service->admin_id = Auth::guard('admin')->user()->id;
            $service->guard_name = 'admin';

            $Metas = [
                'meta_title' => purify_html($request->meta_title),
                'meta_tags' => purify_html($request->meta_tags),
                'meta_description' => purify_html($request->meta_description),

                'facebook_meta_tags' => purify_html($request->facebook_meta_tags),
                'facebook_meta_description' => purify_html($request->facebook_meta_description),
                'facebook_meta_image' => $request->facebook_meta_image,

                'twitter_meta_tags' => purify_html($request->twitter_meta_tags),
                'twitter_meta_description' => purify_html($request->twitter_meta_description),
                'twitter_meta_image' => $request->twitter_meta_image,
            ];
            $service->save();
            $last_service_id = DB::getPdo()->lastInsertId();
            $service->metaData()->create($Metas);

            try {
                $message = get_static_option('admin_service_assign_message') ?? '';
                $message = str_replace(["@service_id"], [$last_service_id], $message);
                Mail::to(get_static_option($seller_country->email))->send(new BasicMail([
                    'subject' => get_static_option('admin_service_assign_subject') ?? __('Service Assign By Admin'),
                    'message' => $message,
                ]));
            } catch (\Exception $e) {
                //
            }
//            return redirect()->back()->with(FlashMsg::item_new('Service Added Success'));
            return redirect()->route('admin.add.service.attributes');
        }

        $categories = Category::where('status', 1)->get();
        $sub_categories = Subcategory::all();
        $sellers = user::select('id', 'name')->where('user_type', 0)->get();
        return view('backend.pages.services.admin-service.add_new_service', compact('categories', 'sub_categories', 'sellers'));
    }

    public function edit_service(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
                'title' => 'required|max:191|unique:services,id,' . $id,
                'description' => 'required|min:150',
                'seller_id' => 'required',
            ]);

            $seller_country = User::select('id', 'service_city', 'country_id', 'email')->where('id', $request->seller_id)->first();
            $country_tax = Tax::select('tax')->where('country_id', $seller_country->country_id)->first();

            $old_image = Service::select('image', 'image_gallery')->where('id', $id)->first();
            $old_slug = Service::select('slug')->where('id', $id)->first();

            Service::where('id', $id)->update([
                'category_id' => $request->category,
                'subcategory_id' => $request->subcategory,
                'child_category_id' => $request->child_category,
                'title' => $request->title,
                'slug' => $request->slug ?? $old_slug->slug,
                'description' => $request->description,
                'seller_id' => $request->seller_id,
                'service_city_id' => $seller_country->service_city,
                'image' => $request->image ?? $old_image->image,
                'image_gallery' => $request->image_gallery ?? $old_image->image_gallery,
                'video' => $request->video,
                'tax' => $country_tax->tax ?? 0,
            ]);

            $service_meta_update = Service::findOrFail($id);
            $Metas = [
                'meta_title' => purify_html($request->meta_title),
                'meta_tags' => $request->meta_tags,
                'meta_description' => purify_html($request->meta_description),

                'facebook_meta_tags' => purify_html($request->facebook_meta_tags),
                'facebook_meta_description' => purify_html($request->facebook_meta_description),
                'facebook_meta_image' => $request->facebook_meta_image,

                'twitter_meta_tags' => purify_html($request->twitter_meta_tags),
                'twitter_meta_description' => purify_html($request->twitter_meta_description),
                'twitter_meta_image' => $request->twitter_meta_image,
            ];

            DB::beginTransaction();

            try {
                $service_meta_update->metaData()->update($Metas);
                DB::commit();

            } catch (\Throwable $th) {
                DB::rollBack();
            }
            return redirect()->route('admin.all.services')->with(FlashMsg::item_new('Service Updated Success'));
        }

        $service = Service::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $sub_categories = Subcategory::all();
        $sellers = user::select('id', 'name')->where('user_type', 0)->get();
        return view('backend.pages.services.admin-service.edit_service', compact('service', 'categories', 'sub_categories', 'sellers'));

    }

    public function add_service_attributes(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (isset($data['is_service_online_id'])) {
                if ($data['is_service_online_id'] == 1) {
                    $request->validate(
                        [
                            'include_service_title.*' => 'required|max:191',
                            'online_service_price' => 'required|integer',
                            'delivery_days' => 'required|integer',
                            'revision' => 'required|integer',
                            'benifits.*' => 'max:191',
                            'faqs_title.*' => 'max:191',
                            'additional_service_title.*' => 'max:191',
                        ],
                        [
                            'include_service_title.*.required' => __('Title is required'),
                        ]
                    );
                }
            } else {
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'include_service_price.*' => 'required|numeric',
                        'include_service_quantity.*' => 'required|numeric',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                        'include_service_price.*.required' => __('Price is required'),
                        'include_service_price.*.numeric' => __('Price must be a number'),
                        'include_service_quantity.*.required' => __('Quantity is required'),
                        'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                    ]
                );
            }

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;

            if (isset($data['is_service_online_id'])) {
                Service::where('id', $request->service_id)->update([
                    'price' => $data['online_service_price'],
                    'delivery_days' => $data['delivery_days'],
                    'revision' => $data['revision'],
                    'is_service_online' => 1,
                ]);

                if ($data['is_service_online_id'] == 1) {
                    if (isset($data['include_service_title'])) {
                        foreach ($data['include_service_title'] as $key => $value) {
                            $all_include_service[] = [
                                'service_id' => $request->service_id,
                                'seller_id' => $request->seller_id,
                                'include_service_title' => $data['include_service_title'][$key],
                                'include_service_price' => 0,
                                'include_service_quantity' => 0,
                            ];
                        }
                    }
                    Serviceinclude::insert($all_include_service);
                }
            } else {
                if (isset($data['include_service_title'])) {
                    foreach ($data['include_service_title'] as $key => $value) {
                        $all_include_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $request->seller_id,
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => $data['include_service_price'][$key],
                            'include_service_quantity' => $data['include_service_quantity'][$key],
                        ];
                        $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                    }
                }
                Serviceinclude::insert($all_include_service);
                Service::where('id', $request->service_id)->update(['price' => $service_total_price]);
            }

            if (isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    if (!empty($data['additional_service_title'][$key])) {
                        $all_additional_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $request->seller_id,
                            'additional_service_title' => $data['additional_service_title'][$key],
                            'additional_service_price' => $data['additional_service_price'][$key],
                            'additional_service_quantity' => $data['additional_service_quantity'][$key],
                            'additional_service_image' => $data['image'][$key],
                        ];
                    }
                }
            }
            Serviceadditional::insert($all_additional_service);

            if (isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $all_benifits_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $request->seller_id,
                            'benifits' => $data['benifits'][$key],
                        ];
                    }
                }
            }
            Servicebenifit::insert($all_benifits_service);

            if (isset($data['faqs_title'])) {
                foreach ($data['faqs_title'] as $key => $value) {
                    if (!empty($data['faqs_title'][$key])) {
                        $online_service_faqs[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $request->seller_id,
                            'title' => $data['faqs_title'][$key],
                            'description' => $data['faqs_description'][$key],
                        ];
                    }
                }
            }
            OnlineServiceFaq::insert($online_service_faqs);
            return redirect()->route('admin.all.services')->with(FlashMsg::item_new('Service Attributes Added Success'));
        }
        $latest_service = Service::orderBy('id', 'Desc')->first();
        return view('backend.pages.services.admin-service.add_service_attributes', compact('latest_service'));
    }

    public function add_service_attributes_by_id(Request $request, $id = null)
    {

        $get_service = Service::where('id', $id)->first();
        if ($request->isMethod('post')) {
            if ($request['is_service_online_id'] == 1) {
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'additional_service_title.*' => 'max:191',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                    ]
                );
            } else {
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'include_service_price.*' => 'required|numeric',
                        'include_service_quantity.*' => 'required|numeric',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                        'include_service_price.*.required' => __('Price is required'),
                        'include_service_price.*.numeric' => __('Price must be a number'),
                        'include_service_quantity.*.required' => __('Quantity is required'),
                        'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                    ]
                );
            }

            $data = $request->all();
            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;

            if (isset($data['is_service_online_id'])) {
                if ($data['is_service_online_id'] == 1) {
                    if (isset($data['include_service_title'])) {
                        foreach ($data['include_service_title'] as $key => $value) {
                            if (!empty($data['include_service_title'][$key])) {
                                $all_include_service[] = [
                                    'service_id' => $request->service_id,
                                    'seller_id' => $get_service->seller_id,
                                    'include_service_title' => $data['include_service_title'][$key],
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0,
                                ];
                                $service_count++;
                            }
                        }
                    }
                }
            } else {
                if (isset($data['include_service_title'])) {
                    foreach ($data['include_service_title'] as $key => $value) {
                        if (!empty($data['include_service_title'][$key])) {
                            $all_include_service[] = [
                                'service_id' => $request->service_id,
                                'seller_id' => $get_service->seller_id,
                                'include_service_title' => $data['include_service_title'][$key],
                                'include_service_price' => $data['include_service_price'][$key],
                                'include_service_quantity' => $data['include_service_quantity'][$key],
                            ];
                            $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                            $service_count++;
                        }
                    }
                }
            }

            if ($service_count >= 1) {
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id', $id)->select('price')->first();
                $service_total_price_with_new_added_attribute = ($service_old_price->price + $service_total_price);
                Service::where('id', $request->service_id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if (isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    if (!empty($data['additional_service_title'][$key])) {
                        $all_additional_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'additional_service_title' => $data['additional_service_title'][$key],
                            'additional_service_price' => $data['additional_service_price'][$key],
                            'additional_service_quantity' => $data['additional_service_quantity'][$key],
                            'additional_service_image' => $data['image'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if ($service_count >= 1) {
                Serviceadditional::insert($all_additional_service);
            }

            if (isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $all_benifits_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'benifits' => $data['benifits'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if ($service_count >= 1) {
                Servicebenifit::insert($all_benifits_service);
            }

            if (isset($data['faqs_title'])) {
                foreach ($data['faqs_title'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $online_service_faqs[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'title' => $data['faqs_title'][$key],
                            'description' => $data['faqs_description'][$key],
                        ];
                        $service_count++;
                    }
                }
            }
            if ($service_count >= 1) {
                OnlineServiceFaq::insert($online_service_faqs);
            }

            if ($service_count <= 0) {
                return redirect()->back()->with(FlashMsg::item_new('Service attributes field is required'));
            }
            return redirect()->back()->with(FlashMsg::item_new('Service Attributes Added Success'));
        }
        if ($get_service != '') {
            return view('backend.pages.services.admin-service.add_service_attributes_by_id', compact('get_service'));
        } else {
            abort(404);
        }

    }

    public function edit_service_attributes_by_id(Request $request, $id = null)
    {
        // update
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (isset($data['is_service_online_id'])) {
                if ($data['is_service_online_id'] == 1) {
                    $request->validate([
                        'include_service_title.*' => 'required|max:191',
                        'online_service_price' => 'required|integer',
                        'delivery_days' => 'required|integer',
                        'revision' => 'required|integer',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                        [
                            'include_service_title.*.required' => __('Title is required'),
                        ]);
                }
            } else {
                $request->validate(
                    [
                        'include_service_title.*' => 'required|max:191',
                        'include_service_price.*' => 'required|numeric',
                        'include_service_quantity.*' => 'required|numeric',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ],
                    [
                        'include_service_title.*.required' => __('Title is required'),
                        'include_service_price.*.required' => __('Price is required'),
                        'include_service_price.*.numeric' => __('Price must be a number'),
                        'include_service_quantity.*.required' => __('Quantity is required'),
                        'include_service_quantity.*.numeric' => __('Quantity must be a number'),
                    ]
                );
            }

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $service_total_price = 0;

            $x = [
                'include' => [],
            ];

            if (isset($data['is_service_online_id'])) {
                if ($data['is_service_online_id'] == 1) {
                    Service::where('id', $id)->update([
                        'price' => $data['online_service_price'],
                        'delivery_days' => $data['delivery_days'],
                        'revision' => $data['revision'],
                    ]);
                    if (isset($data['include_service_title'])) {
                        foreach ($data['include_service_title'] as $key => $value) {
                            Serviceinclude::where('id', $data['service_include_id'][$key])->update([
                                'include_service_title' => $data['include_service_title'][$key],
                                'include_service_price' => 0,
                                'include_service_quantity' => 0,
                            ]);
                        }
                    }
                }
            } else {
                if (isset($data['include_service_title'])) {
                    foreach ($data['include_service_title'] as $key => $value) {
                        Serviceinclude::where('id', $data['service_include_id'][$key])->update([
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => $data['include_service_price'][$key],
                            'include_service_quantity' => $data['include_service_quantity'][$key],
                        ]);
                        $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                    }
                    Service::where('id', $id)->update(['price' => $service_total_price]);
                }
            }

            if (isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    $old_image = Serviceadditional::select('additional_service_image')->where('id', $data['service_additional_id'][$key])->first();

                    Serviceadditional::where('id', $data['service_additional_id'][$key])->update([
                        'additional_service_title' => $data['additional_service_title'][$key],
                        'additional_service_price' => $data['additional_service_price'][$key],
                        'additional_service_quantity' => $data['additional_service_quantity'][$key],
                        'additional_service_image' => $data['image'][$key],
                        'additional_service_image' => $data['image'][$key] ?? $old_image->additional_service_image,
                    ]);
                }
            }

            if (isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    Servicebenifit::where('id', $data['service_benifit_id'][$key])->update([
                        'benifits' => $data['benifits'][$key],
                    ]);
                }
            }

            if (isset($data['faqs_title'])) {
                foreach ($data['faqs_title'] as $key => $value) {
                    OnlineServiceFaq::where('id', $data['online_service_faq_id'][$key])->update([
                        'title' => $data['faqs_title'][$key],
                        'description' => $data['faqs_description'][$key],
                    ]);
                }
            }
            return redirect()->route('admin.all.services')->with(FlashMsg::item_new('Service Attributes Updated Success'));
        }

        $service = Service::findOrFail($id);
        if ($service != '') {
            $service_includes = ServiceInclude::where('service_id', $id)->get();
            $service_additionals = ServiceAdditional::where('service_id', $id)->get();
            $service_benifits = ServiceBenifit::where('service_id', $id)->get();
            $online_service_faq = OnlineServiceFaq::where('service_id', $id)->get();
            return view('backend.pages.services.admin-service.edit_service_attributes_by_id', compact(
                'service',
                'service_includes',
                'service_additionals',
                'service_benifits',
                'online_service_faq',
            ));
        } else {
            abort(404);
        }

    }

    // Edit Service Attribute Offline and Online
    public function editServiceAttributeOfflineAndOnline(Request $request, $id = null)
    {
        $get_service = Service::where('id', $id)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;

            if (isset($data['is_service_online_id'])) {
                if ($data['is_service_online_id'] == 1) {
                    $this->validate($request, [
                        'online_service_price' => 'required',
                        'delivery_days' => 'required',
                        'benifits.*' => 'max:191',
                        'faqs_title.*' => 'max:191',
                        'include_service_title.*' => 'max:191',
                        'additional_service_title.*' => 'max:191',
                    ]);

                    // delete old service data
                    Serviceinclude::where('service_id', $id)->delete();
                    Serviceadditional::where('service_id', $id)->delete();
                    Servicebenifit::where('service_id', $id)->delete();

                    // new online service data update
                    Service::where('id', $id)->update([
                        'price' => $data['online_service_price'],
                        'delivery_days' => $data['delivery_days'],
                        'revision' => $data['revision'],
                    ]);

                    // online service include data add
                    if (isset($data['include_service_title'])) {
                        foreach ($data['include_service_title'] as $key => $value) {
                            if (!empty($data['include_service_title'][$key])) {
                                $all_include_service[] = [
                                    'service_id' => $request->service_id,
                                    'seller_id' => $get_service->seller_id,
                                    'include_service_title' => $data['include_service_title'][$key],
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0,
                                ];
                                $service_count++;
                            }
                        }
                    }

                }
            }

            // offline service add
            if ($data['is_service_online_id'] == 0) {
                // delete old service data
                Serviceinclude::where('service_id', $id)->delete();
                Serviceadditional::where('service_id', $id)->delete();
                Servicebenifit::where('service_id', $id)->delete();

                foreach ($data['include_service_title'] as $key => $value) {
                    if (!empty($data['include_service_title'][$key])) {
                        $all_include_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'include_service_title' => $data['include_service_title'][$key],
                            'include_service_price' => $data['include_service_price'][$key],
                            'include_service_quantity' => $data['include_service_quantity'][$key],
                        ];
                        $service_total_price += $data['include_service_price'][$key] * $data['include_service_quantity'][$key];
                        $service_count++;
                    }
                }
            }

            if ($data['is_service_online_id'] == 0) {
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id', $id)->select('price')->first();
                $service_total_price_with_new_added_attribute = $service_total_price;
                Service::where('id', $request->service_id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if (isset($data['additional_service_title'])) {
                foreach ($data['additional_service_title'] as $key => $value) {
                    if (!empty($data['additional_service_title'][$key])) {
                        $all_additional_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'additional_service_title' => $data['additional_service_title'][$key],
                            'additional_service_price' => $data['additional_service_price'][$key],
                            'additional_service_quantity' => $data['additional_service_quantity'][$key],
                            'additional_service_image' => $data['image'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if ($service_count >= 1) {
                Serviceadditional::insert($all_additional_service);
            }

            if (isset($data['benifits'])) {
                foreach ($data['benifits'] as $key => $value) {
                    if (!empty($data['benifits'][$key])) {
                        $all_benifits_service[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'benifits' => $data['benifits'][$key],
                        ];
                        $service_count++;
                    }
                }
            }

            if ($service_count >= 1) {
                Servicebenifit::insert($all_benifits_service);
            }

            if (isset($data['faqs_title'])) {
                foreach ($data['faqs_title'] as $key => $value) {
                    if (!empty($data['faqs_title'][$key])) {
                        $online_service_faqs[] = [
                            'service_id' => $request->service_id,
                            'seller_id' => $get_service->seller_id,
                            'title' => $data['faqs_title'][$key],
                            'description' => $data['faqs_description'][$key],
                        ];
                        $service_count++;
                    }
                }
            }
            if ($service_count >= 1) {
                OnlineServiceFaq::insert($online_service_faqs);
            }

            // update offline to online service is_service_online value 0 to change 1 6060
            if ($data['is_service_online_id'] == 1) {
                Service::where('id', $id)->update([
                    'is_service_online' => 1,
                ]);
            }

            //update online to offline service is_service_online value 1 to change 0
            if ($data['is_service_online_id'] == 0) {
                OnlineServiceFaq::where('service_id', $id)->delete();
                Service::where('id', $id)->update([
                    'is_service_online' => 0,
                    'delivery_days' => 0,
                    'revision' => 0,
                    'online_service_price' => 0,
                ]);
            }

            if ($service_count <= 0) {
                return redirect()->back()->with(FlashMsg::error('Service attributes field is required'));
            }
            return redirect()->route('admin.edit.service.attributes.by.id', $id)->with(FlashMsg::item_new('Service Attributes Update Success'));
        }
        if ($get_service != '') {
            return view('backend.pages.services.admin-service.edit_service_attributes_offline_and_online_by_id', compact('get_service'));
        } else {
            abort(404);
        }

    }

    public function show_service_attributes_by_id($id = null)
    {
        $service = Service::select('id', 'title', 'image')
            ->where('id', $id)
            ->first();

        if (!empty($service)) {
            $include_service = Serviceinclude::where('service_id', $id)->get();
            $additional_service = Serviceadditional::where('service_id', $id)->get();
            $service_benifit = Servicebenifit::where('service_id', $id)->get();
            $service_faqs = OnlineServiceFaq::where('service_id', $id)->get();
            return view('backend.pages.services.admin-service.show_service_attributes_by_id', compact(
                'service', 'include_service', 'additional_service', 'service_benifit', 'service_faqs'
            ));
        }
        abort(404);
    }

    public function delete_include_service($id = null)
    {
        $include_details = Serviceinclude::find($id);

        //todo udpate service price
        $service_details = Service::where('id', $include_details->service_id)->first();
        $service_details->price -= $include_details->include_service_price * $include_details->include_service_quantity;
        $service_details->save();

        $include_details->delete();

        return redirect()->back()->with(FlashMsg::item_new('Include Service Delete Success'));
    }

    public function delete_additional_service($id = null)
    {
        Serviceadditional::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new('Additional Service Delete Success'));
    }

    public function delete_service_benifit($id = null)
    {
        Servicebenifit::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Benefits Delete Success'));
    }

    public function delete_service_faq($id = null)
    {
        OnlineServiceFaq::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Faq Delete Success'));
    }

    public function admin_services()
    {
        $services = Service::where('guard_name', 'admin')->get();
        return view('backend.pages.services.admin-service.all_service', compact('services'));
    }

    public function get_sub_category(Request $request)
    {
        $sub_categories = Subcategory::where('category_id', $request->category_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'sub_categories' => $sub_categories,
        ]);
    }

    public function get_child_category(Request $request)
    {
        $child_categories = ChildCategory::where('sub_category_id', $request->sub_cat_id)->where('status', 1)->get();

        return response()->json([
            'status' => 'success',
            'child_category' => $child_categories,
        ]);
    }

    public function service_history($id)
    {
        $service_histories = EditServiceHistory::where('service_id', $id)->get();
        return view('backend.pages.services.service-history', compact('service_histories'));

    }

}
