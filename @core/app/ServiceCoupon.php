<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCoupon extends Model
{
    use HasFactory;

    protected $table = 'service_coupons';
    protected $fillable = ['code', 'discount', 'discount_type', 'expire_date', 'status', 'seller_id', 'user_type', 'services_ids', 'start_date', 'discount_type_time'];
}
