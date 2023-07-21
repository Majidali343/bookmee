<?php //aa7ef44ba9ec3b37a91fa7374e16a65c
/** @noinspection all */

namespace LaravelIdea\Helper\Modules\Subscription\Entities {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Modules\Subscription\Entities\SellerSubscription;
    use Modules\Subscription\Entities\Subscription;
    use Modules\Subscription\Entities\SubscriptionCoupon;
    use Modules\Subscription\Entities\SubscriptionHistory;
    
    /**
     * @method SellerSubscription|null getOrPut($key, $value)
     * @method SellerSubscription|$this shift(int $count = 1)
     * @method SellerSubscription|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SellerSubscription|$this pop(int $count = 1)
     * @method SellerSubscription|null pull($key, $default = null)
     * @method SellerSubscription|null last(callable $callback = null, $default = null)
     * @method SellerSubscription|$this random(int|null $number = null)
     * @method SellerSubscription|null sole($key = null, $operator = null, $value = null)
     * @method SellerSubscription|null get($key, $default = null)
     * @method SellerSubscription|null first(callable $callback = null, $default = null)
     * @method SellerSubscription|null firstWhere(string $key, $operator = null, $value = null)
     * @method SellerSubscription|null find($key, $default = null)
     * @method SellerSubscription[] all()
     */
    class _IH_SellerSubscription_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SellerSubscription[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SellerSubscription_QB whereId($value)
     * @method _IH_SellerSubscription_QB whereSubscriptionId($value)
     * @method _IH_SellerSubscription_QB whereSellerId($value)
     * @method _IH_SellerSubscription_QB whereType($value)
     * @method _IH_SellerSubscription_QB whereConnect($value)
     * @method _IH_SellerSubscription_QB wherePrice($value)
     * @method _IH_SellerSubscription_QB whereInitialConnect($value)
     * @method _IH_SellerSubscription_QB whereInitialPrice($value)
     * @method _IH_SellerSubscription_QB whereTotal($value)
     * @method _IH_SellerSubscription_QB whereStatus($value)
     * @method _IH_SellerSubscription_QB whereExpireDate($value)
     * @method _IH_SellerSubscription_QB wherePaymentGateway($value)
     * @method _IH_SellerSubscription_QB wherePaymentStatus($value)
     * @method _IH_SellerSubscription_QB whereTransactionId($value)
     * @method _IH_SellerSubscription_QB whereManualPaymentImage($value)
     * @method _IH_SellerSubscription_QB whereNote($value)
     * @method _IH_SellerSubscription_QB whereCreatedAt($value)
     * @method _IH_SellerSubscription_QB whereUpdatedAt($value)
     * @method SellerSubscription baseSole(array|string $columns = ['*'])
     * @method SellerSubscription create(array $attributes = [])
     * @method _IH_SellerSubscription_C|SellerSubscription[] cursor()
     * @method SellerSubscription|null|_IH_SellerSubscription_C|SellerSubscription[] find($id, array $columns = ['*'])
     * @method _IH_SellerSubscription_C|SellerSubscription[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SellerSubscription|_IH_SellerSubscription_C|SellerSubscription[] findOrFail($id, array $columns = ['*'])
     * @method SellerSubscription|_IH_SellerSubscription_C|SellerSubscription[] findOrNew($id, array $columns = ['*'])
     * @method SellerSubscription first(array|string $columns = ['*'])
     * @method SellerSubscription firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SellerSubscription firstOrCreate(array $attributes = [], array $values = [])
     * @method SellerSubscription firstOrFail(array $columns = ['*'])
     * @method SellerSubscription firstOrNew(array $attributes = [], array $values = [])
     * @method SellerSubscription firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SellerSubscription forceCreate(array $attributes)
     * @method _IH_SellerSubscription_C|SellerSubscription[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SellerSubscription_C|SellerSubscription[] get(array|string $columns = ['*'])
     * @method SellerSubscription getModel()
     * @method SellerSubscription[] getModels(array|string $columns = ['*'])
     * @method _IH_SellerSubscription_C|SellerSubscription[] hydrate(array $items)
     * @method SellerSubscription make(array $attributes = [])
     * @method SellerSubscription newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SellerSubscription[]|_IH_SellerSubscription_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SellerSubscription[]|_IH_SellerSubscription_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SellerSubscription sole(array|string $columns = ['*'])
     * @method SellerSubscription updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SellerSubscription_QB extends _BaseBuilder {}
    
    /**
     * @method SubscriptionCoupon|null getOrPut($key, $value)
     * @method SubscriptionCoupon|$this shift(int $count = 1)
     * @method SubscriptionCoupon|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SubscriptionCoupon|$this pop(int $count = 1)
     * @method SubscriptionCoupon|null pull($key, $default = null)
     * @method SubscriptionCoupon|null last(callable $callback = null, $default = null)
     * @method SubscriptionCoupon|$this random(int|null $number = null)
     * @method SubscriptionCoupon|null sole($key = null, $operator = null, $value = null)
     * @method SubscriptionCoupon|null get($key, $default = null)
     * @method SubscriptionCoupon|null first(callable $callback = null, $default = null)
     * @method SubscriptionCoupon|null firstWhere(string $key, $operator = null, $value = null)
     * @method SubscriptionCoupon|null find($key, $default = null)
     * @method SubscriptionCoupon[] all()
     */
    class _IH_SubscriptionCoupon_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SubscriptionCoupon[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SubscriptionCoupon_QB whereId($value)
     * @method _IH_SubscriptionCoupon_QB whereCode($value)
     * @method _IH_SubscriptionCoupon_QB whereDiscount($value)
     * @method _IH_SubscriptionCoupon_QB whereDiscountType($value)
     * @method _IH_SubscriptionCoupon_QB whereExpireDate($value)
     * @method _IH_SubscriptionCoupon_QB whereStatus($value)
     * @method _IH_SubscriptionCoupon_QB whereCreatedAt($value)
     * @method _IH_SubscriptionCoupon_QB whereUpdatedAt($value)
     * @method SubscriptionCoupon baseSole(array|string $columns = ['*'])
     * @method SubscriptionCoupon create(array $attributes = [])
     * @method _IH_SubscriptionCoupon_C|SubscriptionCoupon[] cursor()
     * @method SubscriptionCoupon|null|_IH_SubscriptionCoupon_C|SubscriptionCoupon[] find($id, array $columns = ['*'])
     * @method _IH_SubscriptionCoupon_C|SubscriptionCoupon[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SubscriptionCoupon|_IH_SubscriptionCoupon_C|SubscriptionCoupon[] findOrFail($id, array $columns = ['*'])
     * @method SubscriptionCoupon|_IH_SubscriptionCoupon_C|SubscriptionCoupon[] findOrNew($id, array $columns = ['*'])
     * @method SubscriptionCoupon first(array|string $columns = ['*'])
     * @method SubscriptionCoupon firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SubscriptionCoupon firstOrCreate(array $attributes = [], array $values = [])
     * @method SubscriptionCoupon firstOrFail(array $columns = ['*'])
     * @method SubscriptionCoupon firstOrNew(array $attributes = [], array $values = [])
     * @method SubscriptionCoupon firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SubscriptionCoupon forceCreate(array $attributes)
     * @method _IH_SubscriptionCoupon_C|SubscriptionCoupon[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SubscriptionCoupon_C|SubscriptionCoupon[] get(array|string $columns = ['*'])
     * @method SubscriptionCoupon getModel()
     * @method SubscriptionCoupon[] getModels(array|string $columns = ['*'])
     * @method _IH_SubscriptionCoupon_C|SubscriptionCoupon[] hydrate(array $items)
     * @method SubscriptionCoupon make(array $attributes = [])
     * @method SubscriptionCoupon newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SubscriptionCoupon[]|_IH_SubscriptionCoupon_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SubscriptionCoupon[]|_IH_SubscriptionCoupon_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SubscriptionCoupon sole(array|string $columns = ['*'])
     * @method SubscriptionCoupon updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SubscriptionCoupon_QB extends _BaseBuilder {}
    
    /**
     * @method SubscriptionHistory|null getOrPut($key, $value)
     * @method SubscriptionHistory|$this shift(int $count = 1)
     * @method SubscriptionHistory|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SubscriptionHistory|$this pop(int $count = 1)
     * @method SubscriptionHistory|null pull($key, $default = null)
     * @method SubscriptionHistory|null last(callable $callback = null, $default = null)
     * @method SubscriptionHistory|$this random(int|null $number = null)
     * @method SubscriptionHistory|null sole($key = null, $operator = null, $value = null)
     * @method SubscriptionHistory|null get($key, $default = null)
     * @method SubscriptionHistory|null first(callable $callback = null, $default = null)
     * @method SubscriptionHistory|null firstWhere(string $key, $operator = null, $value = null)
     * @method SubscriptionHistory|null find($key, $default = null)
     * @method SubscriptionHistory[] all()
     */
    class _IH_SubscriptionHistory_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SubscriptionHistory[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SubscriptionHistory_QB whereId($value)
     * @method _IH_SubscriptionHistory_QB whereSubscriptionId($value)
     * @method _IH_SubscriptionHistory_QB whereSellerId($value)
     * @method _IH_SubscriptionHistory_QB whereType($value)
     * @method _IH_SubscriptionHistory_QB whereConnect($value)
     * @method _IH_SubscriptionHistory_QB wherePrice($value)
     * @method _IH_SubscriptionHistory_QB whereCouponCode($value)
     * @method _IH_SubscriptionHistory_QB whereCouponType($value)
     * @method _IH_SubscriptionHistory_QB whereCouponAmount($value)
     * @method _IH_SubscriptionHistory_QB whereExpireDate($value)
     * @method _IH_SubscriptionHistory_QB wherePaymentGateway($value)
     * @method _IH_SubscriptionHistory_QB wherePaymentStatus($value)
     * @method _IH_SubscriptionHistory_QB whereCreatedAt($value)
     * @method _IH_SubscriptionHistory_QB whereUpdatedAt($value)
     * @method SubscriptionHistory baseSole(array|string $columns = ['*'])
     * @method SubscriptionHistory create(array $attributes = [])
     * @method _IH_SubscriptionHistory_C|SubscriptionHistory[] cursor()
     * @method SubscriptionHistory|null|_IH_SubscriptionHistory_C|SubscriptionHistory[] find($id, array $columns = ['*'])
     * @method _IH_SubscriptionHistory_C|SubscriptionHistory[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SubscriptionHistory|_IH_SubscriptionHistory_C|SubscriptionHistory[] findOrFail($id, array $columns = ['*'])
     * @method SubscriptionHistory|_IH_SubscriptionHistory_C|SubscriptionHistory[] findOrNew($id, array $columns = ['*'])
     * @method SubscriptionHistory first(array|string $columns = ['*'])
     * @method SubscriptionHistory firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SubscriptionHistory firstOrCreate(array $attributes = [], array $values = [])
     * @method SubscriptionHistory firstOrFail(array $columns = ['*'])
     * @method SubscriptionHistory firstOrNew(array $attributes = [], array $values = [])
     * @method SubscriptionHistory firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SubscriptionHistory forceCreate(array $attributes)
     * @method _IH_SubscriptionHistory_C|SubscriptionHistory[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SubscriptionHistory_C|SubscriptionHistory[] get(array|string $columns = ['*'])
     * @method SubscriptionHistory getModel()
     * @method SubscriptionHistory[] getModels(array|string $columns = ['*'])
     * @method _IH_SubscriptionHistory_C|SubscriptionHistory[] hydrate(array $items)
     * @method SubscriptionHistory make(array $attributes = [])
     * @method SubscriptionHistory newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SubscriptionHistory[]|_IH_SubscriptionHistory_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SubscriptionHistory[]|_IH_SubscriptionHistory_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SubscriptionHistory sole(array|string $columns = ['*'])
     * @method SubscriptionHistory updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SubscriptionHistory_QB extends _BaseBuilder {}
    
    /**
     * @method Subscription|null getOrPut($key, $value)
     * @method Subscription|$this shift(int $count = 1)
     * @method Subscription|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Subscription|$this pop(int $count = 1)
     * @method Subscription|null pull($key, $default = null)
     * @method Subscription|null last(callable $callback = null, $default = null)
     * @method Subscription|$this random(int|null $number = null)
     * @method Subscription|null sole($key = null, $operator = null, $value = null)
     * @method Subscription|null get($key, $default = null)
     * @method Subscription|null first(callable $callback = null, $default = null)
     * @method Subscription|null firstWhere(string $key, $operator = null, $value = null)
     * @method Subscription|null find($key, $default = null)
     * @method Subscription[] all()
     */
    class _IH_Subscription_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Subscription[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Subscription_QB whereId($value)
     * @method _IH_Subscription_QB whereTitle($value)
     * @method _IH_Subscription_QB whereType($value)
     * @method _IH_Subscription_QB wherePrice($value)
     * @method _IH_Subscription_QB whereConnect($value)
     * @method _IH_Subscription_QB whereStatus($value)
     * @method _IH_Subscription_QB whereImage($value)
     * @method _IH_Subscription_QB whereCreatedAt($value)
     * @method _IH_Subscription_QB whereUpdatedAt($value)
     * @method Subscription baseSole(array|string $columns = ['*'])
     * @method Subscription create(array $attributes = [])
     * @method _IH_Subscription_C|Subscription[] cursor()
     * @method Subscription|null|_IH_Subscription_C|Subscription[] find($id, array $columns = ['*'])
     * @method _IH_Subscription_C|Subscription[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Subscription|_IH_Subscription_C|Subscription[] findOrFail($id, array $columns = ['*'])
     * @method Subscription|_IH_Subscription_C|Subscription[] findOrNew($id, array $columns = ['*'])
     * @method Subscription first(array|string $columns = ['*'])
     * @method Subscription firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Subscription firstOrCreate(array $attributes = [], array $values = [])
     * @method Subscription firstOrFail(array $columns = ['*'])
     * @method Subscription firstOrNew(array $attributes = [], array $values = [])
     * @method Subscription firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Subscription forceCreate(array $attributes)
     * @method _IH_Subscription_C|Subscription[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Subscription_C|Subscription[] get(array|string $columns = ['*'])
     * @method Subscription getModel()
     * @method Subscription[] getModels(array|string $columns = ['*'])
     * @method _IH_Subscription_C|Subscription[] hydrate(array $items)
     * @method Subscription make(array $attributes = [])
     * @method Subscription newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Subscription[]|_IH_Subscription_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Subscription[]|_IH_Subscription_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Subscription sole(array|string $columns = ['*'])
     * @method Subscription updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Subscription_QB extends _BaseBuilder {}
}