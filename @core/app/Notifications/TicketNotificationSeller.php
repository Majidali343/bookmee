<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotificationSeller extends Notification
{
    use Queueable;

    public $last_ticket_id='';
    public $seller_id='';
    public $buyer_id='';
    public $order_ticcket_message='';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($last_ticket_id , $seller_id, $buyer_id,$order_ticcket_message )
    {
        $this->last_ticket_id= $last_ticket_id;
        $this->seller_id = $seller_id;
        $this->buyer_id = $buyer_id;
        $this->order_ticcket_message= $order_ticcket_message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'seller_last_ticket_id'=>$this->last_ticket_id,
            'seller_id'=>$this->seller_id,
            'buyer_id'=>$this->buyer_id,
            'order_ticcket_message'=>$this->order_ticcket_message,
        ];
    }
}
