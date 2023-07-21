<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountSettings extends Model
{
    use HasFactory;

    protected $table = 'amount_settings';
    protected $fillable = ['min_amount','max_amount'];
}
