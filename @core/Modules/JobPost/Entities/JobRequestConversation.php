<?php

namespace Modules\JobPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobRequestConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'notify',
        'attachment',
        'job_request_id',
        'type'
    ];
    
    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\JobRequestConversationFactory::new();
    }
}
