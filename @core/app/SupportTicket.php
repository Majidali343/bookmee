<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;
    protected $table = 'support_tickets';
    protected $fillable = ['title','via','operating_system','user_agent','description','subject','status','priority','user_id','buyer_id','seller_id','service_id','order_id','admin_id','department'];

    public function ticket_department(){
        return $this->belongsTo(SupportDepartment::class,'department','id');
    }

    public function ticket_user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ticket_buyer(){
        return $this->belongsTo(User::class,'buyer_id','id');
    }

    public function ticket_seller(){
        return $this->belongsTo(User::class,'seller_id','id');
    }

    public function ticket_service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
    
      public function ticket_order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
