<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdditional extends Model
{
    use HasFactory;

    protected $table = 'order_additionals';
    protected $fillable = ['order_id','title','price','quantity','status'];
}
