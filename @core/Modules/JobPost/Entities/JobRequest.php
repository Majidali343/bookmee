<?php

namespace Modules\JobPost\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'job_post_id',
        'is_hired',
        'expected_salary',
        'cover_letter',
    ];
    
    protected static function newFactory()
    {
        return \Modules\JobPost\Database\factories\JobRequestFactory::new();
    }

    public function job()
    {
        return $this->belongsTo(BuyerJob::class,'job_post_id','id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id','id');
    }
}
