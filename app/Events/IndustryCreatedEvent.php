<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Industry;

class IndustryCreatedEvent
{
    use Dispatchable , SerializesModels;

    public $industry;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Industry $industry)
    {
        $this->industry = $industry;
        $this->message = 'created';
        $this->objectType = get_class($industry);
        $this->objectId = $industry->id;
    }
}
