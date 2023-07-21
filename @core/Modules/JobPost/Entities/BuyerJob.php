<?php

namespace Modules\JobPost\Entities;

use App\Category;
use App\ChildCategory;
use App\Country;
use App\Order;
use App\ServiceCity;
use App\Subcategory;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuyerJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'child_category_id',
        'buyer_id',
        'country_id',
        'city_id',
        'title',
        'slug',
        'description',
        'image',
        'status',
        'is_job_online',
        'is_job_on',
        'price',
        'dead_line',
        'view',
    ];
    
    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\BuyerJobFactory::new();
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function city(){
        return $this->belongsTo(ServiceCity::class,'city_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function sub_category(){
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }

    public function child_category(){
        return $this->belongsTo(ChildCategory::class,'child_category_id','id');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function job_request()
    {
        return $this->hasMany(JobRequest::class,'job_post_id','id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'job_post_id','id');
    }

    public function sellerViewJobs()
    {
        return $this->hasOne(SellerViewJob::class,'job_post_id','id');
    }
}
