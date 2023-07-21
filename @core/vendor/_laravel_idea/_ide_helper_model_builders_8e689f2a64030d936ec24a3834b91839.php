<?php //f9904d57b44c43be0d2f16705e2ba846
/** @noinspection all */

namespace LaravelIdea\Helper\Modules\LiveChat\Entities {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Modules\LiveChat\Entities\LiveChatMessage;
    
    /**
     * @method LiveChatMessage|null getOrPut($key, $value)
     * @method LiveChatMessage|$this shift(int $count = 1)
     * @method LiveChatMessage|null firstOrFail($key = null, $operator = null, $value = null)
     * @method LiveChatMessage|$this pop(int $count = 1)
     * @method LiveChatMessage|null pull($key, $default = null)
     * @method LiveChatMessage|null last(callable $callback = null, $default = null)
     * @method LiveChatMessage|$this random(int|null $number = null)
     * @method LiveChatMessage|null sole($key = null, $operator = null, $value = null)
     * @method LiveChatMessage|null get($key, $default = null)
     * @method LiveChatMessage|null first(callable $callback = null, $default = null)
     * @method LiveChatMessage|null firstWhere(string $key, $operator = null, $value = null)
     * @method LiveChatMessage|null find($key, $default = null)
     * @method LiveChatMessage[] all()
     */
    class _IH_LiveChatMessage_C extends _BaseCollection {
        /**
         * @param int $size
         * @return LiveChatMessage[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_LiveChatMessage_QB whereId($value)
     * @method _IH_LiveChatMessage_QB whereFromUser($value)
     * @method _IH_LiveChatMessage_QB whereToUser($value)
     * @method _IH_LiveChatMessage_QB whereSellerId($value)
     * @method _IH_LiveChatMessage_QB whereBuyerId($value)
     * @method _IH_LiveChatMessage_QB whereMessage($value)
     * @method _IH_LiveChatMessage_QB whereImage($value)
     * @method _IH_LiveChatMessage_QB whereCreatedAt($value)
     * @method _IH_LiveChatMessage_QB whereUpdatedAt($value)
     * @method LiveChatMessage baseSole(array|string $columns = ['*'])
     * @method LiveChatMessage create(array $attributes = [])
     * @method _IH_LiveChatMessage_C|LiveChatMessage[] cursor()
     * @method LiveChatMessage|null|_IH_LiveChatMessage_C|LiveChatMessage[] find($id, array $columns = ['*'])
     * @method _IH_LiveChatMessage_C|LiveChatMessage[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method LiveChatMessage|_IH_LiveChatMessage_C|LiveChatMessage[] findOrFail($id, array $columns = ['*'])
     * @method LiveChatMessage|_IH_LiveChatMessage_C|LiveChatMessage[] findOrNew($id, array $columns = ['*'])
     * @method LiveChatMessage first(array|string $columns = ['*'])
     * @method LiveChatMessage firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method LiveChatMessage firstOrCreate(array $attributes = [], array $values = [])
     * @method LiveChatMessage firstOrFail(array $columns = ['*'])
     * @method LiveChatMessage firstOrNew(array $attributes = [], array $values = [])
     * @method LiveChatMessage firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method LiveChatMessage forceCreate(array $attributes)
     * @method _IH_LiveChatMessage_C|LiveChatMessage[] fromQuery(string $query, array $bindings = [])
     * @method _IH_LiveChatMessage_C|LiveChatMessage[] get(array|string $columns = ['*'])
     * @method LiveChatMessage getModel()
     * @method LiveChatMessage[] getModels(array|string $columns = ['*'])
     * @method _IH_LiveChatMessage_C|LiveChatMessage[] hydrate(array $items)
     * @method LiveChatMessage make(array $attributes = [])
     * @method LiveChatMessage newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|LiveChatMessage[]|_IH_LiveChatMessage_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|LiveChatMessage[]|_IH_LiveChatMessage_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method LiveChatMessage sole(array|string $columns = ['*'])
     * @method LiveChatMessage updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_LiveChatMessage_QB extends _BaseBuilder {}
}