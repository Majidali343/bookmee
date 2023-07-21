<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    protected $table = 'child_categories';
    protected $fillable = ['name','slug','category_id','sub_category_id','status','image'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function subcategory(){
        return $this->belongsTo( Subcategory::class, 'sub_category_id', 'id');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function metaData(){
        return $this->morphOne(MetaData::class,'meta_taggable');
    }

}
