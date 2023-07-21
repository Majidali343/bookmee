<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = ['country','status'];

    public function tax(){
        return $this->belongsTo(Tax::class,'country_id','id');
    }

    public function cities(){
        return $this->hasMany(ServiceCity::class,'country_id','id');
    }

}

