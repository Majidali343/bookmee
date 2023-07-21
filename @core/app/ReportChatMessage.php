<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportChatMessage extends Model
{
    use HasFactory;
    protected $fillable = ['report_id','admin_id','seller_id','buyer_id','message','type','notify','attachment'];
}
