<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $order_details;

    public function __construct($subject,$order_details)
    {
        $this->subject = $subject;
        $this->order_details = $order_details;
    }

    public function build()
    {
        $subject = $this->subject;
        $order_details = $this->order_details;

        return $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
        ->subject($subject)
        ->markdown('mail.order-mail-template',compact('order_details'));
    }
}
