<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Public properties are automatically sent as the Pusher payload.
     */
    public $user_name;
    public $comment_text;
    public $admin_reply;

    public function __construct($user_name, $comment_text, $admin_reply = null)
    {
        $this->user_name = $user_name;
        $this->comment_text = $comment_text;
        $this->admin_reply = $admin_reply;
    }

    /**
     * The channel name Pusher will broadcast to.
     */
    public function broadcastOn()
    {
        return new Channel('broadcast-studio');
    }

    /**
     * The event name Pusher will broadcast as.
     * In JS, you listen for '.MessageSent' (the dot signifies a custom name).
     */
    public function broadcastAs()
    {
        return 'MessageSent';
    }

    /**
     * Optional: Control exactly what data is sent to Pusher.
     */
    public function broadcastWith()
    {
        return [
            'user_name' => $this->user_name,
            'comment_text' => $this->comment_text,
            'admin_reply' => $this->admin_reply,
            'time_formatted' => now()->diffForHumans(),
        ];
    }
}
