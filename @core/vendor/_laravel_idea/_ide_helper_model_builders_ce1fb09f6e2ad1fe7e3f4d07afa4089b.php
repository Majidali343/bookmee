<?php //fb6fe9b03ddd85020a4a0f7d8e6decc6
/** @noinspection all */

namespace LaravelIdea\Helper\Modules\JobPost\Entities {

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Modules\JobPost\Entities\BuyerJob;
    use Modules\JobPost\Entities\JobRequest;
    use Modules\JobPost\Entities\JobRequestConversation;
    use Modules\JobPost\Entities\SellerViewJob;
    
    /**
     * @method BuyerJob|null getOrPut($key, $value)
     * @method BuyerJob|$this shift(int $count = 1)
     * @method BuyerJob|null firstOrFail($key = null, $operator = null, $value = null)
     * @method BuyerJob|$this pop(int $count = 1)
     * @method BuyerJob|null pull($key, $default = null)
     * @method BuyerJob|null last(callable $callback = null, $default = null)
     * @method BuyerJob|$this random(int|null $number = null)
     * @method BuyerJob|null sole($key = null, $operator = null, $value = null)
     * @method BuyerJob|null get($key, $default = null)
     * @method BuyerJob|null first(callable $callback = null, $default = null)
     * @method BuyerJob|null firstWhere(string $key, $operator = null, $value = null)
     * @method BuyerJob|null find($key, $default = null)
     * @method BuyerJob[] all()
     */
    class _IH_BuyerJob_C extends _BaseCollection {
        /**
         * @param int $size
         * @return BuyerJob[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_BuyerJob_QB whereId($value)
     * @method _IH_BuyerJob_QB whereCategoryId($value)
     * @method _IH_BuyerJob_QB whereSubcategoryId($value)
     * @method _IH_BuyerJob_QB whereBuyerId($value)
     * @method _IH_BuyerJob_QB whereCountryId($value)
     * @method _IH_BuyerJob_QB whereCityId($value)
     * @method _IH_BuyerJob_QB whereTitle($value)
     * @method _IH_BuyerJob_QB whereSlug($value)
     * @method _IH_BuyerJob_QB whereDescription($value)
     * @method _IH_BuyerJob_QB whereImage($value)
     * @method _IH_BuyerJob_QB whereStatus($value)
     * @method _IH_BuyerJob_QB whereIsJobOn($value)
     * @method _IH_BuyerJob_QB whereIsJobOnline($value)
     * @method _IH_BuyerJob_QB wherePrice($value)
     * @method _IH_BuyerJob_QB whereView($value)
     * @method _IH_BuyerJob_QB whereDeadLine($value)
     * @method _IH_BuyerJob_QB whereCreatedAt($value)
     * @method _IH_BuyerJob_QB whereUpdatedAt($value)
     * @method BuyerJob baseSole(array|string $columns = ['*'])
     * @method BuyerJob create(array $attributes = [])
     * @method _IH_BuyerJob_C|BuyerJob[] cursor()
     * @method BuyerJob|null|_IH_BuyerJob_C|BuyerJob[] find($id, array $columns = ['*'])
     * @method _IH_BuyerJob_C|BuyerJob[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method BuyerJob|_IH_BuyerJob_C|BuyerJob[] findOrFail($id, array $columns = ['*'])
     * @method BuyerJob|_IH_BuyerJob_C|BuyerJob[] findOrNew($id, array $columns = ['*'])
     * @method BuyerJob first(array|string $columns = ['*'])
     * @method BuyerJob firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method BuyerJob firstOrCreate(array $attributes = [], array $values = [])
     * @method BuyerJob firstOrFail(array $columns = ['*'])
     * @method BuyerJob firstOrNew(array $attributes = [], array $values = [])
     * @method BuyerJob firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method BuyerJob forceCreate(array $attributes)
     * @method _IH_BuyerJob_C|BuyerJob[] fromQuery(string $query, array $bindings = [])
     * @method _IH_BuyerJob_C|BuyerJob[] get(array|string $columns = ['*'])
     * @method BuyerJob getModel()
     * @method BuyerJob[] getModels(array|string $columns = ['*'])
     * @method _IH_BuyerJob_C|BuyerJob[] hydrate(array $items)
     * @method BuyerJob make(array $attributes = [])
     * @method BuyerJob newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|BuyerJob[]|_IH_BuyerJob_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|BuyerJob[]|_IH_BuyerJob_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method BuyerJob sole(array|string $columns = ['*'])
     * @method BuyerJob updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_BuyerJob_QB extends _BaseBuilder {}
    
    /**
     * @method JobRequestConversation|null getOrPut($key, $value)
     * @method JobRequestConversation|$this shift(int $count = 1)
     * @method JobRequestConversation|null firstOrFail($key = null, $operator = null, $value = null)
     * @method JobRequestConversation|$this pop(int $count = 1)
     * @method JobRequestConversation|null pull($key, $default = null)
     * @method JobRequestConversation|null last(callable $callback = null, $default = null)
     * @method JobRequestConversation|$this random(int|null $number = null)
     * @method JobRequestConversation|null sole($key = null, $operator = null, $value = null)
     * @method JobRequestConversation|null get($key, $default = null)
     * @method JobRequestConversation|null first(callable $callback = null, $default = null)
     * @method JobRequestConversation|null firstWhere(string $key, $operator = null, $value = null)
     * @method JobRequestConversation|null find($key, $default = null)
     * @method JobRequestConversation[] all()
     */
    class _IH_JobRequestConversation_C extends _BaseCollection {
        /**
         * @param int $size
         * @return JobRequestConversation[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_JobRequestConversation_QB whereId($value)
     * @method _IH_JobRequestConversation_QB whereMessage($value)
     * @method _IH_JobRequestConversation_QB whereNotify($value)
     * @method _IH_JobRequestConversation_QB whereAttachment($value)
     * @method _IH_JobRequestConversation_QB whereType($value)
     * @method _IH_JobRequestConversation_QB whereJobRequestId($value)
     * @method _IH_JobRequestConversation_QB whereCreatedAt($value)
     * @method _IH_JobRequestConversation_QB whereUpdatedAt($value)
     * @method JobRequestConversation baseSole(array|string $columns = ['*'])
     * @method JobRequestConversation create(array $attributes = [])
     * @method _IH_JobRequestConversation_C|JobRequestConversation[] cursor()
     * @method JobRequestConversation|null|_IH_JobRequestConversation_C|JobRequestConversation[] find($id, array $columns = ['*'])
     * @method _IH_JobRequestConversation_C|JobRequestConversation[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method JobRequestConversation|_IH_JobRequestConversation_C|JobRequestConversation[] findOrFail($id, array $columns = ['*'])
     * @method JobRequestConversation|_IH_JobRequestConversation_C|JobRequestConversation[] findOrNew($id, array $columns = ['*'])
     * @method JobRequestConversation first(array|string $columns = ['*'])
     * @method JobRequestConversation firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method JobRequestConversation firstOrCreate(array $attributes = [], array $values = [])
     * @method JobRequestConversation firstOrFail(array $columns = ['*'])
     * @method JobRequestConversation firstOrNew(array $attributes = [], array $values = [])
     * @method JobRequestConversation firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method JobRequestConversation forceCreate(array $attributes)
     * @method _IH_JobRequestConversation_C|JobRequestConversation[] fromQuery(string $query, array $bindings = [])
     * @method _IH_JobRequestConversation_C|JobRequestConversation[] get(array|string $columns = ['*'])
     * @method JobRequestConversation getModel()
     * @method JobRequestConversation[] getModels(array|string $columns = ['*'])
     * @method _IH_JobRequestConversation_C|JobRequestConversation[] hydrate(array $items)
     * @method JobRequestConversation make(array $attributes = [])
     * @method JobRequestConversation newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|JobRequestConversation[]|_IH_JobRequestConversation_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|JobRequestConversation[]|_IH_JobRequestConversation_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method JobRequestConversation sole(array|string $columns = ['*'])
     * @method JobRequestConversation updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_JobRequestConversation_QB extends _BaseBuilder {}
    
    /**
     * @method JobRequest|null getOrPut($key, $value)
     * @method JobRequest|$this shift(int $count = 1)
     * @method JobRequest|null firstOrFail($key = null, $operator = null, $value = null)
     * @method JobRequest|$this pop(int $count = 1)
     * @method JobRequest|null pull($key, $default = null)
     * @method JobRequest|null last(callable $callback = null, $default = null)
     * @method JobRequest|$this random(int|null $number = null)
     * @method JobRequest|null sole($key = null, $operator = null, $value = null)
     * @method JobRequest|null get($key, $default = null)
     * @method JobRequest|null first(callable $callback = null, $default = null)
     * @method JobRequest|null firstWhere(string $key, $operator = null, $value = null)
     * @method JobRequest|null find($key, $default = null)
     * @method JobRequest[] all()
     */
    class _IH_JobRequest_C extends _BaseCollection {
        /**
         * @param int $size
         * @return JobRequest[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_JobRequest_QB whereId($value)
     * @method _IH_JobRequest_QB whereSellerId($value)
     * @method _IH_JobRequest_QB whereBuyerId($value)
     * @method _IH_JobRequest_QB whereJobPostId($value)
     * @method _IH_JobRequest_QB whereIsHired($value)
     * @method _IH_JobRequest_QB whereExpectedSalary($value)
     * @method _IH_JobRequest_QB whereCoverLetter($value)
     * @method _IH_JobRequest_QB whereCreatedAt($value)
     * @method _IH_JobRequest_QB whereUpdatedAt($value)
     * @method JobRequest baseSole(array|string $columns = ['*'])
     * @method JobRequest create(array $attributes = [])
     * @method _IH_JobRequest_C|JobRequest[] cursor()
     * @method JobRequest|null|_IH_JobRequest_C|JobRequest[] find($id, array $columns = ['*'])
     * @method _IH_JobRequest_C|JobRequest[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method JobRequest|_IH_JobRequest_C|JobRequest[] findOrFail($id, array $columns = ['*'])
     * @method JobRequest|_IH_JobRequest_C|JobRequest[] findOrNew($id, array $columns = ['*'])
     * @method JobRequest first(array|string $columns = ['*'])
     * @method JobRequest firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method JobRequest firstOrCreate(array $attributes = [], array $values = [])
     * @method JobRequest firstOrFail(array $columns = ['*'])
     * @method JobRequest firstOrNew(array $attributes = [], array $values = [])
     * @method JobRequest firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method JobRequest forceCreate(array $attributes)
     * @method _IH_JobRequest_C|JobRequest[] fromQuery(string $query, array $bindings = [])
     * @method _IH_JobRequest_C|JobRequest[] get(array|string $columns = ['*'])
     * @method JobRequest getModel()
     * @method JobRequest[] getModels(array|string $columns = ['*'])
     * @method _IH_JobRequest_C|JobRequest[] hydrate(array $items)
     * @method JobRequest make(array $attributes = [])
     * @method JobRequest newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|JobRequest[]|_IH_JobRequest_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|JobRequest[]|_IH_JobRequest_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method JobRequest sole(array|string $columns = ['*'])
     * @method JobRequest updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_JobRequest_QB extends _BaseBuilder {}
    
    /**
     * @method SellerViewJob|null getOrPut($key, $value)
     * @method SellerViewJob|$this shift(int $count = 1)
     * @method SellerViewJob|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SellerViewJob|$this pop(int $count = 1)
     * @method SellerViewJob|null pull($key, $default = null)
     * @method SellerViewJob|null last(callable $callback = null, $default = null)
     * @method SellerViewJob|$this random(int|null $number = null)
     * @method SellerViewJob|null sole($key = null, $operator = null, $value = null)
     * @method SellerViewJob|null get($key, $default = null)
     * @method SellerViewJob|null first(callable $callback = null, $default = null)
     * @method SellerViewJob|null firstWhere(string $key, $operator = null, $value = null)
     * @method SellerViewJob|null find($key, $default = null)
     * @method SellerViewJob[] all()
     */
    class _IH_SellerViewJob_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SellerViewJob[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SellerViewJob_QB whereId($value)
     * @method _IH_SellerViewJob_QB whereJobPostId($value)
     * @method _IH_SellerViewJob_QB whereSellerId($value)
     * @method _IH_SellerViewJob_QB whereCountryId($value)
     * @method _IH_SellerViewJob_QB whereCreatedAt($value)
     * @method _IH_SellerViewJob_QB whereUpdatedAt($value)
     * @method SellerViewJob baseSole(array|string $columns = ['*'])
     * @method SellerViewJob create(array $attributes = [])
     * @method _IH_SellerViewJob_C|SellerViewJob[] cursor()
     * @method SellerViewJob|null|_IH_SellerViewJob_C|SellerViewJob[] find($id, array $columns = ['*'])
     * @method _IH_SellerViewJob_C|SellerViewJob[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SellerViewJob|_IH_SellerViewJob_C|SellerViewJob[] findOrFail($id, array $columns = ['*'])
     * @method SellerViewJob|_IH_SellerViewJob_C|SellerViewJob[] findOrNew($id, array $columns = ['*'])
     * @method SellerViewJob first(array|string $columns = ['*'])
     * @method SellerViewJob firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SellerViewJob firstOrCreate(array $attributes = [], array $values = [])
     * @method SellerViewJob firstOrFail(array $columns = ['*'])
     * @method SellerViewJob firstOrNew(array $attributes = [], array $values = [])
     * @method SellerViewJob firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SellerViewJob forceCreate(array $attributes)
     * @method _IH_SellerViewJob_C|SellerViewJob[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SellerViewJob_C|SellerViewJob[] get(array|string $columns = ['*'])
     * @method SellerViewJob getModel()
     * @method SellerViewJob[] getModels(array|string $columns = ['*'])
     * @method _IH_SellerViewJob_C|SellerViewJob[] hydrate(array $items)
     * @method SellerViewJob make(array $attributes = [])
     * @method SellerViewJob newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SellerViewJob[]|_IH_SellerViewJob_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SellerViewJob[]|_IH_SellerViewJob_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SellerViewJob sole(array|string $columns = ['*'])
     * @method SellerViewJob updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SellerViewJob_QB extends _BaseBuilder {}
}