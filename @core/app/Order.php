<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Modules\JobPost\Entities\BuyerJob;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'service_id',
        'seller_id',
        'buyer_id',
        'name',
        'email',
        'phone',
        'post_code',
        'address',
        'city',
        'area',
        'country',
        'date',
        'schedule',
        'package_fee',
        'extra_service',
        'sub_total',
        'tax',
        'total',
        'coupon_code',
        'coupon_type',
        'coupon_amount',
        'commission_type',
        'commission_charge',
        'commission_amount',
        'payment_gateway',
        'payment_status',
        'status',
        'is_order_online',
        'order_note',
        'order_complete_request',
        'cancel_order_money_return',
        'manual_payment_image',
        'order_from_job',
        'job_post_id',
    ];
    
    protected $casts = [
        'status' => 'integer',
        'is_order_online' => 'integer'
    ];
    protected $dates = [
        'date',
    ];

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function service_city(){
        return $this->belongsTo(ServiceCity::class,'city','id');
    }

    public function service_area(){
        return $this->belongsTo(ServiceArea::class,'area','id');
    }

    public function service_country(){
        return $this->belongsTo(Country::class,'country','id');
    }

    public function orderIncludes(){
        return $this->hasmany(OrderInclude::class,'order_id','id');
    }

    public function orderAdditionals(){
        return $this->hasmany(OrderAdditional::class,'order_id','id');
    }
    public function extraSevices(){
        return $this->hasmany(ExtraService::class,'order_id','id');
    }
    
     public function online_order_ticket(){
        return $this->hasOne(SupportTicket::class,'order_id','id');
    }

    public function job(){
        return $this->belongsTo(BuyerJob::class,'job_post_id','id');
    }

    public function completedeclinehistory(){
        return $this->hasmany(OrderCompleteDecline::class,'order_id','id');
    }
}
