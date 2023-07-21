<?php //640e1a02122f66aee19b7ae5d3f58f74
/** @noinspection all */

namespace LaravelIdea\Helper\Spatie\Permission\Models {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Collection;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Spatie\Permission\Contracts\Permission as Permission1;
    use Spatie\Permission\Contracts\Role;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role as Role1;
    
    /**
     * @method Permission|null getOrPut($key, $value)
     * @method Permission|$this shift(int $count = 1)
     * @method Permission|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Permission|$this pop(int $count = 1)
     * @method Permission|null pull($key, $default = null)
     * @method Permission|null last(callable $callback = null, $default = null)
     * @method Permission|$this random(int|null $number = null)
     * @method Permission|null sole($key = null, $operator = null, $value = null)
     * @method Permission|null get($key, $default = null)
     * @method Permission|null first(callable $callback = null, $default = null)
     * @method Permission|null firstWhere(string $key, $operator = null, $value = null)
     * @method Permission|null find($key, $default = null)
     * @method Permission[] all()
     */
    class _IH_Permission_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Permission[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method Permission baseSole(array|string $columns = ['*'])
     * @method Permission create(array $attributes = [])
     * @method _IH_Permission_C|Permission[] cursor()
     * @method Permission|null|_IH_Permission_C|Permission[] find($id, array $columns = ['*'])
     * @method _IH_Permission_C|Permission[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Permission|_IH_Permission_C|Permission[] findOrFail($id, array $columns = ['*'])
     * @method Permission|_IH_Permission_C|Permission[] findOrNew($id, array $columns = ['*'])
     * @method Permission first(array|string $columns = ['*'])
     * @method Permission firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Permission firstOrCreate(array $attributes = [], array $values = [])
     * @method Permission firstOrFail(array $columns = ['*'])
     * @method Permission firstOrNew(array $attributes = [], array $values = [])
     * @method Permission firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Permission forceCreate(array $attributes)
     * @method _IH_Permission_C|Permission[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Permission_C|Permission[] get(array|string $columns = ['*'])
     * @method Permission getModel()
     * @method Permission[] getModels(array|string $columns = ['*'])
     * @method _IH_Permission_C|Permission[] hydrate(array $items)
     * @method Permission make(array $attributes = [])
     * @method Permission newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Permission[]|_IH_Permission_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Permission[]|_IH_Permission_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Permission sole(array|string $columns = ['*'])
     * @method Permission updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Permission_QB permission(array|Collection|int|Permission1|string $permissions)
     * @method _IH_Permission_QB role(array|Collection|int|Role|string $roles, string $guard = null)
     */
    class _IH_Permission_QB extends _BaseBuilder {}
    
    /**
     * @method Role1|null getOrPut($key, $value)
     * @method Role1|$this shift(int $count = 1)
     * @method Role1|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Role1|$this pop(int $count = 1)
     * @method Role1|null pull($key, $default = null)
     * @method Role1|null last(callable $callback = null, $default = null)
     * @method Role1|$this random(int|null $number = null)
     * @method Role1|null sole($key = null, $operator = null, $value = null)
     * @method Role1|null get($key, $default = null)
     * @method Role1|null first(callable $callback = null, $default = null)
     * @method Role1|null firstWhere(string $key, $operator = null, $value = null)
     * @method Role1|null find($key, $default = null)
     * @method Role1[] all()
     */
    class _IH_Role_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Role1[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method Role1 baseSole(array|string $columns = ['*'])
     * @method Role1 create(array $attributes = [])
     * @method _IH_Role_C|Role1[] cursor()
     * @method Role1|null|_IH_Role_C|Role1[] find($id, array $columns = ['*'])
     * @method _IH_Role_C|Role1[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Role1|_IH_Role_C|Role1[] findOrFail($id, array $columns = ['*'])
     * @method Role1|_IH_Role_C|Role1[] findOrNew($id, array $columns = ['*'])
     * @method Role1 first(array|string $columns = ['*'])
     * @method Role1 firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Role1 firstOrCreate(array $attributes = [], array $values = [])
     * @method Role1 firstOrFail(array $columns = ['*'])
     * @method Role1 firstOrNew(array $attributes = [], array $values = [])
     * @method Role1 firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Role1 forceCreate(array $attributes)
     * @method _IH_Role_C|Role1[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Role_C|Role1[] get(array|string $columns = ['*'])
     * @method Role1 getModel()
     * @method Role1[] getModels(array|string $columns = ['*'])
     * @method _IH_Role_C|Role1[] hydrate(array $items)
     * @method Role1 make(array $attributes = [])
     * @method Role1 newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Role1[]|_IH_Role_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Role1[]|_IH_Role_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Role1 sole(array|string $columns = ['*'])
     * @method Role1 updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Role_QB permission(array|Collection|int|Permission1|string $permissions)
     */
    class _IH_Role_QB extends _BaseBuilder {}
}