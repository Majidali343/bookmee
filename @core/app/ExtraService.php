<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    use HasFactory;
    protected $table = 'extra_services';
    protected $fillable = ['order_id','title','quantity','price','payment_gateway','manual_payment_gateway_image','tax','commission_amount','sub_total','total','transaction_id','payment_status','status'];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
