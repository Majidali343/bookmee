<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDay extends Model
{
    use HasFactory;

    protected $fillable =[
        'day',
        'to_time',
        'from_time',
        'user_id',
    ];
}
