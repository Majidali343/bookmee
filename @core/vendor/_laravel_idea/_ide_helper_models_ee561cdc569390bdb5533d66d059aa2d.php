<?php //1aff0b9e2e72ad10567d00cf43066db4
/** @noinspection all */

namespace App {

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\Relations\MorphTo;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\App\_IH_Accountdeactive_C;
    use LaravelIdea\Helper\App\_IH_Accountdeactive_QB;
    use LaravelIdea\Helper\App\_IH_AdminCommission_C;
    use LaravelIdea\Helper\App\_IH_AdminCommission_QB;
    use LaravelIdea\Helper\App\_IH_AdminRole_C;
    use LaravelIdea\Helper\App\_IH_AdminRole_QB;
    use LaravelIdea\Helper\App\_IH_Admin_C;
    use LaravelIdea\Helper\App\_IH_Admin_QB;
    use LaravelIdea\Helper\App\_IH_AmountSettings_C;
    use LaravelIdea\Helper\App\_IH_AmountSettings_QB;
    use LaravelIdea\Helper\App\_IH_BlogComment_C;
    use LaravelIdea\Helper\App\_IH_BlogComment_QB;
    use LaravelIdea\Helper\App\_IH_Blog_C;
    use LaravelIdea\Helper\App\_IH_Blog_QB;
    use LaravelIdea\Helper\App\_IH_Brand_C;
    use LaravelIdea\Helper\App\_IH_Brand_QB;
    use LaravelIdea\Helper\App\_IH_Category_C;
    use LaravelIdea\Helper\App\_IH_Category_QB;
    use LaravelIdea\Helper\App\_IH_Country_C;
    use LaravelIdea\Helper\App\_IH_Country_QB;
    use LaravelIdea\Helper\App\_IH_DateTime_C;
    use LaravelIdea\Helper\App\_IH_DateTime_QB;
    use LaravelIdea\Helper\App\_IH_Day_C;
    use LaravelIdea\Helper\App\_IH_Day_QB;
    use LaravelIdea\Helper\App\_IH_ExtraService_C;
    use LaravelIdea\Helper\App\_IH_ExtraService_QB;
    use LaravelIdea\Helper\App\_IH_FormBuilder_C;
    use LaravelIdea\Helper\App\_IH_FormBuilder_QB;
    use LaravelIdea\Helper\App\_IH_GalleryCategory_C;
    use LaravelIdea\Helper\App\_IH_GalleryCategory_QB;
    use LaravelIdea\Helper\App\_IH_HeaderSlider_C;
    use LaravelIdea\Helper\App\_IH_HeaderSlider_QB;
    use LaravelIdea\Helper\App\_IH_Language_C;
    use LaravelIdea\Helper\App\_IH_Language_QB;
    use LaravelIdea\Helper\App\_IH_Location_C;
    use LaravelIdea\Helper\App\_IH_Location_QB;
    use LaravelIdea\Helper\App\_IH_MediaUpload_C;
    use LaravelIdea\Helper\App\_IH_MediaUpload_QB;
    use LaravelIdea\Helper\App\_IH_Menu_C;
    use LaravelIdea\Helper\App\_IH_Menu_QB;
    use LaravelIdea\Helper\App\_IH_MetaData_C;
    use LaravelIdea\Helper\App\_IH_MetaData_QB;
    use LaravelIdea\Helper\App\_IH_OnlineServiceFaq_C;
    use LaravelIdea\Helper\App\_IH_OnlineServiceFaq_QB;
    use LaravelIdea\Helper\App\_IH_OrderAdditional_C;
    use LaravelIdea\Helper\App\_IH_OrderAdditional_QB;
    use LaravelIdea\Helper\App\_IH_OrderInclude_C;
    use LaravelIdea\Helper\App\_IH_OrderInclude_QB;
    use LaravelIdea\Helper\App\_IH_Order_C;
    use LaravelIdea\Helper\App\_IH_Order_QB;
    use LaravelIdea\Helper\App\_IH_PageBuilder_C;
    use LaravelIdea\Helper\App\_IH_PageBuilder_QB;
    use LaravelIdea\Helper\App\_IH_Page_C;
    use LaravelIdea\Helper\App\_IH_Page_QB;
    use LaravelIdea\Helper\App\_IH_PayoutRequest_C;
    use LaravelIdea\Helper\App\_IH_PayoutRequest_QB;
    use LaravelIdea\Helper\App\_IH_Report_C;
    use LaravelIdea\Helper\App\_IH_Report_QB;
    use LaravelIdea\Helper\App\_IH_Review_C;
    use LaravelIdea\Helper\App\_IH_Review_QB;
    use LaravelIdea\Helper\App\_IH_Schedule_C;
    use LaravelIdea\Helper\App\_IH_Schedule_QB;
    use LaravelIdea\Helper\App\_IH_SellerVerify_C;
    use LaravelIdea\Helper\App\_IH_SellerVerify_QB;
    use LaravelIdea\Helper\App\_IH_Serviceadditional_C;
    use LaravelIdea\Helper\App\_IH_Serviceadditional_QB;
    use LaravelIdea\Helper\App\_IH_ServiceArea_C;
    use LaravelIdea\Helper\App\_IH_ServiceArea_QB;
    use LaravelIdea\Helper\App\_IH_Serviceattribute_C;
    use LaravelIdea\Helper\App\_IH_Serviceattribute_QB;
    use LaravelIdea\Helper\App\_IH_Servicebenifit_C;
    use LaravelIdea\Helper\App\_IH_Servicebenifit_QB;
    use LaravelIdea\Helper\App\_IH_ServiceCity_C;
    use LaravelIdea\Helper\App\_IH_ServiceCity_QB;
    use LaravelIdea\Helper\App\_IH_ServiceCoupon_C;
    use LaravelIdea\Helper\App\_IH_ServiceCoupon_QB;
    use LaravelIdea\Helper\App\_IH_Serviceinclude_C;
    use LaravelIdea\Helper\App\_IH_Serviceinclude_QB;
    use LaravelIdea\Helper\App\_IH_Service_C;
    use LaravelIdea\Helper\App\_IH_Service_QB;
    use LaravelIdea\Helper\App\_IH_Slider_C;
    use LaravelIdea\Helper\App\_IH_Slider_QB;
    use LaravelIdea\Helper\App\_IH_SocialIcon_C;
    use LaravelIdea\Helper\App\_IH_SocialIcon_QB;
    use LaravelIdea\Helper\App\_IH_StaticOption_C;
    use LaravelIdea\Helper\App\_IH_StaticOption_QB;
    use LaravelIdea\Helper\App\_IH_Subcategory_C;
    use LaravelIdea\Helper\App\_IH_Subcategory_QB;
    use LaravelIdea\Helper\App\_IH_SubCategory_QB;
    use LaravelIdea\Helper\App\_IH_SupportTicketMessage_C;
    use LaravelIdea\Helper\App\_IH_SupportTicketMessage_QB;
    use LaravelIdea\Helper\App\_IH_SupportTicket_C;
    use LaravelIdea\Helper\App\_IH_SupportTicket_QB;
    use LaravelIdea\Helper\App\_IH_Tag_C;
    use LaravelIdea\Helper\App\_IH_Tag_QB;
    use LaravelIdea\Helper\App\_IH_Tax_C;
    use LaravelIdea\Helper\App\_IH_Tax_QB;
    use LaravelIdea\Helper\App\_IH_ToDoList_C;
    use LaravelIdea\Helper\App\_IH_ToDoList_QB;
    use LaravelIdea\Helper\App\_IH_User_C;
    use LaravelIdea\Helper\App\_IH_User_QB;
    use LaravelIdea\Helper\App\_IH_Widgets_C;
    use LaravelIdea\Helper\App\_IH_Widgets_QB;
    use LaravelIdea\Helper\Illuminate\Notifications\_IH_DatabaseNotification_C;
    use LaravelIdea\Helper\Illuminate\Notifications\_IH_DatabaseNotification_QB;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_BuyerJob_C;
    use LaravelIdea\Helper\Modules\JobPost\Entities\_IH_BuyerJob_QB;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SellerSubscription_QB;
    use Modules\JobPost\Entities\BuyerJob;
    use Modules\Subscription\Entities\SellerSubscription;
    
