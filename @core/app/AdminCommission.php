<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCommission extends Model
{
    use HasFactory;

    protected $table = 'admin_commissions';
    protected $fillable = ['system_type','commission_charge_from','commission_charge_type','commission_charge'];
}
