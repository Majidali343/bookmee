<?php

namespace Modules\Wallet\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id','balance','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Wallet\Database\factories\WalletFactory::new();
    }
}
