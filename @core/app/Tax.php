<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = ['tax','country_id'];

    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
}
