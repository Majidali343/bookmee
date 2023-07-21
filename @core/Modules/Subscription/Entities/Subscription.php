<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $fillable = ['image','title','type','price','connect','service','job','status'];

    public function seller(){
        return $this->hasMany(SellerSubscription::class,'subscription_id','id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionFactory::new();
    }
}
