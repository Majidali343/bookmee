<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionCoupon extends Model
{
    use HasFactory;

    protected $fillable = ['code','discount','discount_type','expire_date','status'];
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionCouponFactory::new();
    }
}
