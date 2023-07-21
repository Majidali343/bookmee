<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerVerify extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'national_id',
        'address',
        'status',
    ];
    
    protected $casts = [
        'seller_id' => 'integer',
        'status' => 'integer'
    ];
}
