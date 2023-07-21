<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviceattribute extends Model
{
    use HasFactory;

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