    /**
     * @property int $id
     * @property int $user_id
     * @property string $reason
     * @property string $description
     * @property int|null $status
     * @property int|null $account_status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_Accountdeactive_QB onWriteConnection()
     * @method _IH_Accountdeactive_QB newQuery()
     * @method static _IH_Accountdeactive_QB on(null|string $connection = null)
     * @method static _IH_Accountdeactive_QB query()
     * @method static _IH_Accountdeactive_QB with(array|string $relations)
     * @method _IH_Accountdeactive_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Accountdeactive_C|Accountdeactive[] all()
     * @ownLinks user_id,\App\User,id
     * @mixin _IH_Accountdeactive_QB
     */
    class Accountdeactive extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string $username
     * @property string $email
     * @property int $email_verified
     * @property string $role
     * @property string|null $image
     * @property string $password
     * @property string $status
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $notifications
     * @property-read int $notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB notifications()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $readNotifications
     * @property-read int $read_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB readNotifications()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $unreadNotifications
     * @property-read int $unread_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB unreadNotifications()
     * @method static _IH_Admin_QB onWriteConnection()
     * @method _IH_Admin_QB newQuery()
     * @method static _IH_Admin_QB on(null|string $connection = null)
     * @method static _IH_Admin_QB query()
     * @method static _IH_Admin_QB with(array|string $relations)
     * @method _IH_Admin_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Admin_C|Admin[] all()
     * @foreignLinks id,\App\Service,admin_id|id,\App\SupportTicket,admin_id
     * @mixin _IH_Admin_QB
     */
    class Admin extends Model {}
    
    /**
     * @property int $id
     * @property string|null $system_type
     * @property string|null $commission_charge_from
     * @property string|null $commission_charge_type
     * @property float|null $commission_charge
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_AdminCommission_QB onWriteConnection()
     * @method _IH_AdminCommission_QB newQuery()
     * @method static _IH_AdminCommission_QB on(null|string $connection = null)
     * @method static _IH_AdminCommission_QB query()
     * @method static _IH_AdminCommission_QB with(array|string $relations)
     * @method _IH_AdminCommission_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_AdminCommission_C|AdminCommission[] all()
     * @mixin _IH_AdminCommission_QB
     */
    class AdminCommission extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string $permission
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_AdminRole_QB onWriteConnection()
     * @method _IH_AdminRole_QB newQuery()
     * @method static _IH_AdminRole_QB on(null|string $connection = null)
     * @method static _IH_AdminRole_QB query()
     * @method static _IH_AdminRole_QB with(array|string $relations)
     * @method _IH_AdminRole_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_AdminRole_C|AdminRole[] all()
     * @mixin _IH_AdminRole_QB
     */
    class AdminRole extends Model {}
    
    /**
     * @property int $id
     * @property float|null $min_amount
     * @property float|null $max_amount
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_AmountSettings_QB onWriteConnection()
     * @method _IH_AmountSettings_QB newQuery()
     * @method static _IH_AmountSettings_QB on(null|string $connection = null)
     * @method static _IH_AmountSettings_QB query()
     * @method static _IH_AmountSettings_QB with(array|string $relations)
     * @method _IH_AmountSettings_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_AmountSettings_C|AmountSettings[] all()
     * @mixin _IH_AmountSettings_QB
     */
    class AmountSettings extends Model {}
    
    /**
     * @property int $id
     * @property array $category_id
     * @property int $user_id
     * @property string $title
     * @property string|null $slug
     * @property string $blog_content
     * @property string $image
     * @property string|null $author
     * @property string|null $excerpt
     * @property string|null $views
     * @property string|null $visibility
     * @property string|null $featured
     * @property string|null $schedule_date
     * @property string|null $tag_name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @property string $status
     * @property string|null $tag_id
     * @property Admin $admin
     * @method BelongsTo|_IH_Admin_QB admin()
     * @property Category $category
     * @method BelongsTo|_IH_Category_QB category()
     * @property _IH_BlogComment_C|BlogComment[] $comments
     * @property-read int $comments_count
     * @method HasMany|_IH_BlogComment_QB comments()
     * @property MetaData $meta_data
     * @method MorphToMany|_IH_MetaData_QB meta_data()
     * @property User $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_Blog_QB onWriteConnection()
     * @method _IH_Blog_QB newQuery()
     * @method static _IH_Blog_QB on(null|string $connection = null)
     * @method static _IH_Blog_QB query()
     * @method static _IH_Blog_QB with(array|string $relations)
     * @method _IH_Blog_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Blog_C|Blog[] all()
     * @ownLinks category_id,\App\Category,id|user_id,\App\User,id|tag_id,\App\Tag,id
     * @foreignLinks id,\App\BlogComment,blog_id
     * @mixin _IH_Blog_QB
     */
    class Blog extends Model {}
    
