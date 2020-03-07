<?php

namespace App\Listeners;

use App\Events\IndustryCreatedEvent ;
use App\Events\IndustryEditedEvent ;
use App\Events\IndustryDeletedEvent ;
use App\Http\Services\LogsService;

class IndustryListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedIndustry(IndustryCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedIndustry(IndustryEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedIndustry(IndustryDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
}
