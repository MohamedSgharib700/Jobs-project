<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Location;

class LocationEditedEvent
{
    use Dispatchable, SerializesModels;

    public $location;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Location $location)
    {
        $this->location = $location;

        $this->message = 'updated'; 

        if ($location->wasChanged('active')) {
            $active = $location->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }

        $this->objectType = get_class($location);
        $this->objectId = $location->id;
    }



   
   
}
