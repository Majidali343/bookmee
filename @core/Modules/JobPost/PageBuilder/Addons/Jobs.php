<?php


namespace Modules\JobPost\PageBuilder\Addons;

use App\Category;
use App\ChildCategory;
use App\Country;
use App\JobPost;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\ServiceCity;
use App\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\JobPost\Entities\BuyerJob;
use Modules\JobPost\Entities\JobRequest;
use Str;
use URL;

class Jobs extends \App\PageBuilder\PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'price_plan/price_plan.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);


        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-3' => __('04 Column'),
                'col-lg-4' => __('03 Column'),
                'col-lg-6' => __('02 Column'),
                'col-lg-12' => __('01 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);



        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);
        $output .= Text::get([
            'name' => 'category',
            'label' => __('Category Title Text'),
            'value' => $widget_saved_values['category'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'subcategory',
            'label' => __('Subcategory Title Text'),
            'value' => $widget_saved_values['subcategory'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'child_category',
            'label' => __('Child Category Title Text'),
            'value' => $widget_saved_values['child_category'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'book_now',
            'label' => __('Book Now Text'),
            'value' => $widget_saved_values['book_now'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'read_more',
            'label' => __('View Details Text'),
            'value' => $widget_saved_values['read_more'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'country',
            'label' => __('Country Title Text'),
            'value' => $widget_saved_values['country'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'city',
            'label' => __('City Title Text'),
            'value' => $widget_saved_values['city'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'job_search_by_text',
            'label' => __('Search by Text Title'),
            'value' => $widget_saved_values['job_search_by_text'] ?? null,
        ]);

        // Job filtering option on/off start
        $output .= Switcher::get([
            'name' => 'country_on_off',
            'label' => __('Country'),
            'value' => $widget_saved_values['country_on_off'] ?? null,
            'info' => __('Country wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'city_on_off',
            'label' => __('City'),
            'value' => $widget_saved_values['city_on_off'] ?? null,
            'info' => __('City wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'job_search_by_text_on_off',
            'label' => __('Job search'),
            'value' => $widget_saved_values['job_search_by_text_on_off'] ?? null,
            'info' => __('Job search Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'category_on_off',
            'label' => __('Category'),
            'value' => $widget_saved_values['category_on_off'] ?? null,
            'info' => __('Category wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'subcategory_on_off',
            'label' => __('SubCategory'),
            'value' => $widget_saved_values['subcategory_on_off'] ?? null,
            'info' => __('SubCategory wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'child_category_on_off',
            'label' => __('Child Category'),
            'value' => $widget_saved_values['child_category_on_off'] ?? null,
            'info' => __('Child Category wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'soft_by_price_on_off',
            'label' => __('Sort by Price'),
            'value' => $widget_saved_values['soft_by_price_on_off'] ?? null,
            'info' => __('Sort by Price wise Job Filtering Hide/Show')
        ]);

        $output .= Switcher::get([
            'name' => 'best_match_on_off',
            'label' => __('Best Match'),
            'value' => $widget_saved_values['best_match_on_off'] ?? null,
            'info' => __('Best Match By Job Filtering Hide/Show')
        ]);
        // Job filtering option on/off end


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;

    }

    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $order_by =$settings['order_by'] ?? '';
        $IDorDate =$settings['order'] ?? '';
        $items =$settings['items'] ?? '';
        $columns =$settings['columns'] ?? '';
        $padding_top = $settings['padding_top'] ?? '';
        $padding_bottom = $settings['padding_bottom'] ??  '';

        $category_text = $settings['category'] ??  __('Select Category');
        $subcategory_text = $settings['subcategory'] ??  __('Select Subcategory');
        $child_category_text = $settings['child_category'] ??  __('Select Child Category');
        $country_text = $settings['country'] ??  __('Select Country');
        $city_text = $settings['city'] ?? __('Select City');
        $sort_by_price_title = $settings['sort_by_price_title'] ?? __('Sort By Price');
        $sort_by_best_match_title = $settings['sort_by_best_match_title'] ?? __('Sort By Best Match');
        $search_placeholder = $settings['job_search_by_text'] ??  __('What are you looking for?');

        $book_now_text = $settings['book_now'] ??  __('Apply Now');
        $read_more_text = $settings['read_more'] ??  __('View Details');

        //Job Filtering Hide/Show
        $country_on_off =$settings['country_on_off'] ?? '';
        $city_on_off =$settings['city_on_off'] ?? '';
        $job_search_by_text_on_off =$settings['job_search_by_text_on_off'] ?? '';
        $category_on_off =$settings['category_on_off'] ?? '';
        $subcategory_on_off =$settings['subcategory_on_off'] ?? '';
        $child_category_on_off =$settings['child_category_on_off'] ?? '';
        $sort_price_on_off =$settings['soft_by_price_on_off'] ?? '';
        $sort_by_best_match_on_off =$settings['best_match_on_off'] ?? '';

        $text_search_value = request()->get('q');

        $job_query = BuyerJob::query();
        $current_date = date('Y-m-d h:i:s');

        //search by category
        if(!empty(request()->get('cat_job'))){
            $job_query->where('category_id',request()->get('cat_job'));
        }

        //search by sub category
        if(!empty(request()->get('subcat_job'))){
            $job_query->where('subcategory_id',request()->get('subcat_job'));
        }

        //search by child category
        if(!empty(request()->get('child_cat_job'))){
            $job_query->where('child_category_id',request()->get('child_cat_job'));
        }


        //search by country
        if(!empty(request()->get('country_id'))){
            $job_query->where('country_id',request()->get('country_id'));
        }

        //search by city
        if(!empty(request()->get('city_id'))){
            $job_query->where('city_id',request()->get('city_id'));
        }

        // job title or others text by search
        if (!empty(request()->get('q') )){
            $job_query->Where('title', 'LIKE', '%' . (request()->get('q')) . '%')
                ->orWhere('description', 'LIKE', '%' . (request()->get('q')) . '%');
        }

        //search by asc or desc
        if(!empty(request()->get('sortby_job_ad'))){

            if (request()->get('sortby_job_ad') == 'latest_job') {
                $job_query->orderBy('id', 'Desc');
            }
            if (request()->get('sortby_job_ad') == 'oldest_job') {
                $job_query->orderBy('id', 'Asc');
            }
            if (request()->get('sortby_job_ad') == 'online_job') {
                $job_query->where('is_job_online', 1);
            }
            if (request()->get('sortby_job_ad') == 'offline_job') {
                $job_query->where('is_job_online', 0);
            }
        }

        $sortby_search_ad = [
            'latest_job' => __('Latest Jobs'),
            'oldest_job' => __('Oldest Jobs'),
            'online_job' => __('Online Jobs'),
            'offline_job' => __('Offline Jobs'),
        ];
        $search_by_sort_markup_ad = '<option value=""> '.__('Best Match').'</option>';
        foreach($sortby_search_ad as $value => $text){
            $sortby_selection_ad = !empty(request()->get('sortby_job_ad')) && request()->get('sortby_job_ad') == $value ? 'selected' : '';
            $search_by_sort_markup_ad .= '<option value="'.$value.'" '.$sortby_selection_ad.' > '.$text.'</option>';
        }

        //search by price
        if(!empty(request()->get('sortby_job'))){

            if (request()->get('sortby_job') == 'lowest_price') {
                $job_query->orderBy('price', 'Asc');
            }
            if (request()->get('sortby_job') == 'highest_price') {
                $job_query->orderBy('price', 'Desc');
            }

        }

        $sortby_search = [
            'lowest_price' => __('Lowest Price'),
            'highest_price' => __('Highest Price'),
        ];
        $search_by_sort_markup = '<option value=""> '.__('Sort By Price').'</option>';
        foreach($sortby_search as $value => $text){
            $sortby_selection = !empty(request()->get('sortby_job')) && request()->get('sortby_job') == $value ? 'selected' : '';
            $search_by_sort_markup .= '<option value="'.$value.'" '.$sortby_selection.' > '.$text.'</option>';
        }

        $all_jobs = $job_query->where('status', 1)
            ->where('is_job_on', 1)
            ->where('dead_line', '>=' ,$current_date)
            ->OrderBy($order_by,$IDorDate)
            ->paginate($items);

        $categories = Category::select('id', 'name')->where('status', 1)->get();

        $sub_categories = [];
        if(!empty(request()->get('cat_job'))){
            $sub_categories = Subcategory::select('id', 'name')->where('category_id',request()->get('cat_job'))->where('status', 1)->get();
        }

        $child_categories = [];
        if(!empty(request()->get('subcat_job'))){
            $sub_category_id = request()->get('subcat_job');
            $child_categories = ChildCategory::select('id', 'name')->where('status', 1)->where('sub_category_id',$sub_category_id)->get();
        }

        $countries = Country::select('id', 'country')->where('status', 1)->get();

        $cities = [];
        if(!empty(request()->get('country_id'))){
            $cities = ServiceCity::select('id', 'service_city')->where('country_id',request()->get('country_id'))->where('status', 1)->get();
        }

        $job_markup ='';
        $category_markup ='';
        $sub_category_markup ='';
        $child_category_markup ='';
        $country_markup ='';
        $city_markup ='';
        $apply_markup ='';
        $pagination = $all_jobs->links();
        $no_job_found = __('No Jobs Found');

        if($all_jobs->total() > 0){

            foreach ($all_jobs as $job)
            {
                $image =  render_background_image_markup_by_attachment_id($job->image,'','','thumb');
                $title =  $job->title;
                $slug =  $job->slug;
                $route = route('job.post.details',$slug);
               $buyer_about_route = route('about.buyer.profile',optional($job->buyer)->username);
                $description =  Str::limit(strip_tags($job->description),100);
                $price =  amount_with_currency_symbol($job->price);
                $buyer_image =  render_image_markup_by_attachment_id(optional($job->buyer)->image,'','','thumb');
                $buyer_name =  optional($job->buyer)->name;
                $job_country =  optional($job->country)->country;
                $job_city =  optional($job->city)->service_city;
                if($job_country){
                    $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' '.$job_country .' , '. $job_city .'</span>';
                }else{
                    $job_location = '<span class="single_location" style="color:#fff"><i class="las la-map-marker-alt"></i>' .' Online'.'</span>';
                }

                $is_job_hired = $job->job_request->where('is_hired',1)->count() ?? 0;
                $hired = __('Already Hired');

                if($is_job_hired >= 1){
                    $apply = '<a href="javascript:void(0)" class="btn btn-danger w-100" disabled>'.$hired.'</a>';
                }else{
                    $apply = '<a href="'.$route.'" class="cmn-btn btn-small btn-bg-1 w-100">'.$book_now_text.' </a>';
                }
                $stating_at = __('Starting at');
                $job_markup.= <<<JOBS
                <div class="{$columns} col-md-6 margin-top-30">
                      <div class="single-service no-margin wow fadeInUp" data-wow-delay=".2s">
                        <a href="$route" class="service-thumb">
                            <div class="service-thumb service-bg-thumb-format" {$image}></div>
                            <div class="country_city_location">
                                {$job_location}
                            </div>
                        </a>
                        <div class="services-contents">
                            <ul class="author-tag">
                                <li class="tag-list">
                                    <a href="#">
                                        <div class="authors">
                                         <a href="{$buyer_about_route}">
                                            <div class="thumb">
                                                {$buyer_image}
                                                <span class="notification-dot"></span>
                                            </div>
                                            </a>
                                           <a href="{$buyer_about_route}"><span class="author-title">{$buyer_name}</span> </a>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <h5 class="common-title"> <a href="$route"> {$title} </a> </h5>
                            <p class="common-para">{$description}</p>
                            <div class="service-price">
                                <span class="starting"> {$stating_at} </span>
                                <span class="prices">{$price}</span>
                            </div>
                            <div class="btn-wrapper d-flex flex-wrap">
                                {$apply}
                            </div>
                        </div>
                    </div>
                </div>
            JOBS;
            }
        }else{
            $job_markup.= <<<JOBS
                <div class="col-lg-12 margin-top-30">
                   <h5 class="common-title text-center text-danger"> {$no_job_found}</h5>
                </div>
            JOBS;
        }

        foreach ($categories as $cat) {
            $category = $cat->name;
            $category_id = $cat->id;
            $selected = !empty(request()->get('cat_job')) && request()->get('cat_job') ==  $cat->id ? 'selected' : '';
            $category_markup.= <<<CATEGORIES
                <option {$selected} value="{$category_id}">{$category}</option>
            CATEGORIES;
        }

        foreach ($sub_categories as $sub_cat) {
            $sub_category = $sub_cat->name;
            $sub_category_id = $sub_cat->id;
            $selected = !empty(request()->get('subcat_job')) && request()->get('subcat_job') ==  $sub_cat->id ? 'selected' : '';
            $sub_category_markup.= <<<SUBCATEGORIES
                <option {$selected}  value="{$sub_category_id}">{$sub_category}</option>
            SUBCATEGORIES;
        }


        foreach ($child_categories as $child_cat) {

            $child_category = $child_cat->name;
            $child_category_id = $child_cat->id;
            $selected = !empty(request()->get('child_cat_job')) && request()->get('child_cat_job') ==  $child_cat->id ? 'selected' : '';
            $child_category_markup.= <<<CHILDCATEGORIES
                <option {$selected}  value="{$child_category_id}">{$child_category}</option>
            CHILDCATEGORIES;
        }

        foreach ($countries as $country) {
            $service_country = $country->country;
            $country_id = $country->id;
            $selected = !empty(request()->get('country_id')) && request()->get('country_id') ==  $country->id ? 'selected' : '';
            $country_markup.= <<<COUNTRIES
                <option {$selected} value="{$country_id}">{$service_country}</option>
            COUNTRIES;
        }
        foreach ($cities as $city) {
            $service_city = $city->service_city;
            $city_id = $city->id;
            $selected = !empty(request()->get('city_id')) && request()->get('city_id') ==  $city->id ? 'selected' : '';
            $city_markup.= <<<CITIES
                <option {$selected} value="{$city_id}">{$service_city}</option>
            CITIES;
        }

  // category, sub category ,child category, country, city, area , text search show/hide
        $country_on_off_markup = '';
        $city_on_off_markup = '';
        $job_search_on_off_markup = '';
        $category_on_off_markup = '';
        $subcategory_on_off_markup = '';
        $child_category_on_off_markup = '';
        $sort_price_on_off_markup = '';
        $sort_by_best_price_on_off_markup = '';

        if (!empty($country_on_off)){
            $country_on_off_markup.=<<<COUNTRYONOFF
        <div class="col-lg-3 col-sm-6">
            <div class="single-category-service">
                <div class="single-select">
                    <select id="search_by_country_job" name="country_id">
                      <option value="">{$country_text}</option>
                      $country_markup
                    </select>
                </div>
            </div>
        </div>
    COUNTRYONOFF;
        }

        if (!empty($city_on_off)){
            $fetch_cities = '';
            if($country_on_off !== 'on'){
                $all_cities = ServiceCity::where("status" ,1)->get();
                foreach ($all_cities as $cities){
                    $fetch_cities .= '<option value='.$cities->id.'>'.$cities->service_city.'</option>';
                }
            }
            $city_on_off_markup.=<<<CITYONOFF
         <div class="col-lg-3 col-sm-6">
            <div class="single-category-service">
                <div class="single-select">
                    <select id="search_by_city_job" name="city_id">
                      <option value="">{$city_text}</option>
                      $city_markup
                    </select>
                </div>
            </div>
        </div>
    CITYONOFF;
        }

        if (!empty($job_search_by_text_on_off)){
            $job_search_on_off_markup.=<<<SERVICESEARCHONOFF
         <div class="col-lg-3 col-sm-6">
                    <div class="single-category-service">
                        <div class="single-select">       
                           <input type="text" class="search-input form-control" id="search_by_query" placeholder="{$search_placeholder}" name="q" value="{$text_search_value}">        
                        </div>
                    </div>
                </div>
    SERVICESEARCHONOFF;
        }

        if (!empty($category_on_off)){
            $category_on_off_markup.=<<<CATEGORYONOFF
           <div class="col-lg-3 col-sm-6">
                <div class="single-category-service">
                    <div class="single-select">
                        <select id="search_by_category_job" name="cat_job">
                          <option value="">{$category_text}</option>
                          $category_markup
                        </select>
                    </div>
                </div>
            </div>
    CATEGORYONOFF;
        }

        if (!empty($subcategory_on_off)){
            $subcategory_on_off_markup.=<<<SUBCATEGORYONOFF
          <div class="col-lg-3 col-sm-6">
            <div class="single-category-service">
                <div class="single-select">
                    <select id="search_by_subcategory_job" name="subcat_job">
                      <option value=""> {$subcategory_text}</option>
                       $sub_category_markup
                    </select>
                </div>
            </div>
        </div>
    SUBCATEGORYONOFF;
        }

        if (!empty($child_category_on_off)){
            $child_category_on_off_markup.=<<<CHILDCATEGORYONOFF
           <div class="col-lg-3 col-sm-6">
            <div class="single-category-service">
                <div class="single-select">
                    <select id="search_by_child_category_job" name="child_cat_job">
                      <option value=""> {$child_category_text}</option>
                       $child_category_markup
                    </select>
                </div>
            </div>
        </div>
    CHILDCATEGORYONOFF;
        }

        if (!empty($sort_price_on_off)){
            $sort_price_on_off_markup.=<<<RATINSTARGONOFF
          <div class="col-lg-3 col-sm-6">
            <div class="single-category-service flex-category-service">
                <div class="single-select">
                    <select id="search_by_sorting_job" name="sortby_job">                
                        {$search_by_sort_markup}
                    </select>
                </div>
            </div>
        </div>
        RATINSTARGONOFF;
        }
        if (!empty($sort_by_best_match_on_off)){
            $sort_by_best_price_on_off_markup.=<<<RATINSTARGONOFF
               <div class="col-lg-3 col-sm-6">
                <div class="single-category-service">
                    <div class="single-select">
                        <select id="search_by_job_ad" name="sortby_job_ad">                       
                            {$search_by_sort_markup_ad}
                        </select>
                    </div>
                </div>
            </div>
        RATINSTARGONOFF;
        }

        $current_page_url = URL::current();
        return <<<HTML
            <!-- Category jobs area starts -->
            <section class="category-services-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
                <div class="container">
                    <form method="get" action="{$current_page_url}" id="search_job_list_form">   
                       <div class="row">  
                            {$country_on_off_markup}               
                            {$city_on_off_markup}     
                            {$job_search_on_off_markup} 
                            {$category_on_off_markup} 
                            {$subcategory_on_off_markup} 
                            {$child_category_on_off_markup} 
                            {$sort_price_on_off_markup} 
                            {$sort_by_best_price_on_off_markup}
                        </div>  
                     </form>        
                    <div class="row margin-top-20" id="all_search_result_job">
                        {$job_markup}
                        <div class="col-lg-12">
                            <div class="blog-pagination margin-top-55">
                                <div class="custom-pagination mt-4 mt-lg-5">
                                    {$pagination}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        HTML;
    }

    public function addon_title()
    {
        return __('Jobs');
    }
}


