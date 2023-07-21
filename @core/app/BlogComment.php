<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $table = 'blog_comments';
    protected $fillable = ['blog_id','user_id','name','email','message'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    
}
