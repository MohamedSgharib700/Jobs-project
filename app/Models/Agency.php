<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\AgencyCreatedEvent;
use App\Events\AgencyDeletedEvent;
use App\Events\AgencyEditedEvent;


class Agency extends Model
{
    protected $table = 'agencies';
    
    protected $fillable = ['name', 'phone', 'email', 'address', 'location_id', 'long', 'lat'];
    
    public $dispatchesEvents = [
        'updated' =>AgencyEditedEvent::class,
        'deleted' =>AgencyDeletedEvent::class,
        'created' =>AgencyCreatedEvent::class,
    ];
   
    public function location() {
       return $this->belongsTo(Location::class, 'location_id', 'id') ;
    }

}