    /**
     * @property int $id
     * @property int $blog_id
     * @property int $user_id
     * @property string $name
     * @property string $email
     * @property string $message
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property int|null $parent_id
     * @property string|null $type
     * @property User $user
     * @method BelongsTo|_IH_User_QB user()
     * @method static _IH_BlogComment_QB onWriteConnection()
     * @method _IH_BlogComment_QB newQuery()
     * @method static _IH_BlogComment_QB on(null|string $connection = null)
     * @method static _IH_BlogComment_QB query()
     * @method static _IH_BlogComment_QB with(array|string $relations)
     * @method _IH_BlogComment_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_BlogComment_C|BlogComment[] all()
     * @ownLinks blog_id,\App\Blog,id|user_id,\App\User,id
     * @mixin _IH_BlogComment_QB
     */
    class BlogComment extends Model {}
    
    /**
     * @property int $id
     * @property string|null $title
     * @property string|null $url
     * @property string|null $image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Brand_QB onWriteConnection()
     * @method _IH_Brand_QB newQuery()
     * @method static _IH_Brand_QB on(null|string $connection = null)
     * @method static _IH_Brand_QB query()
     * @method static _IH_Brand_QB with(array|string $relations)
     * @method _IH_Brand_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Brand_C|Brand[] all()
     * @mixin _IH_Brand_QB
     */
    class Brand extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string|null $slug
     * @property string|null $icon
     * @property string|null $image
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $mobile_icon
     * @property _IH_Service_C|Service[] $services
     * @property-read int $services_count
     * @method HasMany|_IH_Service_QB services()
     * @property _IH_Subcategory_C|Subcategory[] $subcategories
     * @property-read int $subcategories_count
     * @method HasMany|_IH_Subcategory_QB subcategories()
     * @method static _IH_Category_QB onWriteConnection()
     * @method _IH_Category_QB newQuery()
     * @method static _IH_Category_QB on(null|string $connection = null)
     * @method static _IH_Category_QB query()
     * @method static _IH_Category_QB with(array|string $relations)
     * @method _IH_Category_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Category_C|Category[] all()
     * @foreignLinks id,\App\Blog,category_id|id,\App\Subcategory,category_id|id,\App\Service,category_id|id,\Modules\JobPost\Entities\BuyerJob,category_id
     * @mixin _IH_Category_QB
     */
    class Category extends Model {}
    
    /**
     * @property int $id
     * @property string $country
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_ServiceCity_C|ServiceCity[] $cities
     * @property-read int $cities_count
     * @method HasMany|_IH_ServiceCity_QB cities()
     * @property Tax $tax
     * @method BelongsTo|_IH_Tax_QB tax()
     * @method static _IH_Country_QB onWriteConnection()
     * @method _IH_Country_QB newQuery()
     * @method static _IH_Country_QB on(null|string $connection = null)
     * @method static _IH_Country_QB query()
     * @method static _IH_Country_QB with(array|string $relations)
     * @method _IH_Country_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Country_C|Country[] all()
     * @foreignLinks id,\App\User,country_id|id,\App\ServiceCity,country_id|id,\App\ServiceArea,country_id|id,\App\Tax,country_id|id,\Modules\JobPost\Entities\BuyerJob,country_id|id,\Modules\JobPost\Entities\SellerViewJob,country_id
     * @mixin _IH_Country_QB
     */
    class Country extends Model {}
    
    /**
     * @method static _IH_DateTime_QB onWriteConnection()
     * @method _IH_DateTime_QB newQuery()
     * @method static _IH_DateTime_QB on(null|string $connection = null)
     * @method static _IH_DateTime_QB query()
     * @method static _IH_DateTime_QB with(array|string $relations)
     * @method _IH_DateTime_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_DateTime_C|DateTime[] all()
     * @mixin _IH_DateTime_QB
     */
    class DateTime extends Model {}
    
    /**
     * @property int $id
     * @property string $day
     * @property int|null $status
     * @property int $seller_id
     * @property int|null $total_day
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_Schedule_C|Schedule[] $schedules
     * @property-read int $schedules_count
     * @method HasMany|_IH_Schedule_QB schedules()
     * @method static _IH_Day_QB onWriteConnection()
     * @method _IH_Day_QB newQuery()
     * @method static _IH_Day_QB on(null|string $connection = null)
     * @method static _IH_Day_QB query()
     * @method static _IH_Day_QB with(array|string $relations)
     * @method _IH_Day_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Day_C|Day[] all()
     * @foreignLinks id,\App\Schedule,day_id
     * @mixin _IH_Day_QB
     */
    class Day extends Model {}
    
    /**
     * @property int $id
     * @property int $order_id
     * @property string $title
     * @property int $quantity
     * @property float $price
     * @property string|null $payment_gateway
     * @property string|null $manual_payment_gateway_image
     * @property float|null $tax
     * @property float|null $commission_amount
     * @property float|null $sub_total
     * @property float|null $total
     * @property string|null $transaction_id
     * @property string|null $payment_status
     * @property int|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Order $order
     * @method BelongsTo|_IH_Order_QB order()
     * @method static _IH_ExtraService_QB onWriteConnection()
     * @method _IH_ExtraService_QB newQuery()
     * @method static _IH_ExtraService_QB on(null|string $connection = null)
     * @method static _IH_ExtraService_QB query()
     * @method static _IH_ExtraService_QB with(array|string $relations)
     * @method _IH_ExtraService_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ExtraService_C|ExtraService[] all()
     * @ownLinks order_id,\App\Order,id
     * @mixin _IH_ExtraService_QB
     */
    class ExtraService extends Model {}
    
    /**
     * @property int $id
     * @property string|null $title
     * @property string|null $email
     * @property string|null $button_text
     * @property string|null $fields
     * @property string|null $success_message
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_FormBuilder_QB onWriteConnection()
     * @method _IH_FormBuilder_QB newQuery()
     * @method static _IH_FormBuilder_QB on(null|string $connection = null)
     * @method static _IH_FormBuilder_QB query()
     * @method static _IH_FormBuilder_QB with(array|string $relations)
     * @method _IH_FormBuilder_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_FormBuilder_C|FormBuilder[] all()
     * @mixin _IH_FormBuilder_QB
     */
    class FormBuilder extends Model {}
    
    /**
     * @method static _IH_GalleryCategory_QB onWriteConnection()
     * @method _IH_GalleryCategory_QB newQuery()
     * @method static _IH_GalleryCategory_QB on(null|string $connection = null)
     * @method static _IH_GalleryCategory_QB query()
     * @method static _IH_GalleryCategory_QB with(array|string $relations)
     * @method _IH_GalleryCategory_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_GalleryCategory_C|GalleryCategory[] all()
     * @mixin _IH_GalleryCategory_QB
     */
    class GalleryCategory extends Model {}
    
