<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Blog;

class BlogEditedEvent
{
    use Dispatchable, SerializesModels;

    public $blog;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;

        $this->message = 'updated'; 

        if ($blog->wasChanged('active')) {
            $active = $blog->active ? 'active' : 'disabled';
            $this->message = 'changed_status_to_' . $active;
        }

        $this->objectType = get_class($blog);
        $this->objectId = $blog->id;
    }
}
