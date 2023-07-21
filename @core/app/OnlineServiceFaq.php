<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineServiceFaq extends Model
{
    use HasFactory;
    protected $table = 'online_service_faqs';
    protected $fillable = ['service_id','seller_id','title','description'];
}
