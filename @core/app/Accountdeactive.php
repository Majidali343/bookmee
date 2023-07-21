<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountdeactive extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','reason','description','status','account_status'];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
