<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;

    protected $table = 'payout_requests';
    protected $fillable = ['seller_id','amount','payment_gateway','payment_receipt','seller_note','admin-note','status'];

    public function seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }
}
