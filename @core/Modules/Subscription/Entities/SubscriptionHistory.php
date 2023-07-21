<?php

namespace Modules\Subscription\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_id',
        'seller_id',
        'type',
        'connect',
        'price',
        'coupon_code',
        'coupon_type',
        'coupon_amount',
        'price_with_discount',
        'expire_date',
        'payment_gateway',
        'payment_status',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionHistoryFactory::new();
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id','id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }
}
