<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use App\Events\PermissionEditedEvent;

class Permission extends Model
{

    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['active'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'active' => 0,
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_permissions', 'group_id', 'permission_id')->withPivot("data", "id");
    }

    // public $dispatchesEvents = [
    //     'updated' =>PermissionEditedEvent::class,
    // ];
}