    /**
     * @property int $id
     * @property string|null $title
     * @property string|null $btn_text
     * @property string|null $btn_url
     * @property string|null $btn_status
     * @property string|null $image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_HeaderSlider_QB onWriteConnection()
     * @method _IH_HeaderSlider_QB newQuery()
     * @method static _IH_HeaderSlider_QB on(null|string $connection = null)
     * @method static _IH_HeaderSlider_QB query()
     * @method static _IH_HeaderSlider_QB with(array|string $relations)
     * @method _IH_HeaderSlider_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_HeaderSlider_C|HeaderSlider[] all()
     * @mixin _IH_HeaderSlider_QB
     */
    class HeaderSlider extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string $slug
     * @property string|null $direction
     * @property string|null $status
     * @property int|null $default
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Language_QB onWriteConnection()
     * @method _IH_Language_QB newQuery()
     * @method static _IH_Language_QB on(null|string $connection = null)
     * @method static _IH_Language_QB query()
     * @method static _IH_Language_QB with(array|string $relations)
     * @method _IH_Language_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Language_C|Language[] all()
     * @mixin _IH_Language_QB
     */
    class Language extends Model {}
    
    /**
     * @method static _IH_Location_QB onWriteConnection()
     * @method _IH_Location_QB newQuery()
     * @method static _IH_Location_QB on(null|string $connection = null)
     * @method static _IH_Location_QB query()
     * @method static _IH_Location_QB with(array|string $relations)
     * @method _IH_Location_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Location_C|Location[] all()
     * @mixin _IH_Location_QB
     */
    class Location extends Model {}
    
    /**
     * @property int $id
     * @property string $title
     * @property string $path
     * @property string|null $alt
     * @property string|null $size
     * @property string|null $dimensions
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $type
     * @property int|null $user_id
     * @method static _IH_MediaUpload_QB onWriteConnection()
     * @method _IH_MediaUpload_QB newQuery()
     * @method static _IH_MediaUpload_QB on(null|string $connection = null)
     * @method static _IH_MediaUpload_QB query()
     * @method static _IH_MediaUpload_QB with(array|string $relations)
     * @method _IH_MediaUpload_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_MediaUpload_C|MediaUpload[] all()
     * @ownLinks user_id,\App\User,id
     * @mixin _IH_MediaUpload_QB
     */
    class MediaUpload extends Model {}
    
    /**
     * @property int $id
     * @property string $title
     * @property string|null $content
     * @property string|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Menu_QB onWriteConnection()
     * @method _IH_Menu_QB newQuery()
     * @method static _IH_Menu_QB on(null|string $connection = null)
     * @method static _IH_Menu_QB query()
     * @method static _IH_Menu_QB with(array|string $relations)
     * @method _IH_Menu_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Menu_C|Menu[] all()
     * @mixin _IH_Menu_QB
     */
    class Menu extends Model {}
    
    /**
     * @property int $id
     * @property int $meta_taggable_id
     * @property string $meta_taggable_type
     * @property string|null $meta_title
     * @property string|null $meta_tags
     * @property string|null $meta_description
     * @property string|null $facebook_meta_tags
     * @property string|null $facebook_meta_description
     * @property string|null $facebook_meta_image
     * @property string|null $twitter_meta_tags
     * @property string|null $twitter_meta_description
     * @property string|null $twitter_meta_image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Model $meta_taggable
     * @method MorphTo meta_taggable()
     * @method static _IH_MetaData_QB onWriteConnection()
     * @method _IH_MetaData_QB newQuery()
     * @method static _IH_MetaData_QB on(null|string $connection = null)
     * @method static _IH_MetaData_QB query()
     * @method static _IH_MetaData_QB with(array|string $relations)
     * @method _IH_MetaData_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_MetaData_C|MetaData[] all()
     * @mixin _IH_MetaData_QB
     */
    class MetaData extends Model {}
    
    /**
     * @property int $id
     * @property int|null $service_id
     * @property int|null $seller_id
     * @property string|null $title
     * @property string|null $description
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_OnlineServiceFaq_QB onWriteConnection()
     * @method _IH_OnlineServiceFaq_QB newQuery()
     * @method static _IH_OnlineServiceFaq_QB on(null|string $connection = null)
     * @method static _IH_OnlineServiceFaq_QB query()
     * @method static _IH_OnlineServiceFaq_QB with(array|string $relations)
     * @method _IH_OnlineServiceFaq_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_OnlineServiceFaq_C|OnlineServiceFaq[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_OnlineServiceFaq_QB
     */
    class OnlineServiceFaq extends Model {}
    
    /**
     * @property int $id
     * @property int $service_id
     * @property int $seller_id
     * @property int|null $buyer_id
     * @property string $name
     * @property string $email
     * @property string $phone
     * @property string $post_code
     * @property string $address
     * @property int $city
     * @property int $area
     * @property int $country
     * @property string $date
     * @property string $schedule
     * @property float $package_fee
     * @property float $extra_service
     * @property float $sub_total
     * @property float $tax
     * @property float $total
     * @property string|null $coupon_code
     * @property string|null $coupon_type
     * @property float|null $coupon_amount
     * @property string|null $commission_type
     * @property float|null $commission_charge
     * @property float|null $commission_amount
     * @property string|null $payment_gateway
     * @property string|null $payment_status
     * @property int|null $status
     * @property string|null $transaction_id
     * @property string|null $order_note
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $manual_payment_image
     * @property int $order_complete_request
     * @property int $cancel_order_money_return
     * @property int $is_order_online
     * @property string|null $order_from_job
     * @property int|null $job_post_id
     * @property User|null $buyer
     * @method BelongsTo|_IH_User_QB buyer()
     * @property _IH_ExtraService_C|ExtraService[] $extraSevices
     * @property-read int $extra_sevices_count
     * @method HasMany|_IH_ExtraService_QB extraSevices()
     * @property BuyerJob|null $job
     * @method BelongsTo|_IH_BuyerJob_QB job()
     * @property SupportTicket $online_order_ticket
     * @method HasOne|_IH_SupportTicket_QB online_order_ticket()
     * @property _IH_OrderAdditional_C|OrderAdditional[] $orderAdditionals
     * @property-read int $order_additionals_count
     * @method HasMany|_IH_OrderAdditional_QB orderAdditionals()
     * @property _IH_OrderInclude_C|OrderInclude[] $orderIncludes
     * @property-read int $order_includes_count
     * @method HasMany|_IH_OrderInclude_QB orderIncludes()
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @property Service $service
     * @method BelongsTo|_IH_Service_QB service()
     * @property ServiceArea $service_area
     * @method BelongsTo|_IH_ServiceArea_QB service_area()
     * @property ServiceCity $service_city
     * @method BelongsTo|_IH_ServiceCity_QB service_city()
     * @property Country $service_country
     * @method BelongsTo|_IH_Country_QB service_country()
     * @method static _IH_Order_QB onWriteConnection()
     * @method _IH_Order_QB newQuery()
     * @method static _IH_Order_QB on(null|string $connection = null)
     * @method static _IH_Order_QB query()
     * @method static _IH_Order_QB with(array|string $relations)
     * @method _IH_Order_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Order_C|Order[] all()
     * @ownLinks service_id,\App\Service,id
     * @foreignLinks id,\App\OrderInclude,order_id|id,\App\OrderAdditional,order_id|id,\App\SupportTicket,order_id|id,\App\Report,order_id|id,\App\ExtraService,order_id
     * @mixin _IH_Order_QB
     */
    class Order extends Model {}
    
