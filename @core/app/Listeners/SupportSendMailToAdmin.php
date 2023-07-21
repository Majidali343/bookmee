<?php

namespace App\Listeners;

use App\Events\SupportMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SupportMail;
use App\SupportTicket;
use Illuminate\Support\Facades\Mail;

class SupportSendMailToAdmin
{

    public function __construct()
    {
        //
    }

    public function handle(SupportMessage $event)
    {
        $ticket_info = $event->message;
        if ($ticket_info->notify === 'on' && $ticket_info->type == 'customer'){
            //subject
            $subject = __('your have a new message in ticket').' #'.$ticket_info->support_ticket_id;
            $admin_email = get_static_option('site_global_email') ?? '';
            $message = '<p>'.__('Hello').'<br>';
            $message .=  __('you have a new message in ticket no').' #'.$ticket_info->support_ticket_id.'. ';
            $message .= '<div class="btn-wrap"><a class="anchor-btn" href="'.route('admin.support.ticket.view',$ticket_info->support_ticket_id).'">'.__('check messages').'</a></div>';
            $message .= '</p>';
            if (!empty($admin_email)){
                try {
                    Mail::to($admin_email)->send(new SupportMail([
                        'message' => $message,
                        'subject' => $subject
                    ]));
                }catch (\Exception $e){
                    //show error message
                }
            }
        }
    }
}
