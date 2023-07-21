<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviceinclude extends Model
{
    use HasFactory;

    protected $table = 'serviceincludes';
    protected $fillable = ['seller_id', 'service_id', 'include_service_title', 'include_service_price', 'include_service_quantity','staff_ids'];
}
