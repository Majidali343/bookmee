<?php //4ae42213635d75c6eb9d354ca5f32aaa
/** @noinspection all */

namespace Modules\Subscription\Entities {

    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\App\_IH_User_QB;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SellerSubscription_C;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SellerSubscription_QB;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SubscriptionCoupon_C;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SubscriptionCoupon_QB;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SubscriptionHistory_C;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_SubscriptionHistory_QB;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_Subscription_C;
    use LaravelIdea\Helper\Modules\Subscription\Entities\_IH_Subscription_QB;
    
    /**
     * @property int $id
     * @property int $subscription_id
     * @property int $seller_id
     * @property string|null $type
     * @property int $connect
     * @property float $price
     * @property int $initial_connect
     * @property float $initial_price
     * @property float $total
     * @property int $status
     * @property Carbon|null $expire_date
     * @property string|null $payment_gateway
     * @property string|null $payment_status
     * @property string|null $transaction_id
     * @property string|null $manual_payment_image
     * @property string|null $note
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @property Subscription $subscription
     * @method BelongsTo|_IH_Subscription_QB subscription()
     * @method static _IH_SellerSubscription_QB onWriteConnection()
     * @method _IH_SellerSubscription_QB newQuery()
     * @method static _IH_SellerSubscription_QB on(null|string $connection = null)
     * @method static _IH_SellerSubscription_QB query()
     * @method static _IH_SellerSubscription_QB with(array|string $relations)
     * @method _IH_SellerSubscription_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SellerSubscription_C|SellerSubscription[] all()
     * @ownLinks subscription_id,\Modules\Subscription\Entities\Subscription,id
     * @mixin _IH_SellerSubscription_QB
     */
    class SellerSubscription extends Model {}
    
    /**
     * @property int $id
     * @property string $title
     * @property string $type
     * @property float $price
     * @property int $connect
     * @property int $status
     * @property int|null $image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_SellerSubscription_C|SellerSubscription[] $seller
     * @property-read int $seller_count
     * @method HasMany|_IH_SellerSubscription_QB seller()
     * @method static _IH_Subscription_QB onWriteConnection()
     * @method _IH_Subscription_QB newQuery()
     * @method static _IH_Subscription_QB on(null|string $connection = null)
     * @method static _IH_Subscription_QB query()
     * @method static _IH_Subscription_QB with(array|string $relations)
     * @method _IH_Subscription_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Subscription_C|Subscription[] all()
     * @foreignLinks id,\Modules\Subscription\Entities\SellerSubscription,subscription_id|id,\Modules\Subscription\Entities\SubscriptionHistory,subscription_id
     * @mixin _IH_Subscription_QB
     */
    class Subscription extends Model {}
    
    /**
     * @property int $id
     * @property string $code
     * @property float|null $discount
     * @property string|null $discount_type
     * @property string|null $expire_date
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_SubscriptionCoupon_QB onWriteConnection()
     * @method _IH_SubscriptionCoupon_QB newQuery()
     * @method static _IH_SubscriptionCoupon_QB on(null|string $connection = null)
     * @method static _IH_SubscriptionCoupon_QB query()
     * @method static _IH_SubscriptionCoupon_QB with(array|string $relations)
     * @method _IH_SubscriptionCoupon_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SubscriptionCoupon_C|SubscriptionCoupon[] all()
     * @mixin _IH_SubscriptionCoupon_QB
     */
    class SubscriptionCoupon extends Model {}
    
    /**
     * @property int $id
     * @property int $subscription_id
     * @property int $seller_id
     * @property string|null $type
     * @property int $connect
     * @property float $price
     * @property string|null $coupon_code
     * @property string|null $coupon_type
     * @property string $coupon_amount
     * @property Carbon|null $expire_date
     * @property string|null $payment_gateway
     * @property string|null $payment_status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property User $seller
     * @method BelongsTo|_IH_User_QB seller()
     * @property Subscription $subscription
     * @method BelongsTo|_IH_Subscription_QB subscription()
     * @method static _IH_SubscriptionHistory_QB onWriteConnection()
     * @method _IH_SubscriptionHistory_QB newQuery()
     * @method static _IH_SubscriptionHistory_QB on(null|string $connection = null)
     * @method static _IH_SubscriptionHistory_QB query()
     * @method static _IH_SubscriptionHistory_QB with(array|string $relations)
     * @method _IH_SubscriptionHistory_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_SubscriptionHistory_C|SubscriptionHistory[] all()
     * @ownLinks subscription_id,\Modules\Subscription\Entities\Subscription,id
     * @mixin _IH_SubscriptionHistory_QB
     */
    class SubscriptionHistory extends Model {}
}