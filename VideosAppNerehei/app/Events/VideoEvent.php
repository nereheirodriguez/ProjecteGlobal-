<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video;

    public function __construct($video)
    {
        $this->video = $video;
    }

    public function broadcastOn()
    {
        return new Channel('video');
    }

    public function broadcastAs()
    {
        return 'video.created';
    }
}
