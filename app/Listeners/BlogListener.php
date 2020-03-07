<?php

namespace App\Listeners;

use App\Events\BlogCreatedEvent ;
use App\Events\BlogEditedEvent ;
use App\Events\BlogDeletedEvent ;
use App\Http\Services\LogsService;

class BlogListener
{
   public $logsService ;
    public function __construct(LogsService $logsService)
    {
        $this->logsService = $logsService ;
    }

    public function handleCreatedBlog(BlogCreatedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleEditedBlog(BlogEditedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
    public function handleDeletedBlog(BlogDeletedEvent $event)
    {
        $this->logsService->fillLog($event->objectId, $event->objectType, $event->message);

    }
}
