<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    use HasFactory;

    protected $table = 'form_builders';
    protected $fillable = ['title','email','button_text','fields','success_message'];
}
