<?php //5a13ba1e983d561428f570557ec4c8cd
/** @noinspection all */

namespace Tzsk\Payu\Models {

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\MorphTo;
    use LaravelIdea\Helper\Tzsk\Payu\Models\_IH_PayuTransaction_C;
    use LaravelIdea\Helper\Tzsk\Payu\Models\_IH_PayuTransaction_QB;
    
    /**
     * @property Model $paidFor
     * @method MorphTo paidFor()
     * @method static _IH_PayuTransaction_QB onWriteConnection()
     * @method _IH_PayuTransaction_QB newQuery()
     * @method static _IH_PayuTransaction_QB on(null|string $connection = null)
     * @method static _IH_PayuTransaction_QB query()
     * @method static _IH_PayuTransaction_QB with(array|string $relations)
     * @method _IH_PayuTransaction_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_PayuTransaction_C|PayuTransaction[] all()
     * @mixin _IH_PayuTransaction_QB
     */
    class PayuTransaction extends Model {}
}