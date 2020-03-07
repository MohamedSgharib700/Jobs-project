<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\AgencyCreatedEvent ;
use App\Events\AgencyEditedEvent ;
use App\Events\AgencyDeletedEvent ;
use App\Http\Services\LogsService;

class AgencyListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedAgency(AgencyCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedAgency(AgencyEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedAgency(AgencyDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
}
