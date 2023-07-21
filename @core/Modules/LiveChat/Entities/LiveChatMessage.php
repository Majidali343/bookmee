<?php

namespace Modules\LiveChat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;

class LiveChatMessage extends Model
{
    use HasFactory;

    protected $table = 'live_chat_messages';
    protected $fillable = ['from_user','to_user','buyer_id','seller_id','message'];

    protected $appends = ['date_time_str', 'date_human_readable', 'image_url','sender_profile_image'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime(optional($this->created_at)->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return optional($this->created_at)->diffForHumans();
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? url('/') . '/assets/uploads/chat_image/' . $this->image : "";
    }

    public function getSenderProfileImageAttribute(){
        $image = User::select("image")->where("id",$this->from_user)->first();
        return optional($image)->image ? render_image_markup_by_attachment_id(optional($image)->image) : null;
    }
    
    protected static function newFactory()
    {
        return \Modules\LiveChat\Database\factories\LiveChatMessageFactory::new();
    }

    public function buyerList()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function sellerList()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function sellerOnlyForAdmin()
    {
        return $this->belongsTo(User::class, 'seller_id')->select('id','name','email','image');
    }

    public function buyerOnlyForAdmin()
    {
        return $this->belongsTo(User::class, 'buyer_id')->select('id','name','email','image');
    }
}
