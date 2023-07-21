<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCity extends Model
{
    use HasFactory;
    protected $table = 'service_cities';
    protected $fillable = ['service_city','status','country_id'];

    public function countryy()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function service_area()
    {
        return $this->hasOne(ServiceArea::class, 'country_id', 'id');
    }


}
