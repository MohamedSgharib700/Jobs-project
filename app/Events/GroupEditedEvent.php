<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Group ;

class GroupEditedEvent
{
    use Dispatchable, SerializesModels;

    public $group;
    public $message;
    public $objectType;
    public $objectId;
    
    public function __construct(Group $group)
    {
        $this->group = $group;
        $this->message = 'updated';

        if ($group->wasChanged('active')) {
            $active = $group->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }
        $this->objectType = get_class($group);
        $this->objectId = $group->id;
    }
}
