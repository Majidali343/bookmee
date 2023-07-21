<?php

namespace App\Http\Controllers\Api;

use App\Actions\Media\MediaHelper;
use App\Category;
use App\ChildCategory;
use App\EditServiceHistory;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\OnlineServiceFaq;
use App\Service;
use App\Serviceadditional;
use App\Servicebenifit;
use App\Serviceinclude;
use App\Subcategory;
use App\Tax;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SellerServiceController extends Controller
{
    public function myService()
    {
        $services = Service::select(['id','title','image','price','is_service_online','view','is_service_on'])
            ->with('reviews_for_mobile')
            ->withCount('reviews','pendingOrder','completeOrder','cancelOrder')
            ->where('seller_id', Auth::guard('sanctum')->user()->id)
            ->latest()->paginate(10)
            ->withQueryString();

        if(!empty($services)){
            $service_image=[];
            foreach($services as $service){
                $service_image[]= get_attachment_image_by_id($service->image);
            }
            return response()->success([
                'my_services'=> $services,
                'service_image'=> $service_image,
            ]);
        }else{
            return response()->error([
                'my_services' => __('No service found'),
            ]);
        }
    }

    public function subCategoryByCategory($category)
    {
        if($category){
            $sub_category = Subcategory::where('category_id',$category)->get();
            return response()->success([
                'sub_category' => $sub_category,
            ]);
        }else{
            return response()->error([
                'message' => __('Category not found'),
            ]);
        }
    }

    public function childCategoryBySubcategory($sub_category)
    {
        if($sub_category){
            $child_category = ChildCategory::where('sub_category_id',$sub_category)->get();
            return response()->success([
                'child_category' => $child_category,
            ]);
        }else{
            return response()->error([
                'message' => __('Subcategory not found'),
            ]);
        }
    }
    
     public function ServiceOnOff($id)
    {
        $is_service_on = Service::select('is_service_on')->where('id', $id)->first();
        if ($is_service_on->is_service_on == 1) {
            $is_service_on = 0;
            Service::where('id', $id)->update(['is_service_on' => $is_service_on]);
            return response()->success(['msg'=> __('Service Off Successfully.')]);
        } else {
            $is_service_on = 1;
            Service::where('id', $id)->update(['is_service_on' => $is_service_on]);
            return response()->success(['msg'=> __('Service On Successfully.')]);
        }
    }

    public function addService(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'required',
                'title' => 'required|max:191|unique:services',
                'description' => 'required|min:150',
            ]);
            
            $seller_country = User::select(['id','country_id'])->where('country_id',Auth::guard('sanctum')->user()->country_id)->first();
            $country_tax = Tax::select('tax')->where('country_id',$seller_country->country_id)->first();

            if($request->file('image')){
                MediaHelper::insert_media_image($request,'web','image');
                $image_id = DB::getPdo()->lastInsertId();
            }
            
            if($request->file('image_gallery')){
                MediaHelper::insert_media_image($request,'web','image_gallery');
                $image_id = DB::getPdo()->lastInsertId();
            }

            $service = new Service();
            $service->category_id = $request->category_id;
            $service->subcategory_id = $request->subcategory_id;
            $service->child_category_id = $request->child_category_id;
            $service->title = $request->title;
            $service->slug = createSlug($request->title, "service");
            $service->description = $request->description;
            $service->image = $image_id;
            $service->video = $request->video;
            $service->seller_id = Auth::guard('sanctum')->user()->id;
            $service->service_city_id = Auth::guard('sanctum')->user()->service_city;
            $service->status = 0;
            $service->tax = $country_tax->tax ?? 0;
            $service->is_service_all_cities = $request->is_service_all_cities ?? 0;

            $Metas = [
                'meta_title'=> purify_html($request->meta_title),
                'meta_tags'=> purify_html($request->meta_tags),
                'meta_description'=> purify_html($request->meta_description),

                'facebook_meta_tags'=> purify_html($request->facebook_meta_tags),
                'facebook_meta_description'=> purify_html($request->facebook_meta_description),
                'facebook_meta_image'=> $request->facebook_meta_image,

                'twitter_meta_tags'=> purify_html($request->twitter_meta_tags),
                'twitter_meta_description'=> purify_html($request->twitter_meta_description),
                'twitter_meta_image'=> $request->twitter_meta_image,
            ];
            $service->save();
            $last_service_id = DB::getPdo()->lastInsertId();
            $service->metaData()->create($Metas);

            try {
                $message = get_static_option('service_approve_message');
                $message = str_replace(["@service_id"],[$last_service_id],$message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' =>get_static_option('service_approve_subject') ?? __('New Service Approve Request'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
                //
            }

            return response()->success(['msg'=> __('Service Successfully Add'), "id" => $last_service_id]);
        }
    }
    
    public function updateService(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
                'title' => 'required|max:191|unique:services,id,'.$request->service_id,
                'description' => 'required|min:150',
            ]);

            $seller_country = User::select(['id','country_id'])->where('country_id',Auth::guard('sanctum')->user()->country_id)->first();
            $country_tax = Tax::select('tax')->where('country_id',$seller_country->country_id)->first();

            $old_image = Service::select(['image','image_gallery'])->where('id',$request->service_id)->first();
            $old_slug = Service::select('slug')->where('id',$request->service_id)->first();

            if($request->file('image')){
                MediaHelper::insert_media_image($request,'web','image');
                $image_id = DB::getPdo()->lastInsertId();
            }
            if($request->file('image_gallery')){
                MediaHelper::insert_media_image($request,'web','image_gallery');
                $image_id = DB::getPdo()->lastInsertId();
            }

            Service::where('id', $request->service_id)->update([
                'category_id' => $request->category,
                'subcategory_id' => $request->subcategory,
                'child_category_id' => $request->child_category,
                'title' => $request->title,
                'slug' => $request->slug ?? $old_slug->slug,
                'description' => $request->description,
                'image' => $image_id ?? $old_image->image,
                'image_gallery' => $image_id ?? $old_image->image_gallery,
                'video' => $request->video,
                'tax' => $country_tax->tax ?? 0,
                'status' => 0,
                'is_service_all_cities' => $request->is_service_all_cities,
            ]);

            $service_meta_update =  Service::findOrFail($request->service_id);
            $Metas = [
                'meta_title'=> purify_html($request->meta_title),
                'meta_tags'=> $request->meta_tags,
                'meta_description'=> purify_html($request->meta_description),

                'facebook_meta_tags'=> purify_html($request->facebook_meta_tags),
                'facebook_meta_description'=> purify_html($request->facebook_meta_description),
                'facebook_meta_image'=> $request->facebook_meta_image,

                'twitter_meta_tags'=> purify_html($request->twitter_meta_tags),
                'twitter_meta_description'=> purify_html($request->twitter_meta_description),
                'twitter_meta_image'=> $request->twitter_meta_image,
            ];

            DB::beginTransaction();

            try {
                $service_meta_update->metaData()->update($Metas);
                DB::commit();
            }catch (\Throwable $th){
                DB::rollBack();
            }

            EditServiceHistory::create([
                'service_id' => $request->service_id,
                'seller_id' => Auth::guard('sanctum')->user()->id,
                'service_title' => $request->title,
                'service_description' => $request->description,
            ]);

            return response()->success([
                'message'=> __('Service updated success'),
            ]);
        }
    }

    public function addServiceAttributesByID(Request $request,$id=null)
    {
        $get_service = Service::where('id',$id)->where('seller_id',Auth::guard('sanctum')->user()->id)->first();

        if($request->isMethod('post')) {
            $data = $request->all();

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;
            $new_include_services = [];
            $new_additional_services = [];
            $new_benifits_services = [];


            if(isset($data['is_service_online_id'])){
                if($data['is_service_online_id'] == 1){
                    if(isset($data['all_include_service'])){
                        $new_include_services = json_decode($data['all_include_service']);
                        foreach ($new_include_services as  $value) {
                            foreach ($value as $service){
                                $all_include_service[] = (array) $service +
                                    [
                                        'seller_id' => Auth::guard('sanctum')->user()->id,
                                        'include_service_price' => 0,
                                        'include_service_quantity' => 0
                                    ];
                                $service_count++;
                            }
                        }
                    }
                }
            }else{
                if(isset($data['all_include_service'])){
                    $new_include_services = json_decode($data['all_include_service']);
                    foreach ($new_include_services as  $value) {
                        foreach ($value as $service){
                            $service = (array) $service;
                            $all_include_service[] = $service +
                                [
                                    'seller_id' => Auth::guard('sanctum')->user()->id,
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0
                                ];
                            $service_total_price += $service['include_service_price'] * $service['include_service_quantity'];
                            $service_count++;
                        }
                    }
                }
            }
            if($service_count>=1){
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id',$id)->select('price')->first();
                $service_total_price_with_new_added_attribute =($service_old_price->price + $service_total_price);
                Service::where('id', $id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if(isset($data['all_additional_service'])) {
                $new_additional_services = json_decode($data['all_additional_service']);
                foreach ($new_additional_services as $value) {
                    foreach ($value as $service){
                        $all_additional_service[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'additional_service_price' => 0,
                                'additional_service_quantity' => 0
                            ];
                        $service_count++;
                    }
                }
            }
            if($service_count>=1){
                Serviceadditional::insert($all_additional_service);
            }

            if(isset($data['service_benifits'])) {
                $new_benifits = json_decode($data['service_benifits']);
                foreach ($new_benifits as $value) {
                    foreach ($value as $service){
                        $all_benifits_service[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'benifits' => 0,
                            ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Servicebenifit::insert($all_benifits_service);
            }

            if(isset($data['online_service_faqs'])){
                $new_faqs_services = json_decode($data['online_service_faqs']);
                foreach ($new_faqs_services as $value) {
                    foreach ($value as $service){
                        $online_service_faqs[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'title' => '',
                                'description' => '',
                            ];
                        $service_count++;
                    }
                }
            }
            if($service_count>=1){
                OnlineServiceFaq::insert($online_service_faqs);
            }

            if($service_count <= 0){
                return response()->error([
                    'message'=>__('Please input service attributes.')
                ]);
            }
            return response()->success([
                'message'=>__('Service attributes added success.')
            ]);
        }

        if($get_service !=''){
            return response()->error([
                'message'=>__('Service not found.')
            ]);
        }

    }

    public function updateServiceAttributesByID(Request $request,$id=null)
    {
        $get_service = Service::where('id',$id)->where('seller_id',Auth::guard('sanctum')->user()->id)->first();

        if($request->isMethod('post')) {
            $data = $request->all();

            $all_include_service = [];
            $all_additional_service = [];
            $all_benifits_service = [];
            $online_service_faqs = [];
            $service_total_price = 0;
            $service_total_price_with_new_added_attribute = 0;
            $service_count = 0;
            $new_include_services = [];
            $new_additional_services = [];
            $new_benifits_services = [];


            if(isset($data['is_service_online_id'])){
                if($data['is_service_online_id'] == 1){
                    if(isset($data['all_include_service'])){
                        $new_include_services = json_decode($data['all_include_service']);
                        foreach ($new_include_services as  $value) {
                            foreach ($value as $service){
                                $all_include_service[] = (array) $service +
                                    [
                                        'seller_id' => Auth::guard('sanctum')->user()->id,
                                        'include_service_price' => 0,
                                        'include_service_quantity' => 0
                                    ];
                                $service_count++;
                            }
                        }
                    }
                }
            }else{
                if(isset($data['all_include_service'])){
                    $new_include_services = json_decode($data['all_include_service']);
                    foreach ($new_include_services as  $value) {
                        foreach ($value as $service){
                            $service = (array) $service;
                            $all_include_service[] = $service +
                                [
                                    'seller_id' => Auth::guard('sanctum')->user()->id,
                                    'include_service_price' => 0,
                                    'include_service_quantity' => 0
                                ];
                            $service_total_price += $service['include_service_price'] * $service['include_service_quantity'];
                            $service_count++;
                        }
                    }
                }
            }
            
            if($service_count>=1){
                Serviceinclude::where("service_id", $get_service->id)->delete();
                Serviceinclude::insert($all_include_service);
                $service_old_price = Service::where('id',$id)->select('price')->first();
                $service_total_price_with_new_added_attribute =($service_old_price->price + $service_total_price);
                Service::where('id', $id)->update(['price' => $service_total_price_with_new_added_attribute]);
            }

            if(isset($data['all_additional_service'])) {
                $new_additional_services = json_decode($data['all_additional_service']);
                foreach ($new_additional_services as $value) {
                    foreach ($value as $service){
                        $all_additional_service[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'additional_service_price' => 0,
                                'additional_service_quantity' => 0
                            ];
                        $service_count++;
                    }
                }
            }
            
            if($service_count>=1){
                Serviceadditional::where("service_id", $get_service->id)->delete();
                Serviceadditional::insert($all_additional_service);
            }

            if(isset($data['service_benifits'])) {
                $new_benifits = json_decode($data['service_benifits']);
                foreach ($new_benifits as $value) {
                    foreach ($value as $service){
                        $all_benifits_service[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'benifits' => 0,
                            ];
                        $service_count++;
                    }
                }
            }

            if($service_count>=1){
                Servicebenifit::where("service_id", $get_service->id)->delete();
                Servicebenifit::insert($all_benifits_service);
            }

            if(isset($data['online_service_faqs'])){
                $new_faqs_services = json_decode($data['online_service_faqs']);
                foreach ($new_faqs_services as $value) {
                    foreach ($value as $service){
                        $online_service_faqs[] = (array) $service +
                            [
                                'seller_id' => Auth::guard('sanctum')->user()->id,
                                'title' => '',
                                'description' => '',
                            ];
                        $service_count++;
                    }
                }
            }
            if($service_count>=1){
                OnlineServiceFaq::where("service_id", $get_service->id)->delete();
                OnlineServiceFaq::insert($online_service_faqs);
            }

            if($service_count <= 0){
                return response()->error([
                    'message'=>__('Please input service attributes.')
                ]);
            }
            return response()->success([
                'message'=>__('Service attributes updated success.')
            ]);
        }

        if($get_service !=''){
            return response()->error([
                'message'=>__('Service not found.')
            ]);
        }

    }
    
    public function showAttributes($id=null)
    {
        $seller_id = Auth::guard('sanctum')->user()->id;
        $service = Service::select(['id','title','image'])
            ->where('id',$id)
            ->where('seller_id',$seller_id)
            ->first();

        if(!empty($service)){
            $include_service = Serviceinclude::where('service_id',$id)->get();
            $additional_service = Serviceadditional::where('service_id',$id)->get();
            $service_benifit = Servicebenifit::where('service_id',$id)->get();
            return response()->success([
                'include_services'=>$include_service,
                'additional_service'=>$additional_service,
                'service_benifit'=>$service_benifit,
            ]);
        }
    }
    
    public function deleteIncludeService($id = null)
    {
        $include_details = Serviceinclude::find($id);

        //todo udpate service price
        $service_details = Service::where('id',$include_details->service_id)->first();
        $service_details->price -= $include_details->include_service_price * $include_details->include_service_quantity;
        $service_details->save();
        $include_details->delete();
        return response()->success([
            'message'=>__('Include Service Delete Success.')
        ]);
    }
    
    public function deleteAdditionalService($id = null)
    {
        Serviceadditional::find($id)->delete();
        return response()->success([
            'message'=>__('Additional Service Delete Success.')
        ]);
    }
    
        public function deleteBenefits($id = null)
    {
        Servicebenifit::find($id)->delete();
        return response()->success([
            'message'=>__('Service Benefit Delete Success')
        ]);
    }

    public function deleteService($id = null)
    {
        Serviceinclude::where('service_id',$id)->delete();
        Serviceadditional::where('service_id',$id)->delete();
        Servicebenifit::where('service_id',$id)->delete();
        OnlineServiceFaq::where('service_id',$id)->delete();
        Service::find($id)->delete();
        return response()->success([
            'message'=>__('Service Delete Success'),
        ]);
    }
}
