<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class LockoutEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /*
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * @var string
     */
    public $userType;
    /**
     * @var int
     */
    public $attempts;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param string $userType
     * @param int $attempts
     * @return void
     */
    public function __construct(Request $request, $userType, $attempts)
    {
        $this->request  = $request;
        $this->userType = $userType;
        $this->attempts = $attempts;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
