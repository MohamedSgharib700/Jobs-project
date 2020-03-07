<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\User ;

class UserCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $objectType;
    public $objectId;
    
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->message = 'created'; 
        $this->objectType = get_class($user);
        $this->objectId = $user->id;
    }
}
