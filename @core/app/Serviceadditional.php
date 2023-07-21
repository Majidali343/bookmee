<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviceadditional extends Model
{
    use HasFactory;
    protected $table = 'serviceadditionals';
    protected $fillable = ['seller_id','service_id','additional_service_title','additional_service_price','additional_service_quantity','additional_service_image'];
}
