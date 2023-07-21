<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestConsulation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $attachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$attachment_list)
    {
        $this->data = $data;
        $this->attachment = $attachment_list;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $mail =  $this->from(get_static_option('site_global_email'),get_static_option('site_title'))
            ->subject('This Consulation Message Send From '. get_static_option('site_title') )
            ->markdown('mail.request-consulation');
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
