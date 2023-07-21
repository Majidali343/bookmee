<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    public $order_id='';
    public $service_id='';
    public $seller_id='';
    public $buyer_id='';
    public $order_message='';
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order_id,$service_id,$seller_id,$buyer_id,$order_message)
    {
        
        $this->order_id = $order_id;
        $this->service_id = $service_id;
        $this->seller_id = $seller_id;
        $this->buyer_id = $buyer_id;
        $this->order_message = $order_message;
        
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
            'order_id'=>$this->order_id,
            'service_id'=>$this->service_id,
            'seller_id'=>$this->seller_id,
            'buyer_id'=>$this->buyer_id,
            'order_message'=>$this->order_message,
            
        ];
    }
}
