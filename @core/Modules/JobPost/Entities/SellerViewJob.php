<?php

namespace Modules\JobPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerViewJob extends Model
{
    use HasFactory;

    protected $fillable = ['job_post_id','seller_id','country_id'];
    
    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\SellerViewJobFactory::new();
    }
}
