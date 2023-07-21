<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;


    protected $fillable = [
        'name',
        'email',
        'image',
        'role',
        'password',
        'username',
        'email_verified',
        'designation',
        'description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function blog(){
        return Blog::where(['admin_id' => $this->attributes['id'],'created_by' => 'admin'])->get();
    }

    public function media(){
        return MediaUpload::where(['user_id' => $this->attributes['id'],'type' => 'admin'])->get();
    }

}
