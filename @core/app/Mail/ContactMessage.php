<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject;
    public $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$attachment_list,$subject)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->attachment = $attachment_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(get_static_option('site_global_email'), get_static_option('site_title'))
        ->subject($this->subject)
        ->markdown('mail.contact');

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
