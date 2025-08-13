<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;

    public function __construct(User $sender, $message)
    {
        $this->sender = $sender;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat'); 
    }

    public function broadcastAs()
    {
        return 'message.sent'; 
    }
}