<?php //5bc179940c8a2f72dd46896c385bf5a9
/** @noinspection all */

namespace LaravelIdea\Helper\Tzsk\Payu\Models {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Tzsk\Payu\Models\PayuTransaction;
    
    /**
     * @method PayuTransaction|null getOrPut($key, $value)
     * @method PayuTransaction|$this shift(int $count = 1)
     * @method PayuTransaction|null firstOrFail($key = null, $operator = null, $value = null)
     * @method PayuTransaction|$this pop(int $count = 1)
     * @method PayuTransaction|null pull($key, $default = null)
     * @method PayuTransaction|null last(callable $callback = null, $default = null)
     * @method PayuTransaction|$this random(int|null $number = null)
     * @method PayuTransaction|null sole($key = null, $operator = null, $value = null)
     * @method PayuTransaction|null get($key, $default = null)
     * @method PayuTransaction|null first(callable $callback = null, $default = null)
     * @method PayuTransaction|null firstWhere(string $key, $operator = null, $value = null)
     * @method PayuTransaction|null find($key, $default = null)
     * @method PayuTransaction[] all()
     */
    class _IH_PayuTransaction_C extends _BaseCollection {
        /**
         * @param int $size
         * @return PayuTransaction[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method PayuTransaction baseSole(array|string $columns = ['*'])
     * @method PayuTransaction create(array $attributes = [])
     * @method _IH_PayuTransaction_C|PayuTransaction[] cursor()
     * @method PayuTransaction|null|_IH_PayuTransaction_C|PayuTransaction[] find($id, array $columns = ['*'])
     * @method _IH_PayuTransaction_C|PayuTransaction[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method PayuTransaction|_IH_PayuTransaction_C|PayuTransaction[] findOrFail($id, array $columns = ['*'])
     * @method PayuTransaction|_IH_PayuTransaction_C|PayuTransaction[] findOrNew($id, array $columns = ['*'])
     * @method PayuTransaction first(array|string $columns = ['*'])
     * @method PayuTransaction firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method PayuTransaction firstOrCreate(array $attributes = [], array $values = [])
     * @method PayuTransaction firstOrFail(array $columns = ['*'])
     * @method PayuTransaction firstOrNew(array $attributes = [], array $values = [])
     * @method PayuTransaction firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method PayuTransaction forceCreate(array $attributes)
     * @method _IH_PayuTransaction_C|PayuTransaction[] fromQuery(string $query, array $bindings = [])
     * @method _IH_PayuTransaction_C|PayuTransaction[] get(array|string $columns = ['*'])
     * @method PayuTransaction getModel()
     * @method PayuTransaction[] getModels(array|string $columns = ['*'])
     * @method _IH_PayuTransaction_C|PayuTransaction[] hydrate(array $items)
     * @method PayuTransaction make(array $attributes = [])
     * @method PayuTransaction newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|PayuTransaction[]|_IH_PayuTransaction_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|PayuTransaction[]|_IH_PayuTransaction_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method PayuTransaction sole(array|string $columns = ['*'])
     * @method PayuTransaction updateOrCreate(array $attributes, array $values = [])
     * @method _IH_PayuTransaction_QB withTrashed()
     * @method _IH_PayuTransaction_QB onlyTrashed()
     * @method _IH_PayuTransaction_QB withoutTrashed()
     * @method _IH_PayuTransaction_QB restore()
     * @method _IH_PayuTransaction_QB failed()
     * @method _IH_PayuTransaction_QB locate(string $id)
     * @method _IH_PayuTransaction_QB pending()
     * @method _IH_PayuTransaction_QB successful()
     * @method _IH_PayuTransaction_QB verifiable()
     */
    class _IH_PayuTransaction_QB extends _BaseBuilder {}
}