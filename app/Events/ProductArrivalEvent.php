<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductArrivalEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $to;
    public $name;
    public $url;
	public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($url, $name = 'celexol')
    {
        $this->name = $name;
        $this->url = $url;
		$this->message = '入荷通知';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
