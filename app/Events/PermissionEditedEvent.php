<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Permission;
use Illuminate\Foundation\Http\Request;

class PermissionEditedEvent
{
    use Dispatchable, SerializesModels;

    public $permission;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

        $this->message = 'updated'; 

        if($permission->wasChanged('active')){
            $active = $permission->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }
       

        $this->objectType = get_class($permission);
        $this->objectId = $permission->id;
    }



   
   
}
