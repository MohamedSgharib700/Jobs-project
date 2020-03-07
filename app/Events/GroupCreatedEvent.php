<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Group ;

class GroupCreatedEvent
{
    use Dispatchable, SerializesModels;

    public $group;
    public $message;
    public $objectType;
    public $objectId;
    
    public function __construct(Group $group)
    {
        $this->group = $group;
        $this->message = 'created'; 
        $this->objectType = get_class($group);
        $this->objectId = $group->id;
    }
}
