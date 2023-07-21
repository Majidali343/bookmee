<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    use HasFactory;

    protected $table = 'service_areas';
    protected $fillable = ['service_area', 'service_city_id', 'status', 'country_id'];

    public function city()
    {
        return $this->belongsTo(ServiceCity::class, 'service_city_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
