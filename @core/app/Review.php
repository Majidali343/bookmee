<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['service_id','order_id','seller_id','buyer_id','rating','name','email','message','status', 'type'];

    public function ratingMax($max)
    {
        return $this->avg('rating') <= $max;
    }

    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function buyer_for_mobile(){
        return $this->belongsTo(User::class,'buyer_id','id')
            ->select('id','image');
    }
}
