<?php //49c3670164c82a41005b66c3166f7f63
/** @noinspection all */

namespace Modules\JobPost\Entities {

    use App\Category;
    use App\Country;
    use App\Order;
    use App\ServiceCity;
    use App\Subcategory;
    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\App\_IH_Category_QB;
    use LaravelIdea\Helper\App\_IH_Country_QB;
    use LaravelIdea\Helper\App\_IH_Order_C;
    use LaravelIdea\Helper\App\_IH_Order_QB;
    use LaravelIdea\Helper\App\_IH_ServiceCity_QB;
    use LaravelIdea\Helper\App\_IH_Subcategory_QB;
    use LaravelIdea\Helper\App\_IH_User_QB;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_BuyerJob_C;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_BuyerJob_QB;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_JobRequestConversation_C;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_JobRequestConversation_QB;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_JobRequest_C;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_JobRequest_QB;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_SellerViewJob_C;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_SellerViewJob_QB;
    
    /**
     * @property int $id
     * @property int $category_id
     * @property int $subcategory_id
     * @property int $buyer_id
     * @property int $country_id
     * @property int $city_id
     * @property string $title
     * @property string $slug
     * @property string $description
     * @property string|null $image
     * @property int $status
     * @property int $is_job_on
     * @property int $is_job_online
     * @property float $price
     * @property int $view
     * @property Carbon|null $dead_line
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $buyer
     * @method BelongsTo|_IH_User_QB buyer()
     * @property Category $category
     * @method BelongsTo|_IH_Category_QB category()
     * @property ServiceCity $city
     * @method BelongsTo|_IH_ServiceCity_QB city()
     * @property Country $country
     * @method BelongsTo|_IH_Country_QB country()
     * @property _IH_JobRequest_C|JobRequest[] $job_request
     * @property-read int $job_request_count
     * @method HasMany|_IH_JobRequest_QB job_request()
     * @property _IH_Order_C|Order[] $orders
     * @property-read int $orders_count
     * @method HasMany|_IH_Order_QB orders()
     * @property SellerViewJob $sellerViewJobs
     * @method HasOne|_IH_SellerViewJob_QB sellerViewJobs()
     * @property Subcategory $sub_category
     * @method BelongsTo|_IH_Subcategory_QB sub_category()
     * @method static _IH_BuyerJob_QB onWriteConnection()
     * @method _IH_BuyerJob_QB newQuery()
     * @method static _IH_BuyerJob_QB on(null|string $connection = null)
     * @method static _IH_BuyerJob_QB query()
     * @method static _IH_BuyerJob_QB with(array|string $relations)
     * @method _IH_BuyerJob_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_BuyerJob_C|BuyerJob[] all()
     * @ownLinks category_id,\App\Category,id|subcategory_id,\App\Subcategory,id|country_id,\App\Country,id
     * @mixin _IH_BuyerJob_QB
     */
    class BuyerJob extends Model {}
    
    /**
     * @property int $id
     * @property int $seller_id
     * @property int $buyer_id
     * @property int $job_post_id
     * @property int $is_hired
     * @property float|null $expected_salary
     * @property string|null $cover_letter
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property BuyerJob $job
     * @method BelongsTo|_IH_BuyerJob_QB job()
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @method static _IH_JobRequest_QB onWriteConnection()
     * @method _IH_JobRequest_QB newQuery()
     * @method static _IH_JobRequest_QB on(null|string $connection = null)
     * @method static _IH_JobRequest_QB query()
     * @method static _IH_JobRequest_QB with(array|string $relations)
     * @method _IH_JobRequest_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_JobRequest_C|JobRequest[] all()
     * @foreignLinks id,\Modules\JobPost\Entities\JobRequestConversation,job_request_id
     * @mixin _IH_JobRequest_QB
     */
    class JobRequest extends Model {}
    
    /**
     * @property int $id
     * @property string|null $message
     * @property string|null $notify
     * @property string|null $attachment
     * @property string|null $type
     * @property int|null $job_request_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_JobRequestConversation_QB onWriteConnection()
     * @method _IH_JobRequestConversation_QB newQuery()
     * @method static _IH_JobRequestConversation_QB on(null|string $connection = null)
     * @method static _IH_JobRequestConversation_QB query()
     * @method static _IH_JobRequestConversation_QB with(array|string $relations)
     * @method _IH_JobRequestConversation_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_JobRequestConversation_C|JobRequestConversation[] all()
     * @ownLinks job_request_id,\Modules\JobPost\Entities\JobRequest,id
     * @mixin _IH_JobRequestConversation_QB
     */
    class JobRequestConversation extends Model {}
    
    /**
     * @property int $id
     * @property int $job_post_id
     * @property int $seller_id
     * @property int|null $country_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_SellerViewJob_QB onWriteConnection()
     * @method _IH_SellerViewJob_QB newQuery()
     * @method static _IH_SellerViewJob_QB on(null|string $connection = null)
     * @method static _IH_SellerViewJob_QB query()
     * @method static _IH_SellerViewJob_QB with(array|string $relations)
     * @method _IH_SellerViewJob_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SellerViewJob_C|SellerViewJob[] all()
     * @ownLinks country_id,\App\Country,id
     * @mixin _IH_SellerViewJob_QB
     */
    class SellerViewJob extends Model {}
}