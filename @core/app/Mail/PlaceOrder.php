<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlaceOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $attachment;
    public $package;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$attachment_list,$package)
    {
        $this->data = $data;
        $this->attachment = $attachment_list;
        $this->package = $package;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
            ->subject('Order For '. $this->package->title.' From '.get_static_option('site_title'))
                ->markdown('mail.order');

        if (!empty($this->attachment)){
            foreach ($this->attachment as $field_name => $attached_file){
                if (file_exists($attached_file)){
                    $mail->attach($attached_file);
                }
            }
        }

        return $mail;

    }
}
