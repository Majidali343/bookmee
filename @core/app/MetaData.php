<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    use HasFactory;
    protected $table = 'meta_data';
    protected $fillable = ['meta_taggable_id','meta_taggable_type','meta_title','meta_tags','meta_description','facebook_meta_tags','facebook_meta_description','facebook_meta_image','twitter_meta_tags','twitter_meta_description','twitter_meta_image'];

    public function meta_taggable(){
        return $this->morphTo();
    }
}
