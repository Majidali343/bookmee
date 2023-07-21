<?php //250052ffe71fe2119f6e0ffd2cdc1cb2
/** @noinspection all */

namespace LaravelIdea\Helper\Modules\Wallet\Entities {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Modules\Wallet\Entities\Wallet;
    use Modules\Wallet\Entities\WalletHistory;
    
    /**
     * @method WalletHistory|null getOrPut($key, $value)
     * @method WalletHistory|$this shift(int $count = 1)
     * @method WalletHistory|null firstOrFail($key = null, $operator = null, $value = null)
     * @method WalletHistory|$this pop(int $count = 1)
     * @method WalletHistory|null pull($key, $default = null)
     * @method WalletHistory|null last(callable $callback = null, $default = null)
     * @method WalletHistory|$this random(int|null $number = null)
     * @method WalletHistory|null sole($key = null, $operator = null, $value = null)
     * @method WalletHistory|null get($key, $default = null)
     * @method WalletHistory|null first(callable $callback = null, $default = null)
     * @method WalletHistory|null firstWhere(string $key, $operator = null, $value = null)
     * @method WalletHistory|null find($key, $default = null)
     * @method WalletHistory[] all()
     */
    class _IH_WalletHistory_C extends _BaseCollection {
        /**
         * @param int $size
         * @return WalletHistory[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_WalletHistory_QB whereId($value)
     * @method _IH_WalletHistory_QB whereBuyerId($value)
     * @method _IH_WalletHistory_QB wherePaymentGateway($value)
     * @method _IH_WalletHistory_QB wherePaymentStatus($value)
     * @method _IH_WalletHistory_QB whereAmount($value)
     * @method _IH_WalletHistory_QB whereTransactionId($value)
     * @method _IH_WalletHistory_QB whereManualPaymentImage($value)
     * @method _IH_WalletHistory_QB whereStatus($value)
     * @method _IH_WalletHistory_QB whereCreatedAt($value)
     * @method _IH_WalletHistory_QB whereUpdatedAt($value)
     * @method WalletHistory baseSole(array|string $columns = ['*'])
     * @method WalletHistory create(array $attributes = [])
     * @method _IH_WalletHistory_C|WalletHistory[] cursor()
     * @method WalletHistory|null|_IH_WalletHistory_C|WalletHistory[] find($id, array $columns = ['*'])
     * @method _IH_WalletHistory_C|WalletHistory[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method WalletHistory|_IH_WalletHistory_C|WalletHistory[] findOrFail($id, array $columns = ['*'])
     * @method WalletHistory|_IH_WalletHistory_C|WalletHistory[] findOrNew($id, array $columns = ['*'])
     * @method WalletHistory first(array|string $columns = ['*'])
     * @method WalletHistory firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method WalletHistory firstOrCreate(array $attributes = [], array $values = [])
     * @method WalletHistory firstOrFail(array $columns = ['*'])
     * @method WalletHistory firstOrNew(array $attributes = [], array $values = [])
     * @method WalletHistory firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method WalletHistory forceCreate(array $attributes)
     * @method _IH_WalletHistory_C|WalletHistory[] fromQuery(string $query, array $bindings = [])
     * @method _IH_WalletHistory_C|WalletHistory[] get(array|string $columns = ['*'])
     * @method WalletHistory getModel()
     * @method WalletHistory[] getModels(array|string $columns = ['*'])
     * @method _IH_WalletHistory_C|WalletHistory[] hydrate(array $items)
     * @method WalletHistory make(array $attributes = [])
     * @method WalletHistory newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|WalletHistory[]|_IH_WalletHistory_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|WalletHistory[]|_IH_WalletHistory_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method WalletHistory sole(array|string $columns = ['*'])
     * @method WalletHistory updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_WalletHistory_QB extends _BaseBuilder {}
    
    /**
     * @method Wallet|null getOrPut($key, $value)
     * @method Wallet|$this shift(int $count = 1)
     * @method Wallet|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Wallet|$this pop(int $count = 1)
     * @method Wallet|null pull($key, $default = null)
     * @method Wallet|null last(callable $callback = null, $default = null)
     * @method Wallet|$this random(int|null $number = null)
     * @method Wallet|null sole($key = null, $operator = null, $value = null)
     * @method Wallet|null get($key, $default = null)
     * @method Wallet|null first(callable $callback = null, $default = null)
     * @method Wallet|null firstWhere(string $key, $operator = null, $value = null)
     * @method Wallet|null find($key, $default = null)
     * @method Wallet[] all()
     */
    class _IH_Wallet_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Wallet[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Wallet_QB whereId($value)
     * @method _IH_Wallet_QB whereBuyerId($value)
     * @method _IH_Wallet_QB whereBalance($value)
     * @method _IH_Wallet_QB whereStatus($value)
     * @method _IH_Wallet_QB whereCreatedAt($value)
     * @method _IH_Wallet_QB whereUpdatedAt($value)
     * @method Wallet baseSole(array|string $columns = ['*'])
     * @method Wallet create(array $attributes = [])
     * @method _IH_Wallet_C|Wallet[] cursor()
     * @method Wallet|null|_IH_Wallet_C|Wallet[] find($id, array $columns = ['*'])
     * @method _IH_Wallet_C|Wallet[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Wallet|_IH_Wallet_C|Wallet[] findOrFail($id, array $columns = ['*'])
     * @method Wallet|_IH_Wallet_C|Wallet[] findOrNew($id, array $columns = ['*'])
     * @method Wallet first(array|string $columns = ['*'])
     * @method Wallet firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Wallet firstOrCreate(array $attributes = [], array $values = [])
     * @method Wallet firstOrFail(array $columns = ['*'])
     * @method Wallet firstOrNew(array $attributes = [], array $values = [])
     * @method Wallet firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Wallet forceCreate(array $attributes)
     * @method _IH_Wallet_C|Wallet[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Wallet_C|Wallet[] get(array|string $columns = ['*'])
     * @method Wallet getModel()
     * @method Wallet[] getModels(array|string $columns = ['*'])
     * @method _IH_Wallet_C|Wallet[] hydrate(array $items)
     * @method Wallet make(array $attributes = [])
     * @method Wallet newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Wallet[]|_IH_Wallet_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Wallet[]|_IH_Wallet_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Wallet sole(array|string $columns = ['*'])
     * @method Wallet updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Wallet_QB extends _BaseBuilder {}
}