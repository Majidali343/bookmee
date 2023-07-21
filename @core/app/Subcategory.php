<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $fillable = ['name','slug','category_id','status','image'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function childcategories(){
        return $this->hasMany('App\ChildCategory');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }
    public function metaData(){
        return $this->morphOne(MetaData::class,'meta_taggable');
    }
}
