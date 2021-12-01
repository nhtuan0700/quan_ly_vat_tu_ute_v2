<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestNoteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $is_create;
    public function __construct($is_create)
    {
        $this->is_create = $is_create;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('request-note');
    }

    public function broadcastWith()
    {
        $count = count_note_processing();
        return [
            'count' => $count,
            'is_create' => $this->is_create
        ];
    }

    public function broadcastAs()
    {
        return 'RequestNote';
    }
}
