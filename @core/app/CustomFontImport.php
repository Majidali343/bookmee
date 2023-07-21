<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFontImport extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'status',
    ];
}
