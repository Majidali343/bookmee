<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicebenifit extends Model
{
    use HasFactory;

    protected $table = 'servicebenifits';
    protected $fillable = ['seller_id','service_id','benifits'];
}
