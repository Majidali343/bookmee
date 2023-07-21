<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    protected $table = 'widgets';
    protected $fillable = ['widget_area','widget_order','widget_name','widget_content','widget_location'];
}