    /**
     * @property int $id
     * @property int|null $order_id
     * @property string|null $title
     * @property float|null $price
     * @property float|null $quantity
     * @property int|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_OrderAdditional_QB onWriteConnection()
     * @method _IH_OrderAdditional_QB newQuery()
     * @method static _IH_OrderAdditional_QB on(null|string $connection = null)
     * @method static _IH_OrderAdditional_QB query()
     * @method static _IH_OrderAdditional_QB with(array|string $relations)
     * @method _IH_OrderAdditional_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_OrderAdditional_C|OrderAdditional[] all()
     * @ownLinks order_id,\App\Order,id
     * @mixin _IH_OrderAdditional_QB
     */
    class OrderAdditional extends Model {}
    
    /**
     * @property int $id
     * @property int $order_id
     * @property string $title
     * @property float $price
     * @property float $quantity
     * @property int|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_OrderInclude_QB onWriteConnection()
     * @method _IH_OrderInclude_QB newQuery()
     * @method static _IH_OrderInclude_QB on(null|string $connection = null)
     * @method static _IH_OrderInclude_QB query()
     * @method static _IH_OrderInclude_QB with(array|string $relations)
     * @method _IH_OrderInclude_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_OrderInclude_C|OrderInclude[] all()
     * @ownLinks order_id,\App\Order,id
     * @mixin _IH_OrderInclude_QB
     */
    class OrderInclude extends Model {}
    
    /**
     * @property int $id
     * @property string $title
     * @property string|null $slug
     * @property string|null $page_content
     * @property string|null $visibility
     * @property string|null $status
     * @property string|null $back_to_top
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $page_builder_status
     * @property string|null $layout
     * @property string|null $sidebar_layout
     * @property string|null $navbar_variant
     * @property string|null $page_class
     * @property string|null $breadcrumb_status
     * @property string|null $footer_variant
     * @property string|null $widget_style
     * @property string|null $left_column
     * @property string|null $right_column
     * @property MetaData $meta_data
     * @method MorphToMany|_IH_MetaData_QB meta_data()
     * @method static _IH_Page_QB onWriteConnection()
     * @method _IH_Page_QB newQuery()
     * @method static _IH_Page_QB on(null|string $connection = null)
     * @method static _IH_Page_QB query()
     * @method static _IH_Page_QB with(array|string $relations)
     * @method _IH_Page_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Page_C|Page[] all()
     * @mixin _IH_Page_QB
     */
    class Page extends Model {}
    
    /**
     * @property int $id
     * @property string|null $addon_name
     * @property string|null $addon_type
     * @property string|null $addon_namespace
     * @property string|null $addon_location
     * @property int|null $addon_order
     * @property int|null $addon_page_id
     * @property string|null $addon_page_type
     * @property string|null $addon_settings
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_PageBuilder_QB onWriteConnection()
     * @method _IH_PageBuilder_QB newQuery()
     * @method static _IH_PageBuilder_QB on(null|string $connection = null)
     * @method static _IH_PageBuilder_QB query()
     * @method static _IH_PageBuilder_QB with(array|string $relations)
     * @method _IH_PageBuilder_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_PageBuilder_C|PageBuilder[] all()
     * @mixin _IH_PageBuilder_QB
     */
    class PageBuilder extends Model {}
    
    /**
     * @property int $id
     * @property int $seller_id
     * @property float $amount
     * @property string|null $payment_gateway
     * @property string|null $payment_receipt
     * @property string|null $seller_note
     * @property string|null $admin_note
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @method static _IH_PayoutRequest_QB onWriteConnection()
     * @method _IH_PayoutRequest_QB newQuery()
     * @method static _IH_PayoutRequest_QB on(null|string $connection = null)
     * @method static _IH_PayoutRequest_QB query()
     * @method static _IH_PayoutRequest_QB with(array|string $relations)
     * @method _IH_PayoutRequest_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_PayoutRequest_C|PayoutRequest[] all()
     * @mixin _IH_PayoutRequest_QB
     */
    class PayoutRequest extends Model {}
    
    /**
     * @property int $id
     * @property int $order_id
     * @property int|null $service_id
     * @property int $seller_id
     * @property int $buyer_id
     * @property string|null $report_from
     * @property string|null $report_to
     * @property int $status
     * @property string $report
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $buyer
     * @method BelongsTo|_IH_User_QB buyer()
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @method static _IH_Report_QB onWriteConnection()
     * @method _IH_Report_QB newQuery()
     * @method static _IH_Report_QB on(null|string $connection = null)
     * @method static _IH_Report_QB query()
     * @method static _IH_Report_QB with(array|string $relations)
     * @method _IH_Report_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Report_C|Report[] all()
     * @ownLinks order_id,\App\Order,id|service_id,\App\Service,id
     * @mixin _IH_Report_QB
     */
    class Report extends Model {}
    
    /**
     * @property int $id
     * @property int $service_id
     * @property int $seller_id
     * @property int $buyer_id
     * @property float $rating
     * @property string $name
     * @property string $email
     * @property string $message
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $buyer
     * @method BelongsTo|_IH_User_QB buyer()
     * @property User $buyer_for_mobile
     * @method BelongsTo|_IH_User_QB buyer_for_mobile()
     * @method static _IH_Review_QB onWriteConnection()
     * @method _IH_Review_QB newQuery()
     * @method static _IH_Review_QB on(null|string $connection = null)
     * @method static _IH_Review_QB query()
     * @method static _IH_Review_QB with(array|string $relations)
     * @method _IH_Review_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Review_C|Review[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_Review_QB
     */
    class Review extends Model {}
    
    /**
     * @property int $id
     * @property int $day_id
     * @property int $seller_id
     * @property string $schedule
     * @property int|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $allow_multiple_schedule
     * @property Day $days
     * @method BelongsTo|_IH_Day_QB days()
     * @method static _IH_Schedule_QB onWriteConnection()
     * @method _IH_Schedule_QB newQuery()
     * @method static _IH_Schedule_QB on(null|string $connection = null)
     * @method static _IH_Schedule_QB query()
     * @method static _IH_Schedule_QB with(array|string $relations)
     * @method _IH_Schedule_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Schedule_C|Schedule[] all()
     * @ownLinks day_id,\App\Day,id
     * @mixin _IH_Schedule_QB
     */
    class Schedule extends Model {}
    
