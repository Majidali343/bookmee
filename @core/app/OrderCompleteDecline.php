<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCompleteDecline extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','buyer_id','seller_id','service_id','decline_reason','image'];

    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
