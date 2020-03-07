<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Industry;

class IndustryEditedEvent
{
    use Dispatchable, SerializesModels;

    public $industry;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Industry $industry)
    {
        $this->industry = $industry;

        $this->message = 'updated'; 

        if ($industry->wasChanged('active')) {
            $active = $industry->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }

        $this->objectType = get_class($industry);
        $this->objectId = $industry->id;
    }
}
