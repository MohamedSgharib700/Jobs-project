<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Blog;

class BlogCreatedEvent
{
    use Dispatchable , SerializesModels;

    public $industry;
    public $message;
    public $objectType;
    public $objectId;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
        $this->message = 'created';
        $this->objectType = get_class($blog);
        $this->objectId = $blog->id;
    }
}
