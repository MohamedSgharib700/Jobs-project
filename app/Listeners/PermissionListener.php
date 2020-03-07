<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PermissionEditedEvent ;
use App\Http\Services\LogsService;

class PermissionListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    
    public function handleEditedPermission(PermissionEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
  
}
