<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\User;

class UserEditedEvent
{
    use Dispatchable , SerializesModels;

    public $user;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->message = 'updated'; 

        if ($user->wasChanged('active')) {
            $active = $user->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }

        $this->objectType = get_class($user);
        $this->objectId = $user->id;
    }



   
   
}
