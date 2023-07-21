<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInclude extends Model
{
    use HasFactory;

    protected $table = 'order_includes';
    protected $fillable = ['order_id','title','price','quantity','status'];
}
