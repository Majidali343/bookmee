<?php //1502476033c8589c334c57782e2f8da0
/** @noinspection all */

namespace LaravelIdea\Helper\App {

    use App\Accountdeactive;
    use App\Admin;
    use App\AdminCommission;
    use App\AdminRole;
    use App\AmountSettings;
    use App\Blog;
    use App\BlogComment;
    use App\Brand;
    use App\Category;
    use App\Country;
    use App\DateTime;
    use App\Day;
    use App\ExtraService;
    use App\FormBuilder;
    use App\GalleryCategory;
    use App\HeaderSlider;
    use App\Language;
    use App\Location;
    use App\MediaUpload;
    use App\Menu;
    use App\MetaData;
    use App\OnlineServiceFaq;
    use App\Order;
    use App\OrderAdditional;
    use App\OrderInclude;
    use App\Page;
    use App\PageBuilder;
    use App\PayoutRequest;
    use App\Report;
    use App\Review;
    use App\Schedule;
    use App\SellerVerify;
    use App\Service;
    use App\Serviceadditional;
    use App\ServiceArea;
    use App\Serviceattribute;
    use App\Servicebenifit;
    use App\ServiceCity;
    use App\ServiceCoupon;
    use App\Serviceinclude;
    use App\Slider;
    use App\SocialIcon;
    use App\StaticOption;
    use App\Subcategory;
    use App\SupportTicket;
    use App\SupportTicketMessage;
    use App\Tag;
    use App\Tax;
    use App\ToDoList;
    use App\User;
    use App\Widgets;
    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Collection;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;
    use Spatie\Permission\Contracts\Permission;
    use Spatie\Permission\Contracts\Role;
    
