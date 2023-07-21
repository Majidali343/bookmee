<?php //96bab72ebc23bfa92e08949810951eac
/** @noinspection all */

namespace Modules\LiveChat\Entities {

    use App\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\App\_IH_User_QB;
    use LaravelIdea\Helper\Modules\LiveChat\Entities\_IH_LiveChatMessage_C;
    use LaravelIdea\Helper\Modules\LiveChat\Entities\_IH_LiveChatMessage_QB;
    
    /**
     * @property int $id
     * @property int $from_user
     * @property int $to_user
     * @property int|null $seller_id
     * @property int|null $buyer_id
     * @property string|null $message
     * @property string|null $image
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read $date_human_readable attribute
     * @property-read $date_time_str attribute
     * @property-read string $image_url attribute
     * @property-read null $sender_profile_image attribute
     * @property User|null $buyerList
     * @method BelongsTo|_IH_User_QB buyerList()
     * @property User|null $buyerOnlyForAdmin
     * @method BelongsTo|_IH_User_QB buyerOnlyForAdmin()
     * @property User $fromUser
     * @method BelongsTo|_IH_User_QB fromUser()
     * @property User|null $sellerList
     * @method BelongsTo|_IH_User_QB sellerList()
     * @property User|null $sellerOnlyForAdmin
     * @method BelongsTo|_IH_User_QB sellerOnlyForAdmin()
     * @property User $toUser
     * @method BelongsTo|_IH_User_QB toUser()
     * @method static _IH_LiveChatMessage_QB onWriteConnection()
     * @method _IH_LiveChatMessage_QB newQuery()
     * @method static _IH_LiveChatMessage_QB on(null|string $connection = null)
     * @method static _IH_LiveChatMessage_QB query()
     * @method static _IH_LiveChatMessage_QB with(array|string $relations)
     * @method _IH_LiveChatMessage_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_LiveChatMessage_C|LiveChatMessage[] all()
     * @mixin _IH_LiveChatMessage_QB
     */
    class LiveChatMessage extends Model {}
}