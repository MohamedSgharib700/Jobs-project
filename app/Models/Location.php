<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\Translations\LocationTranslation ;
use App\Events\LocationCreatedEvent;
use App\Events\LocationDeletedEvent;
use App\Events\LocationEditedEvent;

class Location extends Model
{

    use NodeTrait;
    use Translatable;
    use SoftDeletes;
    
    protected $table = 'locations';
    public $translatedAttributes = ['name', 'deleted_at'];
    protected $appends = ['name'];
    protected $hidden = ['translations'];
    protected $fillable = ['code'];
    
    public $dispatchesEvents = [
        'updated' =>LocationEditedEvent::class,
        'deleted' =>LocationDeletedEvent::class,
        'created' =>LocationCreatedEvent::class,
    ];
    public function getNameAttribute()
    {
        return $this->getTranslationByLocaleKey(app()->getLocale())->name;
    }

    public function workingCountries()
    {
        return $this->belongsToMany(User::class, 'seeker_working_countries', 'country_id', 'user_id');
    }
    public function residence()
    {
        return $this->hasMany(User::class,'country_key', 'id');
    }

  }
