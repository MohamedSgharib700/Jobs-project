<?php

namespace App\Listeners;

use App\Events\UserLoggedEvent;
use App\Events\UserCreatedEvent ;
use App\Events\UserEditedEvent ;
use App\Events\UserDeletedEvent ;
use App\Http\Services\LogsService;

class UserListener
{
    public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedUser(UserCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedUser(UserEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedUser(UserDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }

    /**
     * @param UserLoggedEvent $event
     */
    public function handleLoggedUser(UserLoggedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);
    }

}
