<?php

namespace Modules\Wallet\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletHistory extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id','payment_gateway','payment_status','amount','transaction_id','manual_payment_image','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Wallet\Database\factories\WalletHistoryFactory::new();
    }
}
