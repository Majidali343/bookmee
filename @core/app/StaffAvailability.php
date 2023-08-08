<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAvailability extends Model
{
    use HasFactory;

    protected $table = 'staff_availability';

    protected $fillable = [
        'staff_name',
        'staff_id',
        'date',
        'schedule',
    ];


    public function staff(){
        return $this->belongsTo(Staff::class,'staff_id','id');
    }
}
