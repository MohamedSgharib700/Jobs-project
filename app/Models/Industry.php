<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\IndustryCreatedEvent;
use App\Events\IndustryDeletedEvent;
use App\Events\IndustryEditedEvent;

class Industry extends Model
{
    use Translatable;
    use SoftDeletes;
    protected $table = 'industries';
    public $translatedAttributes = ['name'];
    protected $fillable = ['image', 'active', 'parent_id'];
    public $dispatchesEvents = [
        // 'updated' =>IndustryEditedEvent::class,
        'deleted' => IndustryDeletedEvent::class,
        'created' => IndustryCreatedEvent::class,
    ];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->getTranslationByLocaleKey(app()->getLocale())->name;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_industries', 'industry_id', 'user_id');
    }

    public function children()
    {
        return $this->hasMany(Industry::class, 'parent_id');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'industry_id');
    }

    public function jobRoles()
    {
        return $this->hasMany(JobRoles::class, 'role_id');
    }

    public function usersRoles()
    {
        return $this->belongsToMany(User::class, 'users_roles','role_id', 'user_id');
    }
}

