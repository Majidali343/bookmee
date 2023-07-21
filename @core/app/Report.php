<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','service_id','seller_id','buyer_id','report_from','report_to','status','report'];

    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }
}
