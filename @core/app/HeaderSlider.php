<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeaderSlider extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['title','btn_text','btn_url','btn_status','image','bg_image'];
    public $translatable = ['title','btn_text'];

}
