<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Agency;

class AgencyDeletedEvent
{
    use Dispatchable, SerializesModels;

    public $agency;
    public $message;
    public $objectType;
    public $objectId;
    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
        $this->message = 'deleted'; 
        $this->objectType = get_class($agency);
        $this->objectId = $agency->id;
    }

}