    /**
     * @property int $id
     * @property int|null $seller_id
     * @property string|null $national_id
     * @property string|null $address
     * @property int|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_SellerVerify_QB onWriteConnection()
     * @method _IH_SellerVerify_QB newQuery()
     * @method static _IH_SellerVerify_QB on(null|string $connection = null)
     * @method static _IH_SellerVerify_QB query()
     * @method static _IH_SellerVerify_QB with(array|string $relations)
     * @method _IH_SellerVerify_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SellerVerify_C|SellerVerify[] all()
     * @mixin _IH_SellerVerify_QB
     */
    class SellerVerify extends Model {}
    
    /**
     * @property int $id
     * @property int $category_id
     * @property int $subcategory_id
     * @property int $seller_id
     * @property int $service_city_id
     * @property string $title
     * @property string $slug
     * @property string $description
     * @property string|null $image
     * @property int $status
     * @property int $is_service_on
     * @property float $price
     * @property float $tax
     * @property float $view
     * @property int $featured
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property int $sold_count
     * @property float $online_service_price
     * @property int $delivery_days
     * @property int $revision
     * @property int $is_service_online
     * @property string|null $image_gallery
     * @property string|null $video
     * @property int|null $admin_id
     * @property string|null $guard_name
     * @property int $is_service_all_cities
     * @property _IH_Review_C|Review[] $avgFeedback
     * @property-read int $avg_feedback_count
     * @method HasMany|_IH_Review_QB avgFeedback()
     * @property _IH_Order_C|Order[] $cancelOrder
     * @property-read int $cancel_order_count
     * @method HasMany|_IH_Order_QB cancelOrder()
     * @property Category $category
     * @method BelongsTo|_IH_Category_QB category()
     * @property _IH_Order_C|Order[] $completeOrder
     * @property-read int $complete_order_count
     * @method HasMany|_IH_Order_QB completeOrder()
     * @property MetaData $metaData
     * @method MorphToMany|_IH_MetaData_QB metaData()
     * @property _IH_Order_C|Order[] $pendingOrder
     * @property-read int $pending_order_count
     * @method HasMany|_IH_Order_QB pendingOrder()
     * @property _IH_Review_C|Review[] $reviews
     * @property-read int $reviews_count
     * @method HasMany|_IH_Review_QB reviews()
     * @property _IH_Review_C|Review[] $reviews_for_mobile
     * @property-read int $reviews_for_mobile_count
     * @method HasMany|_IH_Review_QB reviews_for_mobile()
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @property User $seller_for_mobile
     * @method BelongsTo|_IH_User_QB seller_for_mobile()
     * @property SellerSubscription $seller_subscription
     * @method BelongsTo|_IH_SellerSubscription_QB seller_subscription()
     * @property _IH_Serviceadditional_C|Serviceadditional[] $serviceAdditional
     * @property-read int $service_additional_count
     * @method HasMany|_IH_Serviceadditional_QB serviceAdditional()
     * @property _IH_Servicebenifit_C|Servicebenifit[] $serviceBenifit
     * @property-read int $service_benifit_count
     * @method HasMany|_IH_Servicebenifit_QB serviceBenifit()
     * @property ServiceCity $serviceCity
     * @method BelongsTo|_IH_ServiceCity_QB serviceCity()
     * @property _IH_OnlineServiceFaq_C|OnlineServiceFaq[] $serviceFaq
     * @property-read int $service_faq_count
     * @method HasMany|_IH_OnlineServiceFaq_QB serviceFaq()
     * @property _IH_Serviceinclude_C|Serviceinclude[] $serviceInclude
     * @property-read int $service_include_count
     * @method HasMany|_IH_Serviceinclude_QB serviceInclude()
     * @property SubCategory $subcategory
     * @method BelongsTo|_IH_SubCategory_QB subcategory()
     * @method static _IH_Service_QB onWriteConnection()
     * @method _IH_Service_QB newQuery()
     * @method static _IH_Service_QB on(null|string $connection = null)
     * @method static _IH_Service_QB query()
     * @method static _IH_Service_QB with(array|string $relations)
     * @method _IH_Service_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Service_C|Service[] all()
     * @ownLinks category_id,\App\Category,id|subcategory_id,\App\Subcategory,id|service_city_id,\App\ServiceCity,id|admin_id,\App\Admin,id
     * @foreignLinks id,\App\Serviceinclude,service_id|id,\App\Serviceadditional,service_id|id,\App\Servicebenifit,service_id|id,\App\Order,service_id|id,\App\Review,service_id|id,\App\SupportTicket,service_id|id,\App\Slider,service_id|id,\App\OnlineServiceFaq,service_id|id,\App\Report,service_id
     * @mixin _IH_Service_QB
     */
    class Service extends Model {}
    
    /**
     * @property int $id
     * @property string $service_area
     * @property int $service_city_id
     * @property int|null $country_id
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property ServiceCity $city
     * @method BelongsTo|_IH_ServiceCity_QB city()
     * @property Country|null $country
     * @method BelongsTo|_IH_Country_QB country()
     * @method static _IH_ServiceArea_QB onWriteConnection()
     * @method _IH_ServiceArea_QB newQuery()
     * @method static _IH_ServiceArea_QB on(null|string $connection = null)
     * @method static _IH_ServiceArea_QB query()
     * @method static _IH_ServiceArea_QB with(array|string $relations)
     * @method _IH_ServiceArea_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ServiceArea_C|ServiceArea[] all()
     * @ownLinks service_city_id,\App\ServiceCity,id|country_id,\App\Country,id
     * @mixin _IH_ServiceArea_QB
     */
    class ServiceArea extends Model {}
    
    /**
     * @property int $id
     * @property string $service_city
     * @property int|null $country_id
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Country|null $countryy
     * @method BelongsTo|_IH_Country_QB countryy()
     * @method static _IH_ServiceCity_QB onWriteConnection()
     * @method _IH_ServiceCity_QB newQuery()
     * @method static _IH_ServiceCity_QB on(null|string $connection = null)
     * @method static _IH_ServiceCity_QB query()
     * @method static _IH_ServiceCity_QB with(array|string $relations)
     * @method _IH_ServiceCity_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ServiceCity_C|ServiceCity[] all()
     * @ownLinks country_id,\App\Country,id
     * @foreignLinks id,\App\Service,service_city_id|id,\App\ServiceArea,service_city_id
     * @mixin _IH_ServiceCity_QB
     */
    class ServiceCity extends Model {}
    
