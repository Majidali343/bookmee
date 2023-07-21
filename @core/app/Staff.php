<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff_services';

    protected $fillable = [
        'name',
        'email',
        'profile_image_id',
        'user_id',
    ];


    public function owner(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
