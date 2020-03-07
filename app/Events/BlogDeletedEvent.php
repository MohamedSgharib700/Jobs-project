<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Blog;

class BlogDeletedEvent
{
    use Dispatchable , SerializesModels;

    public $blog;
    public $message;
    public $objectType;
    public $objectId;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
        $this->message = 'deleted';
        $this->objectType = get_class($blog);
        $this->objectId = $blog->id;
    }

}
