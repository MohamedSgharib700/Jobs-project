<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\GroupCreatedEvent ;
use App\Events\GroupEditedEvent ;
use App\Events\GroupDeletedEvent ;
use App\Http\Services\LogsService;

class GroupListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedGroup(GroupCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedGroup(GroupEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedGroup(GroupDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
}
