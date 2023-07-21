<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\LiveChat\Entities\LiveChatMessage;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(LiveChatMessage $message)
    {
        $this->message = $message;
    }

    public function broadcastAs()
    {
        \Log::info('broadcastAs '. $this->message);
        return 'message.sent';
    }

    public function broadcastOn()
    {
        \Log::info('broadcastOn '. $this->message->to_user);
        return new PrivateChannel('chat-message.' . $this->message->to_user);
    }
}