    /**
     * @method Accountdeactive|null getOrPut($key, $value)
     * @method Accountdeactive|$this shift(int $count = 1)
     * @method Accountdeactive|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Accountdeactive|$this pop(int $count = 1)
     * @method Accountdeactive|null pull($key, $default = null)
     * @method Accountdeactive|null last(callable $callback = null, $default = null)
     * @method Accountdeactive|$this random(int|null $number = null)
     * @method Accountdeactive|null sole($key = null, $operator = null, $value = null)
     * @method Accountdeactive|null get($key, $default = null)
     * @method Accountdeactive|null first(callable $callback = null, $default = null)
     * @method Accountdeactive|null firstWhere(string $key, $operator = null, $value = null)
     * @method Accountdeactive|null find($key, $default = null)
     * @method Accountdeactive[] all()
     */
    class _IH_Accountdeactive_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Accountdeactive[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Accountdeactive_QB whereId($value)
     * @method _IH_Accountdeactive_QB whereUserId($value)
     * @method _IH_Accountdeactive_QB whereReason($value)
     * @method _IH_Accountdeactive_QB whereDescription($value)
     * @method _IH_Accountdeactive_QB whereStatus($value)
     * @method _IH_Accountdeactive_QB whereAccountStatus($value)
     * @method _IH_Accountdeactive_QB whereCreatedAt($value)
     * @method _IH_Accountdeactive_QB whereUpdatedAt($value)
     * @method Accountdeactive baseSole(array|string $columns = ['*'])
     * @method Accountdeactive create(array $attributes = [])
     * @method _IH_Accountdeactive_C|Accountdeactive[] cursor()
     * @method Accountdeactive|null|_IH_Accountdeactive_C|Accountdeactive[] find($id, array $columns = ['*'])
     * @method _IH_Accountdeactive_C|Accountdeactive[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Accountdeactive|_IH_Accountdeactive_C|Accountdeactive[] findOrFail($id, array $columns = ['*'])
     * @method Accountdeactive|_IH_Accountdeactive_C|Accountdeactive[] findOrNew($id, array $columns = ['*'])
     * @method Accountdeactive first(array|string $columns = ['*'])
     * @method Accountdeactive firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Accountdeactive firstOrCreate(array $attributes = [], array $values = [])
     * @method Accountdeactive firstOrFail(array $columns = ['*'])
     * @method Accountdeactive firstOrNew(array $attributes = [], array $values = [])
     * @method Accountdeactive firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Accountdeactive forceCreate(array $attributes)
     * @method _IH_Accountdeactive_C|Accountdeactive[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Accountdeactive_C|Accountdeactive[] get(array|string $columns = ['*'])
     * @method Accountdeactive getModel()
     * @method Accountdeactive[] getModels(array|string $columns = ['*'])
     * @method _IH_Accountdeactive_C|Accountdeactive[] hydrate(array $items)
     * @method Accountdeactive make(array $attributes = [])
     * @method Accountdeactive newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Accountdeactive[]|_IH_Accountdeactive_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Accountdeactive[]|_IH_Accountdeactive_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Accountdeactive sole(array|string $columns = ['*'])
     * @method Accountdeactive updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Accountdeactive_QB extends _BaseBuilder {}
    
    /**
     * @method AdminCommission|null getOrPut($key, $value)
     * @method AdminCommission|$this shift(int $count = 1)
     * @method AdminCommission|null firstOrFail($key = null, $operator = null, $value = null)
     * @method AdminCommission|$this pop(int $count = 1)
     * @method AdminCommission|null pull($key, $default = null)
     * @method AdminCommission|null last(callable $callback = null, $default = null)
     * @method AdminCommission|$this random(int|null $number = null)
     * @method AdminCommission|null sole($key = null, $operator = null, $value = null)
     * @method AdminCommission|null get($key, $default = null)
     * @method AdminCommission|null first(callable $callback = null, $default = null)
     * @method AdminCommission|null firstWhere(string $key, $operator = null, $value = null)
     * @method AdminCommission|null find($key, $default = null)
     * @method AdminCommission[] all()
     */
    class _IH_AdminCommission_C extends _BaseCollection {
        /**
         * @param int $size
         * @return AdminCommission[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_AdminCommission_QB whereId($value)
     * @method _IH_AdminCommission_QB whereSystemType($value)
     * @method _IH_AdminCommission_QB whereCommissionChargeFrom($value)
     * @method _IH_AdminCommission_QB whereCommissionChargeType($value)
     * @method _IH_AdminCommission_QB whereCommissionCharge($value)
     * @method _IH_AdminCommission_QB whereCreatedAt($value)
     * @method _IH_AdminCommission_QB whereUpdatedAt($value)
     * @method AdminCommission baseSole(array|string $columns = ['*'])
     * @method AdminCommission create(array $attributes = [])
     * @method _IH_AdminCommission_C|AdminCommission[] cursor()
     * @method AdminCommission|null|_IH_AdminCommission_C|AdminCommission[] find($id, array $columns = ['*'])
     * @method _IH_AdminCommission_C|AdminCommission[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method AdminCommission|_IH_AdminCommission_C|AdminCommission[] findOrFail($id, array $columns = ['*'])
     * @method AdminCommission|_IH_AdminCommission_C|AdminCommission[] findOrNew($id, array $columns = ['*'])
     * @method AdminCommission first(array|string $columns = ['*'])
     * @method AdminCommission firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method AdminCommission firstOrCreate(array $attributes = [], array $values = [])
     * @method AdminCommission firstOrFail(array $columns = ['*'])
     * @method AdminCommission firstOrNew(array $attributes = [], array $values = [])
     * @method AdminCommission firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method AdminCommission forceCreate(array $attributes)
     * @method _IH_AdminCommission_C|AdminCommission[] fromQuery(string $query, array $bindings = [])
     * @method _IH_AdminCommission_C|AdminCommission[] get(array|string $columns = ['*'])
     * @method AdminCommission getModel()
     * @method AdminCommission[] getModels(array|string $columns = ['*'])
     * @method _IH_AdminCommission_C|AdminCommission[] hydrate(array $items)
     * @method AdminCommission make(array $attributes = [])
     * @method AdminCommission newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|AdminCommission[]|_IH_AdminCommission_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|AdminCommission[]|_IH_AdminCommission_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method AdminCommission sole(array|string $columns = ['*'])
     * @method AdminCommission updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_AdminCommission_QB extends _BaseBuilder {}
    
    /**
     * @method AdminRole|null getOrPut($key, $value)
     * @method AdminRole|$this shift(int $count = 1)
     * @method AdminRole|null firstOrFail($key = null, $operator = null, $value = null)
     * @method AdminRole|$this pop(int $count = 1)
     * @method AdminRole|null pull($key, $default = null)
     * @method AdminRole|null last(callable $callback = null, $default = null)
     * @method AdminRole|$this random(int|null $number = null)
     * @method AdminRole|null sole($key = null, $operator = null, $value = null)
     * @method AdminRole|null get($key, $default = null)
     * @method AdminRole|null first(callable $callback = null, $default = null)
     * @method AdminRole|null firstWhere(string $key, $operator = null, $value = null)
     * @method AdminRole|null find($key, $default = null)
     * @method AdminRole[] all()
     */
    class _IH_AdminRole_C extends _BaseCollection {
        /**
         * @param int $size
         * @return AdminRole[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_AdminRole_QB whereId($value)
     * @method _IH_AdminRole_QB whereName($value)
     * @method _IH_AdminRole_QB wherePermission($value)
     * @method _IH_AdminRole_QB whereCreatedAt($value)
     * @method _IH_AdminRole_QB whereUpdatedAt($value)
     * @method AdminRole baseSole(array|string $columns = ['*'])
     * @method AdminRole create(array $attributes = [])
     * @method _IH_AdminRole_C|AdminRole[] cursor()
     * @method AdminRole|null|_IH_AdminRole_C|AdminRole[] find($id, array $columns = ['*'])
     * @method _IH_AdminRole_C|AdminRole[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method AdminRole|_IH_AdminRole_C|AdminRole[] findOrFail($id, array $columns = ['*'])
     * @method AdminRole|_IH_AdminRole_C|AdminRole[] findOrNew($id, array $columns = ['*'])
     * @method AdminRole first(array|string $columns = ['*'])
     * @method AdminRole firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method AdminRole firstOrCreate(array $attributes = [], array $values = [])
     * @method AdminRole firstOrFail(array $columns = ['*'])
     * @method AdminRole firstOrNew(array $attributes = [], array $values = [])
     * @method AdminRole firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method AdminRole forceCreate(array $attributes)
     * @method _IH_AdminRole_C|AdminRole[] fromQuery(string $query, array $bindings = [])
     * @method _IH_AdminRole_C|AdminRole[] get(array|string $columns = ['*'])
     * @method AdminRole getModel()
     * @method AdminRole[] getModels(array|string $columns = ['*'])
     * @method _IH_AdminRole_C|AdminRole[] hydrate(array $items)
     * @method AdminRole make(array $attributes = [])
     * @method AdminRole newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|AdminRole[]|_IH_AdminRole_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|AdminRole[]|_IH_AdminRole_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method AdminRole sole(array|string $columns = ['*'])
     * @method AdminRole updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_AdminRole_QB extends _BaseBuilder {}
    
    /**
     * @method Admin|null getOrPut($key, $value)
     * @method Admin|$this shift(int $count = 1)
     * @method Admin|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Admin|$this pop(int $count = 1)
     * @method Admin|null pull($key, $default = null)
     * @method Admin|null last(callable $callback = null, $default = null)
     * @method Admin|$this random(int|null $number = null)
     * @method Admin|null sole($key = null, $operator = null, $value = null)
     * @method Admin|null get($key, $default = null)
     * @method Admin|null first(callable $callback = null, $default = null)
     * @method Admin|null firstWhere(string $key, $operator = null, $value = null)
     * @method Admin|null find($key, $default = null)
     * @method Admin[] all()
     */
    class _IH_Admin_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Admin[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Admin_QB whereId($value)
     * @method _IH_Admin_QB whereName($value)
     * @method _IH_Admin_QB whereUsername($value)
     * @method _IH_Admin_QB whereEmail($value)
     * @method _IH_Admin_QB whereEmailVerified($value)
     * @method _IH_Admin_QB whereRole($value)
     * @method _IH_Admin_QB whereImage($value)
     * @method _IH_Admin_QB wherePassword($value)
     * @method _IH_Admin_QB whereStatus($value)
     * @method _IH_Admin_QB whereRememberToken($value)
     * @method _IH_Admin_QB whereCreatedAt($value)
     * @method _IH_Admin_QB whereUpdatedAt($value)
     * @method Admin baseSole(array|string $columns = ['*'])
     * @method Admin create(array $attributes = [])
     * @method _IH_Admin_C|Admin[] cursor()
     * @method Admin|null|_IH_Admin_C|Admin[] find($id, array $columns = ['*'])
     * @method _IH_Admin_C|Admin[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Admin|_IH_Admin_C|Admin[] findOrFail($id, array $columns = ['*'])
     * @method Admin|_IH_Admin_C|Admin[] findOrNew($id, array $columns = ['*'])
     * @method Admin first(array|string $columns = ['*'])
     * @method Admin firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Admin firstOrCreate(array $attributes = [], array $values = [])
     * @method Admin firstOrFail(array $columns = ['*'])
     * @method Admin firstOrNew(array $attributes = [], array $values = [])
     * @method Admin firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Admin forceCreate(array $attributes)
     * @method _IH_Admin_C|Admin[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Admin_C|Admin[] get(array|string $columns = ['*'])
     * @method Admin getModel()
     * @method Admin[] getModels(array|string $columns = ['*'])
     * @method _IH_Admin_C|Admin[] hydrate(array $items)
     * @method Admin make(array $attributes = [])
     * @method Admin newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Admin[]|_IH_Admin_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Admin[]|_IH_Admin_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Admin sole(array|string $columns = ['*'])
     * @method Admin updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Admin_QB permission(array|Collection|int|Permission|string $permissions)
     * @method _IH_Admin_QB role(array|Collection|int|Role|string $roles, string $guard = null)
     */
    class _IH_Admin_QB extends _BaseBuilder {}
    
    /**
     * @method AmountSettings|null getOrPut($key, $value)
     * @method AmountSettings|$this shift(int $count = 1)
     * @method AmountSettings|null firstOrFail($key = null, $operator = null, $value = null)
     * @method AmountSettings|$this pop(int $count = 1)
     * @method AmountSettings|null pull($key, $default = null)
     * @method AmountSettings|null last(callable $callback = null, $default = null)
     * @method AmountSettings|$this random(int|null $number = null)
     * @method AmountSettings|null sole($key = null, $operator = null, $value = null)
     * @method AmountSettings|null get($key, $default = null)
     * @method AmountSettings|null first(callable $callback = null, $default = null)
     * @method AmountSettings|null firstWhere(string $key, $operator = null, $value = null)
     * @method AmountSettings|null find($key, $default = null)
     * @method AmountSettings[] all()
     */
    class _IH_AmountSettings_C extends _BaseCollection {
        /**
         * @param int $size
         * @return AmountSettings[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_AmountSettings_QB whereId($value)
     * @method _IH_AmountSettings_QB whereMinAmount($value)
     * @method _IH_AmountSettings_QB whereMaxAmount($value)
     * @method _IH_AmountSettings_QB whereCreatedAt($value)
     * @method _IH_AmountSettings_QB whereUpdatedAt($value)
     * @method AmountSettings baseSole(array|string $columns = ['*'])
     * @method AmountSettings create(array $attributes = [])
     * @method _IH_AmountSettings_C|AmountSettings[] cursor()
     * @method AmountSettings|null|_IH_AmountSettings_C|AmountSettings[] find($id, array $columns = ['*'])
     * @method _IH_AmountSettings_C|AmountSettings[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method AmountSettings|_IH_AmountSettings_C|AmountSettings[] findOrFail($id, array $columns = ['*'])
     * @method AmountSettings|_IH_AmountSettings_C|AmountSettings[] findOrNew($id, array $columns = ['*'])
     * @method AmountSettings first(array|string $columns = ['*'])
     * @method AmountSettings firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method AmountSettings firstOrCreate(array $attributes = [], array $values = [])
     * @method AmountSettings firstOrFail(array $columns = ['*'])
     * @method AmountSettings firstOrNew(array $attributes = [], array $values = [])
     * @method AmountSettings firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method AmountSettings forceCreate(array $attributes)
     * @method _IH_AmountSettings_C|AmountSettings[] fromQuery(string $query, array $bindings = [])
     * @method _IH_AmountSettings_C|AmountSettings[] get(array|string $columns = ['*'])
     * @method AmountSettings getModel()
     * @method AmountSettings[] getModels(array|string $columns = ['*'])
     * @method _IH_AmountSettings_C|AmountSettings[] hydrate(array $items)
     * @method AmountSettings make(array $attributes = [])
     * @method AmountSettings newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|AmountSettings[]|_IH_AmountSettings_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|AmountSettings[]|_IH_AmountSettings_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method AmountSettings sole(array|string $columns = ['*'])
     * @method AmountSettings updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_AmountSettings_QB extends _BaseBuilder {}
    
    /**
     * @method BlogComment|null getOrPut($key, $value)
     * @method BlogComment|$this shift(int $count = 1)
     * @method BlogComment|null firstOrFail($key = null, $operator = null, $value = null)
     * @method BlogComment|$this pop(int $count = 1)
     * @method BlogComment|null pull($key, $default = null)
     * @method BlogComment|null last(callable $callback = null, $default = null)
     * @method BlogComment|$this random(int|null $number = null)
     * @method BlogComment|null sole($key = null, $operator = null, $value = null)
     * @method BlogComment|null get($key, $default = null)
     * @method BlogComment|null first(callable $callback = null, $default = null)
     * @method BlogComment|null firstWhere(string $key, $operator = null, $value = null)
     * @method BlogComment|null find($key, $default = null)
     * @method BlogComment[] all()
     */
    class _IH_BlogComment_C extends _BaseCollection {
        /**
         * @param int $size
         * @return BlogComment[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_BlogComment_QB whereId($value)
     * @method _IH_BlogComment_QB whereBlogId($value)
     * @method _IH_BlogComment_QB whereUserId($value)
     * @method _IH_BlogComment_QB whereName($value)
     * @method _IH_BlogComment_QB whereEmail($value)
     * @method _IH_BlogComment_QB whereMessage($value)
     * @method _IH_BlogComment_QB whereCreatedAt($value)
     * @method _IH_BlogComment_QB whereUpdatedAt($value)
     * @method _IH_BlogComment_QB whereParentId($value)
     * @method _IH_BlogComment_QB whereType($value)
     * @method BlogComment baseSole(array|string $columns = ['*'])
     * @method BlogComment create(array $attributes = [])
     * @method _IH_BlogComment_C|BlogComment[] cursor()
     * @method BlogComment|null|_IH_BlogComment_C|BlogComment[] find($id, array $columns = ['*'])
     * @method _IH_BlogComment_C|BlogComment[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method BlogComment|_IH_BlogComment_C|BlogComment[] findOrFail($id, array $columns = ['*'])
     * @method BlogComment|_IH_BlogComment_C|BlogComment[] findOrNew($id, array $columns = ['*'])
     * @method BlogComment first(array|string $columns = ['*'])
     * @method BlogComment firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method BlogComment firstOrCreate(array $attributes = [], array $values = [])
     * @method BlogComment firstOrFail(array $columns = ['*'])
     * @method BlogComment firstOrNew(array $attributes = [], array $values = [])
     * @method BlogComment firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method BlogComment forceCreate(array $attributes)
     * @method _IH_BlogComment_C|BlogComment[] fromQuery(string $query, array $bindings = [])
     * @method _IH_BlogComment_C|BlogComment[] get(array|string $columns = ['*'])
     * @method BlogComment getModel()
     * @method BlogComment[] getModels(array|string $columns = ['*'])
     * @method _IH_BlogComment_C|BlogComment[] hydrate(array $items)
     * @method BlogComment make(array $attributes = [])
     * @method BlogComment newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|BlogComment[]|_IH_BlogComment_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|BlogComment[]|_IH_BlogComment_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method BlogComment sole(array|string $columns = ['*'])
     * @method BlogComment updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_BlogComment_QB extends _BaseBuilder {}
    
    /**
     * @method Blog|null getOrPut($key, $value)
     * @method Blog|$this shift(int $count = 1)
     * @method Blog|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Blog|$this pop(int $count = 1)
     * @method Blog|null pull($key, $default = null)
     * @method Blog|null last(callable $callback = null, $default = null)
     * @method Blog|$this random(int|null $number = null)
     * @method Blog|null sole($key = null, $operator = null, $value = null)
     * @method Blog|null get($key, $default = null)
     * @method Blog|null first(callable $callback = null, $default = null)
     * @method Blog|null firstWhere(string $key, $operator = null, $value = null)
     * @method Blog|null find($key, $default = null)
     * @method Blog[] all()
     */
    class _IH_Blog_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Blog[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Blog_QB whereId($value)
     * @method _IH_Blog_QB whereCategoryId($value)
     * @method _IH_Blog_QB whereUserId($value)
     * @method _IH_Blog_QB whereTitle($value)
     * @method _IH_Blog_QB whereSlug($value)
     * @method _IH_Blog_QB whereBlogContent($value)
     * @method _IH_Blog_QB whereImage($value)
     * @method _IH_Blog_QB whereAuthor($value)
     * @method _IH_Blog_QB whereExcerpt($value)
     * @method _IH_Blog_QB whereViews($value)
     * @method _IH_Blog_QB whereVisibility($value)
     * @method _IH_Blog_QB whereFeatured($value)
     * @method _IH_Blog_QB whereScheduleDate($value)
     * @method _IH_Blog_QB whereTagName($value)
     * @method _IH_Blog_QB whereCreatedAt($value)
     * @method _IH_Blog_QB whereUpdatedAt($value)
     * @method _IH_Blog_QB whereDeletedAt($value)
     * @method _IH_Blog_QB whereStatus($value)
     * @method _IH_Blog_QB whereTagId($value)
     * @method Blog baseSole(array|string $columns = ['*'])
     * @method Blog create(array $attributes = [])
     * @method _IH_Blog_C|Blog[] cursor()
     * @method Blog|null|_IH_Blog_C|Blog[] find($id, array $columns = ['*'])
     * @method _IH_Blog_C|Blog[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Blog|_IH_Blog_C|Blog[] findOrFail($id, array $columns = ['*'])
     * @method Blog|_IH_Blog_C|Blog[] findOrNew($id, array $columns = ['*'])
     * @method Blog first(array|string $columns = ['*'])
     * @method Blog firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Blog firstOrCreate(array $attributes = [], array $values = [])
     * @method Blog firstOrFail(array $columns = ['*'])
     * @method Blog firstOrNew(array $attributes = [], array $values = [])
     * @method Blog firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Blog forceCreate(array $attributes)
     * @method _IH_Blog_C|Blog[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Blog_C|Blog[] get(array|string $columns = ['*'])
     * @method Blog getModel()
     * @method Blog[] getModels(array|string $columns = ['*'])
     * @method _IH_Blog_C|Blog[] hydrate(array $items)
     * @method Blog make(array $attributes = [])
     * @method Blog newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Blog[]|_IH_Blog_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Blog[]|_IH_Blog_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Blog sole(array|string $columns = ['*'])
     * @method Blog updateOrCreate(array $attributes, array $values = [])
     * @method _IH_Blog_QB withTrashed()
     * @method _IH_Blog_QB onlyTrashed()
     * @method _IH_Blog_QB withoutTrashed()
     * @method _IH_Blog_QB restore()
     */
    class _IH_Blog_QB extends _BaseBuilder {}
    
    /**
     * @method Brand|null getOrPut($key, $value)
     * @method Brand|$this shift(int $count = 1)
     * @method Brand|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Brand|$this pop(int $count = 1)
     * @method Brand|null pull($key, $default = null)
     * @method Brand|null last(callable $callback = null, $default = null)
     * @method Brand|$this random(int|null $number = null)
     * @method Brand|null sole($key = null, $operator = null, $value = null)
     * @method Brand|null get($key, $default = null)
     * @method Brand|null first(callable $callback = null, $default = null)
     * @method Brand|null firstWhere(string $key, $operator = null, $value = null)
     * @method Brand|null find($key, $default = null)
     * @method Brand[] all()
     */
    class _IH_Brand_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Brand[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Brand_QB whereId($value)
     * @method _IH_Brand_QB whereTitle($value)
     * @method _IH_Brand_QB whereUrl($value)
     * @method _IH_Brand_QB whereImage($value)
     * @method _IH_Brand_QB whereCreatedAt($value)
     * @method _IH_Brand_QB whereUpdatedAt($value)
     * @method Brand baseSole(array|string $columns = ['*'])
     * @method Brand create(array $attributes = [])
     * @method _IH_Brand_C|Brand[] cursor()
     * @method Brand|null|_IH_Brand_C|Brand[] find($id, array $columns = ['*'])
     * @method _IH_Brand_C|Brand[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Brand|_IH_Brand_C|Brand[] findOrFail($id, array $columns = ['*'])
     * @method Brand|_IH_Brand_C|Brand[] findOrNew($id, array $columns = ['*'])
     * @method Brand first(array|string $columns = ['*'])
     * @method Brand firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Brand firstOrCreate(array $attributes = [], array $values = [])
     * @method Brand firstOrFail(array $columns = ['*'])
     * @method Brand firstOrNew(array $attributes = [], array $values = [])
     * @method Brand firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Brand forceCreate(array $attributes)
     * @method _IH_Brand_C|Brand[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Brand_C|Brand[] get(array|string $columns = ['*'])
     * @method Brand getModel()
     * @method Brand[] getModels(array|string $columns = ['*'])
     * @method _IH_Brand_C|Brand[] hydrate(array $items)
     * @method Brand make(array $attributes = [])
     * @method Brand newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Brand[]|_IH_Brand_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Brand[]|_IH_Brand_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Brand sole(array|string $columns = ['*'])
     * @method Brand updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Brand_QB extends _BaseBuilder {}
    
    /**
     * @method Category|null getOrPut($key, $value)
     * @method Category|$this shift(int $count = 1)
     * @method Category|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Category|$this pop(int $count = 1)
     * @method Category|null pull($key, $default = null)
     * @method Category|null last(callable $callback = null, $default = null)
     * @method Category|$this random(int|null $number = null)
     * @method Category|null sole($key = null, $operator = null, $value = null)
     * @method Category|null get($key, $default = null)
     * @method Category|null first(callable $callback = null, $default = null)
     * @method Category|null firstWhere(string $key, $operator = null, $value = null)
     * @method Category|null find($key, $default = null)
     * @method Category[] all()
     */
    class _IH_Category_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Category[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Category_QB whereId($value)
     * @method _IH_Category_QB whereName($value)
     * @method _IH_Category_QB whereSlug($value)
     * @method _IH_Category_QB whereIcon($value)
     * @method _IH_Category_QB whereImage($value)
     * @method _IH_Category_QB whereStatus($value)
     * @method _IH_Category_QB whereCreatedAt($value)
     * @method _IH_Category_QB whereUpdatedAt($value)
     * @method _IH_Category_QB whereMobileIcon($value)
     * @method Category baseSole(array|string $columns = ['*'])
     * @method Category create(array $attributes = [])
     * @method _IH_Category_C|Category[] cursor()
     * @method Category|null|_IH_Category_C|Category[] find($id, array $columns = ['*'])
     * @method _IH_Category_C|Category[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Category|_IH_Category_C|Category[] findOrFail($id, array $columns = ['*'])
     * @method Category|_IH_Category_C|Category[] findOrNew($id, array $columns = ['*'])
     * @method Category first(array|string $columns = ['*'])
     * @method Category firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Category firstOrCreate(array $attributes = [], array $values = [])
     * @method Category firstOrFail(array $columns = ['*'])
     * @method Category firstOrNew(array $attributes = [], array $values = [])
     * @method Category firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Category forceCreate(array $attributes)
     * @method _IH_Category_C|Category[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Category_C|Category[] get(array|string $columns = ['*'])
     * @method Category getModel()
     * @method Category[] getModels(array|string $columns = ['*'])
     * @method _IH_Category_C|Category[] hydrate(array $items)
     * @method Category make(array $attributes = [])
     * @method Category newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Category[]|_IH_Category_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Category[]|_IH_Category_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Category sole(array|string $columns = ['*'])
     * @method Category updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Category_QB extends _BaseBuilder {}
    
    /**
     * @method Country|null getOrPut($key, $value)
     * @method Country|$this shift(int $count = 1)
     * @method Country|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Country|$this pop(int $count = 1)
     * @method Country|null pull($key, $default = null)
     * @method Country|null last(callable $callback = null, $default = null)
     * @method Country|$this random(int|null $number = null)
     * @method Country|null sole($key = null, $operator = null, $value = null)
     * @method Country|null get($key, $default = null)
     * @method Country|null first(callable $callback = null, $default = null)
     * @method Country|null firstWhere(string $key, $operator = null, $value = null)
     * @method Country|null find($key, $default = null)
     * @method Country[] all()
     */
    class _IH_Country_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Country[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Country_QB whereId($value)
     * @method _IH_Country_QB whereCountry($value)
     * @method _IH_Country_QB whereStatus($value)
     * @method _IH_Country_QB whereCreatedAt($value)
     * @method _IH_Country_QB whereUpdatedAt($value)
     * @method Country baseSole(array|string $columns = ['*'])
     * @method Country create(array $attributes = [])
     * @method _IH_Country_C|Country[] cursor()
     * @method Country|null|_IH_Country_C|Country[] find($id, array $columns = ['*'])
     * @method _IH_Country_C|Country[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Country|_IH_Country_C|Country[] findOrFail($id, array $columns = ['*'])
     * @method Country|_IH_Country_C|Country[] findOrNew($id, array $columns = ['*'])
     * @method Country first(array|string $columns = ['*'])
     * @method Country firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Country firstOrCreate(array $attributes = [], array $values = [])
     * @method Country firstOrFail(array $columns = ['*'])
     * @method Country firstOrNew(array $attributes = [], array $values = [])
     * @method Country firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Country forceCreate(array $attributes)
     * @method _IH_Country_C|Country[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Country_C|Country[] get(array|string $columns = ['*'])
     * @method Country getModel()
     * @method Country[] getModels(array|string $columns = ['*'])
     * @method _IH_Country_C|Country[] hydrate(array $items)
     * @method Country make(array $attributes = [])
     * @method Country newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Country[]|_IH_Country_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Country[]|_IH_Country_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Country sole(array|string $columns = ['*'])
     * @method Country updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Country_QB extends _BaseBuilder {}
    
    /**
     * @method DateTime|null getOrPut($key, $value)
     * @method DateTime|$this shift(int $count = 1)
     * @method DateTime|null firstOrFail($key = null, $operator = null, $value = null)
     * @method DateTime|$this pop(int $count = 1)
     * @method DateTime|null pull($key, $default = null)
     * @method DateTime|null last(callable $callback = null, $default = null)
     * @method DateTime|$this random(int|null $number = null)
     * @method DateTime|null sole($key = null, $operator = null, $value = null)
     * @method DateTime|null get($key, $default = null)
     * @method DateTime|null first(callable $callback = null, $default = null)
     * @method DateTime|null firstWhere(string $key, $operator = null, $value = null)
     * @method DateTime|null find($key, $default = null)
     * @method DateTime[] all()
     */
    class _IH_DateTime_C extends _BaseCollection {
        /**
         * @param int $size
         * @return DateTime[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method DateTime baseSole(array|string $columns = ['*'])
     * @method DateTime create(array $attributes = [])
     * @method _IH_DateTime_C|DateTime[] cursor()
     * @method DateTime|null|_IH_DateTime_C|DateTime[] find($id, array $columns = ['*'])
     * @method _IH_DateTime_C|DateTime[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method DateTime|_IH_DateTime_C|DateTime[] findOrFail($id, array $columns = ['*'])
     * @method DateTime|_IH_DateTime_C|DateTime[] findOrNew($id, array $columns = ['*'])
     * @method DateTime first(array|string $columns = ['*'])
     * @method DateTime firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method DateTime firstOrCreate(array $attributes = [], array $values = [])
     * @method DateTime firstOrFail(array $columns = ['*'])
     * @method DateTime firstOrNew(array $attributes = [], array $values = [])
     * @method DateTime firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method DateTime forceCreate(array $attributes)
     * @method _IH_DateTime_C|DateTime[] fromQuery(string $query, array $bindings = [])
     * @method _IH_DateTime_C|DateTime[] get(array|string $columns = ['*'])
     * @method DateTime getModel()
     * @method DateTime[] getModels(array|string $columns = ['*'])
     * @method _IH_DateTime_C|DateTime[] hydrate(array $items)
     * @method DateTime make(array $attributes = [])
     * @method DateTime newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|DateTime[]|_IH_DateTime_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|DateTime[]|_IH_DateTime_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method DateTime sole(array|string $columns = ['*'])
     * @method DateTime updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_DateTime_QB extends _BaseBuilder {}
    
    /**
     * @method Day|null getOrPut($key, $value)
     * @method Day|$this shift(int $count = 1)
     * @method Day|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Day|$this pop(int $count = 1)
     * @method Day|null pull($key, $default = null)
     * @method Day|null last(callable $callback = null, $default = null)
     * @method Day|$this random(int|null $number = null)
     * @method Day|null sole($key = null, $operator = null, $value = null)
     * @method Day|null get($key, $default = null)
     * @method Day|null first(callable $callback = null, $default = null)
     * @method Day|null firstWhere(string $key, $operator = null, $value = null)
     * @method Day|null find($key, $default = null)
     * @method Day[] all()
     */
    class _IH_Day_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Day[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Day_QB whereId($value)
     * @method _IH_Day_QB whereDay($value)
     * @method _IH_Day_QB whereStatus($value)
     * @method _IH_Day_QB whereSellerId($value)
     * @method _IH_Day_QB whereTotalDay($value)
     * @method _IH_Day_QB whereCreatedAt($value)
     * @method _IH_Day_QB whereUpdatedAt($value)
     * @method Day baseSole(array|string $columns = ['*'])
     * @method Day create(array $attributes = [])
     * @method _IH_Day_C|Day[] cursor()
     * @method Day|null|_IH_Day_C|Day[] find($id, array $columns = ['*'])
     * @method _IH_Day_C|Day[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Day|_IH_Day_C|Day[] findOrFail($id, array $columns = ['*'])
     * @method Day|_IH_Day_C|Day[] findOrNew($id, array $columns = ['*'])
     * @method Day first(array|string $columns = ['*'])
     * @method Day firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Day firstOrCreate(array $attributes = [], array $values = [])
     * @method Day firstOrFail(array $columns = ['*'])
     * @method Day firstOrNew(array $attributes = [], array $values = [])
     * @method Day firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Day forceCreate(array $attributes)
     * @method _IH_Day_C|Day[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Day_C|Day[] get(array|string $columns = ['*'])
     * @method Day getModel()
     * @method Day[] getModels(array|string $columns = ['*'])
     * @method _IH_Day_C|Day[] hydrate(array $items)
     * @method Day make(array $attributes = [])
     * @method Day newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Day[]|_IH_Day_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Day[]|_IH_Day_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Day sole(array|string $columns = ['*'])
     * @method Day updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Day_QB extends _BaseBuilder {}
    
    /**
     * @method ExtraService|null getOrPut($key, $value)
     * @method ExtraService|$this shift(int $count = 1)
     * @method ExtraService|null firstOrFail($key = null, $operator = null, $value = null)
     * @method ExtraService|$this pop(int $count = 1)
     * @method ExtraService|null pull($key, $default = null)
     * @method ExtraService|null last(callable $callback = null, $default = null)
     * @method ExtraService|$this random(int|null $number = null)
     * @method ExtraService|null sole($key = null, $operator = null, $value = null)
     * @method ExtraService|null get($key, $default = null)
     * @method ExtraService|null first(callable $callback = null, $default = null)
     * @method ExtraService|null firstWhere(string $key, $operator = null, $value = null)
     * @method ExtraService|null find($key, $default = null)
     * @method ExtraService[] all()
     */
    class _IH_ExtraService_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ExtraService[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_ExtraService_QB whereId($value)
     * @method _IH_ExtraService_QB whereOrderId($value)
     * @method _IH_ExtraService_QB whereTitle($value)
     * @method _IH_ExtraService_QB whereQuantity($value)
     * @method _IH_ExtraService_QB wherePrice($value)
     * @method _IH_ExtraService_QB wherePaymentGateway($value)
     * @method _IH_ExtraService_QB whereManualPaymentGatewayImage($value)
     * @method _IH_ExtraService_QB whereTax($value)
     * @method _IH_ExtraService_QB whereCommissionAmount($value)
     * @method _IH_ExtraService_QB whereSubTotal($value)
     * @method _IH_ExtraService_QB whereTotal($value)
     * @method _IH_ExtraService_QB whereTransactionId($value)
     * @method _IH_ExtraService_QB wherePaymentStatus($value)
     * @method _IH_ExtraService_QB whereStatus($value)
     * @method _IH_ExtraService_QB whereCreatedAt($value)
     * @method _IH_ExtraService_QB whereUpdatedAt($value)
     * @method ExtraService baseSole(array|string $columns = ['*'])
     * @method ExtraService create(array $attributes = [])
     * @method _IH_ExtraService_C|ExtraService[] cursor()
     * @method ExtraService|null|_IH_ExtraService_C|ExtraService[] find($id, array $columns = ['*'])
     * @method _IH_ExtraService_C|ExtraService[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method ExtraService|_IH_ExtraService_C|ExtraService[] findOrFail($id, array $columns = ['*'])
     * @method ExtraService|_IH_ExtraService_C|ExtraService[] findOrNew($id, array $columns = ['*'])
     * @method ExtraService first(array|string $columns = ['*'])
     * @method ExtraService firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method ExtraService firstOrCreate(array $attributes = [], array $values = [])
     * @method ExtraService firstOrFail(array $columns = ['*'])
     * @method ExtraService firstOrNew(array $attributes = [], array $values = [])
     * @method ExtraService firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ExtraService forceCreate(array $attributes)
     * @method _IH_ExtraService_C|ExtraService[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ExtraService_C|ExtraService[] get(array|string $columns = ['*'])
     * @method ExtraService getModel()
     * @method ExtraService[] getModels(array|string $columns = ['*'])
     * @method _IH_ExtraService_C|ExtraService[] hydrate(array $items)
     * @method ExtraService make(array $attributes = [])
     * @method ExtraService newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ExtraService[]|_IH_ExtraService_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ExtraService[]|_IH_ExtraService_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ExtraService sole(array|string $columns = ['*'])
     * @method ExtraService updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_ExtraService_QB extends _BaseBuilder {}
    
    /**
     * @method FormBuilder|null getOrPut($key, $value)
     * @method FormBuilder|$this shift(int $count = 1)
     * @method FormBuilder|null firstOrFail($key = null, $operator = null, $value = null)
     * @method FormBuilder|$this pop(int $count = 1)
     * @method FormBuilder|null pull($key, $default = null)
     * @method FormBuilder|null last(callable $callback = null, $default = null)
     * @method FormBuilder|$this random(int|null $number = null)
     * @method FormBuilder|null sole($key = null, $operator = null, $value = null)
     * @method FormBuilder|null get($key, $default = null)
     * @method FormBuilder|null first(callable $callback = null, $default = null)
     * @method FormBuilder|null firstWhere(string $key, $operator = null, $value = null)
     * @method FormBuilder|null find($key, $default = null)
     * @method FormBuilder[] all()
     */
    class _IH_FormBuilder_C extends _BaseCollection {
        /**
         * @param int $size
         * @return FormBuilder[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_FormBuilder_QB whereId($value)
     * @method _IH_FormBuilder_QB whereTitle($value)
     * @method _IH_FormBuilder_QB whereEmail($value)
     * @method _IH_FormBuilder_QB whereButtonText($value)
     * @method _IH_FormBuilder_QB whereFields($value)
     * @method _IH_FormBuilder_QB whereSuccessMessage($value)
     * @method _IH_FormBuilder_QB whereCreatedAt($value)
     * @method _IH_FormBuilder_QB whereUpdatedAt($value)
     * @method FormBuilder baseSole(array|string $columns = ['*'])
     * @method FormBuilder create(array $attributes = [])
     * @method _IH_FormBuilder_C|FormBuilder[] cursor()
     * @method FormBuilder|null|_IH_FormBuilder_C|FormBuilder[] find($id, array $columns = ['*'])
     * @method _IH_FormBuilder_C|FormBuilder[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method FormBuilder|_IH_FormBuilder_C|FormBuilder[] findOrFail($id, array $columns = ['*'])
     * @method FormBuilder|_IH_FormBuilder_C|FormBuilder[] findOrNew($id, array $columns = ['*'])
     * @method FormBuilder first(array|string $columns = ['*'])
     * @method FormBuilder firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method FormBuilder firstOrCreate(array $attributes = [], array $values = [])
     * @method FormBuilder firstOrFail(array $columns = ['*'])
     * @method FormBuilder firstOrNew(array $attributes = [], array $values = [])
     * @method FormBuilder firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method FormBuilder forceCreate(array $attributes)
     * @method _IH_FormBuilder_C|FormBuilder[] fromQuery(string $query, array $bindings = [])
     * @method _IH_FormBuilder_C|FormBuilder[] get(array|string $columns = ['*'])
     * @method FormBuilder getModel()
     * @method FormBuilder[] getModels(array|string $columns = ['*'])
     * @method _IH_FormBuilder_C|FormBuilder[] hydrate(array $items)
     * @method FormBuilder make(array $attributes = [])
     * @method FormBuilder newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|FormBuilder[]|_IH_FormBuilder_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|FormBuilder[]|_IH_FormBuilder_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method FormBuilder sole(array|string $columns = ['*'])
     * @method FormBuilder updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_FormBuilder_QB extends _BaseBuilder {}
    
    /**
     * @method GalleryCategory|null getOrPut($key, $value)
     * @method GalleryCategory|$this shift(int $count = 1)
     * @method GalleryCategory|null firstOrFail($key = null, $operator = null, $value = null)
     * @method GalleryCategory|$this pop(int $count = 1)
     * @method GalleryCategory|null pull($key, $default = null)
     * @method GalleryCategory|null last(callable $callback = null, $default = null)
     * @method GalleryCategory|$this random(int|null $number = null)
     * @method GalleryCategory|null sole($key = null, $operator = null, $value = null)
     * @method GalleryCategory|null get($key, $default = null)
     * @method GalleryCategory|null first(callable $callback = null, $default = null)
     * @method GalleryCategory|null firstWhere(string $key, $operator = null, $value = null)
     * @method GalleryCategory|null find($key, $default = null)
     * @method GalleryCategory[] all()
     */
    class _IH_GalleryCategory_C extends _BaseCollection {
        /**
         * @param int $size
         * @return GalleryCategory[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method GalleryCategory baseSole(array|string $columns = ['*'])
     * @method GalleryCategory create(array $attributes = [])
     * @method _IH_GalleryCategory_C|GalleryCategory[] cursor()
     * @method GalleryCategory|null|_IH_GalleryCategory_C|GalleryCategory[] find($id, array $columns = ['*'])
     * @method _IH_GalleryCategory_C|GalleryCategory[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method GalleryCategory|_IH_GalleryCategory_C|GalleryCategory[] findOrFail($id, array $columns = ['*'])
     * @method GalleryCategory|_IH_GalleryCategory_C|GalleryCategory[] findOrNew($id, array $columns = ['*'])
     * @method GalleryCategory first(array|string $columns = ['*'])
     * @method GalleryCategory firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method GalleryCategory firstOrCreate(array $attributes = [], array $values = [])
     * @method GalleryCategory firstOrFail(array $columns = ['*'])
     * @method GalleryCategory firstOrNew(array $attributes = [], array $values = [])
     * @method GalleryCategory firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method GalleryCategory forceCreate(array $attributes)
     * @method _IH_GalleryCategory_C|GalleryCategory[] fromQuery(string $query, array $bindings = [])
     * @method _IH_GalleryCategory_C|GalleryCategory[] get(array|string $columns = ['*'])
     * @method GalleryCategory getModel()
     * @method GalleryCategory[] getModels(array|string $columns = ['*'])
     * @method _IH_GalleryCategory_C|GalleryCategory[] hydrate(array $items)
     * @method GalleryCategory make(array $attributes = [])
     * @method GalleryCategory newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|GalleryCategory[]|_IH_GalleryCategory_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|GalleryCategory[]|_IH_GalleryCategory_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method GalleryCategory sole(array|string $columns = ['*'])
     * @method GalleryCategory updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_GalleryCategory_QB extends _BaseBuilder {}
    
    /**
     * @method HeaderSlider|null getOrPut($key, $value)
     * @method HeaderSlider|$this shift(int $count = 1)
     * @method HeaderSlider|null firstOrFail($key = null, $operator = null, $value = null)
     * @method HeaderSlider|$this pop(int $count = 1)
     * @method HeaderSlider|null pull($key, $default = null)
     * @method HeaderSlider|null last(callable $callback = null, $default = null)
     * @method HeaderSlider|$this random(int|null $number = null)
     * @method HeaderSlider|null sole($key = null, $operator = null, $value = null)
     * @method HeaderSlider|null get($key, $default = null)
     * @method HeaderSlider|null first(callable $callback = null, $default = null)
     * @method HeaderSlider|null firstWhere(string $key, $operator = null, $value = null)
     * @method HeaderSlider|null find($key, $default = null)
     * @method HeaderSlider[] all()
     */
    class _IH_HeaderSlider_C extends _BaseCollection {
        /**
         * @param int $size
         * @return HeaderSlider[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_HeaderSlider_QB whereId($value)
     * @method _IH_HeaderSlider_QB whereTitle($value)
     * @method _IH_HeaderSlider_QB whereBtnText($value)
     * @method _IH_HeaderSlider_QB whereBtnUrl($value)
     * @method _IH_HeaderSlider_QB whereBtnStatus($value)
     * @method _IH_HeaderSlider_QB whereImage($value)
     * @method _IH_HeaderSlider_QB whereCreatedAt($value)
     * @method _IH_HeaderSlider_QB whereUpdatedAt($value)
     * @method HeaderSlider baseSole(array|string $columns = ['*'])
     * @method HeaderSlider create(array $attributes = [])
     * @method _IH_HeaderSlider_C|HeaderSlider[] cursor()
     * @method HeaderSlider|null|_IH_HeaderSlider_C|HeaderSlider[] find($id, array $columns = ['*'])
     * @method _IH_HeaderSlider_C|HeaderSlider[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method HeaderSlider|_IH_HeaderSlider_C|HeaderSlider[] findOrFail($id, array $columns = ['*'])
     * @method HeaderSlider|_IH_HeaderSlider_C|HeaderSlider[] findOrNew($id, array $columns = ['*'])
     * @method HeaderSlider first(array|string $columns = ['*'])
     * @method HeaderSlider firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method HeaderSlider firstOrCreate(array $attributes = [], array $values = [])
     * @method HeaderSlider firstOrFail(array $columns = ['*'])
     * @method HeaderSlider firstOrNew(array $attributes = [], array $values = [])
     * @method HeaderSlider firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method HeaderSlider forceCreate(array $attributes)
     * @method _IH_HeaderSlider_C|HeaderSlider[] fromQuery(string $query, array $bindings = [])
     * @method _IH_HeaderSlider_C|HeaderSlider[] get(array|string $columns = ['*'])
     * @method HeaderSlider getModel()
     * @method HeaderSlider[] getModels(array|string $columns = ['*'])
     * @method _IH_HeaderSlider_C|HeaderSlider[] hydrate(array $items)
     * @method HeaderSlider make(array $attributes = [])
     * @method HeaderSlider newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|HeaderSlider[]|_IH_HeaderSlider_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|HeaderSlider[]|_IH_HeaderSlider_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method HeaderSlider sole(array|string $columns = ['*'])
     * @method HeaderSlider updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_HeaderSlider_QB extends _BaseBuilder {}
    
    /**
     * @method Language|null getOrPut($key, $value)
     * @method Language|$this shift(int $count = 1)
     * @method Language|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Language|$this pop(int $count = 1)
     * @method Language|null pull($key, $default = null)
     * @method Language|null last(callable $callback = null, $default = null)
     * @method Language|$this random(int|null $number = null)
     * @method Language|null sole($key = null, $operator = null, $value = null)
     * @method Language|null get($key, $default = null)
     * @method Language|null first(callable $callback = null, $default = null)
     * @method Language|null firstWhere(string $key, $operator = null, $value = null)
     * @method Language|null find($key, $default = null)
     * @method Language[] all()
     */
    class _IH_Language_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Language[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Language_QB whereId($value)
     * @method _IH_Language_QB whereName($value)
     * @method _IH_Language_QB whereSlug($value)
     * @method _IH_Language_QB whereDirection($value)
     * @method _IH_Language_QB whereStatus($value)
     * @method _IH_Language_QB whereDefault($value)
     * @method _IH_Language_QB whereCreatedAt($value)
     * @method _IH_Language_QB whereUpdatedAt($value)
     * @method Language baseSole(array|string $columns = ['*'])
     * @method Language create(array $attributes = [])
     * @method _IH_Language_C|Language[] cursor()
     * @method Language|null|_IH_Language_C|Language[] find($id, array $columns = ['*'])
     * @method _IH_Language_C|Language[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Language|_IH_Language_C|Language[] findOrFail($id, array $columns = ['*'])
     * @method Language|_IH_Language_C|Language[] findOrNew($id, array $columns = ['*'])
     * @method Language first(array|string $columns = ['*'])
     * @method Language firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Language firstOrCreate(array $attributes = [], array $values = [])
     * @method Language firstOrFail(array $columns = ['*'])
     * @method Language firstOrNew(array $attributes = [], array $values = [])
     * @method Language firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Language forceCreate(array $attributes)
     * @method _IH_Language_C|Language[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Language_C|Language[] get(array|string $columns = ['*'])
     * @method Language getModel()
     * @method Language[] getModels(array|string $columns = ['*'])
     * @method _IH_Language_C|Language[] hydrate(array $items)
     * @method Language make(array $attributes = [])
     * @method Language newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Language[]|_IH_Language_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Language[]|_IH_Language_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Language sole(array|string $columns = ['*'])
     * @method Language updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Language_QB extends _BaseBuilder {}
    
    /**
     * @method Location|null getOrPut($key, $value)
     * @method Location|$this shift(int $count = 1)
     * @method Location|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Location|$this pop(int $count = 1)
     * @method Location|null pull($key, $default = null)
     * @method Location|null last(callable $callback = null, $default = null)
     * @method Location|$this random(int|null $number = null)
     * @method Location|null sole($key = null, $operator = null, $value = null)
     * @method Location|null get($key, $default = null)
     * @method Location|null first(callable $callback = null, $default = null)
     * @method Location|null firstWhere(string $key, $operator = null, $value = null)
     * @method Location|null find($key, $default = null)
     * @method Location[] all()
     */
    class _IH_Location_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Location[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method Location baseSole(array|string $columns = ['*'])
     * @method Location create(array $attributes = [])
     * @method _IH_Location_C|Location[] cursor()
     * @method Location|null|_IH_Location_C|Location[] find($id, array $columns = ['*'])
     * @method _IH_Location_C|Location[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Location|_IH_Location_C|Location[] findOrFail($id, array $columns = ['*'])
     * @method Location|_IH_Location_C|Location[] findOrNew($id, array $columns = ['*'])
     * @method Location first(array|string $columns = ['*'])
     * @method Location firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Location firstOrCreate(array $attributes = [], array $values = [])
     * @method Location firstOrFail(array $columns = ['*'])
     * @method Location firstOrNew(array $attributes = [], array $values = [])
     * @method Location firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Location forceCreate(array $attributes)
     * @method _IH_Location_C|Location[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Location_C|Location[] get(array|string $columns = ['*'])
     * @method Location getModel()
     * @method Location[] getModels(array|string $columns = ['*'])
     * @method _IH_Location_C|Location[] hydrate(array $items)
     * @method Location make(array $attributes = [])
     * @method Location newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Location[]|_IH_Location_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Location[]|_IH_Location_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Location sole(array|string $columns = ['*'])
     * @method Location updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Location_QB extends _BaseBuilder {}
    
    /**
     * @method MediaUpload|null getOrPut($key, $value)
     * @method MediaUpload|$this shift(int $count = 1)
     * @method MediaUpload|null firstOrFail($key = null, $operator = null, $value = null)
     * @method MediaUpload|$this pop(int $count = 1)
     * @method MediaUpload|null pull($key, $default = null)
     * @method MediaUpload|null last(callable $callback = null, $default = null)
     * @method MediaUpload|$this random(int|null $number = null)
     * @method MediaUpload|null sole($key = null, $operator = null, $value = null)
     * @method MediaUpload|null get($key, $default = null)
     * @method MediaUpload|null first(callable $callback = null, $default = null)
     * @method MediaUpload|null firstWhere(string $key, $operator = null, $value = null)
     * @method MediaUpload|null find($key, $default = null)
     * @method MediaUpload[] all()
     */
    class _IH_MediaUpload_C extends _BaseCollection {
        /**
         * @param int $size
         * @return MediaUpload[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_MediaUpload_QB whereId($value)
     * @method _IH_MediaUpload_QB whereTitle($value)
     * @method _IH_MediaUpload_QB wherePath($value)
     * @method _IH_MediaUpload_QB whereAlt($value)
     * @method _IH_MediaUpload_QB whereSize($value)
     * @method _IH_MediaUpload_QB whereDimensions($value)
     * @method _IH_MediaUpload_QB whereCreatedAt($value)
     * @method _IH_MediaUpload_QB whereUpdatedAt($value)
     * @method _IH_MediaUpload_QB whereType($value)
     * @method _IH_MediaUpload_QB whereUserId($value)
     * @method MediaUpload baseSole(array|string $columns = ['*'])
     * @method MediaUpload create(array $attributes = [])
     * @method _IH_MediaUpload_C|MediaUpload[] cursor()
     * @method MediaUpload|null|_IH_MediaUpload_C|MediaUpload[] find($id, array $columns = ['*'])
     * @method _IH_MediaUpload_C|MediaUpload[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method MediaUpload|_IH_MediaUpload_C|MediaUpload[] findOrFail($id, array $columns = ['*'])
     * @method MediaUpload|_IH_MediaUpload_C|MediaUpload[] findOrNew($id, array $columns = ['*'])
     * @method MediaUpload first(array|string $columns = ['*'])
     * @method MediaUpload firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method MediaUpload firstOrCreate(array $attributes = [], array $values = [])
     * @method MediaUpload firstOrFail(array $columns = ['*'])
     * @method MediaUpload firstOrNew(array $attributes = [], array $values = [])
     * @method MediaUpload firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method MediaUpload forceCreate(array $attributes)
     * @method _IH_MediaUpload_C|MediaUpload[] fromQuery(string $query, array $bindings = [])
     * @method _IH_MediaUpload_C|MediaUpload[] get(array|string $columns = ['*'])
     * @method MediaUpload getModel()
     * @method MediaUpload[] getModels(array|string $columns = ['*'])
     * @method _IH_MediaUpload_C|MediaUpload[] hydrate(array $items)
     * @method MediaUpload make(array $attributes = [])
     * @method MediaUpload newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|MediaUpload[]|_IH_MediaUpload_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|MediaUpload[]|_IH_MediaUpload_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method MediaUpload sole(array|string $columns = ['*'])
     * @method MediaUpload updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_MediaUpload_QB extends _BaseBuilder {}
    
    /**
     * @method Menu|null getOrPut($key, $value)
     * @method Menu|$this shift(int $count = 1)
     * @method Menu|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Menu|$this pop(int $count = 1)
     * @method Menu|null pull($key, $default = null)
     * @method Menu|null last(callable $callback = null, $default = null)
     * @method Menu|$this random(int|null $number = null)
     * @method Menu|null sole($key = null, $operator = null, $value = null)
     * @method Menu|null get($key, $default = null)
     * @method Menu|null first(callable $callback = null, $default = null)
     * @method Menu|null firstWhere(string $key, $operator = null, $value = null)
     * @method Menu|null find($key, $default = null)
     * @method Menu[] all()
     */
    class _IH_Menu_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Menu[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Menu_QB whereId($value)
     * @method _IH_Menu_QB whereTitle($value)
     * @method _IH_Menu_QB whereContent($value)
     * @method _IH_Menu_QB whereStatus($value)
     * @method _IH_Menu_QB whereCreatedAt($value)
     * @method _IH_Menu_QB whereUpdatedAt($value)
     * @method Menu baseSole(array|string $columns = ['*'])
     * @method Menu create(array $attributes = [])
     * @method _IH_Menu_C|Menu[] cursor()
     * @method Menu|null|_IH_Menu_C|Menu[] find($id, array $columns = ['*'])
     * @method _IH_Menu_C|Menu[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Menu|_IH_Menu_C|Menu[] findOrFail($id, array $columns = ['*'])
     * @method Menu|_IH_Menu_C|Menu[] findOrNew($id, array $columns = ['*'])
     * @method Menu first(array|string $columns = ['*'])
     * @method Menu firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Menu firstOrCreate(array $attributes = [], array $values = [])
     * @method Menu firstOrFail(array $columns = ['*'])
     * @method Menu firstOrNew(array $attributes = [], array $values = [])
     * @method Menu firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Menu forceCreate(array $attributes)
     * @method _IH_Menu_C|Menu[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Menu_C|Menu[] get(array|string $columns = ['*'])
     * @method Menu getModel()
     * @method Menu[] getModels(array|string $columns = ['*'])
     * @method _IH_Menu_C|Menu[] hydrate(array $items)
     * @method Menu make(array $attributes = [])
     * @method Menu newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Menu[]|_IH_Menu_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Menu[]|_IH_Menu_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Menu sole(array|string $columns = ['*'])
     * @method Menu updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Menu_QB extends _BaseBuilder {}
    
    /**
     * @method MetaData|null getOrPut($key, $value)
     * @method MetaData|$this shift(int $count = 1)
     * @method MetaData|null firstOrFail($key = null, $operator = null, $value = null)
     * @method MetaData|$this pop(int $count = 1)
     * @method MetaData|null pull($key, $default = null)
     * @method MetaData|null last(callable $callback = null, $default = null)
     * @method MetaData|$this random(int|null $number = null)
     * @method MetaData|null sole($key = null, $operator = null, $value = null)
     * @method MetaData|null get($key, $default = null)
     * @method MetaData|null first(callable $callback = null, $default = null)
     * @method MetaData|null firstWhere(string $key, $operator = null, $value = null)
     * @method MetaData|null find($key, $default = null)
     * @method MetaData[] all()
     */
    class _IH_MetaData_C extends _BaseCollection {
        /**
         * @param int $size
         * @return MetaData[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_MetaData_QB whereId($value)
     * @method _IH_MetaData_QB whereMetaTaggableId($value)
     * @method _IH_MetaData_QB whereMetaTaggableType($value)
     * @method _IH_MetaData_QB whereMetaTitle($value)
     * @method _IH_MetaData_QB whereMetaTags($value)
     * @method _IH_MetaData_QB whereMetaDescription($value)
     * @method _IH_MetaData_QB whereFacebookMetaTags($value)
     * @method _IH_MetaData_QB whereFacebookMetaDescription($value)
     * @method _IH_MetaData_QB whereFacebookMetaImage($value)
     * @method _IH_MetaData_QB whereTwitterMetaTags($value)
     * @method _IH_MetaData_QB whereTwitterMetaDescription($value)
     * @method _IH_MetaData_QB whereTwitterMetaImage($value)
     * @method _IH_MetaData_QB whereCreatedAt($value)
     * @method _IH_MetaData_QB whereUpdatedAt($value)
     * @method MetaData baseSole(array|string $columns = ['*'])
     * @method MetaData create(array $attributes = [])
     * @method _IH_MetaData_C|MetaData[] cursor()
     * @method MetaData|null|_IH_MetaData_C|MetaData[] find($id, array $columns = ['*'])
     * @method _IH_MetaData_C|MetaData[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method MetaData|_IH_MetaData_C|MetaData[] findOrFail($id, array $columns = ['*'])
     * @method MetaData|_IH_MetaData_C|MetaData[] findOrNew($id, array $columns = ['*'])
     * @method MetaData first(array|string $columns = ['*'])
     * @method MetaData firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method MetaData firstOrCreate(array $attributes = [], array $values = [])
     * @method MetaData firstOrFail(array $columns = ['*'])
     * @method MetaData firstOrNew(array $attributes = [], array $values = [])
     * @method MetaData firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method MetaData forceCreate(array $attributes)
     * @method _IH_MetaData_C|MetaData[] fromQuery(string $query, array $bindings = [])
     * @method _IH_MetaData_C|MetaData[] get(array|string $columns = ['*'])
     * @method MetaData getModel()
     * @method MetaData[] getModels(array|string $columns = ['*'])
     * @method _IH_MetaData_C|MetaData[] hydrate(array $items)
     * @method MetaData make(array $attributes = [])
     * @method MetaData newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|MetaData[]|_IH_MetaData_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|MetaData[]|_IH_MetaData_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method MetaData sole(array|string $columns = ['*'])
     * @method MetaData updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_MetaData_QB extends _BaseBuilder {}
    
    /**
     * @method OnlineServiceFaq|null getOrPut($key, $value)
     * @method OnlineServiceFaq|$this shift(int $count = 1)
     * @method OnlineServiceFaq|null firstOrFail($key = null, $operator = null, $value = null)
     * @method OnlineServiceFaq|$this pop(int $count = 1)
     * @method OnlineServiceFaq|null pull($key, $default = null)
     * @method OnlineServiceFaq|null last(callable $callback = null, $default = null)
     * @method OnlineServiceFaq|$this random(int|null $number = null)
     * @method OnlineServiceFaq|null sole($key = null, $operator = null, $value = null)
     * @method OnlineServiceFaq|null get($key, $default = null)
     * @method OnlineServiceFaq|null first(callable $callback = null, $default = null)
     * @method OnlineServiceFaq|null firstWhere(string $key, $operator = null, $value = null)
     * @method OnlineServiceFaq|null find($key, $default = null)
     * @method OnlineServiceFaq[] all()
     */
    class _IH_OnlineServiceFaq_C extends _BaseCollection {
        /**
         * @param int $size
         * @return OnlineServiceFaq[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_OnlineServiceFaq_QB whereId($value)
     * @method _IH_OnlineServiceFaq_QB whereServiceId($value)
     * @method _IH_OnlineServiceFaq_QB whereSellerId($value)
     * @method _IH_OnlineServiceFaq_QB whereTitle($value)
     * @method _IH_OnlineServiceFaq_QB whereDescription($value)
     * @method _IH_OnlineServiceFaq_QB whereCreatedAt($value)
     * @method _IH_OnlineServiceFaq_QB whereUpdatedAt($value)
     * @method OnlineServiceFaq baseSole(array|string $columns = ['*'])
     * @method OnlineServiceFaq create(array $attributes = [])
     * @method _IH_OnlineServiceFaq_C|OnlineServiceFaq[] cursor()
     * @method OnlineServiceFaq|null|_IH_OnlineServiceFaq_C|OnlineServiceFaq[] find($id, array $columns = ['*'])
     * @method _IH_OnlineServiceFaq_C|OnlineServiceFaq[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method OnlineServiceFaq|_IH_OnlineServiceFaq_C|OnlineServiceFaq[] findOrFail($id, array $columns = ['*'])
     * @method OnlineServiceFaq|_IH_OnlineServiceFaq_C|OnlineServiceFaq[] findOrNew($id, array $columns = ['*'])
     * @method OnlineServiceFaq first(array|string $columns = ['*'])
     * @method OnlineServiceFaq firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method OnlineServiceFaq firstOrCreate(array $attributes = [], array $values = [])
     * @method OnlineServiceFaq firstOrFail(array $columns = ['*'])
     * @method OnlineServiceFaq firstOrNew(array $attributes = [], array $values = [])
     * @method OnlineServiceFaq firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method OnlineServiceFaq forceCreate(array $attributes)
     * @method _IH_OnlineServiceFaq_C|OnlineServiceFaq[] fromQuery(string $query, array $bindings = [])
     * @method _IH_OnlineServiceFaq_C|OnlineServiceFaq[] get(array|string $columns = ['*'])
     * @method OnlineServiceFaq getModel()
     * @method OnlineServiceFaq[] getModels(array|string $columns = ['*'])
     * @method _IH_OnlineServiceFaq_C|OnlineServiceFaq[] hydrate(array $items)
     * @method OnlineServiceFaq make(array $attributes = [])
     * @method OnlineServiceFaq newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|OnlineServiceFaq[]|_IH_OnlineServiceFaq_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|OnlineServiceFaq[]|_IH_OnlineServiceFaq_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method OnlineServiceFaq sole(array|string $columns = ['*'])
     * @method OnlineServiceFaq updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_OnlineServiceFaq_QB extends _BaseBuilder {}
    
    /**
     * @method OrderAdditional|null getOrPut($key, $value)
     * @method OrderAdditional|$this shift(int $count = 1)
     * @method OrderAdditional|null firstOrFail($key = null, $operator = null, $value = null)
     * @method OrderAdditional|$this pop(int $count = 1)
     * @method OrderAdditional|null pull($key, $default = null)
     * @method OrderAdditional|null last(callable $callback = null, $default = null)
     * @method OrderAdditional|$this random(int|null $number = null)
     * @method OrderAdditional|null sole($key = null, $operator = null, $value = null)
     * @method OrderAdditional|null get($key, $default = null)
     * @method OrderAdditional|null first(callable $callback = null, $default = null)
     * @method OrderAdditional|null firstWhere(string $key, $operator = null, $value = null)
     * @method OrderAdditional|null find($key, $default = null)
     * @method OrderAdditional[] all()
     */
    class _IH_OrderAdditional_C extends _BaseCollection {
        /**
         * @param int $size
         * @return OrderAdditional[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_OrderAdditional_QB whereId($value)
     * @method _IH_OrderAdditional_QB whereOrderId($value)
     * @method _IH_OrderAdditional_QB whereTitle($value)
     * @method _IH_OrderAdditional_QB wherePrice($value)
     * @method _IH_OrderAdditional_QB whereQuantity($value)
     * @method _IH_OrderAdditional_QB whereStatus($value)
     * @method _IH_OrderAdditional_QB whereCreatedAt($value)
     * @method _IH_OrderAdditional_QB whereUpdatedAt($value)
     * @method OrderAdditional baseSole(array|string $columns = ['*'])
     * @method OrderAdditional create(array $attributes = [])
     * @method _IH_OrderAdditional_C|OrderAdditional[] cursor()
     * @method OrderAdditional|null|_IH_OrderAdditional_C|OrderAdditional[] find($id, array $columns = ['*'])
     * @method _IH_OrderAdditional_C|OrderAdditional[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method OrderAdditional|_IH_OrderAdditional_C|OrderAdditional[] findOrFail($id, array $columns = ['*'])
     * @method OrderAdditional|_IH_OrderAdditional_C|OrderAdditional[] findOrNew($id, array $columns = ['*'])
     * @method OrderAdditional first(array|string $columns = ['*'])
     * @method OrderAdditional firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method OrderAdditional firstOrCreate(array $attributes = [], array $values = [])
     * @method OrderAdditional firstOrFail(array $columns = ['*'])
     * @method OrderAdditional firstOrNew(array $attributes = [], array $values = [])
     * @method OrderAdditional firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method OrderAdditional forceCreate(array $attributes)
     * @method _IH_OrderAdditional_C|OrderAdditional[] fromQuery(string $query, array $bindings = [])
     * @method _IH_OrderAdditional_C|OrderAdditional[] get(array|string $columns = ['*'])
     * @method OrderAdditional getModel()
     * @method OrderAdditional[] getModels(array|string $columns = ['*'])
     * @method _IH_OrderAdditional_C|OrderAdditional[] hydrate(array $items)
     * @method OrderAdditional make(array $attributes = [])
     * @method OrderAdditional newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|OrderAdditional[]|_IH_OrderAdditional_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|OrderAdditional[]|_IH_OrderAdditional_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method OrderAdditional sole(array|string $columns = ['*'])
     * @method OrderAdditional updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_OrderAdditional_QB extends _BaseBuilder {}
    
    /**
     * @method OrderInclude|null getOrPut($key, $value)
     * @method OrderInclude|$this shift(int $count = 1)
     * @method OrderInclude|null firstOrFail($key = null, $operator = null, $value = null)
     * @method OrderInclude|$this pop(int $count = 1)
     * @method OrderInclude|null pull($key, $default = null)
     * @method OrderInclude|null last(callable $callback = null, $default = null)
     * @method OrderInclude|$this random(int|null $number = null)
     * @method OrderInclude|null sole($key = null, $operator = null, $value = null)
     * @method OrderInclude|null get($key, $default = null)
     * @method OrderInclude|null first(callable $callback = null, $default = null)
     * @method OrderInclude|null firstWhere(string $key, $operator = null, $value = null)
     * @method OrderInclude|null find($key, $default = null)
     * @method OrderInclude[] all()
     */
    class _IH_OrderInclude_C extends _BaseCollection {
        /**
         * @param int $size
         * @return OrderInclude[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_OrderInclude_QB whereId($value)
     * @method _IH_OrderInclude_QB whereOrderId($value)
     * @method _IH_OrderInclude_QB whereTitle($value)
     * @method _IH_OrderInclude_QB wherePrice($value)
     * @method _IH_OrderInclude_QB whereQuantity($value)
     * @method _IH_OrderInclude_QB whereStatus($value)
     * @method _IH_OrderInclude_QB whereCreatedAt($value)
     * @method _IH_OrderInclude_QB whereUpdatedAt($value)
     * @method OrderInclude baseSole(array|string $columns = ['*'])
     * @method OrderInclude create(array $attributes = [])
     * @method _IH_OrderInclude_C|OrderInclude[] cursor()
     * @method OrderInclude|null|_IH_OrderInclude_C|OrderInclude[] find($id, array $columns = ['*'])
     * @method _IH_OrderInclude_C|OrderInclude[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method OrderInclude|_IH_OrderInclude_C|OrderInclude[] findOrFail($id, array $columns = ['*'])
     * @method OrderInclude|_IH_OrderInclude_C|OrderInclude[] findOrNew($id, array $columns = ['*'])
     * @method OrderInclude first(array|string $columns = ['*'])
     * @method OrderInclude firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method OrderInclude firstOrCreate(array $attributes = [], array $values = [])
     * @method OrderInclude firstOrFail(array $columns = ['*'])
     * @method OrderInclude firstOrNew(array $attributes = [], array $values = [])
     * @method OrderInclude firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method OrderInclude forceCreate(array $attributes)
     * @method _IH_OrderInclude_C|OrderInclude[] fromQuery(string $query, array $bindings = [])
     * @method _IH_OrderInclude_C|OrderInclude[] get(array|string $columns = ['*'])
     * @method OrderInclude getModel()
     * @method OrderInclude[] getModels(array|string $columns = ['*'])
     * @method _IH_OrderInclude_C|OrderInclude[] hydrate(array $items)
     * @method OrderInclude make(array $attributes = [])
     * @method OrderInclude newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|OrderInclude[]|_IH_OrderInclude_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|OrderInclude[]|_IH_OrderInclude_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method OrderInclude sole(array|string $columns = ['*'])
     * @method OrderInclude updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_OrderInclude_QB extends _BaseBuilder {}
    
    /**
     * @method Order|null getOrPut($key, $value)
     * @method Order|$this shift(int $count = 1)
     * @method Order|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Order|$this pop(int $count = 1)
     * @method Order|null pull($key, $default = null)
     * @method Order|null last(callable $callback = null, $default = null)
     * @method Order|$this random(int|null $number = null)
     * @method Order|null sole($key = null, $operator = null, $value = null)
     * @method Order|null get($key, $default = null)
     * @method Order|null first(callable $callback = null, $default = null)
     * @method Order|null firstWhere(string $key, $operator = null, $value = null)
     * @method Order|null find($key, $default = null)
     * @method Order[] all()
     */
    class _IH_Order_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Order[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Order_QB whereId($value)
     * @method _IH_Order_QB whereServiceId($value)
     * @method _IH_Order_QB whereSellerId($value)
     * @method _IH_Order_QB whereBuyerId($value)
     * @method _IH_Order_QB whereName($value)
     * @method _IH_Order_QB whereEmail($value)
     * @method _IH_Order_QB wherePhone($value)
     * @method _IH_Order_QB wherePostCode($value)
     * @method _IH_Order_QB whereAddress($value)
     * @method _IH_Order_QB whereCity($value)
     * @method _IH_Order_QB whereArea($value)
     * @method _IH_Order_QB whereCountry($value)
     * @method _IH_Order_QB whereDate($value)
     * @method _IH_Order_QB whereSchedule($value)
     * @method _IH_Order_QB wherePackageFee($value)
     * @method _IH_Order_QB whereExtraService($value)
     * @method _IH_Order_QB whereSubTotal($value)
     * @method _IH_Order_QB whereTax($value)
     * @method _IH_Order_QB whereTotal($value)
     * @method _IH_Order_QB whereCouponCode($value)
     * @method _IH_Order_QB whereCouponType($value)
     * @method _IH_Order_QB whereCouponAmount($value)
     * @method _IH_Order_QB whereCommissionType($value)
     * @method _IH_Order_QB whereCommissionCharge($value)
     * @method _IH_Order_QB whereCommissionAmount($value)
     * @method _IH_Order_QB wherePaymentGateway($value)
     * @method _IH_Order_QB wherePaymentStatus($value)
     * @method _IH_Order_QB whereStatus($value)
     * @method _IH_Order_QB whereTransactionId($value)
     * @method _IH_Order_QB whereOrderNote($value)
     * @method _IH_Order_QB whereCreatedAt($value)
     * @method _IH_Order_QB whereUpdatedAt($value)
     * @method _IH_Order_QB whereManualPaymentImage($value)
     * @method _IH_Order_QB whereOrderCompleteRequest($value)
     * @method _IH_Order_QB whereCancelOrderMoneyReturn($value)
     * @method _IH_Order_QB whereIsOrderOnline($value)
     * @method _IH_Order_QB whereOrderFromJob($value)
     * @method _IH_Order_QB whereJobPostId($value)
     * @method Order baseSole(array|string $columns = ['*'])
     * @method Order create(array $attributes = [])
     * @method _IH_Order_C|Order[] cursor()
     * @method Order|null|_IH_Order_C|Order[] find($id, array $columns = ['*'])
     * @method _IH_Order_C|Order[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Order|_IH_Order_C|Order[] findOrFail($id, array $columns = ['*'])
     * @method Order|_IH_Order_C|Order[] findOrNew($id, array $columns = ['*'])
     * @method Order first(array|string $columns = ['*'])
     * @method Order firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Order firstOrCreate(array $attributes = [], array $values = [])
     * @method Order firstOrFail(array $columns = ['*'])
     * @method Order firstOrNew(array $attributes = [], array $values = [])
     * @method Order firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Order forceCreate(array $attributes)
     * @method _IH_Order_C|Order[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Order_C|Order[] get(array|string $columns = ['*'])
     * @method Order getModel()
     * @method Order[] getModels(array|string $columns = ['*'])
     * @method _IH_Order_C|Order[] hydrate(array $items)
     * @method Order make(array $attributes = [])
     * @method Order newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Order[]|_IH_Order_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Order[]|_IH_Order_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Order sole(array|string $columns = ['*'])
     * @method Order updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Order_QB extends _BaseBuilder {}
    
    /**
     * @method PageBuilder|null getOrPut($key, $value)
     * @method PageBuilder|$this shift(int $count = 1)
     * @method PageBuilder|null firstOrFail($key = null, $operator = null, $value = null)
     * @method PageBuilder|$this pop(int $count = 1)
     * @method PageBuilder|null pull($key, $default = null)
     * @method PageBuilder|null last(callable $callback = null, $default = null)
     * @method PageBuilder|$this random(int|null $number = null)
     * @method PageBuilder|null sole($key = null, $operator = null, $value = null)
     * @method PageBuilder|null get($key, $default = null)
     * @method PageBuilder|null first(callable $callback = null, $default = null)
     * @method PageBuilder|null firstWhere(string $key, $operator = null, $value = null)
     * @method PageBuilder|null find($key, $default = null)
     * @method PageBuilder[] all()
     */
    class _IH_PageBuilder_C extends _BaseCollection {
        /**
         * @param int $size
         * @return PageBuilder[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_PageBuilder_QB whereId($value)
     * @method _IH_PageBuilder_QB whereAddonName($value)
     * @method _IH_PageBuilder_QB whereAddonType($value)
     * @method _IH_PageBuilder_QB whereAddonNamespace($value)
     * @method _IH_PageBuilder_QB whereAddonLocation($value)
     * @method _IH_PageBuilder_QB whereAddonOrder($value)
     * @method _IH_PageBuilder_QB whereAddonPageId($value)
     * @method _IH_PageBuilder_QB whereAddonPageType($value)
     * @method _IH_PageBuilder_QB whereAddonSettings($value)
     * @method _IH_PageBuilder_QB whereCreatedAt($value)
     * @method _IH_PageBuilder_QB whereUpdatedAt($value)
     * @method PageBuilder baseSole(array|string $columns = ['*'])
     * @method PageBuilder create(array $attributes = [])
     * @method _IH_PageBuilder_C|PageBuilder[] cursor()
     * @method PageBuilder|null|_IH_PageBuilder_C|PageBuilder[] find($id, array $columns = ['*'])
     * @method _IH_PageBuilder_C|PageBuilder[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method PageBuilder|_IH_PageBuilder_C|PageBuilder[] findOrFail($id, array $columns = ['*'])
     * @method PageBuilder|_IH_PageBuilder_C|PageBuilder[] findOrNew($id, array $columns = ['*'])
     * @method PageBuilder first(array|string $columns = ['*'])
     * @method PageBuilder firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method PageBuilder firstOrCreate(array $attributes = [], array $values = [])
     * @method PageBuilder firstOrFail(array $columns = ['*'])
     * @method PageBuilder firstOrNew(array $attributes = [], array $values = [])
     * @method PageBuilder firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method PageBuilder forceCreate(array $attributes)
     * @method _IH_PageBuilder_C|PageBuilder[] fromQuery(string $query, array $bindings = [])
     * @method _IH_PageBuilder_C|PageBuilder[] get(array|string $columns = ['*'])
     * @method PageBuilder getModel()
     * @method PageBuilder[] getModels(array|string $columns = ['*'])
     * @method _IH_PageBuilder_C|PageBuilder[] hydrate(array $items)
     * @method PageBuilder make(array $attributes = [])
     * @method PageBuilder newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|PageBuilder[]|_IH_PageBuilder_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|PageBuilder[]|_IH_PageBuilder_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method PageBuilder sole(array|string $columns = ['*'])
     * @method PageBuilder updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_PageBuilder_QB extends _BaseBuilder {}
    
    /**
     * @method Page|null getOrPut($key, $value)
     * @method Page|$this shift(int $count = 1)
     * @method Page|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Page|$this pop(int $count = 1)
     * @method Page|null pull($key, $default = null)
     * @method Page|null last(callable $callback = null, $default = null)
     * @method Page|$this random(int|null $number = null)
     * @method Page|null sole($key = null, $operator = null, $value = null)
     * @method Page|null get($key, $default = null)
     * @method Page|null first(callable $callback = null, $default = null)
     * @method Page|null firstWhere(string $key, $operator = null, $value = null)
     * @method Page|null find($key, $default = null)
     * @method Page[] all()
     */
    class _IH_Page_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Page[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Page_QB whereId($value)
     * @method _IH_Page_QB whereTitle($value)
     * @method _IH_Page_QB whereSlug($value)
     * @method _IH_Page_QB wherePageContent($value)
     * @method _IH_Page_QB whereVisibility($value)
     * @method _IH_Page_QB whereStatus($value)
     * @method _IH_Page_QB whereBackToTop($value)
     * @method _IH_Page_QB whereCreatedAt($value)
     * @method _IH_Page_QB whereUpdatedAt($value)
     * @method _IH_Page_QB wherePageBuilderStatus($value)
     * @method _IH_Page_QB whereLayout($value)
     * @method _IH_Page_QB whereSidebarLayout($value)
     * @method _IH_Page_QB whereNavbarVariant($value)
     * @method _IH_Page_QB wherePageClass($value)
     * @method _IH_Page_QB whereBreadcrumbStatus($value)
     * @method _IH_Page_QB whereFooterVariant($value)
     * @method _IH_Page_QB whereWidgetStyle($value)
     * @method _IH_Page_QB whereLeftColumn($value)
     * @method _IH_Page_QB whereRightColumn($value)
     * @method Page baseSole(array|string $columns = ['*'])
     * @method Page create(array $attributes = [])
     * @method _IH_Page_C|Page[] cursor()
     * @method Page|null|_IH_Page_C|Page[] find($id, array $columns = ['*'])
     * @method _IH_Page_C|Page[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Page|_IH_Page_C|Page[] findOrFail($id, array $columns = ['*'])
     * @method Page|_IH_Page_C|Page[] findOrNew($id, array $columns = ['*'])
     * @method Page first(array|string $columns = ['*'])
     * @method Page firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Page firstOrCreate(array $attributes = [], array $values = [])
     * @method Page firstOrFail(array $columns = ['*'])
     * @method Page firstOrNew(array $attributes = [], array $values = [])
     * @method Page firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Page forceCreate(array $attributes)
     * @method _IH_Page_C|Page[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Page_C|Page[] get(array|string $columns = ['*'])
     * @method Page getModel()
     * @method Page[] getModels(array|string $columns = ['*'])
     * @method _IH_Page_C|Page[] hydrate(array $items)
     * @method Page make(array $attributes = [])
     * @method Page newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Page[]|_IH_Page_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Page[]|_IH_Page_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Page sole(array|string $columns = ['*'])
     * @method Page updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Page_QB extends _BaseBuilder {}
    
    /**
     * @method PayoutRequest|null getOrPut($key, $value)
     * @method PayoutRequest|$this shift(int $count = 1)
     * @method PayoutRequest|null firstOrFail($key = null, $operator = null, $value = null)
     * @method PayoutRequest|$this pop(int $count = 1)
     * @method PayoutRequest|null pull($key, $default = null)
     * @method PayoutRequest|null last(callable $callback = null, $default = null)
     * @method PayoutRequest|$this random(int|null $number = null)
     * @method PayoutRequest|null sole($key = null, $operator = null, $value = null)
     * @method PayoutRequest|null get($key, $default = null)
     * @method PayoutRequest|null first(callable $callback = null, $default = null)
     * @method PayoutRequest|null firstWhere(string $key, $operator = null, $value = null)
     * @method PayoutRequest|null find($key, $default = null)
     * @method PayoutRequest[] all()
     */
    class _IH_PayoutRequest_C extends _BaseCollection {
        /**
         * @param int $size
         * @return PayoutRequest[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_PayoutRequest_QB whereId($value)
     * @method _IH_PayoutRequest_QB whereSellerId($value)
     * @method _IH_PayoutRequest_QB whereAmount($value)
     * @method _IH_PayoutRequest_QB wherePaymentGateway($value)
     * @method _IH_PayoutRequest_QB wherePaymentReceipt($value)
     * @method _IH_PayoutRequest_QB whereSellerNote($value)
     * @method _IH_PayoutRequest_QB whereAdminNote($value)
     * @method _IH_PayoutRequest_QB whereStatus($value)
     * @method _IH_PayoutRequest_QB whereCreatedAt($value)
     * @method _IH_PayoutRequest_QB whereUpdatedAt($value)
     * @method PayoutRequest baseSole(array|string $columns = ['*'])
     * @method PayoutRequest create(array $attributes = [])
     * @method _IH_PayoutRequest_C|PayoutRequest[] cursor()
     * @method PayoutRequest|null|_IH_PayoutRequest_C|PayoutRequest[] find($id, array $columns = ['*'])
     * @method _IH_PayoutRequest_C|PayoutRequest[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method PayoutRequest|_IH_PayoutRequest_C|PayoutRequest[] findOrFail($id, array $columns = ['*'])
     * @method PayoutRequest|_IH_PayoutRequest_C|PayoutRequest[] findOrNew($id, array $columns = ['*'])
     * @method PayoutRequest first(array|string $columns = ['*'])
     * @method PayoutRequest firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method PayoutRequest firstOrCreate(array $attributes = [], array $values = [])
     * @method PayoutRequest firstOrFail(array $columns = ['*'])
     * @method PayoutRequest firstOrNew(array $attributes = [], array $values = [])
     * @method PayoutRequest firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method PayoutRequest forceCreate(array $attributes)
     * @method _IH_PayoutRequest_C|PayoutRequest[] fromQuery(string $query, array $bindings = [])
     * @method _IH_PayoutRequest_C|PayoutRequest[] get(array|string $columns = ['*'])
     * @method PayoutRequest getModel()
     * @method PayoutRequest[] getModels(array|string $columns = ['*'])
     * @method _IH_PayoutRequest_C|PayoutRequest[] hydrate(array $items)
     * @method PayoutRequest make(array $attributes = [])
     * @method PayoutRequest newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|PayoutRequest[]|_IH_PayoutRequest_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|PayoutRequest[]|_IH_PayoutRequest_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method PayoutRequest sole(array|string $columns = ['*'])
     * @method PayoutRequest updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_PayoutRequest_QB extends _BaseBuilder {}
    
    /**
     * @method Report|null getOrPut($key, $value)
     * @method Report|$this shift(int $count = 1)
     * @method Report|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Report|$this pop(int $count = 1)
     * @method Report|null pull($key, $default = null)
     * @method Report|null last(callable $callback = null, $default = null)
     * @method Report|$this random(int|null $number = null)
     * @method Report|null sole($key = null, $operator = null, $value = null)
     * @method Report|null get($key, $default = null)
     * @method Report|null first(callable $callback = null, $default = null)
     * @method Report|null firstWhere(string $key, $operator = null, $value = null)
     * @method Report|null find($key, $default = null)
     * @method Report[] all()
     */
    class _IH_Report_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Report[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Report_QB whereId($value)
     * @method _IH_Report_QB whereOrderId($value)
     * @method _IH_Report_QB whereServiceId($value)
     * @method _IH_Report_QB whereSellerId($value)
     * @method _IH_Report_QB whereBuyerId($value)
     * @method _IH_Report_QB whereReportFrom($value)
     * @method _IH_Report_QB whereReportTo($value)
     * @method _IH_Report_QB whereStatus($value)
     * @method _IH_Report_QB whereReport($value)
     * @method _IH_Report_QB whereCreatedAt($value)
     * @method _IH_Report_QB whereUpdatedAt($value)
     * @method Report baseSole(array|string $columns = ['*'])
     * @method Report create(array $attributes = [])
     * @method _IH_Report_C|Report[] cursor()
     * @method Report|null|_IH_Report_C|Report[] find($id, array $columns = ['*'])
     * @method _IH_Report_C|Report[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Report|_IH_Report_C|Report[] findOrFail($id, array $columns = ['*'])
     * @method Report|_IH_Report_C|Report[] findOrNew($id, array $columns = ['*'])
     * @method Report first(array|string $columns = ['*'])
     * @method Report firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Report firstOrCreate(array $attributes = [], array $values = [])
     * @method Report firstOrFail(array $columns = ['*'])
     * @method Report firstOrNew(array $attributes = [], array $values = [])
     * @method Report firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Report forceCreate(array $attributes)
     * @method _IH_Report_C|Report[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Report_C|Report[] get(array|string $columns = ['*'])
     * @method Report getModel()
     * @method Report[] getModels(array|string $columns = ['*'])
     * @method _IH_Report_C|Report[] hydrate(array $items)
     * @method Report make(array $attributes = [])
     * @method Report newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Report[]|_IH_Report_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Report[]|_IH_Report_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Report sole(array|string $columns = ['*'])
     * @method Report updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Report_QB extends _BaseBuilder {}
    
    /**
     * @method Review|null getOrPut($key, $value)
     * @method Review|$this shift(int $count = 1)
     * @method Review|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Review|$this pop(int $count = 1)
     * @method Review|null pull($key, $default = null)
     * @method Review|null last(callable $callback = null, $default = null)
     * @method Review|$this random(int|null $number = null)
     * @method Review|null sole($key = null, $operator = null, $value = null)
     * @method Review|null get($key, $default = null)
     * @method Review|null first(callable $callback = null, $default = null)
     * @method Review|null firstWhere(string $key, $operator = null, $value = null)
     * @method Review|null find($key, $default = null)
     * @method Review[] all()
     */
    class _IH_Review_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Review[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Review_QB whereId($value)
     * @method _IH_Review_QB whereServiceId($value)
     * @method _IH_Review_QB whereSellerId($value)
     * @method _IH_Review_QB whereBuyerId($value)
     * @method _IH_Review_QB whereRating($value)
     * @method _IH_Review_QB whereName($value)
     * @method _IH_Review_QB whereEmail($value)
     * @method _IH_Review_QB whereMessage($value)
     * @method _IH_Review_QB whereStatus($value)
     * @method _IH_Review_QB whereCreatedAt($value)
     * @method _IH_Review_QB whereUpdatedAt($value)
     * @method Review baseSole(array|string $columns = ['*'])
     * @method Review create(array $attributes = [])
     * @method _IH_Review_C|Review[] cursor()
     * @method Review|null|_IH_Review_C|Review[] find($id, array $columns = ['*'])
     * @method _IH_Review_C|Review[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Review|_IH_Review_C|Review[] findOrFail($id, array $columns = ['*'])
     * @method Review|_IH_Review_C|Review[] findOrNew($id, array $columns = ['*'])
     * @method Review first(array|string $columns = ['*'])
     * @method Review firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Review firstOrCreate(array $attributes = [], array $values = [])
     * @method Review firstOrFail(array $columns = ['*'])
     * @method Review firstOrNew(array $attributes = [], array $values = [])
     * @method Review firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Review forceCreate(array $attributes)
     * @method _IH_Review_C|Review[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Review_C|Review[] get(array|string $columns = ['*'])
     * @method Review getModel()
     * @method Review[] getModels(array|string $columns = ['*'])
     * @method _IH_Review_C|Review[] hydrate(array $items)
     * @method Review make(array $attributes = [])
     * @method Review newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Review[]|_IH_Review_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Review[]|_IH_Review_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Review sole(array|string $columns = ['*'])
     * @method Review updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Review_QB extends _BaseBuilder {}
    
    /**
     * @method Schedule|null getOrPut($key, $value)
     * @method Schedule|$this shift(int $count = 1)
     * @method Schedule|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Schedule|$this pop(int $count = 1)
     * @method Schedule|null pull($key, $default = null)
     * @method Schedule|null last(callable $callback = null, $default = null)
     * @method Schedule|$this random(int|null $number = null)
     * @method Schedule|null sole($key = null, $operator = null, $value = null)
     * @method Schedule|null get($key, $default = null)
     * @method Schedule|null first(callable $callback = null, $default = null)
     * @method Schedule|null firstWhere(string $key, $operator = null, $value = null)
     * @method Schedule|null find($key, $default = null)
     * @method Schedule[] all()
     */
    class _IH_Schedule_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Schedule[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Schedule_QB whereId($value)
     * @method _IH_Schedule_QB whereDayId($value)
     * @method _IH_Schedule_QB whereSellerId($value)
     * @method _IH_Schedule_QB whereSchedule($value)
     * @method _IH_Schedule_QB whereStatus($value)
     * @method _IH_Schedule_QB whereCreatedAt($value)
     * @method _IH_Schedule_QB whereUpdatedAt($value)
     * @method _IH_Schedule_QB whereAllowMultipleSchedule($value)
     * @method Schedule baseSole(array|string $columns = ['*'])
     * @method Schedule create(array $attributes = [])
     * @method _IH_Schedule_C|Schedule[] cursor()
     * @method Schedule|null|_IH_Schedule_C|Schedule[] find($id, array $columns = ['*'])
     * @method _IH_Schedule_C|Schedule[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Schedule|_IH_Schedule_C|Schedule[] findOrFail($id, array $columns = ['*'])
     * @method Schedule|_IH_Schedule_C|Schedule[] findOrNew($id, array $columns = ['*'])
     * @method Schedule first(array|string $columns = ['*'])
     * @method Schedule firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Schedule firstOrCreate(array $attributes = [], array $values = [])
     * @method Schedule firstOrFail(array $columns = ['*'])
     * @method Schedule firstOrNew(array $attributes = [], array $values = [])
     * @method Schedule firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Schedule forceCreate(array $attributes)
     * @method _IH_Schedule_C|Schedule[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Schedule_C|Schedule[] get(array|string $columns = ['*'])
     * @method Schedule getModel()
     * @method Schedule[] getModels(array|string $columns = ['*'])
     * @method _IH_Schedule_C|Schedule[] hydrate(array $items)
     * @method Schedule make(array $attributes = [])
     * @method Schedule newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Schedule[]|_IH_Schedule_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Schedule[]|_IH_Schedule_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Schedule sole(array|string $columns = ['*'])
     * @method Schedule updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Schedule_QB extends _BaseBuilder {}
    
    /**
     * @method SellerVerify|null getOrPut($key, $value)
     * @method SellerVerify|$this shift(int $count = 1)
     * @method SellerVerify|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SellerVerify|$this pop(int $count = 1)
     * @method SellerVerify|null pull($key, $default = null)
     * @method SellerVerify|null last(callable $callback = null, $default = null)
     * @method SellerVerify|$this random(int|null $number = null)
     * @method SellerVerify|null sole($key = null, $operator = null, $value = null)
     * @method SellerVerify|null get($key, $default = null)
     * @method SellerVerify|null first(callable $callback = null, $default = null)
     * @method SellerVerify|null firstWhere(string $key, $operator = null, $value = null)
     * @method SellerVerify|null find($key, $default = null)
     * @method SellerVerify[] all()
     */
    class _IH_SellerVerify_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SellerVerify[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SellerVerify_QB whereId($value)
     * @method _IH_SellerVerify_QB whereSellerId($value)
     * @method _IH_SellerVerify_QB whereNationalId($value)
     * @method _IH_SellerVerify_QB whereAddress($value)
     * @method _IH_SellerVerify_QB whereStatus($value)
     * @method _IH_SellerVerify_QB whereCreatedAt($value)
     * @method _IH_SellerVerify_QB whereUpdatedAt($value)
     * @method SellerVerify baseSole(array|string $columns = ['*'])
     * @method SellerVerify create(array $attributes = [])
     * @method _IH_SellerVerify_C|SellerVerify[] cursor()
     * @method SellerVerify|null|_IH_SellerVerify_C|SellerVerify[] find($id, array $columns = ['*'])
     * @method _IH_SellerVerify_C|SellerVerify[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SellerVerify|_IH_SellerVerify_C|SellerVerify[] findOrFail($id, array $columns = ['*'])
     * @method SellerVerify|_IH_SellerVerify_C|SellerVerify[] findOrNew($id, array $columns = ['*'])
     * @method SellerVerify first(array|string $columns = ['*'])
     * @method SellerVerify firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SellerVerify firstOrCreate(array $attributes = [], array $values = [])
     * @method SellerVerify firstOrFail(array $columns = ['*'])
     * @method SellerVerify firstOrNew(array $attributes = [], array $values = [])
     * @method SellerVerify firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SellerVerify forceCreate(array $attributes)
     * @method _IH_SellerVerify_C|SellerVerify[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SellerVerify_C|SellerVerify[] get(array|string $columns = ['*'])
     * @method SellerVerify getModel()
     * @method SellerVerify[] getModels(array|string $columns = ['*'])
     * @method _IH_SellerVerify_C|SellerVerify[] hydrate(array $items)
     * @method SellerVerify make(array $attributes = [])
     * @method SellerVerify newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SellerVerify[]|_IH_SellerVerify_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SellerVerify[]|_IH_SellerVerify_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SellerVerify sole(array|string $columns = ['*'])
     * @method SellerVerify updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SellerVerify_QB extends _BaseBuilder {}
    
    /**
     * @method ServiceArea|null getOrPut($key, $value)
     * @method ServiceArea|$this shift(int $count = 1)
     * @method ServiceArea|null firstOrFail($key = null, $operator = null, $value = null)
     * @method ServiceArea|$this pop(int $count = 1)
     * @method ServiceArea|null pull($key, $default = null)
     * @method ServiceArea|null last(callable $callback = null, $default = null)
     * @method ServiceArea|$this random(int|null $number = null)
     * @method ServiceArea|null sole($key = null, $operator = null, $value = null)
     * @method ServiceArea|null get($key, $default = null)
     * @method ServiceArea|null first(callable $callback = null, $default = null)
     * @method ServiceArea|null firstWhere(string $key, $operator = null, $value = null)
     * @method ServiceArea|null find($key, $default = null)
     * @method ServiceArea[] all()
     */
    class _IH_ServiceArea_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ServiceArea[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_ServiceArea_QB whereId($value)
     * @method _IH_ServiceArea_QB whereServiceArea($value)
     * @method _IH_ServiceArea_QB whereServiceCityId($value)
     * @method _IH_ServiceArea_QB whereCountryId($value)
     * @method _IH_ServiceArea_QB whereStatus($value)
     * @method _IH_ServiceArea_QB whereCreatedAt($value)
     * @method _IH_ServiceArea_QB whereUpdatedAt($value)
     * @method ServiceArea baseSole(array|string $columns = ['*'])
     * @method ServiceArea create(array $attributes = [])
     * @method _IH_ServiceArea_C|ServiceArea[] cursor()
     * @method ServiceArea|null|_IH_ServiceArea_C|ServiceArea[] find($id, array $columns = ['*'])
     * @method _IH_ServiceArea_C|ServiceArea[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method ServiceArea|_IH_ServiceArea_C|ServiceArea[] findOrFail($id, array $columns = ['*'])
     * @method ServiceArea|_IH_ServiceArea_C|ServiceArea[] findOrNew($id, array $columns = ['*'])
     * @method ServiceArea first(array|string $columns = ['*'])
     * @method ServiceArea firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method ServiceArea firstOrCreate(array $attributes = [], array $values = [])
     * @method ServiceArea firstOrFail(array $columns = ['*'])
     * @method ServiceArea firstOrNew(array $attributes = [], array $values = [])
     * @method ServiceArea firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ServiceArea forceCreate(array $attributes)
     * @method _IH_ServiceArea_C|ServiceArea[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ServiceArea_C|ServiceArea[] get(array|string $columns = ['*'])
     * @method ServiceArea getModel()
     * @method ServiceArea[] getModels(array|string $columns = ['*'])
     * @method _IH_ServiceArea_C|ServiceArea[] hydrate(array $items)
     * @method ServiceArea make(array $attributes = [])
     * @method ServiceArea newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ServiceArea[]|_IH_ServiceArea_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ServiceArea[]|_IH_ServiceArea_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ServiceArea sole(array|string $columns = ['*'])
     * @method ServiceArea updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_ServiceArea_QB extends _BaseBuilder {}
    
    /**
     * @method ServiceCity|null getOrPut($key, $value)
     * @method ServiceCity|$this shift(int $count = 1)
     * @method ServiceCity|null firstOrFail($key = null, $operator = null, $value = null)
     * @method ServiceCity|$this pop(int $count = 1)
     * @method ServiceCity|null pull($key, $default = null)
     * @method ServiceCity|null last(callable $callback = null, $default = null)
     * @method ServiceCity|$this random(int|null $number = null)
     * @method ServiceCity|null sole($key = null, $operator = null, $value = null)
     * @method ServiceCity|null get($key, $default = null)
     * @method ServiceCity|null first(callable $callback = null, $default = null)
     * @method ServiceCity|null firstWhere(string $key, $operator = null, $value = null)
     * @method ServiceCity|null find($key, $default = null)
     * @method ServiceCity[] all()
     */
    class _IH_ServiceCity_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ServiceCity[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_ServiceCity_QB whereId($value)
     * @method _IH_ServiceCity_QB whereServiceCity($value)
     * @method _IH_ServiceCity_QB whereCountryId($value)
     * @method _IH_ServiceCity_QB whereStatus($value)
     * @method _IH_ServiceCity_QB whereCreatedAt($value)
     * @method _IH_ServiceCity_QB whereUpdatedAt($value)
     * @method ServiceCity baseSole(array|string $columns = ['*'])
     * @method ServiceCity create(array $attributes = [])
     * @method _IH_ServiceCity_C|ServiceCity[] cursor()
     * @method ServiceCity|null|_IH_ServiceCity_C|ServiceCity[] find($id, array $columns = ['*'])
     * @method _IH_ServiceCity_C|ServiceCity[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method ServiceCity|_IH_ServiceCity_C|ServiceCity[] findOrFail($id, array $columns = ['*'])
     * @method ServiceCity|_IH_ServiceCity_C|ServiceCity[] findOrNew($id, array $columns = ['*'])
     * @method ServiceCity first(array|string $columns = ['*'])
     * @method ServiceCity firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method ServiceCity firstOrCreate(array $attributes = [], array $values = [])
     * @method ServiceCity firstOrFail(array $columns = ['*'])
     * @method ServiceCity firstOrNew(array $attributes = [], array $values = [])
     * @method ServiceCity firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ServiceCity forceCreate(array $attributes)
     * @method _IH_ServiceCity_C|ServiceCity[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ServiceCity_C|ServiceCity[] get(array|string $columns = ['*'])
     * @method ServiceCity getModel()
     * @method ServiceCity[] getModels(array|string $columns = ['*'])
     * @method _IH_ServiceCity_C|ServiceCity[] hydrate(array $items)
     * @method ServiceCity make(array $attributes = [])
     * @method ServiceCity newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ServiceCity[]|_IH_ServiceCity_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ServiceCity[]|_IH_ServiceCity_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ServiceCity sole(array|string $columns = ['*'])
     * @method ServiceCity updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_ServiceCity_QB extends _BaseBuilder {}
    
    /**
     * @method ServiceCoupon|null getOrPut($key, $value)
     * @method ServiceCoupon|$this shift(int $count = 1)
     * @method ServiceCoupon|null firstOrFail($key = null, $operator = null, $value = null)
     * @method ServiceCoupon|$this pop(int $count = 1)
     * @method ServiceCoupon|null pull($key, $default = null)
     * @method ServiceCoupon|null last(callable $callback = null, $default = null)
     * @method ServiceCoupon|$this random(int|null $number = null)
     * @method ServiceCoupon|null sole($key = null, $operator = null, $value = null)
     * @method ServiceCoupon|null get($key, $default = null)
     * @method ServiceCoupon|null first(callable $callback = null, $default = null)
     * @method ServiceCoupon|null firstWhere(string $key, $operator = null, $value = null)
     * @method ServiceCoupon|null find($key, $default = null)
     * @method ServiceCoupon[] all()
     */
    class _IH_ServiceCoupon_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ServiceCoupon[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_ServiceCoupon_QB whereId($value)
     * @method _IH_ServiceCoupon_QB whereCode($value)
     * @method _IH_ServiceCoupon_QB whereDiscount($value)
     * @method _IH_ServiceCoupon_QB whereDiscountType($value)
     * @method _IH_ServiceCoupon_QB whereExpireDate($value)
     * @method _IH_ServiceCoupon_QB whereStatus($value)
     * @method _IH_ServiceCoupon_QB whereSellerId($value)
     * @method _IH_ServiceCoupon_QB whereCreatedAt($value)
     * @method _IH_ServiceCoupon_QB whereUpdatedAt($value)
     * @method _IH_ServiceCoupon_QB whereUserType($value)
     * @method ServiceCoupon baseSole(array|string $columns = ['*'])
     * @method ServiceCoupon create(array $attributes = [])
     * @method _IH_ServiceCoupon_C|ServiceCoupon[] cursor()
     * @method ServiceCoupon|null|_IH_ServiceCoupon_C|ServiceCoupon[] find($id, array $columns = ['*'])
     * @method _IH_ServiceCoupon_C|ServiceCoupon[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method ServiceCoupon|_IH_ServiceCoupon_C|ServiceCoupon[] findOrFail($id, array $columns = ['*'])
     * @method ServiceCoupon|_IH_ServiceCoupon_C|ServiceCoupon[] findOrNew($id, array $columns = ['*'])
     * @method ServiceCoupon first(array|string $columns = ['*'])
     * @method ServiceCoupon firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method ServiceCoupon firstOrCreate(array $attributes = [], array $values = [])
     * @method ServiceCoupon firstOrFail(array $columns = ['*'])
     * @method ServiceCoupon firstOrNew(array $attributes = [], array $values = [])
     * @method ServiceCoupon firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ServiceCoupon forceCreate(array $attributes)
     * @method _IH_ServiceCoupon_C|ServiceCoupon[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ServiceCoupon_C|ServiceCoupon[] get(array|string $columns = ['*'])
     * @method ServiceCoupon getModel()
     * @method ServiceCoupon[] getModels(array|string $columns = ['*'])
     * @method _IH_ServiceCoupon_C|ServiceCoupon[] hydrate(array $items)
     * @method ServiceCoupon make(array $attributes = [])
     * @method ServiceCoupon newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ServiceCoupon[]|_IH_ServiceCoupon_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ServiceCoupon[]|_IH_ServiceCoupon_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ServiceCoupon sole(array|string $columns = ['*'])
     * @method ServiceCoupon updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_ServiceCoupon_QB extends _BaseBuilder {}
    
    /**
     * @method Service|null getOrPut($key, $value)
     * @method Service|$this shift(int $count = 1)
     * @method Service|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Service|$this pop(int $count = 1)
     * @method Service|null pull($key, $default = null)
     * @method Service|null last(callable $callback = null, $default = null)
     * @method Service|$this random(int|null $number = null)
     * @method Service|null sole($key = null, $operator = null, $value = null)
     * @method Service|null get($key, $default = null)
     * @method Service|null first(callable $callback = null, $default = null)
     * @method Service|null firstWhere(string $key, $operator = null, $value = null)
     * @method Service|null find($key, $default = null)
     * @method Service[] all()
     */
    class _IH_Service_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Service[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Service_QB whereId($value)
     * @method _IH_Service_QB whereCategoryId($value)
     * @method _IH_Service_QB whereSubcategoryId($value)
     * @method _IH_Service_QB whereSellerId($value)
     * @method _IH_Service_QB whereServiceCityId($value)
     * @method _IH_Service_QB whereTitle($value)
     * @method _IH_Service_QB whereSlug($value)
     * @method _IH_Service_QB whereDescription($value)
     * @method _IH_Service_QB whereImage($value)
     * @method _IH_Service_QB whereStatus($value)
     * @method _IH_Service_QB whereIsServiceOn($value)
     * @method _IH_Service_QB wherePrice($value)
     * @method _IH_Service_QB whereTax($value)
     * @method _IH_Service_QB whereView($value)
     * @method _IH_Service_QB whereFeatured($value)
     * @method _IH_Service_QB whereCreatedAt($value)
     * @method _IH_Service_QB whereUpdatedAt($value)
     * @method _IH_Service_QB whereSoldCount($value)
     * @method _IH_Service_QB whereOnlineServicePrice($value)
     * @method _IH_Service_QB whereDeliveryDays($value)
     * @method _IH_Service_QB whereRevision($value)
     * @method _IH_Service_QB whereIsServiceOnline($value)
     * @method _IH_Service_QB whereImageGallery($value)
     * @method _IH_Service_QB whereVideo($value)
     * @method _IH_Service_QB whereAdminId($value)
     * @method _IH_Service_QB whereGuardName($value)
     * @method _IH_Service_QB whereIsServiceAllCities($value)
     * @method Service baseSole(array|string $columns = ['*'])
     * @method Service create(array $attributes = [])
     * @method _IH_Service_C|Service[] cursor()
     * @method Service|null|_IH_Service_C|Service[] find($id, array $columns = ['*'])
     * @method _IH_Service_C|Service[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Service|_IH_Service_C|Service[] findOrFail($id, array $columns = ['*'])
     * @method Service|_IH_Service_C|Service[] findOrNew($id, array $columns = ['*'])
     * @method Service first(array|string $columns = ['*'])
     * @method Service firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Service firstOrCreate(array $attributes = [], array $values = [])
     * @method Service firstOrFail(array $columns = ['*'])
     * @method Service firstOrNew(array $attributes = [], array $values = [])
     * @method Service firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Service forceCreate(array $attributes)
     * @method _IH_Service_C|Service[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Service_C|Service[] get(array|string $columns = ['*'])
     * @method Service getModel()
     * @method Service[] getModels(array|string $columns = ['*'])
     * @method _IH_Service_C|Service[] hydrate(array $items)
     * @method Service make(array $attributes = [])
     * @method Service newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Service[]|_IH_Service_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Service[]|_IH_Service_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Service sole(array|string $columns = ['*'])
     * @method Service updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Service_QB extends _BaseBuilder {}
    
    /**
     * @method Serviceadditional|null getOrPut($key, $value)
     * @method Serviceadditional|$this shift(int $count = 1)
     * @method Serviceadditional|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Serviceadditional|$this pop(int $count = 1)
     * @method Serviceadditional|null pull($key, $default = null)
     * @method Serviceadditional|null last(callable $callback = null, $default = null)
     * @method Serviceadditional|$this random(int|null $number = null)
     * @method Serviceadditional|null sole($key = null, $operator = null, $value = null)
     * @method Serviceadditional|null get($key, $default = null)
     * @method Serviceadditional|null first(callable $callback = null, $default = null)
     * @method Serviceadditional|null firstWhere(string $key, $operator = null, $value = null)
     * @method Serviceadditional|null find($key, $default = null)
     * @method Serviceadditional[] all()
     */
    class _IH_Serviceadditional_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Serviceadditional[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Serviceadditional_QB whereId($value)
     * @method _IH_Serviceadditional_QB whereServiceId($value)
     * @method _IH_Serviceadditional_QB whereSellerId($value)
     * @method _IH_Serviceadditional_QB whereAdditionalServiceTitle($value)
     * @method _IH_Serviceadditional_QB whereAdditionalServicePrice($value)
     * @method _IH_Serviceadditional_QB whereAdditionalServiceQuantity($value)
     * @method _IH_Serviceadditional_QB whereAdditionalServiceImage($value)
     * @method _IH_Serviceadditional_QB whereCreatedAt($value)
     * @method _IH_Serviceadditional_QB whereUpdatedAt($value)
     * @method Serviceadditional baseSole(array|string $columns = ['*'])
     * @method Serviceadditional create(array $attributes = [])
     * @method _IH_Serviceadditional_C|Serviceadditional[] cursor()
     * @method Serviceadditional|null|_IH_Serviceadditional_C|Serviceadditional[] find($id, array $columns = ['*'])
     * @method _IH_Serviceadditional_C|Serviceadditional[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Serviceadditional|_IH_Serviceadditional_C|Serviceadditional[] findOrFail($id, array $columns = ['*'])
     * @method Serviceadditional|_IH_Serviceadditional_C|Serviceadditional[] findOrNew($id, array $columns = ['*'])
     * @method Serviceadditional first(array|string $columns = ['*'])
     * @method Serviceadditional firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Serviceadditional firstOrCreate(array $attributes = [], array $values = [])
     * @method Serviceadditional firstOrFail(array $columns = ['*'])
     * @method Serviceadditional firstOrNew(array $attributes = [], array $values = [])
     * @method Serviceadditional firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Serviceadditional forceCreate(array $attributes)
     * @method _IH_Serviceadditional_C|Serviceadditional[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Serviceadditional_C|Serviceadditional[] get(array|string $columns = ['*'])
     * @method Serviceadditional getModel()
     * @method Serviceadditional[] getModels(array|string $columns = ['*'])
     * @method _IH_Serviceadditional_C|Serviceadditional[] hydrate(array $items)
     * @method Serviceadditional make(array $attributes = [])
     * @method Serviceadditional newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Serviceadditional[]|_IH_Serviceadditional_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Serviceadditional[]|_IH_Serviceadditional_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Serviceadditional sole(array|string $columns = ['*'])
     * @method Serviceadditional updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Serviceadditional_QB extends _BaseBuilder {}
    
    /**
     * @method Serviceattribute|null getOrPut($key, $value)
     * @method Serviceattribute|$this shift(int $count = 1)
     * @method Serviceattribute|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Serviceattribute|$this pop(int $count = 1)
     * @method Serviceattribute|null pull($key, $default = null)
     * @method Serviceattribute|null last(callable $callback = null, $default = null)
     * @method Serviceattribute|$this random(int|null $number = null)
     * @method Serviceattribute|null sole($key = null, $operator = null, $value = null)
     * @method Serviceattribute|null get($key, $default = null)
     * @method Serviceattribute|null first(callable $callback = null, $default = null)
     * @method Serviceattribute|null firstWhere(string $key, $operator = null, $value = null)
     * @method Serviceattribute|null find($key, $default = null)
     * @method Serviceattribute[] all()
     */
    class _IH_Serviceattribute_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Serviceattribute[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method Serviceattribute baseSole(array|string $columns = ['*'])
     * @method Serviceattribute create(array $attributes = [])
     * @method _IH_Serviceattribute_C|Serviceattribute[] cursor()
     * @method Serviceattribute|null|_IH_Serviceattribute_C|Serviceattribute[] find($id, array $columns = ['*'])
     * @method _IH_Serviceattribute_C|Serviceattribute[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Serviceattribute|_IH_Serviceattribute_C|Serviceattribute[] findOrFail($id, array $columns = ['*'])
     * @method Serviceattribute|_IH_Serviceattribute_C|Serviceattribute[] findOrNew($id, array $columns = ['*'])
     * @method Serviceattribute first(array|string $columns = ['*'])
     * @method Serviceattribute firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Serviceattribute firstOrCreate(array $attributes = [], array $values = [])
     * @method Serviceattribute firstOrFail(array $columns = ['*'])
     * @method Serviceattribute firstOrNew(array $attributes = [], array $values = [])
     * @method Serviceattribute firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Serviceattribute forceCreate(array $attributes)
     * @method _IH_Serviceattribute_C|Serviceattribute[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Serviceattribute_C|Serviceattribute[] get(array|string $columns = ['*'])
     * @method Serviceattribute getModel()
     * @method Serviceattribute[] getModels(array|string $columns = ['*'])
     * @method _IH_Serviceattribute_C|Serviceattribute[] hydrate(array $items)
     * @method Serviceattribute make(array $attributes = [])
     * @method Serviceattribute newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Serviceattribute[]|_IH_Serviceattribute_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Serviceattribute[]|_IH_Serviceattribute_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Serviceattribute sole(array|string $columns = ['*'])
     * @method Serviceattribute updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Serviceattribute_QB extends _BaseBuilder {}
    
    /**
     * @method Servicebenifit|null getOrPut($key, $value)
     * @method Servicebenifit|$this shift(int $count = 1)
     * @method Servicebenifit|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Servicebenifit|$this pop(int $count = 1)
     * @method Servicebenifit|null pull($key, $default = null)
     * @method Servicebenifit|null last(callable $callback = null, $default = null)
     * @method Servicebenifit|$this random(int|null $number = null)
     * @method Servicebenifit|null sole($key = null, $operator = null, $value = null)
     * @method Servicebenifit|null get($key, $default = null)
     * @method Servicebenifit|null first(callable $callback = null, $default = null)
     * @method Servicebenifit|null firstWhere(string $key, $operator = null, $value = null)
     * @method Servicebenifit|null find($key, $default = null)
     * @method Servicebenifit[] all()
     */
    class _IH_Servicebenifit_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Servicebenifit[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Servicebenifit_QB whereId($value)
     * @method _IH_Servicebenifit_QB whereServiceId($value)
     * @method _IH_Servicebenifit_QB whereSellerId($value)
     * @method _IH_Servicebenifit_QB whereBenifits($value)
     * @method _IH_Servicebenifit_QB whereCreatedAt($value)
     * @method _IH_Servicebenifit_QB whereUpdatedAt($value)
     * @method Servicebenifit baseSole(array|string $columns = ['*'])
     * @method Servicebenifit create(array $attributes = [])
     * @method _IH_Servicebenifit_C|Servicebenifit[] cursor()
     * @method Servicebenifit|null|_IH_Servicebenifit_C|Servicebenifit[] find($id, array $columns = ['*'])
     * @method _IH_Servicebenifit_C|Servicebenifit[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Servicebenifit|_IH_Servicebenifit_C|Servicebenifit[] findOrFail($id, array $columns = ['*'])
     * @method Servicebenifit|_IH_Servicebenifit_C|Servicebenifit[] findOrNew($id, array $columns = ['*'])
     * @method Servicebenifit first(array|string $columns = ['*'])
     * @method Servicebenifit firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Servicebenifit firstOrCreate(array $attributes = [], array $values = [])
     * @method Servicebenifit firstOrFail(array $columns = ['*'])
     * @method Servicebenifit firstOrNew(array $attributes = [], array $values = [])
     * @method Servicebenifit firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Servicebenifit forceCreate(array $attributes)
     * @method _IH_Servicebenifit_C|Servicebenifit[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Servicebenifit_C|Servicebenifit[] get(array|string $columns = ['*'])
     * @method Servicebenifit getModel()
     * @method Servicebenifit[] getModels(array|string $columns = ['*'])
     * @method _IH_Servicebenifit_C|Servicebenifit[] hydrate(array $items)
     * @method Servicebenifit make(array $attributes = [])
     * @method Servicebenifit newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Servicebenifit[]|_IH_Servicebenifit_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Servicebenifit[]|_IH_Servicebenifit_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Servicebenifit sole(array|string $columns = ['*'])
     * @method Servicebenifit updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Servicebenifit_QB extends _BaseBuilder {}
    
    /**
     * @method Serviceinclude|null getOrPut($key, $value)
     * @method Serviceinclude|$this shift(int $count = 1)
     * @method Serviceinclude|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Serviceinclude|$this pop(int $count = 1)
     * @method Serviceinclude|null pull($key, $default = null)
     * @method Serviceinclude|null last(callable $callback = null, $default = null)
     * @method Serviceinclude|$this random(int|null $number = null)
     * @method Serviceinclude|null sole($key = null, $operator = null, $value = null)
     * @method Serviceinclude|null get($key, $default = null)
     * @method Serviceinclude|null first(callable $callback = null, $default = null)
     * @method Serviceinclude|null firstWhere(string $key, $operator = null, $value = null)
     * @method Serviceinclude|null find($key, $default = null)
     * @method Serviceinclude[] all()
     */
    class _IH_Serviceinclude_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Serviceinclude[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Serviceinclude_QB whereId($value)
     * @method _IH_Serviceinclude_QB whereServiceId($value)
     * @method _IH_Serviceinclude_QB whereSellerId($value)
     * @method _IH_Serviceinclude_QB whereIncludeServiceTitle($value)
     * @method _IH_Serviceinclude_QB whereIncludeServicePrice($value)
     * @method _IH_Serviceinclude_QB whereIncludeServiceQuantity($value)
     * @method _IH_Serviceinclude_QB whereCreatedAt($value)
     * @method _IH_Serviceinclude_QB whereUpdatedAt($value)
     * @method Serviceinclude baseSole(array|string $columns = ['*'])
     * @method Serviceinclude create(array $attributes = [])
     * @method _IH_Serviceinclude_C|Serviceinclude[] cursor()
     * @method Serviceinclude|null|_IH_Serviceinclude_C|Serviceinclude[] find($id, array $columns = ['*'])
     * @method _IH_Serviceinclude_C|Serviceinclude[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Serviceinclude|_IH_Serviceinclude_C|Serviceinclude[] findOrFail($id, array $columns = ['*'])
     * @method Serviceinclude|_IH_Serviceinclude_C|Serviceinclude[] findOrNew($id, array $columns = ['*'])
     * @method Serviceinclude first(array|string $columns = ['*'])
     * @method Serviceinclude firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Serviceinclude firstOrCreate(array $attributes = [], array $values = [])
     * @method Serviceinclude firstOrFail(array $columns = ['*'])
     * @method Serviceinclude firstOrNew(array $attributes = [], array $values = [])
     * @method Serviceinclude firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Serviceinclude forceCreate(array $attributes)
     * @method _IH_Serviceinclude_C|Serviceinclude[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Serviceinclude_C|Serviceinclude[] get(array|string $columns = ['*'])
     * @method Serviceinclude getModel()
     * @method Serviceinclude[] getModels(array|string $columns = ['*'])
     * @method _IH_Serviceinclude_C|Serviceinclude[] hydrate(array $items)
     * @method Serviceinclude make(array $attributes = [])
     * @method Serviceinclude newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Serviceinclude[]|_IH_Serviceinclude_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Serviceinclude[]|_IH_Serviceinclude_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Serviceinclude sole(array|string $columns = ['*'])
     * @method Serviceinclude updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Serviceinclude_QB extends _BaseBuilder {}
    
    /**
     * @method Slider|null getOrPut($key, $value)
     * @method Slider|$this shift(int $count = 1)
     * @method Slider|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Slider|$this pop(int $count = 1)
     * @method Slider|null pull($key, $default = null)
     * @method Slider|null last(callable $callback = null, $default = null)
     * @method Slider|$this random(int|null $number = null)
     * @method Slider|null sole($key = null, $operator = null, $value = null)
     * @method Slider|null get($key, $default = null)
     * @method Slider|null first(callable $callback = null, $default = null)
     * @method Slider|null firstWhere(string $key, $operator = null, $value = null)
     * @method Slider|null find($key, $default = null)
     * @method Slider[] all()
     */
    class _IH_Slider_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Slider[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Slider_QB whereId($value)
     * @method _IH_Slider_QB whereBackgroundImage($value)
     * @method _IH_Slider_QB whereTitle($value)
     * @method _IH_Slider_QB whereSubTitle($value)
     * @method _IH_Slider_QB whereServiceId($value)
     * @method _IH_Slider_QB whereCreatedAt($value)
     * @method _IH_Slider_QB whereUpdatedAt($value)
     * @method Slider baseSole(array|string $columns = ['*'])
     * @method Slider create(array $attributes = [])
     * @method _IH_Slider_C|Slider[] cursor()
     * @method Slider|null|_IH_Slider_C|Slider[] find($id, array $columns = ['*'])
     * @method _IH_Slider_C|Slider[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Slider|_IH_Slider_C|Slider[] findOrFail($id, array $columns = ['*'])
     * @method Slider|_IH_Slider_C|Slider[] findOrNew($id, array $columns = ['*'])
     * @method Slider first(array|string $columns = ['*'])
     * @method Slider firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Slider firstOrCreate(array $attributes = [], array $values = [])
     * @method Slider firstOrFail(array $columns = ['*'])
     * @method Slider firstOrNew(array $attributes = [], array $values = [])
     * @method Slider firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Slider forceCreate(array $attributes)
     * @method _IH_Slider_C|Slider[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Slider_C|Slider[] get(array|string $columns = ['*'])
     * @method Slider getModel()
     * @method Slider[] getModels(array|string $columns = ['*'])
     * @method _IH_Slider_C|Slider[] hydrate(array $items)
     * @method Slider make(array $attributes = [])
     * @method Slider newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Slider[]|_IH_Slider_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Slider[]|_IH_Slider_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Slider sole(array|string $columns = ['*'])
     * @method Slider updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Slider_QB extends _BaseBuilder {}
    
    /**
     * @method SocialIcon|null getOrPut($key, $value)
     * @method SocialIcon|$this shift(int $count = 1)
     * @method SocialIcon|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SocialIcon|$this pop(int $count = 1)
     * @method SocialIcon|null pull($key, $default = null)
     * @method SocialIcon|null last(callable $callback = null, $default = null)
     * @method SocialIcon|$this random(int|null $number = null)
     * @method SocialIcon|null sole($key = null, $operator = null, $value = null)
     * @method SocialIcon|null get($key, $default = null)
     * @method SocialIcon|null first(callable $callback = null, $default = null)
     * @method SocialIcon|null firstWhere(string $key, $operator = null, $value = null)
     * @method SocialIcon|null find($key, $default = null)
     * @method SocialIcon[] all()
     */
    class _IH_SocialIcon_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SocialIcon[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SocialIcon_QB whereId($value)
     * @method _IH_SocialIcon_QB whereIcon($value)
     * @method _IH_SocialIcon_QB whereUrl($value)
     * @method _IH_SocialIcon_QB whereCreatedAt($value)
     * @method _IH_SocialIcon_QB whereUpdatedAt($value)
     * @method SocialIcon baseSole(array|string $columns = ['*'])
     * @method SocialIcon create(array $attributes = [])
     * @method _IH_SocialIcon_C|SocialIcon[] cursor()
     * @method SocialIcon|null|_IH_SocialIcon_C|SocialIcon[] find($id, array $columns = ['*'])
     * @method _IH_SocialIcon_C|SocialIcon[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SocialIcon|_IH_SocialIcon_C|SocialIcon[] findOrFail($id, array $columns = ['*'])
     * @method SocialIcon|_IH_SocialIcon_C|SocialIcon[] findOrNew($id, array $columns = ['*'])
     * @method SocialIcon first(array|string $columns = ['*'])
     * @method SocialIcon firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SocialIcon firstOrCreate(array $attributes = [], array $values = [])
     * @method SocialIcon firstOrFail(array $columns = ['*'])
     * @method SocialIcon firstOrNew(array $attributes = [], array $values = [])
     * @method SocialIcon firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SocialIcon forceCreate(array $attributes)
     * @method _IH_SocialIcon_C|SocialIcon[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SocialIcon_C|SocialIcon[] get(array|string $columns = ['*'])
     * @method SocialIcon getModel()
     * @method SocialIcon[] getModels(array|string $columns = ['*'])
     * @method _IH_SocialIcon_C|SocialIcon[] hydrate(array $items)
     * @method SocialIcon make(array $attributes = [])
     * @method SocialIcon newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SocialIcon[]|_IH_SocialIcon_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SocialIcon[]|_IH_SocialIcon_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SocialIcon sole(array|string $columns = ['*'])
     * @method SocialIcon updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SocialIcon_QB extends _BaseBuilder {}
    
    /**
     * @method StaticOption|null getOrPut($key, $value)
     * @method StaticOption|$this shift(int $count = 1)
     * @method StaticOption|null firstOrFail($key = null, $operator = null, $value = null)
     * @method StaticOption|$this pop(int $count = 1)
     * @method StaticOption|null pull($key, $default = null)
     * @method StaticOption|null last(callable $callback = null, $default = null)
     * @method StaticOption|$this random(int|null $number = null)
     * @method StaticOption|null sole($key = null, $operator = null, $value = null)
     * @method StaticOption|null get($key, $default = null)
     * @method StaticOption|null first(callable $callback = null, $default = null)
     * @method StaticOption|null firstWhere(string $key, $operator = null, $value = null)
     * @method StaticOption|null find($key, $default = null)
     * @method StaticOption[] all()
     */
    class _IH_StaticOption_C extends _BaseCollection {
        /**
         * @param int $size
         * @return StaticOption[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_StaticOption_QB whereId($value)
     * @method _IH_StaticOption_QB whereOptionName($value)
     * @method _IH_StaticOption_QB whereOptionValue($value)
     * @method _IH_StaticOption_QB whereCreatedAt($value)
     * @method _IH_StaticOption_QB whereUpdatedAt($value)
     * @method StaticOption baseSole(array|string $columns = ['*'])
     * @method StaticOption create(array $attributes = [])
     * @method _IH_StaticOption_C|StaticOption[] cursor()
     * @method StaticOption|null|_IH_StaticOption_C|StaticOption[] find($id, array $columns = ['*'])
     * @method _IH_StaticOption_C|StaticOption[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method StaticOption|_IH_StaticOption_C|StaticOption[] findOrFail($id, array $columns = ['*'])
     * @method StaticOption|_IH_StaticOption_C|StaticOption[] findOrNew($id, array $columns = ['*'])
     * @method StaticOption first(array|string $columns = ['*'])
     * @method StaticOption firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method StaticOption firstOrCreate(array $attributes = [], array $values = [])
     * @method StaticOption firstOrFail(array $columns = ['*'])
     * @method StaticOption firstOrNew(array $attributes = [], array $values = [])
     * @method StaticOption firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method StaticOption forceCreate(array $attributes)
     * @method _IH_StaticOption_C|StaticOption[] fromQuery(string $query, array $bindings = [])
     * @method _IH_StaticOption_C|StaticOption[] get(array|string $columns = ['*'])
     * @method StaticOption getModel()
     * @method StaticOption[] getModels(array|string $columns = ['*'])
     * @method _IH_StaticOption_C|StaticOption[] hydrate(array $items)
     * @method StaticOption make(array $attributes = [])
     * @method StaticOption newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|StaticOption[]|_IH_StaticOption_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|StaticOption[]|_IH_StaticOption_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method StaticOption sole(array|string $columns = ['*'])
     * @method StaticOption updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_StaticOption_QB extends _BaseBuilder {}
    
    /**
     * @method Subcategory|null getOrPut($key, $value)
     * @method Subcategory|$this shift(int $count = 1)
     * @method Subcategory|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Subcategory|$this pop(int $count = 1)
     * @method Subcategory|null pull($key, $default = null)
     * @method Subcategory|null last(callable $callback = null, $default = null)
     * @method Subcategory|$this random(int|null $number = null)
     * @method Subcategory|null sole($key = null, $operator = null, $value = null)
     * @method Subcategory|null get($key, $default = null)
     * @method Subcategory|null first(callable $callback = null, $default = null)
     * @method Subcategory|null firstWhere(string $key, $operator = null, $value = null)
     * @method Subcategory|null find($key, $default = null)
     * @method Subcategory[] all()
     */
    class _IH_Subcategory_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Subcategory[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Subcategory_QB whereId($value)
     * @method _IH_Subcategory_QB whereCategoryId($value)
     * @method _IH_Subcategory_QB whereName($value)
     * @method _IH_Subcategory_QB whereSlug($value)
     * @method _IH_Subcategory_QB whereImage($value)
     * @method _IH_Subcategory_QB whereStatus($value)
     * @method _IH_Subcategory_QB whereCreatedAt($value)
     * @method _IH_Subcategory_QB whereUpdatedAt($value)
     * @method Subcategory baseSole(array|string $columns = ['*'])
     * @method Subcategory create(array $attributes = [])
     * @method _IH_Subcategory_C|Subcategory[] cursor()
     * @method Subcategory|null|_IH_Subcategory_C|Subcategory[] find($id, array $columns = ['*'])
     * @method _IH_Subcategory_C|Subcategory[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Subcategory|_IH_Subcategory_C|Subcategory[] findOrFail($id, array $columns = ['*'])
     * @method Subcategory|_IH_Subcategory_C|Subcategory[] findOrNew($id, array $columns = ['*'])
     * @method Subcategory first(array|string $columns = ['*'])
     * @method Subcategory firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Subcategory firstOrCreate(array $attributes = [], array $values = [])
     * @method Subcategory firstOrFail(array $columns = ['*'])
     * @method Subcategory firstOrNew(array $attributes = [], array $values = [])
     * @method Subcategory firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Subcategory forceCreate(array $attributes)
     * @method _IH_Subcategory_C|Subcategory[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Subcategory_C|Subcategory[] get(array|string $columns = ['*'])
     * @method Subcategory getModel()
     * @method Subcategory[] getModels(array|string $columns = ['*'])
     * @method _IH_Subcategory_C|Subcategory[] hydrate(array $items)
     * @method Subcategory make(array $attributes = [])
     * @method Subcategory newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Subcategory[]|_IH_Subcategory_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Subcategory[]|_IH_Subcategory_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Subcategory sole(array|string $columns = ['*'])
     * @method Subcategory updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Subcategory_QB extends _BaseBuilder {}
    
    /**
     * @method SupportTicketMessage|null getOrPut($key, $value)
     * @method SupportTicketMessage|$this shift(int $count = 1)
     * @method SupportTicketMessage|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SupportTicketMessage|$this pop(int $count = 1)
     * @method SupportTicketMessage|null pull($key, $default = null)
     * @method SupportTicketMessage|null last(callable $callback = null, $default = null)
     * @method SupportTicketMessage|$this random(int|null $number = null)
     * @method SupportTicketMessage|null sole($key = null, $operator = null, $value = null)
     * @method SupportTicketMessage|null get($key, $default = null)
     * @method SupportTicketMessage|null first(callable $callback = null, $default = null)
     * @method SupportTicketMessage|null firstWhere(string $key, $operator = null, $value = null)
     * @method SupportTicketMessage|null find($key, $default = null)
     * @method SupportTicketMessage[] all()
     */
    class _IH_SupportTicketMessage_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SupportTicketMessage[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SupportTicketMessage_QB whereId($value)
     * @method _IH_SupportTicketMessage_QB whereMessage($value)
     * @method _IH_SupportTicketMessage_QB whereNotify($value)
     * @method _IH_SupportTicketMessage_QB whereAttachment($value)
     * @method _IH_SupportTicketMessage_QB whereType($value)
     * @method _IH_SupportTicketMessage_QB whereSupportTicketId($value)
     * @method _IH_SupportTicketMessage_QB whereCreatedAt($value)
     * @method _IH_SupportTicketMessage_QB whereUpdatedAt($value)
     * @method SupportTicketMessage baseSole(array|string $columns = ['*'])
     * @method SupportTicketMessage create(array $attributes = [])
     * @method _IH_SupportTicketMessage_C|SupportTicketMessage[] cursor()
     * @method SupportTicketMessage|null|_IH_SupportTicketMessage_C|SupportTicketMessage[] find($id, array $columns = ['*'])
     * @method _IH_SupportTicketMessage_C|SupportTicketMessage[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SupportTicketMessage|_IH_SupportTicketMessage_C|SupportTicketMessage[] findOrFail($id, array $columns = ['*'])
     * @method SupportTicketMessage|_IH_SupportTicketMessage_C|SupportTicketMessage[] findOrNew($id, array $columns = ['*'])
     * @method SupportTicketMessage first(array|string $columns = ['*'])
     * @method SupportTicketMessage firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SupportTicketMessage firstOrCreate(array $attributes = [], array $values = [])
     * @method SupportTicketMessage firstOrFail(array $columns = ['*'])
     * @method SupportTicketMessage firstOrNew(array $attributes = [], array $values = [])
     * @method SupportTicketMessage firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SupportTicketMessage forceCreate(array $attributes)
     * @method _IH_SupportTicketMessage_C|SupportTicketMessage[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SupportTicketMessage_C|SupportTicketMessage[] get(array|string $columns = ['*'])
     * @method SupportTicketMessage getModel()
     * @method SupportTicketMessage[] getModels(array|string $columns = ['*'])
     * @method _IH_SupportTicketMessage_C|SupportTicketMessage[] hydrate(array $items)
     * @method SupportTicketMessage make(array $attributes = [])
     * @method SupportTicketMessage newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SupportTicketMessage[]|_IH_SupportTicketMessage_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SupportTicketMessage[]|_IH_SupportTicketMessage_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SupportTicketMessage sole(array|string $columns = ['*'])
     * @method SupportTicketMessage updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SupportTicketMessage_QB extends _BaseBuilder {}
    
    /**
     * @method SupportTicket|null getOrPut($key, $value)
     * @method SupportTicket|$this shift(int $count = 1)
     * @method SupportTicket|null firstOrFail($key = null, $operator = null, $value = null)
     * @method SupportTicket|$this pop(int $count = 1)
     * @method SupportTicket|null pull($key, $default = null)
     * @method SupportTicket|null last(callable $callback = null, $default = null)
     * @method SupportTicket|$this random(int|null $number = null)
     * @method SupportTicket|null sole($key = null, $operator = null, $value = null)
     * @method SupportTicket|null get($key, $default = null)
     * @method SupportTicket|null first(callable $callback = null, $default = null)
     * @method SupportTicket|null firstWhere(string $key, $operator = null, $value = null)
     * @method SupportTicket|null find($key, $default = null)
     * @method SupportTicket[] all()
     */
    class _IH_SupportTicket_C extends _BaseCollection {
        /**
         * @param int $size
         * @return SupportTicket[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_SupportTicket_QB whereId($value)
     * @method _IH_SupportTicket_QB whereTitle($value)
     * @method _IH_SupportTicket_QB whereVia($value)
     * @method _IH_SupportTicket_QB whereOperatingSystem($value)
     * @method _IH_SupportTicket_QB whereUserAgent($value)
     * @method _IH_SupportTicket_QB whereDescription($value)
     * @method _IH_SupportTicket_QB whereSubject($value)
     * @method _IH_SupportTicket_QB whereStatus($value)
     * @method _IH_SupportTicket_QB wherePriority($value)
     * @method _IH_SupportTicket_QB whereDepartment($value)
     * @method _IH_SupportTicket_QB whereUserId($value)
     * @method _IH_SupportTicket_QB whereBuyerId($value)
     * @method _IH_SupportTicket_QB whereSellerId($value)
     * @method _IH_SupportTicket_QB whereServiceId($value)
     * @method _IH_SupportTicket_QB whereOrderId($value)
     * @method _IH_SupportTicket_QB whereAdminId($value)
     * @method _IH_SupportTicket_QB whereCreatedAt($value)
     * @method _IH_SupportTicket_QB whereUpdatedAt($value)
     * @method SupportTicket baseSole(array|string $columns = ['*'])
     * @method SupportTicket create(array $attributes = [])
     * @method _IH_SupportTicket_C|SupportTicket[] cursor()
     * @method SupportTicket|null|_IH_SupportTicket_C|SupportTicket[] find($id, array $columns = ['*'])
     * @method _IH_SupportTicket_C|SupportTicket[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method SupportTicket|_IH_SupportTicket_C|SupportTicket[] findOrFail($id, array $columns = ['*'])
     * @method SupportTicket|_IH_SupportTicket_C|SupportTicket[] findOrNew($id, array $columns = ['*'])
     * @method SupportTicket first(array|string $columns = ['*'])
     * @method SupportTicket firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method SupportTicket firstOrCreate(array $attributes = [], array $values = [])
     * @method SupportTicket firstOrFail(array $columns = ['*'])
     * @method SupportTicket firstOrNew(array $attributes = [], array $values = [])
     * @method SupportTicket firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method SupportTicket forceCreate(array $attributes)
     * @method _IH_SupportTicket_C|SupportTicket[] fromQuery(string $query, array $bindings = [])
     * @method _IH_SupportTicket_C|SupportTicket[] get(array|string $columns = ['*'])
     * @method SupportTicket getModel()
     * @method SupportTicket[] getModels(array|string $columns = ['*'])
     * @method _IH_SupportTicket_C|SupportTicket[] hydrate(array $items)
     * @method SupportTicket make(array $attributes = [])
     * @method SupportTicket newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|SupportTicket[]|_IH_SupportTicket_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|SupportTicket[]|_IH_SupportTicket_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method SupportTicket sole(array|string $columns = ['*'])
     * @method SupportTicket updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_SupportTicket_QB extends _BaseBuilder {}
    
    /**
     * @method Tag|null getOrPut($key, $value)
     * @method Tag|$this shift(int $count = 1)
     * @method Tag|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Tag|$this pop(int $count = 1)
     * @method Tag|null pull($key, $default = null)
     * @method Tag|null last(callable $callback = null, $default = null)
     * @method Tag|$this random(int|null $number = null)
     * @method Tag|null sole($key = null, $operator = null, $value = null)
     * @method Tag|null get($key, $default = null)
     * @method Tag|null first(callable $callback = null, $default = null)
     * @method Tag|null firstWhere(string $key, $operator = null, $value = null)
     * @method Tag|null find($key, $default = null)
     * @method Tag[] all()
     */
    class _IH_Tag_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Tag[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Tag_QB whereId($value)
     * @method _IH_Tag_QB whereName($value)
     * @method _IH_Tag_QB whereStatus($value)
     * @method _IH_Tag_QB whereCreatedAt($value)
     * @method _IH_Tag_QB whereUpdatedAt($value)
     * @method Tag baseSole(array|string $columns = ['*'])
     * @method Tag create(array $attributes = [])
     * @method _IH_Tag_C|Tag[] cursor()
     * @method Tag|null|_IH_Tag_C|Tag[] find($id, array $columns = ['*'])
     * @method _IH_Tag_C|Tag[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Tag|_IH_Tag_C|Tag[] findOrFail($id, array $columns = ['*'])
     * @method Tag|_IH_Tag_C|Tag[] findOrNew($id, array $columns = ['*'])
     * @method Tag first(array|string $columns = ['*'])
     * @method Tag firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Tag firstOrCreate(array $attributes = [], array $values = [])
     * @method Tag firstOrFail(array $columns = ['*'])
     * @method Tag firstOrNew(array $attributes = [], array $values = [])
     * @method Tag firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Tag forceCreate(array $attributes)
     * @method _IH_Tag_C|Tag[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Tag_C|Tag[] get(array|string $columns = ['*'])
     * @method Tag getModel()
     * @method Tag[] getModels(array|string $columns = ['*'])
     * @method _IH_Tag_C|Tag[] hydrate(array $items)
     * @method Tag make(array $attributes = [])
     * @method Tag newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Tag[]|_IH_Tag_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Tag[]|_IH_Tag_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Tag sole(array|string $columns = ['*'])
     * @method Tag updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Tag_QB extends _BaseBuilder {}
    
    /**
     * @method Tax|null getOrPut($key, $value)
     * @method Tax|$this shift(int $count = 1)
     * @method Tax|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Tax|$this pop(int $count = 1)
     * @method Tax|null pull($key, $default = null)
     * @method Tax|null last(callable $callback = null, $default = null)
     * @method Tax|$this random(int|null $number = null)
     * @method Tax|null sole($key = null, $operator = null, $value = null)
     * @method Tax|null get($key, $default = null)
     * @method Tax|null first(callable $callback = null, $default = null)
     * @method Tax|null firstWhere(string $key, $operator = null, $value = null)
     * @method Tax|null find($key, $default = null)
     * @method Tax[] all()
     */
    class _IH_Tax_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Tax[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Tax_QB whereId($value)
     * @method _IH_Tax_QB whereTax($value)
     * @method _IH_Tax_QB whereCountryId($value)
     * @method _IH_Tax_QB whereCreatedAt($value)
     * @method _IH_Tax_QB whereUpdatedAt($value)
     * @method Tax baseSole(array|string $columns = ['*'])
     * @method Tax create(array $attributes = [])
     * @method _IH_Tax_C|Tax[] cursor()
     * @method Tax|null|_IH_Tax_C|Tax[] find($id, array $columns = ['*'])
     * @method _IH_Tax_C|Tax[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Tax|_IH_Tax_C|Tax[] findOrFail($id, array $columns = ['*'])
     * @method Tax|_IH_Tax_C|Tax[] findOrNew($id, array $columns = ['*'])
     * @method Tax first(array|string $columns = ['*'])
     * @method Tax firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Tax firstOrCreate(array $attributes = [], array $values = [])
     * @method Tax firstOrFail(array $columns = ['*'])
     * @method Tax firstOrNew(array $attributes = [], array $values = [])
     * @method Tax firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Tax forceCreate(array $attributes)
     * @method _IH_Tax_C|Tax[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Tax_C|Tax[] get(array|string $columns = ['*'])
     * @method Tax getModel()
     * @method Tax[] getModels(array|string $columns = ['*'])
     * @method _IH_Tax_C|Tax[] hydrate(array $items)
     * @method Tax make(array $attributes = [])
     * @method Tax newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Tax[]|_IH_Tax_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Tax[]|_IH_Tax_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Tax sole(array|string $columns = ['*'])
     * @method Tax updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Tax_QB extends _BaseBuilder {}
    
    /**
     * @method ToDoList|null getOrPut($key, $value)
     * @method ToDoList|$this shift(int $count = 1)
     * @method ToDoList|null firstOrFail($key = null, $operator = null, $value = null)
     * @method ToDoList|$this pop(int $count = 1)
     * @method ToDoList|null pull($key, $default = null)
     * @method ToDoList|null last(callable $callback = null, $default = null)
     * @method ToDoList|$this random(int|null $number = null)
     * @method ToDoList|null sole($key = null, $operator = null, $value = null)
     * @method ToDoList|null get($key, $default = null)
     * @method ToDoList|null first(callable $callback = null, $default = null)
     * @method ToDoList|null firstWhere(string $key, $operator = null, $value = null)
     * @method ToDoList|null find($key, $default = null)
     * @method ToDoList[] all()
     */
    class _IH_ToDoList_C extends _BaseCollection {
        /**
         * @param int $size
         * @return ToDoList[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_ToDoList_QB whereId($value)
     * @method _IH_ToDoList_QB whereTitle($value)
     * @method _IH_ToDoList_QB whereDescription($value)
     * @method _IH_ToDoList_QB whereUserId($value)
     * @method _IH_ToDoList_QB whereStatus($value)
     * @method _IH_ToDoList_QB whereCreatedAt($value)
     * @method _IH_ToDoList_QB whereUpdatedAt($value)
     * @method ToDoList baseSole(array|string $columns = ['*'])
     * @method ToDoList create(array $attributes = [])
     * @method _IH_ToDoList_C|ToDoList[] cursor()
     * @method ToDoList|null|_IH_ToDoList_C|ToDoList[] find($id, array $columns = ['*'])
     * @method _IH_ToDoList_C|ToDoList[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method ToDoList|_IH_ToDoList_C|ToDoList[] findOrFail($id, array $columns = ['*'])
     * @method ToDoList|_IH_ToDoList_C|ToDoList[] findOrNew($id, array $columns = ['*'])
     * @method ToDoList first(array|string $columns = ['*'])
     * @method ToDoList firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method ToDoList firstOrCreate(array $attributes = [], array $values = [])
     * @method ToDoList firstOrFail(array $columns = ['*'])
     * @method ToDoList firstOrNew(array $attributes = [], array $values = [])
     * @method ToDoList firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method ToDoList forceCreate(array $attributes)
     * @method _IH_ToDoList_C|ToDoList[] fromQuery(string $query, array $bindings = [])
     * @method _IH_ToDoList_C|ToDoList[] get(array|string $columns = ['*'])
     * @method ToDoList getModel()
     * @method ToDoList[] getModels(array|string $columns = ['*'])
     * @method _IH_ToDoList_C|ToDoList[] hydrate(array $items)
     * @method ToDoList make(array $attributes = [])
     * @method ToDoList newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|ToDoList[]|_IH_ToDoList_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|ToDoList[]|_IH_ToDoList_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method ToDoList sole(array|string $columns = ['*'])
     * @method ToDoList updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_ToDoList_QB extends _BaseBuilder {}
    
    /**
     * @method User|null getOrPut($key, $value)
     * @method User|$this shift(int $count = 1)
     * @method User|null firstOrFail($key = null, $operator = null, $value = null)
     * @method User|$this pop(int $count = 1)
     * @method User|null pull($key, $default = null)
     * @method User|null last(callable $callback = null, $default = null)
     * @method User|$this random(int|null $number = null)
     * @method User|null sole($key = null, $operator = null, $value = null)
     * @method User|null get($key, $default = null)
     * @method User|null first(callable $callback = null, $default = null)
     * @method User|null firstWhere(string $key, $operator = null, $value = null)
     * @method User|null find($key, $default = null)
     * @method User[] all()
     */
    class _IH_User_C extends _BaseCollection {
        /**
         * @param int $size
         * @return User[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_User_QB whereId($value)
     * @method _IH_User_QB whereName($value)
     * @method _IH_User_QB whereEmail($value)
     * @method _IH_User_QB whereUsername($value)
     * @method _IH_User_QB wherePassword($value)
     * @method _IH_User_QB wherePhone($value)
     * @method _IH_User_QB whereImage($value)
     * @method _IH_User_QB whereProfileBackground($value)
     * @method _IH_User_QB whereServiceCity($value)
     * @method _IH_User_QB whereServiceArea($value)
     * @method _IH_User_QB whereUserType($value)
     * @method _IH_User_QB whereUserStatus($value)
     * @method _IH_User_QB whereTermsCondition($value)
     * @method _IH_User_QB whereAddress($value)
     * @method _IH_User_QB whereState($value)
     * @method _IH_User_QB whereAbout($value)
     * @method _IH_User_QB wherePostCode($value)
     * @method _IH_User_QB whereCountryId($value)
     * @method _IH_User_QB whereEmailVerified($value)
     * @method _IH_User_QB whereEmailVerifyToken($value)
     * @method _IH_User_QB whereRememberToken($value)
     * @method _IH_User_QB whereCreatedAt($value)
     * @method _IH_User_QB whereUpdatedAt($value)
     * @method _IH_User_QB whereAutoPostApproval($value)
     * @method _IH_User_QB whereIsBanned($value)
     * @method _IH_User_QB wherePostPermission($value)
     * @method _IH_User_QB whereFacebookId($value)
     * @method _IH_User_QB whereGoogleId($value)
     * @method _IH_User_QB whereCountryCode($value)
     * @method User baseSole(array|string $columns = ['*'])
     * @method User create(array $attributes = [])
     * @method _IH_User_C|User[] cursor()
     * @method User|null|_IH_User_C|User[] find($id, array $columns = ['*'])
     * @method _IH_User_C|User[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method User|_IH_User_C|User[] findOrFail($id, array $columns = ['*'])
     * @method User|_IH_User_C|User[] findOrNew($id, array $columns = ['*'])
     * @method User first(array|string $columns = ['*'])
     * @method User firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method User firstOrCreate(array $attributes = [], array $values = [])
     * @method User firstOrFail(array $columns = ['*'])
     * @method User firstOrNew(array $attributes = [], array $values = [])
     * @method User firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method User forceCreate(array $attributes)
     * @method _IH_User_C|User[] fromQuery(string $query, array $bindings = [])
     * @method _IH_User_C|User[] get(array|string $columns = ['*'])
     * @method User getModel()
     * @method User[] getModels(array|string $columns = ['*'])
     * @method _IH_User_C|User[] hydrate(array $items)
     * @method User make(array $attributes = [])
     * @method User newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|User[]|_IH_User_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|User[]|_IH_User_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method User sole(array|string $columns = ['*'])
     * @method User updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_User_QB extends _BaseBuilder {}
    
    /**
     * @method Widgets|null getOrPut($key, $value)
     * @method Widgets|$this shift(int $count = 1)
     * @method Widgets|null firstOrFail($key = null, $operator = null, $value = null)
     * @method Widgets|$this pop(int $count = 1)
     * @method Widgets|null pull($key, $default = null)
     * @method Widgets|null last(callable $callback = null, $default = null)
     * @method Widgets|$this random(int|null $number = null)
     * @method Widgets|null sole($key = null, $operator = null, $value = null)
     * @method Widgets|null get($key, $default = null)
     * @method Widgets|null first(callable $callback = null, $default = null)
     * @method Widgets|null firstWhere(string $key, $operator = null, $value = null)
     * @method Widgets|null find($key, $default = null)
     * @method Widgets[] all()
     */
    class _IH_Widgets_C extends _BaseCollection {
        /**
         * @param int $size
         * @return Widgets[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
    
    /**
     * @method _IH_Widgets_QB whereId($value)
     * @method _IH_Widgets_QB whereWidgetArea($value)
     * @method _IH_Widgets_QB whereWidgetOrder($value)
     * @method _IH_Widgets_QB whereWidgetLocation($value)
     * @method _IH_Widgets_QB whereWidgetName($value)
     * @method _IH_Widgets_QB whereWidgetContent($value)
     * @method _IH_Widgets_QB whereCreatedAt($value)
     * @method _IH_Widgets_QB whereUpdatedAt($value)
     * @method Widgets baseSole(array|string $columns = ['*'])
     * @method Widgets create(array $attributes = [])
     * @method _IH_Widgets_C|Widgets[] cursor()
     * @method Widgets|null|_IH_Widgets_C|Widgets[] find($id, array $columns = ['*'])
     * @method _IH_Widgets_C|Widgets[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method Widgets|_IH_Widgets_C|Widgets[] findOrFail($id, array $columns = ['*'])
     * @method Widgets|_IH_Widgets_C|Widgets[] findOrNew($id, array $columns = ['*'])
     * @method Widgets first(array|string $columns = ['*'])
     * @method Widgets firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method Widgets firstOrCreate(array $attributes = [], array $values = [])
     * @method Widgets firstOrFail(array $columns = ['*'])
     * @method Widgets firstOrNew(array $attributes = [], array $values = [])
     * @method Widgets firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method Widgets forceCreate(array $attributes)
     * @method _IH_Widgets_C|Widgets[] fromQuery(string $query, array $bindings = [])
     * @method _IH_Widgets_C|Widgets[] get(array|string $columns = ['*'])
     * @method Widgets getModel()
     * @method Widgets[] getModels(array|string $columns = ['*'])
     * @method _IH_Widgets_C|Widgets[] hydrate(array $items)
     * @method Widgets make(array $attributes = [])
     * @method Widgets newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|Widgets[]|_IH_Widgets_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|Widgets[]|_IH_Widgets_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Widgets sole(array|string $columns = ['*'])
     * @method Widgets updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_Widgets_QB extends _BaseBuilder {}
}