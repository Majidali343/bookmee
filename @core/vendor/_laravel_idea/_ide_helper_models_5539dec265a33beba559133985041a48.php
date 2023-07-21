<?php //987e056dc5fc15b0e11d89e0435280be
/** @noinspection all */

namespace Modules\Wallet\Entities {

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;
    use LaravelIdea\Helper\Modules\Wallet\Entities\_IH_WalletHistory_C;
    use LaravelIdea\Helper\Modules\Wallet\Entities\_IH_WalletHistory_QB;
    use LaravelIdea\Helper\Modules\Wallet\Entities\_IH_Wallet_C;
    use LaravelIdea\Helper\Modules\Wallet\Entities\_IH_Wallet_QB;
    
    /**
     * @property int $id
     * @property int $buyer_id
     * @property float $balance
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Wallet_QB onWriteConnection()
     * @method _IH_Wallet_QB newQuery()
     * @method static _IH_Wallet_QB on(null|string $connection = null)
     * @method static _IH_Wallet_QB query()
     * @method static _IH_Wallet_QB with(array|string $relations)
     * @method _IH_Wallet_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Wallet_C|Wallet[] all()
     * @mixin _IH_Wallet_QB
     */
    class Wallet extends Model {}
    
    /**
     * @property int $id
     * @property int $buyer_id
     * @property string|null $payment_gateway
     * @property string|null $payment_status
     * @property float $amount
     * @property string|null $transaction_id
     * @property string $manual_payment_image
     * @property int $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_WalletHistory_QB onWriteConnection()
     * @method _IH_WalletHistory_QB newQuery()
     * @method static _IH_WalletHistory_QB on(null|string $connection = null)
     * @method static _IH_WalletHistory_QB query()
     * @method static _IH_WalletHistory_QB with(array|string $relations)
     * @method _IH_WalletHistory_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_WalletHistory_C|WalletHistory[] all()
     * @mixin _IH_WalletHistory_QB
     */
    class WalletHistory extends Model {}
}