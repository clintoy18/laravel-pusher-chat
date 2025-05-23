<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PrivateMessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $sender;
    protected $receiverId;

    public function __construct(Message $message, $receiver)
    {
        $this->message = $message;
        $this->sender = $message->user;
        $this->receiverId = $receiver->id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.user.' . $this->receiverId);
    }

    public function broadcastAs()
    {
        return 'private-message';
    }
}
