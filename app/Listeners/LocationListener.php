<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\LocationCreatedEvent ;
use App\Events\LocationEditedEvent ;
use App\Events\LocationDeletedEvent ;
use App\Http\Services\LogsService;

class LocationListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedLocation(LocationCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedLocation(LocationEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedLocation(LocationDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
}
