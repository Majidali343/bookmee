<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketMessage extends Model
{
    use HasFactory;

    protected $table = 'support_ticket_messages';
    protected $fillable = ['message','notify','attachment','support_ticket_id','type'];
}
