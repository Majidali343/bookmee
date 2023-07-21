<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditServiceHistory extends Model
{
    use HasFactory;
    protected $fillable = ['service_id','seller_id','service_title','service_description'];
}