    /**
     * @property int $id
     * @property string $code
     * @property float|null $discount
     * @property string|null $discount_type
     * @property string|null $expire_date
     * @property int $status
     * @property int|null $seller_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $user_type
     * @method static _IH_ServiceCoupon_QB onWriteConnection()
     * @method _IH_ServiceCoupon_QB newQuery()
     * @method static _IH_ServiceCoupon_QB on(null|string $connection = null)
     * @method static _IH_ServiceCoupon_QB query()
     * @method static _IH_ServiceCoupon_QB with(array|string $relations)
     * @method _IH_ServiceCoupon_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ServiceCoupon_C|ServiceCoupon[] all()
     * @mixin _IH_ServiceCoupon_QB
     */
    class ServiceCoupon extends Model {}
    
    /**
     * @property int $id
     * @property int $service_id
     * @property int $seller_id
     * @property string|null $additional_service_title
     * @property float|null $additional_service_price
     * @property int|null $additional_service_quantity
     * @property string|null $additional_service_image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Serviceadditional_QB onWriteConnection()
     * @method _IH_Serviceadditional_QB newQuery()
     * @method static _IH_Serviceadditional_QB on(null|string $connection = null)
     * @method static _IH_Serviceadditional_QB query()
     * @method static _IH_Serviceadditional_QB with(array|string $relations)
     * @method _IH_Serviceadditional_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Serviceadditional_C|Serviceadditional[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_Serviceadditional_QB
     */
    class Serviceadditional extends Model {}
    
    /**
     * @property Service $service
     * @method BelongsTo|_IH_Service_QB service()
     * @method static _IH_Serviceattribute_QB onWriteConnection()
     * @method _IH_Serviceattribute_QB newQuery()
     * @method static _IH_Serviceattribute_QB on(null|string $connection = null)
     * @method static _IH_Serviceattribute_QB query()
     * @method static _IH_Serviceattribute_QB with(array|string $relations)
     * @method _IH_Serviceattribute_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Serviceattribute_C|Serviceattribute[] all()
     * @mixin _IH_Serviceattribute_QB
     */
    class Serviceattribute extends Model {}
    
    /**
     * @property int $id
     * @property int $service_id
     * @property int $seller_id
     * @property string|null $benifits
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Servicebenifit_QB onWriteConnection()
     * @method _IH_Servicebenifit_QB newQuery()
     * @method static _IH_Servicebenifit_QB on(null|string $connection = null)
     * @method static _IH_Servicebenifit_QB query()
     * @method static _IH_Servicebenifit_QB with(array|string $relations)
     * @method _IH_Servicebenifit_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Servicebenifit_C|Servicebenifit[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_Servicebenifit_QB
     */
    class Servicebenifit extends Model {}
    
    /**
     * @property int $id
     * @property int $service_id
     * @property int $seller_id
     * @property string $include_service_title
     * @property float $include_service_price
     * @property int $include_service_quantity
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Serviceinclude_QB onWriteConnection()
     * @method _IH_Serviceinclude_QB newQuery()
     * @method static _IH_Serviceinclude_QB on(null|string $connection = null)
     * @method static _IH_Serviceinclude_QB query()
     * @method static _IH_Serviceinclude_QB with(array|string $relations)
     * @method _IH_Serviceinclude_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Serviceinclude_C|Serviceinclude[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_Serviceinclude_QB
     */
    class Serviceinclude extends Model {}
    
    /**
     * @property int $id
     * @property string $background_image
     * @property string $title
     * @property string $sub_title
     * @property int|null $service_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Slider_QB onWriteConnection()
     * @method _IH_Slider_QB newQuery()
     * @method static _IH_Slider_QB on(null|string $connection = null)
     * @method static _IH_Slider_QB query()
     * @method static _IH_Slider_QB with(array|string $relations)
     * @method _IH_Slider_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Slider_C|Slider[] all()
     * @ownLinks service_id,\App\Service,id
     * @mixin _IH_Slider_QB
     */
    class Slider extends Model {}
    
    /**
     * @property int $id
     * @property string $icon
     * @property string $url
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_SocialIcon_QB onWriteConnection()
     * @method _IH_SocialIcon_QB newQuery()
     * @method static _IH_SocialIcon_QB on(null|string $connection = null)
     * @method static _IH_SocialIcon_QB query()
     * @method static _IH_SocialIcon_QB with(array|string $relations)
     * @method _IH_SocialIcon_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SocialIcon_C|SocialIcon[] all()
     * @mixin _IH_SocialIcon_QB
     */
    class SocialIcon extends Model {}
    
    /**
     * @property int $id
     * @property string $option_name
     * @property string|null $option_value
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_StaticOption_QB onWriteConnection()
     * @method _IH_StaticOption_QB newQuery()
     * @method static _IH_StaticOption_QB on(null|string $connection = null)
     * @method static _IH_StaticOption_QB query()
     * @method static _IH_StaticOption_QB with(array|string $relations)
     * @method _IH_StaticOption_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_StaticOption_C|StaticOption[] all()
     * @mixin _IH_StaticOption_QB
     */
    class StaticOption extends Model {}
    
    /**
     * @property int $id
     * @property int $category_id
     * @property string $name
     * @property string|null $slug
     * @property string|null $image
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Category $category
     * @method BelongsTo|_IH_Category_QB category()
     * @property _IH_Service_C|Service[] $services
     * @property-read int $services_count
     * @method HasMany|_IH_Service_QB services()
     * @method static _IH_Subcategory_QB onWriteConnection()
     * @method _IH_Subcategory_QB newQuery()
     * @method static _IH_Subcategory_QB on(null|string $connection = null)
     * @method static _IH_Subcategory_QB query()
     * @method static _IH_Subcategory_QB with(array|string $relations)
     * @method _IH_Subcategory_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Subcategory_C|Subcategory[] all()
     * @ownLinks category_id,\App\Category,id
     * @foreignLinks id,\App\Service,subcategory_id|id,\Modules\JobPost\Entities\BuyerJob,subcategory_id
     * @mixin _IH_Subcategory_QB
     */
    class Subcategory extends Model {}
    
