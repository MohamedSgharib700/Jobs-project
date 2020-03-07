<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\BlogCreatedEvent;
use App\Events\BlogDeletedEvent;
use App\Events\BlogEditedEvent;
class Blog extends Model
{
    use Translatable;
    use SoftDeletes;
    protected $table = 'blog';
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['image', 'active', 'link'];
    public $dispatchesEvents = [
        // 'updated' =>BlogEditedEvent::class,
        'deleted' =>BlogDeletedEvent::class,
        'created' =>BlogCreatedEvent::class,
    ];
    protected $appends = ['name','description'];

    public function getNameAttribute()
    {
        return $this->getTranslationByLocaleKey(app()->getLocale())->name;
    }
    public function getDescriptionAttribute()
    {
        return $this->getTranslationByLocaleKey(app()->getLocale())->description;
    }
}
