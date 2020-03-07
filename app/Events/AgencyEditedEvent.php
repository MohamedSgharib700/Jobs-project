<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Agency;

class AgencyEditedEvent
{
    use Dispatchable, SerializesModels;

    public $agency;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Agency $agency)
    {
        $this->agency = $agency;

        $this->message = 'updated'; 

        if ($agency->wasChanged('active')) {
            $active = $agency->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }

        $this->objectType = get_class($agency);
        $this->objectId = $agency->id;
    }



   
   
}