    /**
     * @property int $id
     * @property string|null $title
     * @property string|null $via
     * @property string|null $operating_system
     * @property string|null $user_agent
     * @property string|null $description
     * @property string|null $subject
     * @property string|null $status
     * @property string|null $priority
     * @property string|null $department
     * @property int|null $user_id
     * @property int|null $buyer_id
     * @property int|null $seller_id
     * @property int|null $service_id
     * @property int|null $order_id
     * @property int|null $admin_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User|null $ticket_buyer
     * @method BelongsTo|_IH_User_QB ticket_buyer()
     * @property Order|null $ticket_order
     * @method BelongsTo|_IH_Order_QB ticket_order()
     * @property User|null $ticket_seller
     * @method BelongsTo|_IH_User_QB ticket_seller()
     * @property Service|null $ticket_service
     * @method BelongsTo|_IH_Service_QB ticket_service()
     * @property User|null $ticket_user
     * @method BelongsTo|_IH_User_QB ticket_user()
     * @method static _IH_SupportTicket_QB onWriteConnection()
     * @method _IH_SupportTicket_QB newQuery()
     * @method static _IH_SupportTicket_QB on(null|string $connection = null)
     * @method static _IH_SupportTicket_QB query()
     * @method static _IH_SupportTicket_QB with(array|string $relations)
     * @method _IH_SupportTicket_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SupportTicket_C|SupportTicket[] all()
     * @ownLinks user_id,\App\User,id|service_id,\App\Service,id|order_id,\App\Order,id|admin_id,\App\Admin,id
     * @foreignLinks id,\App\SupportTicketMessage,support_ticket_id
     * @mixin _IH_SupportTicket_QB
     */
    class SupportTicket extends Model {}
    
    /**
     * @property int $id
     * @property string|null $message
     * @property string|null $notify
     * @property string|null $attachment
     * @property string|null $type
     * @property int|null $support_ticket_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_SupportTicketMessage_QB onWriteConnection()
     * @method _IH_SupportTicketMessage_QB newQuery()
     * @method static _IH_SupportTicketMessage_QB on(null|string $connection = null)
     * @method static _IH_SupportTicketMessage_QB query()
     * @method static _IH_SupportTicketMessage_QB with(array|string $relations)
     * @method _IH_SupportTicketMessage_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SupportTicketMessage_C|SupportTicketMessage[] all()
     * @ownLinks support_ticket_id,\App\SupportTicket,id
     * @mixin _IH_SupportTicketMessage_QB
     */
    class SupportTicketMessage extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string|null $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Tag_QB onWriteConnection()
     * @method _IH_Tag_QB newQuery()
     * @method static _IH_Tag_QB on(null|string $connection = null)
     * @method static _IH_Tag_QB query()
     * @method static _IH_Tag_QB with(array|string $relations)
     * @method _IH_Tag_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Tag_C|Tag[] all()
     * @foreignLinks id,\App\Blog,tag_id
     * @mixin _IH_Tag_QB
     */
    class Tag extends Model {}
    
    /**
     * @property int $id
     * @property float $tax
     * @property int $country_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Country $country
     * @method HasOne|_IH_Country_QB country()
     * @method static _IH_Tax_QB onWriteConnection()
     * @method _IH_Tax_QB newQuery()
     * @method static _IH_Tax_QB on(null|string $connection = null)
     * @method static _IH_Tax_QB query()
     * @method static _IH_Tax_QB with(array|string $relations)
     * @method _IH_Tax_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Tax_C|Tax[] all()
     * @ownLinks country_id,\App\Country,id
     * @mixin _IH_Tax_QB
     */
    class Tax extends Model {}
    
    /**
     * @property int $id
     * @property string|null $title
     * @property string|null $description
     * @property int|null $user_id
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_ToDoList_QB onWriteConnection()
     * @method _IH_ToDoList_QB newQuery()
     * @method static _IH_ToDoList_QB on(null|string $connection = null)
     * @method static _IH_ToDoList_QB query()
     * @method static _IH_ToDoList_QB with(array|string $relations)
     * @method _IH_ToDoList_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ToDoList_C|ToDoList[] all()
     * @ownLinks user_id,\App\User,id
     * @mixin _IH_ToDoList_QB
     */
    class ToDoList extends Model {}
    
    /**
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string $username
     * @property string $password
     * @property string|null $phone
     * @property string|null $image
     * @property string|null $profile_background
     * @property string|null $service_city
     * @property string|null $service_area
     * @property int $user_type
     * @property int $user_status
     * @property int $terms_condition
     * @property string|null $address
     * @property string|null $state
     * @property string|null $about
     * @property string|null $post_code
     * @property string|null $country_id
     * @property int|null $email_verified
     * @property string|null $email_verify_token
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $auto_post_approval
     * @property string $is_banned
     * @property string $post_permission
     * @property string|null $facebook_id
     * @property string|null $google_id
     * @property string|null $country_code
     * @property ServiceArea|null $area
     * @method BelongsTo|_IH_ServiceArea_QB area()
     * @property ServiceCity|null $city
     * @method BelongsTo|_IH_ServiceCity_QB city()
     * @property Country|null $country
     * @method BelongsTo|_IH_Country_QB country()
     * @property _IH_BuyerJob_C|BuyerJob[] $jobs
     * @property-read int $jobs_count
     * @method HasMany|_IH_BuyerJob_QB jobs()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $notifications
     * @property-read int $notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB notifications()
     * @property _IH_Order_C|Order[] $order
     * @property-read int $order_count
     * @method HasMany|_IH_Order_QB order()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $readNotifications
     * @property-read int $read_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB readNotifications()
     * @property _IH_Review_C|Review[] $review
     * @property-read int $review_count
     * @method HasMany|_IH_Review_QB review()
     * @property SellerVerify $sellerVerify
     * @method HasOne|_IH_SellerVerify_QB sellerVerify()
     * @property SellerSubscription $subscribedSeller
     * @method HasOne|_IH_SellerSubscription_QB subscribedSeller()
     * @property _IH_DatabaseNotification_C|DatabaseNotification[] $unreadNotifications
     * @property-read int $unread_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB unreadNotifications()
     * @method static _IH_User_QB onWriteConnection()
     * @method _IH_User_QB newQuery()
     * @method static _IH_User_QB on(null|string $connection = null)
     * @method static _IH_User_QB query()
     * @method static _IH_User_QB with(array|string $relations)
     * @method _IH_User_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_User_C|User[] all()
     * @ownLinks country_id,\App\Country,id
     * @foreignLinks id,\App\MediaUpload,user_id|id,\App\Blog,user_id|id,\App\BlogComment,user_id|id,\App\Accountdeactive,user_id|id,\App\SupportTicket,user_id|id,\App\ToDoList,user_id
     * @mixin _IH_User_QB
     */
    class User extends Model {}
    
    /**
     * @property int $id
     * @property string|null $widget_area
     * @property int|null $widget_order
     * @property string|null $widget_location
     * @property string $widget_name
     * @property string $widget_content
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Widgets_QB onWriteConnection()
     * @method _IH_Widgets_QB newQuery()
     * @method static _IH_Widgets_QB on(null|string $connection = null)
     * @method static _IH_Widgets_QB query()
     * @method static _IH_Widgets_QB with(array|string $relations)
     * @method _IH_Widgets_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Widgets_C|Widgets[] all()
     * @mixin _IH_Widgets_QB
     */
    class Widgets extends Model {}
}